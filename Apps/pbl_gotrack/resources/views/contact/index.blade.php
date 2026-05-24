<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ data_get($contact, 'title') ?: data_get($contactFallback, 'title', 'Hubungi Kami') }} - Deenhag</title>
    <meta name="description" content="{{ data_get($contact, 'description') ?: data_get($contactFallback, 'description') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,700;9..40,800&family=Inter:wght@400;500;600;700&family=Montserrat:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body antialiased">
    <div
        x-data="{
            theme: (localStorage.getItem('site-theme') === 'dark' || localStorage.getItem('site-theme') === 'light')
                ? localStorage.getItem('site-theme')
                : (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
            toggleTheme() {
                this.theme = this.theme === 'dark' ? 'light' : 'dark';
                window.localStorage.setItem('site-theme', this.theme);
            }
        }"
        x-bind:data-theme="theme"
        class="catalog-shell contact-shell min-h-screen"
    >
        <x-site-navbar active="contact" variant="light" />

        <main class="relative z-10 pt-10 md:pt-14 lg:pt-16">

            {{-- ============================================================ --}}
            {{-- HUBUNGI KAMI (Contact Form + Info)                             --}}
            {{-- ============================================================ --}}
            <x-contact-form :contact="$contact" :fallback="$contactFallback" />

            {{-- ============================================================ --}}
            {{-- GOOGLE MAPS EMBED                                              --}}
            {{-- ============================================================ --}}
            <x-map-section :contact="$contact" :fallback="$contactFallback" class="mt-14 lg:mt-18" />

            {{-- ============================================================ --}}
            {{-- F.A.Q SECTION                                                  --}}
            {{-- ============================================================ --}}

            <x-faq-section :faqs="$faqs" class="mt-16 lg:mt-20" />


        </main>

        <x-site-footer class="mt-20 lg:mt-24" />

        <x-scroll-top />
    </div>
</body>
</html>
