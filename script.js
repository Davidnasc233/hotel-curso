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
    errorMessage.textContent = ""; // Clear the error message
    abrirModal();
  }
  emailInput.value = "";
  
});

function abrirModal() {
  modal.style.display = "flex";

  btnFechar.onclick = () => {
    modal.style.display = "none";
  };

  btnOk.onclick = () => {
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

  // Adiciona um 'ouvinte' de clique para cada link de filtro
  filterLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault(); // Previne a navegação da página

      // Remove a classe 'active' de todos os links
      filterLinks.forEach((l) => l.classList.remove("active"));
      // Adiciona a classe 'active' ao link clicado
      this.classList.add("active");

      const filterValue = this.getAttribute("data-filter");

      // Itera sobre todos os itens de quarto
      filterableItems.forEach((item) => {
        // Esconde todos os itens por padrão
        item.style.display = "none";

        // Se o valor do filtro for 'todos' OU se o item tiver a classe correspondente, mostre-o.
        // A função `classList.contains()` verifica se a classe existe.
        if (filterValue === "todos" || item.classList.contains(filterValue)) {
          item.style.display = "block"; // Ou 'flex', 'grid', dependendo do seu layout original
        }
      });
    });
  });

  // Simula um clique no link "TODOS" ao carregar a página
  // para garantir que todos os itens sejam exibidos inicialmente.
  const todosLink = document.querySelector(
    '.acomodacoes a[data-filter="todos"]'
  );
  if (todosLink) {
    todosLink.click();
  }
});
