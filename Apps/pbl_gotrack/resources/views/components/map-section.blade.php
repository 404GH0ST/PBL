@props(['class' => '', 'contact' => null])

@php
    $googleMapsEmbedUrl = data_get($contact, 'google_maps_embed_url');
    $title = data_get($contact, 'title', 'Deenhag');
@endphp

<section {{ $attributes->merge(['class' => "relative z-10 mx-auto w-full max-w-[1280px] px-5 md:px-8 lg:px-14 {$class}"]) }}>
    @if ($googleMapsEmbedUrl)
        <div class="overflow-hidden rounded-lg">
            <iframe
                src="{{ $googleMapsEmbedUrl }}"
                class="h-[280px] w-full border-0 md:h-[340px] lg:h-[400px]"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi {{ $title }} di Google Maps"
            ></iframe>
        </div>
    @else
        <div class="contact-border contact-text-soft flex h-[280px] items-center justify-center rounded-lg border px-5 text-center font-['Inter',sans-serif] text-sm font-semibold md:h-[340px] lg:h-[400px]">
            Lokasi belum dikonfigurasi di CMS.
        </div>
    @endif
</section>
