// js/modules/roomModal.js

const quartos = {
  casal01: {
    title: "Detalhes do Quarto Casal 01",
    description:
      "Este quarto possui uma cama de casal, ar-condicionado, Wi-Fi gratuito e uma vista incrível.",
    price: "R$ 299,00 por noite",
  },
  solteiro01: {
    title: "Detalhes do Quarto Solteiro 01",
    description:
      "Este quarto possui uma cama de solteiro, ar-condicionado, Wi-Fi gratuito e uma vista incrível.",
    price: "R$ 199,00 por noite",
  },
  casalSuite: {
    title: "Detalhes da Suíte Casal",
    description:
      "Esta suíte possui uma cama de casal, ar-condicionado, Wi-Fi gratuito, banheira e uma vista incrível.",
    price: "R$ 299,00 por noite",
  },
};

const modalRoom = document.getElementById("modalRoom");

function abrirModalDetalhes(quartoId) {
  const quarto = quartos[quartoId];
  if (quarto && modalRoom) {
    document.getElementById("modalTitle").textContent = quarto.title;
    document.getElementById("modalDescription").textContent =
      quarto.description;
    document.getElementById(
      "modalPrice"
    ).innerHTML = `Preço: <strong>${quarto.price}</strong>`;
    modalRoom.classList.add("show");
  }
}


function fecharModalDetalhes() {
  if (modalRoom) {
    modalRoom.classList.remove("show");
  }
}

export function initRoomModal() {
  if (!modalRoom) {
    console.warn("Modal de quartos não encontrado.");
    return;
  }

  const closeModalButton = document.getElementById("closeModalRoom");
  const btnCloseModal = modalRoom.querySelector(".btn-close-modal");
  const saibaMaisButtons = document.querySelectorAll(".quarto-card button");
  const quartoIds = ["solteiro01", "casal01", "casalSuite"]; // Garante a ordem correta

  // Eventos para fechar o modal
  if (closeModalButton) {
    closeModalButton.addEventListener("click", fecharModalDetalhes);
  }
  if (btnCloseModal) {
    btnCloseModal.addEventListener("click", fecharModalDetalhes);
  }
  window.addEventListener("click", (event) => {
    if (event.target === modalRoom) {
      fecharModalDetalhes();
    }
  });
  // Adicionar eventos aos botões "SAIBA MAIS"
  saibaMaisButtons.forEach((button, index) => {
    const quartoId = quartoIds[index];
    if (quartoId) {
      button.addEventListener("click", () => abrirModalDetalhes(quartoId));
    }
  });
}

const reserva = document.getElementById("modalReserva");

window.abrirModalReserva = function () {
  if (reserva) {
    console.log("Abrindo modalReserva...");
    reserva.style.display = "flex"; // Exibe o modal
  } else {
    console.error("Modal reserva não encontrado!");
  }
};

const openModalReserva = document.getElementById("openModalReserva");

if (openModalReserva) {
  openModalReserva.addEventListener("click", () => {
    console.log("Botão openModalReserva clicado");
    abrirModalReserva();
  });
}
