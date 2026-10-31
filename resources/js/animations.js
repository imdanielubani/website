import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { SplitText } from 'gsap/SplitText';

gsap.registerPlugin(ScrollTrigger, SplitText);

const EASE = 'expo.out';

/**
 * Declarative scroll and entrance animations.
 *
 * All content is visible in the HTML. Hidden start states are applied here
 * (via gsap.from) so nothing disappears if JavaScript fails, and every
 * animation is skipped for visitors who prefer reduced motion.
 *
 *   data-hero              hero wrapper: image settles in, heading lines rise
 *   data-split             heading revealed line by line on scroll
 *   data-reveal            fade + rise on scroll ("up" default, "fade", "clip")
 *   data-stagger           children revealed in sequence
 *   data-parallax="12"     image drifts by n % of its height while scrolling
 *   data-count="2016"      number counts up (verified figures only)
 *   data-marquee           horizontal band moved by scroll position
 */
export function initAnimations() {
    const mm = gsap.matchMedia();

    mm.add('(prefers-reduced-motion: no-preference)', () => {
        hero();
        splitHeadings();
        reveals();
        staggers();
        parallax();
        counters();
        marquees();
        footerWord();

        ScrollTrigger.refresh();
    });
}

function hero() {
    document.querySelectorAll('[data-hero]').forEach((hero) => {
        const tl = gsap.timeline({ defaults: { ease: EASE }, delay: document.documentElement.classList.contains('is-transitioning') ? 0.45 : 0.1 });
        const media = hero.querySelector('[data-hero-media]');
        const title = hero.querySelector('[data-hero-title]');
        const items = hero.querySelectorAll('[data-hero-item]');

        if (media) {
            tl.from(media, { scale: 1.14, duration: 2.4, ease: 'power3.out' }, 0);
        }

        if (title) {
            const split = SplitText.create(title, { type: 'lines', linesClass: 'split-line', mask: 'lines' });
            tl.from(split.lines, { yPercent: 110, duration: 1.4, stagger: 0.09 }, 0.2);
        }

        if (items.length) {
            tl.from(items, { y: 28, autoAlpha: 0, duration: 1.2, stagger: 0.08 }, 0.55);
        }

        // Gentle parallax on the hero image as the page scrolls away.
        if (media) {
            gsap.to(media, {
                yPercent: 12,
                ease: 'none',
                scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: true },
            });
        }
    });
}

function splitHeadings() {
    document.querySelectorAll('[data-split]').forEach((el) => {
        const split = SplitText.create(el, { type: 'lines', linesClass: 'split-line', mask: 'lines' });

        gsap.from(split.lines, {
            yPercent: 105,
            duration: 1.25,
            ease: EASE,
            stagger: 0.08,
            scrollTrigger: { trigger: el, start: 'top 88%', once: true },
        });
    });
}

function reveals() {
    document.querySelectorAll('[data-reveal]').forEach((el) => {
        const type = el.dataset.reveal || 'up';
        const delay = parseFloat(el.dataset.delay || 0);
        const scrollTrigger = { trigger: el, start: 'top 90%', once: true };

        if (type === 'clip') {
            const img = el.querySelector('img');
            gsap.from(el, { clipPath: 'inset(100% 0% 0% 0%)', duration: 1.6, ease: 'expo.inOut', delay, scrollTrigger });
            if (img) gsap.from(img, { scale: 1.25, duration: 2, ease: EASE, delay, scrollTrigger });
            return;
        }

        if (type === 'fade') {
            gsap.from(el, { autoAlpha: 0, duration: 1.4, ease: 'power2.out', delay, scrollTrigger });
            return;
        }

        gsap.from(el, { y: 40, autoAlpha: 0, duration: 1.2, ease: EASE, delay, scrollTrigger });
    });
}

function staggers() {
    document.querySelectorAll('[data-stagger]').forEach((group) => {
        gsap.from(group.children, {
            y: 36,
            autoAlpha: 0,
            duration: 1.1,
            ease: EASE,
            stagger: 0.09,
            scrollTrigger: { trigger: group, start: 'top 88%', once: true },
        });
    });
}

function parallax() {
    document.querySelectorAll('[data-parallax]').forEach((el) => {
        const amount = parseFloat(el.dataset.parallax || 10);

        gsap.fromTo(
            el,
            { yPercent: -amount / 2, scale: 1 + amount / 100 },
            {
                yPercent: amount / 2,
                ease: 'none',
                scrollTrigger: { trigger: el.parentElement, start: 'top bottom', end: 'bottom top', scrub: true },
            },
        );
    });
}

function counters() {
    document.querySelectorAll('[data-count]').forEach((el) => {
        const target = parseInt(el.dataset.count, 10);
        const from = parseInt(el.dataset.countFrom || 0, 10);
        const state = { value: from };

        gsap.to(state, {
            value: target,
            duration: 2.2,
            ease: 'power3.out',
            scrollTrigger: { trigger: el, start: 'top 90%', once: true },
            onUpdate: () => (el.textContent = Math.round(state.value).toString()),
        });
    });
}

function marquees() {
    document.querySelectorAll('[data-marquee]').forEach((band) => {
        const track = band.querySelector('.marquee-track');
        const direction = band.dataset.marquee === 'right' ? 1 : -1;

        gsap.fromTo(
            track,
            { xPercent: direction > 0 ? -30 : 0 },
            {
                xPercent: direction > 0 ? 0 : -30,
                ease: 'none',
                scrollTrigger: { trigger: band, start: 'top bottom', end: 'bottom top', scrub: 0.6 },
            },
        );
    });
}

function footerWord() {
    const word = document.querySelector('[data-footer-word]');

    if (!word) return;

    gsap.from(word, {
        yPercent: 40,
        ease: 'none',
        scrollTrigger: { trigger: word, start: 'top bottom', end: 'bottom bottom', scrub: true },
    });
}
