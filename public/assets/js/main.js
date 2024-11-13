/*==================================================================================
            This is the toast logic code below. It contains code that will help
            us do toasts
=====================================================================================*/

(function(root, factory) {
  if (typeof module === "object" && module.exports) {
    module.exports = factory();
  } else {
    root.Toastify = factory();
  }
})(this, function(global) {
  // Object initialization
  var Toastify = function(options) {
      // Returning a new init object
      return new Toastify.lib.init(options);
    },
    // Library version
    version = "1.12.0";

  // Set the default global options
  Toastify.defaults = {
    oldestFirst: true,
    text: "Toastify is awesome!",
    node: undefined,
    duration: 3000,
    selector: undefined,
    callback: function () {
    },
    destination: undefined,
    newWindow: false,
    close: false,
    gravity: "toastify-top",
    positionLeft: false,
    position: '',
    backgroundColor: '',
    avatar: "",
    className: "",
    stopOnFocus: true,
    onClick: function () {
    },
    offset: {x: 0, y: 0},
    escapeMarkup: true,
    ariaLive: 'polite',
    style: {background: ''}
  };

  // Defining the prototype of the object
  Toastify.lib = Toastify.prototype = {
    toastify: version,

    constructor: Toastify,

    // Initializing the object with required parameters
    init: function(options) {
      // Verifying and validating the input object
      if (!options) {
        options = {};
      }

      // Creating the options object
      this.options = {};

      this.toastElement = null;

      // Validating the options
      this.options.text = options.text || Toastify.defaults.text; // Display message
      this.options.node = options.node || Toastify.defaults.node;  // Display content as node
      this.options.duration = options.duration === 0 ? 0 : options.duration || Toastify.defaults.duration; // Display duration
      this.options.selector = options.selector || Toastify.defaults.selector; // Parent selector
      this.options.callback = options.callback || Toastify.defaults.callback; // Callback after display
      this.options.destination = options.destination || Toastify.defaults.destination; // On-click destination
      this.options.newWindow = options.newWindow || Toastify.defaults.newWindow; // Open destination in new window
      this.options.close = options.close || Toastify.defaults.close; // Show toast close icon
      this.options.gravity = options.gravity === "bottom" ? "toastify-bottom" : Toastify.defaults.gravity; // toast position - top or bottom
      this.options.positionLeft = options.positionLeft || Toastify.defaults.positionLeft; // toast position - left or right
      this.options.position = options.position || Toastify.defaults.position; // toast position - left or right
      this.options.backgroundColor = options.backgroundColor || Toastify.defaults.backgroundColor; // toast background color
      this.options.avatar = options.avatar || Toastify.defaults.avatar; // img element src - url or a path
      this.options.className = options.className || Toastify.defaults.className; // additional class names for the toast
      this.options.stopOnFocus = options.stopOnFocus === undefined ? Toastify.defaults.stopOnFocus : options.stopOnFocus; // stop timeout on focus
      this.options.onClick = options.onClick || Toastify.defaults.onClick; // Callback after click
      this.options.offset = options.offset || Toastify.defaults.offset; // toast offset
      this.options.escapeMarkup = options.escapeMarkup !== undefined ? options.escapeMarkup : Toastify.defaults.escapeMarkup;
      this.options.ariaLive = options.ariaLive || Toastify.defaults.ariaLive;
      this.options.style = options.style || Toastify.defaults.style;
      if(options.backgroundColor) {
        this.options.style.background = options.backgroundColor;
      }

      // Returning the current object for chaining functions
      return this;
    },

    // Building the DOM element
    buildToast: function() {
      // Validating if the options are defined
      if (!this.options) {
        throw "Toastify is not initialized";
      }

      // Creating the DOM object
      var divElement = document.createElement("div");
      divElement.className = "toastify on " + this.options.className;

      // Positioning toast to left or right or center
      if (!!this.options.position) {
        divElement.className += " toastify-" + this.options.position;
      } else {
        // To be depreciated in further versions
        if (this.options.positionLeft === true) {
          divElement.className += " toastify-left";
          console.warn('Property `positionLeft` will be depreciated in further versions. Please use `position` instead.')
        } else {
          // Default position
          divElement.className += " toastify-right";
        }
      }

      // Assigning gravity of element
      divElement.className += " " + this.options.gravity;

      if (this.options.backgroundColor) {
        // This is being deprecated in favor of using the style HTML DOM property
        console.warn('DEPRECATION NOTICE: "backgroundColor" is being deprecated. Please use the "style.background" property.');
      }

      // Loop through our style object and apply styles to divElement
      for (var property in this.options.style) {
        divElement.style[property] = this.options.style[property];
      }

      // Announce the toast to screen readers
      if (this.options.ariaLive) {
        divElement.setAttribute('aria-live', this.options.ariaLive)
      }

      // Adding the toast message/node
      if (this.options.node && this.options.node.nodeType === Node.ELEMENT_NODE) {
        // If we have a valid node, we insert it
        divElement.appendChild(this.options.node)
      } else {
        if (this.options.escapeMarkup) {
          divElement.innerText = this.options.text;
        } else {
          divElement.innerHTML = this.options.text;
        }

        if (this.options.avatar !== "") {
          var avatarElement = document.createElement("img");
          avatarElement.src = this.options.avatar;

          avatarElement.className = "toastify-avatar";

          if (this.options.position == "left" || this.options.positionLeft === true) {
            // Adding close icon on the left of content
            divElement.appendChild(avatarElement);
          } else {
            // Adding close icon on the right of content
            divElement.insertAdjacentElement("afterbegin", avatarElement);
          }
        }
      }

      // Adding a close icon to the toast
      if (this.options.close === true) {
        // Create a span for close element
        var closeElement = document.createElement("button");
        closeElement.type = "button";
        closeElement.setAttribute("aria-label", "Close");
        closeElement.className = "toast-close";
        closeElement.innerHTML = "&#10006;";

        // Triggering the removal of toast from DOM on close click
        closeElement.addEventListener(
          "click",
          function(event) {
            event.stopPropagation();
            this.removeElement(this.toastElement);
            window.clearTimeout(this.toastElement.timeOutValue);
          }.bind(this)
        );

        //Calculating screen width
        var width = window.innerWidth > 0 ? window.innerWidth : screen.width;

        // Adding the close icon to the toast element
        // Display on the right if screen width is less than or equal to 360px
        if ((this.options.position == "left" || this.options.positionLeft === true) && width > 360) {
          // Adding close icon on the left of content
          divElement.insertAdjacentElement("afterbegin", closeElement);
        } else {
          // Adding close icon on the right of content
          divElement.appendChild(closeElement);
        }
      }

      // Clear timeout while toast is focused
      if (this.options.stopOnFocus && this.options.duration > 0) {
        var self = this;
        // stop countdown
        divElement.addEventListener(
          "mouseover",
          function(event) {
            window.clearTimeout(divElement.timeOutValue);
          }
        )
        // add back the timeout
        divElement.addEventListener(
          "mouseleave",
          function() {
            divElement.timeOutValue = window.setTimeout(
              function() {
                // Remove the toast from DOM
                self.removeElement(divElement);
              },
              self.options.duration
            )
          }
        )
      }

      // Adding an on-click destination path
      if (typeof this.options.destination !== "undefined") {
        divElement.addEventListener(
          "click",
          function(event) {
            event.stopPropagation();
            if (this.options.newWindow === true) {
              window.open(this.options.destination, "_blank");
            } else {
              window.location = this.options.destination;
            }
          }.bind(this)
        );
      }

      if (typeof this.options.onClick === "function" && typeof this.options.destination === "undefined") {
        divElement.addEventListener(
          "click",
          function(event) {
            event.stopPropagation();
            this.options.onClick();
          }.bind(this)
        );
      }

      // Adding offset
      if(typeof this.options.offset === "object") {

        var x = getAxisOffsetAValue("x", this.options);
        var y = getAxisOffsetAValue("y", this.options);

        var xOffset = this.options.position == "left" ? x : "-" + x;
        var yOffset = this.options.gravity == "toastify-top" ? y : "-" + y;

        divElement.style.transform = "translate(" + xOffset + "," + yOffset + ")";

      }

      // Returning the generated element
      return divElement;
    },

    // Displaying the toast
    showToast: function() {
      // Creating the DOM object for the toast
      this.toastElement = this.buildToast();

      // Getting the root element to with the toast needs to be added
      var rootElement;
      if (typeof this.options.selector === "string") {
        rootElement = document.getElementById(this.options.selector);
      } else if (this.options.selector instanceof HTMLElement || (typeof ShadowRoot !== 'undefined' && this.options.selector instanceof ShadowRoot)) {
        rootElement = this.options.selector;
      } else {
        rootElement = document.body;
      }

      // Validating if root element is present in DOM
      if (!rootElement) {
        throw "Root element is not defined";
      }

      // Adding the DOM element
      var elementToInsert = Toastify.defaults.oldestFirst ? rootElement.firstChild : rootElement.lastChild;
      rootElement.insertBefore(this.toastElement, elementToInsert);

      // Repositioning the toasts in case multiple toasts are present
      Toastify.reposition();

      if (this.options.duration > 0) {
        this.toastElement.timeOutValue = window.setTimeout(
          function() {
            // Remove the toast from DOM
            this.removeElement(this.toastElement);
          }.bind(this),
          this.options.duration
        ); // Binding `this` for function invocation
      }

      // Supporting function chaining
      return this;
    },

    hideToast: function() {
      if (this.toastElement.timeOutValue) {
        clearTimeout(this.toastElement.timeOutValue);
      }
      this.removeElement(this.toastElement);
    },

    // Removing the element from the DOM
    removeElement: function(toastElement) {
      // Hiding the element
      // toastElement.classList.remove("on");
      toastElement.className = toastElement.className.replace(" on", "");

      // Removing the element from DOM after transition end
      window.setTimeout(
        function() {
          // remove options node if any
          if (this.options.node && this.options.node.parentNode) {
            this.options.node.parentNode.removeChild(this.options.node);
          }

          // Remove the element from the DOM, only when the parent node was not removed before.
          if (toastElement.parentNode) {
            toastElement.parentNode.removeChild(toastElement);
          }

          // Calling the callback function
          this.options.callback.call(toastElement);

          // Repositioning the toasts again
          Toastify.reposition();
        }.bind(this),
        400
      ); // Binding `this` for function invocation
    },
  };

  // Positioning the toasts on the DOM
  Toastify.reposition = function() {

    // Top margins with gravity
    var topLeftOffsetSize = {
      top: 15,
      bottom: 15,
    };
    var topRightOffsetSize = {
      top: 15,
      bottom: 15,
    };
    var offsetSize = {
      top: 15,
      bottom: 15,
    };

    // Get all toast messages on the DOM
    var allToasts = document.getElementsByClassName("toastify");

    var classUsed;

    // Modifying the position of each toast element
    for (var i = 0; i < allToasts.length; i++) {
      // Getting the applied gravity
      if (containsClass(allToasts[i], "toastify-top") === true) {
        classUsed = "toastify-top";
      } else {
        classUsed = "toastify-bottom";
      }

      var height = allToasts[i].offsetHeight;
      classUsed = classUsed.substr(9, classUsed.length-1)
      // Spacing between toasts
      var offset = 15;

      var width = window.innerWidth > 0 ? window.innerWidth : screen.width;

      // Show toast in center if screen with less than or equal to 360px
      if (width <= 360) {
        // Setting the position
        allToasts[i].style[classUsed] = offsetSize[classUsed] + "px";

        offsetSize[classUsed] += height + offset;
      } else {
        if (containsClass(allToasts[i], "toastify-left") === true) {
          // Setting the position
          allToasts[i].style[classUsed] = topLeftOffsetSize[classUsed] + "px";

          topLeftOffsetSize[classUsed] += height + offset;
        } else {
          // Setting the position
          allToasts[i].style[classUsed] = topRightOffsetSize[classUsed] + "px";

          topRightOffsetSize[classUsed] += height + offset;
        }
      }
    }

    // Supporting function chaining
    return this;
  };

  // Helper function to get offset.
  function getAxisOffsetAValue(axis, options) {

    if(options.offset[axis]) {
      if(isNaN(options.offset[axis])) {
        return options.offset[axis];
      }
      else {
        return options.offset[axis] + 'px';
      }
    }

    return '0px';

  }

  function containsClass(elem, yourClass) {
    if (!elem || typeof yourClass !== "string") {
      return false;
    } else if (
      elem.className &&
      elem.className
        .trim()
        .split(/\s+/gi)
        .indexOf(yourClass) > -1
    ) {
      return true;
    } else {
      return false;
    }
  }

  // Setting up the prototype for the init object
  Toastify.lib.init.prototype = Toastify.lib;

  // Returning the Toastify function to be assigned to the window object/module
  return Toastify;
});

/*==================================================================================
          LOGIC TO SHOW MOBILE MENU ON MOBILE DEVICES FOR RESPONSIVENESS
=====================================================================================*/
document.addEventListener('DOMContentLoaded', () => {
  const mobileMenu = document.getElementById('mobile-menu');
  const navOpen = document.getElementById('nav-open');
  const navClose = document.getElementById('nav-close');

  /* show the mobile Menu */
  if (navOpen) {
      navOpen.addEventListener('click', () => {
          mobileMenu.classList.remove('right-[-100%]');
          mobileMenu.classList.add('right-0');
          document.body.classList.add('no-scroll');
      });
  }

  /* Hide the mobile menu*/
  if (navClose) {
      navClose.addEventListener('click', () => {
          mobileMenu.classList.add('right-[-100%]');
          mobileMenu.classList.remove('right-0');
          document.body.classList.remove('no-scroll');
      });
  }
});


/*====================================================================================
  This functinality will be used to toggle the visibility of a dropdown menu
  when the profile section of the header is clicked.
======================================================================================*/
document.addEventListener('DOMContentLoaded', () => {
  const user_account_btn = document.getElementById('user-account-btn')
  if (user_account_btn) {
      user_account_btn.addEventListener('click', function() {
          const dropdownMenu = document.getElementById("user-account-dropdown");
          dropdownMenu.classList.toggle('hidden');
      }); 
  }
});

/*====================================================================================
      To achieve a more pronounced visual feedback when clicking on a link on 
      Navigation
======================================================================================*/
document.addEventListener('DOMContentLoaded', () => {
  //we have to ensure that indeed the header section is loaded to avoid errors
  const header_section = document.getElementById('header-section');
  if (header_section) {
      document.querySelectorAll('.nav-link').forEach((link) => {
          link.addEventListener('click', function () {
              //when a link is clicked remove all active class styles from all links
              document.querySelectorAll('.nav-link').forEach((l) => {
                  l.classList.remove('bg-[#fc4b3b]', 'text-white');
              });
              // add the active styles to the clicked link
              this.classList.add('bg-[#fc4b3b]', 'text-white');
          });
      });
  }
})

/*====================================================================================
      Initiating an  MPESA STK PUSH 
======================================================================================*/
document.addEventListener('DOMContentLoaded', () => {
  const payButton = document.getElementById('payButton');
  const confirmationModal = document.getElementById('confirmationModal');
  const cancelButton = document.getElementById('cancelButton');
  const confirmButton = document.getElementById('confirmButton');
  const paymentForm = document.getElementById('paymentForm');
  const stkPushModal = document.getElementById('stkPushModal');
  const stkPushModalMessage = document.getElementById('stkPushModalMessage');
  const stkPushModalIcon = document.getElementById('stkPushModalIcon');
  const closeStkPushModalButton = document.getElementById('closeStkPushModal');
  // Maximum time for polling before we stop checking if payment has been done
  const MAX_POLLING_TIME = 30000;
  const closeAlertBtn = document.getElementById('closeAlertBtn');
  const customAlert = document.getElementById('customAlert');

  if (payButton && paymentForm) {
    // Show confirmation modal when pay with mpesa button is shown and disable scrolling
    payButton.addEventListener('click', () => {
      console.log('payment Button clicked');
      if (validateForm()) {
        confirmationModal.classList.remove('hidden');
        document.body.classList.add('no-scroll');
      }
    });

    // close the custom Alert modal when we click the close button
    closeAlertBtn.addEventListener('click', closeCustomAlert);

    // Proceed with payment when confirm button is clicked and also start pooling to see the payment status
    confirmButton.addEventListener('click', () => {
      //close the confirmation modal first
      confirmationModal.classList.add('hidden');
      document.body.classList.remove('no-scroll');

      //if the form data is valid submit initiate the payment .
      if (validateForm()) {
        const formData = new FormData(paymentForm);
        initiatePayment(formData);
      }
    });

    // Hide the confirmation modal when the cancel button is clicked and enable scrolling
    cancelButton.addEventListener('click', () => {
      confirmationModal.classList.add('hidden');
      document.body.classList.remove('no-scroll');
    });
  }
  // function to validate the data from the form in receipt blade file
  function validateForm() {
    const email = paymentForm.email.value;
    const phoneNumber = paymentForm.phoneNumber.value;
    const country = paymentForm.country.value;
    const fullname = paymentForm.fullname.value;
    const address = paymentForm.address.value;
    const city = paymentForm.city.value;

    if (!email || !phoneNumber || !country || !fullname || !address || !city) {
      showCustomAlert('Please fill in all required fields.');
      return false;
    }
    // Add regex for additional email validation as needed
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      showCustomAlert('Please enter a valid email address.');
      return false;
    }
    // if all validations pass return true
    return true;
  }

  // function to show stk push modal depending if there is an error or success
  function showStkPushModal(isSuccess, message) {
    if (isSuccess) {
        stkPushModalIcon.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" class="bi bi-check2-circle" viewBox="0 0 16 16">
            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
        </svg>`;
    } else {
        stkPushModalIcon.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-exclamation-lg" viewBox="0 0 16 16">
            <path d="M7.005 3.1a1 1 0 1 1 1.99 0l-.388 6.35a.61.61 0 0 1-1.214 0zM7 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0"/>
        </svg>`;
    }

    stkPushModalMessage.textContent = message;

    // Show the modal with animation and also disable scrolling
    stkPushModal.classList.remove('hidden');
    stkPushModal.classList.add('modal-enter');
    document.body.classList.add('no-scroll');
  
    // Close the modal when the close button is clicked
    closeStkPushModalButton.addEventListener('click', function () {
      closeStkPushModal();
    })
  }

  // function to close stkpush modal
  function closeStkPushModal () {
    stkPushModal.classList.remove('modal-enter');
    stkPushModal.classList.add('modal-exit');
    stkPushModal.classList.add('hidden');
    document.body.classList.remove('no-scroll');
  }

  // Function to show the custom alert modal when Validation fails or another logic instead of using Javascript alert
  function showCustomAlert(message) {
    const alertMessage = customAlert.querySelector('p');
    alertMessage.textContent = message;
    customAlert.classList.remove('hidden');
    customAlert.classList.add('show');
    document.body.classList.add('no-scroll');
  }

  // Function to close the custom alert modal when close button is hit
  function closeCustomAlert() {
    customAlert.classList.remove('show');
    customAlert.classList.add('hidden');
    document.body.classList.remove('no-scroll');
  }

  //function to initiate payment by calling the route specified in the form action field
  async function initiatePayment(formData) {
    try {
      const response = await fetch(paymentForm.action, {
        method: 'POST',
        body: formData,
      });

      const data = await response.json();

      if (!response.ok || !data) {
        // Check for successful response
        showStkPushModal(false, 'Error: Invalid response from server.');
        return;
      }

      if (data.error) {
        // If STK push was not successful
        console.log(data);
        showStkPushModal(false, data.error);
      } else {
        // If STK push was successful. Inform customer
        showStkPushModal(true, 'Payment request has been sent. Please check your phone to complete the transaction.');
        // Start polling to check payment status.
        checkPaymentStatus(data.CheckoutRequestID);
      }
    } catch (error) {
      console.log('Error:', error);
      showStkPushModal(false, 'There was an issue initiating the payment. Please try again.');
    }
  }

  //function to check payment status by using the pooling method
  function checkPaymentStatus(checkoutRequestId) {
    let pollingTime = 0;

    const interval = setInterval(() => {
      if (pollingTime >= MAX_POLLING_TIME) {
        clearInterval(interval);
        showStkPushModal(false, 'Payment status check timed out. Please try again later.');
        return;
      }
      fetch(`/payment-status/${checkoutRequestId}`).then(response => response.json()).then(data => {
        if (!data || data.error) {
          console.error('Error fetching payment status:', data.error || 'Unknown error');
          return;
        }
        // Update UI based on payment status
        if (data.status === 'completed') {
          clearInterval(interval);
          showStkPushModal(true, 'Payment completed successfully!');

          // Wait for 1.5s before closing the modal and redirecting partner to their dashboard to see their new commission earned!
          setTimeout(() => {
            closeStkPushModal();
            window.location.href = '/my-account?toast=success';
          }, 1500);
      
        } else if (data.status === 'failed') {
          clearInterval(interval);
          showStkPushModal(false, 'Payment failed. Please try again.');
        }
      })
      .catch(error => {
        console.error('Error fetching payment status:', error);
      });

      // Increment polling time by 3 seconds
      pollingTime += 3000;
    }, 3000); // Check every 3 seconds
  }
})

/*
==========================================================================================
  The following code below will be used to toggle visibility of the password
  In a login page
==========================================================================================
*/
document.addEventListener('DOMContentLoaded', function () {
  const passwordButtonToggler = document.getElementById('toggle-password-button');
  const loginPage = document.getElementById('login-page');

  if (loginPage) {
      function togglePasswordVisibility() {
          const passwordInput = document.getElementById('password');
          const eyeOpen = document.getElementById('eye-open');
          const eyeClosed = document.getElementById('eye-closed');
      
          if (passwordInput.type === 'password') {
              passwordInput.type = 'text';
              eyeOpen.classList.remove('hidden');
              eyeClosed.classList.add('hidden');
          } else {
              passwordInput.type = 'password';
              eyeOpen.classList.add('hidden');
              eyeClosed.classList.remove('hidden');
          }
      }
      passwordButtonToggler.addEventListener('click', function () {
          togglePasswordVisibility();
      })
  }
});

/*
==========================================================================================
  The following code below will be used to toggle visibility of the password
  In a Registration page
==========================================================================================
*/
document.addEventListener('DOMContentLoaded', function () {
  const registrationPage = document.getElementById('register-page');

  const passwordInput = document.getElementById('password');
  const passwordButton = document.getElementById('passwordButton');
  const eye_open = document.getElementById('eye-open');
  const eye_closed = document.getElementById('eye-closed');

  const confirmPasswordInput = document.getElementById('password_confirmation');
  const confirmPasswordButton = document.getElementById('password_confirmation_button');
  const eye_open_confirm = document.getElementById('eye-open-confirm');
  const eye_close_confirm = document.getElementById('eye-closed-confirm');

  if (registrationPage) {
      function togglePasswordVisibility() {
          if (passwordInput.type === 'password') {
              passwordInput.type = 'text';
              eye_open.classList.remove('hidden');
              eye_closed.classList.add('hidden');
          } else {
              passwordInput.type = 'password';
              eye_open.classList.add('hidden');
              eye_closed.classList.remove('hidden');
          }
      }
      passwordButton.addEventListener('click', function () {
          togglePasswordVisibility();
      })
      
      function togglePasswordVisibilityConfirm() {
          if (confirmPasswordInput.type === 'password') {
              confirmPasswordInput.type = 'text';
              eye_open_confirm.classList.remove('hidden');
              eye_close_confirm.classList.add('hidden');
          } else {
              confirmPasswordInput.type = 'password';
              eye_open_confirm.classList.add('hidden');
              eye_close_confirm.classList.remove('hidden');
          }
      }
      confirmPasswordButton.addEventListener('click', function () {
          togglePasswordVisibilityConfirm();
      })
  }
});

/*====================================================================================
          Toggle the visibility of Infomation modal on the home page
          when user clicks the system security home section
======================================================================================*/
document.addEventListener('DOMContentLoaded', () => {
  const showHomeModalButton = document.getElementById('showHomeModal');
  const modal = document.getElementById('info-modal');
  const closeModalButton = document.getElementById('modal-close');
  const modalContent = document.getElementById('modal-content');

  // function to open the modal
  function openModal() {
      modal.classList.remove('hidden');
      modal.classList.add('show');
      setTimeout(() => {
          modalContent.classList.add('show');
      }, 10)
      document.body.classList.add('no-scroll');
  }

  // function to close the modal
  function closeModal() {
      modalContent.classList.remove('show');
      setTimeout(() => {
          modal.classList.remove('show');
          modal.classList.add('hidden'); // Hide the modal after the transition
      }, 500); // Match this with your transition duration of the modal content
      document.body.classList.remove('no-scroll')
  }

  //ensure that we are indeed in the home page
  if(showHomeModalButton) {
      showHomeModalButton.addEventListener('click', function() {
          openModal();
      })

      closeModalButton.addEventListener('click', function() {
          closeModal();
      })
  }
}) 

/*====================================================================================
          Toggle the visibility of the Our services modal in the about page.
======================================================================================*/
document.addEventListener('DOMContentLoaded', () => {
  const ourServicesModal = document.getElementById('ourServicesModal');
  const closeModalButton = document.getElementById('closeButton');
  
  if (ourServicesModal) {    
      // function to open the modal and set its content
      function openModal(title, description, iconSrc) {
          document.getElementById("modalTitle").innerText = title;
          document.getElementById("modalDescription").innerText = description;
          document.getElementById("modalIcon").src = iconSrc;
          ourServicesModal.classList.remove("hidden");
      }
      function closeModal() {
          ourServicesModal.classList.add('hidden');
      }

      closeModalButton.addEventListener('click', closeModal)

      // Attaching openModal to service card buttons
      document.querySelectorAll('.service-card-button').forEach(button => {
          button.addEventListener('click', () => {
              const title = button.getAttribute('data-title');
              const description = button.getAttribute('data-description');
              const iconSrc = document.getElementById('icon').src
              openModal(title, description, iconSrc);
          });
      });
  }
}) 

/*====================================================================================
          This is the partners page section. The section where the partner will be
          to see their commissions
======================================================================================*/
document.addEventListener('DOMContentLoaded', () => {
  const partnerPage = document.getElementById('partnerPage');
  const overlay = document.getElementById('overlay');
  const sidebar = document.getElementById('sidebar');
  const openSidebarButton = document.getElementById('OpenSidebarButton');
  const closeSidebar = document.getElementById('closeSidebar');

  const myClientsLink = document.getElementById('myClients');
  const clientsSection = document.getElementById('clientsSection');
  const clientSearchInput = document.getElementById('clientSearchInput');

  const myEarningsLink = document.getElementById('myEarnings');
  const earningsSection = document.getElementById('earningsSection');

  const productsSold = document.getElementById('productsSold');
  const productsSection = document.getElementById('productsSection');

  const mySettings = document.getElementById('mySettings');
  const settingsSection = document.getElementById('settingsSection');

  // a function to toggle the opening and closing of sidebar depending on the
  // boolean variable passed
  function toggleSidebar(isOpen) {
      if (isOpen) {
          sidebar.classList.remove('translate-x-[-100%]');
          sidebar.classList.add('translate-x-0');
          overlay.classList.remove('hidden');
          overlay.classList.add('block');
      } else {
          sidebar.classList.add('translate-x-[-100%]');
          sidebar.classList.remove('translate-x-0');
          overlay.classList.remove('block');
          overlay.classList.add('hidden');
      }
  }

  //this function will hide all the sections in the dashboard
  // by adding the hidden class
  function hideAllSections () {
      clientsSection.classList.add('hidden');
      earningsSection.classList.add('hidden');
      productsSection.classList.add('hidden');
      settingsSection.classList.add('hidden');
  }
  
  // ensure that we are running these scripts while on partner page
  if (partnerPage) {
      //close the sidebar when you click outside the sidebar when open
      overlay.addEventListener('click', function () {
          toggleSidebar(false);
      });

      //open the sidebar
      openSidebarButton.addEventListener('click', function() {
          toggleSidebar(true);
      });

      //close the sidebar on mobile screen
      closeSidebar.addEventListener('click', function() {
          toggleSidebar(false);
      });

      //Show the clients section
      myClientsLink.addEventListener('click', function () {
          hideAllSections();
          clientsSection.classList.remove('hidden');
          toggleSidebar(false);
      })
      //search functionality for clients section
      clientSearchInput.addEventListener('keyup', function () {
          const filter = clientSearchInput.value.toLowerCase();
          const table = document.querySelector('table');
          const rows = table.getElementsByTagName('tr');

          for (let i = 1; i < rows.length; i++) {
              const cells = rows[i].getElementsByTagName('td');
              const nameCell = cells[0]; // Assuming the name is in the first column
      
              if (nameCell) {
                  const txtValue = nameCell.textContent || nameCell.innerText;
                  rows[i].style.display = txtValue.toLowerCase().includes(filter) ? '' : 'none';
              }
          }
      })

      //show the earnings section
      myEarningsLink.addEventListener('click', function () {
          hideAllSections();
          earningsSection.classList.remove('hidden');
          toggleSidebar(false);
      });

      //shows the products sold section
      productsSold.addEventListener('click', function () {
          hideAllSections();
          productsSection.classList.remove('hidden');
          toggleSidebar(false);
      });

      //show the settings section
      mySettings.addEventListener('click', function () {
          hideAllSections();
          settingsSection.classList.remove('hidden');
          toggleSidebar(false);
      });
  }
});