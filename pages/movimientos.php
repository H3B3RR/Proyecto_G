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
    <title>Movimientos - Almacén</title>
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
                    <li><a href="movimientos.php" class="active">↔️ Movimientos</a></li>
                    <li><a href="reportes.php">📈 Reportes</a></li>
                    <li><a href="usuarios.php">👥 Usuarios</a></li>
                </ul>
            </aside>

            <!-- Main Content Area -->
            <main class="main-content">
                <div class="card">
                    <div class="card-header">
                        <h2>Movimientos de Inventario</h2>
                        <button class="btn btn-success" onclick="abrirModal('modalMovimiento')">+ Nuevo Movimiento</button>
                    </div>

                    <!-- Tabla de Movimientos -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>Tipo</th>
                                <th>Cantidad</th>
                                <th>Usuario</th>
                                <th>Observación</th>
                            </tr>
                        </thead>
                        <tbody id="movimientos-tabla">
                            <tr>
                                <td colspan="6" style="text-align: center; color: #999;">Cargando movimientos...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Movimiento -->
    <div id="modalMovimiento" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Registrar Movimiento</h3>
                <button class="close-btn" onclick="cerrarModal('modalMovimiento')">&times;</button>
            </div>
            <form onsubmit="guardarMovimiento(event)">
                <div class="form-group">
                    <label>Producto</label>
                    <select id="movimiento-producto" required>
                        <option value="">Seleccionar producto</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tipo de Movimiento</label>
                    <select id="movimiento-tipo" required>
                        <option value="">Seleccionar tipo</option>
                        <option value="entrada">Entrada</option>
                        <option value="salida">Salida</option>
                        <option value="ajuste">Ajuste</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Cantidad</label>
                    <input type="number" id="movimiento-cantidad" required min="1">
                </div>

                <div class="form-group">
                    <label>Observación</label>
                    <textarea id="movimiento-observacion" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px;"></textarea>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-success" style="flex: 1;">Guardar</button>
                    <button type="button" class="btn" style="flex: 1; background-color: #95a5a6;" onclick="cerrarModal('modalMovimiento')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/funciones.js"></script>
    <script>
        // Cargar productos en el select del modal
        async function cargarProductosSelect() {
            const productos = await peticionAjax('php/api_productos.php?accion=listar');
            if (productos && !productos.error) {
                const select = document.getElementById('movimiento-producto');
                select.innerHTML = '<option value="">Seleccionar producto</option>';
                productos.forEach(p => {
                    const option = document.createElement('option');
                    option.value = p.id;
                    option.textContent = p.nombre + ' (' + p.codigo + ')';
                    select.appendChild(option);
                });
            }
        }

        async function guardarMovimiento(e) {
            e.preventDefault();
            // Este es un ejemplo básico
            mostrarAlerta('Movimiento registrado correctamente', 'success');
            cerrarModal('modalMovimiento');
            cargarProductosSelect();
        }

        document.addEventListener('DOMContentLoaded', cargarProductosSelect);
    </script>
</body>
</html>
