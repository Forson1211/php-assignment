document.addEventListener('DOMContentLoaded', function() {
  const slides = document.querySelectorAll('.slide');
  const prevBtn = document.querySelector('.prev-slide');
  const nextBtn = document.querySelector('.next-slide');
  let currentSlide = 0;
  
  // Show first slide
  showSlide(currentSlide);
  
  // Auto slide change
  let slideInterval = setInterval(nextSlide, 5000);
  
  // Next slide function
  function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
  }
  
  // Previous slide function
  function prevSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);
  }
  
  // Show specific slide
  function showSlide(index) {
      slides.forEach(slide => slide.classList.remove('active'));
      slides[index].classList.add('active');
      
      // Reset timer when manually changing slides
      clearInterval(slideInterval);
      slideInterval = setInterval(nextSlide, 5000);
  }
  
  // Event listeners for buttons
  if (nextBtn && prevBtn) {
      nextBtn.addEventListener('click', nextSlide);
      prevBtn.addEventListener('click', prevSlide);
  }
  
  // Pause on hover
  const slider = document.querySelector('.slider');
  if (slider) {
      slider.addEventListener('mouseenter', function() {
          clearInterval(slideInterval);
      });
      
      slider.addEventListener('mouseleave', function() {
          clearInterval(slideInterval);
          slideInterval = setInterval(nextSlide, 5000);
      });
  }
});