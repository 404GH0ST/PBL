<x-guest-layout>
    <main
        x-data="{
            isDark: (() => {
                const stored = localStorage.getItem('site-theme');
                if (stored === 'dark' || stored === 'light') return stored === 'dark';
                return window.matchMedia('(prefers-color-scheme: dark)').matches;
            })(),
            toggleTheme() {
                this.isDark = ! this.isDark;
                localStorage.setItem('site-theme', this.isDark ? 'dark' : 'light');
                document.documentElement.dataset.siteTheme = this.isDark ? 'dark' : 'light';
            }
        }"
        x-bind:data-theme="isDark ? 'dark' : 'light'"
        class="login-page relative min-h-screen overflow-hidden px-5 py-8 text-black transition-colors duration-300"
    >
        <div class="login-orb login-orb--top" aria-hidden="true"></div>
        <div class="login-orb login-orb--bottom" aria-hidden="true"></div>
        <div class="login-glow" aria-hidden="true"></div>

        <div class="relative z-10 mx-auto flex min-h-[calc(100vh-4rem)] max-w-6xl items-center justify-center">
            <div class="login-panel reset-panel grid w-full max-w-[820px] overflow-hidden rounded-[28px] sm:grid-cols-[0.92fr_1.08fr]">
                <aside class="forgot-brief reset-brief flex min-h-[280px] flex-col justify-between px-8 py-8 sm:px-9 sm:py-10">
                    <div>
                        <span class="forgot-logo-mark block h-10 w-10 rounded-full" aria-hidden="true"></span>
                        <p class="mt-6 font-['DM_Sans'] text-sm font-bold uppercase tracking-[0.16em] text-white/55">Keamanan akun</p>
                    </div>

                    <div>
                        <h1 class="font-['Plus_Jakarta_Sans'] text-[2.15rem] font-bold leading-tight text-white">
                            Buat kata sandi baru.
                        </h1>
                        <p class="mt-4 font-['DM_Sans'] text-[15px] font-semibold leading-relaxed text-white/68">
                            Gunakan kombinasi kata sandi yang kuat agar akses admin tetap aman.
                        </p>
                    </div>
                </aside>

                <section class="px-8 py-9 sm:px-10 sm:py-11">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="forgot-eyebrow font-['DM_Sans'] text-xs font-bold uppercase tracking-[0.18em]">
                                Reset kata sandi
                            </p>
                            <h2 class="mt-2 font-['Plus_Jakarta_Sans'] text-[1.9rem] font-bold leading-tight">
                                Masukkan kata sandi baru
                            </h2>
                            <p class="login-helper mt-3 max-w-[410px] font-['DM_Sans'] text-[15px] font-semibold leading-snug">
                                Pastikan alamat email sesuai dengan akun admin yang menerima tautan reset.
                            </p>
                        </div>

                        <button
                            type="button"
                            class="login-link rounded-md font-['DM_Sans'] text-xs font-bold focus:outline-none focus:ring-2 focus:ring-offset-2"
                            x-on:click="toggleTheme()"
                            x-text="isDark ? 'Light' : 'Dark'"
                        ></button>
                    </div>

                    <form method="POST" action="{{ route('password.store') }}" class="mt-7 space-y-4">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div>
                            <label for="email" class="block font-['DM_Sans'] text-sm font-bold">Email</label>
                            <input
                                id="email"
                                class="login-input mt-2.5 block h-[48px] w-full rounded-[15px] border bg-transparent px-5 font-['DM_Sans'] text-[15px] font-semibold outline-none transition"
                                type="email"
                                name="email"
                                value="{{ old('email', $request->email) }}"
                                required
                                autocomplete="username"
                                placeholder="admin@gmail.com"
                            >
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="block font-['DM_Sans'] text-sm font-bold">Kata Sandi Baru</label>
                            <input
                                id="password"
                                class="login-input mt-2.5 block h-[48px] w-full rounded-[15px] border bg-transparent px-5 font-['DM_Sans'] text-[15px] font-semibold outline-none transition"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Minimal 8 karakter"
                            >
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block font-['DM_Sans'] text-sm font-bold">Konfirmasi Kata Sandi</label>
                            <input
                                id="password_confirmation"
                                class="login-input mt-2.5 block h-[48px] w-full rounded-[15px] border bg-transparent px-5 font-['DM_Sans'] text-[15px] font-semibold outline-none transition"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Ulangi kata sandi baru"
                            >
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button
                            type="submit"
                            class="login-button mt-5 flex min-h-[48px] w-full items-center justify-center rounded-[15px] px-4 text-center font-['DM_Sans'] text-lg font-bold leading-tight transition"
                        >
                            Simpan Kata Sandi Baru
                        </button>
                    </form>

                    <p class="login-register mt-6 text-center font-['DM_Sans'] text-sm font-semibold">
                        Ingat kata sandi?
                        <a class="login-link rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2" href="{{ route('login') }}">
                            Kembali ke login
                        </a>
                    </p>
                </section>
            </div>
        </div>
    </main>
</x-guest-layout>
