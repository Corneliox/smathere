/**
 * SMA Theresiana – main.js
 * Vanilla JavaScript (no jQuery, no external dependencies)
 * ============================================================
 */

document.addEventListener('DOMContentLoaded', () => {

    /* ============================================================
     * 1. STICKY HEADER
     * ============================================================ */
    const header = document.querySelector('.th-header');
    window.addEventListener('scroll', () => {
        header?.classList.toggle('scrolled', window.scrollY > 60);
    }, { passive: true });


    /* ============================================================
     * 2. HERO SLIDER
     * ============================================================ */
    (function initHeroSlider() {
        const hero   = document.querySelector('.th-hero');
        if (!hero) return;

        const slides = Array.from(hero.querySelectorAll('.th-hero__slide'));
        const dots   = Array.from(hero.querySelectorAll('.th-hero__dot'));
        const arrows = {
            prev: hero.querySelector('.th-hero__arrow--prev'),
            next: hero.querySelector('.th-hero__arrow--next'),
        };

        if (!slides.length) return;

        let current  = 0;
        let timer    = null;
        const DELAY  = 5500;

        function goTo(index) {
            slides[current].classList.remove('active');
            dots[current]?.classList.remove('active');
            dots[current]?.removeAttribute('aria-current');

            current = (index + slides.length) % slides.length;

            slides[current].classList.add('active');
            if (dots[current]) {
                dots[current].classList.add('active');
                dots[current].setAttribute('aria-current', 'true');
            }
        }

        function startTimer() {
            clearInterval(timer);
            timer = setInterval(() => goTo(current + 1), DELAY);
        }

        function stopTimer() {
            clearInterval(timer);
        }

        // Initialise first slide
        goTo(0);
        startTimer();

        // Pause on hover
        hero.addEventListener('mouseenter', stopTimer);
        hero.addEventListener('mouseleave', startTimer);

        // Dots
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                goTo(i);
                startTimer();
            });
        });

        // Arrow buttons
        arrows.prev?.addEventListener('click', () => { goTo(current - 1); startTimer(); });
        arrows.next?.addEventListener('click', () => { goTo(current + 1); startTimer(); });
    })();


    /* ============================================================
     * 3. MOBILE MENU
     * ============================================================ */
    (function initMobileMenu() {
        const hamburger = document.getElementById('th-hamburger');
        const mobileNav = document.getElementById('th-mobile-nav');
        const overlay   = document.getElementById('th-mobile-overlay');
        const closeBtn  = document.getElementById('th-mobile-close');
        if (!hamburger || !mobileNav) return;

        function openMenu() {
            mobileNav.classList.add('open');
            mobileNav.setAttribute('aria-hidden', 'false');
            hamburger.classList.add('is-open');
            hamburger.setAttribute('aria-expanded', 'true');
            overlay?.classList.add('visible');
            document.body.classList.add('nav-open');
        }

        function closeMenu() {
            mobileNav.classList.remove('open');
            mobileNav.setAttribute('aria-hidden', 'true');
            hamburger.classList.remove('is-open');
            hamburger.setAttribute('aria-expanded', 'false');
            overlay?.classList.remove('visible');
            document.body.classList.remove('nav-open');
        }

        hamburger.addEventListener('click', () => {
            mobileNav.classList.contains('open') ? closeMenu() : openMenu();
        });

        closeBtn?.addEventListener('click', closeMenu);
        overlay?.addEventListener('click', closeMenu);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeMenu();
        });

        // Close on any nav link click
        mobileNav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeMenu);
        });
    })();


    /* ============================================================
     * 4. NEWS SLIDER (horizontal drag + touch + arrow buttons)
     * ============================================================ */
    (function initNewsSlider() {
        const wrap  = document.querySelector('.th-news__slider');
        const track = document.querySelector('.th-news__track');
        const prev  = document.querySelector('.th-news__prev');
        const next  = document.querySelector('.th-news__next');
        if (!track) return;

        // Card width = first child width + gap
        function getScrollAmount() {
            const card = track.querySelector('.th-news__card');
            if (!card) return 320;
            const style = window.getComputedStyle(track);
            const gap   = parseFloat(style.columnGap || style.gap) || 24;
            return card.offsetWidth + gap;
        }

        prev?.addEventListener('click', () => {
            track.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' });
        });

        next?.addEventListener('click', () => {
            track.scrollBy({ left: getScrollAmount(), behavior: 'smooth' });
        });

        // ---------- Touch support ----------
        let touchStartX = 0;
        let touchStartScrollLeft = 0;

        track.addEventListener('touchstart', (e) => {
            touchStartX = e.touches[0].clientX;
            touchStartScrollLeft = track.scrollLeft;
        }, { passive: true });

        track.addEventListener('touchmove', (e) => {
            const dx = touchStartX - e.touches[0].clientX;
            track.scrollLeft = touchStartScrollLeft + dx;
        }, { passive: true });

        track.addEventListener('touchend', () => {
            const amount = getScrollAmount();
            const snapped = Math.round(track.scrollLeft / amount) * amount;
            track.scrollTo({ left: snapped, behavior: 'smooth' });
        }, { passive: true });

        // ---------- Mouse drag support ----------
        let isDragging = false;
        let dragStartX = 0;
        let dragScrollLeft = 0;

        track.addEventListener('mousedown', (e) => {
            isDragging      = true;
            dragStartX      = e.pageX - track.offsetLeft;
            dragScrollLeft  = track.scrollLeft;
            track.style.cursor = 'grabbing';
            track.style.userSelect = 'none';
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            const x   = e.pageX - track.offsetLeft;
            const walk = (x - dragStartX) * 1.2;
            track.scrollLeft = dragScrollLeft - walk;
        });

        document.addEventListener('mouseup', () => {
            if (!isDragging) return;
            isDragging = false;
            track.style.cursor = '';
            track.style.userSelect = '';
            const amount  = getScrollAmount();
            const snapped = Math.round(track.scrollLeft / amount) * amount;
            track.scrollTo({ left: snapped, behavior: 'smooth' });
        });

        // Show/hide arrow buttons based on scroll position
        function updateArrows() {
            if (!prev || !next) return;
            prev.disabled = track.scrollLeft <= 0;
            next.disabled = track.scrollLeft + track.clientWidth >= track.scrollWidth - 2;
        }

        track.addEventListener('scroll', updateArrows, { passive: true });
        updateArrows();
    })();


    /* ============================================================
     * 5. INTERSECTION OBSERVER – Scroll Animations
     * ============================================================ */
    (function initScrollAnimations() {
        if (!('IntersectionObserver' in window)) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.th-reveal').forEach(el => observer.observe(el));
    })();


    /* ============================================================
     * 6. SMOOTH SCROLL – Anchor links
     * ============================================================ */
    (function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener('click', e => {
                const href = link.getAttribute('href');
                if (!href || href === '#') return;
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    })();


    /* ============================================================
     * 7. ACTIVE MENU ITEM ON SCROLL (one-page sections)
     * ============================================================ */
    (function initActiveMenuOnScroll() {
        if (!('IntersectionObserver' in window)) return;

        // Collect sections that have matching menu links
        const menuLinks = Array.from(document.querySelectorAll('.th-menu .th-menu__link[href*="#"]'));
        if (!menuLinks.length) return;

        const sectionMap = new Map(); // section el → link el

        menuLinks.forEach(link => {
            const href = link.getAttribute('href');
            const hash = href.includes('#') ? '#' + href.split('#').pop() : null;
            if (!hash) return;
            const section = document.querySelector(hash);
            if (section) sectionMap.set(section, link);
        });

        if (!sectionMap.size) return;

        function setActive(link) {
            menuLinks.forEach(l => l.classList.remove('active'));
            link?.classList.add('active');
        }

        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const link = sectionMap.get(entry.target);
                    if (link) setActive(link);
                }
            });
        }, {
            threshold: 0.5,
            rootMargin: '0px 0px -10% 0px',
        });

        sectionMap.forEach((_, section) => sectionObserver.observe(section));
    })();


    /* ============================================================
     * 8. BETA MODE — Persist ?beta=1 on all internal links
     * ============================================================ */
    (() => {
        const origin = window.location.origin;
        function addBetaParam(link) {
            try {
                const url = new URL(link.href, origin);
                if (url.origin !== origin) return;
                if (url.searchParams.get('beta') === '1') return;
                if (link.classList.contains('exit-beta-widget')) return;
                url.searchParams.set('beta', '1');
                link.href = url.toString();
            } catch (_) {}
        }
        document.querySelectorAll('a[href]').forEach(addBetaParam);
        if (typeof MutationObserver !== 'undefined') {
            new MutationObserver((mutations) => {
                mutations.forEach((m) => {
                    m.addedNodes.forEach((node) => {
                        if (node.nodeType !== 1) return;
                        if (node.tagName === 'A') addBetaParam(node);
                        node.querySelectorAll && node.querySelectorAll('a[href]').forEach(addBetaParam);
                    });
                });
            }).observe(document.body, { childList: true, subtree: true });
        }
    })();

    /* ============================================================
     * 9. DARK MODE TOGGLE
     * ============================================================ */
    (function initDarkMode() {
        const toggleBtn = document.getElementById('th-theme-toggle');
        if (!toggleBtn) return;
        
        // Check local storage for preference
        const savedTheme = localStorage.getItem('th-theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
            toggleBtn.innerHTML = '<i class="fa fa-moon-o" aria-hidden="true"></i>';
        }

        toggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            
            // Toggle Icon
            toggleBtn.innerHTML = isDark 
                ? '<i class="fa fa-moon-o" aria-hidden="true"></i>' 
                : '<i class="fa fa-sun-o" aria-hidden="true"></i>';
                
            // Save preference
            localStorage.setItem('th-theme', isDark ? 'dark' : 'light');
        });
    })();

    /* ============================================================
     * 10. HIDDEN ADMIN LINK (3 CLICKS)
     * ============================================================ */
    (function initHiddenAdminLink() {
        const adminLink = document.querySelector('.th-admin-hidden-link');
        if (!adminLink) return;
        
        let clickCount = 0;
        let clickTimeout;
        
        adminLink.addEventListener('click', (e) => {
            e.preventDefault();
            clickCount++;
            clearTimeout(clickTimeout);
            
            if (clickCount >= 3) {
                window.location.href = adminLink.href;
            } else {
                clickTimeout = setTimeout(() => {
                    clickCount = 0; // Reset after 1 second if not enough clicks
                }, 1000);
            }
        });
    })();

}); // end DOMContentLoaded
