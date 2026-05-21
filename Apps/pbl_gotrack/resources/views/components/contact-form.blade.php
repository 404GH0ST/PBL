@props(['class' => ''])

<section {{ $attributes->merge(['class' => "relative z-10 mx-auto w-full max-w-[1280px] px-5 md:px-8 lg:px-14 {$class}"]) }}>
    <h1 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-[2rem] font-bold tracking-[-0.02em] md:text-[2.4rem]">
        Hubungi Kami
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
                    deenhag@gmail.com
                </p>
            </div>

            {{-- Hubungi Kami --}}
            <div>
                <h3 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-[1rem] font-bold">
                    Hubungi Kami
                </h3>
                <p class="contact-text-soft mt-1 font-['Inter',sans-serif] text-[0.88rem]">
                    +62 23456789123
                </p>
            </div>

            {{-- Mengikuti --}}
            <div>
                <h3 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-[1rem] font-bold">
                    Mengikuti
                </h3>
                <div class="mt-2 flex items-center gap-2">
                    <a href="#" aria-label="Facebook" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/facebook.png') }}" alt="" class="contact-social-icon h-7 w-7 object-contain">
                    </a>
                    <a href="#" aria-label="Instagram" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/instagram.png') }}" alt="" class="contact-social-icon h-7 w-7 object-contain">
                    </a>
                    <a href="#" aria-label="Twitter" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/twitter.png') }}" alt="" class="contact-social-icon h-7 w-7 object-contain">
                    </a>
                    <a href="#" aria-label="TikTok" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/tiktok.png') }}" alt="" class="contact-social-icon h-7 w-7 object-contain">
                    </a>
                </div>
            </div>

            {{-- Kunjungi Kami --}}
            <div>
                <h3 class="contact-heading font-['Plus_Jakarta_Sans',sans-serif] text-[1rem] font-bold">
                    Kunjungi Kami
                </h3>
                <p class="contact-text-soft mt-1 font-['Inter',sans-serif] text-[0.88rem] max-w-[20rem]">
                    03240 Desa, Kecamatan, Ponorogo, Jawa Timur, Indonesia
                </p>
            </div>
        </div>
    </div>
</section>
