<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog - Deenhag</title>

    <x-theme-preload />

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
        x-data="themePage"
        x-bind:data-theme="theme"
        class="catalog-shell blog-shell min-h-screen"
    >
        <x-site-navbar active="blog" variant="light" />

        <main class="relative z-10 mx-auto w-full max-w-[1280px] px-5 pt-10 md:px-8 lg:px-14 lg:pt-14">

            {{-- ============================================================ --}}
            {{-- FEATURED HERO MOSAIC                                           --}}
            {{-- ============================================================ --}}
            @if($featured->isNotEmpty())
            @php
                $featuredList = $featured->values();
                $f1 = $featuredList[0] ?? null;
                $f2 = $featuredList[1] ?? null;
                $f3 = $featuredList[2] ?? null;
                $f4 = $featuredList[3] ?? null;
            @endphp
            <section class="grid gap-3 lg:h-[505px] lg:grid-cols-2 lg:grid-rows-2">

                {{-- Big left card --}}
                @if($f1)
                <a href="{{ route('blog.show', $f1->slug) }}"
                   class="group relative block overflow-hidden lg:row-span-2">
                    <img src="{{ $f1->image_url }}" alt="{{ $f1->title }}"
                         class="h-[380px] w-full object-cover transition duration-500 group-hover:scale-105 lg:h-full">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/60"></div>
                    <div class="absolute inset-x-0 bottom-0 p-8 lg:p-11">
                        <span class="inline-block bg-black/50 px-2 py-1.5 font-['Plus_Jakarta_Sans',sans-serif] text-[0.88rem] font-bold uppercase tracking-wide text-white">
                            {{ strtoupper($f1->category ?? 'BLOG') }}
                        </span>
                        <h2 class="mt-4 max-w-[541px] font-['Plus_Jakarta_Sans',sans-serif] text-[1.1rem] font-bold leading-snug text-white lg:text-[1.25rem]">
                            {{ Str::limit($f1->title, 160) }}
                        </h2>
                        <p class="mt-5 font-['Inter',sans-serif] text-[0.88rem] font-medium text-[#becee5]">
                            {{ $f1->display_date }}
                        </p>
                    </div>
                </a>
                @endif

                {{-- Top-right wide --}}
                @if($f2)
                <a href="{{ route('blog.show', $f2->slug) }}"
                   class="group relative block overflow-hidden">
                    <img src="{{ $f2->image_url }}" alt="{{ $f2->title }}"
                         class="h-[220px] w-full object-cover transition duration-500 group-hover:scale-105 lg:h-full">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/60"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6 lg:p-11">
                        <span class="inline-block bg-black/50 px-2 py-1 font-['Plus_Jakarta_Sans',sans-serif] text-[0.82rem] font-bold uppercase tracking-wide text-white">
                            {{ strtoupper($f2->category ?? 'BLOG') }}
                        </span>
                        <h3 class="mt-2 max-w-[539px] font-['Plus_Jakarta_Sans',sans-serif] text-[1.05rem] font-bold leading-snug text-white lg:text-[1.25rem]">
                            {{ Str::limit($f2->title, 80) }}
                        </h3>
                        <p class="mt-3 font-['Inter',sans-serif] text-[0.88rem] font-medium text-[#becee5]">
                            {{ $f2->display_date }}
                        </p>
                    </div>
                </a>
                @endif

                {{-- Bottom-right small pair --}}
                <div class="grid gap-3 sm:grid-cols-2">
                    @foreach([$f3, $f4] as $fx)
                        @if($fx)
                        <a href="{{ route('blog.show', $fx->slug) }}"
                           class="group relative block overflow-hidden">
                            <img src="{{ $fx->image_url }}" alt="{{ $fx->title }}"
                                 class="h-[220px] w-full object-cover transition duration-500 group-hover:scale-105 lg:h-full">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black/60"></div>
                            <div class="absolute inset-x-0 bottom-0 p-5 lg:p-7">
                                <span class="inline-block bg-black/50 px-2 py-1 font-['Plus_Jakarta_Sans',sans-serif] text-[0.78rem] font-bold uppercase tracking-wide text-white">
                                    {{ strtoupper($fx->category ?? 'BLOG') }}
                                </span>
                                <h4 class="mt-2 font-['Plus_Jakarta_Sans',sans-serif] text-[1rem] font-bold leading-snug text-white line-clamp-3">
                                    {{ Str::limit($fx->title, 60) }}
                                </h4>
                                <p class="mt-3 font-['Inter',sans-serif] text-[0.82rem] font-medium text-[#becee5]">
                                    {{ $fx->display_date }}
                                </p>
                            </div>
                        </a>
                        @endif
                    @endforeach
                </div>

            </section>
            @endif

            {{-- ============================================================ --}}
            {{-- UNGGULAN                                                        --}}
            {{-- ============================================================ --}}
            @if($featured->count() >= 1)
            <section class="mt-16 lg:mt-20">
                {{-- Unggulan: short thick underline sitting on top of a long full-width thin rule --}}
                <div class="catalog-border-soft relative flex border-b">
                    <h2 class="blog-section-label catalog-text font-['Plus_Jakarta_Sans',sans-serif] text-[1.55rem] font-bold">Unggulan</h2>
                </div>

                @php
                    $bigCard    = $featuredList[0];
                    $midCards   = $featuredList->slice(0, 2)->values();
                    $smallCards = $featuredList->take(3)->values();
                @endphp

                <div class="mt-8 flex flex-col gap-8 lg:flex-row lg:gap-8">

                    {{-- Col 1: BIG CARD --}}
                    <a href="{{ route('blog.show', $bigCard->slug) }}"
                       class="group block shrink-0 lg:w-[435px]">
                        <div class="overflow-hidden">
                            <img src="{{ $bigCard->image_url }}" alt="{{ $bigCard->title }}"
                                 class="h-[260px] w-full object-cover transition duration-500 group-hover:scale-105 lg:h-[202px]">
                        </div>
                        <h3 class="catalog-text mt-5 font-['Plus_Jakarta_Sans',sans-serif] text-[1.25rem] font-bold leading-snug line-clamp-2">
                            {{ Str::limit($bigCard->title, 90) }}
                        </h3>
                        <p class="mt-3 font-['Plus_Jakarta_Sans',sans-serif] text-[0.92rem] leading-relaxed text-[#686b6c] line-clamp-2">
                            {{ Str::limit($bigCard->excerpt ?? strip_tags($bigCard->content), 130) }}
                        </p>
                        <div class="mt-4 flex items-center gap-2 font-['Inter',sans-serif] text-[0.82rem]">
                            <span class="catalog-text font-semibold">{{ $bigCard->category }}</span>
                            <span class="h-[1px] w-[9px] rotate-90 bg-[#686b6c]"></span>
                            <span class="font-medium text-[#686b6c]">{{ $bigCard->display_date }}</span>
                        </div>
                    </a>

                    {{-- Col 2: MID STACK (image + text pairs) --}}
                    <div class="grid gap-x-4 gap-y-6 lg:grid-cols-[175px_240px] lg:items-start">
                        @foreach($midCards as $mid)
                        <a href="{{ route('blog.show', $mid->slug) }}" class="group block shrink-0 overflow-hidden">
                            <img src="{{ $mid->image_url }}" alt="{{ $mid->title }}"
                                 class="h-[170px] w-full object-cover transition duration-500 group-hover:scale-105 lg:w-[175px]">
                        </a>
                        <a href="{{ route('blog.show', $mid->slug) }}" class="group block">
                            <h4 class="catalog-text font-['Plus_Jakarta_Sans',sans-serif] text-[1rem] font-bold leading-snug line-clamp-3">
                                {{ Str::limit($mid->title, 60) }}
                            </h4>
                            <p class="mt-2 font-['Plus_Jakarta_Sans',sans-serif] text-[0.85rem] leading-snug text-[#686b6c] line-clamp-2">
                                {{ Str::limit($mid->excerpt ?? strip_tags($mid->content), 80) }}
                            </p>
                            <div class="mt-2 flex items-center gap-2 font-['Inter',sans-serif] text-[0.78rem]">
                                <span class="catalog-text font-semibold">{{ $mid->category }}</span>
                                <span class="h-[1px] w-[9px] rotate-90 bg-[#686b6c]"></span>
                                <span class="font-medium text-[#686b6c]">{{ $mid->display_date }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    {{-- Col 3: SMALL STACK --}}
                    <div class="grid gap-x-4 gap-y-5 lg:grid-cols-[130px_215px] lg:items-start">
                        @foreach($smallCards as $sm)
                        <a href="{{ route('blog.show', $sm->slug) }}" class="group block shrink-0 overflow-hidden">
                            <img src="{{ $sm->image_url }}" alt="{{ $sm->title }}"
                                 class="h-[104px] w-full object-cover transition duration-500 group-hover:scale-105 lg:w-[130px]">
                        </a>
                        <a href="{{ route('blog.show', $sm->slug) }}" class="group block">
                            <h4 class="catalog-text font-['Plus_Jakarta_Sans',sans-serif] text-[0.95rem] font-bold leading-snug line-clamp-3">
                                {{ Str::limit($sm->title, 55) }}
                            </h4>
                            <div class="mt-2 flex items-center gap-2 font-['Inter',sans-serif] text-[0.76rem]">
                                <span class="catalog-text font-semibold">{{ $sm->category }}</span>
                                <span class="h-[1px] w-[9px] rotate-90 bg-[#686b6c]"></span>
                                <span class="font-medium text-[#686b6c]">{{ $sm->display_date }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>

                </div>
            </section>
            @endif

            {{-- ============================================================ --}}
            {{-- TERBARU + POPULER                                              --}}
            {{-- ============================================================ --}}
            <section class="mt-20">
                <div class="catalog-border-soft relative grid gap-8 border-b lg:grid-cols-[1fr_280px]">
                    <div class="flex">
                        <h2 class="blog-section-label catalog-text font-['Plus_Jakarta_Sans',sans-serif] text-[1.55rem] font-bold">Terbaru</h2>
                    </div>
                    <div class="flex">
                        <h2 class="blog-section-label catalog-text font-['Plus_Jakarta_Sans',sans-serif] text-[1.55rem] font-bold">Populer</h2>
                    </div>
                </div>

                <div class="mt-10 grid gap-x-10 gap-y-12 lg:grid-cols-[1fr_280px]">

                    {{-- TERBARU --}}
                    <div class="grid gap-x-8 gap-y-12 sm:grid-cols-2">
                        @forelse($latest as $post)
                        <a href="{{ route('blog.show', $post->slug) }}" class="group block">
                            <div class="overflow-hidden">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                                     class="h-[202px] w-full object-cover transition duration-500 group-hover:scale-105">
                            </div>
                            <h3 class="catalog-text mt-5 font-['Plus_Jakarta_Sans',sans-serif] text-[1.2rem] font-bold leading-snug line-clamp-2">
                                {{ Str::limit($post->title, 85) }}
                            </h3>
                            <p class="mt-3 font-['Plus_Jakarta_Sans',sans-serif] text-[0.92rem] leading-relaxed text-[#686b6c] line-clamp-2">
                                {{ Str::limit($post->excerpt ?? strip_tags($post->content), 140) }}
                            </p>
                            <div class="mt-4 flex items-center gap-2 font-['Inter',sans-serif] text-[0.82rem]">
                                <span class="catalog-text font-semibold">{{ $post->category }}</span>
                                <span class="h-[1px] w-[9px] rotate-90 bg-[#686b6c]"></span>
                                <span class="font-medium text-[#686b6c]">{{ $post->display_date }}</span>
                            </div>
                        </a>
                        @empty
                        <p class="text-[#686b6c] sm:col-span-2">Belum ada artikel.</p>
                        @endforelse
                    </div>

                    {{-- POPULER --}}
                    <aside class="space-y-8">
                        @foreach($popular as $i => $post)
                        <a href="{{ route('blog.show', $post->slug) }}"
                           class="group grid grid-cols-[70px_1fr] items-start gap-4">
                            <span class="font-['DM_Sans',sans-serif] text-[3rem] font-bold leading-none tracking-tight text-[rgba(104,107,108,0.5)]">
                                {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <div class="pt-1">
                                <h4 class="catalog-text font-['Plus_Jakarta_Sans',sans-serif] text-[1rem] font-bold leading-snug group-hover:underline line-clamp-2">
                                    {{ Str::limit($post->title, 60) }}
                                </h4>
                                <div class="mt-2 flex items-center gap-2 font-['Inter',sans-serif] text-[0.76rem]">
                                    <span class="catalog-text font-semibold">{{ $post->category }}</span>
                                    <span class="h-[1px] w-[9px] rotate-90 bg-[#686b6c]"></span>
                                    <span class="font-medium text-[#686b6c]">{{ $post->display_date }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </aside>
                </div>
            </section>

            {{-- Pagination --}}
            @if($latest->hasPages())
            <div class="mt-20 flex items-center justify-center gap-3">
                @if($latest->onFirstPage())
                    <span class="catalog-text flex h-5 w-3 items-center justify-center opacity-40">‹</span>
                @else
                    <a href="{{ $latest->previousPageUrl() }}" class="catalog-text flex h-5 w-3 items-center justify-center hover:opacity-70">‹</a>
                @endif

                @foreach($latest->getUrlRange(1, $latest->lastPage()) as $page => $url)
                    @if($page == $latest->currentPage())
                        <span class="flex h-5 min-w-[18px] items-center justify-center bg-[#686b6c] px-1 font-['Inter',sans-serif] text-[0.9rem] font-semibold text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="flex h-5 min-w-[18px] items-center justify-center bg-[rgba(104,107,108,0.5)] px-1 font-['Inter',sans-serif] text-[0.9rem] font-semibold text-white hover:opacity-80">{{ $page }}</a>
                    @endif
                @endforeach

                @if($latest->hasMorePages())
                    <a href="{{ $latest->nextPageUrl() }}" class="catalog-text flex h-5 w-3 items-center justify-center hover:opacity-70">›</a>
                @else
                    <span class="catalog-text flex h-5 w-3 items-center justify-center opacity-40">›</span>
                @endif
            </div>
            @endif

        </main>

        <x-site-footer class="mt-24" />
    </div>
</body>
</html>
