/* =========================================================
   Spread Love Foundation — Admin
   ========================================================= */
(function () {
    'use strict';

    /* Sidebar toggle (mobile) */
    const toggle = document.getElementById('adminMenuToggle');
    const sidebar = document.getElementById('adminSidebar');

    if (toggle && sidebar) {
        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            sidebar.classList.toggle('open');
        });

        // Click outside closes the sidebar on mobile
        document.addEventListener('click', function (e) {
            if (window.innerWidth <= 900 &&
                sidebar.classList.contains('open') &&
                !sidebar.contains(e.target) &&
                !toggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    }

    /* Flash dismiss */
    document.querySelectorAll('.flash-close').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const flash = btn.closest('.flash');
            if (flash) flash.remove();
        });
    });
})();