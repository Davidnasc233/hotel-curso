const form = document.getElementById("formEmail");
const emailInput = document.getElementById("newEmail");
const errorMessage = document.getElementById("erro");
const modalNewsletter = document.getElementById("meuModalSucesso");
const btnCloseNewsletter = document.getElementById("closeSucesso");
const btnOkNewsletter = document.getElementById("ok-btn-sucesso");

function openModalSucess() {
  if (modalNewsletter) {
    modalNewsletter.style.display = "flex";
  }
}

function closeModalSucess() {
  if (modalNewsletter) {
    modalNewsletter.style.display = "none";
  }
}

export function initNewsletter() {
  if (!form || !emailInput || !errorMessage || !modalNewsletter) {
    console.warn("Elementos do formulário de newsletter não encontrados.");
    return;
  }

  form.addEventListener("submit", function (event) {
    event.preventDefault();
    const email = emailInput.value.trim();
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!regex.test(email)) {
      errorMessage.textContent = "Por favor, insira um email válido.";
      errorMessage.style.color = "red";
    } else {
      errorMessage.textContent = "";
      openModalSucess();
      emailInput.value = "";
    }
  });

  if (btnCloseNewsletter) {
    btnCloseNewsletter.onclick = closeModalSucess
;
  }
  if (btnOkNewsletter) {
    btnOkNewsletter.onclick = closeModalSucess
;
  }
  window.addEventListener("click", (event) => {
    if (event.target === modalNewsletter) {
      closeModalSucess
    ();
    }
  });
}