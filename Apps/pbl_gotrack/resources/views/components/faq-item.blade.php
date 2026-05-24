@props(['question' => '', 'answer' => ''])

<details class="group space-y-2">
    <summary class="list-none cursor-pointer [&::-webkit-details-marker]:hidden">
        <h3 class="contact-faq-question font-['Plus_Jakarta_Sans',sans-serif] text-[0.95rem] font-bold leading-snug">
            {{ $question }}
        </h3>
    </summary>
    <div class="contact-faq-answer font-['Inter',sans-serif] text-[0.85rem] leading-relaxed">
        {!! str($answer)->sanitizeHtml() !!}
    </div>
</details>
