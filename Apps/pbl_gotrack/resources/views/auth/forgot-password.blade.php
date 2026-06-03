<x-guest-layout>
    <main
        x-data="themePage"
        x-bind:data-theme="theme"
        class="login-page relative min-h-screen overflow-hidden px-5 py-8 text-black transition-colors duration-300"
    >
        <div class="login-orb login-orb--top" aria-hidden="true"></div>
        <div class="login-orb login-orb--bottom" aria-hidden="true"></div>
        <div class="login-glow" aria-hidden="true"></div>

        <div class="absolute right-5 top-5 z-20">
            <x-theme-switch mode="mobile" />
        </div>

        <section class="relative z-10 flex min-h-[calc(100vh-4rem)] items-center justify-center">
            <div class="login-panel forgot-panel grid w-full max-w-[760px] overflow-hidden rounded-[28px] sm:grid-cols-[0.9fr_1.1fr]">
                <aside class="forgot-brief flex min-h-[250px] flex-col justify-between px-8 py-8 sm:px-9 sm:py-10">
                    <a href="/" class="flex w-fit items-center gap-2.5" aria-label="Kembali ke beranda Deenhag">
                        <span class="forgot-logo-mark block h-10 w-10 rounded-full" aria-hidden="true"></span>
                        <span class="font-['DM_Sans'] text-xl font-extrabold tracking-normal">
                            DEENHAG
                        </span>
                    </a>

                    <div class="mt-12">
                        <p class="font-['DM_Sans'] text-xs font-bold uppercase tracking-[0.2em]">
                            Pemulihan Admin
                        </p>
                        <h1 class="mt-4 font-['Plus_Jakarta_Sans'] text-[30px] font-semibold leading-tight sm:text-[34px]">
                            Pulihkan akses akun dengan aman.
                        </h1>
                    </div>
                </aside>

                <section class="px-8 py-9 sm:px-10 sm:py-11">
                    <div>
                        <p class="forgot-eyebrow font-['DM_Sans'] text-xs font-bold uppercase tracking-[0.18em]">
                            Lupa Kata Sandi
                        </p>
                        <h2 class="mt-3 font-['Plus_Jakarta_Sans'] text-[25px] font-semibold leading-tight">
                            Kirim tautan reset
                        </h2>
                        <p class="login-helper mt-3 max-w-[410px] font-['DM_Sans'] text-[15px] font-semibold leading-snug">
                            Masukkan email admin yang terdaftar. Sistem akan mengirimkan tautan untuk membuat kata sandi baru.
                        </p>
                    </div>

                    <x-auth-session-status class="login-status mt-6 rounded-[15px] px-4 py-3 font-['DM_Sans'] text-sm font-semibold" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}" class="mt-7">
                        @csrf

                        <div>
                            <label for="email" class="block font-['DM_Sans'] text-lg font-semibold leading-none">
                                Email Admin
                            </label>
                            <input
                                id="email"
                                class="login-input mt-2.5 block h-[48px] w-full rounded-[15px] border bg-transparent px-5 font-['DM_Sans'] text-[15px] font-semibold outline-none transition"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="admin@email.com"
                            >
                            <x-input-error :messages="$errors->get('email')" class="mt-2 font-['DM_Sans'] text-sm font-semibold" />
                        </div>

                        <button
                            type="submit"
                            class="login-button mt-5 flex min-h-[48px] w-full items-center justify-center rounded-[15px] px-4 text-center font-['DM_Sans'] text-lg font-bold leading-tight transition"
                        >
                            Kirim Tautan Reset
                        </button>

                        <div class="mt-5 flex items-center justify-center font-['DM_Sans'] text-sm font-semibold">
                            <a class="login-link rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2" href="{{ route('login') }}">
                                Kembali ke Login
                            </a>
                        </div>
                    </form>
                </section>
            </div>
        </section>
    </main>
</x-guest-layout>
