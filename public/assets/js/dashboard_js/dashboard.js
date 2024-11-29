/*====================================================================================
    This is my vanilla js that will handle the collapsing and expansion of of collapsible
    toggles on the sidebar of the admin dashboard
======================================================================================*/
document.addEventListener("DOMContentLoaded", function() {
    // Get all elements with the class "collapse-toggle"
    const collapseToggles = document.querySelectorAll('.collapse-toggle');

    // Loop through each toggle and add a click event listener
    collapseToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            // Get the next sibling element (the .collapse-content div)
            const content = this.nextElementSibling;

            // Toggle the 'collapse' class on the content element
            content.classList.toggle('collapse');

            // Optional: Toggle the 'aria-expanded' attribute for accessibility
            const isExpanded = content.classList.contains('collapse');
            this.setAttribute('aria-expanded', !isExpanded);
        });
    });
});