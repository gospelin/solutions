import { gsap } from 'gsap';
import { ScrollTrigger, TextPlugin } from 'gsap/all';
import i18next from 'i18next';

gsap.registerPlugin(ScrollTrigger, TextPlugin);

function initialize() {
    document.addEventListener('DOMContentLoaded', () => {
        // Check if i18next loaded from CDN
        if (typeof i18next === 'undefined') {
            return;
        }

        // Initialize i18next
        i18next.init({
            lng: localStorage.getItem('language') || 'en',
            debug: false,
            resources: {
                en: {},
                es: {},
                fr: {}
            },
            fallbackLng: 'en',
            interpolation: {
                escapeValue: false
            }
        }, (err, t) => {
            if (err) {
                return;
            }
            loadTranslations(t);
        });

        // Load translations dynamically
        function loadTranslations(t) {
            fetch('/translations.json')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to load translations');
                    }
                    return response.json();
                })
                .then(data => {
                    i18next.addResourceBundle('en', 'translation', data.en, true, true);
                    i18next.addResourceBundle('es', 'translation', data.es, true, true);
                    i18next.addResourceBundle('fr', 'translation', data.fr, true, true);
                    applyTranslations(t);
                    setupDynamicContent(t);
                })
                .catch(error => {
                    alert('Failed to load resources. Using default content.');
                    applyTranslations(t);
                    setupDynamicContent(t);
                });
        }

        // Apply translations to DOM
        function applyTranslations(t) {
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                const translation = t(key) || key;
                if (translation) {
                    const faqText = element.querySelector('.faq-text');
                    if (faqText) {
                        faqText.textContent = translation;
                    } else {
                        element.textContent = translation;
                    }
                } else {
                    element.textContent = key;
                }
            });

            document.querySelectorAll('[data-i18n-placeholder]').forEach(element => {
                const key = element.getAttribute('data-i18n-placeholder');
                const translation = t(key) || key;
                if (translation) {
                    element.placeholder = translation;
                }
            });

            document.title = t('meta.title') || 'Mr Solution - Fucked Up Tech Solutions';
        }

        // Setup dynamic content that depends on translations
        function setupDynamicContent(t) {
            const serviceDetails = {
                'AI-Powered Analytics': { icon: '🚀', description: t('services.ai.detailedDescription') || 'Default AI description.' },
                'Cloud Infrastructure': { icon: '⚡', description: t('services.cloud.detailedDescription') || 'Default Cloud description.' },
                'Cybersecurity Suite': { icon: '🛡️', description: t('services.cybersecurity.detailedDescription') || 'Default Cybersecurity description.' },
                'Custom Development': { icon: '🔧', description: t('services.custom.detailedDescription') || 'Default Custom description.' },
                'Business Intelligence': { icon: '📊', description: t('services.bi.detailedDescription') || 'Default BI description.' },
                'Digital Transformation': { icon: '🌐', description: t('services.digital.detailedDescription') || 'Default Digital description.' }
            };

            // Language switcher
            const languageSwitcher = document.getElementById('languageSwitcher');
            if (languageSwitcher) {
                languageSwitcher.value = i18next.language;
                languageSwitcher.addEventListener('change', (e) => {
                    const selectedLang = e.target.value;
                    i18next.changeLanguage(selectedLang, (err) => {
                        if (err) {
                            return;
                        }
                        localStorage.setItem('language', selectedLang);
                        const newT = i18next.getFixedT(selectedLang);
                        applyTranslations(newT);
                        updateServiceModal(newT, serviceDetails);
                        updateGSAPAnimations(newT);
                    });
                });
            }

            

            // Loading screen handling
            const loadingScreen = document.getElementById('loadingScreen');
            if (loadingScreen) {
                setTimeout(() => {
                    loadingScreen.style.opacity = '0';
                    setTimeout(() => {
                        loadingScreen.style.display = 'none';
                    }, 500);
                }, 1000);
            }

            document.querySelectorAll('.new-trans').forEach(element => {
        const key = element.getAttribute('data-i18n');
        element.textContent = t(key) || element.textContent;
    });

            // Service Modal
            const modal = document.getElementById('serviceModal');
            const modalClose = document.getElementById('modalClose');
            const modalIcon = document.getElementById('modalIcon');
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');
            const serviceCards = document.querySelectorAll('.service-card');

            function updateServiceModal(t, serviceDetails) {
                if (modal && modalClose && modalIcon && modalTitle && modalDescription && serviceCards.length) {
                    serviceCards.forEach(card => {
                        card.removeEventListener('click', card.clickHandler);
                        card.clickHandler = () => {
                            const title = card.querySelector('.service-title')?.textContent;
                            if (!title) {
                                return;
                            }
                            const serviceMap = {
                                [t('services.ai.title') || 'AI-Powered Analytics']: 'AI-Powered Analytics',
                                [t('services.cloud.title') || 'Cloud Infrastructure']: 'Cloud Infrastructure',
                                [t('services.cybersecurity.title') || 'Cybersecurity Suite']: 'Cybersecurity Suite',
                                [t('services.custom.title') || 'Custom Development']: 'Custom Development',
                                [t('services.bi.title') || 'Business Intelligence']: 'Business Intelligence',
                                [t('services.digital.title') || 'Digital Transformation']: 'Digital Transformation'
                            };
                            const serviceKey = serviceMap[title] || title;
                            modalIcon.textContent = serviceDetails[serviceKey]?.icon || '🚀';
                            modalTitle.textContent = title;
                            modalDescription.textContent = serviceDetails[serviceKey]?.description || t(`services.${serviceKey.toLowerCase().replace(/\s+/g, '')}.detailedDescription`) || 'No description.';

                            modal.style.display = 'flex';
                            modal.classList.add('active');
                            modal.setAttribute('aria-hidden', 'false');
                            document.body.style.overflow = 'hidden';

                            if (typeof gsap !== 'undefined') {
                                gsap.fromTo(
                                    modal.querySelector('.modal-content'),
                                    { opacity: 0, y: 50 },
                                    { opacity: 1, y: 0, duration: 0.5, ease: 'power3.out' }
                                );
                            }
                            modalClose.focus();
                        };
                        card.addEventListener('click', card.clickHandler);
                    });

                    const closeModal = () => {
                        if (typeof gsap !== 'undefined') {
                            gsap.to(modal.querySelector('.modal-content'), {
                                opacity: 0,
                                y: 50,
                                duration: 0.3,
                                ease: 'power3.in',
                                onComplete: () => {
                                    modal.classList.remove('active');
                                    modal.style.display = 'none';
                                    modal.setAttribute('aria-hidden', 'true');
                                    document.body.style.overflow = '';
                                }
                            });
                        } else {
                            modal.classList.remove('active');
                            modal.style.display = 'none';
                            modal.setAttribute('aria-hidden', 'true');
                            document.body.style.overflow = '';
                        }
                    };

                    modalClose.removeEventListener('click', closeModal);
                    modalClose.addEventListener('click', closeModal);

                    modal.removeEventListener('click', modal.clickHandler);
                    modal.clickHandler = (e) => {
                        if (e.target === modal) {
                            closeModal();
                        }
                    };
                    modal.addEventListener('click', modal.clickHandler);

                    document.removeEventListener('keydown', document.keydownHandler);
                    document.keydownHandler = (e) => {
                        if (e.key === 'Escape' && modal.classList.contains('active')) {
                            closeModal();
                        }
                    };
                    document.addEventListener('keydown', document.keydownHandler);
                }
            }

            updateServiceModal(t, serviceDetails);

            // Custom Cursor
            const cursor = document.getElementById('cursor');
            const cursorFollower = document.getElementById('cursorFollower');
            document.addEventListener('mousemove', (e) => {
                if (cursor && cursorFollower) {
                    cursor.style.left = e.clientX + 'px';
                    cursor.style.top = e.clientY + 'px';
                    setTimeout(() => {
                        cursorFollower.style.left = e.clientX + 'px';
                        cursorFollower.style.top = e.clientY + 'px';
                    }, 50);
                }
            });

            const hoverElements = document.querySelectorAll('a, button, input, textarea, select, .service-card, .testimonial-card');
            hoverElements.forEach(elem => {
                elem.addEventListener('mouseenter', () => {
                    if (cursor && cursorFollower) {
                        cursor.classList.add('hover');
                        cursorFollower.classList.add('hover');
                    }
                });
                elem.addEventListener('mouseleave', () => {
                    if (cursor && cursorFollower) {
                        cursor.classList.remove('hover');
                        cursorFollower.classList.remove('hover');
                    }
                });
            });

            // Navbar Scroll Effect
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (navbar) {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                }
            });

            // Mobile Menu
            const mobileMenu = document.getElementById('mobileMenu');
            const navLinks = document.querySelector('.nav-links');
            if (mobileMenu && navLinks) {
                mobileMenu.addEventListener('click', () => {
                    navLinks.classList.toggle('active');
                    mobileMenu.classList.toggle('active');
                    const hamburgers = mobileMenu.querySelectorAll('.hamburger');
                    hamburgers[0].style.transform = navLinks.classList.contains('active')
                        ? 'rotate(45deg) translate(5px, 5px)'
                        : 'none';
                    hamburgers[1].style.opacity = navLinks.classList.contains('active') ? '0' : '1';
                    hamburgers[2].style.transform = navLinks.classList.contains('active')
                        ? 'rotate(-45deg) translate(7px, -7px)'
                        : 'none';
                });
            }

            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (navLinks && mobileMenu) {
                        navLinks.classList.remove('active');
                        mobileMenu.classList.remove('active');
                        const hamburgers = mobileMenu.querySelectorAll('.hamburger');
                        hamburgers[0].style.transform = 'none';
                        hamburgers[1].style.opacity = '1';
                        hamburgers[2].style.transform = 'none';
                    }
                });
            });

            // Scroll Indicator
            const scrollIndicator = document.getElementById('scrollIndicator');
            window.addEventListener('scroll', () => {
                if (scrollIndicator) {
                    const windowHeight = document.documentElement.scrollHeight - window.innerHeight;
                    const scrollProgress = (window.scrollY / windowHeight) * 100;
                    scrollIndicator.style.transform = `scaleX(${scrollProgress / 100})`;
                }
            });

            // Theme toggle tray
            const themeToggleButton = document.getElementById('themeToggleButton');
            const themeTray = document.getElementById('themeTray');
            const themeOptions = document.querySelectorAll('.theme-option');
            const themeIcon = document.querySelector('.theme-icon');

            if (themeToggleButton && themeTray && themeOptions.length) {
                themeToggleButton.addEventListener('click', () => {
                    const isActive = themeTray.classList.contains('active');
                    themeTray.classList.toggle('active');
                    if (typeof gsap !== 'undefined') {
                        gsap.to(themeTray, {
                            duration: 0.3,
                            opacity: isActive ? 0 : 1,
                            y: isActive ? 10 : 0,
                            ease: 'power3.out',
                            onComplete: () => {
                                if (isActive) {
                                    themeTray.style.display = 'none';
                                }
                            },
                            onStart: () => {
                                if (!isActive) {
                                    themeTray.style.display = 'flex';
                                }
                            }
                        });
                    } else {
                        themeTray.style.display = isActive ? 'none' : 'flex';
                        themeTray.style.opacity = isActive ? '0' : '1';
                        themeTray.style.transform = isActive ? 'translateY(10px)' : 'translateY(0)';
                    }
                });

                themeOptions.forEach(option => {
                    option.addEventListener('click', () => {
                        const theme = option.getAttribute('data-theme');
                        document.body.classList.remove('light', 'dark');
                        document.body.classList.add(theme);
                        localStorage.setItem('theme', theme);
                        themeIcon.textContent = theme === 'light' ? '🌞' : '🌙';
                        if (typeof gsap !== 'undefined') {
                            gsap.to(themeTray, {
                                duration: 0.3,
                                opacity: 0,
                                y: 10,
                                ease: 'power3.in',
                                onComplete: () => {
                                    themeTray.classList.remove('active');
                                    themeTray.style.display = 'none';
                                }
                            });
                        } else {
                            themeTray.classList.remove('active');
                            themeTray.style.display = 'none';
                            themeTray.style.opacity = '0';
                            themeTray.style.transform = 'translateY(10px)';
                        }
                    });
                });

                // Initialize theme from localStorage
                const savedTheme = localStorage.getItem('theme') || 'dark';
                document.body.classList.add(savedTheme);
                themeIcon.textContent = savedTheme === 'light' ? '🌞' : '🌙';
            }


            // Back to Top Button
            const backToTop = document.getElementById('backToTop');
            if (backToTop) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 300) {
                        backToTop.classList.add('visible');
                        if (typeof gsap !== 'undefined') {
                            gsap.to(backToTop, { opacity: 1, scale: 1, duration: 0.3 });
                        }
                    } else {
                        backToTop.classList.remove('visible');
                        if (typeof gsap !== 'undefined') {
                            gsap.to(backToTop, { opacity: 0, scale: 0.8, duration: 0.3 });
                        }
                    }
                });

                backToTop.addEventListener('click', () => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            // Contact Form
            const contactForm = document.getElementById('contactForm');
            const formMessage = document.getElementById('formMessage');
            if (contactForm && formMessage) {
                contactForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const name = document.getElementById('name')?.value.trim();
                    const email = document.getElementById('email')?.value.trim();
                    const message = document.getElementById('message')?.value.trim();

                    if (name && email && message) {
                        if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                            formMessage.textContent = t('form.success') || 'Message sent successfully!';
                            formMessage.style.color = 'var(--electric)';
                            formMessage.classList.add('show');
                            contactForm.reset();
                            setTimeout(() => formMessage.classList.remove('show'), 3000);
                        } else {
                            formMessage.textContent = t('form.invalidEmail') || 'Please enter a valid email address.';
                            formMessage.style.color = 'var(--accent)';
                            formMessage.classList.add('show');
                        }
                    } else {
                        formMessage.textContent = t('form.required') || 'Please fill out all fields.';
                        formMessage.style.color = 'var(--accent)';
                        formMessage.classList.add('show');
                    }
                });
            }

            // Newsletter Form
            const newsletterForm = document.getElementById('newsletterForm');
            const newsletterMessage = document.getElementById('newsletterMessage');
            if (newsletterForm && newsletterMessage) {
                newsletterForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const email = document.getElementById('newsletterEmail')?.value.trim();

                    if (email && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                        newsletterMessage.textContent = t('newsletter.success') || 'Subscribed successfully!';
                        newsletterMessage.style.color = 'var(--electric)';
                        newsletterMessage.classList.add('show');
                        newsletterForm.reset();
                        setTimeout(() => newsletterMessage.classList.remove('show'), 3000);
                    } else {
                        newsletterMessage.textContent = t('newsletter.invalidEmail') || 'Please enter a valid email address.';
                        newsletterMessage.style.color = 'var(--accent)';
                        newsletterMessage.classList.add('show');
                    }
                });
            }

            // Live Chat Widget
            const chatButton = document.getElementById('chatButton');
            const chatBox = document.getElementById('chatBox');
            const chatClose = document.getElementById('chatClose');
            const chatForm = document.getElementById('chatForm');
            const chatInput = document.getElementById('chatInput');
            const chatMessages = chatBox?.querySelector('.chat-messages');

            if (chatButton && chatBox && chatClose && chatForm && chatInput && chatMessages) {
                chatButton.addEventListener('click', () => {
                    chatBox.classList.toggle('active');
                    chatBox.setAttribute('aria-hidden', !chatBox.classList.contains('active'));
                    if (chatBox.classList.contains('active')) {
                        chatInput.focus();
                        if (typeof gsap !== 'undefined') {
                            gsap.fromTo(chatBox, { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.3 });
                        }
                    } else {
                        if (typeof gsap !== 'undefined') {
                            gsap.to(chatBox, { opacity: 0, y: 20, duration: 0.3, onComplete: () => chatBox.classList.remove('active') });
                        }
                    }
                });

                chatClose.addEventListener('click', () => {
                    if (typeof gsap !== 'undefined') {
                        gsap.to(chatBox, {
                            opacity: 0, y: 20, duration: 0.3, onComplete: () => {
                                chatBox.classList.remove('active');
                                chatBox.setAttribute('aria-hidden', 'true');
                            }
                        });
                    }
                });

                chatForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const message = chatInput.value.trim();
                    if (message) {
                        const messageElement = document.createElement('p');
                        messageElement.textContent = `You: ${message}`;
                        chatMessages.appendChild(messageElement);
                        chatMessages.scrollTop = chatMessages.scrollHeight;

                        setTimeout(() => {
                            const botMessage = document.createElement('p');
                            botMessage.textContent = t('chat.response') || 'Thank you for your message! Our team will get back to you soon.';
                            chatMessages.appendChild(botMessage);
                            chatMessages.scrollTop = chatMessages.scrollHeight;
                        }, 1000);

                        chatInput.value = '';
                    }
                });
            }

            // New Hero Button Hover Effects
            //const heroButtons = document.querySelectorAll('.hero-button');
            //heroButtons.forEach(button => {
            //    button.addEventListener('mouseenter', () => {
            //        gsap.to(button, {
            //            scale: 1.1,
            //            duration: 0.3,
            //            ease: 'power3.out',
            //            boxShadow: '0 8px 24px rgba(108, 92, 231, 0.5)',
            //        });
            //    });
            //    button.addEventListener('mouseleave', () => {
            //        gsap.to(button, {
            //            scale: 1,
            //            duration: 0.3,
            //            ease: 'power2.in',
            //            boxShadow: 'none',
            //        });
            //    });
            //});

            // Enhanced Hero Button Animations
            const heroButtons = document.querySelectorAll('.hero-button');
            heroButtons.forEach(button => {
                button.addEventListener('mouseenter', () => {
                    gsap.to(button, {
                        scale: 1.05,
                        duration: 0.3,
                        ease: 'power3.out',
                        boxShadow: '0 8px 24px rgba(108, 92, 231, 0.5)',
                    });
                });
                button.addEventListener('mouseleave', () => {
                    gsap.to(button, {
                        scale: 1,
                        duration: 0.3,
                        ease: 'power2.in',
                        boxShadow: 'none',
                    });
                });
            });

            // New Service Card Flip Animation
            gsap.utils.toArray('.service-card').forEach(card => {
                const front = card.querySelector('.card-front');
                const back = card.querySelector('.card-back');
                if (front && back) {
                    card.addEventListener('mouseenter', () => {
                        gsap.to(front, { rotationY: 180, duration: 0.6, ease: 'power3' });
                        gsap.to(back, { rotationY: 360, duration: 0.6, ease: 'power3', opacity: 1 });
                    });
                    card.addEventListener('mouseleave', () => {
                        gsap.to(front, { rotationY: 0, duration: 0.6, ease: 'power3' });
                        gsap.to(back, { rotationY: 180, duration: 0.6, ease: 'power3', opacity: 0 });
                    });
                }
            });

            // New FAQ Hover Animation
            const faqQuestions = document.querySelectorAll('.faq-question');
            faqQuestions.forEach(question => {
                question.addEventListener('mouseenter', () => {
                    gsap.to(question, {
                        background: 0.2,
                        duration: 0.3,
                        ease: 'power3.out'
                    });
                });
                question.addEventListener('mouseleave', () => {
                    gsap.to(question, {
                        background: 'none',
                        duration: 0.3,
                        ease: 'power2.in'
                    });
                });
            });

            // FAQ Accordion
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');
                if (question && answer) {
                    question.addEventListener('click', () => {
                        const isOpen = question.getAttribute('aria-expanded') === 'true';
                        faqItems.forEach(i => {
                            const q = i.querySelector('.faq-question');
                            const a = i.querySelector('.faq-answer');
                            if (i !== item && q && a) {
                                q.setAttribute('aria-expanded', 'false');
                                a.style.maxHeight = null;
                            }
                        });
                        question.setAttribute('aria-expanded', !isOpen);
                        answer.style.maxHeight = isOpen ? null : `${answer.scrollHeight}px`;
                    });
                }
            });

            // GSAP Animations
            if (typeof gsap !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger, TextPlugin);

                // Hero Section Animation
                gsap.from('.hero-content', {
                    opacity: 0,
                    y: 100,
                    duration: 1.5,
                    ease: 'power3.out',
                    delay: 0.5
                });

                gsap.to('#heroTitle', {
                    text: t('hero.title') || 'Revolutionary Tech Solutions',
                    duration: 1.5,
                    ease: 'none',
                    delay: 0.5
                });

                // New Stats Reveal Animation
                gsap.utils.toArray('.stat-item').forEach((item, i) => {
                    gsap.from(item, {
                        opacity: 0,
                        scale: 0.8,
                        duration: 0.8,
                        ease: 'power3.out',
                        scrollTrigger: {
                            trigger: item,
                            start: 'top 85%',
                            toggleActions: 'play none none none',
                        },
                        delay: i * 0.2,
                    });
                });

                // New CTA Button Pulse
                const ctaButtons = document.querySelectorAll('.cta-button');
                ctaButtons.forEach(button => {
                    gsap.to(button, {
                        scale: 1.03,
                        duration: 1.5,
                        repeat: -1,
                        yoyo: true,
                        ease: 'sin.inOut',
                    });
                });

                // Update translations for new elements
                document.querySelectorAll('.new-trans').forEach(element => {
                    const key = element.getAttribute('data-i18n');
                    element.textContent = t(key) || element.textContent;
                });

                // Stats Animation
                gsap.utils.toArray('.stat-number').forEach(stat => {
                    gsap.to(stat, {
                        textContent: stat.getAttribute('data-count'),
                        duration: 2,
                        ease: 'power1.out',
                        snap: { textContent: 1 },
                        scrollTrigger: {
                            trigger: stat,
                            start: 'top 80%',
                            toggleActions: 'play none none none'
                        }
                    });
                });

                // Services Animation
                gsap.utils.toArray('.service-card').forEach((card, i) => {
                    gsap.from(card, {
                        opacity: 0,
                        y: 50,
                        duration: 0.8,
                        ease: 'power3.out',
                        scrollTrigger: {
                            trigger: card,
                            start: 'top 85%',
                            toggleActions: 'play none none none'
                        },
                        delay: i * 0.2
                    });
                });

                // Testimonials Animation
                gsap.utils.toArray('.testimonial-card').forEach((card, i) => {
                    gsap.from(card, {
                        opacity: 0,
                        x: i % 2 === 0 ? -50 : 50,
                        duration: 0.8,
                        ease: 'power3.out',
                        scrollTrigger: {
                            trigger: card,
                            start: 'top 85%',
                            toggleActions: 'play none none none'
                        },
                        delay: i * 0.2
                    });
                });

                // CTA Animation
                gsap.from('.cta-content', {
                    opacity: 0,
                    y: 50,
                    duration: 1,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: '.cta-section',
                        start: 'top 80%',
                        toggleActions: 'play none none none'
                    }
                });

                // Footer Animation
                gsap.from('.footer-section', {
                    opacity: 0,
                    y: 30,
                    duration: 0.8,
                    ease: 'power3.out',
                    stagger: 0.2,
                    scrollTrigger: {
                        trigger: '.footer',
                        start: 'top 85%',
                        toggleActions: 'play none none none'
                    }
                });

                // Floating Elements Parallax
                gsap.utils.toArray('.floating-element').forEach(element => {
                    const speed = parseFloat(element.getAttribute('data-parallax-speed'));
                    gsap.to(element, {
                        y: '-=100',
                        ease: 'none',
                        scrollTrigger: {
                            trigger: '.hero',
                            start: 'top top',
                            end: 'bottom top',
                            scrub: speed
                        }
                    });
                });
            }

            function updateGSAPAnimations(t) {
                if (typeof gsap !== 'undefined') {
                    gsap.to('#heroTitle', {
                        text: t('hero.title') || 'Revolutionary Tech Solutions',
                        duration: 1.5,
                        ease: 'none'
                    });
                }
            }
        }
    });
}

// Start the application
initialize();
