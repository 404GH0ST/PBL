<?php

namespace App\Filament\Admin\Resources\Orders\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

class UpdatePaymentAction
{
    public static function make(): Action
    {
        return Action::make('update_payment')
            ->label('Pelunasan')
            ->icon('heroicon-o-credit-card')
            ->color('warning')
            ->authorize('updatePayment')
            ->visible(fn($record): bool => $record?->payment_type === 'dp' && $record?->payment_status !== 'paid')
            ->modalHeading('Pelunasan Pembayaran')
            ->modalSubmitActionLabel('Lunasi Pembayaran')
            ->modalCancelActionLabel('Batal')
            ->form(fn($record): array => [
                TextInput::make('total_price')
                    ->label('Total Pembayaran')
                    ->prefix('Rp')
                    ->default($record?->total_price ?? 0)
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('dp_amount')
                    ->label('DP / Uang Muka')
                    ->prefix('Rp')
                    ->default($record?->dp_amount ?? 0)
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('remaining_payment')
                    ->label('Kekurangan Pembayaran')
                    ->prefix('Rp')
                    ->default($record?->remaining_payment ?? 0)
                    ->disabled()
                    ->dehydrated(false),
            ])
            ->action(function ($record): void {
                $record->update([
                    'payment_type' => 'paid',
                    'payment_status' => 'paid',
                    'paid_amount' => $record->total_price,
                    'paid_at' => now(),
                ]);

                Notification::make()
                    ->title('Pembayaran berhasil dilunasi')
                    ->success()
                    ->send();
            });
    }
}
