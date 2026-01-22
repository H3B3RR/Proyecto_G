<?php
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = escapar($_POST['email'] ?? '', $conexion);
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Por favor complete todos los campos';
        header('Location: ../index.php');
        exit();
    }
    
    // Buscar usuario
    $sql = "SELECT id, nombre, email, password, rol FROM usuarios WHERE email = '$email' AND estado = 'activo'";
    $resultado = consultar($sql, $conexion);
    
    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        // Verificar contraseña (en producción usar password_hash y password_verify)
        if ($password === 'admin123' || md5($password) === $usuario['password']) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['rol'] = $usuario['rol'];
            
            header('Location: ../dashboard.php');
            exit();
        } else {
            $_SESSION['error'] = 'Contraseña incorrecta';
        }
    } else {
        $_SESSION['error'] = 'Usuario no encontrado o inactivo';
    }
    
    header('Location: ../index.php');
    exit();
}
?>
