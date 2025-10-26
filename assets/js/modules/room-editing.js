function setupEditModal() {
    const editForm = document.getElementById("editForm");
    const modal = document.getElementById("modalWidth");

    document.querySelectorAll(".btn-editar").forEach(function (btn) {
        btn.addEventListener("click", function () {
            document.getElementById("edit-id").value = this.dataset.id;
            document.getElementById("edit-numero").value = this.dataset.numero;
            document.getElementById("edit-tipo").value = this.dataset.tipo;
            document.getElementById("edit-preco").value = this.dataset.preco;
            document.getElementById("edit-ativo").value = this.dataset.ativo;
            if (modal) modal.style.display = "flex";
        });
    });

    if (editForm) {
        const cancelButton = editForm.querySelector('button[type="button"]');
        if (cancelButton && modal) {
            cancelButton.onclick = function () {
                modal.style.display = "none";
            };
        }

        editForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(editForm);
            formData.append("action", "edit");

            fetch("../../controllers/room-controller.php", {
                method: "POST",
                body: formData,
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.status === "ok") {
                        alert("Quarto atualizado com sucesso!");
                        window.location.reload();
                    } else {
                        alert("Erro ao atualizar quarto: " + (data.msg || ""));
                    }
                })
                .catch(() => alert("Erro na comunicação com o servidor."));
        });
    }
}

export function initRoomEditing() {
    setupEditModal();
}