// assets/js/modules/create-reservation-form.js

import { initInputMasks } from "../utils/input-mask.js";
import {
  mostrarErro,
  limparErro,
  validarCPF,
  validarTelefone,
} from "../utils/form-validation.js";

document.addEventListener("DOMContentLoaded", function () {
  // Inicializa máscaras
  initInputMasks();

  const form = document.querySelector(
    "form[action='../../controllers/reserva-controller.php']"
  );
  if (!form) return;

  const cpfInput = form.querySelector('[name="cpf"]');
  const telInput = form.querySelector('[name="telefone"]');
  const emailInput = form.querySelector('[name="email"]');
  const errorCpf = document.getElementById("error-cpf");
  const errorTel = document.getElementById("error-telefone");
  const errorEmail = document.getElementById("error-email");

  form.addEventListener("submit", function (e) {
    let valid = true;
    // Validação CPF
    if (cpfInput && !validarCPF(cpfInput.value)) {
      mostrarErro(cpfInput, errorCpf, "CPF inválido");
      valid = false;
    } else if (cpfInput) {
      limparErro(cpfInput, errorCpf);
    }
    // Validação Telefone
    if (telInput && !validarTelefone(telInput.value)) {
      mostrarErro(telInput, errorTel, "Telefone inválido");
      valid = false;
    } else if (telInput) {
      limparErro(telInput, errorTel);
    }
    // Validação Email
    if (emailInput && !/.+@.+\..+/.test(emailInput.value)) {
      mostrarErro(emailInput, errorEmail, "E-mail inválido");
      valid = false;
    } else if (emailInput) {
      limparErro(emailInput, errorEmail);
    }
    if (!valid) {
      e.preventDefault();
    }
  });
});
