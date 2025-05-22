document.addEventListener("DOMContentLoaded", function () {
  // Buka modal tambah kegiatan
  const addButton = document.querySelector(".btn-add");
  if (addButton) {
    addButton.addEventListener("click", function (e) {
      e.preventDefault();
      document.getElementById("addModal").style.display = "flex";
    });
  }

  // Tutup modal
  window.closeAddModal = function () {
    document.getElementById("addModal").style.display = "none";
  };

  // Validasi form
  const addForm = document.getElementById("addForm");
  if (addForm) {
    addForm.addEventListener("submit", function (e) {
      const title = document.getElementById("title");
      const description = document.getElementById("description");
      const titleError = document.getElementById("titleError");
      const descriptionError = document.getElementById("descriptionError");

      let isValid = true;

      // Reset error
      titleError.textContent = "";
      descriptionError.textContent = "";

      if (title.value.trim().length < 3) {
        titleError.textContent = "Title harus minimal 3 karakter.";
        isValid = false;
      }

      if (description.value.trim().length < 15) {
        descriptionError.textContent = "Description harus minimal 15 karakter.";
        isValid = false;
      }

      if (!isValid) {
        e.preventDefault();
      }
    });
  }
});
