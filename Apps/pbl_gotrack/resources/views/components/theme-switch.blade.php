@props(['mode' => 'desktop'])

@php
    $extraClass = $mode === 'desktop' ? 'hidden shrink-0 lg:inline-flex' : 'shrink-0';
@endphp

<button
    type="button"
    @click="toggleTheme()"
    :aria-pressed="(theme === 'dark').toString()"
    :aria-label="theme === 'dark' ? 'Aktifkan light mode' : 'Aktifkan dark mode'"
    :data-state="theme"
    class="catalog-theme-switch relative {{ $extraClass }}"
>
    <span class="catalog-theme-thumb" aria-hidden="true"></span>
    <span class="catalog-theme-icon catalog-theme-icon--sun absolute left-[0.625rem] top-[0.625rem]">
        <svg viewBox="0 0 20 20" class="h-5 w-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" aria-hidden="true">
            <circle cx="10" cy="10" r="3.2"></circle>
            <path d="M10 1.9v1.8M10 16.3v1.8M18.1 10h-1.8M3.7 10H1.9M15.73 4.27 14.45 5.55M5.55 14.45l-1.28 1.28M15.73 15.73l-1.28-1.28M5.55 5.55 4.27 4.27"></path>
        </svg>
    </span>
    <span class="catalog-theme-icon catalog-theme-icon--moon absolute left-[3.5rem] top-[0.625rem]">
        <svg viewBox="0 0 20 20" class="h-5 w-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" aria-hidden="true">
            <path d="M12.4 2.35a6.75 6.75 0 1 0 5.25 9.9A6.95 6.95 0 0 1 12.4 2.35Z"></path>
        </svg>
    </span>
</button>
