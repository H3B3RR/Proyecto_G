<?php
require_once 'php/sesion.php';
require_once 'php/conexion.php';

verificar_sesion();
verificar_admin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Almacén</title>
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
                    <a href="dashboard.php">Dashboard</a>
                    <a href="productos.php">Productos</a>
                    <a href="movimientos.php">Movimientos</a>
                    <a href="reportes.php">Reportes</a>
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
                    <li><a href="dashboard.php">📊 Dashboard</a></li>
                    <li><a href="productos.php">📦 Productos</a></li>
                    <li><a href="movimientos.php">↔️ Movimientos</a></li>
                    <li><a href="reportes.php" class="active">📈 Reportes</a></li>
                    <li><a href="usuarios.php">👥 Usuarios</a></li>
                </ul>
            </aside>

            <!-- Main Content Area -->
            <main class="main-content">
                <div class="card">
                    <div class="card-header">
                        <h2>Reportes del Sistema</h2>
                    </div>

                    <!-- Reportes Grid -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                        <div class="card" style="margin: 0; background: linear-gradient(135deg, #3498db, #2980b9); color: white;">
                            <div style="font-size: 2rem; margin-bottom: 1rem;">📦</div>
                            <div style="font-weight: bold; margin-bottom: 0.5rem;">Inventario</div>
                            <p style="opacity: 0.9; margin-bottom: 1rem;">Reporte completo de inventario actual</p>
                            <button class="btn" style="background-color: rgba(255,255,255,0.2); width: 100%;" onclick="generarReporte('inventario')">Ver Reporte</button>
                        </div>

                        <div class="card" style="margin: 0; background: linear-gradient(135deg, #27ae60, #229954); color: white;">
                            <div style="font-size: 2rem; margin-bottom: 1rem;">💰</div>
                            <div style="font-weight: bold; margin-bottom: 0.5rem;">Ventas</div>
                            <p style="opacity: 0.9; margin-bottom: 1rem;">Reporte de ventas por período</p>
                            <button class="btn" style="background-color: rgba(255,255,255,0.2); width: 100%;" onclick="generarReporte('ventas')">Ver Reporte</button>
                        </div>

                        <div class="card" style="margin: 0; background: linear-gradient(135deg, #f39c12, #e67e22); color: white;">
                            <div style="font-size: 2rem; margin-bottom: 1rem;">⚠️</div>
                            <div style="font-weight: bold; margin-bottom: 0.5rem;">Stock Bajo</div>
                            <p style="opacity: 0.9; margin-bottom: 1rem;">Productos con stock bajo</p>
                            <button class="btn" style="background-color: rgba(255,255,255,0.2); width: 100%;" onclick="generarReporte('stock-bajo')">Ver Reporte</button>
                        </div>

                        <div class="card" style="margin: 0; background: linear-gradient(135deg, #e74c3c, #c0392b); color: white;">
                            <div style="font-size: 2rem; margin-bottom: 1rem;">📊</div>
                            <div style="font-weight: bold; margin-bottom: 0.5rem;">Movimientos</div>
                            <p style="opacity: 0.9; margin-bottom: 1rem;">Historial de movimientos</p>
                            <button class="btn" style="background-color: rgba(255,255,255,0.2); width: 100%;" onclick="generarReporte('movimientos')">Ver Reporte</button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="js/funciones.js"></script>
    <script>
        function generarReporte(tipo) {
            mostrarAlerta('Generando reporte de ' + tipo + '...', 'success');
            // Aquí se implementaría la lógica para generar reportes
        }
    </script>
</body>
</html>
