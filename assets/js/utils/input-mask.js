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

export function initInputMasks() {
    const cpfInput = document.querySelector('[name="cpf"]');
    if (cpfInput) {
        cpfInput.addEventListener("input", function () {
            this.value = mascaraCPF(this.value);
        });
    }

    const telInput = document.querySelector('[name="telefone"]');
    if (telInput) {
        telInput.addEventListener("input", function () {
            this.value = mascaraTelefone(this.value);
        });
    }
}