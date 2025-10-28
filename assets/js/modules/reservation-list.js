document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".btn-edit").forEach(function (btn) {
    btn.addEventListener("click", function () {
      document.getElementById("modalWidth").style.display = "flex";
      document.getElementById("edit-id").value = this.dataset.id;
      document.getElementById("edit-nome").value = this.dataset.nome;
      document.getElementById("edit-email").value = this.dataset.email;
      document.getElementById("edit-telefone").value = this.dataset.telefone;
      document.getElementById("edit-checkin").value = this.dataset.checkin
        ? this.dataset.checkin.substring(0, 10)
        : "";
      document.getElementById("edit-checkout").value = this.dataset.checkout
        ? this.dataset.checkout.substring(0, 10)
        : "";
      if (this.dataset.quarto) {
        document.getElementById("edit-quarto").value = this.dataset.quarto;
      }
    });
  });

  let formToDelete = null;
  document.querySelectorAll(".btn-excluir-reserva").forEach(function (btn) {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      formToDelete = btn.closest("form");
      document.getElementById("deleteModalBody").innerHTML =
        "Tem certeza que deseja excluir esta reserva?";
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

  const successEditModalEl = document.getElementById("successEditModal");
  const successModal = successEditModalEl
    ? new bootstrap.Modal(successEditModalEl, {
        backdrop: "static",
        keyboard: false,
      })
    : null;
  const editForm = document.getElementById("editForm");

  if (editForm) {
    editForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const id = editForm["id"].value;
      const nome = editForm["nome"].value;
      const email = editForm["email"].value;
      const telefone = editForm["telefone"].value;
      const checkin = editForm["checkin"].value;
      const checkout = editForm["checkout"].value;
      const quartoId = editForm["quarto"].value;
      const quartoText =
        editForm["quarto"].options[editForm["quarto"].selectedIndex].text;

      const row = Array.from(document.querySelectorAll("tr.grid-row")).find(
        (tr) => tr.querySelector("td")?.textContent == id
      );
      if (row) {
        const tds = row.querySelectorAll("td");
        tds[2].textContent = nome;
        tds[3].textContent = email;
        tds[4].textContent = telefone;
        tds[6].textContent = checkin
          ? new Date(checkin).toLocaleDateString("pt-BR")
          : "";
        tds[7].textContent = checkout
          ? new Date(checkout).toLocaleDateString("pt-BR")
          : "";
        tds[1].textContent = quartoText;

        const btnEdit = row.querySelector(".btn-edit");
        if (btnEdit) {
          Object.assign(btnEdit.dataset, {
            nome,
            email,
            telefone,
            checkin,
            checkout,
            quarto: quartoId,
          });
        }
      }

      document.getElementById("modalWidth").style.display = "none";

      setTimeout(() => {
        if (successModal) {
          successModal.show();
          setTimeout(() => successModal.hide(), 1800);
        }
      }, 300);
    });
  }
});
