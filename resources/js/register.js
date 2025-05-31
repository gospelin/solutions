import { gsap } from 'gsap';
import { ScrollTrigger, TextPlugin } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger, TextPlugin);

document.addEventListener('DOMContentLoaded', () => {
    // Ensure DOM is fully loaded before running
    if (!document.querySelector('.content-section')) {
        console.warn('Content section not found. Skipping animations.');
        return;
    }

    function createParticles() {
        const particlesContainer = document.querySelector('.particles');
        if (!particlesContainer) return;
        const particleCount = 50;
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 15 + 's';
            particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
            particlesContainer.appendChild(particle);
        }
    }
    createParticles();

    const registerForm = document.getElementById('registerForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmationInput = document.getElementById('password_confirmation');
    const passwordToggle = document.getElementById('passwordToggle');
    const passwordConfirmToggle = document.getElementById('passwordConfirmToggle');
    const termsCheckbox = document.getElementById('terms');
    const registerButton = document.getElementById('registerButton');
    const buttonText = document.getElementById('buttonText');
    const errorMessage = document.getElementById('errorMessage');
    const successMessage = document.getElementById('successMessage');

    // Null checks for critical elements
    if (!registerForm || !nameInput || !emailInput || !passwordInput || !passwordConfirmationInput || !registerButton) {
        console.error('Critical form elements missing. Aborting registration script.');
        return;
    }

    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }


    if (passwordToggle && passwordInput) {
        passwordToggle.addEventListener('click', () => {
            const icon = passwordToggle.querySelector('i');
            const isVisible = passwordInput.type === 'password';
            passwordInput.type = isVisible ? 'text' : 'password';
            icon.classList.toggle('fa-eye', !isVisible);
            icon.classList.toggle('fa-eye-slash', isVisible);
            passwordToggle.setAttribute('aria-label', isVisible ? 'Hide password' : 'Show password');
        });
    }

    if (passwordConfirmToggle && passwordConfirmationInput) {
        passwordConfirmToggle.addEventListener('click', () => {
            const icon = passwordConfirmToggle.querySelector('i');
            const isVisible = passwordConfirmationInput.type === 'password';
            passwordConfirmationInput.type = isVisible ? 'text' : 'password';
            icon.classList.toggle('fa-eye', !isVisible);
            icon.classList.toggle('fa-eye-slash', isVisible);
            passwordConfirmToggle.setAttribute('aria-label', isVisible ? 'Hide password' : 'Show password');
        });
    }


    if (nameInput) {
        nameInput.addEventListener('input', debounce(function () {
            const name = this.value.trim();
            const nameValidation = document.getElementById('nameValidation');
            if (!name) {
                this.classList.remove('success', 'error');
                nameValidation.classList.remove('success', 'error');
                nameValidation.textContent = '';
            } else if (name.length < 2) {
                this.classList.add('error');
                this.classList.remove('success');
                nameValidation.textContent = 'Name must be at least 2 characters';
                nameValidation.classList.add('error');
                nameValidation.classList.remove('success');
            } else {
                this.classList.remove('error');
                this.classList.add('success');
                nameValidation.textContent = '✓ Valid name';
                nameValidation.classList.remove('error');
                nameValidation.classList.add('success');
            }
        }, 300));
    }

    if (emailInput) {
        emailInput.addEventListener('input', debounce(function () {
            const email = this.value.trim();
            const emailValidation = document.getElementById('emailValidation');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email) {
                this.classList.remove('success', 'error');
                emailValidation.classList.remove('success', 'error');
                emailValidation.textContent = '';
            } else if (!emailRegex.test(email)) {
                this.classList.add('error');
                this.classList.remove('success');
                emailValidation.textContent = 'Please enter a valid email address';
                emailValidation.classList.add('error');
                emailValidation.classList.remove('success');
            } else {
                this.classList.remove('error');
                this.classList.add('success');
                emailValidation.textContent = '✓ Valid email';
                emailValidation.classList.remove('error');
                emailValidation.classList.add('success');
            }
        }, 300));
    }

    if (passwordInput) {
        passwordInput.addEventListener('input', debounce(function () {
            const password = this.value;
            const passwordValidation = document.getElementById('passwordValidation');
            if (!password) {
                this.classList.remove('success', 'error');
                passwordValidation.classList.remove('success', 'error');
                passwordValidation.textContent = '';
            } else if (password.length < 8) {
                this.classList.add('error');
                this.classList.remove('success');
                passwordValidation.textContent = 'Password must be at least 8 characters';
                passwordValidation.classList.add('error');
                passwordValidation.classList.remove('success');
            } else {
                this.classList.remove('error');
                this.classList.add('success');
                passwordValidation.textContent = '✓ Password meets requirements';
                passwordValidation.classList.remove('error');
                passwordValidation.classList.add('success');
            }
        }, 300));
    }

    if (passwordConfirmationInput) {
        passwordConfirmationInput.addEventListener('input', debounce(function () {
            const password = passwordInput.value;
            const confirmation = this.value;
            const confirmationValidation = document.getElementById('passwordConfirmationValidation');
            if (!confirmation) {
                this.classList.remove('success', 'error');
                confirmationValidation.classList.remove('success', 'error');
                confirmationValidation.textContent = '';
            } else if (confirmation !== password) {
                this.classList.add('error');
                this.classList.remove('success');
                confirmationValidation.textContent = 'Passwords do not match';
                confirmationValidation.classList.add('error');
                confirmationValidation.classList.remove('success');
            } else {
                this.classList.remove('error');
                this.classList.add('success');
                confirmationValidation.textContent = '✓ Passwords match';
                confirmationValidation.classList.remove('error');
                confirmationValidation.classList.add('success');
            }
        }, 300));
    }

    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            e.preventDefault();
            registerButton.classList.add('loading');
            buttonText.textContent = 'Signing Up...';
            registerButton.disabled = true;
            errorMessage.style.display = 'none';
            successMessage.style.display = 'none';

            const name = nameInput.value.trim();
            const email = emailInput.value.trim();
            const password = passwordInput.value;
            const passwordConfirmation = passwordConfirmationInput.value;
            const termsChecked = termsCheckbox.checked;

            let hasError = false;
            errorMessage.innerHTML = '';

            if (!name || name.length < 2) {
                nameInput.classList.add('error');
                document.getElementById('nameValidation').textContent = 'Name must be at least 2 characters';
                hasError = true;
            }

            if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                emailInput.classList.add('error');
                document.getElementById('emailValidation').textContent = 'Please enter a valid email address';
                hasError = true;
            }

            if (!password || password.length < 8) {
                passwordInput.classList.add('error');
                document.getElementById('passwordValidation').textContent = 'Password must be at least 8 characters';
                hasError = true;
            }

            if (!passwordConfirmation || passwordConfirmation !== password) {
                passwordConfirmationInput.classList.add('error');
                document.getElementById('passwordConfirmationValidation').textContent = 'Passwords do not match';
                hasError = true;
            }

            if (!termsChecked) {
                errorMessage.innerHTML += 'You must agree to the terms and conditions.<br>';
                hasError = true;
            }

            if (hasError) {
                errorMessage.style.display = 'block';
                gsap.to(errorMessage, { opacity: 1, y: 0, duration: 0.5 });
                registerButton.classList.remove('loading');
                buttonText.textContent = 'Sign Up';
                registerButton.disabled = false;
                return;
            }

            registerForm.submit();
        });
    }

    const socialButtons = [
        { id: 'googleLogin', label: 'Google' },
        { id: 'facebookLogin', label: 'Facebook' },
        { id: 'twitterLogin', label: 'Twitter' }
    ];

    socialButtons.forEach(button => {
        const element = document.getElementById(button.id);
        if (element) {
            element.addEventListener('click', () => {
                gsap.to(`#${button.id}`, {
                    scale: 0.95,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 1
                });
                console.log(`${button.label} sign-up clicked`);
            });
        }
    });

    if (document.getElementById('termsLink')) {
        document.getElementById('termsLink').addEventListener('click', e => {
            e.preventDefault();
            window.location.href = '/terms';
        });
    }

    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                registerForm.dispatchEvent(new Event('submit'));
            }
        });
    });

    const isMobile = window.matchMedia('(max-width: 768px)').matches;
    gsap.set(['.content-section > *', '.form-group', '.login-btn', '.social-login', '.register-link'], {
        opacity: 0,
        y: 30
    });
    gsap.set('.logo', {
        opacity: 0,
        scale: 0.8,
        rotationY: 180
    });
    const tl = gsap.timeline({
        delay: 0.2
    });
    tl.to('.auth-container', {
        opacity: 1,
        scale: 1,
        duration: 0.8,
        ease: "back.out(1.2)"
    })
        .to('.logo', {
            opacity: 1,
            scale: 1,
            rotationY: 0,
            duration: 0.8,
            ease: "back.out(1.7)"
        }, '-=0.4')
        .to('.content-section > *', {
            opacity: 1,
            y: 0,
            duration: 0.6,
            stagger: 0.1,
            ease: "power3.out"
        }, '-=0.6')
        .to(['.welcome-text', '.subtitle'], {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "power3.out"
        }, '-=0.4')
        .to('.form-group', {
            opacity: 1,
            y: 0,
            duration: 0.5,
            stagger: 0.1,
            ease: "power3.out"
        }, '-=0.3')
        .to('.remember-me', {
            opacity: 1,
            y: 0,
            duration: 0.5,
            ease: "power3.out"
        }, '-=0.2')
        .to('.login-btn', {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "back.out(1.7)"
        }, '-=0.2')
        .to(['.divider', '.social-login', '.register-link'], {
            opacity: 1,
            y: 0,
            duration: 0.5,
            stagger: 0.1,
            ease: "power3.out"
        }, '-=0.3');

    const interactiveElements = document.querySelectorAll('.form-input, .login-btn, .social-btn, .cta-btn');
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', () => {
            gsap.to(element, {
                scale: 1.02,
                duration: 0.3,
                ease: "power2.out"
            });
        });
        element.addEventListener('mouseleave', () => {
            gsap.to(element, {
                scale: 1,
                duration: 0.3,
                ease: "power2.out"
            });
        });
    });

    gsap.to('.logo', {
        y: -5,
        duration: 2,
        repeat: -1,
        yoyo: true,
        ease: "power2.inOut"
    });

    function animateParticles() {
        const particles = document.querySelectorAll('.particle');
        particles.forEach((particle, index) => {
            gsap.set(particle, {
                x: Math.random() * window.innerWidth,
                y: window.innerHeight + 10,
                opacity: 0
            });
            gsap.to(particle, {
                y: -100,
                x: `+=${Math.random() * 200 - 100}`,
                opacity: 1,
                duration: Math.random() * 10 + 10,
                repeat: -1,
                delay: Math.random() * 5,
                ease: "none",
                onComplete: () => {
                    gsap.set(particle, {
                        y: window.innerHeight + 10,
                        opacity: 0
                    });
                }
            });
        });
    }
    animateParticles();

    document.querySelectorAll('input, button, a').forEach(element => {
        element.addEventListener('focus', () => {
            gsap.to(element, {
                boxShadow: "0 0 20px rgba(79, 172, 254, 0.3)",
                duration: 0.3
            });
        });
        element.addEventListener('blur', () => {
            gsap.to(element, {
                boxShadow: "none",
                duration: 0.3
            });
        });
    });

    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallax = scrolled * 0.5;
        gsap.to('.content-section', {
            y: parallax,
            duration: 0.1
        });
    });

    const mediaQuery = window.matchMedia('(max-width: 768px)');

    function handleScreenChange(e) {
        if (e.matches) {
            gsap.set('.auth-container', {
                scale: 1,
                transformOrigin: "center center"
            });
        } else {
            gsap.set('.auth-container', {
                scale: 1,
                transformOrigin: "center center"
            });
        }
    }
    mediaQuery.addListener(handleScreenChange);
    handleScreenChange(mediaQuery);

    const isLowEndDevice = navigator.hardwareConcurrency < 4;
    if (isLowEndDevice) {
        gsap.globalTimeline.timeScale(1.5);
        document.querySelectorAll('.particle').forEach((particle, index) => {
            if (index > 20) particle.remove();
        });
    }

    console.log('Premium register page initialized successfully!');
});