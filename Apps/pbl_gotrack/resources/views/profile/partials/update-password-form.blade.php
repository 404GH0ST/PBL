<section>
    <form method="post" action="{{ route('password.update') }}" class="profile-form">
        @csrf
        @method('put')

        <div class="profile-field">
            <label for="update_password_current_password">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="profile-field">
            <label for="update_password_password">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="profile-field">
            <label for="update_password_password_confirmation">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="profile-actions">
            <button type="submit" class="profile-primary-button">Perbarui Kata Sandi</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="profile-success"
                >Kata sandi berhasil diperbarui.</p>
            @endif
        </div>
    </form>
</section>
