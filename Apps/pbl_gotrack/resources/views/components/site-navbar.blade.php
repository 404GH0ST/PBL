@props(['active' => null, 'variant' => 'dark', 'showThemeSwitch' => true])

@php
    $isLight = $variant === 'light';
    $pillClass = $isLight ? 'site-nav-pill site-nav-pill--light' : 'site-nav-pill';
    $mobilePillClass = $isLight ? 'site-nav-mobile site-nav-mobile--light' : 'site-nav-mobile';
    $brandTextClass = $isLight ? '' : 'text-white';

    $activeContact = \Illuminate\Support\Facades\Schema::hasTable('contacts')
        ? \App\Models\Contact::active()
        : null;
    $logoUrl = $activeContact?->logo_url ?? asset('images/logo_deenhag.png');
    $brandTitle = 'DEENHAG';

    $links = [
        'home' => ['label' => 'Beranda', 'href' => route('home')],
        'contact' => ['label' => 'Contact', 'href' => route('contact')],
        'catalog' => ['label' => 'Katalog', 'href' => route('catalog')],
        'blog' => ['label' => 'Blog', 'href' => route('blog.index')],
        'tracking' => ['label' => 'Lacak', 'href' => route('tracking.index')],
    ];
@endphp

<header class="relative z-20 px-5 pt-5 md:px-8 md:pt-7 lg:px-14 lg:pt-10">
    <div class="mx-auto flex max-w-[1280px] items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Beranda">
            <img src="{{ $logoUrl }}" alt="{{ $brandTitle }} Logo" class="h-10 w-auto max-w-[120px] object-contain lg:h-12">
        </a>

        <nav class="{{ $pillClass }} hidden items-center rounded-full px-3 py-2 text-[1.02rem] font-semibold lg:flex">
            @foreach ($links as $key => $link)
                <a href="{{ $link['href'] }}" class="rounded-full px-4 py-1.5 {{ $active === $key ? 'is-active' : '' }}">{{ $link['label'] }}</a>
            @endforeach
        </nav>

        @if ($showThemeSwitch)
            <div class="flex items-center gap-3">
                <x-theme-switch mode="desktop" />
            </div>
        @else
            {{-- Invisible spacer keeps nav centered via justify-between --}}
            <div aria-hidden="true" class="hidden lg:block" style="width: 5.75rem;"></div>
        @endif
    </div>

    <div class="mx-auto mt-6 flex max-w-[1280px] items-center gap-3 lg:hidden">
        <nav class="{{ $mobilePillClass }} flex min-w-0 flex-1 gap-2 overflow-x-auto rounded-[1.25rem] p-2 text-sm font-semibold">
            @foreach ($links as $key => $link)
                <a href="{{ $link['href'] }}" class="whitespace-nowrap rounded-full px-4 py-2 {{ $active === $key ? 'is-active' : '' }}">{{ $link['label'] }}</a>
            @endforeach
        </nav>
        @if ($showThemeSwitch)
            <x-theme-switch mode="mobile" />
        @endif
    </div>
</header>
