@php
    $contactFallback = [
        'title' => 'Hubungi Kami',
        'description' => 'Hubungi Deenhag untuk kebutuhan konveksi dan digital printing Anda.',
        'email' => 'deenhag@gmail.com',
        'phone_number' => '+62 23456789',
        'address' => '(1234) Desa, Kecamatan, Ponorogo, Jawa Timur, Indonesia',
        'google_maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63267.53399981368!2d111.4172!3d-7.8684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79a0348daa7b05%3A0x301576d14feb980!2sPonorogo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
    ];

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Deenhag</title>
    <meta name="description" content="{{ $contactFallback['description'] }}">

    <x-theme-preload />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,600;9..40,700;9..40,800&family=Inter:wght@500;600;700&family=Montserrat:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body antialiased">
    <div
        x-data="themePage"
        x-bind:data-theme="theme"
        class="catalog-shell contact-shell about-figma-shell min-h-screen"
    >
        <x-site-navbar active="about" variant="light" />

        <main class="relative z-10 pt-8 md:pt-10 lg:pt-12">
            <section class="mx-auto w-full max-w-[1280px] px-5 md:px-8 lg:px-14">
                <h1 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-[2rem] font-bold leading-tight md:text-[2.5rem]">
                    Hubungi Kami
                </h1>

                <div class="mt-6 grid gap-6 lg:grid-cols-[minmax(0,630px)_minmax(0,1fr)] lg:items-start">
                    <form action="#" method="POST" class="about-figma-form border px-8 py-8">
                        @csrf

                        <input
                            type="text"
                            name="nama"
                            placeholder="Nama"
                            class="about-figma-input h-9 w-full rounded-[10px] px-5 font-['DM_Sans',sans-serif] text-[15px] font-semibold outline-none"
                        >

                        <input
                            type="email"
                            name="email"
                            placeholder="Email"
                            class="about-figma-input mt-5 h-9 w-full rounded-[10px] px-5 font-['DM_Sans',sans-serif] text-[15px] font-semibold outline-none"
                        >

                        <textarea
                            name="pesan"
                            placeholder="Pesan"
                            rows="4"
                            class="about-figma-input mt-5 h-[92px] w-full resize-none rounded-[10px] px-5 py-3 font-['DM_Sans',sans-serif] text-[15px] font-semibold outline-none"
                        ></textarea>

                        <div class="mt-5 flex justify-end">
                            <button type="submit" class="rounded-[10px] bg-[#72a3bf] px-7 py-1 font-['DM_Sans',sans-serif] text-[13px] font-semibold text-white">
                                Kirim
                            </button>
                        </div>
                    </form>

                    <div class="grid gap-6 lg:gap-7">
                        <div>
                            <h2 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-xl font-bold">Email Kami</h2>
                            <p class="contact-text-soft mt-2 font-['DM_Sans',sans-serif] text-[15px] font-bold">{{ $contactFallback['email'] }}</p>
                        </div>

                        <div>
                            <h2 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-xl font-bold">Hubungi Kami</h2>
                            <p class="contact-text-soft mt-2 font-['DM_Sans',sans-serif] text-[15px] font-bold">{{ $contactFallback['phone_number'] }}</p>
                        </div>

                        <div>
                            <h2 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-xl font-bold">Mengikuti</h2>
                            <div class="mt-3 flex items-center gap-1.5">
                                <a href="#" aria-label="YouTube" class="transition hover:opacity-75">
                                    <span class="about-figma-social">▶</span>
                                </a>
                                <a href="#" aria-label="TikTok" class="transition hover:opacity-75">
                                    <img src="{{ asset('images/footer/tiktok.png') }}" alt="" class="contact-social-icon h-[30px] w-[30px] object-contain">
                                </a>
                                <a href="#" aria-label="Instagram" class="transition hover:opacity-75">
                                    <img src="{{ asset('images/footer/instagram.png') }}" alt="" class="contact-social-icon h-[30px] w-[30px] object-contain">
                                </a>
                                <a href="#" aria-label="Twitter" class="transition hover:opacity-75">
                                    <img src="{{ asset('images/footer/twitter.png') }}" alt="" class="contact-social-icon h-[30px] w-[30px] object-contain">
                                </a>
                                <a href="#" aria-label="Facebook" class="transition hover:opacity-75">
                                    <img src="{{ asset('images/footer/facebook.png') }}" alt="" class="contact-social-icon h-[30px] w-[30px] object-contain">
                                </a>
                            </div>
                        </div>

                        <div>
                            <h2 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-xl font-bold">Kunjungi Kami</h2>
                            <p class="contact-text-soft mt-2 font-['DM_Sans',sans-serif] text-[15px] font-bold">{{ $contactFallback['address'] }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mx-auto mt-14 w-full max-w-[1280px] px-5 md:px-8 lg:px-14">
                <div class="about-figma-map overflow-hidden">
                    <iframe
                        src="{{ $contactFallback['google_maps_embed_url'] }}"
                        class="h-[260px] w-full border-0 md:h-[320px] lg:h-[360px]"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi Deenhag di Google Maps"
                    ></iframe>
                </div>
            </section>

            <x-faq-section :faqs="$faqs" class="mt-16 lg:mt-20" />
        </main>

        <x-site-footer class="mt-20 lg:mt-24" />

        <x-scroll-top />
    </div>
</body>
</html>
