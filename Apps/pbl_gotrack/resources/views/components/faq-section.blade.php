@props(['faqs' => [], 'class' => ''])

<section {{ $attributes->merge(['class' => "relative z-10 mx-auto w-full max-w-[1280px] px-5 md:px-8 lg:px-14 {$class}"]) }}>
    <h2 class="contact-faq-title text-center font-['Plus_Jakarta_Sans',sans-serif] text-[2rem] font-bold tracking-[-0.02em] md:text-[2.2rem]">
        F.A.Q
    </h2>

    <div class="mt-10 grid gap-x-12 gap-y-8 md:grid-cols-2 lg:mt-12">
        @foreach ($faqs as $faq)
            <x-faq-item :question="data_get($faq, 'question')" :answer="data_get($faq, 'answer')" />
        @endforeach
    </div>
</section>
