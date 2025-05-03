document.addEventListener('DOMContentLoaded', function() {
  // Check if cookie consent is already given
  if (localStorage.getItem('cookieConsent')) {
      document.querySelector('.cookie-consent').style.display = 'none';
  } else {
      document.querySelector('.cookie-consent').style.display = 'block';
  }
  
  // Accept cookies button
  document.getElementById('acceptCookies')?.addEventListener('click', function() {
      localStorage.setItem('cookieConsent', 'accepted');
      document.querySelector('.cookie-consent').style.display = 'none';
  });
  
  // Learn more button
  document.getElementById('learnMore')?.addEventListener('click', function() {
      window.location.href = 'cookies.php';
  });
});