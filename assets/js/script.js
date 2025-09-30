document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM fully loaded and parsed");

  // Header
  const header = document.querySelector("header");
  const form = document.getElementById("formEmail");
  const emailInput = document.getElementById("newEmail");
  const errorMessage = document.getElementById("erro");

  const modalNewsletter = document.getElementById("meuModalSucesso");
  const btnFecharNewsletter = document.getElementById("closeSucesso");
  const btnOkNewsletter = document.getElementById("ok-btn-sucesso");

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const email = emailInput.value.trim();
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regex.test(email)) {
      errorMessage.textContent = "Por favor, insira um email válido.";
      errorMessage.style.color = "red";
      return;
    } else {
      abrirModal();
    }
    emailInput.value = "";
  });

  function abrirModal() {
    modalNewsletter.style.display = "flex";

    btnFechar.onclick = () => {
      btnFecharNewsletter.style.display = "none";
    };

    btnOk.onclick = (event) => {
      event.preventDefault();
      btnOkNewsletter.style.display = "none";
    };

    window.onclick = (event) => {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    };
  }

  // Inputs de datas
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

  // Scroll header
  document.addEventListener("scroll", () => {
    if (header) {
      if (window.scrollY > 0) header.classList.add("header-bg");
      else header.classList.remove("header-bg");
    }
  });

  // Filtro de acomodações
  const filterLinks = document.querySelectorAll(".acomodacoes a");
  const filterableItems = document.querySelectorAll(".filterable-item");

  filterLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      filterLinks.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");
      const filterValue = this.getAttribute("data-filter");
      filterableItems.forEach((item) => {
        item.style.display =
          filterValue === "todos" || item.classList.contains(filterValue)
            ? "block"
            : "none";
      });
    });
  });

  const todosLink = document.querySelector(
    '.acomodacoes a[data-filter="todos"]'
  );
  if (todosLink) todosLink.click();

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
  const closeModalRoom = document.getElementById("closeModalRoom");
  const btnCloseModal = modalRoom.querySelector(".btn-close-modal");

  // Função para abrir o modal e preencher o conteúdo
  function abrirModal(quartoId) {
    const quarto = quartos[quartoId];
    if (quarto) {
      document.getElementById("modalTitle").textContent = quarto.title;
      document.getElementById("modalDescription").textContent =
        quarto.description;
      document.getElementById(
        "modalPrice"
      ).innerHTML = `Preço: <strong>${quarto.price}</strong>`;
      modalRoom.classList.add("show");
    }
  }

  // Função para fechar o modal
  function fecharModal() {
    modalRoom.classList.remove("show");
  }

  // Eventos para fechar o modal
  if (closeModalRoom) {
    closeModalRoom.addEventListener("click", fecharModal);
  }

  if (btnCloseModal) {
    btnCloseModal.addEventListener("click", fecharModal);
  }

  window.addEventListener("click", (event) => {
    if (event.target === modalRoom) {
      fecharModal();
    }
  });

  // Adicionar eventos aos botões "SAIBA MAIS"
  document.querySelectorAll(".quarto-card button").forEach((button, index) => {
    const quartoIds = ["solteiro01", "casal01", "casalSuite"];
    button.addEventListener("click", () => abrirModal(quartoIds[index]));
  });
});
