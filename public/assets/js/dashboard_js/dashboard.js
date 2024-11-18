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


/*====================================================================================
    Handle the sidebar item click events and send the AJAX request to fetch the 
    content dynamically depending on the sidebar item we have clicked
======================================================================================*/
document.addEventListener('DOMContentLoaded', function() {
    //get all the sidebar items that when clicked should show some data
    // I have given them similar class 'section-item' so that they can be
    // selected together
    const sidebarItems = document.querySelectorAll('.section-item');

    //loop through each sidebar item and add an event listener
    sidebarItems.forEach(item => {
        item.addEventListener('click', function() {
            // get the specific section we are displaying from the data-section attribute
            const section = item.getAttribute('data-section');

            //Now call a function to load the specific content of the section
            loadSectionContent(section);
        })
    })

    //function to load the content of the section dynamically via Ajax
    //and inject it into main panel
    function loadSectionContent(section) {
        // Target the main panel to update content
        const mainPanelContentSection = document.getElementById('main-panel-content-section');
        
        // Show loading spinner or message for now lets do a div
        mainPanelContentSection.innerHTML = '<div class="loading">Loading...</div>';

        // Make the AJAX request to the server to fetch the content for the selected section
        fetch(`/admin/dashboard/load-section?section=${section}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load section');
            }
            return response.text(); // Return the HTML content
        })
        .then(content => {
            mainPanelContentSection.innerHTML = content; // Update the main panel with the fetched content
        })
        .catch(error => {
            mainPanelContentSection.innerHTML = '<div class="error">Error loading content</div>';
            console.error(error);
        });
    }

})