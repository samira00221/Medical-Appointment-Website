// ====== Mobile Menu Toggle ======
document.getElementById('menu-toggle')?.addEventListener('click', () => {
  document.getElementById('menu').classList.toggle('show');
});


// ====== Fade-in on Scroll ======
document.addEventListener('DOMContentLoaded', () => {
  const fadeElements = document.querySelectorAll('.fade-in');

  function checkFadeIn() {
    fadeElements.forEach(el => {
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight - 100) {
        el.classList.add('visible');
      }
    });
  }

  window.addEventListener('scroll', checkFadeIn);
  checkFadeIn(); // Initial call
});
