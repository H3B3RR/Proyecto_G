<?php
session_start();

// Si ya está logueado, redirigir al dashboard
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Almacén - Login</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>🏪 Almacén Online</h2>
            
            <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-error">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']);
            }
            ?>
            
            <form method="POST" action="php/login.php">
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required 
                           placeholder="admin@almacen.com">
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required 
                           placeholder="admin123">
                </div>
                
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
            
            <hr style="margin: 1.5rem 0; border: none; border-top: 1px solid #ddd;">
            
            <div style="text-align: center; color: #999; font-size: 0.9rem;">
                <p><strong>Credenciales de Demo:</strong></p>
                <p>Email: admin@almacen.com</p>
                <p>Contraseña: admin123</p>
            </div>
        </div>
    </div>
</body>
</html>
