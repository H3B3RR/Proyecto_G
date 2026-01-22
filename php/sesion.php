<?php
session_start();

// Función para verificar si el usuario está autenticado
function verificar_sesion() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ../index.php');
        exit();
    }
}

// Función para verificar si es admin
function verificar_admin() {
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
        header('Location: ../dashboard.php');
        exit();
    }
}

// Función para cerrar sesión
function cerrar_sesion() {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>
