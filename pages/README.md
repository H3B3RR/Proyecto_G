# Sistema de Almacén Web

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
- Servidor web (Apache, Nginx, etc.)

## Instalación

### 1. Crear la Base de Datos

```bash
mysql -u root -p < database/almacen.sql
```

O ejecutar manualmente el SQL en tu cliente MySQL.

### 2. Configurar Conexión

Edita `php/conexion.php` y ajusta:
```php
define('SERVIDOR', 'localhost');
define('USUARIO_DB', 'root');
define('CLAVE_DB', '');
define('BASE_DATOS', 'almacen');
```

### 3. Colocar en tu servidor web

Copia la carpeta `almacen` a:
- **Apache**: `htdocs/`
- **Nginx**: `/var/www/html/`

## Credenciales Iniciales

- **Email**: admin@almacen.com
- **Contraseña**: admin123

## Estructura del Proyecto

```
almacen/
├── css/
│   └── estilos.css          # Estilos principales
├── js/
│   └── funciones.js         # Funciones JavaScript
├── php/
│   ├── conexion.php         # Conexión a BD
│   ├── sesion.php           # Control de sesiones
│   ├── login.php            # Autenticación
│   ├── logout.php           # Cerrar sesión
│   └── api_productos.php    # API de productos
├── database/
│   └── almacen.sql          # Script de BD
├── uploads/                 # Carpeta para imágenes
├── index.php                # Página de login
├── dashboard.php            # Panel principal
├── productos.php            # Gestión de productos
├── movimientos.php          # Registro de movimientos
├── reportes.php             # Reportes del sistema
└── usuarios.php             # Gestión de usuarios
```

## Módulos Principales

### 1. Autenticación
- Login con email y contraseña
- Control de sesiones
- Roles de usuario (Admin/Empleado)

### 2. Dashboard
- Estadísticas generales
- Total de productos
- Unidades en stock
- Ventas del día

### 3. Productos
- Crear nuevos productos
- Editar productos existentes
- Eliminar productos
- Filtrar por categoría
- Buscar productos

### 4. Movimientos
- Registrar entradas
- Registrar salidas
- Registrar ajustes
- Historial de movimientos

### 5. Reportes
- Reporte de inventario
- Reporte de ventas
- Productos con stock bajo
- Historial de movimientos

### 6. Usuarios
- Crear nuevos usuarios
- Editar usuarios
- Cambiar estado (Activo/Inactivo)
- Asignar roles

## Uso

### Acceder al Sistema

1. Abre en tu navegador: `http://localhost/almacen/`
2. Ingresa las credenciales
3. Serás redirigido al dashboard

### Agregar Producto

1. Ve a **Productos**
2. Haz clic en **+ Nuevo Producto**
3. Completa los datos
4. Haz clic en **Guardar**

### Registrar Movimiento

1. Ve a **Movimientos**
2. Haz clic en **+ Nuevo Movimiento**
3. Selecciona producto, tipo y cantidad
4. Haz clic en **Guardar**

## Notas de Desarrollo

- Las contraseñas actualmente se almacenan en texto plano (considera usar `password_hash()` en producción)
- Las imágenes de productos se almacenan en la carpeta `uploads/`
- Los reportes son funcionales en la interfaz pero necesitan lógica backend completa
- El sistema usa sesiones de PHP para autenticación

## Mejoras Futuras

- [ ] Implementar password_hash() para contraseñas
- [ ] Agregar validación de formularios en frontend y backend
- [ ] Implementar carga de imágenes
- [ ] Generar reportes en PDF
- [ ] Agregar gráficos con Chart.js
- [ ] Implementar API REST completa
- [ ] Agregar notificaciones en tiempo real
- [ ] Implementar backup automático de BD

## Soporte

Para reportar errores o sugerencias, contacta al administrador.

## Licencia

Proyecto educativo - Libre para usar y modificar.
