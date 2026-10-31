/**
 * Sticky header: background on scroll, hide on scroll down / reveal on
 * scroll up, hover-intent mega menus and the mobile menu.
 */
export default () => ({
    scrolled: false,
    hidden: false,
    panel: null,
    mobileOpen: false,
    closeTimer: null,
    lastY: 0,

    init() {
        const onScroll = () => {
            const y = window.scrollY;
            this.scrolled = y > 24;
            this.hidden = y > 480 && y > this.lastY;
            this.lastY = y;
        };

        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });

        // Close the mobile menu when the viewport grows into desktop layout.
        window.matchMedia('(min-width: 1280px)').addEventListener('change', (e) => {
            if (e.matches) this.mobileOpen = false;
        });
    },

    open(index) {
        this.cancelClose();
        this.panel = index;
    },

    toggle(index) {
        this.cancelClose();
        this.panel = this.panel === index ? null : index;
    },

    scheduleClose() {
        this.cancelClose();
        this.closeTimer = setTimeout(() => (this.panel = null), 220);
    },

    cancelClose() {
        clearTimeout(this.closeTimer);
    },

    toggleMobile() {
        this.mobileOpen = !this.mobileOpen;
        this.panel = null;
    },

    closeAll() {
        this.panel = null;
        this.mobileOpen = false;
    },
});
