export function initNavbarEvents() {
  console.log("Navbar inicializada");
  const menuToggle = document.getElementById('menu-toggle');
  const navLinks = document.getElementById('nav-links');

  if (!menuToggle || !navLinks) {
    console.log("Elementos não encontrados");
    return;
  }

  menuToggle.addEventListener('click', () => {
    console.log("Clicou no menu");
    navLinks.classList.toggle('active');
    menuToggle.classList.toggle('active');
  });

  document.addEventListener('click', (e) => {
    const isClickInsideMenu = navLinks.contains(e.target);
    const isClickOnToggle = menuToggle.contains(e.target);

    if (!isClickInsideMenu && !isClickOnToggle && navLinks.classList.contains('active')) {
      navLinks.classList.remove('active');
      menuToggle.classList.remove('active');
    }
  });

  const dropdowns = document.querySelectorAll('.dropdown');
  dropdowns.forEach(dropdown => {
    const link = dropdown.querySelector('a');

    link.addEventListener('click', (e) => {
      if (window.innerWidth <= 768) {
        e.preventDefault();
        dropdown.classList.toggle('active');
      }
    });
  });
}
