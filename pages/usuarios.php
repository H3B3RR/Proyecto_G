<?php
require_once 'php/sesion.php';
require_once 'php/conexion.php';

verificar_sesion();
verificar_admin();

// Obtener usuarios
$sql = "SELECT * FROM usuarios ORDER BY fecha_creacion DESC";
$resultado = consultar($sql, $conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - Almacén</title>
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
                    <li><a href="reportes.php">📈 Reportes</a></li>
                    <li><a href="usuarios.php" class="active">👥 Usuarios</a></li>
                </ul>
            </aside>

            <!-- Main Content Area -->
            <main class="main-content">
                <div class="card">
                    <div class="card-header">
                        <h2>Gestión de Usuarios</h2>
                        <button class="btn btn-success" onclick="abrirModal('modalUsuario')">+ Nuevo Usuario</button>
                    </div>

                    <!-- Tabla de Usuarios -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Fecha Creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($usuario = $resultado->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($usuario['nombre']) . '</td>';
                                echo '<td>' . htmlspecialchars($usuario['email']) . '</td>';
                                echo '<td><span class="btn btn-sm" style="background-color: ' . ($usuario['rol'] == 'admin' ? '#e74c3c' : '#3498db') . '; color: white;">' . ucfirst($usuario['rol']) . '</span></td>';
                                echo '<td><span class="btn btn-sm" style="background-color: ' . ($usuario['estado'] == 'activo' ? '#27ae60' : '#95a5a6') . '; color: white;">' . ucfirst($usuario['estado']) . '</span></td>';
                                echo '<td>' . date('d/m/Y', strtotime($usuario['fecha_creacion'])) . '</td>';
                                echo '<td><button class="btn btn-sm btn-warning" onclick="editarUsuario(' . $usuario['id'] . ')">Editar</button></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Usuario -->
    <div id="modalUsuario" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Usuario</h3>
                <button class="close-btn" onclick="cerrarModal('modalUsuario')">&times;</button>
            </div>
            <form onsubmit="guardarUsuario(event)">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" id="usuario-nombre" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="usuario-email" required>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" id="usuario-password" required>
                </div>

                <div class="form-group">
                    <label>Rol</label>
                    <select id="usuario-rol" required>
                        <option value="empleado">Empleado</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-success" style="flex: 1;">Guardar</button>
                    <button type="button" class="btn" style="flex: 1; background-color: #95a5a6;" onclick="cerrarModal('modalUsuario')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/funciones.js"></script>
    <script>
        function editarUsuario(id) {
            abrirModal('modalUsuario');
            // Aquí se cargarían los datos del usuario
        }

        function guardarUsuario(e) {
            e.preventDefault();
            mostrarAlerta('Usuario guardado correctamente', 'success');
            cerrarModal('modalUsuario');
        }
    </script>
</body>
</html>
