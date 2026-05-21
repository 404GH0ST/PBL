<script>
    (() => {
        const storedTheme = window.localStorage.getItem('site-theme');
        const theme = storedTheme === 'dark' || storedTheme === 'light'
            ? storedTheme
            : (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

        document.documentElement.dataset.siteTheme = theme;
        document.documentElement.style.colorScheme = theme;
    })();
</script>
