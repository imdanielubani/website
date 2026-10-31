import { gsap } from 'gsap';

/**
 * Lightweight page transitions: a curtain sweeps up before leaving and
 * lifts away on arrival. Real navigation is preserved (history, back
 * button, middle-click, new tabs); only plain left-clicks on internal
 * links are intercepted.
 */
export function initPageTransitions() {
    const curtain = document.querySelector('.page-curtain');
    const root = document.documentElement;
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (!curtain) return;

    if (root.classList.contains('is-transitioning')) {
        gsap.fromTo(
            curtain,
            { scaleY: 1, transformOrigin: 'top' },
            {
                scaleY: 0,
                duration: 0.9,
                ease: 'expo.inOut',
                delay: 0.05,
                onComplete: () => {
                    root.classList.remove('is-transitioning');
                    gsap.set(curtain, { clearProps: 'all' });
                },
            },
        );
    }

    // Returning via the back/forward cache must never show a covered page.
    window.addEventListener('pageshow', (event) => {
        if (event.persisted) {
            root.classList.remove('is-transitioning');
            gsap.set(curtain, { clearProps: 'all' });
        }
    });

    if (reduced) return;

    document.addEventListener('click', (event) => {
        const link = event.target.closest('a[href]');

        if (!link || !shouldTransition(link, event)) return;

        event.preventDefault();

        try {
            sessionStorage.setItem('pt', '1');
        } catch {
            // Without storage the next page simply loads without the curtain.
        }

        gsap.fromTo(
            curtain,
            { scaleY: 0, transformOrigin: 'bottom' },
            { scaleY: 1, duration: 0.6, ease: 'expo.inOut', onComplete: () => (window.location.href = link.href) },
        );
    });
}

function shouldTransition(link, event) {
    if (event.defaultPrevented || event.button !== 0) return false;
    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return false;
    if (link.target && link.target !== '_self') return false;
    if (link.hasAttribute('download') || link.dataset.noTransition !== undefined) return false;

    const url = new URL(link.href, window.location.href);

    if (url.origin !== window.location.origin) return false;
    if (!/^https?:$/.test(url.protocol)) return false;

    // Same-page anchors scroll normally.
    if (url.pathname === window.location.pathname && url.search === window.location.search) return false;

    return true;
}
