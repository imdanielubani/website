import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import focus from '@alpinejs/focus';

import siteHeader from './components/site-header';
import cookieConsent from './components/cookie-consent';
import inquiryForm from './components/inquiry-form';
import { renderIcons } from './icons';
import { initAnimations } from './animations';
import { initPageTransitions } from './page-transitions';

Alpine.plugin(collapse);
Alpine.plugin(focus);

Alpine.data('siteHeader', siteHeader);
Alpine.data('cookieConsent', cookieConsent);
Alpine.data('inquiryForm', inquiryForm);

window.Alpine = Alpine;
Alpine.start();

renderIcons();
initPageTransitions();

// Wait for fonts so split-text lines are measured with the final typeface.
(document.fonts?.ready ?? Promise.resolve()).then(() => initAnimations());
