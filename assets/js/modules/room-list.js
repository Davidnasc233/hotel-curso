document.addEventListener("DOMContentLoaded", function () {
  let formToDelete = null;
  document.querySelectorAll(".btn-excluir").forEach(function (btn) {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      formToDelete = btn.closest("form");
      document.getElementById("deleteModalBody").innerHTML =
        "Tem certeza que deseja excluir este quarto?";
      document.getElementById("confirmDeleteBtn").disabled = false;
      const modal = new bootstrap.Modal(
        document.getElementById("confirmDeleteModal")
      );
      modal.show();
    });
  });
  document
    .getElementById("confirmDeleteBtn")
    .addEventListener("click", function () {
      const btn = this;
      btn.disabled = true;
      const body = document.getElementById("deleteModalBody");
      body.innerHTML =
        '<div style="display:flex;flex-direction:column;align-items:center;gap:10px;">' +
        '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#28a745" class="bi bi-check-circle-fill" viewBox="0 0 16 16">' +
        '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.439 6.03 7.97a.75.75 0 1 0-1.06 1.06l1.999 2z"/></svg>' +
        '<span style="color:#28a745;font-weight:bold;font-size:1.2em;">Excluído com sucesso!</span>' +
        "</div>";
      setTimeout(function () {
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("confirmDeleteModal")
        );
        modal.hide();
        if (formToDelete) {
          formToDelete.submit();
        }
      }, 900);
    });

  document.getElementById("editForm").addEventListener("submit", function (e) {
    e.preventDefault();
    document.getElementById("modalWidth").style.display = "none";
    const successModal = new bootstrap.Modal(
      document.getElementById("successEditModal")
    );
    successModal.show();
    setTimeout(function () {
      successModal.hide();
      window.location.reload();
    }, 1200);
  });
});
