const STORAGE_KEY = 'cookie-consent';

const read = () => {
    try {
        return JSON.parse(localStorage.getItem(STORAGE_KEY));
    } catch {
        return null;
    }
};

export default () => ({
    visible: false,
    settings: false,
    analytics: false,

    init() {
        const saved = read();

        if (saved) {
            this.analytics = Boolean(saved.analytics);
        } else {
            setTimeout(() => (this.visible = true), 1200);
        }
    },

    openSettings() {
        this.settings = true;
        this.visible = true;
    },

    store(analytics) {
        const consent = { essential: true, analytics, date: new Date().toISOString() };

        try {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(consent));
        } catch {
            // Storage unavailable (private mode); the choice applies to this page only.
        }

        this.analytics = analytics;
        this.visible = false;
        this.settings = false;
        window.dispatchEvent(new CustomEvent('cookie-consent-updated', { detail: consent }));
    },

    acceptAll() {
        this.store(true);
    },

    essentialOnly() {
        this.store(false);
    },

    save() {
        this.store(this.analytics);
    },
});
