@props(['class' => 'mt-[-1rem]'])

<footer {{ $attributes->merge(['class' => "site-footer {$class} overflow-hidden pt-24 pb-10"]) }}>
    <div class="mx-auto max-w-[1300px] px-5 md:px-8 lg:px-14">
        <div class="grid gap-14 lg:grid-cols-[1.45fr_0.8fr_0.85fr_1fr]">
            <div class="max-w-[26rem]">
                <div class="flex items-center gap-4">
                    <span class="block h-11 w-11 rounded-full bg-white/85"></span>
                    <span class="font-['Montserrat',sans-serif] text-[1.95rem] font-bold text-white">Deenhag</span>
                </div>

                <p class="mt-8 text-[0.92rem] leading-[1.7] text-white/78">
                    Kami melayani kebutuhan konveksi dan digital printing untuk personal, komunitas, maupun bisnis, mulai dari apparel custom, media promosi, hingga kebutuhan cetak usaha dengan kualitas yang rapi dan terpercaya.
                </p>

                <div class="mt-8 flex items-center gap-2.5">
                    <a href="#" aria-label="Facebook" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/facebook.png') }}" alt="" class="h-9 w-9 object-contain">
                    </a>
                    <a href="#" aria-label="Twitter" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/twitter.png') }}" alt="" class="h-9 w-9 object-contain">
                    </a>
                    <a href="#" aria-label="TikTok" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/tiktok.png') }}" alt="" class="h-9 w-9 object-contain">
                    </a>
                    <a href="#" aria-label="Instagram" class="transition hover:opacity-75">
                        <img src="{{ asset('images/footer/instagram.png') }}" alt="" class="h-9 w-9 object-contain">
                    </a>
                </div>
            </div>

            <div>
                <h3 class="font-['Montserrat',sans-serif] text-[1.2rem] font-bold text-[#72a3bf]">Navigasi Cepat</h3>
                <div class="mt-8 space-y-5 text-[0.92rem] font-medium tracking-[0.04em] text-white/85">
                    <a href="{{ route('home') }}" class="block transition hover:opacity-75">Beranda</a>
                    <a href="{{ route('catalog') }}" class="block transition hover:opacity-75">Katalog</a>
                    <a href="#" class="block transition hover:opacity-75">Blog</a>
                    <a href="#" class="block transition hover:opacity-75">Keranjang</a>
                    <a href="{{ route('tracking.index') }}" class="block transition hover:opacity-75">Lacak Pesanan</a>
                </div>
            </div>

            <div>
                <h3 class="font-['Montserrat',sans-serif] text-[1.2rem] font-bold text-[#72a3bf]">Layanan Kami</h3>
                <div class="mt-8 space-y-5 text-[0.92rem] font-medium tracking-[0.04em] text-white/85">
                    <p>Konveksi Apparel</p>
                    <p>Media Promosi</p>
                    <p>Cetak DTF</p>
                    <p>Kebutuhan Bisnis</p>
                </div>
            </div>

            <div>
                <h3 class="font-['Montserrat',sans-serif] text-[1.2rem] font-bold text-[#72a3bf]">Hubungi Kami</h3>
                <div class="mt-8 space-y-4 text-[0.92rem] font-medium tracking-[0.04em] text-white/85">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/footer/whatsapp.png') }}" alt="" class="h-7 w-7 object-contain">
                        <span>+62 23456789123</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/footer/email.png') }}" alt="" class="h-7 w-7 object-contain">
                        <span>deenhag@gmail.com</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/footer/address.png') }}" alt="" class="h-7 w-7 object-contain">
                        <span>Ponorogo, Indonesia</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 border-t pt-6 text-center text-[0.9rem] text-[var(--site-footer-copy)]" style="border-color: var(--site-footer-border);">
            © 2026 Deenhag. All rights reserved.
        </div>
    </div>
</footer>
