@props(['question' => '', 'answer' => ''])

<details class="faq-accordion group">
    <summary class="flex cursor-pointer list-none items-start justify-between gap-4 [&::-webkit-details-marker]:hidden">
        <h3 class="contact-faq-question font-['Plus_Jakarta_Sans',sans-serif] text-[0.95rem] font-bold leading-snug md:text-[1rem]">
            {{ $question }}
        </h3>
        <span class="faq-accordion-icon mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full border" aria-hidden="true">
            <svg viewBox="0 0 20 20" class="h-4 w-4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="m6 8 4 4 4-4" />
            </svg>
        </span>
    </summary>
    <div class="contact-faq-answer faq-accordion-answer mt-4 font-['Inter',sans-serif] text-[0.85rem] leading-relaxed">
        {!! str($answer)->sanitizeHtml() !!}
    </div>
</details>
