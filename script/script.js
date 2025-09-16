document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM fully loaded and parsed");

  if (!form || !emailInput || !errorMessage || !modal || !btnFechar || !btnOk) {
    console.error("Elementos necessários não encontrados no DOM.");
    return;
  }
});

const header = document.querySelector("header");
const form = document.getElementById("formEmail");
const emailInput = document.getElementById("newEmail");
const errorMessage = document.getElementById("erro");

const modal = document.getElementById("meuModal");
const btnFechar = document.getElementById("close");
const btnOk = document.getElementById("ok-btn");

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
  modal.style.display = "flex";

  btnFechar.onclick = () => {
    modal.style.display = "none";
  };

  btnOk.onclick = (event) => {
    event.preventDefault();
    modal.style.display = "none";
  };

  window.onclick = (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  };
}

document.addEventListener("scroll", function () {
  if (window.scrollY > 0) {
    header.classList.add("header-bg");
  } else {
    header.classList.remove("header-bg");
  }

  const input = document.getElementById("input-room");
  const optionsList = document.getElementById("options-list");

  // abre/fecha lista ao clicar no input
  input.addEventListener("click", () => {
    optionsList.style.display =
      optionsList.style.display === "block" ? "none" : "block";
  });

  // quando clica em uma opção
  optionsList.querySelectorAll("div").forEach((option) => {
    option.addEventListener("click", () => {
      input.value = option.textContent;
      optionsList.style.display = "none";
    });
  });

  // fecha se clicar fora
  document.addEventListener("click", (e) => {
    if (!e.target.closest(".custom-select")) {
      optionsList.style.display = "none";
    }
  });
});

const inputs = document.getElementsByClassName("input-date");

Array.from(inputs).forEach((input) => {
  input.addEventListener("input", (e) => {
    let valor = e.target.value.replace(/\D/g, "");
    if (valor.length > 8) valor = valor.slice(0, 8);

    if (valor.length > 4) {
      valor = valor.replace(/(\d{2})(\d{2})(\d{1,4})/, "$1/$2/$3");
    } else if (valor.length > 2) {
      valor = valor.replace(/(\d{2})(\d{1,2})/, "$1/$2");
    }

    e.target.value = valor;
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const filterLinks = document.querySelectorAll(".acomodacoes a");
  const filterableItems = document.querySelectorAll(".filterable-item");

  filterLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();

      filterLinks.forEach((l) => l.classList.remove("active"));

      this.classList.add("active");

      const filterValue = this.getAttribute("data-filter");

      filterableItems.forEach((item) => {
        item.style.display = "none";

        if (filterValue === "todos" || item.classList.contains(filterValue)) {
          item.style.display = "block";
        }
      });
    });
  });

  const todosLink = document.querySelector(
    '.acomodacoes a[data-filter="todos"]'
  );
  if (todosLink) {
    todosLink.click();
  }
});

//requisições com backend

const reserva = document.getElementById("formReserva");

reserva.addEventListener("submit", async (event) => {
  event.preventDefault();

  const checkIn = document.getElementById("check_in").value;
  const checkOut = document.getElementById("check_out").value;
  const roomType = document.getElementById("room_type").value;
  const guests = document.getElementById("guests").value;
  const children = document.getElementById("children").value;

  // Enviar dados para o backend
  const data = {
    check_in: checkIn,
    check_out: checkOut,
    room_type: parseInt(roomType, 10),
    guests: parseInt(guests, 10),
    children: parseInt(children, 10),
  };

  try {
    const response = await fetch('http://localhost:3000/reservations', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    });

    if (response.ok) {
      const result = await response.json();
      alert('Reserva criada com sucesso! ID da reserva: ' + result.id);
    } else {
      alert('Erro ao criar reserva.');
    }
  } catch (error) {
    console.error('Erro:', error);
    alert('Erro ao conectar com o servidor.');
  }
});

