<?php

namespace App\Filament\Admin\Pages;

use Filament\Actions\Action;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Schemas\Components\Component;

class EditProfile extends BaseEditProfile
{
    public static function getLabel(): string
    {
        return 'Profil Akun';
    }

    protected function getNameFormComponent(): Component
    {
        return parent::getNameFormComponent()
            ->label('Nama');
    }

    protected function getEmailFormComponent(): Component
    {
        return parent::getEmailFormComponent()
            ->label('Alamat Email');
    }

    protected function getPasswordFormComponent(): Component
    {
        return parent::getPasswordFormComponent()
            ->label('Kata Sandi Baru');
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return parent::getPasswordConfirmationFormComponent()
            ->label('Konfirmasi Kata Sandi Baru');
    }

    protected function getCurrentPasswordFormComponent(): Component
    {
        return parent::getCurrentPasswordFormComponent()
            ->label('Kata Sandi Saat Ini')
            ->belowContent('Wajib diisi ketika mengubah email atau kata sandi.');
    }

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->label('Simpan Perubahan');
    }

    public function backAction(): Action
    {
        return parent::backAction()
            ->label('Batal');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Profil akun berhasil diperbarui';
    }
}
