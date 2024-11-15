/*====================================================================================
      Initiating an  MPESA B2B Business Paybill
======================================================================================*/
document.addEventListener('DOMContentLoaded', () => {
    const paymentForm = document.getElementById('paymentForm');
    const payBenOlivesButton = document.getElementById('payBenOlivesButton');
    const confirmationModal = document.getElementById('confirmationModal');
    const cancelButton = document.getElementById('cancelButton');
    const confirmButton = document.getElementById('confirmButton');
    const B2BModal= document.getElementById('B2BModal');
    const B2BModalMessage = document.getElementById('B2BModalMessage');
    const B2BModalIcon = document.getElementById('B2BModalIcon');
    const closeB2BModalButton = document.getElementById('closeB2BModalButton');

    if (payBenOlivesButton) {
      // Show confirmation modal when pay with mpesa button is shown and disable scrolling
      payBenOlivesButton.addEventListener('click', () => {
        console.log('pay BenOlives Button clicked');
        confirmationModal.classList.remove('hidden');
        document.body.classList.add('no-scroll');
      });
  
      // Proceed with payment when confirm button is clicked and also start pooling to see the payment status
      confirmButton.addEventListener('click', () => {
        //close the confirmation modal first
        confirmationModal.classList.add('hidden');
        document.body.classList.remove('no-scroll');

        // will contain the amount of kaspersky sales
        const formData = new FormData(paymentForm);
        //initiate b2b payment
        initiateB2BPayment(formData);
      });
  
      // Hide the confirmation modal when the cancel button is clicked and enable scrolling
      cancelButton.addEventListener('click', () => {
        confirmationModal.classList.add('hidden');
        document.body.classList.remove('no-scroll');
      });
    }

    //function to initiate payment by calling the route specified in the form action field
    async function initiateB2BPayment(formData) {
        try {
            const response = await fetch(paymentForm.action, {
                method: 'POST',
                body: formData,
            });
            const data = await response.json();
            if (!response.ok || !data) {
                // Check for successful response
                showB2BResultModal(false, 'Error: Invalid response from server.');
                return;
            }

            if (data.error) {
                // If B2B BUSINESS PAYBILL was not successful
                console.log(data);
                showB2BResultModal(false, data.error);
            } else {
               // If B2B BUSINESS PAYBILL was successful. Inform customer
               showB2BResultModal(true, data.message);  // Show success message
               // Start polling to check payment status (optional)
               // checkPaymentStatus(data.CheckoutRequestID);
            }
        } catch (error) {
            console.log('Error:', error);
            showB2BResultModal(false, 'There was an issue initiating the payment. Please try again.');
        }
    }

    // show B2B modal depending if there is an error or success
    function showB2BResultModal(isSuccess, message) {
        if (isSuccess) {
            B2BModalIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" class="bi bi-check2-circle" viewBox="0 0 16 16">
                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
            </svg>`;
        } else {
            B2BModalIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-exclamation-lg" viewBox="0 0 16 16">
                <path d="M7.005 3.1a1 1 0 1 1 1.99 0l-.388 6.35a.61.61 0 0 1-1.214 0zM7 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0"/>
            </svg>`;
        }

        B2BModalMessage.textContent = message;

        // Show the modal with animation and also disable scrolling
        B2BModal.classList.remove('hidden');
        B2BModal.classList.add('modal-enter');
        document.body.classList.add('no-scroll');
    
        // Close the modal when the close button is clicked
        closeB2BModalButton.addEventListener('click', function () {
        closeB2BModal();
        })
    }

    // function to close B2B modal
    function closeB2BModal () {
        B2BModal.classList.remove('modal-enter');
        B2BModal.classList.add('modal-exit');
        B2BModal.classList.add('hidden');
        document.body.classList.remove('no-scroll');
    }
})


document.addEventListener('DOMContentLoaded', function () {
    // Select all sidebar links
    const sidebarLinks = document.querySelectorAll('.sidebar .menu li a');
    
    // Add click event listener to each sidebar link
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            // Prevent the default link behavior (no page reload)
            e.preventDefault();

            // Get the URL of the clicked link
            const url = this.getAttribute('href');
            console.log(url)

            // Call the function to load the content dynamically
            loadContent(url);
        });
    });

    // Function to load content dynamically into the main content area
    function loadContent(url) {
        const contentArea = document.getElementById('content-area');
        contentArea.innerHTML = 'Loading...'; // Optional: Show loading text or a spinner

        // Create a new AJAX request using the Fetch API
        fetch(url)
            .then(response => {
                if (response.ok) {
                    return response.text(); // Return the response text (HTML content)
                }
                throw new Error('Network response was not ok');
            })
            .then(data => {
                // Inject the content into the #content-area div
                contentArea.innerHTML = data;
            })
            .catch(error => {
                // If there's an error, display a fallback message
                contentArea.innerHTML = 'Error loading content. Please try again.';
                console.error('There was an error with the fetch operation:', error);
            });
    }
});
