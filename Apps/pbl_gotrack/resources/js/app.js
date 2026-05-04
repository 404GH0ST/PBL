import './bootstrap';

import Alpine from 'alpinejs';

Alpine.data('homePageMotion', () => ({
    activeService: null,
    activeTestimonial: 0,
    cleanup: null,
    floatingJerseyStyle: '',
    frameRequested: false,
    menuOpen: false,
    shouldAnimateHeroJersey:
        typeof window !== 'undefined'
        && window.matchMedia('(min-width: 1024px)').matches
        && !window.matchMedia('(prefers-reduced-motion: reduce)').matches,
    testimonials: [
        {
            avatar: '/images/testimonials/ajeng-febria.png',
            name: 'Ajeng Febria',
            quote: 'Bahan sangat bagus,\nnext akan beli lagi',
            rating: 5,
        },
        {
            avatar: '/images/testimonials/fahrul-kz.png',
            name: 'Fahrul Kz',
            quote: 'print sangat jelas\ndan tajam,\nLove U',
            rating: 4,
        },
        {
            avatar: 'https://i.pravatar.cc/96?img=44',
            name: 'Maudy Ayunda',
            quote: 'Wah bahannya bagus\nbanget, saya menjadi\nsangat cantik',
            rating: 5,
        },
        {
            avatar: 'https://i.pravatar.cc/96?img=15',
            name: 'Jefri Nichol',
            quote: 'Kaosnya keren saya\njadi tampan seperti\nfahrul',
            rating: 5,
        },
        {
            avatar: 'https://i.pravatar.cc/96?img=47',
            name: 'Pevita Pearce',
            quote: '"kpan" beli lagi deh\nsuka banget dengan\nplatfrom ini',
            rating: 4,
        },
    ],

    init() {
        const desktopMediaQuery = window.matchMedia('(min-width: 1024px)');
        const reducedMotionMediaQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

        const updateAnimationMode = () => {
            this.shouldAnimateHeroJersey = desktopMediaQuery.matches && !reducedMotionMediaQuery.matches;
            this.queueFloatingJerseyUpdate();
        };

        const queueUpdate = () => {
            this.queueFloatingJerseyUpdate();
        };

        desktopMediaQuery.addEventListener('change', updateAnimationMode);
        reducedMotionMediaQuery.addEventListener('change', updateAnimationMode);
        window.addEventListener('resize', queueUpdate);
        window.addEventListener('scroll', queueUpdate, { passive: true });

        this.cleanup = () => {
            desktopMediaQuery.removeEventListener('change', updateAnimationMode);
            reducedMotionMediaQuery.removeEventListener('change', updateAnimationMode);
            window.removeEventListener('resize', queueUpdate);
            window.removeEventListener('scroll', queueUpdate);
        };

        this.$nextTick(() => {
            updateAnimationMode();
        });
    },

    destroy() {
        this.cleanup?.();
    },

    clamp(value, min, max) {
        return Math.min(Math.max(value, min), max);
    },

    lerp(start, end, progress) {
        return start + ((end - start) * progress);
    },

    setActiveService(index) {
        this.activeService = index;
    },

    resetActiveService() {
        this.activeService = null;
    },

    previousTestimonial() {
        if (this.activeTestimonial <= 0) {
            return;
        }

        this.activeTestimonial -= 1;
    },

    nextTestimonial() {
        if (this.activeTestimonial >= this.testimonials.length - 1) {
            return;
        }

        this.activeTestimonial += 1;
    },

    setActiveTestimonial(index) {
        this.activeTestimonial = this.clamp(Number(index), 0, this.testimonials.length - 1);
    },

    currentTestimonial() {
        return this.testimonials[this.activeTestimonial] ?? null;
    },

    previousTestimonialData() {
        if (this.activeTestimonial <= 0) {
            return null;
        }

        return this.testimonials[this.activeTestimonial - 1] ?? null;
    },

    nextTestimonialData() {
        if (this.activeTestimonial >= this.testimonials.length - 1) {
            return null;
        }

        return this.testimonials[this.activeTestimonial + 1] ?? null;
    },

    queueFloatingJerseyUpdate() {
        if (this.frameRequested) {
            return;
        }

        this.frameRequested = true;

        requestAnimationFrame(() => {
            this.frameRequested = false;
            this.updateFloatingJersey();
        });
    },

    updateFloatingJersey() {
        if (!this.shouldAnimateHeroJersey) {
            this.floatingJerseyStyle = 'display: none;';

            return;
        }

        const heroAnchor = this.$refs.heroJerseyStart?.getBoundingClientRect();
        const aboutAnchor = this.$refs.aboutJerseyEnd?.getBoundingClientRect();

        if (!heroAnchor || !aboutAnchor) {
            this.floatingJerseyStyle = 'display: none;';

            return;
        }

        if (heroAnchor.height < 10 || aboutAnchor.height < 10) {
            this.floatingJerseyStyle = 'display: none;';

            return;
        }

        const heroAnchorTop = window.scrollY + heroAnchor.top;
        const aboutAnchorTop = window.scrollY + aboutAnchor.top;
        const scrollStart = heroAnchorTop - (window.innerHeight * 0.18);
        const scrollEnd = aboutAnchorTop - (window.innerHeight * 0.46);
        const progress = this.clamp((window.scrollY - scrollStart) / Math.max(scrollEnd - scrollStart, 1), 0, 1);

        const left = this.lerp(heroAnchor.left, aboutAnchor.left, progress);
        const top = this.lerp(heroAnchor.top, aboutAnchor.top, progress);
        const width = this.lerp(heroAnchor.width, aboutAnchor.width, progress);

        this.floatingJerseyStyle = [
            'display: block',
            `left: ${left}px`,
            `top: ${top}px`,
            `width: ${width}px`,
            'transform: translate3d(0, 0, 0)',
        ].join('; ');
    },
}));

Alpine.data('catalogPage', (products = [], filters = []) => ({
    currentPage: 1,
    filters,
    perPage: 12,
    products,
    searchTerm: '',
    selectedFilter: 'all',
    syncSystemThemeHandler: null,
    systemThemeQuery: null,
    theme: 'light',

    init() {
        this.systemThemeQuery = window.matchMedia('(prefers-color-scheme: dark)');
        this.syncSystemThemeHandler = this.syncSystemTheme.bind(this);
        this.initializeTheme();
        this.normalizePage();

        this.systemThemeQuery.addEventListener('change', this.syncSystemThemeHandler);
    },

    destroy() {
        this.systemThemeQuery?.removeEventListener('change', this.syncSystemThemeHandler);
    },

    filteredProducts() {
        const term = this.searchTerm.trim().toLowerCase();

        return this.products.filter((product) => {
            const matchesTerm = !term
                || product.title.toLowerCase().includes(term)
                || product.category_label.toLowerCase().includes(term);

            if (!matchesTerm) {
                return false;
            }

            if (this.selectedFilter === 'all') {
                return true;
            }

            if (this.selectedFilter === 'new') {
                return Boolean(product.is_new);
            }

            if (this.selectedFilter === 'top') {
                return Boolean(product.is_top);
            }

            return product.category === this.selectedFilter;
        });
    },

    paginatedProducts() {
        const filtered = this.filteredProducts();
        const start = (this.currentPage - 1) * this.perPage;

        return filtered.slice(start, start + this.perPage);
    },

    featuredProducts() {
        return this.products.filter((product) => product.featured).slice(0, 4);
    },

    pageNumbers() {
        return Array.from({ length: this.totalPages() }, (_, index) => index + 1);
    },

    totalPages() {
        return Math.max(1, Math.ceil(this.filteredProducts().length / this.perPage));
    },

    setFilter(filter) {
        this.selectedFilter = filter;
        this.currentPage = 1;
    },

    clearSearch() {
        this.searchTerm = '';
        this.currentPage = 1;
    },

    initializeTheme() {
        const savedTheme = window.localStorage.getItem('catalog-theme');

        if (savedTheme === 'light' || savedTheme === 'dark') {
            this.theme = savedTheme;

            return;
        }

        this.theme = this.systemThemeQuery.matches ? 'dark' : 'light';
    },

    syncSystemTheme(event) {
        if (window.localStorage.getItem('catalog-theme')) {
            return;
        }

        this.theme = event.matches ? 'dark' : 'light';
    },

    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        window.localStorage.setItem('catalog-theme', this.theme);
    },

    previousPage() {
        this.currentPage = Math.max(1, this.currentPage - 1);
    },

    nextPage() {
        this.currentPage = Math.min(this.totalPages(), this.currentPage + 1);
    },

    goToPage(page) {
        this.currentPage = Math.min(Math.max(Number(page), 1), this.totalPages());
    },

    normalizePage() {
        this.currentPage = Math.min(this.currentPage, this.totalPages());
    },

    hasProducts() {
        return this.filteredProducts().length > 0;
    },

    formatPrice(price) {
        return new Intl.NumberFormat('id-ID').format(price);
    },

    reviewLabel(product) {
        return `${product.rating.toFixed(1)} (${product.reviews}) Reviews`;
    },

    filterIcon(icon) {
        const icons = {
            banner: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 4h10v16l-5-3-5 3V4Z"/><path d="M15 6h4v12l-4-2.4"/></svg>',
            dots: '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="6" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="18" cy="12" r="2"/></svg>',
            grid: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="4" y="4" width="6" height="6" rx="1.5"/><rect x="14" y="4" width="6" height="6" rx="1.5"/><rect x="4" y="14" width="6" height="6" rx="1.5"/><rect x="14" y="14" width="6" height="6" rx="1.5"/></svg>',
            jersey: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="m8 6 1.8-2h4.4L16 6l3 1.6-1.8 4.2-2.2-1.1V20H9v-9.3l-2.2 1.1L5 7.6 8 6Z"/></svg>',
            printer: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M7 9V4h10v5"/><rect x="4" y="9" width="16" height="8" rx="2"/><path d="M7 14h10v6H7z"/><path d="M16 12h.01"/></svg>',
            spark: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="m12 3 1.5 4.5L18 9l-4.5 1.5L12 15l-1.5-4.5L6 9l4.5-1.5L12 3Z"/><path d="m19 15 .7 2.3L22 18l-2.3.7L19 21l-.7-2.3L16 18l2.3-.7L19 15Z"/></svg>',
            shirt: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="m9 4 3 2 3-2 3 2.5-1.7 4.1-2.3-1.1V20H10V9.5L7.7 10.6 6 6.5 9 4Z"/></svg>',
            trophy: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M8 4h8v3a4 4 0 0 1-8 0V4Z"/><path d="M8 5H5a2 2 0 0 0 2 4h1"/><path d="M16 5h3a2 2 0 0 1-2 4h-1"/><path d="M12 11v4"/><path d="M9 21h6"/><path d="M10 15h4v6h-4z"/></svg>',
        };

        return icons[icon] ?? icons.grid;
    },
}));

window.Alpine = Alpine;

Alpine.start();
