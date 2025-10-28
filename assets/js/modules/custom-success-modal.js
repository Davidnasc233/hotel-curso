window.showCustomSuccess = function (message, onOk, timeoutMs = 2000) {
  const modal = document.getElementById("customSuccessModal");
  const msg = document.getElementById("customSuccessMessage");
  const btnOk = document.getElementById("customSuccessOk");
  const btnClose = document.getElementById("closeCustomSuccess");
  const modalReserva = document.getElementById("modalReserva");
  if (modalReserva && modalReserva.style.display !== "none") {
    modalReserva.style.display = "none";
  }
  msg.textContent = message || "Reserva realizada com sucesso!";
  modal.style.display = "flex";
  let closed = false;
  let timer = setTimeout(() => {
    if (!closed) closeModal();
  }, timeoutMs);

  function closeModal() {
    modal.style.display = "none";
    closed = true;
    clearTimeout(timer);
    btnOk.removeEventListener("click", okHandler);
    btnClose.removeEventListener("click", okHandler);
    modal.onclick = null;
    if (typeof onOk === "function") onOk();
  }
  function okHandler() {
    closeModal();
  }
  btnOk.addEventListener("click", okHandler);
  btnClose.addEventListener("click", okHandler);
  modal.onclick = function (e) {
    if (e.target === modal) okHandler();
  };
};
