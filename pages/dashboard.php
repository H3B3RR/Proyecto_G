<?php
require_once 'php/sesion.php';
require_once 'php/conexion.php';

verificar_sesion();

// Obtener estadísticas
$sql_productos = "SELECT COUNT(*) as total FROM productos WHERE estado = 'activo'";
$resultado = consultar($sql_productos, $conexion);
$total_productos = $resultado->fetch_assoc()['total'];

$sql_cantidad = "SELECT SUM(cantidad) as total FROM productos WHERE estado = 'activo'";
$resultado = consultar($sql_cantidad, $conexion);
$total_cantidad = $resultado->fetch_assoc()['total'] ?? 0;

$sql_ventas = "SELECT COUNT(*) as total FROM ventas WHERE DATE(fecha) = CURDATE()";
$resultado = consultar($sql_ventas, $conexion);
$ventas_hoy = $resultado->fetch_assoc()['total'];

// Obtener categorías
$sql_categorias = "SELECT * FROM categorias ORDER BY nombre";
$resultado_categorias = consultar($sql_categorias, $conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Almacén</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="navbar-content">
                <div class="navbar-brand">🏪 Almacén Online</div>
                <div class="navbar-menu">
                    <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                    <?php if ($_SESSION['rol'] == 'admin'): ?>
                        <a href="productos.php">Productos</a>
                        <a href="movimientos.php">Movimientos</a>
                        <a href="reportes.php">Reportes</a>
                    <?php endif; ?>
                    <a href="php/logout.php" class="logout-btn">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container" style="padding: 2rem 0;">
        <div class="dashboard-container">
            <!-- Sidebar -->
            <aside class="sidebar">
                <ul class="sidebar-menu">
                    <li><a href="dashboard.php" class="active">📊 Dashboard</a></li>
                    <?php if ($_SESSION['rol'] == 'admin'): ?>
                        <li><a href="productos.php">📦 Productos</a></li>
                        <li><a href="movimientos.php">↔️ Movimientos</a></li>
                        <li><a href="reportes.php">📈 Reportes</a></li>
                        <li><a href="usuarios.php">👥 Usuarios</a></li>
                    <?php endif; ?>
                </ul>
            </aside>

            <!-- Main Content Area -->
            <main class="main-content">
                <div class="card">
                    <div class="card-header">
                        <h2>Dashboard</h2>
                    </div>

                    <!-- Statistics -->
                    <div class="stats-grid">
                        <div class="stat-card primary">
                            <div class="stat-label">Total de Productos</div>
                            <div class="stat-value"><?php echo $total_productos; ?></div>
                        </div>
                        <div class="stat-card success">
                            <div class="stat-label">Unidades en Stock</div>
                            <div class="stat-value"><?php echo $total_cantidad; ?></div>
                        </div>
                        <div class="stat-card danger">
                            <div class="stat-label">Ventas Hoy</div>
                            <div class="stat-value"><?php echo $ventas_hoy; ?></div>
                        </div>
                    </div>
                </div>

                <!-- Quick Access -->
                <div class="card">
                    <div class="card-header">
                        <h2>Acceso Rápido</h2>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        <?php if ($_SESSION['rol'] == 'admin'): ?>
                            <a href="productos.php" style="padding: 1.5rem; background: linear-gradient(135deg, #3498db, #2980b9); color: white; border-radius: 10px; text-decoration: none; text-align: center;">
                                <div style="font-size: 2rem;">📦</div>
                                <div style="font-weight: bold; margin-top: 0.5rem;">Gestionar Productos</div>
                            </a>
                            <a href="movimientos.php" style="padding: 1.5rem; background: linear-gradient(135deg, #27ae60, #229954); color: white; border-radius: 10px; text-decoration: none; text-align: center;">
                                <div style="font-size: 2rem;">↔️</div>
                                <div style="font-weight: bold; margin-top: 0.5rem;">Registrar Movimientos</div>
                            </a>
                            <a href="reportes.php" style="padding: 1.5rem; background: linear-gradient(135deg, #f39c12, #e67e22); color: white; border-radius: 10px; text-decoration: none; text-align: center;">
                                <div style="font-size: 2rem;">📈</div>
                                <div style="font-weight: bold; margin-top: 0.5rem;">Ver Reportes</div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-header">
                        <h2>Información del Sistema</h2>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Usuario:</strong></td>
                                <td><?php echo htmlspecialchars($_SESSION['nombre']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Rol:</strong></td>
                                <td><?php echo ucfirst($_SESSION['rol']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Correo:</strong></td>
                                <td><?php echo htmlspecialchars($_SESSION['email']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha y Hora:</strong></td>
                                <td><?php echo date('d/m/Y H:i:s'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="js/funciones.js"></script>
</body>
</html>
