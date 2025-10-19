import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;

    let dropdownConfigs = [];

    const closeAllDropdowns = (excludeMenu = null) => {
        dropdownConfigs.forEach(({ trigger, menu, arrow }) => {
            if (!menu || menu === excludeMenu) {
                return;
            }

            if (!menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }

            trigger?.setAttribute('aria-expanded', 'false');
            arrow?.classList.remove('rotate-180');
        });
    };

    const mobileNav = document.getElementById('mobile-nav');
    const openNavButton = document.getElementById('btn-open-nav');
    const closeNavButton = document.getElementById('btn-close-nav');
    const overlayCloser = mobileNav?.querySelector('[data-close-nav]');

    const toggleMobileNav = (show) => {
        if (!mobileNav) {
            return;
        }

        const isOpen = !mobileNav.classList.contains('hidden');
        const shouldOpen = typeof show === 'boolean' ? show : !isOpen;

        if (shouldOpen) {
            mobileNav.classList.remove('hidden');
            body.classList.add('overflow-hidden');
            openNavButton?.setAttribute('aria-expanded', 'true');
            closeAllDropdowns();
        } else {
            mobileNav.classList.add('hidden');
            body.classList.remove('overflow-hidden');
            openNavButton?.setAttribute('aria-expanded', 'false');
        }
    };

    openNavButton?.addEventListener('click', () => toggleMobileNav(true));
    closeNavButton?.addEventListener('click', () => toggleMobileNav(false));
    overlayCloser?.addEventListener('click', () => toggleMobileNav(false));

    dropdownConfigs = [
        {
            trigger: document.getElementById('notifications-dropdown-button'),
            menu: document.getElementById('notifications-dropdown-menu'),
        },
        {
            trigger: document.getElementById('profile-dropdown-button'),
            menu: document.getElementById('profile-dropdown-menu'),
            arrow: document.getElementById('profile-dropdown-arrow'),
        },
    ];

    dropdownConfigs.forEach(({ trigger, menu, arrow }) => {
        if (!trigger || !menu) {
            return;
        }

        trigger.setAttribute('aria-haspopup', 'true');
        trigger.setAttribute('aria-expanded', 'false');

        trigger.addEventListener('click', (event) => {
            event.stopPropagation();
            const isHidden = menu.classList.contains('hidden');
            closeAllDropdowns(menu);

            if (isHidden) {
                menu.classList.remove('hidden');
                trigger.setAttribute('aria-expanded', 'true');
                arrow?.classList.add('rotate-180');
            } else {
                menu.classList.add('hidden');
                trigger.setAttribute('aria-expanded', 'false');
                arrow?.classList.remove('rotate-180');
            }
        });
    });

    document.addEventListener('click', (event) => {
        const clickedInsideDropdown = dropdownConfigs.some(({ menu }) => menu?.contains(event.target));
        const clickedTrigger = dropdownConfigs.some(({ trigger }) => trigger?.contains(event.target));

        if (!clickedInsideDropdown && !clickedTrigger) {
            closeAllDropdowns();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            toggleMobileNav(false);
            closeAllDropdowns();
        }
    });
});
