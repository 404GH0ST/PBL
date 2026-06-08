@php
    $rupiah = fn($value) => 'Rp ' . number_format((float) ($value ?? 0), 0, ',', '.');
    $date = fn($value) => $value ? $value->timezone(config('app.timezone'))->format('d M Y, H:i') : '-';

    $activeContact = \Illuminate\Support\Facades\Schema::hasTable('contacts')
        ? \App\Models\Contact::active()
        : null;

    $brandTitle = 'Deenhag';
    $address = $activeContact?->address ?? 'Jl. Sultan Agung No. 24, Ponorogo, Jawa Timur, Indonesia';

    if ($activeContact && $activeContact->logo) {
        $logoSrc = ($isPdf ?? false)
            ? public_path('storage/' . $activeContact->logo)
            : asset('storage/' . $activeContact->logo);

        if (($isPdf ?? false) && !file_exists($logoSrc)) {
            $logoSrc = public_path('images/logo_deenhag.png');
        }
    } else {
        $logoSrc = ($isPdf ?? false) ? public_path('images/logo_deenhag.png') : asset('images/logo_deenhag.png');
    }
@endphp

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: #f3f4f6;
        color: #111827;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        line-height: 1.5;
    }

    .invoice-page {
        max-width: 960px;
        margin: 32px auto;
        padding: 0 16px;
    }

    .invoice-toolbar {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-bottom: 16px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 8px 14px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background: #ffffff;
        color: #111827;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-primary {
        border-color: #0f766e;
        background: #0f766e;
        color: #ffffff;
    }

    .invoice-sheet {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 36px;
    }

    .invoice-header {
        display: table;
        width: 100%;
        border-bottom: 2px solid #111827;
        padding-bottom: 22px;
        margin-bottom: 24px;
    }

    .brand,
    .invoice-meta {
        display: table-cell;
        width: 50%;
        vertical-align: top;
    }

    .invoice-meta {
        text-align: right;
    }

    .brand-layout {
        display: table;
        width: 100%;
    }

    .brand-logo-cell,
    .brand-text-cell {
        display: table-cell;
        vertical-align: middle;
    }

    .brand-logo-cell {
        width: 86px;
    }

    .brand-logo {
        display: block;
        width: auto;
        max-width: 78px;
        max-height: 64px;
        object-fit: contain;
    }

    .brand-text-cell {
        padding-left: 14px;
    }

    .brand-name {
        margin: 0 0 6px;
        color: #0f766e;
        font-size: 26px;
        font-weight: 800;
        letter-spacing: 0;
    }

    .invoice-title {
        margin: 0 0 8px;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: 0;
    }

    .muted {
        color: #6b7280;
    }

    .section {
        margin-top: 24px;
    }

    .section-title {
        margin: 0 0 12px;
        color: #0f766e;
        font-size: 15px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0;
    }

    .grid {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .col {
        display: table-cell;
        width: 50%;
        vertical-align: top;
    }

    .col + .col {
        padding-left: 24px;
    }

    .info-table,
    .items-table,
    .summary-table {
        width: 100%;
        border-collapse: collapse;
    }

    .info-table th {
        width: 42%;
        padding: 8px 0;
        color: #6b7280;
        font-weight: 700;
        text-align: left;
        vertical-align: top;
    }

    .info-table td {
        padding: 8px 0;
        font-weight: 700;
        vertical-align: top;
    }

    .items-table th,
    .items-table td,
    .summary-table th,
    .summary-table td {
        border: 1px solid #e5e7eb;
        padding: 10px 12px;
        text-align: left;
        vertical-align: top;
    }

    .items-table th,
    .summary-table th {
        background: #f9fafb;
        color: #374151;
        font-size: 12px;
        text-transform: uppercase;
    }

    .text-right {
        text-align: right;
    }

    .badge {
        display: inline-block;
        padding: 4px 9px;
        border-radius: 999px;
        background: #fef3c7;
        color: #92400e;
        font-size: 12px;
        font-weight: 800;
    }

    .badge-success {
        background: #dcfce7;
        color: #166534;
    }

    .notes {
        min-height: 58px;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        background: #f9fafb;
        white-space: pre-line;
    }

    .footer {
        margin-top: 28px;
        padding-top: 18px;
        border-top: 1px solid #e5e7eb;
        color: #6b7280;
        font-size: 12px;
        text-align: center;
    }

    @media print {
        body {
            background: #ffffff;
        }

        .invoice-page {
            max-width: none;
            margin: 0;
            padding: 0;
        }

        .invoice-toolbar {
            display: none;
        }

        .invoice-sheet {
            border: 0;
            border-radius: 0;
            padding: 0;
        }
    }

    @media (max-width: 720px) {
        .invoice-sheet {
            padding: 22px;
        }

        .brand,
        .invoice-meta,
        .col {
            display: block;
            width: 100%;
        }

        .invoice-meta {
            margin-top: 16px;
            text-align: left;
        }

        .brand-logo-cell {
            width: 76px;
        }

        .brand-logo {
            max-width: 68px;
            max-height: 58px;
        }

        .col + .col {
            padding-left: 0;
            margin-top: 18px;
        }
    }
</style>

<div class="invoice-page">
    @unless($isPdf ?? false)
        <div class="invoice-toolbar">
            <button type="button" class="btn" onclick="window.print()">Print</button>
        </div>
    @endunless

    <article class="invoice-sheet">
        <header class="invoice-header">
           <div class="brand">
                <img src="{{ $logoSrc }}" alt="Logo {{ $brandTitle }}" style="height: 50px;">
                <p>{{ $address }}</p>
            </div>
            <div class="invoice-meta">
                <h2 class="invoice-title">INVOICE</h2>
                <div><strong>{{ $invoice['number'] }}</strong></div>
                <div class="muted">Tanggal Invoice: {{ $date($order->created_at) }}</div>
            </div>
        </header>

        <section class="grid">
            <div class="col">
                <h3 class="section-title">Customer</h3>
                <table class="info-table">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $order->customer_name ?: '-' }}</td>
                    </tr>
                    <tr>
                        <th>WhatsApp</th>
                        <td>{{ $order->customer_whatsapp ?: '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Pengiriman</th>
                        <td>{{ $order->shipping_address ?: '-' }}</td>
                    </tr>
                </table>
            </div>

            <div class="col">
                <h3 class="section-title">Pesanan</h3>
                <table class="info-table">
                    <tr>
                        <th>Tracking ID</th>
                        <td>{{ $order->tracking_id ?: '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status Order</th>
                        <td>{{ $invoice['order_status'] }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Order</th>
                        <td>{{ $date($order->created_at) }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lunas</th>
                        <td>{{ $date($order->paid_at) }}</td>
                    </tr>
                </table>
            </div>
        </section>

        <section class="section">
            <h3 class="section-title">Produk</h3>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Addons</th>
                        <th class="text-right">Jumlah pcs</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $invoice['product_name'] }}</td>
                        <td>
                            @forelse($invoice['addon_groups'] as $group)
                                <div>
                                    {{ $group['names'] ? implode(', ', $group['names']) : '-' }}
                                    @if($group['quantity'] > 0)
                                        <span class="muted">({{ $group['quantity'] }} pcs)</span>
                                    @endif
                                </div>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td class="text-right">{{ number_format((int) $order->quantity, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="section">
            <h3 class="section-title">Pembayaran</h3>
            <table class="summary-table">
                <tr>
                    <th>Total Pembayaran</th>
                    <td class="text-right">{{ $rupiah($order->total_price) }}</td>
                </tr>
                <tr>
                    <th>Tipe Pembayaran</th>
                    <td class="text-right">{{ $invoice['payment_type'] }}</td>
                </tr>
                <tr>
                    <th>DP / Uang Muka</th>
                    <td class="text-right">{{ $rupiah($invoice['dp_amount']) }}</td>
                </tr>
                <tr>
                    <th>Pelunasan</th>
                    <td class="text-right">{{ $rupiah($invoice['settlement_amount']) }}</td>
                </tr>
                <tr>
                    <th>Total Dibayar</th>
                    <td class="text-right"><strong>{{ $rupiah($invoice['paid_amount']) }}</strong></td>
                </tr>
                <tr>
                    <th>Kekurangan Pembayaran</th>
                    <td class="text-right"><strong>{{ $rupiah($invoice['remaining_payment']) }}</strong></td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td class="text-right">
                        <span class="badge {{ $invoice['payment_status'] === 'Lunas' ? 'badge-success' : '' }}">
                            {{ $invoice['payment_status'] }}
                        </span>
                    </td>
                </tr>
            </table>
        </section>

        <section class="section">
            <h3 class="section-title">Catatan Customer</h3>
            <div class="notes">{{ $order->notes ?: '-' }}</div>
        </section>

        <footer class="footer">
            Invoice ini dibuat otomatis dari data order {{ $order->tracking_id }}.
        </footer>
    </article>
</div>
