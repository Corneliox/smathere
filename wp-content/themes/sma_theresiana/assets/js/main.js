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
     * 2. FEATURED HERO SLIDER (Vanilla CSS Scroll Snap)
     * ============================================================ */
    (function initFeaturedSlider() {
        const slider = document.getElementById('featured-slider');
        if (!slider) return;

        const track = document.getElementById('th-fs-track');
        const prevBtn = document.getElementById('th-fs-prev');
        const nextBtn = document.getElementById('th-fs-next');
        const dotsContainer = document.getElementById('th-fs-dots');
        
        if (!track) return;
        
        const slides = Array.from(track.querySelectorAll('.th-featured-slider__slide'));
        if (slides.length === 0) return;

        // Create dots dynamically
        slides.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.className = 'th-fs-dot' + (i === 0 ? ' active' : '');
            dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
            dot.dataset.index = i;
            dotsContainer.appendChild(dot);
        });

        const dots = Array.from(dotsContainer.querySelectorAll('.th-fs-dot'));

        let currentIndex = 0;
        const maxIndex = slides.length - 1;

        function getScrollAmount() {
            return track.offsetWidth; // snap full width
        }

        function updateDots() {
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === currentIndex);
            });
        }

        function getNearestSlide() {
            return slides.reduce((closest, slide, index) => {
                const distance = Math.abs(slide.offsetLeft - track.scrollLeft);
                const closestDistance = Math.abs(slides[closest].offsetLeft - track.scrollLeft);
                return distance < closestDistance ? index : closest;
            }, 0);
        }

        function goTo(index) {
            if (index < 0) index = maxIndex;
            if (index > maxIndex) index = 0;
            currentIndex = index;

            if (slides[currentIndex]) {
                track.scrollTo({
                    left: slides[currentIndex].offsetLeft,
                    behavior: 'smooth'
                });
            }

            updateDots();
            startAutoplay();
        }

        track.addEventListener('scroll', () => {
            if (isDragging) return;

            const nearest = getNearestSlide();

            if (nearest !== currentIndex) {
                currentIndex = nearest;
                requestAnimationFrame(updateDots);
            }
        }, { passive: true });

        prevBtn?.addEventListener('click', (e) => {
            e.preventDefault();
            goTo(currentIndex - 1);
        });
        
        nextBtn?.addEventListener('click', (e) => {
            e.preventDefault();
            goTo(currentIndex + 1);
        });

        dots.forEach(dot => {
            dot.addEventListener('click', (e) => {
                e.preventDefault();
                goTo(parseInt(dot.dataset.index, 10));
            });
        });

        // ---------- Drag to Scroll Support ----------
        let isDragging = false;
        let startX = 0;
        let scrollLeft = 0;

        const startDrag = (e) => {
            isDragging = true;
            track.style.scrollSnapType = 'none'; // Disable snap during drag
            startX = (e.pageX || e.touches?.[0]?.clientX) - track.offsetLeft;
            scrollLeft = track.scrollLeft;
            track.style.cursor = 'grabbing';
            track.style.userSelect = 'none';
            clearInterval(autoplayTimer); // Pause autoplay
        };

        const onDrag = (e) => {
            if (!isDragging) return;
            const x = (e.pageX || e.touches?.[0]?.clientX) - track.offsetLeft;
            const walk = (x - startX) * 1.5; // Scroll speed multiplier
            track.scrollLeft = scrollLeft - walk;
        };

        const stopDrag = () => {
            if (!isDragging) return;
            isDragging = false;
            track.style.cursor = '';
            track.style.userSelect = '';
            track.style.scrollSnapType = 'x mandatory'; // Restore snap
            
            // Snap to nearest slide based on offset
            currentIndex = getNearestSlide();
            
            goTo(currentIndex);
            
            // Resume autoplay
            startAutoplay();
        };

        track.addEventListener('mousedown', startDrag);
        track.addEventListener('touchstart', startDrag, { passive: true });
        
        window.addEventListener('mousemove', onDrag);
        window.addEventListener('touchmove', onDrag, { passive: true });
        
        window.addEventListener('mouseup', stopDrag);
        window.addEventListener('touchend', stopDrag);

        // Autoplay
        let autoplayTimer;
        function startAutoplay() {
            clearInterval(autoplayTimer);
            autoplayTimer = setInterval(() => {
                goTo(currentIndex + 1);
            }, 5000);
        }
        
        startAutoplay();

        slider.addEventListener('mouseenter', () => clearInterval(autoplayTimer));
        slider.addEventListener('mouseleave', startAutoplay);
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
        
        let currentLeft = 0;
        
        function scrollTrackBy(direction) {
            const amount = getScrollAmount();
            const maxScroll = track.scrollWidth - track.clientWidth;
            currentLeft = track.scrollLeft + (direction * amount);
            if (currentLeft < 0) currentLeft = 0;
            if (currentLeft > maxScroll) currentLeft = maxScroll;
            track.scrollTo({ left: currentLeft, behavior: 'smooth' });
        }

        prev?.addEventListener('click', () => scrollTrackBy(-1));
        next?.addEventListener('click', () => scrollTrackBy(1));

        // ---------- Drag to Scroll Support ----------
        let isDragging = false;
        let dragStartX = 0;
        let dragScrollLeft = 0;

        const startDrag = (e) => {
            isDragging = true;
            track.style.scrollSnapType = 'none'; // Disable snap
            dragStartX = (e.pageX || e.touches?.[0]?.clientX) - track.offsetLeft;
            dragScrollLeft = track.scrollLeft;
            track.style.cursor = 'grabbing';
            track.style.userSelect = 'none';
        };

        const onDrag = (e) => {
            if (!isDragging) return;
            const x = (e.pageX || e.touches?.[0]?.clientX) - track.offsetLeft;
            const walk = (x - dragStartX) * 1.5;
            track.scrollLeft = dragScrollLeft - walk;
        };

        const stopDrag = () => {
            if (!isDragging) return;
            isDragging = false;
            track.style.cursor = '';
            track.style.userSelect = '';
            track.style.scrollSnapType = ''; // Restore snap
            
            const amount = getScrollAmount();
            const snapped = Math.round(track.scrollLeft / amount) * amount;
            track.scrollTo({ left: snapped, behavior: 'smooth' });
            currentLeft = snapped;
        };

        track.addEventListener('mousedown', startDrag);
        track.addEventListener('touchstart', startDrag, { passive: true });

        window.addEventListener('mousemove', onDrag);
        window.addEventListener('touchmove', onDrag, { passive: true });

        window.addEventListener('mouseup', stopDrag);
        window.addEventListener('touchend', stopDrag);

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
