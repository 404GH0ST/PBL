@props(['class' => '', 'contact' => null, 'fallback' => []])

@php
    $title = data_get($contact, 'title') ?: data_get($fallback, 'title', 'Hubungi Kami');
    $email = data_get($contact, 'email') ?: data_get($fallback, 'email', 'deenhag@gmail.com');
    $phone = data_get($contact, 'phone_number') ?: data_get($contact, 'whatsapp_number') ?: data_get($fallback, 'phone_number', '+62 23456789123');
    $address = data_get($contact, 'address') ?: data_get($fallback, 'address', '03240 Desa, Kecamatan, Ponorogo, Jawa Timur, Indonesia');
    $googleMapsUrl = data_get($contact, 'google_maps_url') ?: data_get($fallback, 'google_maps_url');
    $facebookUrl = data_get($contact, 'facebook_url') ?: data_get($fallback, 'facebook_url', '#');
    $instagramUrl = data_get($contact, 'instagram_url') ?: data_get($fallback, 'instagram_url', '#');
    $twitterUrl = data_get($contact, 'twitter_url') ?: data_get($fallback, 'twitter_url', '#');
    $tiktokUrl = data_get($contact, 'tiktok_url') ?: data_get($fallback, 'tiktok_url', '#');
@endphp

<section {{ $attributes->merge(['class' => "relative z-10 mx-auto w-full max-w-[1280px] px-5 md:px-8 lg:px-14 {$class}"]) }}>
    <h1 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-[2rem] font-bold tracking-[-0.02em] md:text-[2.4rem]">
        {{ $title }}
    </h1>

    <div class="mt-8 grid gap-10 lg:mt-10 lg:grid-cols-[1fr_1fr] lg:gap-16">
        {{-- Left: Contact Form --}}
        <form action="#" method="POST" class="space-y-4">
            @csrf
            <div>
                <input
                    type="text"
                    name="nama"
                    placeholder="Nama"
                    required
                    class="contact-input w-full rounded-md px-4 py-3 font-['Inter',sans-serif] text-[0.9rem]"
                >
            </div>

            <div>
                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                    class="contact-input w-full rounded-md px-4 py-3 font-['Inter',sans-serif] text-[0.9rem]"
                >
            </div>

            <div>
                <textarea
                    name="pesan"
                    placeholder="Pesan"
                    rows="5"
                    required
                    class="contact-input w-full resize-none rounded-md px-4 py-3 font-['Inter',sans-serif] text-[0.9rem]"
                ></textarea>
            </div>

            <div class="flex justify-end">
                <button
                    type="submit"
                    class="contact-btn rounded-md px-8 py-2.5 font-['Inter',sans-serif] text-[0.88rem] font-semibold transition-opacity"
                >
                    Kirim
                </button>
            </div>
        </form>

        {{-- Right: Contact Info --}}
        <div class="space-y-7">
            {{-- Email Kami --}}
            <div>
                <h3 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-[1rem] font-bold">
                    Email Kami
                </h3>
                <p class="contact-text-soft mt-1 font-['Inter',sans-serif] text-[0.88rem]">
                    {{ $email }}
                </p>
            </div>

            {{-- Hubungi Kami --}}
            <div>
                <h3 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-[1rem] font-bold">
                    Hubungi Kami
                </h3>
                <p class="contact-text-soft mt-1 font-['Inter',sans-serif] text-[0.88rem]">
                    {{ $phone }}
                </p>
            </div>

            {{-- Mengikuti --}}
            <div>
                <h3 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-[1rem] font-bold">
                    Mengikuti
                </h3>
                <div class="mt-2 flex items-center gap-2">
                    <a href="{{ $facebookUrl }}" aria-label="Facebook" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/facebook.png') }}" alt="" class="contact-social-icon h-7 w-7 object-contain">
                    </a>
                    <a href="{{ $instagramUrl }}" aria-label="Instagram" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/instagram.png') }}" alt="" class="contact-social-icon h-7 w-7 object-contain">
                    </a>
                    <a href="{{ $twitterUrl }}" aria-label="Twitter" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/twitter.png') }}" alt="" class="contact-social-icon h-7 w-7 object-contain">
                    </a>
                    <a href="{{ $tiktokUrl }}" aria-label="TikTok" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/tiktok.png') }}" alt="" class="contact-social-icon h-7 w-7 object-contain">
                    </a>
                </div>
            </div>

            {{-- Kunjungi Kami --}}
            <div>
                <h3 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-[1rem] font-bold">
                    Kunjungi Kami
                </h3>
                @if ($googleMapsUrl)
                    <a href="{{ $googleMapsUrl }}" target="_blank" rel="noopener" class="contact-text-soft mt-1 block max-w-[20rem] font-['Inter',sans-serif] text-[0.88rem] transition hover:opacity-75">
                        {{ $address }}
                    </a>
                @else
                    <p class="contact-text-soft mt-1 font-['Inter',sans-serif] text-[0.88rem] max-w-[20rem]">
                        {{ $address }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>
