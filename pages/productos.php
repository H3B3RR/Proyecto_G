<?php
require_once 'php/sesion.php';
require_once 'php/conexion.php';

verificar_sesion();
verificar_admin();

// Obtener categorías
$sql_categorias = "SELECT * FROM categorias ORDER BY nombre";
$resultado_categorias = consultar($sql_categorias, $conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Almacén</title>
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
                    <li><a href="productos.php" class="active">📦 Productos</a></li>
                    <li><a href="movimientos.php">↔️ Movimientos</a></li>
                    <li><a href="reportes.php">📈 Reportes</a></li>
                    <li><a href="usuarios.php">👥 Usuarios</a></li>
                </ul>
            </aside>

            <!-- Main Content Area -->
            <main class="main-content">
                <div class="card">
                    <div class="card-header">
                        <h2>Gestión de Productos</h2>
                        <button class="btn btn-success" onclick="abrirModal('modalProducto')">+ Nuevo Producto</button>
                    </div>

                    <!-- Filtros -->
                    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                        <input type="text" id="buscar-producto" placeholder="Buscar producto..." 
                               style="flex: 1; min-width: 200px; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px;">
                        <select id="filtro-categoria" style="min-width: 200px; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px;">
                            <option value="">Todas las categorías</option>
                            <?php
                            while ($cat = $resultado_categorias->fetch_assoc()) {
                                echo '<option value="' . $cat['id'] . '">' . htmlspecialchars($cat['nombre']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Productos Grid -->
                    <div id="productos-contenedor" class="productos-grid"></div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Producto -->
    <div id="modalProducto" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Producto</h3>
                <button class="close-btn" onclick="cerrarModal('modalProducto')">&times;</button>
            </div>
            <form id="formularioProducto" onsubmit="guardarProducto(event)">
                <input type="hidden" id="producto-id" name="id">

                <div class="form-group">
                    <label>Nombre del Producto</label>
                    <input type="text" id="producto-nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label>Código</label>
                    <input type="text" id="producto-codigo" name="codigo" required>
                </div>

                <div class="form-group">
                    <label>Categoría</label>
                    <select id="producto-categoria" name="categoria_id" required>
                        <option value="">Seleccionar categoría</option>
                        <?php
                        $resultado_categorias->data_seek(0);
                        while ($cat = $resultado_categorias->fetch_assoc()) {
                            echo '<option value="' . $cat['id'] . '">' . htmlspecialchars($cat['nombre']) . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Precio</label>
                    <input type="number" id="producto-precio" name="precio" step="0.01" required>
                </div>

                <div class="form-group">
                    <label>Cantidad</label>
                    <input type="number" id="producto-cantidad" name="cantidad" required>
                </div>

                <div class="form-group">
                    <label>Cantidad Mínima</label>
                    <input type="number" id="producto-cantidad-minima" name="cantidad_minima" value="10">
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea id="producto-descripcion" name="descripcion" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px;"></textarea>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-success" style="flex: 1;">Guardar</button>
                    <button type="button" class="btn" style="flex: 1; background-color: #95a5a6;" onclick="cerrarModal('modalProducto')">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/funciones.js"></script>
</body>
</html>
