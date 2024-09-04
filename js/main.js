// <!-- Utvecklad av Maja Afzelius 2023 -->

"use strict";
// hämta element
const themeToggle = document.getElementById('theme-toggle');
const link = document.getElementById('theme-link');
const storedTheme = localStorage.getItem('theme');

if (storedTheme) {
  link.setAttribute('href', storedTheme);
}
// eventlistener på knapp för att byta tema 
themeToggle.addEventListener('click', () => {
  if (link.getAttribute('href') === 'css/main.css') {
    link.setAttribute('href', 'css/dark_mode.css');
    localStorage.setItem('theme', 'css/dark_mode.css');
  } else {
    link.setAttribute('href', 'css/main.css');
    localStorage.setItem('theme', 'css/main.css');
  }
});

