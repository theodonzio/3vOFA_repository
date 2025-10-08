<?php
  include '../tools/head.php';
  include '../tools/header_adscripta.php';

if (isset($_GET['docente'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  <?php if ($_GET['docente'] === 'success'): ?>
    Swal.fire({
      icon: 'success',
      title: '¡Docente agregado correctamente!',
      text: 'El nuevo docente ha sido registrado en el sistema.',
      confirmButtonColor: '#198754',
      confirmButtonText: 'Aceptar'
    });
  <?php elseif ($_GET['docente'] === 'error'): ?>
    Swal.fire({
      icon: 'error',
      title: 'Error al registrar',
      text: 'No se pudo agregar el docente. Intenta nuevamente.',
      confirmButtonColor: '#dc3545',
      confirmButtonText: 'Aceptar'
    });
  <?php endif; ?>
});
</script>
<?php endif; ?>
<?php if (isset($_GET['espacio'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  <?php if ($_GET['espacio'] === 'success'): ?>
    Swal.fire({
      icon: 'success',
      title: '¡Espacio agregado correctamente!',
      text: 'El nuevo espacio ha sido registrado en el sistema.',
      confirmButtonColor: '#198754',
      confirmButtonText: 'Aceptar'
    });
  <?php elseif ($_GET['espacio'] === 'error'): ?>
    Swal.fire({
      icon: 'error',
      title: 'Error al registrar',
      text: 'No se pudo agregar el espacio. Intenta nuevamente.',
      confirmButtonColor: '#dc3545',
      confirmButtonText: 'Aceptar'
    });
  <?php endif; ?>
});
</script>
<?php endif; ?>
<body class="<?php echo isset($_SESSION['modoOscuro']) && $_SESSION['modoOscuro'] ? 'oscuro' : ''; ?>">

<div class="text-center titulo-adscripta">
  <img src="../../img/ofalogos/blue-logo.png" class="tinylogo"> 
  <img src="../../img/blueicons/adscriptablue.png" class="blue_icon"> 
  <h1 data-traducible="Sistema de Gestión OFA" class="display-4 fw-bold text-primary">Sistema de Gestión</h1>
  <p data-traducible="Panel exclusivo para Adscripta" class="lead text-muted">Panel exclusivo para Adscripta</p>
  <?php include '../tools/reloj.php'; ?>
</div>

<!-- Hero Docentes -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center" style="background-image: url('https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center; position: relative; min-height: 400px;">
  <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.4); border-radius: 20px"></div>
  <div class="container text-center" style="position: relative; z-index: 1;">
    <h2 data-traducible="Docentes del Sistema" class="display-6 fw-semibold">Docentes del Sistema</h2>
    <p data-traducible="Desde aquí puedes gestionar a los docentes registrados en el sistema" class="mb-4">Desde aquí puedes gestionar a los docentes registrados en el sistema</p>
    <div class="d-flex justify-content-center gap-3">
      <button class="btn btn-light btn-lg btn_wicon" data-bs-toggle="modal" data-bs-target="#registrarDocenteModal" data-traducible="Registrar Docente">
        <i class="bi bi-person-plus-fill"></i> Registrar Docente
      </button>
      <a href="../PaginasAdcriptas/docentes.php" class="btn btn-outline-light btn-lg" data-traducible="Ver Docentes">Ver Docentes</a>
    </div>
  </div>
</div>

<!-- Modal Registrar Docente -->
<div class="modal fade" id="registrarDocenteModal" tabindex="-1" aria-labelledby="registrarDocenteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/registrar_docente.php" method="POST">
        <div class="modal-header">
          <h5 data-traducible="Registrar Docente" class="modal-title" id="registrarDocenteLabel">Registrar Docente</h5>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" data-traducible="Nombre" required>
          </div>
          <div class="mb-3">
            <input type="text" name="apellido" class="form-control" placeholder="Apellido" data-traducible="Apellido" required>
          </div>
          <div class="mb-3">
            <input type="text" name="cedula" class="form-control" placeholder="Cédula" data-traducible="Cédula" required>
          </div>
          <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" data-traducible="Email" required>
          </div>
          <div class="mb-3">
            <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" data-traducible="Contraseña" required>
          </div>
          <input type="hidden" name="id_rol" value="2">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
          <button type="submit" class="btn btn-success" data-traducible="Guardar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Hero Asignaturas -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center" 
     style="background-image: url('https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=2070&auto=format&fit=crop'); 
            background-size: cover; background-position: center; position: relative; min-height: 400px;">
  <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.4); border-radius: 20px"></div>
  <div class="container text-center" style="position: relative; z-index: 1;">
    <h2 data-traducible="Asignaturas" class="display-6 fw-semibold">Asignaturas</h2>
    <p data-traducible="Desde aquí puedes gestionar las asignaturas registradas en el sistema" class="mb-4">
      Desde aquí puedes gestionar las asignaturas registradas en el sistema
    </p>
    <div class="d-flex justify-content-center gap-3">
      <button class="btn btn-light btn-lg btn_wicon" data-bs-toggle="modal" data-bs-target="#agregarAsignaturaModal" data-traducible="Agregar Asignatura">
        <i class="bi bi-journal-plus"></i> Agregar Asignatura
      </button>
    </div>
  </div>
</div>

<!-- Modal Agregar Asignatura -->
<div class="modal fade" id="agregarAsignaturaModal" tabindex="-1" aria-labelledby="agregarAsignaturaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="../funciones/agregar_asignatura.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarAsignaturaLabel" data-traducible="Agregar Asignatura">Agregar Asignatura</h5>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label" data-traducible="Nombre de la Asignatura">Nombre de la Asignatura</label>
            <input type="text" name="nombre_asignatura" class="form-control" placeholder="Ej: Matemática" required>
          </div>

          <div class="mb-3">
            <label class="form-label" data-traducible="Docente">Docente</label>
            <select name="id_docente" class="form-select" required>
              <option value="">Seleccionar docente...</option>
              <?php
              include '../login/conexion_bd.php';
              $docentes = $conn->query("SELECT id_usuario, nombre, apellido FROM usuario WHERE id_rol = 2");
              while ($d = $docentes->fetch_assoc()) {
                echo "<option value='{$d['id_usuario']}'>{$d['nombre']} {$d['apellido']}</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label" data-traducible="Grupo">Grupo</label>
            <select name="id_grupo" class="form-select" required>
              <option value="">Seleccionar grupo...</option>
              <?php
              $grupos = $conn->query("SELECT id_grupo, nombre_grupo FROM grupo");
              while ($g = $grupos->fetch_assoc()) {
                echo "<option value='{$g['id_grupo']}'>{$g['nombre_grupo']}</option>";
              }
              ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
          <button type="submit" class="btn btn-success" data-traducible="Guardar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>


 <!-- Sección Horarios -->
<?php
if (!isset($conn)) {
  include_once '../login/conexion_bd.php';
}

// Traemos todas las asignaturas
$asignaturas = [];
if (isset($conn)) {
  $resAsig = $conn->query("SELECT id_asignatura, nombre_asignatura FROM asignatura ORDER BY nombre_asignatura");
  if ($resAsig) {
    while ($a = $resAsig->fetch_assoc()) {
      $asignaturas[] = $a;
    }
  }
}
?>

<div class="container my-5">
  <h2 class="text-center mb-4">Gestión de Horarios por Grupo</h2>

  <div class="d-flex justify-content-end mb-3">
    <label for="grupoSelect" class="me-2 fw-bold">Seleccionar grupo:</label>
    <select id="grupoSelect" class="form-select w-auto">
      <option value="">-- Seleccionar grupo --</option>
      <?php
      if (isset($conn)) {
        $resGr = $conn->query("SELECT id_grupo, nombre_grupo FROM grupo ORDER BY nombre_grupo");
        while ($g = $resGr->fetch_assoc()) {
          echo "<option value='{$g['id_grupo']}'>{$g['nombre_grupo']}</option>";
        }
      }
      ?>
    </select>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle" id="tablaHorarios">
      <thead class="table-primary">
        <tr>
          <th>Hora</th>
          <th>Lunes</th>
          <th>Martes</th>
          <th>Miércoles</th>
          <th>Jueves</th>
          <th>Viernes</th>
        </tr>
      </thead>
      <tbody id="horarioBody">
        <?php
        // Traemos los horarios
        $horarios = [];
        if (isset($conn)) {
          $resHor = $conn->query("SELECT * FROM horario ORDER BY id_horario");
          if ($resHor) {
            while ($h = $resHor->fetch_assoc()) {
              $horarios[] = $h;
            }
          }
        }

        foreach ($horarios as $fila) {
          echo "<tr>";
          echo "<td><strong>{$fila['nombre_horario']}</strong><br>{$fila['hora_inicio']} - {$fila['hora_fin']}</td>";
          for ($i = 1; $i <= 5; $i++) {
            echo "<td>";
            echo "<select class='form-select selectHorario' data-dia='{$i}' data-hora='{$fila['id_horario']}'>";
            echo "<option value=''>-- Vacío --</option>";
            foreach ($asignaturas as $a) {
              echo "<option value='{$a['id_asignatura']}'>{$a['nombre_asignatura']}</option>";
            }
            echo "</select>";
            echo "</td>";
          }
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-end">
    <button id="guardarCambios" class="btn btn-success">Guardar Cambios</button>
  </div>
</div>

<!-- JS: carga/guardado de select -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  const grupoSelect = document.getElementById("grupoSelect");
  const guardarBtn = document.getElementById("guardarCambios");

  grupoSelect.addEventListener("change", () => {
    const idGrupo = grupoSelect.value;
    document.querySelectorAll(".selectHorario").forEach(sel => sel.value = "");

    if (!idGrupo) return;

    fetch(`../funciones/obtener_horario.php?id_grupo=${idGrupo}`)
      .then(res => res.ok ? res.json() : [])
      .then(data => {
        if (!Array.isArray(data)) return;
        data.forEach(item => {
          const sel = document.querySelector(`.selectHorario[data-dia='${item.dia_semana}'][data-hora='${item.id_horario}']`);
          if (sel) sel.value = item.id_asignatura; // Ajustar según la respuesta JSON
        });
      })
      .catch(err => console.log('Error al obtener horarios:', err));
  });

  guardarBtn.addEventListener("click", () => {
    if (!grupoSelect.value) {
      Swal.fire("Error", "Debes seleccionar un grupo antes de guardar.", "error");
      return;
    }

    Swal.fire({
      title: "¿Guardar cambios?",
      text: "¿Estás seguro de guardar los cambios realizados en la tabla?",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Aceptar",
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#198754",
      cancelButtonColor: "#dc3545"
    }).then((result) => {
      if (result.isConfirmed) {
        const datos = [];
        document.querySelectorAll(".selectHorario").forEach(sel => {
          datos.push({
            id_horario: sel.dataset.hora,
            dia_semana: sel.dataset.dia,
            id_asignatura: sel.value || null
          });
        });

        fetch("../funciones/guardar_horario.php", {
          method: "POST",
          headers: {"Content-Type": "application/json"},
          body: JSON.stringify({id_grupo: grupoSelect.value, horarios: datos})
        })
        .then(res => res.ok ? res.json() : Promise.reject('error'))
        .then(resp => Swal.fire(resp.titulo, resp.mensaje, resp.icono))
        .catch(() => Swal.fire("Error", "No se pudieron guardar los cambios.", "error"));
      }
    });
  });
</script>



<!-- Hero Espacios -->
<div class="hero text-white py-5 d-flex align-items-center justify-content-center" style="background-image: url('https://images.unsplash.com/photo-1604134967494-8a9ed3adea0d?q=80&w=1974&auto=format&fit=crop'); background-size: cover; background-position: center; position: relative; min-height: 400px;">
  <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: rgba(0,0,0,0.4); border-radius: 20px"></div>
  <div class="container text-center" style="position: relative; z-index: 1;">
    <h2 data-traducible="Gestión de Espacios" class="display-6 fw-semibold">Gestión de Espacios</h2>
    <p data-traducible="Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos" class="mb-4">Desde aquí podés agregar nuevos espacios al sistema y asignarles recursos</p>
    <div class="d-flex justify-content-center gap-3">
      <button class="btn btn-light btn-lg btn_wicon" data-bs-toggle="modal" data-bs-target="#agregarEspacioModal" data-traducible="Agregar Espacio">
        <i class="bi bi-clipboard-plus-fill"></i>Agregar Espacio
      </button>
    </div>
  </div>
</div>

<!-- Modal Agregar Espacio -->
<div class="modal fade" id="agregarEspacioModal" tabindex="-1" aria-labelledby="agregarEspacioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="formEspacio" action="../funciones/agregar_espacio.php" method="POST">
        <div class="modal-header">
          <h5 data-traducible="Agregar Espacio" class="modal-title" id="agregarEspacioLabel">Agregar Espacio</h5>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label data-traducible="Tipo de Salón" class="form-label">Tipo de Salón</label>
            <select name="tipo_salon" class="form-select" required>
              <option value="" data-traducible="Seleccione un tipo">Seleccione un tipo</option>
              <option value="Aula" data-traducible="Aula">Aula</option>
              <option value="Laboratorio" data-traducible="Laboratorio">Laboratorio</option>
              <option value="Salón" data-traducible="Salón">Salón</option>
              <option value="SUM" data-traducible="SUM">SUM</option>
            </select>
          </div>
          <!-- Descripción del salón -->
          <div class="mb-3">
            <label class="form-label">Nº de Espacio</label>
            <input 
              type="number" 
              name="descripcion" 
              id="descripcion" 
              class="form-control" 
              placeholder="Ej: 2" 
              required>
          </div>
          <label data-traducible="Selecciona los recursos que contiene:" class="form-label">Selecciona los recursos que contiene:</label><br>
          <div class="recursos">
            <input type="checkbox" id="television" name="opciones[]" value="Televisión">
            <label for="television"><img src="../../img/icons/tv_icon.png" class="icono" data-traducible="Televisión">Televisión</label><br>
            <input type="checkbox" id="cableHDMI" name="opciones[]" value="Cable HDMI">
            <label for="cableHDMI"><img src="../../img/icons/hdmi_icon.png" class="icono" data-traducible="Cable HDMI">Cable HDMI</label><br>
            <input type="checkbox" id="aireAcondicionado" name="opciones[]" value="Aire Acondicionado">
            <label for="aireAcondicionado"><img src="../../img/icons/air_icon.png" class="icono" data-traducible="Aire Acondicionado">Aire Acondicionado</label><br>
            <input type="checkbox" id="proyector" name="opciones[]" value="Proyector">
            <label for="proyector"><img src="../../img/icons/proyector_icon.png" class="icono" data-traducible="Proyector">Proyector</label><br>
            <input type="checkbox" id="alargue" name="opciones[]" value="Alargue">
            <label for="alargue"><img src="../../img/icons/alargue_icon.png" class="icono" data-traducible="Alargue">Alargue</label><br>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
          <button type="submit" class="btn btn-success" data-traducible="Guardar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById("formEspacio").addEventListener("submit", function(e) {
  const descripcion = document.getElementById("descripcion").value.trim();
  if (!/^\d+$/.test(descripcion)) {
    e.preventDefault();
    alert("Por favor, indica solo el número del espacio (sin letras ni símbolos).");
  }
});
</script>

<!-- Sección Reservas -->
<div id="tabla_reservas_adscripta" class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="m-0" data-traducible="Reservas Realizadas por los Docentes" id="title_reserva">Reservas de los Docentes</h2>
  <button id="btnRecargar" class="btn btn-outline-primary d-flex align-items-center gap-2">
    <i class="bi bi-arrow-clockwise"></i> Recargar Reservas
  </button>
</div>
  <div class="row">
    <?php
    include '../login/conexion_bd.php';
    $sql = "SELECT r.id_reserva, e.nombre_espacio, e.tipo AS tipo_salon,
                   DATE(r.fecha_inicio) AS fecha,
                   TIME(r.fecha_inicio) AS hora_inicio,
                   TIME(r.fecha_fin) AS hora_fin,
                   u.nombre AS nombre_docente, u.apellido AS apellido_docente,
                   r.estado
            FROM reserva r
            JOIN espacio e ON r.id_espacio = e.id_espacio
            JOIN usuario u ON r.id_docente = u.id_usuario
            ORDER BY r.fecha_inicio DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $estado = $row['estado'];
            $colorEstado = 'secondary'; $icono = 'question-circle'; $textoColor = 'text-dark';
            if ($estado == 'Pendiente') { $colorEstado='warning'; $icono='clock'; $textoColor='text-warning'; $estadoTraducible = 'Pendiente'; }
            elseif ($estado == 'Aprobada') { $colorEstado='success'; $icono='check-circle'; $textoColor='text-success'; $estadoTraducible = 'Aprobada'; }
            elseif ($estado == 'No aprobada' || $estado=='Rechazada'||$estado=='Rechazado') { $colorEstado='danger'; $icono='x-circle'; $textoColor='text-danger'; $estadoTraducible = 'No aprobada'; }
    ?>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-lg h-100 rounded-4 overflow-hidden">
                    <div class="card-header bg-<?php echo $colorEstado; ?> bg-gradient text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-<?php echo $icono; ?>"></i>
                            <?php echo $row['nombre_docente'].' '.$row['apellido_docente']; ?>
                        </h5>
                        <span class="badge bg-light <?php echo $textoColor; ?> fw-bold" data-traducible="<?php echo $estadoTraducible; ?>"><?php echo strtoupper($estadoTraducible); ?></span>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-3">
                            <li><strong data-traducible="Salón:">Salón:</strong> <?php echo $row['nombre_espacio'].' ('.$row['tipo_salon'].')'; ?></li>
                            <li><strong data-traducible="Fecha:">Fecha:</strong> <?php echo $row['fecha']; ?></li>
                            <li><strong data-traducible="Horario:">Horario:</strong> <?php echo $row['hora_inicio'].' - '.$row['hora_fin']; ?></li>
                        </ul>

                        <?php if($estado == 'Pendiente'){ ?>
                        <form action="../funciones/aprobar_reserva.php" method="POST" class="d-flex justify-content-between">
                            <input type="hidden" name="id_reserva" value="<?php echo $row['id_reserva']; ?>">
                            <button type="submit" name="accion" value="Aprobar" class="btn btn-success w-50 me-2" data-traducible="Aprobar">
                                <i class="bi bi-check-lg"></i> Aprobar
                            </button>
                            <button type="submit" name="accion" value="Rechazar" class="btn btn-danger w-50" data-traducible="No aprobar">
                                <i class="bi bi-x-lg"></i> No aprobar
                            </button>
                        </form>
                        <?php } ?>
                    </div>
                    <div class="card-footer text-muted text-center small bg-light">
                        ID Reserva: <?php echo $row['id_reserva']; ?>
                    </div>
                </div>
            </div>
    <?php
        }
    } else {
        echo '<div class="col-12"><p class="text-center text-muted fs-5" data-traducible="No hay reservas registradas aún.">No hay reservas registradas aún.</p></div>';
    }
    $conn->close();
    ?>
  </div>
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


<?php include '../tools/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
<script>
  document.getElementById('btnRecargar').addEventListener('click', () => {
    // Agregamos un pequeño efecto visual de recarga
    const btn = document.getElementById('btnRecargar');
    btn.disabled = true;
    btn.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Recargando...';
    setTimeout(() => location.reload(), 1000);
  });
</script>

<style>
  /* animación del icono girando */
  .spin {
    animation: spin 1s linear infinite;
  }
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>
