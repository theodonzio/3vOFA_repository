<?php
  include '../tools/head.php';
  include '../tools/header_estudiante.php';
?>

<link rel="stylesheet" href="../css/style.css">

<div class="en-construccion">
  <i class="bi bi-cone-striped display-1 text-warning mb-3"></i>
  <h2 class="fw-bold">En construcción</h2>
  <p>Esta sección del estudiante aún se encuentra en desarrollo.</p>
</div>

<a href="#top" id="scrollTopBtn" class="btn btn-secondary shadow-lg position-fixed bottom-0 end-0 m-4" 
   style="z-index:999; font-size:28px; opacity:0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s;">
  <i class="bi bi-caret-up-fill"></i>
</a>

<script>
  const btn = document.getElementById('scrollTopBtn');

  window.addEventListener('scroll', () => {
    if (window.scrollY > 500) { // aparece después de 500px de scroll
      btn.style.opacity = '1';
      btn.style.transform = 'translateY(0)';
    } else {
      btn.style.opacity = '0';
      btn.style.transform = 'translateY(20px)';
    }
  });
</script>



<?php
  include '../tools/footer.php';
?>

<script src="../../js/traductor.js"></script>