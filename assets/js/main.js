import { initNavbarEvents } from './components/navbar.js';
import { initModalEvents } from './components/modal.js';

console.log("main.js carregado");

document.addEventListener('DOMContentLoaded', () => {
  initNavbarEvents();
  initModalEvents();
});
