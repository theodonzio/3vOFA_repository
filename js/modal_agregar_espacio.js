document.getElementById("formEspacio").addEventListener("submit", function(e) {
  const descripcion = document.getElementById("descripcion").value.trim();
  if (!/^\d+$/.test(descripcion)) {
    e.preventDefault();
    alert("Por favor, indica solo el número del espacio (sin letras ni símbolos).");
  }
});