import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const root = document.documentElement;

    const themeToggle = document.getElementById('theme-toggle');
    themeToggle?.addEventListener('click', () => {
        const isDark = root.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });

    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle?.addEventListener('click', () => {
        mobileMenu?.classList.toggle('hidden');
    });

    mobileMenu?.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
    });

    document.querySelectorAll('[data-flash]').forEach((flash) => {
        setTimeout(() => {
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500);
        }, 3500);
    });

    const typingEl = document.getElementById('typing-role');

    if (typingEl) {
        const roles = JSON.parse(typingEl.dataset.roles || '[]');
        let roleIndex = 0;
        let charIndex = 0;
        let deleting = false;

        const tick = () => {
            const currentRole = roles[roleIndex] || '';
            typingEl.textContent = currentRole.slice(0, charIndex);

            if (!deleting && charIndex < currentRole.length) {
                charIndex++;
                setTimeout(tick, 70);
            } else if (!deleting) {
                deleting = true;
                setTimeout(tick, 1700);
            } else if (charIndex > 0) {
                charIndex--;
                setTimeout(tick, 35);
            } else {
                deleting = false;
                roleIndex = (roleIndex + 1) % roles.length;
                setTimeout(tick, 300);
            }
        };

        tick();
    }

    const revealElements = document.querySelectorAll('.reveal');

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12 },
        );

        revealElements.forEach((element) => observer.observe(element));
    } else {
        revealElements.forEach((element) => element.classList.add('is-visible'));
    }
});
