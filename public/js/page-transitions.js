(function () {
    'use strict';

    /* ── Respect users who have opted out of animation ────────────── */
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    /* ── State ─────────────────────────────────────────────────────── */
    var isTransitioning = false;
    var ANIMATION_DURATION = 480;          // ms — matches CSS transition
    var ENTER_DURATION = 500;             // ms — enter animation cleanup

    /* ── Helpers ───────────────────────────────────────────────────── */

    function getBodyBgColor() {
        var bg = getComputedStyle(document.body).backgroundColor;
        if (!bg || bg === 'rgba(0, 0, 0, 0)' || bg === 'transparent') {
            var el = document.body;
            while (el) {
                bg = getComputedStyle(el).backgroundColor;
                if (bg && bg !== 'rgba(0, 0, 0, 0)' && bg !== 'transparent') {
                    return bg;
                }
                el = el.parentElement;
            }
            return '#ffffff';
        }
        return bg;
    }

    function isSameSiteOrigin(href) {
        try {
            var url = new URL(href, window.location.href);
            return url.origin === window.location.origin;
        } catch (e) {
            return false;
        }
    }

    function shouldInterceptLink(link) {
        if (!link || link.tagName !== 'A') return false;
        if (isTransitioning) return false;

        var href = link.getAttribute('href');
        if (!href || href === '#' || href.charAt(0) === '#') return false;
        if (href.indexOf('javascript:') === 0) return false;
        if (href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0) return false;
        if (link.download) return false;
        if (link.target === '_blank') return false;
        if (link.hasAttribute('data-bs-toggle')) return false;
        if (link.hasAttribute('data-bs-dismiss')) return false;
        if (!isSameSiteOrigin(href)) return false;
        if (link.href === window.location.href) return false;

        return true;
    }

    /* ── Overlay — the book page that folds ────────────────────────── */

    function createOverlay() {
        var overlay = document.createElement('div');
        overlay.className = 'pt-overlay';
        overlay.style.setProperty('--pt-bg-color', getBodyBgColor());

        var left = document.createElement('div');
        left.className = 'pt-left';

        var right = document.createElement('div');
        right.className = 'pt-right';

        var spine = document.createElement('div');
        spine.className = 'pt-spine';

        overlay.appendChild(left);
        overlay.appendChild(right);
        overlay.appendChild(spine);

        document.body.appendChild(overlay);

        /* Lock scroll so the underlying page doesn't shift */
        var scrollY = window.scrollY;
        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.top = -scrollY + 'px';
        document.body.style.width = '100%';

        /* Trigger the fold animation on next frame */
        requestAnimationFrame(function () {
            right.classList.add('pt-folding');
        });

        return { overlay: overlay, right: right, scrollY: scrollY };
    }

    function removeOverlay(parts) {
        if (parts && parts.overlay && parts.overlay.parentNode) {
            parts.overlay.parentNode.removeChild(parts.overlay);
        }
        document.body.style.overflow = '';
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.width = '';
        window.scrollTo(0, parts ? parts.scrollY : 0);
        isTransitioning = false;
    }

    /* ── Exit animation — fold the overlay then navigate ───────────── */

    function animateExit(callback) {
        var parts = createOverlay();
        var done = false;

        function finish() {
            if (done) return;
            done = true;

            /* Remove the overlay, then navigate so the new page loads cleanly */
            removeOverlay(parts);
            callback();
        }

        /* Listen for the CSS transition end on the folding half */
        function onTransitionEnd(e) {
            if (e.propertyName !== 'transform') return;
            parts.right.removeEventListener('transitionend', onTransitionEnd);
            finish();
        }
        parts.right.addEventListener('transitionend', onTransitionEnd);

        /* Safety-net timeout in case transitionend doesn't fire */
        setTimeout(finish, ANIMATION_DURATION + 200);
    }

    /* ── Enter animation — new page content fades / lifts in ───────── */

    function runEnterAnimation() {
        /* Only animate when the visitor arrived via our transition system */
        var cameFromTransition = false;
        try {
            cameFromTransition = sessionStorage.getItem('pt_navigating') === 'true';
        } catch (e) {
            /* sessionStorage may be unavailable in private mode */
        }
        if (!cameFromTransition) return;
        try { sessionStorage.removeItem('pt_navigating'); } catch (e) { }

        var content = document.querySelector('.pt-content');
        if (!content) return;

        content.classList.add('pt-enter-anim');
        requestAnimationFrame(function () {
            content.classList.add('pt-enter-anim-active');
        });

        setTimeout(function () {
            content.classList.remove('pt-enter-anim', 'pt-enter-anim-active');
        }, ENTER_DURATION);
    }

    /* ── Click handler — intercept navigation links ────────────────── */

    function handleLinkClick(e) {
        /* Only left-clicks without modifier keys */
        if (e.button !== 0) return;
        if (e.ctrlKey || e.metaKey || e.shiftKey || e.altKey) return;

        var link = e.target.closest('a');
        if (!shouldInterceptLink(link)) return;

        e.preventDefault();
        sessionStorage.setItem('pt_navigating', 'true');
        isTransitioning = true;

        animateExit(function () {
            window.location.href = link.href;
        });
    }

    /* ── Submit handler — intercept form submissions ───────────────── */

    function handleFormSubmit(e) {
        /* If the form's own onsubmit (e.g. confirm()) cancelled, do nothing */
        if (e.defaultPrevented) return;

        var form = e.target;
        if (!form || form.tagName !== 'FORM') return;

        e.preventDefault();
        sessionStorage.setItem('pt_navigating', 'true');
        isTransitioning = true;

        animateExit(function () {
            form.submit();
        });
    }

    /* ── Initialization ─────────────────────────────────────────────── */

    document.addEventListener('click', handleLinkClick);
    document.addEventListener('submit', handleFormSubmit);

    /* Enter animation on load */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', runEnterAnimation);
    } else {
        runEnterAnimation();
    }

    /* Handle bfcache restoration (Back/Forward cache) */
    window.addEventListener('pageshow', function (e) {
        if (e.persisted) {
            isTransitioning = false;
            runEnterAnimation();
        }
    });
})();
