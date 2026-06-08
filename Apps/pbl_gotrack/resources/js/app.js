import './bootstrap';

import Alpine from 'alpinejs';

const getPreferredSiteTheme = () => {
    const savedTheme = window.localStorage.getItem('site-theme');

    if (savedTheme === 'light' || savedTheme === 'dark') {
        return savedTheme;
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
};

const applySiteTheme = (theme) => {
    document.documentElement.dataset.siteTheme = theme;
    document.documentElement.style.colorScheme = theme;
};

const initializePageTransitions = () => {
    if (typeof window === 'undefined') {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const supportsViewTransitions = typeof document.startViewTransition === 'function';
    const transitionStorageKey = 'deenhag-page-transition';

    if (!prefersReducedMotion.matches && !supportsViewTransitions && window.sessionStorage.getItem(transitionStorageKey)) {
        document.documentElement.classList.add('is-page-entering');
        window.sessionStorage.removeItem(transitionStorageKey);

        window.requestAnimationFrame(() => {
            document.documentElement.classList.remove('is-page-entering');
        });
    }

    document.addEventListener('click', (event) => {
        if (
            event.defaultPrevented
            || event.button !== 0
            || event.metaKey
            || event.ctrlKey
            || event.shiftKey
            || event.altKey
            || prefersReducedMotion.matches
            || supportsViewTransitions
        ) {
            return;
        }

        if (!(event.target instanceof Element)) {
            return;
        }

        const link = event.target.closest('a[href]');

        if (!link || link.target || link.hasAttribute('download') || link.closest('[data-no-page-transition]')) {
            return;
        }

        const nextUrl = new URL(link.href, window.location.href);
        const currentUrl = new URL(window.location.href);

        if (nextUrl.origin !== currentUrl.origin || (nextUrl.protocol !== 'http:' && nextUrl.protocol !== 'https:')) {
            return;
        }

        if (
            nextUrl.pathname === currentUrl.pathname
            && nextUrl.search === currentUrl.search
            && nextUrl.hash
        ) {
            return;
        }

        event.preventDefault();
        window.sessionStorage.setItem(transitionStorageKey, '1');
        document.documentElement.classList.add('is-page-leaving');

        window.setTimeout(() => {
            window.location.assign(nextUrl.href);
        }, 170);
    });
};

initializePageTransitions();

Alpine.data('homePageMotion', (initialTestimonials = null, initialServices = []) => ({
    activeFeatureProduct: '01',
    activeService: null,
    activeTestimonial: 0,
    cleanup: null,
    featureAnimationTimer: null,
    featureFloatTimer: null,
    featureMode: 'services',
    featurePhase: 'idle',
    featureSwitchPhase: 'idle',
    featureSwitchTimer: null,
    selectedFeatureProduct: '01',
    floatingJerseyStyle: '',
    frameRequested: false,
    menuOpen: false,
    services: initialServices || [],
    shouldAnimateHeroJersey:
        typeof window !== 'undefined'
        && window.matchMedia('(min-width: 1024px)').matches
        && !window.matchMedia('(prefers-reduced-motion: reduce)').matches,
    testimonials: (initialTestimonials && initialTestimonials.length > 0) ? initialTestimonials : [
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
        window.clearTimeout(this.featureAnimationTimer);
        window.clearTimeout(this.featureFloatTimer);
        window.clearTimeout(this.featureSwitchTimer);
        this.unlockPageScroll();
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

    currentFeatureProduct() {
        const products = {
            '01': {
                title: 'APPAREL',
                description: 'Pembuatan pakaian custom berkualitas tinggi seperti jersey, kaos, kemeja, jaket, dan seragam sesuai desain keinginan Anda.',
                image: '/images/product/konveksi-apparel.png',
            },
            '02': {
                title: 'PROMOSI',
                description: 'Nota custom berkualitas untuk kebutuhan transaksi usaha, toko, dan bisnis dengan hasil cetak yang rapi dan profesional.',
                image: '/images/product/media-promosi.png',
            },
            '03': {
                title: 'CETAK DTF',
                description: 'Cetak stiker sablon DTF (Direct to Film) siap tempel dengan warna solid, detail tajam, dan daya tahan cuci yang luar biasa.',
                image: '/images/product/cetak-dtf.png',
            },
            '04': {
                title: 'BISNIS',
                description: 'Layanan pembuatan stempel custom yang praktis dan profesional untuk menunjang identitas serta kebutuhan administrasi bisnis Anda.',
                image: '/images/product/kebutuhan-bisnis.png',
            },
            'konveksi-apparel': {
                title: 'APPAREL',
                description: 'Pembuatan pakaian custom berkualitas tinggi seperti jersey, kaos, kemeja, jaket, dan seragam sesuai desain keinginan Anda.',
                image: '/images/product/konveksi-apparel.png',
            },
            'media-promosi': {
                title: 'PROMOSI',
                description: 'Nota custom berkualitas untuk kebutuhan transaksi usaha, toko, dan bisnis dengan hasil cetak yang rapi dan profesional.',
                image: '/images/product/media-promosi.png',
            },
            'cetak-dtf': {
                title: 'CETAK DTF',
                description: 'Cetak stiker sablon DTF (Direct to Film) siap tempel dengan warna solid, detail tajam, dan daya tahan cuci yang luar biasa.',
                image: '/images/product/cetak-dtf.png',
            },
            'kebutuhan-bisnis': {
                title: 'BISNIS',
                description: 'Layanan pembuatan stempel custom yang praktis dan profesional untuk menunjang identitas serta kebutuhan administrasi bisnis Anda.',
                image: '/images/product/kebutuhan-bisnis.png',
            },
            nota: {
                title: 'NOTA',
                description: 'Nota custom berkualitas untuk kebutuhan transaksi usaha, toko, dan bisnis dengan hasil cetak yang rapi dan profesional.',
                image: '/images/product/media-promosi.png',
            },
            stempel: {
                title: 'STEMPEL',
                description: 'Layanan pembuatan stempel custom yang praktis dan profesional untuk menunjang identitas serta kebutuhan administrasi bisnis Anda.',
                image: '/images/product/kebutuhan-bisnis.png',
            },
        };

        let product = products[this.activeFeatureProduct] ?? products['01'];

        if (this.services && this.services.length > 0) {
            const matchedService = this.services.find(s => s.number === this.activeFeatureProduct);
            if (matchedService) {
                product = {
                    ...product,
                    title: matchedService.title.toUpperCase(),
                    description: matchedService.description || product.description,
                    image: matchedService.image,
                };
            }
        }

        return product;
    },

    openFeatureProduct(product = '01', event = null) {
        this.activeFeatureProduct = product;
        this.selectedFeatureProduct = product;
        this.featureSwitchPhase = 'idle';
        this.featureMode = 'product';
        this.featurePhase = 'entering';
        this.lockPageScroll();

        window.clearTimeout(this.featureAnimationTimer);
        window.clearTimeout(this.featureFloatTimer);
        window.clearTimeout(this.featureSwitchTimer);
        this.featureAnimationTimer = window.setTimeout(() => {
            this.featurePhase = 'revealing';
        }, 60);
        this.featureFloatTimer = window.setTimeout(() => {
            this.featurePhase = 'settled';
        }, 960);
    },

    closeFeatureProduct() {
        window.clearTimeout(this.featureAnimationTimer);
        window.clearTimeout(this.featureFloatTimer);
        window.clearTimeout(this.featureSwitchTimer);
        this.featurePhase = 'idle';
        this.featureSwitchPhase = 'idle';
        this.featureMode = 'services';
        this.unlockPageScroll();
    },

    selectFeatureProduct(product) {
        if (product === this.activeFeatureProduct || this.featureSwitchPhase !== 'idle') {
            return;
        }

        this.selectedFeatureProduct = product;
        this.featureSwitchPhase = 'leaving';
        window.clearTimeout(this.featureSwitchTimer);

        this.featureSwitchTimer = window.setTimeout(() => {
            this.activeFeatureProduct = product;
            this.featureSwitchPhase = 'entering';

            this.featureSwitchTimer = window.setTimeout(() => {
                this.featureSwitchPhase = 'idle';
            }, 520);
        }, 160);
    },

    featureHeroStyle() {
        if (this.services && this.services.length > 0) {
            const matchedService = this.services.find(s => s.number === this.activeFeatureProduct);
            if (matchedService) {
                const titleLower = matchedService.title.toLowerCase();
                if (titleLower.includes('stempel') || titleLower.includes('bisnis') || matchedService.number === '04') {
                    return '--feature-product-scale: 1.08';
                }
            }
        }
        return `--feature-product-scale: ${this.activeFeatureProduct === 'stempel' || this.activeFeatureProduct === '04' || this.activeFeatureProduct === 'kebutuhan-bisnis' ? '1.08' : '1.18'}`;
    },

    lockPageScroll() {
        document.documentElement.style.overflow = 'hidden';
    },

    unlockPageScroll() {
        document.documentElement.style.overflow = '';
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
    theme: getPreferredSiteTheme(),

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
        this.theme = getPreferredSiteTheme();
        applySiteTheme(this.theme);
    },

    syncSystemTheme(event) {
        if (window.localStorage.getItem('site-theme')) {
            return;
        }

        this.theme = event.matches ? 'dark' : 'light';
        applySiteTheme(this.theme);
    },

    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        window.localStorage.setItem('site-theme', this.theme);
        applySiteTheme(this.theme);
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
            megaphone: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 14a3 3 0 0 1 0-6h3l8-3v12l-8-3H5Z"/><path d="M8 14l1 5H7l-2-5"/><path d="M19 8.5a3.5 3.5 0 0 1 0 5"/></svg>',
            package: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 8.5 12 4l8 4.5v7L12 20l-8-4.5v-7Z"/><path d="m4 8.5 8 4.5 8-4.5"/><path d="M12 13v7"/><path d="m8 6.5 8 4.5"/></svg>',
            photo: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="4" y="5" width="16" height="14" rx="2"/><circle cx="9" cy="10" r="1.7"/><path d="m7 17 3.5-4 2.6 3 1.8-2.1L18 17"/></svg>',
            printer: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M7 9V4h10v5"/><rect x="4" y="9" width="16" height="8" rx="2"/><path d="M7 14h10v6H7z"/><path d="M16 12h.01"/></svg>',
            spark: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="m12 3 1.5 4.5L18 9l-4.5 1.5L12 15l-1.5-4.5L6 9l4.5-1.5L12 3Z"/><path d="m19 15 .7 2.3L22 18l-2.3.7L19 21l-.7-2.3L16 18l2.3-.7L19 15Z"/></svg>',
            shirt: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="m9 4 3 2 3-2 3 2.5-1.7 4.1-2.3-1.1V20H10V9.5L7.7 10.6 6 6.5 9 4Z"/></svg>',
            briefcase: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M9 7V5.8C9 4.8 9.8 4 10.8 4h2.4c1 0 1.8.8 1.8 1.8V7"/><rect x="4" y="7" width="16" height="12" rx="2"/><path d="M4 12h16"/><path d="M10 12v1h4v-1"/></svg>',
            cube: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3.5 19 7.5v8.9l-7 4.1-7-4.1V7.5l7-4Z"/><path d="M5 7.5 12 11.6l7-4.1"/><path d="M12 11.6v8.9"/></svg>',
            store: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 10h14l-1-5H6l-1 5Z"/><path d="M6 10v9h12v-9"/><path d="M9 19v-5h6v5"/><path d="M4 10c0 1.2 1 2 2 2s2-.8 2-2c0 1.2 1 2 2 2s2-.8 2-2c0 1.2 1 2 2 2s2-.8 2-2c0 1.2 1 2 2 2s2-.8 2-2"/></svg>',
            swatch: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M7 4h4v13a3 3 0 1 1-6 0V6a2 2 0 0 1 2-2Z"/><path d="m11 7 3-3 3 3-9.2 9.2"/><path d="M17 10h3v5a2 2 0 0 1-2 2H8"/><circle cx="8" cy="17" r=".5" fill="currentColor"/></svg>',
            trophy: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M8 4h8v3a4 4 0 0 1-8 0V4Z"/><path d="M8 5H5a2 2 0 0 0 2 4h1"/><path d="M16 5h3a2 2 0 0 1-2 4h-1"/><path d="M12 11v4"/><path d="M9 21h6"/><path d="M10 15h4v6h-4z"/></svg>',
        };

        return icons[icon] ?? icons.grid;
    },
}));

Alpine.data('trackingPage', ({ initialModalOpen = false } = {}) => ({
    rating: 0,
    reviewComment: '',
    reviewModalOpen: initialModalOpen,
    syncSystemThemeHandler: null,
    systemThemeQuery: null,
    theme: getPreferredSiteTheme(),

    init() {
        this.systemThemeQuery = window.matchMedia('(prefers-color-scheme: dark)');
        this.syncSystemThemeHandler = this.syncSystemTheme.bind(this);
        this.initializeTheme();

        this.systemThemeQuery.addEventListener('change', this.syncSystemThemeHandler);
    },

    destroy() {
        this.systemThemeQuery?.removeEventListener('change', this.syncSystemThemeHandler);
    },

    initializeTheme() {
        this.theme = getPreferredSiteTheme();
        applySiteTheme(this.theme);
    },

    syncSystemTheme(event) {
        if (window.localStorage.getItem('site-theme')) {
            return;
        }

        this.theme = event.matches ? 'dark' : 'light';
        applySiteTheme(this.theme);
    },

    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        window.localStorage.setItem('site-theme', this.theme);
        applySiteTheme(this.theme);
    },

    openReviewModal() {
        this.reviewModalOpen = true;
    },

    closeReviewModal() {
        this.reviewModalOpen = false;
    },

    setRating(value) {
        this.rating = Number(value);
    },
}));

Alpine.data('themePage', () => ({
    syncSystemThemeHandler: null,
    systemThemeQuery: null,
    theme: getPreferredSiteTheme(),

    init() {
        this.systemThemeQuery = window.matchMedia('(prefers-color-scheme: dark)');
        this.syncSystemThemeHandler = this.syncSystemTheme.bind(this);
        this.initializeTheme();

        this.systemThemeQuery.addEventListener('change', this.syncSystemThemeHandler);
    },

    destroy() {
        this.systemThemeQuery?.removeEventListener('change', this.syncSystemThemeHandler);
    },

    initializeTheme() {
        this.theme = getPreferredSiteTheme();
        applySiteTheme(this.theme);
    },

    syncSystemTheme(event) {
        if (window.localStorage.getItem('site-theme')) {
            return;
        }

        this.theme = event.matches ? 'dark' : 'light';
        applySiteTheme(this.theme);
    },

    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        window.localStorage.setItem('site-theme', this.theme);
        applySiteTheme(this.theme);
    },
}));

Alpine.data('productDetailPage', ({
    gallery = [],
    order = {},
    productName = '',
    reviews = [],
    breakdown = [],
} = {}) => ({
    activeImage: gallery[0] ?? '',
    activeTab: 'deskripsi',
    breakdown,
    expandedReviews: false,
    gallery,
    mobileMenuOpen: false,
    order,
    productName,
    quantity: 1,
    reviews,
    selectedOptions: {},
    sortOption: 'latest',
    syncSystemThemeHandler: null,
    systemThemeQuery: null,
    theme: getPreferredSiteTheme(),

    init() {
        this.systemThemeQuery = window.matchMedia('(prefers-color-scheme: dark)');
        this.syncSystemThemeHandler = this.syncSystemTheme.bind(this);
        this.initializeTheme();
        this.systemThemeQuery.addEventListener('change', this.syncSystemThemeHandler);
    },

    destroy() {
        this.systemThemeQuery?.removeEventListener('change', this.syncSystemThemeHandler);
    },

    setActiveImage(image) {
        this.activeImage = image;
    },

    incrementQuantity() {
        this.quantity += 1;
    },

    decrementQuantity() {
        if (this.quantity > 1) {
            this.quantity -= 1;
        }
    },

    selectOption(type, name) {
        if (this.selectedOptions[type] === name) {
            delete this.selectedOptions[type];
            return;
        }

        this.selectedOptions[type] = name;
    },

    isOptionSelected(type, name) {
        return this.selectedOptions[type] === name;
    },

    hasOrderWhatsApp() {
        return Boolean(String(this.order.whatsappNumber ?? '').replace(/\D/g, ''));
    },

    orderWhatsAppUrl() {
        const number = String(this.order.whatsappNumber ?? '').replace(/\D/g, '');

        if (!number) {
            return '#';
        }

        const selectedOptions = Object.entries(this.selectedOptions);
        const lines = [
            'Halo Deenhag, saya ingin pesan produk berikut:',
            '',
            `Produk: ${this.order.productName ?? this.productName}`,
            `Kategori: ${this.order.category ?? '-'}`,
            `Harga: ${this.order.price ?? '-'}`,
            `Jumlah: ${this.quantity}`,
        ];

        if (selectedOptions.length > 0) {
            lines.push('Opsi:');
            selectedOptions.forEach(([type, value]) => {
                lines.push(`- ${type}: ${value}`);
            });
        }

        lines.push(
            `Link produk: ${this.order.url ?? window.location.href}`,
            '',
            'Mohon info langkah pemesanan selanjutnya.'
        );

        return `https://wa.me/${number}?text=${encodeURIComponent(lines.join('\n'))}`;
    },

    setTab(tab) {
        this.activeTab = tab;
    },

    toggleExpandedReviews() {
        this.expandedReviews = !this.expandedReviews;
    },

    sortedReviews() {
        const sorted = [...this.reviews];

        if (this.sortOption === 'latest') {
            return sorted;
        }

        if (this.sortOption === 'oldest') {
            return sorted.reverse();
        }

        if (this.sortOption === 'highest') {
            return sorted.sort((a, b) => b.rating - a.rating);
        }

        return sorted;
    },

    visibleReviews() {
        const sorted = this.sortedReviews();

        if (this.expandedReviews) {
            return sorted;
        }

        return sorted.slice(0, 3);
    },

    reviewSummary() {
        const total = this.reviews.length;

        if (total === 0) {
            return 'Belum ada ulasan';
        }

        const visible = this.expandedReviews ? total : Math.min(3, total);

        return `Menampilkan dari 1-${visible} dari ${total} hasil`;
    },

    initializeTheme() {
        this.theme = getPreferredSiteTheme();
        applySiteTheme(this.theme);
    },

    syncSystemTheme(event) {
        if (window.localStorage.getItem('site-theme')) {
            return;
        }

        this.theme = event.matches ? 'dark' : 'light';
        applySiteTheme(this.theme);
    },

    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        window.localStorage.setItem('site-theme', this.theme);
        applySiteTheme(this.theme);
    },

    starLabel(rating) {
        return '★'.repeat(Math.round(rating)) + '☆'.repeat(5 - Math.round(rating));
    },
}));

window.Alpine = Alpine;

// Cross-tab theme sync: if theme changes in another tab, update the current page
window.addEventListener('storage', (event) => {
    if (event.key !== 'site-theme') return;
    if (event.newValue !== 'light' && event.newValue !== 'dark') return;

    applySiteTheme(event.newValue);

    document.querySelectorAll('[x-data]').forEach((el) => {
        const stack = el._x_dataStack;
        if (stack && stack[0] && 'theme' in stack[0]) {
            stack[0].theme = event.newValue;
        }
    });
});

Alpine.start();
