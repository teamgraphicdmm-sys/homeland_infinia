// function hiInitTourButton() {
//     const tourBtn = document.getElementById('tour-btn');
//     if (!tourBtn) return;

//     tourBtn.addEventListener('click', function (e) {
//         e.preventDefault();
//         const targetUrl = this.getAttribute('href');
//         const container = document.getElementById('app-container');
//         const header = document.getElementById('site-header');
//         const footer = document.getElementById('site-footer');

//         if (header) header.classList.add('fade-out-element');
//         if (footer) footer.classList.add('fade-out-element');
//         if (container) container.classList.add('zoom-into-screen');

//         setTimeout(function () {
//             window.location.href = targetUrl;
//         }, 900);
//     });
// }

function hiInitTourButton() {
    const tourBtn = document.getElementById('tour-btn');
    if (!tourBtn) return;

    tourBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const targetUrl = this.getAttribute('href');

        // Add a class to the button itself for the simple transition (e.g., fading out)
        this.classList.add('btn-fade-out');

        // Navigate to the link after the transition finishes (400ms)
        setTimeout(function () {
            window.location.href = targetUrl;
        }, 400); 
    });
}

function hiInitHamburgerMenu() {
    const btn = document.getElementById('hamburgerBtn');
    const menu = document.getElementById('headerRight');
    if (!btn || !menu) return;

    function closeMenu() {
        btn.classList.remove('is-open');
        menu.classList.remove('is-open');
        btn.setAttribute('aria-expanded', 'false');
    }

    function toggleMenu() {
        const isOpen = menu.classList.toggle('is-open');
        btn.classList.toggle('is-open', isOpen);
        btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    }

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        toggleMenu();
    });

    // Close when a nav link is tapped
    menu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', closeMenu);
    });

    // Close when tapping outside the menu
    document.addEventListener('click', function (e) {
        if (!menu.contains(e.target) && !btn.contains(e.target)) {
            closeMenu();
        }
    });

    // Close automatically if the viewport grows back to desktop size
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) closeMenu();
    });
}

// This script is enqueued in the footer -- the DOM is already parsed by the
// time it runs, so 'DOMContentLoaded' may have already fired before a
// listener attaches. Run immediately if the DOM is already ready.
function hiRunWhenReady(fn) {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', fn);
    } else {
        fn();
    }
}

hiRunWhenReady(function () {
    hiInitTourButton();
    hiInitHamburgerMenu();
});