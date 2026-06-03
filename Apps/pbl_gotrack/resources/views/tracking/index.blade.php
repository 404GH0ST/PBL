<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lacak Pesanan Deenhag</title>

    <x-theme-preload />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@700;800&family=Inter:wght@400;500;600;700&family=Montserrat:wght@600;700&family=Plus+Jakarta+Sans:wght@500;700;800&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body antialiased">
    @php
        $statusLabel = match ($order?->status) {
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => null,
        };

        $statusDateLabel = $statusMoment?->locale('id')->translatedFormat('d F Y, l');
        $canConfirm = $order?->status === 'shipped' && $order?->review === null;
        $addressText = filled($order?->shipping_address) ? $order->shipping_address : 'Data alamat belum tersedia pada pesanan ini.';
        $customerReview = $order?->review;
    @endphp

    <div
        x-data="trackingPage({ initialModalOpen: {{ $errors->isNotEmpty() ? 'true' : 'false' }} })"
        x-init="rating = {{ (int) old('rating', 0) }}; reviewComment = @js(old('comment', ''))"
        x-bind:data-theme="theme"
        @keydown.escape.window="closeReviewModal()"
        class="tracking-shell min-h-screen"
    >
        <div class="tracking-page min-h-screen">
            <x-site-navbar active="tracking" variant="light" />

            <main class="px-6 pt-12 pb-16 md:px-10 lg:px-20 lg:pt-16">
                <div class="mx-auto max-w-[1320px] transition duration-200" :class="reviewModalOpen ? 'blur-[7.5px]' : ''">
                    @if (session('tracking_success'))
                        <div class="mx-auto mb-6 max-w-[1105px] rounded-[1rem] border border-emerald-500/25 bg-emerald-500/10 px-5 py-4 text-sm font-semibold text-emerald-700">
                            {{ session('tracking_success') }}
                        </div>
                    @endif

                    @if (!$order)
                        <section class="mx-auto max-w-[630px] pt-14 pb-24 lg:pt-20">
                            <div class="tracking-search-card rounded-[20px] px-6 py-8 shadow-[0_30px_90px_rgba(2,2,2,0.24)]">
                                <h1 class="text-center font-['Plus_Jakarta_Sans',sans-serif] text-xl font-extrabold lg:text-[20px]">
                                    Selamat Datang di Fitur Pelacakan
                                </h1>

                                <form action="{{ route('tracking.index') }}" method="GET" class="tracking-search-input-shell mt-6 flex flex-col gap-3 rounded-[10px] p-1.5 sm:flex-row">
                                    <label class="sr-only" for="tracking_id">Nomor pelacakan</label>
                                    <input
                                        id="tracking_id"
                                        name="tracking_id"
                                        value="{{ $trackingId }}"
                                        type="text"
                                        placeholder="Masukkan nomor Pelacakan Anda"
                                        class="tracking-search-input min-w-0 flex-1 rounded-[8px] border-0 bg-transparent px-4 py-2 text-[17px] font-semibold outline-none"
                                    >
                                    <button type="submit" class="rounded-[6px] bg-[#72a3bf] px-6 py-2 text-[17px] font-semibold text-white transition hover:bg-[#5f8faa]">
                                        Lacak
                                    </button>
                                </form>

                                @if ($trackingNotFound)
                                    <p class="mt-4 text-center text-sm font-medium text-red-300">
                                        Nomor pelacakan tidak ditemukan. Periksa kembali lalu coba lagi.
                                    </p>
                                @endif
                            </div>
                        </section>
                    @else
                        <section class="mx-auto max-w-[1105px] pb-24 lg:pb-28">
                            <div class="tracking-panel rounded-[20px] px-6 py-7 shadow-[0_38px_110px_rgba(2,2,2,0.28)] md:px-10 lg:px-[45px] lg:py-[38px]">
                                <div class="grid gap-8 lg:grid-cols-[280px_minmax(0,1fr)] lg:gap-[45px]">
                                    <div class="border-b tracking-divider pb-6 lg:border-b-0 lg:border-r lg:pr-[45px] lg:pb-0">
                                        <div class="border-b tracking-divider pb-6">
                                            <h2 class="font-['DM_Sans',sans-serif] text-[25px] font-extrabold">Rincian Pesanan</h2>
                                        </div>

                                        <div class="space-y-9 pt-6">
                                            <div class="space-y-3">
                                                <p class="font-['Inter',sans-serif] text-[15px] font-bold">Nama Pelanggan</p>
                                                <p class="tracking-card-muted font-['Plus_Jakarta_Sans',sans-serif] text-[17px] font-bold">{{ $order->customer_name }}</p>
                                            </div>

                                            <div class="space-y-3">
                                                <p class="font-['Inter',sans-serif] text-[15px] font-bold">Kontak Pelanggan</p>
                                                <p class="tracking-card-muted font-['Plus_Jakarta_Sans',sans-serif] text-[17px] font-bold">{{ $order->customer_whatsapp }}</p>
                                            </div>

                                            <div class="space-y-3">
                                                <p class="font-['Inter',sans-serif] text-[15px] font-bold">Alamat Pengiriman</p>
                                                <p class="tracking-card-muted font-['Plus_Jakarta_Sans',sans-serif] max-w-[280px] text-[17px] leading-[1.45] font-bold">
                                                    {{ $addressText }}
                                                </p>
                                            </div>
                                        </div>

                                        @if ($canConfirm)
                                            <div class="mt-12 border-t tracking-divider pt-5 text-center">
                                                <p class="font-['Inter',sans-serif] text-[15px] font-semibold">Konfirmasi penerimaan pesanan!</p>
                                                <button
                                                    type="button"
                                                    @click="openReviewModal()"
                                                    class="tracking-confirm-button mt-4 rounded-[10px] px-4 py-1.5 text-[15px] font-semibold transition hover:opacity-90"
                                                >
                                                    Konfirmasi
                                                </button>
                                            </div>
                                        @endif

                                        @if ($customerReview)
                                            <div class="mt-12 border-t tracking-divider pt-5">
                                                <p class="font-['Inter',sans-serif] text-[15px] font-bold">Ulasan Anda</p>
                                                <div class="tracking-review-card mt-4 rounded-[14px] border px-4 py-4">
                                                    <div class="flex items-center justify-between gap-3">
                                                        <div class="flex items-center gap-1" aria-label="Rating {{ $customerReview->product_rating }} dari 5">
                                                            @for ($star = 1; $star <= 5; $star++)
                                                                <span class="{{ $star <= (int) $customerReview->product_rating ? 'text-[#f59e0b]' : 'tracking-review-star-muted' }} text-[18px] leading-none">★</span>
                                                            @endfor
                                                        </div>
                                                        <p class="tracking-card-muted text-right font-['Plus_Jakarta_Sans',sans-serif] text-[11px] font-bold">
                                                            {{ $customerReview->created_at?->locale('id')->translatedFormat('d F Y') }}
                                                        </p>
                                                    </div>

                                                    @if (filled($customerReview->comment))
                                                        <p class="mt-3 font-['Plus_Jakarta_Sans',sans-serif] text-[14px] font-bold leading-relaxed">
                                                            “{{ $customerReview->comment }}”
                                                        </p>
                                                    @else
                                                        <p class="tracking-card-muted mt-3 font-['Plus_Jakarta_Sans',sans-serif] text-[14px] font-bold leading-relaxed">
                                                            Pelanggan memberikan rating tanpa komentar.
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div>
                                        <div class="flex flex-col gap-6 border-b tracking-divider pb-6 md:flex-row md:items-start md:justify-between">
                                            <div>
                                                <p class="tracking-card-muted font-['Plus_Jakarta_Sans',sans-serif] text-[17px] font-semibold">No Pelacakan:</p>
                                                <p class="mt-2 font-['Plus_Jakarta_Sans',sans-serif] text-[20px] font-extrabold">#{{ $order->tracking_id }}</p>
                                            </div>

                                            <p class="font-['DM_Sans',sans-serif] text-[25px] font-extrabold">DEENHAG</p>
                                        </div>

                                        <div class="border-b tracking-divider py-10">
                                            <p class="tracking-card-muted font-['Plus_Jakarta_Sans',sans-serif] text-[17px] font-bold">Pesanan Anda</p>
                                            <p class="mt-3 font-['Plus_Jakarta_Sans',sans-serif] text-[35px] leading-none font-extrabold">{{ $statusLabel }}</p>
                                            @if ($statusDateLabel)
                                                <p class="mt-3 font-['Plus_Jakarta_Sans',sans-serif] text-[17px] font-bold">
                                                    pada tanggal {{ $statusDateLabel }}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="pt-5">
                                            <p class="tracking-card-muted font-['Plus_Jakarta_Sans',sans-serif] text-[17px] font-bold">Riwayat Pelacakan</p>

                                            <div class="mt-8 space-y-6">
                                                @forelse ($trackingItems as $item)
                                                    <div class="grid gap-4 sm:grid-cols-[150px_24px_minmax(0,1fr)] sm:items-start sm:gap-5">
                                                        <div class="font-['Plus_Jakarta_Sans',sans-serif]">
                                                            <p class="text-[17px] font-bold">
                                                                {{ $item['occurred_at']?->locale('id')->translatedFormat('d F Y') }}
                                                            </p>
                                                            <p class="tracking-card-muted mt-1 text-[15px] font-bold">
                                                                pukul {{ $item['occurred_at']?->format('H:i') }}
                                                            </p>
                                                        </div>

                                                        <div class="relative hidden min-h-[24px] justify-center sm:flex">
                                                            <span class="relative z-10 block h-[24px] w-[24px]">
                                                                <span class="tracking-timeline-ring absolute left-1/2 top-1/2 block h-[14px] w-[14px] -translate-x-1/2 -translate-y-1/2 rounded-full border"></span>
                                                            </span>
                                                            @if ($item['is_current'])
                                                                <span class="absolute left-1/2 top-1/2 z-20 h-[10px] w-[10px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#16a34a] shadow-[0_0_0_3px_rgba(22,163,74,0.16)]"></span>
                                                            @endif
                                                            @if (!$loop->last)
                                                                <span class="tracking-timeline-line absolute left-1/2 top-[24px] h-[calc(100%+16px)] w-px -translate-x-1/2"></span>
                                                            @endif
                                                        </div>

                                                        <div class="pt-0.5">
                                                            <div class="flex items-start gap-3 sm:hidden">
                                                                <span class="relative block h-[24px] w-[24px] shrink-0">
                                                                    <span class="tracking-timeline-ring absolute left-1/2 top-1/2 block h-[14px] w-[14px] -translate-x-1/2 -translate-y-1/2 rounded-full border"></span>
                                                                    @if ($item['is_current'])
                                                                        <span class="absolute left-1/2 top-1/2 h-[10px] w-[10px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#16a34a] shadow-[0_0_0_3px_rgba(22,163,74,0.16)]"></span>
                                                                    @endif
                                                                </span>
                                                                <p class="font-['Plus_Jakarta_Sans',sans-serif] text-[17px] font-bold">{{ $item['title'] }}</p>
                                                            </div>
                                                            <p class="hidden font-['Plus_Jakarta_Sans',sans-serif] text-[17px] font-bold sm:block">{{ $item['title'] }}</p>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p class="tracking-card-muted font-['Plus_Jakarta_Sans',sans-serif] text-[15px] font-bold">
                                                        Belum ada pembaruan pelacakan untuk pesanan ini.
                                                    </p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                </div>
            </main>

            <x-site-footer class="mt-8" />
        </div>

        @if ($canConfirm)
            <div
                x-cloak
                x-show="reviewModalOpen"
                x-transition.opacity.duration.200ms
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 px-4"
            >
                <div
                    @click.outside="closeReviewModal()"
                    class="tracking-modal w-full max-w-[335px] rounded-[20px] border shadow-[0_30px_90px_rgba(0,0,0,0.2)]"
                >
                    <div class="flex items-start justify-between gap-3 border-b tracking-divider-soft px-[18px] pt-[11px] pb-3">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-[25px] w-[25px] shrink-0 items-center justify-center rounded-full border border-white/35">
                                <svg viewBox="0 0 24 24" aria-hidden="true" class="h-[13px] w-[13px] tracking-modal-text">
                                    <path d="M12 2.75l2.04 5.21 5.59.39-4.3 3.58 1.41 5.42L12 14.2l-4.74 3.15 1.41-5.42-4.3-3.58 5.59-.39L12 2.75z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="1.8" />
                                </svg>
                            </span>
                            <div>
                                <p class="tracking-modal-text font-['Plus_Jakarta_Sans',sans-serif] text-[15px] font-bold">Nilai Produk Ini</p>
                                <p class="tracking-modal-muted font-['Plus_Jakarta_Sans',sans-serif] text-[10px] font-semibold">Berikan kami masukan untuk produk ini</p>
                            </div>
                        </div>
                        <button type="button" @click="closeReviewModal()" class="tracking-modal-text text-[10px] font-bold">X</button>
                    </div>

                    <form action="{{ route('tracking.review', $order->tracking_id) }}" method="POST" class="px-[18px] pt-3 pb-4">
                        @csrf

                        <div class="mb-4">
                            <label for="customer_name" class="tracking-modal-text font-['Plus_Jakarta_Sans',sans-serif] text-[15px] font-bold">Nama Anda</label>
                            <input
                                id="customer_name"
                                name="customer_name"
                                type="text"
                                value="{{ old('customer_name', $order->customer_name) }}"
                                required
                                class="tracking-modal-input mt-2 h-[38px] w-full rounded-[8px] border px-3 py-2 text-[10px] font-bold outline-none"
                                placeholder="Masukkan nama Anda"
                            >
                            @error('customer_name')
                                <p class="mt-2 text-[11px] font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="customer_whatsapp" class="tracking-modal-text font-['Plus_Jakarta_Sans',sans-serif] text-[15px] font-bold">Nomor WhatsApp</label>
                            <input
                                id="customer_whatsapp"
                                name="customer_whatsapp"
                                type="text"
                                value="{{ old('customer_whatsapp', $order->customer_whatsapp) }}"
                                required
                                class="tracking-modal-input mt-2 h-[38px] w-full rounded-[8px] border px-3 py-2 text-[10px] font-bold outline-none"
                                placeholder="Masukkan nomor WhatsApp"
                            >
                            @error('customer_whatsapp')
                                <p class="mt-2 text-[11px] font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <p class="tracking-modal-text font-['Plus_Jakarta_Sans',sans-serif] text-[15px] font-bold">Peringkat Anda</p>
                            <input type="hidden" name="rating" :value="rating">

                            <div class="mt-3 flex items-center gap-[12.5px]">
                                <template x-for="star in 5" :key="star">
                                    <button
                                        type="button"
                                        @click="setRating(star)"
                                        class="tracking-rating-idle flex h-[31px] w-[31px] items-center justify-center rounded-[8px] border text-[21px] leading-none transition"
                                        :class="rating >= star ? 'tracking-rating-active' : 'tracking-rating-idle'"
                                        aria-label="Beri bintang"
                                    >
                                        ★
                                    </button>
                                </template>
                            </div>
                            @error('rating')
                                <p class="mt-2 text-[11px] font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-5 border-t tracking-divider-soft pt-4">
                            <label for="comment" class="tracking-modal-text font-['Plus_Jakarta_Sans',sans-serif] text-[15px] font-bold">Ulasan Produk</label>
                            <textarea
                                id="comment"
                                name="comment"
                                x-model="reviewComment"
                                rows="4"
                                placeholder="Tulis ulasan Anda di sini..."
                                class="tracking-modal-input mt-2 h-[52px] w-full resize-none rounded-[8px] border px-3 py-2 text-[10px] font-bold outline-none"
                            ></textarea>
                            @error('comment')
                                <p class="mt-2 text-[11px] font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-5 border-t tracking-divider-soft pt-4">
                            <div class="grid grid-cols-2 gap-[15px]">
                                <button type="button" @click="closeReviewModal()" class="tracking-modal-button-secondary rounded-[5px] border py-1.5 text-[10px] font-bold">
                                    Batalkan
                                </button>
                                <button
                                    type="submit"
                                    class="tracking-modal-button-primary rounded-[5px] py-1.5 text-[10px] font-bold disabled:cursor-not-allowed disabled:opacity-40"
                                    :disabled="rating === 0"
                                >
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

<x-scroll-top />
</body>
</html>
