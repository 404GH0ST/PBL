@props(['class' => '', 'contact' => null, 'fallback' => []])

@php
    $googleMapsEmbedUrl = data_get($contact, 'google_maps_embed_url') ?: data_get($fallback, 'google_maps_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63267.53399981368!2d111.4172!3d-7.8684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79a0348daa7b05%3A0x301576d14feb980!2sPonorogo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid');
    $title = data_get($contact, 'title') ?: data_get($fallback, 'title', 'Deenhag');
@endphp

<section {{ $attributes->merge(['class' => "relative z-10 mx-auto w-full max-w-[1280px] px-5 md:px-8 lg:px-14 {$class}"]) }}>
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
</section>
