export function mostrarErro(input, errorSpan, mensagem) {
  input.classList.add("is-invalid");
  errorSpan.textContent = mensagem;
  errorSpan.style.display = "block";
}
export function limparErro(input, errorSpan) {
  input.classList.remove("is-invalid");
  errorSpan.textContent = "";
  errorSpan.style.display = "none";
}

// Validação de e-mail
export function validarEmail(email) {
  return /^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email);
}

// Validação de CPF
export function validarCPF(cpf) {
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
export function validarTelefone(tel) {
  tel = tel.replace(/\D/g, "");
  return tel.length >= 10 && tel.length <= 11;
}
