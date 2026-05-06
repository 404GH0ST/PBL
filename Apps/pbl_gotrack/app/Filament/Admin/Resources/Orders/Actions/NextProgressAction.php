<?php

namespace App\Filament\Admin\Resources\Orders\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NextProgressAction
{
    public static function make(): Action
    {
        return Action::make('update_progress')
            ->label('Next Progress')
            ->icon('heroicon-o-forward')
            ->color('success')
            ->hidden(function ($record) {
                if (!$record || !$record->product || !$record->product->category_id) return true;

                $stages = \App\Models\ProductionStage::where('category_id', $record->product->category_id)->orderBy('sequence')->get();
                if ($stages->isEmpty()) return true;

                $lastProgress = $record->progress()->latest('id')->first();
                if ($lastProgress && $lastProgress->production_stage_id == $stages->last()->id) return true;

                return false;
            })
            ->form(function ($record) {
                if (!$record || !$record->product || !$record->product->category_id) return [];

                $stages = \App\Models\ProductionStage::where('category_id', $record->product->category_id)->orderBy('sequence')->get();
                if ($stages->isEmpty()) return [];

                $lastProgress = $record->progress()->latest('id')->first();
                $nextStage = null;

                if (!$lastProgress) {
                    $nextStage = $stages->first();
                } else {
                    $currentIndex = $stages->search(fn($s) => $s->id == $lastProgress->production_stage_id);
                    if ($currentIndex !== false) {
                        $nextStage = $stages->get($currentIndex + 1) ?? $stages->first();
                    }
                }

                return [
                    Hidden::make('production_stage_id')
                        ->default($nextStage ? $nextStage->id : null),

                    TextInput::make('stage_name')
                        ->label('Tahapan Selanjutnya (Otomatis)')
                        ->default($nextStage ? $nextStage->name : 'Tahapan Selesai/Error')
                        ->disabled()
                        ->dehydrated(false)
                        ->extraInputAttributes(['class' => 'font-bold text-primary-600']),

                    Textarea::make('notes')
                        ->label('Catatan Admin')
                        ->placeholder('Tambahkan catatan opsional...')
                        ->rows(3),

                    // FIELD FOTO SEKARANG SELALU MUNCUL & OPSIONAL
                    FileUpload::make('photo')
                        ->label('Foto Bukti / Dokumentasi (Opsional)')
                        ->directory('orders/progress-photos')
                        ->image(),
                ];
            })
            ->action(function ($record, array $data): void {
                $stage = \App\Models\ProductionStage::find($data['production_stage_id']);
                $stages = \App\Models\ProductionStage::where('category_id', $record->product->category_id)->orderBy('sequence')->get();

                // Cek apakah ini tahapan paling terakhir?
                $isFinal = $stage && $stages->last() && $stage->id === $stages->last()->id;

                // 1. Simpan Riwayat Progress
                $record->progress()->create([
                    'production_stage_id' => $data['production_stage_id'],
                    'title' => $stage ? $stage->name : 'Update Progress',
                    'notes' => $data['notes'] ?? null,
                    'photo' => $data['photo'] ?? null,
                    'staff_id' => Auth::id(),
                ]);

                // 2. SIHIR AUTO-SYNC STATUS PRODUKSI UTAMA
                $record->update([
                    'status' => $isFinal ? 'completed' : 'processing'
                ]);

                Notification::make()
                    ->title($isFinal ? 'Pesanan Selesai!' : 'Tahapan Berhasil Diupdate!')
                    ->success()
                    ->send();
            });
    }
}
