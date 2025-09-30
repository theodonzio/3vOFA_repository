document.addEventListener("DOMContentLoaded", () => {
  const modalLogin = document.getElementById("modalLogin");

  if (modalLogin) {
    modalLogin.addEventListener("show.bs.modal", function (event) {
      const button = event.relatedTarget;
      const rol = button.getAttribute("data-role");
      const inputRol = modalLogin.querySelector("#rol");
      const formLogin = document.getElementById("formLogin");

      if (rol === "adscripta") {
        inputRol.value = "adscripta";
        formLogin.action = "../php/usuarios/adscripta.php";
      } else if (rol === "docente") {
        inputRol.value = "docente";
        formLogin.action = "../php/usuarios/docente.php";
      }
    });
  }
});