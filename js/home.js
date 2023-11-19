const links = document.querySelectorAll('.nav-link');

function toggleActive(activeLink) {
  links.forEach(link => link.classList.remove('active'));
  activeLink.classList.add('active');
}

links.forEach(link => link.addEventListener('click', () => toggleActive(link)));