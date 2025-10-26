// js/modules/reservation-form.js

import {
    mostrarErro,
    limparErro,
    validarEmail,
    validarCPF,
    validarTelefone,
} from "../utils/form-validation.js"; 

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
        alert("Por favor, preencha as datas de Check-in/Check-out e selecione um Quarto.");
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

function setupModalOpen() {
    const modalReserva = document.getElementById("modalReserva");
    const fecharModalBtn = document.getElementById("fecharModalReserva");

    window.abrirModalReserva = function () {
        const dados = coletarDadosPrincipais();
        if (!validarDadosPrincipais(dados)) {
            return;
        }
        if (modalReserva) {
            modalReserva.style.display = "flex";
        }
    };

    if (fecharModalBtn && modalReserva) {
        fecharModalBtn.onclick = function () {
            modalReserva.style.display = "none";
        };
    }
}

async function handleModalSubmit(e) {
    e.preventDefault();
    const formModal = e.currentTarget;

    const dadosPrincipais = coletarDadosPrincipais();
    if (!validarDadosPrincipais(dadosPrincipais)) {
        return;
    }

    const nome_cliente = formModal.querySelector('[name="nome_cliente"]');
    const emailInput = formModal.querySelector('[name="email"]');
    const cpfInput = formModal.querySelector('[name="cpf"]');
    const telefoneInput = formModal.querySelector('[name="telefone"]');
    const email = emailInput.value;
    const cpf = cpfInput.value;
    const telefone = telefoneInput.value;

    const errorEmail = document.getElementById("error-email");
    const errorCpf = document.getElementById("error-cpf");
    const errorTelefone = document.getElementById("error-telefone");

    let erro = false;
    limparErro(emailInput, errorEmail);
    limparErro(cpfInput, errorCpf);
    limparErro(telefoneInput, errorTelefone);

    if (!nome_cliente.value || !email || !cpf || !telefone) {
        if (!email) mostrarErro(emailInput, errorEmail, "Preencha o e-mail.");
        if (!cpf) mostrarErro(cpfInput, errorCpf, "Preencha o CPF.");
        if (!telefone) mostrarErro(telefoneInput, errorTelefone, "Preencha o telefone.");
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
        mostrarErro(telefoneInput, errorTelefone, "Telefone inválido. Informe DDD e número.");
        erro = true;
    }
    if (erro) return;

    const dadosReserva = {
        ...dadosPrincipais,
        quarto_id: dadosPrincipais.quarto_id,
        nome_cliente: nome_cliente.value,
        email: emailInput.value,
        cpf: cpfInput.value.replace(/[^\d]/g, ''),
        telefone: telefoneInput.value.replace(/[^\d]/g, ''),
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
            const resError = await response.json().catch(() => ({ msg: `HTTP Status ${response.status}` }));
            throw new Error(resError.msg || `Erro na comunicação (Status ${response.status})`);
        }

        const res = await response.json();
        if (res.status === "ok") {
            alert("Reserva realizada com sucesso!");
            setTimeout(() => { window.location.reload(); }, 100);
        } else {
            alert("Erro ao realizar reserva: " + (res.msg || "Detalhe desconhecido."));
        }
    } catch (err) {
        alert("Erro na reserva: " + err.message);
    }
}

export function initReservationForm() {
    setupModalOpen();

    const formModal = document.getElementById("formModalInputs");
    if (formModal) {
        formModal.addEventListener("submit", handleModalSubmit);
    }

    const checkInInput = document.getElementById("check_in");
    const checkOutInput = document.getElementById("check_out");

    if (checkInInput) {
        checkInInput.addEventListener("change", () => {
            console.log("Data de entrada selecionada:", checkInInput.value);
        });
    }

    if (checkOutInput) {
        checkOutInput.addEventListener("change", () => {
            console.log("Data de saída selecionada:", checkOutInput.value);
        });
    }
    const cancelarBtn = document.getElementById("cancelarModalReserva");
    const modalReserva = document.getElementById("modalReserva");
    if (cancelarBtn && modalReserva) {
        cancelarBtn.addEventListener("click", () => {
            modalReserva.style.display = "none";
        });
    }
}