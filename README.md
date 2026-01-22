# Proyecto_G - Sistema de Almacén Web

Proyecto web para gestión de inventario de almacén desarrollado con **PHP, HTML, CSS y JavaScript**.

## Características

- ✅ **Autenticación de usuarios** - Login seguro
- ✅ **Gestión de productos** - CRUD completo
- ✅ **Control de inventario** - Registro de movimientos
- ✅ **Dashboard** - Estadísticas en tiempo real
- ✅ **Reportes** - Generación de reportes
- ✅ **Gestión de usuarios** - Administración de empleados
- ✅ **Interfaz responsive** - Funciona en todos los dispositivos

## Requisitos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Navegador web moderno

## Instalación

### 1. Crear la Base de Datos
```bash
mysql -u root -p < database/almacen.sql
```

### 2. Configurar Conexión
Edita `php/conexion.php`:
```php
define('SERVIDOR', 'localhost');
define('USUARIO_DB', 'root');
define('CLAVE_DB', '');
define('BASE_DATOS', 'almacen');
```

### 3. Acceder al Sistema
```
http://localhost/almacen/
```

## Credenciales Iniciales

- **Email**: admin@almacen.com
- **Contraseña**: admin123

## Estructura del Proyecto

```
almacen/
├── css/
│   └── estilos.css
├── js/
│   └── funciones.js
├── php/
│   ├── conexion.php
│   ├── sesion.php
│   ├── login.php
│   ├── logout.php
│   └── api_productos.php
├── database/
│   └── almacen.sql
├── uploads/
├── index.php
├── dashboard.php
├── productos.php
├── movimientos.php
├── reportes.php
└── usuarios.php
```

## Módulos Principales

1. **Autenticación** - Login con sesiones
2. **Dashboard** - Panel con estadísticas
3. **Productos** - CRUD de productos
4. **Movimientos** - Control de inventario
5. **Reportes** - Reportes del sistema
6. **Usuarios** - Gestión de usuarios

## Uso

1. Accede a `http://localhost/almacen/`
2. Ingresa las credenciales de demo
3. Explora los módulos disponibles

## Licencia

Proyecto educativo - Libre para usar y modificar.
