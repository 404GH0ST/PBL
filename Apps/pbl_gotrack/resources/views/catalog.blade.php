<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Deenhag</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@700;800&family=Inter:wght@400;500;600;700&family=Montserrat:wght@600;700&family=Plus+Jakarta+Sans:wght@500;700;800&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body antialiased">
    <div
        x-data="catalogPage({{ \Illuminate\Support\Js::from($catalogProducts) }}, {{ \Illuminate\Support\Js::from($catalogFilters) }})"
        x-bind:data-theme="theme"
        class="catalog-shell min-h-screen"
    >
        <section class="relative isolate overflow-hidden bg-[#071019]">
            <div aria-hidden="true" class="absolute inset-0">
                <img src="{{ asset('images/catalog/hero-workshop.png') }}" alt="" class="h-full w-full object-cover opacity-35">
                <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(3,8,13,0.76)_0%,rgba(5,11,18,0.68)_44%,rgba(7,16,25,0.94)_100%)]"></div>
            </div>

            <header class="relative z-20 px-5 pt-5 md:px-8 md:pt-7 lg:px-14 lg:pt-10">
                <div class="mx-auto flex max-w-[1280px] items-center justify-between gap-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 text-white" aria-label="Beranda">
                        <span class="block h-10 w-10 rounded-full bg-white/90 lg:h-12 lg:w-12"></span>
                        <span class="font-['DM_Sans',sans-serif] text-sm font-bold tracking-[0.08em] lg:text-base">DEENHAG</span>
                    </a>

                    <nav class="hidden items-center rounded-full bg-white/12 px-3 py-2 text-[1.02rem] font-semibold text-white/35 lg:fixed lg:left-1/2 lg:top-8 lg:z-50 lg:flex lg:-translate-x-1/2">
                        <a href="{{ route('home') }}" class="rounded-full px-4 py-1.5 transition-colors hover:bg-white/8 hover:text-white">Beranda</a>
                        <a href="{{ route('catalog') }}" class="rounded-full px-4 py-1.5 text-white">Katalog</a>
                        <a href="#" class="rounded-full px-4 py-1.5 transition-colors hover:bg-white/8 hover:text-white">Blog</a>
                        <a href="{{ route('tracking.index') }}" class="rounded-full px-4 py-1.5 transition-colors hover:bg-white/8 hover:text-white">Lacak</a>
                    </nav>

                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            @click="toggleTheme()"
                            :aria-pressed="(theme === 'dark').toString()"
                            :aria-label="theme === 'dark' ? 'Aktifkan light mode' : 'Aktifkan dark mode'"
                            :data-state="theme"
                            class="catalog-theme-switch relative hidden shrink-0 lg:inline-flex"
                        >
                            <span class="catalog-theme-thumb" aria-hidden="true"></span>
                            <span class="catalog-theme-icon catalog-theme-icon--sun absolute left-[0.625rem] top-[0.625rem]">
                                <svg viewBox="0 0 20 20" class="h-5 w-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" aria-hidden="true">
                                    <circle cx="10" cy="10" r="3.2"></circle>
                                    <path d="M10 1.9v1.8M10 16.3v1.8M18.1 10h-1.8M3.7 10H1.9M15.73 4.27 14.45 5.55M5.55 14.45l-1.28 1.28M15.73 15.73l-1.28-1.28M5.55 5.55 4.27 4.27"></path>
                                </svg>
                            </span>
                            <span class="catalog-theme-icon catalog-theme-icon--moon absolute left-[3.5rem] top-[0.625rem]">
                                <svg viewBox="0 0 20 20" class="h-5 w-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" aria-hidden="true">
                                    <path d="M12.4 2.35a6.75 6.75 0 1 0 5.25 9.9A6.95 6.95 0 0 1 12.4 2.35Z"></path>
                                </svg>
                            </span>
                        </button>

                    </div>
                </div>

                <div class="mx-auto mt-6 flex max-w-[1280px] items-center gap-3 lg:hidden">
                    <nav class="flex min-w-0 flex-1 gap-2 overflow-x-auto rounded-[1.25rem] bg-white/10 p-2 text-sm font-semibold text-white/80 backdrop-blur-xl">
                    <a href="{{ route('home') }}" class="whitespace-nowrap rounded-full px-4 py-2">Beranda</a>
                    <a href="{{ route('catalog') }}" class="whitespace-nowrap rounded-full bg-white/14 px-4 py-2 text-white">Katalog</a>
                    <a href="#" class="whitespace-nowrap rounded-full px-4 py-2">Blog</a>
                    <a href="{{ route('tracking.index') }}" class="whitespace-nowrap rounded-full px-4 py-2">Lacak</a>
                    </nav>
                    <button
                        type="button"
                        @click="toggleTheme()"
                        :aria-pressed="(theme === 'dark').toString()"
                        :aria-label="theme === 'dark' ? 'Aktifkan light mode' : 'Aktifkan dark mode'"
                        :data-state="theme"
                        class="catalog-theme-switch relative shrink-0"
                    >
                        <span class="catalog-theme-thumb" aria-hidden="true"></span>
                        <span class="catalog-theme-icon catalog-theme-icon--sun absolute left-[0.625rem] top-[0.625rem]">
                            <svg viewBox="0 0 20 20" class="h-5 w-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" aria-hidden="true">
                                <circle cx="10" cy="10" r="3.2"></circle>
                                <path d="M10 1.9v1.8M10 16.3v1.8M18.1 10h-1.8M3.7 10H1.9M15.73 4.27 14.45 5.55M5.55 14.45l-1.28 1.28M15.73 15.73l-1.28-1.28M5.55 5.55 4.27 4.27"></path>
                            </svg>
                        </span>
                        <span class="catalog-theme-icon catalog-theme-icon--moon absolute left-[3.5rem] top-[0.625rem]">
                            <svg viewBox="0 0 20 20" class="h-5 w-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" aria-hidden="true">
                                <path d="M12.4 2.35a6.75 6.75 0 1 0 5.25 9.9A6.95 6.95 0 0 1 12.4 2.35Z"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </header>

            <div class="relative z-10 px-5 pt-16 pb-36 text-center md:px-8 md:pt-20 md:pb-40 lg:px-14 lg:pt-24 lg:pb-44">
                <p class="font-['DM_Sans',sans-serif] text-[5.5rem] leading-none font-extrabold tracking-[-0.08em] text-white md:text-[8rem] lg:text-[13rem]">
                    Shop
                </p>
            </div>
        </section>

        <main class="relative z-20 -mt-24 px-5 pb-0 md:px-8 lg:-mt-28 lg:px-14">
            <div class="catalog-panel mx-auto max-w-[1280px] rounded-[2rem] p-5 md:p-8 lg:p-11">
                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="catalog-text font-['Plus_Jakarta_Sans',sans-serif] text-[1.45rem] font-extrabold md:text-[1.65rem]">
                            Semua kebutuhan anda
                        </p>
                    </div>

                    <label class="catalog-surface catalog-border-strong flex w-full items-center gap-3 rounded-full border px-4 py-3 lg:w-[28.5rem]">
                        <svg viewBox="0 0 24 24" class="catalog-text-soft h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <circle cx="11" cy="11" r="6.5"></circle>
                            <path d="m16 16 4 4"></path>
                        </svg>
                        <input
                            x-model="searchTerm"
                            @input="currentPage = 1; normalizePage()"
                            type="search"
                            placeholder="Cari di Deenhag"
                            class="catalog-text min-w-0 flex-1 bg-transparent text-[0.97rem] outline-none placeholder:text-[var(--catalog-text-soft)]"
                        >
                        <button
                            x-show="searchTerm"
                            x-cloak
                            type="button"
                            @click="clearSearch()"
                            class="catalog-text-soft hidden text-xs font-semibold md:block"
                        >
                            Reset
                        </button>
                        <button type="button" class="catalog-primary-action rounded-full px-4 py-1.5 text-sm font-semibold">
                            Cari
                        </button>
                    </label>
                </div>

                <div class="mt-8 flex flex-wrap gap-2.5 lg:hidden">
                    <template x-for="filter in filters" :key="filter.slug">
                        <button
                            type="button"
                            @click="setFilter(filter.slug)"
                            class="inline-flex items-center gap-2 rounded-full border px-4 py-2 text-sm font-semibold transition"
                            :class="selectedFilter === filter.slug ? 'catalog-active-pill border-transparent' : 'catalog-surface catalog-border catalog-text-soft'"
                        >
                            <span class="h-4 w-4" x-html="filterIcon(filter.icon)"></span>
                            <span x-text="filter.label"></span>
                        </button>
                    </template>
                </div>

                <div class="mt-10 grid gap-9 lg:grid-cols-[9.75rem_minmax(0,1fr)] lg:gap-12">
                    <aside class="hidden lg:block">
                        <p class="catalog-text font-['Plus_Jakarta_Sans',sans-serif] text-lg font-extrabold">Category</p>

                        <div class="mt-5 space-y-2">
                            <template x-for="filter in filters" :key="filter.slug">
                                <button
                                    type="button"
                                    @click="setFilter(filter.slug)"
                                    class="flex w-full items-center gap-3 rounded-xl px-3 py-2 text-left transition"
                                    :class="selectedFilter === filter.slug ? 'catalog-sidebar-active' : 'catalog-text-soft catalog-hover-surface'"
                                >
                                    <span
                                        class="catalog-icon-surface flex h-7 w-7 items-center justify-center rounded-lg"
                                        :class="selectedFilter === filter.slug ? 'catalog-active-pill' : 'catalog-text-soft'"
                                        x-html="filterIcon(filter.icon)"
                                    ></span>
                                    <span class="text-[0.95rem] font-medium" x-text="filter.label"></span>
                                </button>
                            </template>
                        </div>
                    </aside>

                    <div>
                        <div class="grid gap-x-5 gap-y-8 sm:grid-cols-2 xl:grid-cols-4">
                            <template x-for="product in paginatedProducts()" :key="product.slug">
                                <article class="group flex h-full flex-col">
                                    <a :href="product.detail_url" class="catalog-card-media overflow-hidden rounded-[1rem] shadow-[var(--catalog-card-shadow)]">
                                        <img :src="product.image" :alt="product.title" class="h-[12.5rem] w-full object-cover transition duration-300 group-hover:scale-[1.03]">
                                    </a>

                                    <div class="mt-3 flex flex-1 flex-col">
                                        <a
                                            :href="product.detail_url"
                                            class="catalog-text min-h-[3rem] font-['DM_Sans',sans-serif] text-[1rem] font-bold leading-[1.2] tracking-[-0.04em] transition hover:opacity-75"
                                            x-text="product.title"
                                        ></a>

                                        <div class="mt-3 flex items-center justify-between gap-3 text-[0.72rem]">
                                            <div class="catalog-text-muted flex items-center gap-1">
                                                <span class="text-[#f0bc1f]">★</span>
                                                <span class="font-bold" x-text="reviewLabel(product)"></span>
                                            </div>
                                            <div class="catalog-text font-['Plus_Jakarta_Sans',sans-serif] font-extrabold">
                                                <span class="text-[0.66rem]">Rp</span>
                                                <span class="ml-0.5 text-[0.9rem]" x-text="formatPrice(product.price)"></span>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex items-center gap-2">
                                            <a :href="product.detail_url" class="catalog-border-strong catalog-text rounded-full border px-3 py-1.5 text-[0.62rem] font-semibold transition hover:opacity-80">
                                                Lihat Detail
                                            </a>
                                            <a :href="product.detail_url" class="catalog-primary-action rounded-full px-3 py-1.5 text-[0.62rem] font-semibold transition hover:opacity-90">
                                                Beli Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </template>
                        </div>

                        <div x-show="!hasProducts()" x-cloak class="catalog-card mt-10 rounded-[1.5rem] border catalog-border px-6 py-10 text-center">
                            <p class="catalog-text font-['DM_Sans',sans-serif] text-[1.35rem] font-bold">Produk tidak ditemukan</p>
                            <p class="catalog-text-soft mt-2 text-sm">Coba ganti kata kunci atau pilih kategori lain.</p>
                        </div>

                        <div class="catalog-border mt-10 flex flex-col gap-4 border-t pt-6 md:flex-row md:items-center md:justify-between">
                            <button
                                type="button"
                                @click="previousPage()"
                                class="catalog-text inline-flex items-center gap-2 text-sm font-medium transition disabled:cursor-not-allowed disabled:opacity-40"
                                :disabled="currentPage === 1"
                            >
                                <span aria-hidden="true">←</span>
                                Sebelumnya
                            </button>

                            <div class="flex items-center justify-center gap-2">
                                <template x-for="page in pageNumbers()" :key="page">
                                    <button
                                        type="button"
                                        @click="goToPage(page)"
                                        class="flex h-8 min-w-8 items-center justify-center rounded-full px-2 text-sm font-semibold transition"
                                        :class="currentPage === page ? 'catalog-active-pill' : 'catalog-text-soft hover:opacity-80'"
                                        x-text="page"
                                    ></button>
                                </template>
                            </div>

                            <button
                                type="button"
                                @click="nextPage()"
                                class="catalog-text inline-flex items-center gap-2 self-end text-sm font-medium transition disabled:cursor-not-allowed disabled:opacity-40 md:self-auto"
                                :disabled="currentPage === totalPages()"
                            >
                                Berikutnya
                                <span aria-hidden="true">→</span>
                            </button>
                        </div>
                    </div>
                </div>

                <section class="mt-18 pb-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="catalog-text font-['DM_Sans',sans-serif] text-[2rem] font-bold tracking-[-0.04em] md:text-[2.2rem]">
                                Jelajahi Rekomendasi Kami
                            </h2>
                        </div>

                        <div class="catalog-text hidden items-center gap-3 text-lg md:flex">
                            <span class="catalog-text-muted">←</span>
                            <span>→</span>
                        </div>
                    </div>

                    <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                        <template x-for="product in featuredProducts()" :key="`featured-${product.slug}`">
                            <article class="catalog-card-strong rounded-[1.15rem] p-3">
                                <a :href="product.detail_url" class="catalog-card-soft block overflow-hidden rounded-[1rem]">
                                    <img :src="product.image" :alt="product.title" class="h-[12rem] w-full object-cover">
                                </a>

                                <div class="mt-3">
                                    <a
                                        :href="product.detail_url"
                                        class="catalog-text font-['DM_Sans',sans-serif] text-[1rem] font-bold leading-[1.2] tracking-[-0.04em] transition hover:opacity-75"
                                        x-text="product.title"
                                    ></a>
                                    <div class="mt-3 flex items-center justify-between gap-3 text-[0.72rem]">
                                        <div class="catalog-text-muted flex items-center gap-1">
                                            <span class="text-[#f0bc1f]">★</span>
                                            <span class="font-bold" x-text="reviewLabel(product)"></span>
                                        </div>
                                        <div class="catalog-text font-['Plus_Jakarta_Sans',sans-serif] font-extrabold">
                                            <span class="text-[0.66rem]">Rp</span>
                                            <span class="ml-0.5 text-[0.9rem]" x-text="formatPrice(product.price)"></span>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex items-center gap-2">
                                        <a :href="product.detail_url" class="catalog-border-strong catalog-text rounded-full border px-3 py-1.5 text-[0.62rem] font-semibold transition hover:opacity-80">
                                            Lihat Detail
                                        </a>
                                        <a :href="product.detail_url" class="catalog-primary-action rounded-full px-3 py-1.5 text-[0.62rem] font-semibold transition hover:opacity-90">
                                            Beli Sekarang
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </template>
                    </div>
                </section>
            </div>
        </main>

        <footer class="site-footer mt-[-1rem] overflow-hidden pt-24 pb-10">
            <div class="mx-auto max-w-[1300px] px-5 md:px-8 lg:px-14">
                <div class="grid gap-14 lg:grid-cols-[1.45fr_0.8fr_0.85fr_1fr]">
                    <div class="max-w-[26rem]">
                        <div class="flex items-center gap-4">
                            <span class="block h-11 w-11 rounded-full bg-white/85"></span>
                            <span class="font-['Montserrat',sans-serif] text-[1.95rem] font-bold text-white">Deenhag</span>
                        </div>

                        <p class="mt-8 text-[0.92rem] leading-[1.7] text-white/78">
                            Kami melayani kebutuhan konveksi dan digital printing untuk personal, komunitas, maupun bisnis, mulai dari apparel custom, media promosi, hingga kebutuhan cetak usaha dengan kualitas yang rapi dan terpercaya.
                        </p>

                        <div class="mt-8 flex items-center gap-2.5">
                            <a href="#" aria-label="Facebook" class="transition hover:opacity-75">
                                <img src="{{ asset('images/footer/facebook.png') }}" alt="" class="h-9 w-9 object-contain">
                            </a>
                            <a href="#" aria-label="Twitter" class="transition hover:opacity-75">
                                <img src="{{ asset('images/footer/twitter.png') }}" alt="" class="h-9 w-9 object-contain">
                            </a>
                            <a href="#" aria-label="TikTok" class="transition hover:opacity-75">
                                <img src="{{ asset('images/footer/tiktok.png') }}" alt="" class="h-9 w-9 object-contain">
                            </a>
                            <a href="#" aria-label="Instagram" class="transition hover:opacity-75">
                                <img src="{{ asset('images/footer/instagram.png') }}" alt="" class="h-9 w-9 object-contain">
                            </a>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-['Montserrat',sans-serif] text-[1.2rem] font-bold text-[#72a3bf]">Navigasi Cepat</h3>
                        <div class="mt-8 space-y-5 text-[0.92rem] font-medium tracking-[0.04em] text-white/85">
                            <a href="{{ route('home') }}" class="block transition hover:opacity-75">Beranda</a>
                            <a href="{{ route('catalog') }}" class="block transition hover:opacity-75">Katalog</a>
                            <a href="#" class="block transition hover:opacity-75">Blog</a>
                            <a href="#" class="block transition hover:opacity-75">Keranjang</a>
                            <a href="{{ route('tracking.index') }}" class="block transition hover:opacity-75">Lacak Pesanan</a>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-['Montserrat',sans-serif] text-[1.2rem] font-bold text-[#72a3bf]">Layanan Kami</h3>
                        <div class="mt-8 space-y-5 text-[0.92rem] font-medium tracking-[0.04em] text-white/85">
                            <p>Konveksi Apparel</p>
                            <p>Media Promosi</p>
                            <p>Cetak DTF</p>
                            <p>Kebutuhan Bisnis</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-['Montserrat',sans-serif] text-[1.2rem] font-bold text-[#72a3bf]">Hubungi Kami</h3>
                        <div class="mt-8 space-y-4 text-[0.92rem] font-medium tracking-[0.04em] text-white/85">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/footer/whatsapp.png') }}" alt="" class="h-7 w-7 object-contain">
                                <span>+62 23456789123</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/footer/email.png') }}" alt="" class="h-7 w-7 object-contain">
                                <span>deenhag@gmail.com</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/footer/address.png') }}" alt="" class="h-7 w-7 object-contain">
                                <span>Ponorogo, Indonesia</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 border-t pt-6 text-center text-[0.9rem] text-[var(--site-footer-copy)]" style="border-color: var(--site-footer-border);">
                    © 2026 Deenhag. All rights reserved.
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
