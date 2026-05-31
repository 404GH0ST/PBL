<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use App\Models\Product;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use App\Models\ProductAddon;
use Filament\Forms\Components\Repeater;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(['default' => 3])
                    ->schema([
                        // ==========================================
                        // KIRI: INPUT KASIR
                        // ==========================================
                        Group::make()->schema([
                            Section::make('Informasi Transaksi')
                                ->schema([
                                    TextInput::make('customer_name')->label('Nama Pemesan')->required(),
                                    TextInput::make('customer_whatsapp')->label('Nomor WhatsApp')->numeric()->required(),
                                    Textarea::make('shipping_address')
                                        ->label('Alamat Pengiriman')
                                        ->rows(3)
                                        ->columnSpanFull()
                                        ->required(),
                                    Select::make('product_id')
                                        ->relationship('product', 'name')
                                        ->label('Pilih Produk Katalog')
                                        ->searchable()
                                        ->required()
                                        ->live(onBlur: true)
                                        ->extraInputAttributes(['style' => 'background-image: none; -webkit-appearance: none; appearance: none; padding-right: 1rem;'])
                                        ->afterStateUpdated(function ($set, $get) {
                                            $set('selected_addons', []);
                                            self::calculateTotal($set, $get);
                                        }),
                                    TextInput::make('tracking_id')
                                        ->label('Nomor Resi')
                                        ->default('CTX-' . strtoupper(uniqid()))
                                        ->disabled()->dehydrated()->required(),
                                    Select::make('status')
                                        ->label('Status Produksi')
                                        ->options([
                                            'processing' => 'Sedang Diproses',
                                            'shipped' => 'Dalam Pengiriman',
                                            'completed' => 'Selesai / Diterima Customer',
                                            'cancelled' => 'Dibatalkan',
                                        ])
                                        ->default('processing')
                                        ->required(fn($operation) => $operation !== 'view')
                                        ->extraInputAttributes(['style' => 'background-image: none; -webkit-appearance: none; appearance: none; padding-right: 1rem;']),
                                ])->columns(2),

                            Section::make('Rincian Variasi & Kuantitas')
                                ->schema([
                                    Repeater::make('selected_addons')
                                        ->label('')
                                        ->schema([
                                            Select::make('addons')
                                                ->label('Spesifikasi')
                                                ->multiple()
                                                ->extraInputAttributes(['style' => 'background-image: none; -webkit-appearance: none; appearance: none;'])
                                                ->options(function ($get) {
                                                    $productId = $get('../../product_id');
                                                    if (!$productId) return [];
                                                    $product = Product::find($productId);
                                                    if (!$product || !$product->category_id) return [];
                                                    $addons = ProductAddon::where('category_id', $product->category_id)->get();
                                                    $groupedOptions = [];
                                                    foreach ($addons as $addon) {
                                                        $priceText = $addon->price > 0 ? " (+Rp " . number_format($addon->price, 0, ',', '.') . ")" : " (Gratis)";
                                                        $groupedOptions[$addon->type][$addon->id] = $addon->name . $priceText;
                                                    }
                                                    return $groupedOptions;
                                                })
                                                ->live()
                                                ->afterStateUpdated(fn($set, $get) => self::calculateTotal($set, $get))
                                                ->columnSpan(2),
                                            TextInput::make('quantity')
                                                ->label('Jumlah Qty')
                                                ->numeric()->default(1)->required()->live(onBlur: true)
                                                ->minValue(1)
                                                ->afterStateUpdated(fn($set, $get) => self::calculateTotal($set, $get))
                                                ->columnSpan(1),
                                        ])->columns(3)->defaultItems(1)->addActionLabel('+ Tambah Rincian')->columnSpanFull(),
                                    TextInput::make('quantity')->label('Total Kuantitas Keseluruhan')->numeric()->default(0)->disabled()->dehydrated()->required(),
                                ])->columns(1),

                            Section::make('Berkas & Catatan')
                                ->schema([
                                    FileUpload::make('design_file')->label('File Desain (Jika Ada)')->directory('orders/designs'),
                                    Textarea::make('notes')->label('Catatan Opsional')->columnSpanFull(),
                                ]),
                        ])->columnSpan(['default' => 3, 'lg' => 2]),

                        // ==========================================
                        // KANAN: RINGKASAN & PEMBAYARAN
                        // ==========================================
                        Group::make()->schema([
                            Section::make('Rincian Tagihan')
                                ->schema([
                                    TextInput::make('total_price')
                                        ->label('Total Tagihan Akhir')
                                        ->readOnly()
                                        ->prefix('Rp')
                                        ->extraInputAttributes(['class' => 'text-2xl font-bold text-primary-600'])
                                        ->default(0)->disabled()->dehydrated(),
                                    Select::make('payment_status')
                                        ->label('Status Pembayaran')
                                        ->options([
                                            'unpaid' => 'Belum Bayar',
                                            'dp' => 'DP (Uang Muka)',
                                            'paid' => 'Lunas',
                                        ])
                                        ->default('unpaid')->live()->required()
                                        ->extraInputAttributes(['style' => 'background-image: none; -webkit-appearance: none; appearance: none; padding-right: 1rem;']),
                                    TextInput::make('dp_amount')
                                        ->label('Nominal DP (Dibayar Sekarang)')
                                        ->numeric()->prefix('Rp')
                                        ->minValue(0)
                                        ->visible(fn($get) => $get('payment_status') === 'dp')
                                        ->required(fn($get) => $get('payment_status') === 'dp'),
                                ]),
                            // RIWAYAT PRODUKSI DI SINI SUDAH DIHAPUS SEPENUHNYA
                        ])->columnSpan(['default' => 3, 'lg' => 1]),
                    ])->columnSpan('full'),
            ]);
    }

    protected static function calculateTotal($set, $get): void
    {
        $isInsideRepeater = $get('selected_addons') === null;

        $productId = $isInsideRepeater ? $get('../../product_id') : $get('product_id');
        $repeaterItems = $isInsideRepeater ? ($get('../../selected_addons') ?: []) : ($get('selected_addons') ?: []);

        $basePrice = 0;
        if ($productId) {
            $product = Product::find($productId);
            if ($product) $basePrice = $product->price;
        }
        $totalItemsPrice = 0;
        $totalQuantity = 0;
        foreach ($repeaterItems as $item) {
            $qty = (int) ($item['quantity'] ?? 1);
            $totalQuantity += $qty;
            $addonIds = $item['addons'] ?? [];
            $addonsPrice = 0;
            if (!empty($addonIds)) {
                $addonsPrice = ProductAddon::whereIn('id', $addonIds)->sum('price');
            }
            $totalItemsPrice += ($basePrice + $addonsPrice) * $qty;
        }

        if ($isInsideRepeater) {
            $set('../../total_price', $totalItemsPrice);
            $set('../../quantity', $totalQuantity);
        } else {
            $set('total_price', $totalItemsPrice);
            $set('quantity', $totalQuantity);
        }
    }
}
