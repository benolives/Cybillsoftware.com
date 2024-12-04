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

/*====================================================================================
    This is to mark the notification as READ on the dashboard by the admin
======================================================================================*/
document.addEventListener('DOMContentLoaded', function () {
    // Get all notification items
    const notificationItems = document.querySelectorAll('.notification-item');

    notificationItems.forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const notificationId = item.getAttribute('data-id');

            // Create a new FormData object
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
           
            // Create the Ajax request (using Fetch API)
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                body: formData,
            })
            .then(response => {
                console.log('Response:', response); // Log the full response to inspect
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    // Find the parent <li> element and fade it out (you can just remove it if you prefer)
                    item.closest('div').style.opacity = '0.5'; // Example of "marking it as read"
                    item.closest('div').style.transition = 'opacity 0.5s ease'; // Smooth transition
                    setTimeout(() => {
                        item.closest('div').style.display = 'none'; // Optionally hide it after fade-out
                    }, 500); // Wait for fade-out to complete before hiding
                }
            })
            .catch(error => {
                console.error('Error marking notification as read', error);
            });
        });
    });
});