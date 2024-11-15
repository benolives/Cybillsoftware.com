/*=============================================================================================
                When we scroll we want the header to change background to white color so
                that we can maintain contrast.
==============================================================================================*/
document.addEventListener('DOMContentLoaded', function() {
    // When we scroll, the header background change to white from transparent
    const desktopLinks = document.querySelectorAll('.desktop-link');
    const nav_open_btn = document.getElementById('nav-open');
    const header_section = document.getElementById('header-section');
    const logo_name = document.getElementById('logo-name');

    // Function to apply styles based on scroll position
    function updateHeaderStyles() {
        if (window.scrollY > 50) {
            header_section.classList.add('scrolled');
            desktopLinks.forEach(link => {
                link.classList.remove('text-white');
                link.classList.add('text-gray-700');
            });
            logo_name.classList.remove('text-white');
            logo_name.classList.add('text-gray-700');
            nav_open_btn.classList.remove('text-white');
            nav_open_btn.classList.add('text-black');
        } else {
            header_section.classList.remove('scrolled');
            desktopLinks.forEach(link => {
                link.classList.remove('text-gray-700');
                link.classList.add('text-white');
            });
            logo_name.classList.remove('text-gray-700');
            logo_name.classList.add('text-white');
            nav_open_btn.classList.remove('text-black');
            nav_open_btn.classList.add('text-white');
        }
    }

    // Initialize styles based on the current scroll position
    updateHeaderStyles();

    // Add scroll event listener to handle scroll-based style changes
    window.addEventListener('scroll', updateHeaderStyles);
});