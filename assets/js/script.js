// js/main.js

// Importa as funções de inicialização de cada módulo
import { initNewsletter } from "../../assets/js/modules/newsletter.js";
import { initHeaderScroll } from "../../assets/js/modules/header-scroll.js";
import { initAccommodationFilter } from "../../assets/js/modules/accommodation-filter.js";
import { initRoomModal } from "../../assets/js/modules/room-modal.js";

// Espera o DOM carregar completamente para executar os scripts
document.addEventListener("DOMContentLoaded", function () {
  // Função para mostrar erro visual e mensagem
  function mostrarErro(input, errorSpan, mensagem) {
    input.classList.add("is-invalid");
    errorSpan.textContent = mensagem;
    errorSpan.style.display = "block";
  }
  function limparErro(input, errorSpan) {
    input.classList.remove("is-invalid");
    errorSpan.textContent = "";
    errorSpan.style.display = "none";
  }
  // Máscara CPF
  function mascaraCPF(cpf) {
    cpf = cpf.replace(/\D/g, "");
    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    return cpf;
  }
  const cpfInput = document.querySelector('[name="cpf"]');
  if (cpfInput) {
    cpfInput.addEventListener("input", function () {
      this.value = mascaraCPF(this.value);
    });
  }

  // Máscara Telefone
  function mascaraTelefone(tel) {
    tel = tel.replace(/\D/g, "");
    tel = tel.replace(/^(\d{2})(\d)/g, "($1) $2");
    tel = tel.replace(/(\d{5})(\d{1,4})$/, "$1-$2");
    return tel;
  }
  const telInput = document.querySelector('[name="telefone"]');
  if (telInput) {
    telInput.addEventListener("input", function () {
      this.value = mascaraTelefone(this.value);
    });
  }

  // Validação de e-mail
  function validarEmail(email) {
    return /^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email);
  }

  // Validação de CPF
  function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, "");
    if (cpf.length !== 11 || /^([0-9])\1+$/.test(cpf)) return false;
    let soma = 0,
      resto;
    for (let i = 1; i <= 9; i++)
      soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.substring(9, 10))) return false;
    soma = 0;
    for (let i = 1; i <= 10; i++)
      soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.substring(10, 11))) return false;
    return true;
  }

  // Validação de telefone simples (mínimo 10 dígitos)
  function validarTelefone(tel) {
    tel = tel.replace(/\D/g, "");
    return tel.length >= 10 && tel.length <= 11;
  }
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
document.addEventListener("DOMContentLoaded", function () {
  const selectRoom = document.getElementById("room_type");
  const options = selectRoom ? Array.from(selectRoom.options) : [];
  const validOptions = options.filter((opt) => !opt.disabled && opt.value);
  validOptions.forEach((option) => {});
  const modalReserva = document.getElementById("modalReserva");
  const formReservaPrincipal = document.getElementById("formReserva");
  const formModal = document.getElementById("formModalInputs");
  const fecharModalBtn = document.getElementById("fecharModalReserva");

  function coletarDadosPrincipais() {
    const check_in_el = document.getElementById("check_in");
    const check_out_el = document.getElementById("check_out");
    const quarto_id_select_el = document.getElementById("room_type");
    const guests_el = document.getElementById("guests");
    const children_el = document.getElementById("children");

    return {
      check_in: check_in_el ? check_in_el.value : null,
      check_out: check_out_el ? check_out_el.value : null,
      quarto_id: quarto_id_select_el ? quarto_id_select_el.value : null,
      quarto_select_el: quarto_id_select_el,
      guests: guests_el ? guests_el.value : null,
      children: children_el ? children_el.value : null,
    };
  }

  function validarDadosPrincipais(dados) {
    const hoje = new Date();
    hoje.setHours(0, 0, 0, 0);
    const checkIn = dados.check_in ? new Date(dados.check_in) : null;
    const checkOut = dados.check_out ? new Date(dados.check_out) : null;
    if (!checkIn || !checkOut || dados.quarto_select_el.selectedIndex === 0) {
      alert(
        "Por favor, preencha as datas de Check-in/Check-out e selecione um Quarto."
      );
      return false;
    }
    if (checkIn < hoje) {
      alert("A data de Check-in não pode ser anterior ao dia atual.");
      return false;
    }
    if (checkOut < hoje) {
      alert("A data de Check-out não pode ser anterior ao dia atual.");
      return false;
    }
    if (checkIn >= checkOut) {
      alert("A data de Check-out deve ser posterior à data de Check-in.");
      return false;
    }
    return true;
  }

  window.abrirModalReserva = function () {
    const dados = coletarDadosPrincipais();
    if (!validarDadosPrincipais(dados)) {
      return;
    }
    modalReserva.style.display = "flex";
  };

  if (fecharModalBtn) {
    fecharModalBtn.onclick = function () {
      modalReserva.style.display = "none";
    };
  }

  if (formModal) {
    formModal.onsubmit = async function (e) {
      e.preventDefault();
      console.log("Submit do modal disparado!");

      const dadosPrincipais = coletarDadosPrincipais();
      if (!validarDadosPrincipais(dadosPrincipais)) {
        return;
      }

      const nome_cliente = this.querySelector('[name="nome_cliente"]');
      const emailInput = this.querySelector('[name="email"]');
      const cpfInput = this.querySelector('[name="cpf"]');
      const telefoneInput = this.querySelector('[name="telefone"]');
      const email = emailInput.value;
      const cpf = cpfInput.value;
      const telefone = telefoneInput.value;

      const errorEmail = document.getElementById("error-email");
      const errorCpf = document.getElementById("error-cpf");
      const errorTelefone = document.getElementById("error-telefone");

      let erro = false;
      // Limpa erros anteriores
      limparErro(emailInput, errorEmail);
      limparErro(cpfInput, errorCpf);
      limparErro(telefoneInput, errorTelefone);

      if (!nome_cliente.value || !email || !cpf || !telefone) {
        if (!email) mostrarErro(emailInput, errorEmail, "Preencha o e-mail.");
        if (!cpf) mostrarErro(cpfInput, errorCpf, "Preencha o CPF.");
        if (!telefone)
          mostrarErro(telefoneInput, errorTelefone, "Preencha o telefone.");
        erro = true;
      }
      if (email && !validarEmail(email)) {
        mostrarErro(emailInput, errorEmail, "E-mail inválido.");
        erro = true;
      }
      if (cpf && !validarCPF(cpf)) {
        mostrarErro(cpfInput, errorCpf, "CPF inválido.");
        erro = true;
      }
      if (telefone && !validarTelefone(telefone)) {
        mostrarErro(
          telefoneInput,
          errorTelefone,
          "Telefone inválido. Informe DDD e número."
        );
        erro = true;
      }
      if (erro) return;

      const dadosReserva = {
        ...dadosPrincipais,
        quarto_id: dadosPrincipais.quarto_id,
        nome_cliente,
        email,
        cpf,
        telefone,
        data_checkin: dadosPrincipais.check_in,
        data_checkout: dadosPrincipais.check_out,
        status: "pendente",
        guests: dadosPrincipais.guests || 1,
        children: dadosPrincipais.children || 0,
      };

      const urlController = "controllers/reserva-controller.php";

      try {
        const response = await fetch(urlController, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(dadosReserva),
        });

        if (!response.ok) {
          const resError = await response
            .json()
            .catch(() => ({ msg: `HTTP Status ${response.status}` }));
          throw new Error(
            resError.msg || `Erro na comunicação (Status ${response.status})`
          );
        }

        const res = await response.json();
        // TODO reset não está funcionando corrigir posteriormente
        if (res.status === "ok") {
          alert("Reserva realizada com sucesso!");
          setTimeout(() => {
            window.location.reload();
          }, 100);
        } else {
          alert(
            "Erro ao realizar reserva: " + (res.msg || "Detalhe desconhecido.")
          );
        }
      } catch (err) {
        alert("Erro na reserva: " + err.message);
      }
    };
  }
});
