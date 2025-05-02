// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
  const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
  const mainNav = document.querySelector('.main-nav');
  
  if (mobileMenuBtn && mainNav) {
      mobileMenuBtn.addEventListener('click', function() {
          mainNav.classList.toggle('active');
      });
  }
  
  // Sign up modal
  const signUpBtn = document.getElementById('signUpBtn');
  const signUpModal = document.getElementById('signUpModal');
  const closeModal = document.querySelector('.close-modal');
  
  if (signUpBtn && signUpModal) {
      signUpBtn.addEventListener('click', function() {
          signUpModal.style.display = 'flex';
      });
  }
  
  if (closeModal && signUpModal) {
      closeModal.addEventListener('click', function() {
          signUpModal.style.display = 'none';
      });
  }
  
  // Close modal when clicking outside
  if (signUpModal) {
      signUpModal.addEventListener('click', function(e) {
          if (e.target === signUpModal) {
              signUpModal.style.display = 'none';
          }
      });
  }
  
  // Form validation
  const forms = document.querySelectorAll('form');
  forms.forEach(form => {
      form.addEventListener('submit', function(e) {
          let valid = true;
          const inputs = form.querySelectorAll('input[required]');
          
          inputs.forEach(input => {
              if (!input.value.trim()) {
                  valid = false;
                  input.classList.add('error');
              } else {
                  input.classList.remove('error');
              }
          });
          
          // Check password match for signup form
          if (form.id === 'signupForm') {
              const password = document.getElementById('password');
              const confirmPassword = document.getElementById('confirmPassword');
              
              if (password.value !== confirmPassword.value) {
                  valid = false;
                  confirmPassword.classList.add('error');
                  alert('Passwords do not match!');
              }
          }
          
          if (!valid) {
              e.preventDefault();
          }
      });
  });
  
  // Check if cookie consent is needed
  checkCookieConsent();
});

// Cookie consent functions
function checkCookieConsent() {
  if (!localStorage.getItem('cookieConsent')) {
      document.querySelector('.cookie-consent').style.display = 'block';
  }
}

document.getElementById('acceptCookies')?.addEventListener('click', function() {
  localStorage.setItem('cookieConsent', 'accepted');
  document.querySelector('.cookie-consent').style.display = 'none';
});

document.getElementById('learnMore')?.addEventListener('click', function() {
  window.location.href = 'cookies.php';
});