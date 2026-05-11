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

            <x-site-navbar active="catalog" variant="dark" />

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

        <x-site-footer />
    </div>

<x-scroll-top />
</body>
</html>
