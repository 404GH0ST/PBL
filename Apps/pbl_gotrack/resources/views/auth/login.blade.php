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
            <div class="login-panel w-full max-w-[525px] px-8 py-10 sm:px-11 sm:py-12">
                <a href="/" class="mx-auto flex w-fit items-center gap-2.5" aria-label="Kembali ke beranda Deenhag">
                    <span class="login-logo-mark block h-10 w-10 rounded-full" aria-hidden="true"></span>
                    <span class="font-['DM_Sans'] text-xl font-extrabold tracking-normal">
                        DEENHAG
                    </span>
                </a>

                <div class="mt-6 text-center">
                    <h1 class="font-['Plus_Jakarta_Sans'] text-[25px] font-semibold leading-tight">
                        Selamat Datang di Deenhag
                    </h1>
                    <p class="login-helper mx-auto mt-3 max-w-[410px] font-['DM_Sans'] text-[15px] font-semibold leading-snug">
                        Masukkan email dan kata sandi Anda di bawah ini untuk masuk.
                    </p>
                </div>

                <x-auth-session-status class="login-status mt-6 rounded-[15px] px-4 py-3 text-center font-['DM_Sans'] text-sm font-semibold" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="mx-auto mt-7 max-w-[410px]">
                    @csrf

                    <div>
                        <label for="email" class="block font-['DM_Sans'] text-xl font-semibold leading-none">
                            Email
                        </label>
                        <input
                            id="email"
                            class="login-input mt-2.5 block h-[46px] w-full rounded-[15px] border bg-transparent px-5 font-['DM_Sans'] text-[15px] font-semibold outline-none transition"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Masukkan Email Anda"
                        >
                        <x-input-error :messages="$errors->get('email')" class="mt-2 font-['DM_Sans'] text-sm font-semibold" />
                    </div>

                    <div class="mt-5">
                        <label for="password" class="block font-['DM_Sans'] text-xl font-semibold leading-none">
                            Kata Sandi
                        </label>
                        <input
                            id="password"
                            class="login-input mt-2.5 block h-[46px] w-full rounded-[15px] border bg-transparent px-5 font-['DM_Sans'] text-[15px] font-semibold outline-none transition"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan Kata Sandi Anda"
                        >
                        <x-input-error :messages="$errors->get('password')" class="mt-2 font-['DM_Sans'] text-sm font-semibold" />
                    </div>

                    <div class="mt-4 flex flex-wrap items-center justify-between gap-3 font-['DM_Sans'] text-sm font-semibold">
                        <label for="remember_me" class="inline-flex cursor-pointer items-center gap-2">
                            <input
                                id="remember_me"
                                type="checkbox"
                                class="login-checkbox h-4 w-4 rounded border"
                                name="remember"
                            >
                            <span>Ingat Saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="login-link rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2" href="{{ route('password.request') }}">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>

                    <button
                        type="submit"
                        class="login-button mt-5 flex h-[47px] w-full items-center justify-center rounded-[15px] font-['DM_Sans'] text-xl font-bold transition"
                    >
                        Login
                    </button>

                </form>
            </div>
        </section>
    </main>
</x-guest-layout>
