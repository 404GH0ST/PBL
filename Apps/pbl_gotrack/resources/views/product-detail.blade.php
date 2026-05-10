<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Deenhag</title>

    @vite(['resources/css/app.css', 'resources/css/product-detail.css', 'resources/js/app.js'])

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >
</head>

<body>
@php
    $descriptionParagraphs = collect(preg_split('/\r\n|\r|\n/', trim((string) $product->description)))
        ->filter()
        ->values();

    if ($descriptionParagraphs->isEmpty()) {
        $descriptionParagraphs = collect([
            'Produk ini tersedia untuk pemesanan sesuai kebutuhan kategori dan opsi yang tersedia di Deenhag.',
        ]);
    }
@endphp

<div
    x-data="productDetailPage({{ \Illuminate\Support\Js::from($productDetailState) }})"
    x-bind:data-theme="theme"
    class="pd-shell"
>

{{-- ===== HEADER ===== --}}
<header class="relative z-20 px-5 pt-5 md:px-8 md:pt-7 lg:px-14 lg:pt-10">
    <div class="mx-auto flex max-w-[1280px] items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Beranda">
            <span class="block h-10 w-10 rounded-full bg-[#e3e3e3] lg:h-12 lg:w-12"></span>
            <span class="text-sm font-extrabold tracking-[0.08em] lg:text-base">DEENHAG</span>
        </a>

        <nav class="hidden items-center rounded-full bg-black/10 px-3 py-2 text-[1.02rem] font-semibold text-black/40 lg:fixed lg:left-1/2 lg:top-8 lg:z-50 lg:flex lg:-translate-x-1/2">
            <a href="{{ route('home') }}" class="rounded-full px-4 py-1.5 transition-colors hover:bg-black/8 hover:text-black">Beranda</a>
            <a href="{{ route('catalog') }}" class="rounded-full px-4 py-1.5 text-black">Katalog</a>
            <a href="#" class="rounded-full px-4 py-1.5 transition-colors hover:bg-black/8 hover:text-black">Blog</a>
            <a href="{{ route('tracking.index') }}" class="rounded-full px-4 py-1.5 transition-colors hover:bg-black/8 hover:text-black">Lacak</a>
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

    {{-- Mobile nav --}}
    <div class="mx-auto mt-4 flex max-w-[1280px] items-center gap-3 lg:hidden">
        <nav class="flex min-w-0 flex-1 gap-2 overflow-x-auto rounded-[1.25rem] bg-black/8 p-2 text-sm font-semibold text-black/60">
            <a href="{{ route('home') }}" class="whitespace-nowrap rounded-full px-4 py-2">Beranda</a>
            <a href="{{ route('catalog') }}" class="whitespace-nowrap rounded-full bg-black/10 px-4 py-2 text-black">Katalog</a>
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

<main>
    {{-- ===== PRODUCT SECTION ===== --}}
    <section class="pd-container pd-product-section">
        {{-- Gallery --}}
        <div class="pd-gallery">
            <div class="pd-main-img-wrap">
                <img
                    class="pd-main-img"
                    :src="activeImage"
                    alt="{{ $product->name }}"
                >
            </div>

            <div class="pd-thumbs">
                <template x-for="(image, idx) in gallery" :key="image">
                    <button
                        type="button"
                        class="pd-thumb-btn"
                        :class="{ 'pd-thumb-btn--active': activeImage === image }"
                        @click="setActiveImage(image)"
                        :aria-label="`Lihat gambar ${idx + 1}`"
                    >
                        <img :src="image" :alt="`Thumbnail ${idx + 1}`">
                    </button>
                </template>
            </div>
        </div>

        {{-- Product Info --}}
        <div class="pd-info">
            <p class="pd-category">{{ $product->category?->name }}</p>

            <h1 class="pd-title">{{ $product->name }}</h1>

            {{-- Rating --}}
            <div class="pd-rating-row">
                <div class="pd-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="{{ $i <= round($productAverageRating) ? 'pd-star--filled' : 'pd-star--empty' }}">★</span>
                    @endfor
                </div>
                <span class="pd-rating-text">{{ $productAverageRating }} &nbsp; ({{ $productReviewCountLabel }} Reviews)</span>
            </div>

            {{-- Price --}}
            <div class="pd-price">
                <span class="pd-price-new">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            </div>

            {{-- Description --}}
            <p class="pd-desc">{{ $descriptionParagraphs->first() }}</p>

            {{-- Options --}}
            @foreach ($productOptions as $type => $options)
                <p class="pd-option-label">{{ $type }}</p>
                <div class="pd-option-list">
                    @foreach ($options as $option)
                        <button type="button" class="pd-option-btn">{{ $option['name'] }}</button>
                    @endforeach
                </div>
            @endforeach

            {{-- Quantity + Buy --}}
            <div class="pd-buy-row">
                <div class="pd-qty">
                    <button class="pd-qty-btn" type="button" @click="decrementQuantity()">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                    <span class="pd-qty-val" x-text="quantity">1</span>
                    <button class="pd-qty-btn" type="button" @click="incrementQuantity()">+</button>
                </div>

                <button class="pd-btn-buy" type="button">Beli Sekarang</button>
            </div>

            {{-- Meta --}}
            <div class="pd-meta">
                <div class="pd-meta-row">
                    <span class="pd-meta-key">SKU:</span>
                    <span class="pd-meta-val">{{ $product->sku ?? 'FH27634571267253G' }}</span>
                </div>
                <div class="pd-meta-row">
                    <span class="pd-meta-key">Tags:</span>
                    <span class="pd-meta-val">{{ $product->category?->name }}</span>
                </div>
                <div class="pd-meta-row">
                    <span class="pd-meta-key">Share:</span>
                    <span class="pd-meta-val pd-share">
                        <a href="#" class="pd-share-icon" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="pd-share-icon" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="pd-share-icon" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#" class="pd-share-icon" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== TABS SECTION ===== --}}
    <section class="pd-container pd-tabs-section">
        <div class="pd-tabs">
            <button
                type="button"
                class="pd-tab-btn"
                :class="{ 'pd-tab-btn--active': activeTab === 'deskripsi' }"
                @click="setTab('deskripsi')"
            >Deskripsi</button>
            <button
                type="button"
                class="pd-tab-btn"
                :class="{ 'pd-tab-btn--active': activeTab === 'informasi' }"
                @click="setTab('informasi')"
            >Informasi Tambahan</button>
            <button
                type="button"
                class="pd-tab-btn"
                :class="{ 'pd-tab-btn--active': activeTab === 'reviews' }"
                @click="setTab('reviews')"
            >Reviews</button>
        </div>

        {{-- Deskripsi Tab --}}
        <div class="pd-tab-pane" :class="{ 'pd-tab-pane--active': activeTab === 'deskripsi' }">
            @foreach ($descriptionParagraphs as $paragraph)
                <p>{{ $paragraph }}</p>
                @if (!$loop->last) <br> @endif
            @endforeach
        </div>

        {{-- Informasi Tambahan Tab --}}
        <div class="pd-tab-pane" :class="{ 'pd-tab-pane--active': activeTab === 'informasi' }">
            <div class="pd-info-table">
                <div class="pd-info-head">
                    <div>Atribut</div>
                    <div>Detail</div>
                </div>
                @foreach ($productOptions as $type => $options)
                    <div class="pd-info-row">
                        <div>{{ $type }}</div>
                        <div>{{ collect($options)->pluck('name')->join(', ') }}</div>
                    </div>
                @endforeach
                @if (empty($productOptions))
                    <div class="pd-info-row">
                        <div>Kategori</div>
                        <div>{{ $product->category?->name ?? '-' }}</div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Reviews Tab --}}
        <div class="pd-tab-pane" :class="{ 'pd-tab-pane--active': activeTab === 'reviews' }">
            <div class="pd-reviews-wrap">
                {{-- Overview --}}
                <div class="pd-review-overview">
                    <div class="pd-review-score">
                        <div class="pd-score-big">
                            <span class="pd-score-num">{{ $productAverageRating }}</span>
                            <span class="pd-score-sub">Dari 5</span>
                        </div>
                        <div class="pd-score-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= round($productAverageRating) ? 'pd-star--filled' : 'pd-star--empty' }}">★</span>
                            @endfor
                        </div>
                        <p class="pd-score-count">({{ $productReviewCountLabel }} Reviews)</p>
                    </div>

                    <div class="pd-rating-bars">
                        @foreach ($productDetailState['breakdown'] as $row)
                            <div class="pd-bar-row">
                                <span>{{ $row['rating'] }} Bintang</span>
                                <div class="pd-bar-track">
                                    <div class="pd-bar-fill" style="--pct: {{ $row['percent'] }}%;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Review list header --}}
                <div class="pd-review-list-hdr">
                    <div>
                        <h3>Review List</h3>
                        <p x-text="reviewSummary()"></p>
                    </div>
                    <label class="pd-sort-label">
                        Urutkan berdasarkan:
                        <select x-model="sortOption" class="pd-sort-select">
                            <option value="latest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="highest">Rating tertinggi</option>
                        </select>
                    </label>
                </div>

                {{-- Review items --}}
                <div class="pd-review-list">
                    <template x-for="(review, idx) in visibleReviews()" :key="idx">
                        <article class="pd-review-item">
                            <div class="pd-review-top">
                                <div class="pd-reviewer">
                                    <img :src="review.avatar" :alt="review.author" class="pd-reviewer-avatar">
                                    <strong x-text="review.author"></strong>
                                </div>
                                <span class="pd-review-date" x-text="review.date"></span>
                            </div>
                            <h4 class="pd-review-title" x-text="review.title"></h4>
                            <p class="pd-review-comment" x-text="review.comment"></p>
                            <div class="pd-review-rating">
                                <span x-text="starLabel(review.rating)"></span>
                                <small x-text="review.rating + '.0'"></small>
                            </div>
                        </article>
                    </template>

                    <template x-if="reviews.length === 0">
                        <p class="pd-no-reviews">Belum ada ulasan untuk produk ini.</p>
                    </template>
                </div>

                {{-- Toggle more reviews --}}
                <template x-if="reviews.length > 3">
                    <button
                        type="button"
                        class="pd-review-toggle"
                        :class="{ 'pd-review-toggle--open': expandedReviews }"
                        @click="toggleExpandedReviews()"
                        aria-label="Lihat review lainnya"
                    >
                        <span class="pd-chevron"></span>
                    </button>
                </template>
            </div>
        </div>
    </section>

    {{-- ===== RECOMMENDATIONS ===== --}}
    <section class="pd-container pd-reco-section">
        <h2 class="pd-reco-title">Rekomendasi Produk</h2>

        <div class="pd-reco-grid">
            @foreach ($productRecommendations as $item)
                <article class="pd-reco-card">
                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" loading="lazy" class="pd-reco-img">

                    <div class="pd-reco-card-top">
                        <span class="pd-reco-cat">{{ $item['category_label'] }}</span>
                        <span class="pd-reco-rating">
                            <span class="pd-star--filled">★</span>
                            <span>{{ $item['rating'] }}</span>
                        </span>
                    </div>

                    <h3 class="pd-reco-name">
                        <a href="{{ $item['detail_url'] }}">{{ $item['title'] }}</a>
                    </h3>

                    <div class="pd-reco-price">
                        <span>Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</main>

{{-- ===== FOOTER ===== --}}
<footer class="pd-footer">
    <div class="pd-container">
        <div class="pd-footer-grid">
            <div class="pd-footer-about">
                <div class="pd-footer-brand">
                    <span class="pd-footer-logo"></span>
                    <span>Deenhag</span>
                </div>
                <p>
                    Kami melayani kebutuhan konveksi dan digital printing untuk personal,
                    komunitas, maupun bisnis, mulai dari apparel custom, media promosi,
                    hingga kebutuhan cetak usaha dengan kualitas yang rapi dan terpercaya.
                </p>
                <div class="pd-footer-social">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>

            <div>
                <h4>Navigasi Cepat</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('catalog') }}">Katalog</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="{{ route('tracking.index') }}">Lacak Pesanan</a></li>
                </ul>
            </div>

            <div>
                <h4>Layanan Kami</h4>
                <ul>
                    <li><a href="#">Konveksi Apparel</a></li>
                    <li><a href="#">Media Promosi</a></li>
                    <li><a href="#">Cetak DTF</a></li>
                    <li><a href="#">Kebutuhan Bisnis</a></li>
                </ul>
            </div>

            <div>
                <h4>Hubungi Kami</h4>
                <ul>
                    <li><i class="fa-brands fa-whatsapp"></i> +62 23456789123</li>
                    <li><i class="fa-regular fa-envelope"></i> deenhag@gmail.com</li>
                    <li><i class="fa-solid fa-location-dot"></i> Ponorogo, Indonesia</li>
                </ul>
            </div>
        </div>

        <div class="pd-footer-copy">
            © 2026 Deenhag. All rights reserved.
        </div>
    </div>
</footer>

</div>{{-- end pd-shell --}}
</body>
</html>
