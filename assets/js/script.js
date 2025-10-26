// js/main.js

// Importa as funções de inicialização de cada módulo
import { initNewsletter } from "../../assets/js/modules/newsletter.js";
import { initHeaderScroll } from "../../assets/js/modules/header-scroll.js";
import { initAccommodationFilter } from "../../assets/js/modules/accommodation-filter.js";
import { initRoomModal } from "../../assets/js/modules/room-modal.js";
import { initInputMasks } from "./utils/input-mask.js";
import { initReservationForm } from "./modules/reservation-form.js";
import { initRoomEditing } from "./modules/room-editing.js";

document.addEventListener("DOMContentLoaded", function () {
  // Inicializa cada módulo
  initNewsletter();
  initHeaderScroll();
  initRoomModal();
  initInputMasks();
  initReservationForm();
  initRoomEditing();
  initAccommodationFilter();
});
