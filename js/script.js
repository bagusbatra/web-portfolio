/* Modern Technical Portfolio JS */

document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Typing Effect for Hero Section
    const typingText = document.getElementById('typing-text');
    const phrases = [
        "Membangun Solusi Digital yang Elegan.",
        "Junior Web Programmer.",
        "Antusias dengan Teknologi Modern.",
        "Fokus pada Kode yang Bersih."
    ];
    let phraseIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typeSpeed = 80;

    function type() {
        const currentPhrase = phrases[phraseIndex];
        
        if (isDeleting) {
            typingText.textContent = currentPhrase.substring(0, charIndex - 1);
            charIndex--;
            typeSpeed = 40;
        } else {
            typingText.textContent = currentPhrase.substring(0, charIndex + 1);
            charIndex++;
            typeSpeed = 80;
        }

        if (!isDeleting && charIndex === currentPhrase.length) {
            isDeleting = true;
            typeSpeed = 2500; // Pause at end
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            phraseIndex = (phraseIndex + 1) % phrases.length;
            typeSpeed = 500;
        }

        setTimeout(type, typeSpeed);
    }

    if (typingText) type();

    // 2. Smooth Scrolling for Navbar Links
    const navLinks = document.querySelectorAll('.navbar-nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                window.scrollTo({
                    top: targetSection.offsetTop - 80,
                    behavior: 'smooth'
                });
                
                // Close mobile menu if open
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
            }
        });
    });

    // 3. Navbar Background Change on Scroll
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // 4. Reveal Animations on Scroll
    const revealElements = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    });

    revealElements.forEach(el => revealObserver.observe(el));

    // 5. Contact Form Submission (Mock PHP)
    const contactForm = document.getElementById('contactForm');
    const responseMessage = document.getElementById('responseMessage');
    const submitBtn = document.getElementById('submitBtn');

    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            submitBtn.disabled = true;
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = 'Mengirim... <span class="spinner-border spinner-border-sm ms-2"></span>';
            
            const inputs = contactForm.querySelectorAll('input, textarea');
            const data = {};
            inputs.forEach(input => {
                data[input.placeholder.toLowerCase()] = input.value;
            });

            try {
                const response = await fetch('/contact.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.status === 'success') {
                    responseMessage.textContent = result.message;
                    responseMessage.className = 'mt-4 text-center alert alert-success glass text-white border-success border-opacity-20';
                    responseMessage.classList.remove('d-none');
                    contactForm.reset();
                } else {
                    throw new Error();
                }
            } catch (error) {
                responseMessage.textContent = 'Terjadi kesalahan. Silakan coba lagi nanti.';
                responseMessage.className = 'mt-4 text-center alert alert-danger glass text-white border-danger border-opacity-20';
                responseMessage.classList.remove('d-none');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }

    // 6. Active Nav Link on Scroll / Page Load
    const sections = document.querySelectorAll('section, header');
    const currentPath = window.location.pathname;

    function updateActiveLink() {
        let current = '';
        
        // If on about.html or projects.html, set corresponding link as active
        if (currentPath.includes('about.html')) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes('about.html')) {
                    link.classList.add('active');
                }
            });
            return;
        }

        if (currentPath.includes('projects.html')) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes('projects.html')) {
                    link.classList.add('active');
                }
            });
            return;
        }

        if (currentPath.includes('articles.html')) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes('articles.html')) {
                    link.classList.add('active');
                }
            });
            return;
        }

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop - 150) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').includes(current) && current !== '') {
                link.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', updateActiveLink);
    updateActiveLink(); // Initial call

    // 7. Parallax Effect for Hero Sections
    function handleParallax() {
        const parallaxBgs = document.querySelectorAll('.parallax-bg, .parallax-img');
        const scrolled = window.pageYOffset;
        parallaxBgs.forEach(bg => {
            const speed = 0.3;
            const yPos = (scrolled * speed);
            bg.style.transform = `translateY(${yPos}px)`;
        });
    }

    window.addEventListener('scroll', handleParallax);
    handleParallax(); // Initial call

    // 8. Skeleton Loading Handler
    const skeletons = document.querySelectorAll('.skeleton-wrapper');
    if (skeletons.length > 0) {
        window.addEventListener('load', () => {
            setTimeout(() => {
                skeletons.forEach(el => {
                    el.classList.remove('skeleton-wrapper');
                    const skeletonElements = el.querySelectorAll('.skeleton');
                    skeletonElements.forEach(s => s.remove());
                    const hiddenContent = el.querySelectorAll('.content-hidden');
                    hiddenContent.forEach(c => c.classList.remove('content-hidden'));
                });
            }, 800); // Small delay for visual effect
        });
    }

    // 9. Scroll Progress Bar (for Detail Artikel)
    const progressBar = document.getElementById('scroll-progress');
    if (progressBar) {
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            progressBar.style.width = scrolled + "%";
        });
    }

    // 10. Image Lightbox (for Detail Proyek)
    const lightboxTriggers = document.querySelectorAll('.lightbox-trigger');
    if (lightboxTriggers.length > 0) {
        const overlay = document.createElement('div');
        overlay.className = 'lightbox-overlay';
        overlay.innerHTML = `
            <span class="lightbox-close">&times;</span>
            <img src="" class="lightbox-img" alt="Enlarged view">
        `;
        document.body.appendChild(overlay);

        const lightboxImg = overlay.querySelector('.lightbox-img');
        const closeBtn = overlay.querySelector('.lightbox-close');

        lightboxTriggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const imgSrc = trigger.getAttribute('src') || trigger.querySelector('img').getAttribute('src');
                lightboxImg.src = imgSrc;
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        const closeLightbox = () => {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        };

        closeBtn.addEventListener('click', closeLightbox);
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closeLightbox();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeLightbox();
        });
    }
});
