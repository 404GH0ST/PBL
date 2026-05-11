<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} - Deenhag</title>

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
        class="catalog-shell blog-shell min-h-screen"
    >
        <x-site-navbar active="blog" variant="light" />

        {{-- Divider under navbar --}}
        <div class="mx-auto w-full max-w-[1280px] px-5 md:px-8 lg:px-14">
            <hr class="catalog-border-soft mt-6 border-t">
        </div>

        <main class="mx-auto w-full max-w-[1280px] px-5 md:px-8 lg:px-14">

            {{-- Back link --}}
            <div class="mt-6">
                <a href="{{ route('blog.index') }}"
                   class="catalog-text inline-flex items-center gap-2 font-['Inter',sans-serif] text-[1.1rem] font-semibold transition hover:opacity-70">
                    <span aria-hidden="true">←</span>
                    <span>Kembali</span>
                </a>
            </div>

            <div class="mt-8 grid gap-10 lg:grid-cols-[845fr_406fr] lg:gap-[36px]">

                {{-- LEFT : ARTICLE --}}
                <article class="min-w-0">
                    {{-- Title --}}
                    <h1 class="catalog-text font-['Plus_Jakarta_Sans',sans-serif] text-[1.6rem] font-bold leading-snug md:text-[1.85rem]">
                        {{ $post->title }}
                    </h1>

                    {{-- Meta --}}
                    <div class="catalog-text-muted mt-3 flex items-center gap-3 font-['Inter',sans-serif] text-[0.9rem] font-semibold">
                        <span>{{ $post->category }}</span>
                        <span class="h-[5px] w-[5px] rounded-full bg-current"></span>
                        <span>{{ $post->display_date }}</span>
                    </div>

                    {{-- Hero image --}}
                    <div class="mt-6 overflow-hidden rounded-[20px]">
                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                             class="h-[280px] w-full object-cover md:h-[380px] lg:h-[436px]">
                    </div>

                    {{-- Lead + body --}}
                    @php
                        $content = trim($post->content);
                        $paragraphs = preg_split('/\r?\n\s*\r?\n/', $content);
                        $lead = $paragraphs[0] ?? '';
                        $rest = array_slice($paragraphs, 1);
                    @endphp

                    @if($lead)
                    <p class="catalog-text mt-10 font-['Plus_Jakarta_Sans',sans-serif] text-[1.3rem] font-semibold leading-relaxed">
                        {{ $lead }}
                    </p>
                    @endif

                    @if(!empty($rest))
                    <div class="catalog-text-body mt-6 space-y-5 font-['DM_Sans',sans-serif] text-[1.05rem] leading-[1.7]">
                        @foreach(array_slice($rest, 0, 1) as $p)
                            @if(trim($p))<p>{{ $p }}</p>@endif
                        @endforeach
                    </div>
                    @endif

                    {{-- Divider + continuation --}}
                    @if(count($rest) > 1)
                    <hr class="catalog-border-soft my-10 border-t">

                    <div class="catalog-text-body space-y-5 font-['DM_Sans',sans-serif] text-[1.05rem] leading-[1.7]">
                        @foreach(array_slice($rest, 1) as $p)
                            @if(trim($p))<p>{{ $p }}</p>@endif
                        @endforeach
                    </div>
                    @endif

                </article>

                {{-- RIGHT : SIDEBAR --}}
                <aside class="catalog-border-soft lg:border-l lg:pl-10">

                    {{-- Share --}}
                    <p class="catalog-text font-['DM_Sans',sans-serif] text-[1rem] font-bold">Bagikan Ke</p>
                    <div class="catalog-text mt-3 flex items-center gap-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                           target="_blank" rel="noopener" aria-label="Share to Facebook"
                           class="transition hover:opacity-70">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="h-[26px] w-[26px]" aria-hidden="true">
                                <path d="M22 12.07C22 6.51 17.52 2 12 2S2 6.51 2 12.07c0 5.02 3.66 9.19 8.44 9.93v-7.02H7.9v-2.91h2.54V9.85c0-2.52 1.49-3.91 3.77-3.91 1.09 0 2.24.2 2.24.2v2.47h-1.26c-1.24 0-1.63.78-1.63 1.57v1.88h2.77l-.44 2.91h-2.33V22c4.78-.74 8.44-4.91 8.44-9.93Z"/>
                            </svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                           target="_blank" rel="noopener" aria-label="Share to Twitter / X"
                           class="transition hover:opacity-70">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="h-[26px] w-[26px]" aria-hidden="true">
                                <path d="M18.244 2H21l-6.52 7.45L22 22h-6.8l-4.77-6.24L4.8 22H2l7-8.02L2 2h6.9l4.33 5.72L18.244 2Zm-1.19 18h1.65L7.02 4H5.28l11.774 16Z"/>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram"
                           class="transition hover:opacity-70">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" class="h-[26px] w-[26px]" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="5"/>
                                <circle cx="12" cy="12" r="4"/>
                                <circle cx="17.4" cy="6.6" r="1.1" fill="currentColor" stroke="none"/>
                            </svg>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($post->title.' '.request()->url()) }}"
                           target="_blank" rel="noopener" aria-label="Share to WhatsApp"
                           class="transition hover:opacity-70">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="h-[26px] w-[26px]" aria-hidden="true">
                                <path d="M20.52 3.48A11.77 11.77 0 0 0 12.04 0C5.48 0 .16 5.32.16 11.87c0 2.09.55 4.12 1.6 5.93L0 24l6.37-1.67a11.9 11.9 0 0 0 5.67 1.44h.01c6.56 0 11.87-5.32 11.87-11.87 0-3.17-1.23-6.15-3.4-8.42ZM12.05 21.8h-.01a9.9 9.9 0 0 1-5.04-1.38l-.36-.22-3.77.99 1-3.67-.23-.38a9.86 9.86 0 0 1-1.51-5.28c0-5.45 4.44-9.88 9.89-9.88 2.64 0 5.13 1.03 7 2.9a9.84 9.84 0 0 1 2.9 6.99c0 5.45-4.44 9.93-9.87 9.93Zm5.43-7.42c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15s-.77.97-.94 1.17c-.17.2-.35.22-.65.08-.3-.15-1.26-.46-2.4-1.48-.88-.78-1.48-1.75-1.66-2.05-.17-.3-.02-.46.13-.6.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51l-.57-.01c-.2 0-.52.07-.79.37-.27.3-1.03 1-1.03 2.44s1.06 2.83 1.21 3.03c.15.2 2.09 3.2 5.07 4.48 2.98 1.28 2.98.85 3.52.8.54-.05 1.76-.72 2-1.42.25-.7.25-1.3.17-1.42-.07-.12-.27-.2-.57-.35Z"/>
                            </svg>
                        </a>
                    </div>

                    {{-- Related --}}
                    @if($related->isNotEmpty())
                    <hr class="catalog-border-soft my-8 border-t">

                    <p class="catalog-text font-['Plus_Jakarta_Sans',sans-serif] text-[1.25rem] font-bold">Terkait</p>

                    <div class="mt-5 space-y-5">
                        @foreach($related as $rel)
                        <a href="{{ route('blog.show', $rel->slug) }}" class="group flex items-start gap-4">
                            <div class="shrink-0 overflow-hidden rounded-[10px]">
                                <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}"
                                     class="h-[100px] w-[130px] object-cover transition duration-300 group-hover:scale-105">
                            </div>
                            <div class="flex-1 pt-1">
                                <h4 class="catalog-text font-['Plus_Jakarta_Sans',sans-serif] text-[0.95rem] font-bold leading-snug group-hover:underline line-clamp-3">
                                    {{ Str::limit($rel->title, 60) }}
                                </h4>
                                <div class="catalog-text-muted mt-2 flex items-center gap-2 font-['Inter',sans-serif] text-[0.78rem] font-semibold">
                                    <span>{{ $rel->category }}</span>
                                    <span class="h-[5px] w-[5px] rounded-full bg-current"></span>
                                    <span>{{ $rel->display_date }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </aside>
            </div>

        </main>

        <x-site-footer class="mt-24" />
    </div>
</body>
</html>
