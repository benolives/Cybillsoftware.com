/*==================================================================================
        Toggle the visibility of the drop down menu, when user clicks 
        on the search group in the home section
=====================================================================================*/
document.addEventListener('DOMContentLoaded', function() {
    // Get the dropdown button and menu
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    // Add click event listener to the dropdown button
    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', function() {
            // Toggle the 'hidden' class on the dropdown menu to show/hide it
            dropdownMenu.classList.toggle('hidden');
        });
    
        // Close the dropdown if the user clicks anywhere outside the dropdown
        document.addEventListener('click', function(event) {
            // Check if the click was outside the dropdown or button
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                // Hide the dropdown if clicked outside
                dropdownMenu.classList.add('hidden');
            }
        });
    }
})