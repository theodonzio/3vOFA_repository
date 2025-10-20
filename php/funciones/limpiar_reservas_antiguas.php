<?php
/**
 * Script para eliminar reservas antiguas automáticamente
 * Las reservas se eliminan SOLO después de que pase su fecha_fin
 */

// Evitar que se ejecute múltiples veces en la misma carga
if (defined('LIMPIEZA_RESERVAS_EJECUTADA')) {
    return;
}
define('LIMPIEZA_RESERVAS_EJECUTADA', true);

// Conexión a la base de datos
if (!isset($conn)) {
    include_once __DIR__ . '/../login/conexion_bd.php';
}

// Configurar zona horaria
date_default_timezone_set('America/Montevideo');

try {
    // Eliminar reservas cuya fecha_fin ya pasó
    $sql = "DELETE FROM reserva WHERE fecha_fin < NOW()";
    
    if ($conn->query($sql) === TRUE) {
        $eliminadas = $conn->affected_rows;
        
        // Log para debugging (puedes comentar en producción)
        if ($eliminadas > 0) {
            error_log("[" . date('Y-m-d H:i:s') . "] Limpieza automática: Se eliminaron $eliminadas reserva(s) antigua(s)");
        }
        
        // Si se ejecuta manualmente desde el navegador
        if (php_sapi_name() !== 'cli' && basename($_SERVER['PHP_SELF']) === 'limpiar_reservas_antiguas.php') {
            echo "<!DOCTYPE html>
            <html>
            <head>
                <meta charset='UTF-8'>
                <title>Limpieza de Reservas</title>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
            </head>
            <body class='bg-light'>
                <div class='container mt-5'>
                    <div class='alert alert-success'>
                        <h4 class='alert-heading'><i class='bi bi-check-circle'></i> Limpieza completada</h4>
                        <p>Se eliminaron <strong>$eliminadas</strong> reserva(s) antigua(s) exitosamente.</p>
                        <hr>
                        <p class='mb-0'><small>Fecha: " . date('Y-m-d H:i:s') . "</small></p>
                    </div>
                    <a href='../usuarios/adscripta.php' class='btn btn-primary'>Volver al panel</a>
                </div>
            </body>
            </html>";
        }
    } else {
        throw new Exception($conn->error);
    }
    
} catch (Exception $e) {
    error_log("[ERROR] Limpieza de reservas: " . $e->getMessage());
    
    if (php_sapi_name() !== 'cli' && basename($_SERVER['PHP_SELF']) === 'limpiar_reservas_antiguas.php') {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Error - Limpieza de Reservas</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body class='bg-light'>
            <div class='container mt-5'>
                <div class='alert alert-danger'>
                    <h4 class='alert-heading'><i class='bi bi-x-circle'></i> Error</h4>
                    <p>No se pudo completar la limpieza de reservas.</p>
                    <hr>
                    <p class='mb-0'><small>Error: " . htmlspecialchars($e->getMessage()) . "</small></p>
                </div>
                <a href='../usuarios/adscripta.php' class='btn btn-primary'>Volver al panel</a>
            </div>
        </body>
        </html>";
    }
}

// No cerrar conexión si fue incluido desde otro archivo
if (basename($_SERVER['PHP_SELF']) === 'limpiar_reservas_antiguas.php' && isset($conn)) {
    $conn->close();
}
?>