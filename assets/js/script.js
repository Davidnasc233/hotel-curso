// js/main.js

// Importa as funções de inicialização de cada módulo
import { initNewsletter } from "../../assets/js/modules/newsletter.js";
import { initHeaderScroll } from "../../assets/js/modules/header-scroll.js";
import { initAccommodationFilter } from "../../assets/js/modules/accommodation-filter.js";
import { initRoomModal } from "../../assets/js/modules/room-modal.js";

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
document.addEventListener("DOMContentLoaded", function () {
  const modalReserva = document.getElementById("modalReserva");
  const formReservaPrincipal = document.getElementById("formReserva"); 
  const formModal = document.getElementById("formModalInputs"); 
  const fecharModalBtn = document.getElementById("fecharModalReserva");

  function coletarDadosPrincipais() {
    const check_in_el =
      document.getElementById("check_in");
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
    if (
      !dados.check_in ||
      !dados.check_out ||
      dados.quarto_select_el.selectedIndex === 0
    ) {
      alert(
        "Por favor, preencha as datas de Check-in/Check-out e selecione um Quarto."
      );
      return false;
    }
    if (new Date(dados.check_in) >= new Date(dados.check_out)) {
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

      const nome_cliente = this.querySelector('[name="nome_cliente"]').value;
      const email = this.querySelector('[name="email"]').value;
      const cpf = this.querySelector('[name="cpf"]').value;
      const telefone = this.querySelector('[name="telefone"]').value;

      if (!nome_cliente || !email || !cpf || !telefone) {
        alert("Por favor, preencha todos os seus dados pessoais no modal.");
        return;
      }

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
          modalReserva.style.display = "none";
          formModal.reset();
          if (
            formReservaPrincipal &&
            typeof formReservaPrincipal.reset === "function"
          ) {
            formReservaPrincipal.reset();
          }
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
