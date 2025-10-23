document.addEventListener("DOMContentLoaded", () => {
  const idiomaGuardado = localStorage.getItem("idioma") || "es";

  const esItem = document.getElementById("lenguaje-es");
  const enItem = document.getElementById("lenguaje-en");

  if (idiomaGuardado === "es") {
    esItem.classList.add("active");
    enItem.classList.remove("active");
  } else {
    enItem.classList.add("active");
    esItem.classList.remove("active");
  }

  esItem.addEventListener("click", () => {
    esItem.classList.add("active");
    enItem.classList.remove("active");
  });
  enItem.addEventListener("click", () => {
    enItem.classList.add("active");
    esItem.classList.remove("active");
  });
});