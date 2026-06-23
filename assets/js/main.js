(function() {
    'use strict';

    // Header scroll effect
    const header = document.getElementById('ec-header');
    function handleScroll() {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
    window.addEventListener('scroll', handleScroll);
    handleScroll();

    // Mobile menu toggle
    const menuToggle = document.getElementById('ec-menu-toggle');
    const mainNav = document.getElementById('ec-main-nav');
    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            const isOpen = mainNav.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            const spans = menuToggle.querySelectorAll('span');
            if (isOpen) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Close mobile menu if open
                if (mainNav && mainNav.classList.contains('active')) {
                    mainNav.classList.remove('active');
                    if (menuToggle) {
                        menuToggle.setAttribute('aria-expanded', 'false');
                        const spans = menuToggle.querySelectorAll('span');
                        spans[0].style.transform = 'none';
                        spans[1].style.opacity = '1';
                        spans[2].style.transform = 'none';
                    }
                }
            }
        });
    });

    // Intersection Observer for animations
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('ec-animate');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.ec-service-card, .ec-ministry-card, .ec-sermon-card, .ec-testimony-card, .ec-event-item, .ec-pillar-card, .ec-blog-card, .ec-tcard, .ec-belief-card').forEach(function(el) {
        observer.observe(el);
    });

    // Animated stat counters (About section). Counts up once on first view.
    const prefersReducedMotion = window.matchMedia &&
        window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const counters = document.querySelectorAll('.ec-stat-num[data-count-to]');
    if (counters.length) {
        const runCount = function(el) {
            const target = parseInt(el.getAttribute('data-count-to'), 10) || 0;
            const suffix = el.getAttribute('data-count-suffix') || '';
            if (prefersReducedMotion) {
                el.textContent = target + suffix;
                return;
            }
            const duration = 1400;
            const start = performance.now();
            const step = function(now) {
                const progress = Math.min((now - start) / duration, 1);
                // easeOutCubic for a settled finish
                const eased = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.round(eased * target) + suffix;
                if (progress < 1) {
                    requestAnimationFrame(step);
                }
            };
            requestAnimationFrame(step);
        };

        const countObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    runCount(entry.target);
                    countObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.4 });

        counters.forEach(function(el) {
            countObserver.observe(el);
        });
    }

    // Gallery lightbox
    const lightbox = document.getElementById('ec-lightbox');
    const galleryItems = Array.prototype.slice.call(document.querySelectorAll('.ec-gallery-item[data-lightbox]'));
    if (lightbox && galleryItems.length) {
        const lbImg = lightbox.querySelector('.ec-lightbox-img');
        const lbCap = lightbox.querySelector('.ec-lightbox-caption');
        const slides = galleryItems.map(function(a) {
            return { src: a.getAttribute('href'), caption: a.getAttribute('data-caption') || '' };
        });
        let current = 0;

        const show = function(i) {
            current = (i + slides.length) % slides.length;
            lbImg.setAttribute('src', slides[current].src);
            lbImg.setAttribute('alt', slides[current].caption);
            lbCap.textContent = slides[current].caption;
        };
        const open = function(i) {
            show(i);
            lightbox.classList.add('is-open');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        };
        const close = function() {
            lightbox.classList.remove('is-open');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        };

        galleryItems.forEach(function(a, i) {
            a.addEventListener('click', function(e) {
                e.preventDefault();
                open(i);
            });
        });
        lightbox.querySelector('.ec-lightbox-close').addEventListener('click', close);
        lightbox.querySelector('.ec-lightbox-prev').addEventListener('click', function() { show(current - 1); });
        lightbox.querySelector('.ec-lightbox-next').addEventListener('click', function() { show(current + 1); });
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) { close(); }
        });
        document.addEventListener('keydown', function(e) {
            if (!lightbox.classList.contains('is-open')) { return; }
            if (e.key === 'Escape') { close(); }
            else if (e.key === 'ArrowLeft') { show(current - 1); }
            else if (e.key === 'ArrowRight') { show(current + 1); }
        });
    }

    // Sermon video modal — play Facebook / YouTube / Vimeo videos in-page.
    // Falls back to the link's normal behaviour (opens in a new tab) when the
    // URL can't be turned into an embed or when JS is unavailable.
    const videoModal = document.getElementById('ec-video-modal');
    if (videoModal) {
        const frameHost = videoModal.querySelector('.ec-video-modal-frame');
        const vmClose   = videoModal.querySelector('.ec-video-modal-close');

        const makeIframe = function(src) {
            const f = document.createElement('iframe');
            f.setAttribute('src', src);
            f.setAttribute('allow', 'autoplay; fullscreen; clipboard-write; encrypted-media; picture-in-picture; web-share');
            f.setAttribute('allowfullscreen', 'true');
            f.setAttribute('frameborder', '0');
            f.setAttribute('scrolling', 'no');
            return f;
        };

        // Turn a video page URL into an embeddable iframe src, or return null.
        const embedSrc = function(url) {
            let u;
            try { u = new URL(url, window.location.href); } catch (err) { return null; }
            const host = u.hostname.toLowerCase();

            if (host.indexOf('facebook.com') !== -1 || host.indexOf('fb.watch') !== -1 || host.indexOf('fb.me') !== -1) {
                // Pull a numeric video id out of the common URL shapes and rebuild a
                // clean canonical link (drops tracking params / slugs that make the
                // Facebook player report "video unavailable"). Falls back to the raw
                // URL for share/fb.watch tokens that have no embeddable id.
                var fbId = null;
                var m = u.pathname.match(/\/videos\/(?:[^\/]+\/)?(\d+)/) ||
                        u.pathname.match(/\/reel\/(\d+)/);
                if (m) { fbId = m[1]; }
                if (!fbId) {
                    var v = u.searchParams.get('v'); // watch/?v= and video.php?v=
                    if (v && /^\d+$/.test(v)) { fbId = v; }
                }
                var href = fbId ? ('https://www.facebook.com/watch/?v=' + fbId) : url;
                return 'https://www.facebook.com/plugins/video.php?href=' + encodeURIComponent(href) + '&show_text=false&autoplay=true';
            }
            if (host.indexOf('youtube.com') !== -1) {
                const id = u.searchParams.get('v');
                if (id) { return 'https://www.youtube.com/embed/' + id + '?autoplay=1'; }
            }
            if (host.indexOf('youtu.be') !== -1) {
                const id = u.pathname.replace(/^\/+/, '').split('/')[0];
                if (id) { return 'https://www.youtube.com/embed/' + id + '?autoplay=1'; }
            }
            if (host.indexOf('vimeo.com') !== -1) {
                const seg = u.pathname.split('/').filter(Boolean);
                const id = seg.length ? seg[seg.length - 1] : '';
                if (/^\d+$/.test(id)) { return 'https://player.vimeo.com/video/' + id + '?autoplay=1'; }
            }
            return null;
        };

        const openVideo = function(url) {
            const src = embedSrc(url);
            if (!src) { return false; }
            frameHost.innerHTML = '';
            frameHost.appendChild(makeIframe(src));
            videoModal.classList.add('is-open');
            videoModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            return true;
        };
        const closeVideo = function() {
            videoModal.classList.remove('is-open');
            videoModal.setAttribute('aria-hidden', 'true');
            frameHost.innerHTML = '';
            document.body.style.overflow = '';
        };

        document.querySelectorAll('.ec-sermon-play-btn, .ec-sermon-play').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                const url = btn.getAttribute('href');
                if (!url || url === '#') { return; }
                if (openVideo(url)) { e.preventDefault(); }
            });
        });

        vmClose.addEventListener('click', closeVideo);
        videoModal.addEventListener('click', function(e) { if (e.target === videoModal) { closeVideo(); } });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && videoModal.classList.contains('is-open')) { closeVideo(); }
        });
    }

})();