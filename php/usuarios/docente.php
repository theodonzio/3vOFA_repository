<?php
session_start();

// Verificar sesión
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_rol'] != 2) {
    header("Location: ../index.php?login=" . (!isset($_SESSION['id_usuario']) ? 'required' : 'unauthorized'));
    exit;
}

include '../tools/head.php';
include '../tools/headers/header_docente.php';
include '../login/conexion_bd.php';
$id_docente = $_SESSION['id_usuario'];
?>

<body>

<div class="text-center titulo-adscripta">
    <img src="../../img/ofalogos/blue-logo.png" class="tinylogo"> 
    <img src="../../img/blueicons/docenteblue.png" class="blue_icon"> 
    <h1 class="display-4 fw-bold text-primary" data-traducible="Sistema de Gestión">Sistema de Gestión</h1>
    <p class="lead text-muted" data-traducible="Panel exclusivo para Docentes">Panel exclusivo para Docentes</p>
    <?php include '../tools/reloj.php'; ?>
</div>

<?php include '../tools/sections/seccion_horarios_docente.php'; ?>

<div class="hero hero-imagen hero-reservas text-white d-flex align-items-center justify-content-center py-5" id="reservashero">
    <div class="hero-overlay"></div>
    <div class="container text-center hero-content">
        <h2 class="display-6 fw-semibold mb-3" data-traducible="Sistema de Reservas">Sistema de Reservas</h2>
        <p class="mb-4 fs-5" data-traducible="Desde aquí podés solicitar espacios">Desde aquí podés solicitar espacios</p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-success btn-lg shadow-sm btn_wicon" data-bs-toggle="modal" data-bs-target="#realizarReservaModal">
                <i class="bi bi-bookmark-fill"></i> 
                <span data-traducible="Realizar Reserva">Realizar Reserva</span>
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="realizarReservaModal" tabindex="-1" aria-labelledby="realizarReservaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="../funciones/realizar_reserva.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="realizarReservaLabel" data-traducible="Realizar Reserva">Realizar Reserva</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" data-traducible="Selecciona un Espacio">Selecciona un Espacio</label>
                        <select name="id_espacio" id="nombre_salon" class="form-select" required>
                            <option value="" data-traducible="Seleccione un salón">Seleccione un salón</option>
                            <?php
                            $sql = "SELECT id_espacio, nombre_espacio, tipo FROM espacio ORDER BY nombre_espacio ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $nombre = htmlspecialchars($row['nombre_espacio'] . ' (' . $row['tipo'] . ')');
                                    echo "<option value='".$row['id_espacio']."'>{$nombre}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" data-traducible="Fecha">Fecha</label>
                        <input type="date" name="fecha_reserva" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" data-traducible="Horario">Horario</label>
                        <select name="id_horario" class="form-select" required>
                            <option value="" data-traducible="Seleccione un horario">Seleccione un horario</option>
                            <?php
                            $sql = "SELECT id_horario, nombre_horario, hora_inicio, hora_fin FROM horario ORDER BY id_horario ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $horario = htmlspecialchars($row['nombre_horario'] . ' (' . $row['hora_inicio'] . ' - ' . $row['hora_fin'] . ')');
                                    echo "<option value='".$row['id_horario']."'>{$horario}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    
                    <div class="mb-3" id="recursos-container" style="display:none;">
  <label class="form-label" data-traducible="Selecciona los recursos">Selecciona los recursos</label>
  <div id="recursos-list"></div>
</div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-traducible="Cancelar">Cancelar</button>
                    <button type="submit" class="btn btn-success submit_btn" data-traducible="Reservar">Reservar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../tools/sections/tabla_reservas_docente.php'; ?>

<a href="#top" id="scrollTopBtn" class="btn btn-secondary shadow-lg position-fixed bottom-0 end-0 m-4" 
   style="z-index:999; font-size:28px; opacity:0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s;">
    <i class="bi bi-caret-up-fill"></i>
</a>

<?php include '../tools/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/scroll-top.js"></script>
<script src="../../js/notificaciones-docente.js"></script>
<script src="../../js/recursos-reserva.js"></script>

</body>
</html>