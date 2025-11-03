<?php
/**
 * Procesa aprobación o rechazo de reservas
 */

session_start();
include '../login/conexion_bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene datos
    $id_reserva = isset($_POST['id_reserva']) ? intval($_POST['id_reserva']) : 0;
    $accion = isset($_POST['accion']) ? trim($_POST['accion']) : '';
    $use_sweetalert = isset($_POST['use_sweetalert']) ? true : false;
    
    // Valida datos
    if ($id_reserva <= 0 || empty($accion)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    // Determina nuevo estado
    if ($accion == 'Aprobar') {
        $nuevo_estado = 'Aprobada';
    } elseif ($accion == 'Rechazar') {
        $nuevo_estado = 'No aprobada';
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    // Actualiza en base de datos
    $sql = "UPDATE reserva SET estado = ? WHERE id_reserva = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("si", $nuevo_estado, $id_reserva);
        
        if ($stmt->execute()) {
            // Redirige con parámetros para SweetAlert
            $redirect_url = $_SERVER['HTTP_REFERER'];
            $separator = (strpos($redirect_url, '?') !== false) ? '&' : '?';
            $redirect_url .= $separator . "success=1&accion=" . urlencode($accion);
            
            header("Location: " . $redirect_url);
            exit();
        } else {
            // Error al actualizar
            echo "<!DOCTYPE html>
            <html>
            <head>
                <meta charset='UTF-8'>
                <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo actualizar la reserva. Intenta nuevamente.',
                        confirmButtonColor: '#dc3545'
                    }).then(() => {
                        window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
                    });
                </script>
            </body>
            </html>";
            exit();
        }
        
        $stmt->close();
    } else {
        // Error al preparar consulta
        echo "<!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la base de datos',
                    text: 'Contacta al administrador del sistema.',
                    confirmButtonColor: '#dc3545'
                }).then(() => {
                    window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
                });
            </script>
        </body>
        </html>";
        exit();
    }
    
    $conn->close();
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>