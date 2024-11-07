  // Staff JS ////////////////////////////////////////////////////////////////////////////////////////////////////////
// Run the function when the page loads to ensure correct state

var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}

document.addEventListener('DOMContentLoaded', function() {
    // Initially hide all sections
    document.querySelectorAll('.content-section').forEach(section => {
        section.style.display = 'none';
    });

    // Handle navigation link clicks
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default anchor behavior

            // Remove 'active' class from all nav links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });

            // Add 'active' class to the clicked link
            this.classList.add('active');

            // Get the target section ID from the clicked link
            const targetId = this.getAttribute('data-target');

            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.style.display = 'none';
            });

            // Show the selected section
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.style.display = 'block';
            } else {
                console.log('No section found with ID:', targetId);
            }
        });
    });

    // Show the first section by default (optional)
    const firstNavLink = document.querySelector('.nav-link[data-target]');
    if (firstNavLink) {
        firstNavLink.click();
    }
});

// Function to toggle profile edit view
function toggleEditProfile() {
    document.getElementById('viewProfile').style.display = 'none';
    document.getElementById('editProfile').style.display = 'block';
}

function toggleViewProfile() {
    document.getElementById('editProfile').style.display = 'none';
    document.getElementById('viewProfile').style.display = 'block';
}

// Function to update date and time
function updateDateTime() {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
    document.getElementById('date-time').textContent = now.toLocaleDateString('en-US', options);
}

// Update date and time every second
setInterval(updateDateTime, 1000);

// Initialize date and time on page load
updateDateTime();


// Admin JS /////////////////////////////////////////////////////////////////////////////////////////////////////////
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    document.addEventListener('DOMContentLoaded', function() {
  // Initially hide all sections
  document.querySelectorAll('.content-section').forEach(section => {
    section.style.display = 'none';
  });

  // Handle navigation link clicks
  document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(event) {
      event.preventDefault();

      // Debugging: Log which link was clicked
      console.log('Clicked link:', this.getAttribute('data-target'));

      // Remove 'active' class from all nav links
      document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
      });

      // Add 'active' class to the clicked link
      this.classList.add('active');

      // Get the target section ID from the clicked link
      const targetId = this.getAttribute('data-target');
      console.log('Target ID:', targetId);  // Debugging

      // Hide all sections
      document.querySelectorAll('.content-section').forEach(section => {
        console.log('Hiding section:', section.id); // Debugging
        section.style.display = 'none';
      });

      // Show the selected section
      const targetSection = document.getElementById(targetId);
      if (targetSection) {
        console.log('Showing section:', targetSection.id); // Debugging
        targetSection.style.display = 'block';
      } else {
        console.log('No section found with ID:', targetId); // Debugging
      }
    });
  });

  // Optionally, show the first section by default
  const firstNavLink = document.querySelector('.nav-link[data-target]');
  if (firstNavLink) {
    firstNavLink.click();
  }
});
 // Function to toggle between view and edit profile
 function toggleEditProfile() {
    document.getElementById('viewProfile').style.display = 'none';
    document.getElementById('editProfile').style.display = 'block';
  }

  function toggleViewProfile() {
    document.getElementById('viewProfile').style.display = 'block';
    document.getElementById('editProfile').style.display = 'none';
  }
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[data-target]').forEach(anchor => {
        anchor.addEventListener('click', function(event) {
            // Custom logic for data-target links
            event.preventDefault(); // Prevents the default action, if needed
        });
    });
});
function updateDateTime() {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
    document.getElementById('date-time').textContent = now.toLocaleDateString('en-US', options);
  }

  // Update date and time every second
  setInterval(updateDateTime, 1000);

  // Initialize date and time on page load
  updateDateTime();

  document.addEventListener('DOMContentLoaded', function () {
    // Check if there's a 'section' query parameter in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const section = urlParams.get('section');

    // If the section is 'Annouce', display the Announcement section
    if (section === 'Annouce') {
        document.getElementById('Annouce').style.display = 'block';
    } else {
        // Optionally, you can set other sections to be displayed by default
        // For example:
        // document.getElementById('Dashboard').style.display = 'block';
    }
});










//Officer JS /////////////////////////////////////////////////////////////////////////////////////////////////////
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    document.addEventListener('DOMContentLoaded', function() {
    // Initially hide all sections
    document.querySelectorAll('.content-section').forEach(section => {
      section.style.display = 'none';
    });

    // Handle navigation link clicks
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', function(event) {
        event.preventDefault();

        // Remove 'active' class from all nav links
        document.querySelectorAll('.nav-link').forEach(link => {
          link.classList.remove('active');
        });

        // Add 'active' class to the clicked link
        this.classList.add('active');

        // Get the target section ID from the clicked link
        const targetId = this.getAttribute('data-target');

        // Hide all sections
        document.querySelectorAll('.content-section').forEach(section => {
          section.style.display = 'none';
        });

        // Show the selected section
        const targetSection = document.getElementById(targetId);
        if (targetSection) {
          targetSection.style.display = 'block';
        } else {
          console.log('No section found with ID:', targetId);
        }
      });
    });

    // Show the first section by default (optional)
    const firstNavLink = document.querySelector('.nav-link[data-target]');
    if (firstNavLink) {
      firstNavLink.click();
    }
  });
  function toggleEditProfile() {
    document.getElementById('viewProfile').style.display = 'none';
    document.getElementById('editProfile').style.display = 'block';
  }

  function toggleViewProfile() {
    document.getElementById('editProfile').style.display = 'none';
    document.getElementById('viewProfile').style.display = 'block';
  }
  function updateDateTime() {
    const now = new Date();
    const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };

    document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', dateOptions);
    document.getElementById('current-time').textContent = now.toLocaleTimeString('en-US', timeOptions);
}

// Update date and time every second
setInterval(updateDateTime, 1000);

// Initialize date and time on page load
updateDateTime();

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;
    const alertMessage = document.getElementById('password-alert');

    if (password !== passwordConfirmation) {
        alertMessage.classList.remove('d-none'); // Show alert if passwords don't match
    } else {
        alertMessage.classList.add('d-none'); // Hide alert if passwords match
    }
}

function validatePassword() {
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;

    // Check if passwords match before form submission
    if (password !== passwordConfirmation) {
        alert('Kata laluan tidak sepadan!'); // Alert user on submission if passwords don't match
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}
    $(document).ready(function() {
        // Initialize Summernote
        $('.summernote').summernote({
            height: 150, // Set editor height
            toolbar: [ // Customize the toolbar as needed
                ['style', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    // Update the hidden textarea with the content
                    $('#hidden_rejection_reason').val(contents);
                }
            }
        });

        // When the modal is shown, clear and reset Summernote
        $('#rejectionReasonModal-{{ $application->id }}').on('show.bs.modal', function () {
            $('.summernote').summernote('reset');
            $('#hidden_rejection_reason').val('');
        });
    });
    






