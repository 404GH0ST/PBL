@props(['question' => '', 'answer' => ''])

<div class="space-y-2">
    <h3 class="contact-faq-question font-['Plus_Jakarta_Sans',sans-serif] text-[0.95rem] font-bold leading-snug">
        {{ $question }}
    </h3>
    <p class="contact-faq-answer font-['Inter',sans-serif] text-[0.85rem] leading-relaxed">
        {{ $answer }}
    </p>
</div>
