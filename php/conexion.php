<?php
// Configuración de conexión a la base de datos
define('SERVIDOR', 'localhost');
define('USUARIO_DB', 'root');
define('CLAVE_DB', '');
define('BASE_DATOS', 'almacen');

// Crear conexión
$conexion = new mysqli(SERVIDOR, USUARIO_DB, CLAVE_DB, BASE_DATOS);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Establecer el charset a UTF-8
$conexion->set_charset("utf8");

// Función para escapar datos
function escapar($datos, $conexion) {
    return $conexion->real_escape_string(trim($datos));
}

// Función para consultas SELECT
function consultar($sql, $conexion) {
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        return ['error' => 'Error en la consulta: ' . $conexion->error];
    }
    return $resultado;
}

// Función para ejecutar insert, update, delete
function ejecutar($sql, $conexion) {
    if ($conexion->query($sql) === TRUE) {
        return ['exito' => true, 'id' => $conexion->insert_id, 'filas' => $conexion->affected_rows];
    } else {
        return ['error' => 'Error: ' . $conexion->error];
    }
}
?>
