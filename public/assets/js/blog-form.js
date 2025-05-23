document.addEventListener("DOMContentLoaded", function () {
  // Buka modal tambah blog
  const addButton = document.querySelector(".btn-add");
  if (addButton) {
    addButton.addEventListener("click", function (e) {
      e.preventDefault();
      document.getElementById("addModal").style.display = "flex";
    });
  }

  // Event listener untuk tombol edit
  // Modal Edit Blog
  const editButtons = document.querySelectorAll(".btn-edit");

  editButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const id = this.getAttribute("data-id");
      const title = this.getAttribute("data-title");
      const description = this.getAttribute("data-description");
      const date = this.getAttribute("data-date");
      const image = this.getAttribute("data-image");

      document.getElementById("update-id").value = id;
      document.getElementById("update-title").value = title;
      document.getElementById("update-description").value = description;
      document.getElementById("update-date").value = date;

      const imagePreview = document.getElementById("update-image-preview");
      if (image) {
        imagePreview.src = `/uploads/${image}`;
        imagePreview.style.display = "block";
      } else {
        imagePreview.style.display = "none";
      }

      document.getElementById("updateModal").style.display = "flex";
    });
  });

  // Tutup modal tambah
  window.closeAddModal = function () {
    document.getElementById("addModal").style.display = "none";
  };

  // Tutup modal update
  window.closeUpdateModal = function () {
    document.getElementById("updateModal").style.display = "none";
  };

  // Validasi form tambah
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

  // ========== SCRIPT MODAL UPDATE ==========
  // Buka modal update
  window.openUpdateModal = function (blog) {
    const modal = document.getElementById("updateModal");
    modal.style.display = "flex";

    // Set value ke form
    document.getElementById("updateForm").action = "/dashboard/updateBlog";
    document.getElementById("updateForm").reset();

    document.getElementById("update-id").value = blog.id;
    document.getElementById("update-title").value = blog.title;
    document.getElementById("update-description").value = blog.description;
    document.getElementById("update-date").value = blog.date;

    // Tampilkan preview image
    const imagePreview = document.getElementById("update-image-preview");
    if (blog.image) {
      imagePreview.src = `/uploads/${blog.image}`;
      imagePreview.style.display = "block";
    } else {
      imagePreview.src = "";
      imagePreview.style.display = "none";
    }

    // Reset error
    document.getElementById("update_titleError").textContent = "";
    document.getElementById("update_descriptionError").textContent = "";
  };

  // Validasi form update
  const updateForm = document.getElementById("updateForm");
  if (updateForm) {
    updateForm.addEventListener("submit", function (e) {
      const title = document.getElementById("update_title");
      const description = document.getElementById("update_description");
      const titleError = document.getElementById("update_titleError");
      const descriptionError = document.getElementById(
        "update_descriptionError"
      );

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
