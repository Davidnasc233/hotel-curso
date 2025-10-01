// js/main.js

// Importa as funções de inicialização de cada módulo
import { initNewsletter } from './modules/newsletter.js';
import { initHeaderScroll } from './modules/headerScroll.js';
import { initAccommodationFilter } from './modules/accommodationFilter.js';
import { initRoomModal } from './modules/roomModal.js';

// Espera o DOM carregar completamente para executar os scripts
document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM fully loaded and parsed. Initializing modules...");

  // Inicializa cada módulo
  initNewsletter();
  initHeaderScroll();
  initAccommodationFilter();
  initRoomModal();
  
  // O código dos inputs de data pode ficar aqui se for simples,
  // ou ser movido para seu próprio módulo (ex: datePicker.js) se crescer.
  const checkInInput = document.getElementById("check_in");
  const checkOutInput = document.getElementById("check_out");

  if (checkInInput) {
    checkInInput.addEventListener("change", () => {
      console.log("Data de entrada selecionada:", checkInInput.value);
    });
  } else {
    console.warn("Elemento 'check_in' não encontrado.");
  }

  if (checkOutInput) {
    checkOutInput.addEventListener("change", () => {
      console.log("Data de saída selecionada:", checkOutInput.value);
    });
  } else {
    console.warn("Elemento 'check_out' não encontrado.");
  }
});