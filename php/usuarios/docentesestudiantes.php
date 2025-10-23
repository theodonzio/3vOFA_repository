<?php
// Obtener el ID del grupo desde la URL y guardarlo ANTES de incluir el header
$id_grupo_actual = isset($_GET['id_grupo']) ? intval($_GET['id_grupo']) : null;
$id_grupo = $id_grupo_actual; // Para usar en el resto del archivo

if (!$id_grupo) {
    header("Location: ../index.php");
    exit;
}

include '../tools/head.php';
include '../login/conexion_bd.php';
include '../tools/headers/header_estudiante.php';
?>

<link rel="stylesheet" href="../../css/style.css">
<body>

<!-- Título Principal -->
<div class="text-center my-5">
    <div class="mb-4">
        <i class="bi bi-person-workspace icon-main"></i>
    </div>
    <h1 class="display-4 fw-bold text-primary" data-traducible="Mis Docentes">Mis Docentes</h1>
    <p class="lead text-muted" data-traducible="Conoce a los profesores de tu grupo">
        Conoce a los profesores de tu grupo
    </p>
    <div id="watch" class="reloj text-center mt-2 fs-4 fw-semibold text-primary"></div>
</div>

<!-- Información del Grupo -->
<?php
$sql_grupo = "SELECT g.nombre_grupo, c.nombre_curso, t.nombre_turno 
              FROM grupo g
              LEFT JOIN curso c ON g.id_curso = c.id_curso
              LEFT JOIN turno t ON g.id_turno = t.id_turno
              WHERE g.id_grupo = ?";
$stmt = $conn->prepare($sql_grupo);
$stmt->bind_param("i", $id_grupo);
$stmt->execute();
$result_grupo = $stmt->get_result();
$grupo_info = $result_grupo->fetch_assoc();
$stmt->close();
?>

<div class="container my-4">
    <div class="alert alert-info text-center">
        <h4 class="mb-2">
            <i class="bi bi-people-fill me-2"></i>
            <strong>Grupo:</strong> <?= htmlspecialchars($grupo_info['nombre_grupo'] ?? 'N/A') ?>
        </h4>
        <p class="mb-0">
            <strong>Curso:</strong> <?= htmlspecialchars($grupo_info['nombre_curso'] ?? 'N/A') ?> | 
            <strong>Turno:</strong> <?= htmlspecialchars($grupo_info['nombre_turno'] ?? 'N/A') ?>
        </p>
    </div>
</div>

<!-- Lista de Docentes y sus Materias -->
<div class="container my-5">
    <div class="row g-4">
        <?php
        // Obtener docentes del grupo con sus asignaturas
        $sql = "SELECT DISTINCT 
                    u.id_usuario,
                    u.nombre,
                    u.apellido,
                    u.email,
                    GROUP_CONCAT(DISTINCT a.nombre_asignatura SEPARATOR ', ') as materias
                FROM grupo_asignatura ga
                JOIN usuario u ON ga.id_docente = u.id_usuario
                JOIN asignatura a ON ga.id_asignatura = a.id_asignatura
                WHERE ga.id_grupo = ?
                GROUP BY u.id_usuario, u.nombre, u.apellido, u.email
                ORDER BY u.apellido, u.nombre";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_grupo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            while ($docente = $result->fetch_assoc()) {
                $nombre_completo = htmlspecialchars($docente['nombre'] . ' ' . $docente['apellido']);
                $email = htmlspecialchars($docente['email']);
                $materias = htmlspecialchars($docente['materias'] ?? 'Sin asignaturas asignadas');
                
                // Generar iniciales para el avatar
                $iniciales = strtoupper(substr($docente['nombre'], 0, 1) . substr($docente['apellido'], 0, 1));
                
                // Color aleatorio pero consistente basado en el ID
                $colores = ['#0d6efd', '#198754', '#dc3545', '#ffc107', '#0dcaf0', '#6f42c1', '#fd7e14'];
                $color = $colores[$docente['id_usuario'] % count($colores)];
        ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 docente-card">
                        <div class="card-body text-center">
                            <!-- Avatar con iniciales -->
                            <div class="avatar-circle mx-auto mb-3" style="background-color: <?= $color ?>;">
                                <?= $iniciales ?>
                            </div>
                            
                            <!-- Nombre del docente -->
                            <h5 class="card-title mb-2 fw-bold">
                                <?= $nombre_completo ?>
                            </h5>
                            
                            <!-- Email -->
                            <p class="text-muted small mb-3">
                                <i class="bi bi-envelope me-1"></i>
                                <a href="mailto:<?= $email ?>" class="text-decoration-none text-muted">
                                    <?= $email ?>
                                </a>
                            </p>
                            
                            <!-- Materias -->
                            <div class="card bg-light p-3 rounded">
                                <h6 class="text-primary mb-2">
                                    <i class="bi bi-book me-2"></i>
                                    <span data-traducible="Materias que imparte">Materias que imparte</span>
                                </h6>
                                <p class="mb-0 text-start">
                                    <?php
                                    $materias_array = explode(', ', $materias);
                                    foreach ($materias_array as $materia) {
                                        echo '<span class="badge bg-primary me-1 mb-1">' . htmlspecialchars($materia) . '</span>';
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
            $stmt->close();
        } else {
            echo '
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    <i class="bi bi-exclamation-triangle fs-1 mb-3 d-block"></i>
                    <h4 data-traducible="No hay docentes asignados">No hay docentes asignados</h4>
                    <p data-traducible="Aún no se han asignado docentes a tu grupo.">
                        Aún no se han asignado docentes a tu grupo.
                    </p>
                </div>
            </div>';
        }
        ?>
    </div>
</div>

<!-- Botón volver -->
<div class="container text-center my-5">
    <a href="estudiante.php?id_grupo=<?= $id_grupo ?>" class="btn btn-outline-primary btn-lg">
        <i class="bi bi-arrow-left me-2"></i>
        <span data-traducible="Volver a mi horario">Volver a mi horario</span>
    </a>
</div>

<!-- Botón scroll top -->
<a href="#top" id="scrollTopBtn" class="btn btn-secondary shadow-lg position-fixed bottom-0 end-0 m-4">
    <i class="bi bi-caret-up-fill"></i>
</a>

<?php include '../tools/footer.php'; ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/modoClaroOscuro.js"></script>
<script src="../../js/traductor.js"></script>
<script src="../../js/scroll-top.js"></script>
<script src="../../js/watchFunction.js"></script>

</body>
</html>

<?php $conn->close(); ?>