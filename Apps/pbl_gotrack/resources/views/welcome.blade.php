<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Deenhag - Elevasi Identitas Apparel Anda</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@600;700;800&family=Manrope:wght@400;500;600;700&family=Montserrat:wght@600;700&family=Plus+Jakarta+Sans:wght@700&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#020607] font-body text-white antialiased">
    <div x-data="homePageMotion({{ Js::from($testimonials) }})" class="relative isolate min-h-screen">
        <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10 bg-[#020607]"></div>

        <div class="relative min-h-screen overflow-x-hidden bg-transparent">
            <div x-cloak x-show="shouldAnimateHeroJersey" style="display: none;" aria-hidden="true" class="pointer-events-none fixed z-40 hidden lg:block" :style="floatingJerseyStyle">
                <img src="{{ asset('images/hero/jersey-front.png') }}" alt="" class="h-auto w-full -scale-x-100 object-contain">
            </div>

            <x-site-navbar active="home" variant="dark" :show-theme-switch="false" />

            <main class="relative z-20 px-6 pt-10 md:px-10 md:pt-14 lg:px-20 lg:pt-24">
                <div class="mx-auto max-w-[1280px]">
                    <div class="grid items-start gap-10 lg:grid-cols-[0.9fr_1.1fr]">
                        <section class="max-w-[34rem] pt-2 lg:pt-24">
                            <h1 class="font-display text-[3.75rem] leading-[0.9] font-extrabold tracking-[-0.06em] text-white md:text-[4.9rem] lg:text-[5.4rem]">
                                <span class="block">Elevasi <span class="text-[#78a4c6]">Identitas</span></span>
                                <span class="block"><span class="text-[#78a4c6]">Apparel</span> Anda</span>
                            </h1>

                            <div class="mt-12 max-w-[27rem] space-y-1.5 text-[1.02rem] leading-[1.55] font-medium tracking-[-0.03em] text-white/78 md:text-[1.18rem] md:leading-[1.5] lg:text-[1rem]">
                                <p>Kami mendesain, kami memproduksi,</p>
                                <p>kami memberikan kualitas.</p>
                                <p>Solusi konveksi dan printing paling lengkap.</p>
                            </div>

                            <a href="{{ route('catalog') }}" class="mt-16 inline-flex items-center gap-1.5 text-[0.95rem] font-medium text-[#6b95b8] lg:mt-18">
                                Belanja Sekarang
                                <span aria-hidden="true">→</span>
                            </a>
                        </section>

                        <section class="relative min-h-[26rem] md:min-h-[33rem] lg:min-h-[39rem]">
                            <div
                                aria-hidden="true"
                                class="pointer-events-none absolute right-[-8%] top-[-4%] z-0 h-[108%] w-[95%] rounded-full bg-[radial-gradient(ellipse_at_center,rgba(20,43,56,0.94)_0%,rgba(18,38,50,0.92)_28%,rgba(13,27,35,0.86)_52%,rgba(7,15,20,0.72)_74%,rgba(4,8,10,0.3)_88%,rgba(0,0,0,0)_100%)] blur-[14px]"
                            ></div>
                            <div
                                aria-hidden="true"
                                class="pointer-events-none absolute right-[6%] top-[11%] z-0 h-[76%] w-[70%] rounded-full bg-[radial-gradient(ellipse_at_center,rgba(40,84,109,0.28)_0%,rgba(19,42,56,0.18)_46%,rgba(0,0,0,0)_100%)] blur-[10px]"
                            ></div>

                            <div class="absolute left-[21%] top-[4%] z-10 w-[40%] min-w-[10rem] max-w-[22rem] md:left-[28%] md:top-[2%] md:w-[38%] lg:left-[33%] lg:top-[4%] lg:w-[39%]">
                                <img src="{{ asset('images/hero/jersey-back-new.png') }}" alt="Jersey belakang" class="h-auto w-full -scale-x-100 object-contain opacity-[0.42]">
                            </div>

                            <div x-ref="heroJerseyStart" class="absolute right-[-2%] top-[19%] z-20 aspect-[500/659] w-[73%] min-w-[18rem] max-w-[31.25rem] md:right-[-1%] md:top-[18%] md:w-[71%] lg:right-[-2%] lg:top-[27%] lg:w-[68%]">
                                <img
                                    src="{{ asset('images/hero/jersey-front.png') }}"
                                    alt="Jersey depan"
                                    class="h-auto w-full -scale-x-100 object-contain lg:hidden"
                                >
                            </div>
                        </section>
                    </div>

                    <section class="pt-20 md:pt-24 lg:pt-30">
                        <div class="grid gap-y-10 lg:grid-cols-[27rem_25rem_21rem] lg:grid-rows-[auto_1fr] lg:gap-x-10 lg:gap-y-7">
                            <h2 class="font-display text-[3rem] leading-none font-bold tracking-[-0.05em] text-[#78a4c6] md:text-[4rem] lg:col-span-2">
                                Tentang Kami
                            </h2>

                            <div class="lg:row-start-2">
                                <p class="max-w-[28rem] text-[1.3rem] leading-[1.5] font-medium tracking-[-0.03em] text-white md:text-[1.55rem] lg:text-[1.12rem] lg:leading-[1.45]">
                                    Solusi Konveksi dan Digital Printing untuk Kebutuhan Personal, Komunitas, dan Bisnis
                                </p>

                                <div class="mt-6 overflow-hidden">
                                    <img
                                        src="{{ asset('images/about/tentang-kami.png') }}"
                                        alt="Mockup brand Deenhag"
                                        class="h-auto w-full object-cover"
                                    >
                                </div>

                                <a href="{{ route('catalog') }}" class="mt-6 inline-flex items-center gap-1.5 text-[0.95rem] font-medium text-[#6b95b8]">
                                    Belanja Sekarang
                                    <span aria-hidden="true">→</span>
                                </a>
                            </div>

                            <div class="space-y-8 text-[1.04rem] leading-[2] text-white/82 md:text-[1.12rem] lg:row-start-2 lg:pt-1 lg:text-[0.98rem] lg:leading-[2.1]">
                                <p>
                                    Deenhag hadir sebagai layanan konveksi dan digital printing yang berfokus pada kualitas, kerapian, dan hasil visual yang maksimal. Kami melayani berbagai kebutuhan seperti kaos custom, jersey, banner, cetak DTF, nota, hingga stempel untuk mendukung kebutuhan promosi, identitas brand, maupun operasional usaha.
                                </p>

                                <p>
                                    Dengan proses produksi yang detail, bahan yang berkualitas, serta pelayanan yang responsif, kami berkomitmen memberikan hasil yang tidak hanya menarik secara tampilan, tetapi juga nyaman, fungsional, dan siap digunakan sesuai kebutuhan Anda.
                                </p>
                            </div>

                            <div class="flex items-start justify-center lg:col-start-3 lg:row-span-2 lg:justify-end lg:pt-3">
                                <div class="relative mt-2 h-[26rem] w-[18rem] md:h-[34rem] md:w-[24rem] lg:h-[31rem] lg:w-[21rem]">
                                    <div class="absolute -right-[5%] top-0 h-[27%] w-[32%] rounded-[2rem] bg-[#86b4d5]"></div>
                                    <div class="absolute -left-[5%] bottom-[10%] h-[27%] w-[32%] rounded-[2rem] bg-[#86b4d5]"></div>
                                    <div class="absolute inset-[4%] z-10 rounded-[2.8rem] bg-[#8f8f8f]"></div>
                                    <div x-ref="aboutJerseyEnd" class="absolute inset-x-[10%] top-[10%] z-20 aspect-[409/610]">
                                        <img
                                            src="{{ asset('images/hero/jersey-front.png') }}"
                                            alt="Jersey showcase"
                                            class="h-auto w-full -scale-x-100 object-contain lg:hidden"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    @php
                        $serviceItems = [
                            [
                                'number' => '01',
                                'title' => 'Konveksi Apparel',
                                'subtitle' => 'Kualitas presisi',
                                'image' => 'images/product/konveksi-apparel.png',
                                'mobile_image_class' => 'w-[10.75rem] -scale-x-100',
                                'desktop_image_class' => 'w-[15rem] -scale-x-100',
                                'active_background' => 'bg-[#101218]',
                            ],
                            [
                                'number' => '02',
                                'title' => 'Media Promosi',
                                'subtitle' => 'Warna solid',
                                'image' => 'images/product/media-promosi.png',
                                'mobile_image_class' => 'w-[7.5rem]',
                                'desktop_image_class' => 'w-[10.2rem]',
                                'active_background' => 'bg-[#04111d]',
                            ],
                            [
                                'number' => '03',
                                'title' => 'Cetak DTF',
                                'subtitle' => 'Hasil tajam',
                                'image' => 'images/product/cetak-dtf.png',
                                'mobile_image_class' => 'w-[8.75rem]',
                                'desktop_image_class' => 'w-[11.3rem]',
                                'active_background' => 'bg-[#101218]',
                            ],
                            [
                                'number' => '04',
                                'title' => 'Kebutuhan Bisnis',
                                'subtitle' => 'Profesionalitas terjamin',
                                'image' => 'images/product/kebutuhan-bisnis.png',
                                'mobile_image_class' => 'w-[8.25rem]',
                                'desktop_image_class' => 'w-[11rem]',
                                'active_background' => 'bg-[#04111d]',
                            ],
                        ];
                    @endphp

                    <section class="pt-30 pb-6 md:pt-32 md:pb-8 lg:pt-36 lg:pb-10">
                        <div class="grid gap-6 md:grid-cols-2 xl:hidden">
                            @foreach ($serviceItems as $serviceItem)
                                <article class="overflow-hidden rounded-[2rem] border border-white/8 bg-[#050608] px-6 pt-6 pb-7 shadow-[0_18px_40px_rgba(0,0,0,0.24)]">
                                    <p class="font-['Montserrat',sans-serif] text-[2.7rem] leading-none font-semibold text-[#686b6c]">
                                        {{ $serviceItem['number'] }}
                                    </p>

                                    <div class="mt-8 flex h-[13rem] items-center justify-center">
                                        <img
                                            src="{{ asset($serviceItem['image']) }}"
                                            alt="{{ $serviceItem['title'] }}"
                                            class="h-auto object-contain {{ $serviceItem['mobile_image_class'] }}"
                                        >
                                    </div>

                                    <div class="mt-8">
                                        <h3 class="font-['Montserrat',sans-serif] text-[1.55rem] leading-tight font-bold tracking-[-0.03em] text-white">
                                            {{ $serviceItem['title'] }}
                                        </h3>
                                        <p class="mt-2 text-[0.98rem] text-white/74">{{ $serviceItem['subtitle'] }}</p>
                                        <a href="#" class="mt-8 inline-flex items-center gap-1.5 text-[0.95rem] font-semibold text-[#72a3bf]">
                                            View more
                                            <span aria-hidden="true">→</span>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="relative left-1/2 hidden w-screen -translate-x-1/2 xl:block">
                            <div class="mx-auto max-w-[1512px]">
                                <div class="grid grid-cols-4 border-b border-white/12">
                                    @foreach ($serviceItems as $index => $serviceItem)
                                        @php
                                            $serviceIndex = $index + 1;
                                        @endphp
                                        <article
                                            @mouseenter="setActiveService({{ $serviceIndex }})"
                                            @mouseleave="resetActiveService()"
                                            @focusin="setActiveService({{ $serviceIndex }})"
                                            @focusout="resetActiveService()"
                                            class="relative min-h-[41rem] overflow-hidden border-r border-white/12 px-12 py-14 transition-[background-color] duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] last:border-r-0"
                                            :class="activeService === {{ $serviceIndex }} ? '{{ $serviceItem['active_background'] }}' : 'bg-black'"
                                        >
                                            <p
                                                class="font-['Montserrat',sans-serif] text-[3.75rem] leading-none font-semibold text-[#686b6c] transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)]"
                                                :class="activeService === {{ $serviceIndex }} ? '-translate-y-4 opacity-0' : 'translate-y-0 opacity-100'"
                                            >
                                                {{ $serviceItem['number'] }}
                                            </p>

                                            <div
                                                class="pointer-events-none absolute left-1/2 top-[5.2rem] flex h-[19rem] w-full max-w-[15.8rem] -translate-x-1/2 items-center justify-center transition-all duration-700 ease-[cubic-bezier(0.22,1,0.36,1)]"
                                                :class="activeService === {{ $serviceIndex }} ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                                            >
                                                <img
                                                    data-feature-source-image
                                                    src="{{ asset($serviceItem['image']) }}"
                                                    alt=""
                                                    class="h-auto object-contain {{ $serviceItem['desktop_image_class'] }}"
                                                >
                                            </div>

                                            <div
                                                class="absolute inset-x-12 transition-all duration-700 ease-[cubic-bezier(0.22,1,0.36,1)]"
                                                :class="activeService === {{ $serviceIndex }} ? 'bottom-14' : 'bottom-[15.5rem]'"
                                            >
                                                <h3 class="font-['Montserrat',sans-serif] text-[2rem] leading-tight font-bold tracking-[-0.03em] text-white">
                                                    {{ $serviceItem['title'] }}
                                                </h3>
                                                <p class="mt-2 text-[1rem] text-white/74">{{ $serviceItem['subtitle'] }}</p>
                                                <button type="button" class="mt-8 inline-flex items-center gap-1.5 text-[0.95rem] font-semibold text-[#72a3bf]" @click="openFeatureProduct('{{ $serviceIndex === 4 ? 'stempel' : 'nota' }}')">
                                                    View more
                                                    <span aria-hidden="true">→</span>
                                                </button>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>

                    <div
                        x-cloak
                        x-show="featureMode === 'product'"
                        x-transition:enter="transition duration-700 ease-[cubic-bezier(0.16,1,0.3,1)]"
                        x-transition:enter-start="translate-x-full"
                        x-transition:enter-end="translate-x-0"
                        x-transition:leave="transition duration-[450ms] ease-[cubic-bezier(0.55,0,1,0.45)]"
                        x-transition:leave-start="translate-x-0 opacity-100"
                        x-transition:leave-end="translate-x-full opacity-100"
                        class="fixed inset-0 z-[80] overflow-hidden bg-[#020607] feature-product-overlay"
                        :class="[`is-${featurePhase}`, `is-switch-${featureSwitchPhase}`]"
                    >
                        <div class="feature-product-chrome">
                            <x-site-navbar active="home" variant="dark" :show-theme-switch="false" />
                        </div>

                        <div
                            aria-hidden="true"
                            class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(circle_at_68%_49%,rgba(84,104,111,0.28)_0%,rgba(9,31,42,0.96)_34%,#020607_74%)]"
                        ></div>

                        <div class="feature-product-stage relative mx-auto mt-[4.2rem] grid max-w-[1280px] grid-cols-[1fr_0.95fr] gap-12 px-14">
                            <div class="feature-product-copy relative z-10">
                                <div class="feature-product-meta flex items-center gap-1.5 text-[1.25rem] leading-none text-[#f7d328]" aria-label="Rated 4.5 out of 5">
                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span><span class="text-white/55">★</span>
                                </div>
                                <h3 class="feature-product-title mt-4 font-display text-[8.7rem] leading-[0.8] font-extrabold tracking-[-0.06em] text-white" x-text="currentFeatureProduct().title"></h3>
                                <p class="feature-product-description mt-8 max-w-[32rem] text-[1.02rem] leading-[1.5] text-white/66" x-text="currentFeatureProduct().description"></p>

                                <div class="feature-product-actions mt-10 flex items-center gap-10">
                                    <a href="{{ route('catalog') }}" class="inline-flex h-9 items-center rounded-full bg-white px-5 text-[0.72rem] font-extrabold uppercase tracking-[-0.01em] text-[#101820] transition-colors hover:bg-[#dceaf2]">
                                        Pesan Sekarang
                                    </a>
                                    <a href="{{ route('catalog') }}" class="inline-flex items-center gap-1.5 text-[0.78rem] font-semibold text-white/88 transition-colors hover:text-white">
                                        Lihat Semua Produk
                                        <span aria-hidden="true">→</span>
                                    </a>
                                </div>

                                <div class="mt-14 flex items-center gap-5">
                                    <button
                                        type="button"
                                        class="feature-product-thumb"
                                        :class="selectedFeatureProduct === 'nota' ? 'is-active' : ''"
                                        @click="selectFeatureProduct('nota')"
                                        aria-label="Show nota product"
                                    >
                                        <img src="{{ asset('images/product/media-promosi.png') }}" alt="" class="h-[3rem] w-auto object-contain">
                                    </button>
                                    <button
                                        type="button"
                                        class="feature-product-thumb"
                                        :class="selectedFeatureProduct === 'stempel' ? 'is-active' : ''"
                                        @click="selectFeatureProduct('stempel')"
                                        aria-label="Show stempel product"
                                    >
                                        <img src="{{ asset('images/product/kebutuhan-bisnis.png') }}" alt="" class="h-[3.25rem] w-auto object-contain">
                                    </button>
                                </div>
                            </div>

                            <div class="feature-product-visual relative flex min-h-[31rem] items-center justify-center">
                                <img
                                    :src="currentFeatureProduct().image"
                                    :alt="currentFeatureProduct().title"
                                    class="feature-product-hero h-auto max-h-[32rem] w-auto max-w-[28rem] object-contain"
                                    :style="featureHeroStyle()"
                                >
                            </div>
                        </div>

                        <button
                            type="button"
                            class="feature-product-back absolute right-[6.4rem] bottom-[5rem] inline-flex items-center gap-1.5 text-[0.82rem] font-semibold text-white/88 transition-colors hover:text-white"
                            @click="closeFeatureProduct()"
                        >
                            ← Kembali
                        </button>
                    </div>

                    @php
                        $orderSteps = [
                            ['number' => '01', 'title' => 'Pilih Produk', 'image' => 'images/order/pilih-produk.png', 'card' => 'bg-[linear-gradient(180deg,#787f8b_0%,#5a626c_100%)]', 'image_class' => 'max-h-[8.2rem]'],
                            ['number' => '02', 'title' => 'Konsultasi', 'image' => 'images/order/konsultasi.png', 'card' => 'bg-[linear-gradient(180deg,#233252_0%,#0d1d39_100%)]', 'image_class' => 'max-h-[6.4rem]'],
                            ['number' => '03', 'title' => 'Pembayaran', 'image' => 'images/order/pembayaran.png', 'card' => 'bg-[linear-gradient(180deg,#787f8b_0%,#5a626c_100%)]', 'image_class' => 'max-h-[6.9rem]'],
                            ['number' => '04', 'title' => 'Produksi', 'image' => 'images/order/produksi.png', 'card' => 'bg-[linear-gradient(180deg,#233252_0%,#0d1d39_100%)]', 'image_class' => 'max-h-[6.7rem]'],
                            ['number' => '05', 'title' => 'Pengiriman', 'image' => 'images/order/pengiriman.png', 'card' => 'bg-[linear-gradient(180deg,#787f8b_0%,#5a626c_100%)]', 'image_class' => 'max-h-[7rem]'],
                        ];
                    @endphp

                    <section class="pt-2 pb-10 md:pt-4 md:pb-12 lg:pt-6 lg:pb-16">
                        <div class="mx-auto max-w-[81rem]">
                            <h2 class="text-center font-display text-[2.9rem] leading-none font-bold tracking-[-0.05em] text-white md:text-[3.4rem] lg:text-[3.9rem] xl:hidden">
                                Cara Pemesanan
                            </h2>

                            <div class="mt-14 grid gap-8 md:grid-cols-2 xl:hidden">
                                @foreach ($orderSteps as $orderStep)
                                    <article class="flex justify-center">
                                        <div class="{{ $orderStep['card'] }} relative flex h-[19.5rem] w-full max-w-[15rem] flex-col items-center rounded-[2rem] px-6 pt-5 pb-7 shadow-[0_20px_40px_rgba(0,0,0,0.2)]">
                                            <p class="font-display text-[2.5rem] leading-none font-bold tracking-[-0.05em] text-white/92">
                                                {{ $orderStep['number'] }}
                                            </p>
                                            <h3 class="mt-6 text-center font-display text-[1.75rem] leading-[1.05] font-bold tracking-[-0.05em] text-white">
                                                {{ $orderStep['title'] }}
                                            </h3>
                                            <div class="mt-auto flex h-[8.9rem] items-end justify-center">
                                                <img src="{{ asset($orderStep['image']) }}" alt="{{ $orderStep['title'] }}" class="h-auto w-auto object-contain {{ $orderStep['image_class'] }}">
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>

                            @php
                                $desktopOrderSteps = [
                                    ['number' => '01', 'title' => 'Pilih Produk', 'image' => 'images/order/pilih-produk.png', 'left' => '220px', 'title_width' => '114px', 'image_left' => '0px', 'image_top' => '97px', 'image_width' => '151px', 'image_height' => '117px', 'image_class' => 'max-h-[117px]'],
                                    ['number' => '02', 'title' => 'Konsultasi', 'image' => 'images/order/konsultasi.png', 'left' => '450px', 'title_width' => '101px', 'image_left' => '0px', 'image_top' => '115px', 'image_width' => '151px', 'image_height' => '82px', 'image_class' => 'max-h-[82px]'],
                                    ['number' => '03', 'title' => 'Pembayaran', 'image' => 'images/order/pembayaran.png', 'left' => '680px', 'title_width' => '123px', 'image_left' => '0px', 'image_top' => '99px', 'image_width' => '151px', 'image_height' => '120px', 'image_class' => 'max-h-[120px]'],
                                    ['number' => '04', 'title' => 'Produksi', 'image' => 'images/order/produksi.png', 'left' => '910px', 'title_width' => '86px', 'image_left' => '0px', 'image_top' => '99px', 'image_width' => '151px', 'image_height' => '120px', 'image_class' => 'max-h-[120px]'],
                                    ['number' => '05', 'title' => 'Pengiriman', 'image' => 'images/order/pengiriman.png', 'left' => '1141px', 'title_width' => '110px', 'image_left' => '10px', 'image_top' => '104px', 'image_width' => '135px', 'image_height' => '126px', 'image_class' => 'max-h-[126px]'],
                                ];
                            @endphp

                            <div class="relative left-1/2 mt-10 hidden w-screen -translate-x-1/2 xl:block">
                                <div class="mx-auto h-[506px] w-[1276px] overflow-hidden min-[1440px]:h-[552px] min-[1440px]:w-[1391px] 2xl:h-[600px] 2xl:w-[1512px]">
                                    <div class="relative h-[600px] w-[1512px] origin-top-left scale-[0.844] min-[1440px]:scale-[0.92] 2xl:scale-100">
                                        <p class="absolute left-1/2 top-[74px] -translate-x-1/2 whitespace-nowrap text-[30px] leading-[40px] font-bold text-white [font-family:'Montserrat',sans-serif]">
                                            Cara Pemesanan
                                        </p>

                                        @foreach ($desktopOrderSteps as $desktopOrderStep)
                                            <article class="absolute top-[185px] h-[250px] w-[151px]" style="left: {{ $desktopOrderStep['left'] }};">
                                                <div class="absolute inset-y-0 left-px w-[150px] rounded-[20px] {{ str_contains($desktopOrderStep['title'], 'Konsultasi') || str_contains($desktopOrderStep['title'], 'Produksi') ? 'bg-[linear-gradient(180deg,#1f2d42_0%,#0d1a2f_100%)]' : 'bg-[linear-gradient(180deg,#69717c_0%,#3b444d_100%)]' }}"></div>
                                                <p class="absolute top-[12px] left-1/2 -translate-x-1/2 text-[20px] leading-[40px] font-semibold text-[#f1f5f9] [font-family:'Montserrat',sans-serif]">
                                                    {{ $desktopOrderStep['number'] }}
                                                </p>
                                                <p class="absolute top-[54px] left-1/2 -translate-x-1/2 whitespace-nowrap text-center text-[20px] leading-[40px] font-bold text-white [font-family:'Plus Jakarta Sans',sans-serif]" style="width: {{ $desktopOrderStep['title_width'] }};">
                                                    {{ $desktopOrderStep['title'] }}
                                                </p>
                                                <div
                                                    class="absolute flex items-center justify-center"
                                                    style="left: {{ $desktopOrderStep['image_left'] }}; top: {{ $desktopOrderStep['image_top'] }}; width: {{ $desktopOrderStep['image_width'] }}; height: {{ $desktopOrderStep['image_height'] }};"
                                                >
                                                    <img src="{{ asset($desktopOrderStep['image']) }}" alt="{{ $desktopOrderStep['title'] }}" class="h-auto w-auto object-contain {{ $desktopOrderStep['image_class'] }}">
                                                </div>
                                            </article>
                                        @endforeach

                                        <div class="absolute left-[281.56px] top-[106.24px] flex h-[238.043px] w-[226.019px] items-center justify-center">
                                            <div>
                                                <img src="{{ asset('images/order/figma/arrow-1.svg') }}" alt="" class="mr-12 mt-12">
                                            </div>
                                        </div>

                                        <div class="absolute left-[347.09px] top-[337.57px] flex h-[189.248px] w-[196.106px] items-center justify-center">
                                            <div>
                                                <img src="{{ asset('images/order/figma/arrow-2.svg') }}" alt="" class="mb-12 ml-12">
                                            </div>
                                        </div>

                                        <div class="absolute left-[515.87px] top-[290.07px] flex h-[232.377px] w-[219.788px] items-center justify-center">
                                            <div>
                                                <img src="{{ asset('images/order/figma/arrow-3.svg') }}" alt="" class="mb-10 mr-12">
                                            </div>
                                        </div>

                                        <div class="absolute left-[568.4px] top-[95px] flex h-[203.072px] w-[210.01px] items-center justify-center">
                                            <div>
                                                <img src="{{ asset('images/order/figma/arrow-8.svg') }}" alt="" class="mt-12 ml-12">
                                            </div>
                                        </div>

                                        <div class="absolute left-[744px] top-[98.07px] flex h-[235.777px] w-[222.658px] items-center justify-center">
                                            <div>
                                                <img src="{{ asset('images/order/figma/arrow-5.svg') }}" alt="" class="mt-10 mr-12">
                                            </div>
                                        </div>

                                        <div class="absolute left-[804.04px] top-[328.07px] flex h-[194.005px] w-[200.708px] items-center justify-center">
                                            <div>
                                                <img src="{{ asset('images/order/figma/arrow-9.svg') }}" alt="" class="mb-12 ml-12">
                                            </div>
                                        </div>

                                        <div class="absolute left-[972px] top-[286.07px] flex h-[235.777px] w-[222.658px] items-center justify-center">
                                            <div>
                                                <img src="{{ asset('images/order/figma/arrow-7.svg') }}" alt="" class="mb-12 mr-12">
                                            </div>
                                        </div>

                                        <div class="absolute left-[1032px] top-[100.07px] flex h-[194.005px] w-[200.708px] items-center justify-center">
                                            <div>
                                                <img src="{{ asset('images/order/figma/arrow-10.svg') }}" alt="" class="mt-12 ml-12">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="pt-18 pb-16 md:pt-22 md:pb-18 lg:pt-24 lg:pb-22">
                        <div class="relative mx-auto max-w-[1280px]">
                            <h2 class="text-center font-['Montserrat',sans-serif] text-[2.5rem] leading-none font-bold tracking-[-0.04em] text-white">
                                Testimonials
                            </h2>

                            <div class="mt-14 flex items-center justify-center gap-4 md:mt-16 lg:mt-[3.75rem] lg:gap-[3.55rem]">
                                <button
                                    type="button"
                                    class="hidden h-[3.125rem] w-[3.125rem] shrink-0 items-center justify-center rounded-full text-black transition-colors lg:flex"
                                    :class="activeTestimonial === 0 ? 'bg-[#031325] opacity-100' : 'bg-[#9e9e9e] opacity-100 hover:bg-[#b4b4b4]'"
                                    @click="previousTestimonial()"
                                    aria-label="Previous testimonial"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.55rem] w-[1.55rem]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19 8 12l7-7"></path>
                                    </svg>
                                </button>

                                <div class="flex-1">
                                    <div class="mx-auto grid max-w-[54rem] items-start gap-10 lg:grid-cols-[13rem_15.625rem_12.5rem] lg:gap-[6.5625rem]">
                                        <article
                                            class="hidden flex-col items-center text-center text-white/42 transition-opacity duration-300 lg:flex"
                                            :class="previousTestimonialData() ? 'opacity-100' : 'pointer-events-none opacity-0'"
                                        >
                                            <div class="flex items-center gap-[0.95rem] text-[1.78rem] leading-none">
                                                <template x-for="index in 5" :key="`testimonial-left-star-${index}`">
                                                    <span x-text="'★'" :class="previousTestimonialData() && index <= previousTestimonialData().rating ? 'text-[#8d7900]' : 'text-white/28'"></span>
                                                </template>
                                            </div>

                                            <p class="mt-[2.95rem] max-w-[12.875rem] whitespace-pre-line font-mono text-[0.94rem] leading-[1.35] tracking-[-0.02em]" x-text="previousTestimonialData()?.quote ?? ''"></p>

                                            <div class="mt-[2.95rem] flex items-center gap-[0.95rem]">
                                                <div class="h-[2.95rem] w-[2.95rem] overflow-hidden rounded-full flex items-center justify-center bg-[#72a3bf] text-white text-[1.1rem] font-bold" x-show="!previousTestimonialData()?.avatar">
                                                    <span x-text="previousTestimonialData()?.name ? previousTestimonialData().name.charAt(0).toUpperCase() : 'P'"></span>
                                                </div>
                                                <div class="h-[2.95rem] w-[2.95rem] overflow-hidden rounded-full" x-show="previousTestimonialData()?.avatar">
                                                    <img :src="previousTestimonialData()?.avatar ?? ''" :alt="previousTestimonialData()?.name ?? ''" class="h-full w-full object-cover opacity-80">
                                                </div>
                                                <span class="text-[1.25rem] font-semibold tracking-[-0.03em]" x-text="previousTestimonialData()?.name ?? ''"></span>
                                            </div>
                                        </article>

                                        <article class="flex flex-col items-center text-center text-white">
                                            <div class="flex items-center gap-[1.15rem] text-[2.2rem] leading-none">
                                                <template x-for="index in 5" :key="`testimonial-main-star-${index}`">
                                                    <span x-text="'★'" :class="currentTestimonial() && index <= currentTestimonial().rating ? 'text-[#ffd21f]' : 'text-white/45'"></span>
                                                </template>
                                            </div>

                                            <p class="mt-[3.55rem] max-w-[15.625rem] whitespace-pre-line font-mono text-[1.16rem] leading-[1.4] tracking-[-0.02em] text-white" x-text="currentTestimonial()?.quote ?? ''"></p>

                                            <div class="mt-[3.55rem] flex items-center gap-[1.15rem]">
                                                <div class="h-[3.65rem] w-[3.65rem] overflow-hidden rounded-full shadow-[0_10px_24px_rgba(0,0,0,0.28)] flex items-center justify-center bg-[#72a3bf] text-white text-[1.4rem] font-bold" x-show="!currentTestimonial()?.avatar">
                                                    <span x-text="currentTestimonial()?.name ? currentTestimonial().name.charAt(0).toUpperCase() : 'P'"></span>
                                                </div>
                                                <div class="h-[3.65rem] w-[3.65rem] overflow-hidden rounded-full shadow-[0_10px_24px_rgba(0,0,0,0.28)]" x-show="currentTestimonial()?.avatar">
                                                    <img :src="currentTestimonial()?.avatar ?? ''" :alt="currentTestimonial()?.name ?? ''" class="h-full w-full object-cover">
                                                </div>
                                                <span class="text-[1.56rem] font-semibold tracking-[-0.04em] text-white" x-text="currentTestimonial()?.name ?? ''"></span>
                                            </div>
                                        </article>

                                        <article
                                            class="hidden flex-col items-center text-center text-white/42 transition-opacity duration-300 lg:flex"
                                            :class="nextTestimonialData() ? 'opacity-100' : 'pointer-events-none opacity-0'"
                                        >
                                            <div class="flex items-center gap-[0.95rem] text-[1.78rem] leading-none">
                                                <template x-for="index in 5" :key="`testimonial-right-star-${index}`">
                                                    <span x-text="'★'" :class="nextTestimonialData() && index <= nextTestimonialData().rating ? 'text-[#8d7900]' : 'text-white/28'"></span>
                                                </template>
                                            </div>

                                            <p class="mt-[3.1rem] max-w-[12.5rem] whitespace-pre-line font-mono text-[0.94rem] leading-[1.35] tracking-[-0.02em]" x-text="nextTestimonialData()?.quote ?? ''"></p>

                                            <div class="mt-[3.1rem] flex items-center gap-[0.95rem]">
                                                <div class="h-[2.95rem] w-[2.95rem] overflow-hidden rounded-full flex items-center justify-center bg-[#72a3bf] text-white text-[1.1rem] font-bold" x-show="!nextTestimonialData()?.avatar">
                                                    <span x-text="nextTestimonialData()?.name ? nextTestimonialData().name.charAt(0).toUpperCase() : 'P'"></span>
                                                </div>
                                                <div class="h-[2.95rem] w-[2.95rem] overflow-hidden rounded-full" x-show="nextTestimonialData()?.avatar">
                                                    <img :src="nextTestimonialData()?.avatar ?? ''" :alt="nextTestimonialData()?.name ?? ''" class="h-full w-full object-cover opacity-80">
                                                </div>
                                                <span class="text-[1.25rem] font-semibold tracking-[-0.03em]" x-text="nextTestimonialData()?.name ?? ''"></span>
                                            </div>
                                        </article>
                                    </div>

                                    <div class="mt-12 flex items-center justify-center gap-4 lg:hidden">
                                        <button
                                            type="button"
                                            class="flex h-12 w-12 items-center justify-center rounded-full text-black transition-colors"
                                            :class="activeTestimonial === 0 ? 'bg-[#031325] opacity-100' : 'bg-[#9e9e9e] opacity-100 hover:bg-[#b4b4b4]'"
                                            @click="previousTestimonial()"
                                            aria-label="Previous testimonial"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19 8 12l7-7"></path>
                                            </svg>
                                        </button>

                                        <button
                                            type="button"
                                            class="flex h-12 w-12 items-center justify-center rounded-full text-black transition-colors"
                                            :class="activeTestimonial === testimonials.length - 1 ? 'bg-[#031325] opacity-100' : 'bg-[#9e9e9e] opacity-100 hover:bg-[#b4b4b4]'"
                                            @click="nextTestimonial()"
                                            aria-label="Next testimonial"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="mt-[3.35rem] flex items-center justify-center gap-[0.95rem]">
                                        <template x-for="(testimonial, index) in testimonials" :key="`testimonial-dot-${index}`">
                                            <button
                                                type="button"
                                                class="h-[0.625rem] w-[0.625rem] rounded-full transition-colors"
                                                :class="activeTestimonial === index ? 'bg-[#7aa9cb]' : 'bg-white/82'"
                                                @click="setActiveTestimonial(index)"
                                                :aria-label="`Show testimonial ${index + 1}`"
                                            ></button>
                                        </template>
                                    </div>
                                </div>

                                <button
                                    type="button"
                                    class="hidden h-[3.125rem] w-[3.125rem] shrink-0 items-center justify-center rounded-full text-black transition-colors lg:flex"
                                    :class="activeTestimonial === testimonials.length - 1 ? 'bg-[#031325] opacity-100' : 'bg-[#9e9e9e] opacity-100 hover:bg-[#b4b4b4]'"
                                    @click="nextTestimonial()"
                                    aria-label="Next testimonial"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[1.55rem] w-[1.55rem]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </section>

                </div>
            </main>

            <footer class="relative isolate overflow-hidden bg-[#020607] pt-18 pb-12 md:pt-22 md:pb-14 lg:pt-26 lg:pb-16">
                <div
                    aria-hidden="true"
                    class="pointer-events-none absolute inset-x-[-16%] bottom-[-34%] z-0 h-[68%] rounded-full bg-[radial-gradient(ellipse_at_center,rgba(35,73,96,0.34)_0%,rgba(18,39,52,0.24)_34%,rgba(8,19,26,0.12)_60%,rgba(0,0,0,0)_100%)] blur-[24px]"
                ></div>

                <div class="relative z-10 mx-auto max-w-[1512px] px-6 md:px-10 lg:px-20">
                    <div class="grid gap-14 lg:grid-cols-[1.8fr_1fr_1fr_1.05fr] lg:gap-x-[6.25rem]">
                        <div class="max-w-[26.125rem]">
                            <div class="flex items-center gap-[1.05rem]">
                                <span class="block h-14 w-14 rounded-full bg-[#e3e3e3]"></span>
                                <span class="font-['Montserrat',sans-serif] text-[2.2rem] leading-none font-bold tracking-[-0.04em] text-white">
                                    Deenhag
                                </span>
                            </div>

                            <p class="mt-[2.85rem] max-w-[26.125rem] text-[0.9375rem] leading-[1.67] text-white/84">
                                Kami melayani kebutuhan konveksi dan digital printing untuk personal, komunitas, maupun bisnis, mulai dari apparel custom, media promosi, hingga kebutuhan cetak usaha dengan kualitas yang rapi dan terpercaya.
                            </p>

                            <div class="mt-[2.85rem] flex items-center gap-[0.65rem] text-white">
                                <a href="{{ $contact?->facebook_url ?: '#' }}" {{ $contact?->facebook_url ? 'target="_blank"' : '' }} aria-label="Facebook" class="transition-opacity hover:opacity-75">
                                    <img src="{{ asset('images/footer/facebook.png') }}" alt="" class="h-10 w-10 object-contain">
                                </a>
                                <a href="{{ $contact?->twitter_url ?: '#' }}" {{ $contact?->twitter_url ? 'target="_blank"' : '' }} aria-label="Twitter" class="transition-opacity hover:opacity-75">
                                    <img src="{{ asset('images/footer/twitter.png') }}" alt="" class="h-10 w-10 object-contain">
                                </a>
                                <a href="{{ $contact?->tiktok_url ?: '#' }}" {{ $contact?->tiktok_url ? 'target="_blank"' : '' }} aria-label="TikTok" class="transition-opacity hover:opacity-75">
                                    <img src="{{ asset('images/footer/tiktok.png') }}" alt="" class="h-10 w-10 object-contain">
                                </a>
                                <a href="{{ $contact?->instagram_url ?: '#' }}" {{ $contact?->instagram_url ? 'target="_blank"' : '' }} aria-label="Instagram" class="transition-opacity hover:opacity-75">
                                    <img src="{{ asset('images/footer/instagram.png') }}" alt="" class="h-10 w-10 object-contain">
                                </a>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-['Montserrat',sans-serif] text-[1.25rem] leading-none font-bold tracking-[-0.03em] text-[#72a3bf]">
                                Navigasi Cepat
                            </h3>
                            <div class="mt-10 space-y-[1.55rem] text-[0.9375rem] font-medium tracking-[0.05em] text-white/92">
                                <a href="{{ route('home') }}" class="block transition-opacity hover:opacity-75">Beranda</a>
                                <a href="{{ route('catalog') }}" class="block transition-opacity hover:opacity-75">Katalog</a>
                                <a href="#" class="block transition-opacity hover:opacity-75">Blog</a>
                                <a href="#" class="block transition-opacity hover:opacity-75">Keranjang</a>
                                <a href="{{ route('tracking.index') }}" class="block transition-opacity hover:opacity-75">Lacak Pesanan</a>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-['Montserrat',sans-serif] text-[1.25rem] leading-none font-bold tracking-[-0.03em] text-[#72a3bf]">
                                Layanan Kami
                            </h3>
                            <div class="mt-10 space-y-[1.55rem] text-[0.9375rem] font-medium tracking-[0.05em] text-white/92">
                                <a href="#" class="block transition-opacity hover:opacity-75">Konveksi Apparel</a>
                                <a href="#" class="block transition-opacity hover:opacity-75">Media Promosi</a>
                                <a href="#" class="block transition-opacity hover:opacity-75">Cetak DTF</a>
                                <a href="#" class="block transition-opacity hover:opacity-75">Kebutuhan Bisnis</a>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-['Montserrat',sans-serif] text-[1.25rem] leading-none font-bold tracking-[-0.03em] text-[#72a3bf]">
                                Hubungi Kami
                            </h3>
                            <div class="mt-[2.2rem] space-y-[0.95rem] text-[0.9375rem] font-medium tracking-[0.05em] text-white/92">
                                <div class="flex items-center gap-[0.65rem]">
                                    <img src="{{ asset('images/footer/whatsapp.png') }}" alt="" class="h-[1.875rem] w-[1.875rem] shrink-0 object-contain">
                                    <span>{{ $contact?->whatsapp_number ?: '+62 23456789123' }}</span>
                                </div>
                                <div class="flex items-center gap-[0.65rem]">
                                    <img src="{{ asset('images/footer/email.png') }}" alt="" class="h-[1.875rem] w-[1.875rem] shrink-0 object-contain">
                                    <span>{{ $contact?->email ?: 'deenhag@gmail.com' }}</span>
                                </div>
                                <div class="flex items-center gap-[0.65rem]">
                                    <img src="{{ asset('images/footer/address.png') }}" alt="" class="h-[1.875rem] w-[1.875rem] shrink-0 object-contain">
                                    <span>{{ $contact?->address ?: 'Ponorogo, Indonesia' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-[3.8rem] border-t border-white/28 pt-[1.9rem] text-center">
                        <p class="text-[0.9375rem] text-white/85">© 2026 Deenhag. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

<x-scroll-top />
</body>
</html>
