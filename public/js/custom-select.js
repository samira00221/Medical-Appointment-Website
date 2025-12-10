document.addEventListener('DOMContentLoaded', function () {
    const customSelect = document.querySelector('.custom-select');
    const trigger = customSelect.querySelector('.custom-select-trigger');
    const options = customSelect.querySelectorAll('.custom-option');

    customSelect.addEventListener('click', function (e) {
        this.classList.toggle('open');
    });

    options.forEach(option => {
        option.addEventListener('click', function (e) {
            options.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            trigger.textContent = this.textContent;
            customSelect.classList.remove('open');
            // You can add your language change logic here
        });
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', function (e) {
        if (!customSelect.contains(e.target)) {
            customSelect.classList.remove('open');
        }
    });

    document.querySelectorAll('.language-menu-options a').forEach(link => {
  link.addEventListener('click', () => {
    const lang = link.textContent.trim().toLowerCase();
    if (lang === 'fr') {
      window.location.href = 'index-fr.html';
    } else {
      window.location.href = 'index.html';
    }
  });
});

});