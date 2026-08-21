/* ==========================================================
   Law Office CMS
   Common Admin JavaScript
========================================================== */

document.addEventListener("DOMContentLoaded", function () {

  console.log("Law Office CMS Loaded");

  /* ==========================================
     Auto Close Success Alert
  ========================================== */

  const alerts = document.querySelectorAll(".alert");

  alerts.forEach(function (alert) {

    setTimeout(function () {

      if (alert.classList.contains("show")) {

        const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
        bsAlert.close();

      }

    }, 4000);

  });


  /* ==========================================
     Confirm Delete
  ========================================== */

  document.querySelectorAll(".delete-btn").forEach(function (button) {

    button.addEventListener("click", function (e) {

      if (!confirm("Are you sure you want to delete this record?")) {

        e.preventDefault();

      }

    });

  });


  /* ==========================================
     Live Search
  ========================================== */

  const searchInput = document.getElementById("searchInput");

  if (searchInput) {

    searchInput.addEventListener("keyup", function () {

      const value = this.value.toLowerCase();

      document.querySelectorAll("tbody tr").forEach(function (row) {

        row.style.display = row.innerText.toLowerCase().includes(value)
          ? ""
          : "none";

      });

    });

  }


  /* ==========================================
     Image Preview
  ========================================== */

  const imageInput = document.getElementById("image");

  if (imageInput) {

    imageInput.addEventListener("change", function () {

      const file = this.files[0];

      if (!file) return;

      const reader = new FileReader();

      reader.onload = function (e) {

        const preview = document.getElementById("preview");

        if (preview) {

          preview.src = e.target.result;
          preview.style.display = "block";

        }

      };

      reader.readAsDataURL(file);

    });

  }


  /* ==========================================
     Auto Focus First Input
  ========================================== */

  const firstInput = document.querySelector("input, textarea, select");

  if (firstInput) {

    firstInput.focus();

  }


  /* ==========================================
     Number Validation
  ========================================== */

  document.querySelectorAll("input[type='number']").forEach(function (input) {

    input.addEventListener("input", function () {

      if (this.value < 0) {

        this.value = 0;

      }

    });

  });

});