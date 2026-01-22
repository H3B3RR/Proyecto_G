<?php
require_once 'conexion.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'No autorizado']);
    exit();
}

$accion = $_GET['accion'] ?? '';

if ($accion == 'listar') {
    $categoria = $_GET['categoria'] ?? '';
    $buscar = $_GET['buscar'] ?? '';
    
    $sql = "SELECT p.*, c.nombre as categoria FROM productos p 
            INNER JOIN categorias c ON p.categoria_id = c.id 
            WHERE p.estado = 'activo'";
    
    if (!empty($categoria)) {
        $categoria = escapar($categoria, $conexion);
        $sql .= " AND p.categoria_id = $categoria";
    }
    
    if (!empty($buscar)) {
        $buscar = escapar($buscar, $conexion);
        $sql .= " AND (p.nombre LIKE '%$buscar%' OR p.codigo LIKE '%$buscar%')";
    }
    
    $resultado = consultar($sql, $conexion);
    $productos = [];
    
    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = $fila;
    }
    
    echo json_encode($productos);
}

elseif ($accion == 'obtener') {
    $id = intval($_GET['id'] ?? 0);
    $sql = "SELECT p.*, c.nombre as categoria FROM productos p 
            INNER JOIN categorias c ON p.categoria_id = c.id 
            WHERE p.id = $id";
    
    $resultado = consultar($sql, $conexion);
    $producto = $resultado->fetch_assoc();
    
    echo json_encode($producto);
}

elseif ($accion == 'guardar' && $_SESSION['rol'] == 'admin' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $nombre = escapar($_POST['nombre'] ?? '', $conexion);
    $codigo = escapar($_POST['codigo'] ?? '', $conexion);
    $categoria_id = intval($_POST['categoria_id'] ?? 0);
    $precio = floatval($_POST['precio'] ?? 0);
    $cantidad = intval($_POST['cantidad'] ?? 0);
    $cantidad_minima = intval($_POST['cantidad_minima'] ?? 10);
    $descripcion = escapar($_POST['descripcion'] ?? '', $conexion);
    
    if ($id > 0) {
        // Actualizar
        $sql = "UPDATE productos SET nombre='$nombre', codigo='$codigo', categoria_id=$categoria_id, 
                precio=$precio, cantidad=$cantidad, cantidad_minima=$cantidad_minima, 
                descripcion='$descripcion' WHERE id=$id";
    } else {
        // Insertar
        $sql = "INSERT INTO productos (nombre, codigo, categoria_id, precio, cantidad, cantidad_minima, descripcion) 
                VALUES ('$nombre', '$codigo', $categoria_id, $precio, $cantidad, $cantidad_minima, '$descripcion')";
    }
    
    $resultado = ejecutar($sql, $conexion);
    echo json_encode($resultado);
}

elseif ($accion == 'eliminar' && $_SESSION['rol'] == 'admin') {
    $id = intval($_GET['id'] ?? 0);
    $sql = "UPDATE productos SET estado='inactivo' WHERE id=$id";
    $resultado = ejecutar($sql, $conexion);
    echo json_encode($resultado);
}

else {
    echo json_encode(['error' => 'Acción no válida']);
}
?>
