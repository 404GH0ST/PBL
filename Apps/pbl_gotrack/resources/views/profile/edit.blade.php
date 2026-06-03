<x-app-layout>
    <section class="profile-page">
        <div class="profile-shell">
            <div class="profile-hero">
                <div>
                    <p class="profile-kicker">Profil Admin</p>
                    <h1>Pengaturan Akun</h1>
                    <p>Perbarui identitas akun dan kata sandi yang digunakan untuk masuk ke sistem GoTrack.</p>
                </div>

                <div class="profile-user-card">
                    <span class="profile-avatar">{{ strtoupper(\Illuminate\Support\Str::substr($user->name, 0, 1)) }}</span>
                    <div>
                        <strong>{{ $user->name }}</strong>
                        <span>{{ $user->email }}</span>
                    </div>
                </div>
            </div>

            <div class="profile-grid">
                <article class="profile-card">
                    <header>
                        <span class="profile-card-icon">01</span>
                        <div>
                            <h2>Informasi Akun</h2>
                            <p>Ubah nama dan email akun admin yang sedang digunakan.</p>
                        </div>
                    </header>

                    @include('profile.partials.update-profile-information-form')
                </article>

                <article class="profile-card">
                    <header>
                        <span class="profile-card-icon">02</span>
                        <div>
                            <h2>Keamanan Akun</h2>
                            <p>Ganti kata sandi secara berkala untuk menjaga keamanan akses.</p>
                        </div>
                    </header>

                    @include('profile.partials.update-password-form')
                </article>

                <article class="profile-card profile-card--danger">
                    <header>
                        <span class="profile-card-icon">03</span>
                        <div>
                            <h2>Hapus Akun</h2>
                            <p>Gunakan fitur ini hanya jika akun benar-benar tidak diperlukan.</p>
                        </div>
                    </header>

                    @include('profile.partials.delete-user-form')
                </article>
            </div>
        </div>
    </section>
</x-app-layout>
