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

## Descargar el Proyecto

### Opción 1: Clonar el repositorio (Recomendado)

```bash
git clone https://github.com/H3B3RR/Proyecto_G.git
cd Proyecto_G
```

### Opción 2: Descargar como ZIP

1. Ve a: https://github.com/H3B3RR/Proyecto_G
2. Haz clic en **Code** → **Download ZIP**
3. Descomprime la carpeta

## Configuración Inicial Después de Descargar

1. Copia la carpeta a tu servidor web (htdocs o /var/www/html)
2. Crea la base de datos:
   ```bash
   mysql -u root -p < database/almacen.sql
   ```
3. Edita `php/conexion.php` con tus credenciales MySQL
4. Accede a `http://localhost/Proyecto_G/`

## Hacer Push (Subir cambios a GitHub)

### Si ya clonaste el proyecto:

1. **Realiza cambios** en los archivos
2. **Verifica el estado**:
   ```bash
   git status
   ```
3. **Agrega los cambios**:
   ```bash
   git add .
   ```
4. **Crea un commit**:
   ```bash
   git commit -m "Descripción de los cambios"
   ```
5. **Sube a GitHub**:
   ```bash
   git push origin main
   ```

### Ejemplo de cambios comunes:

```bash
# Agregar nueva funcionalidad
git add .
git commit -m "Agregar nueva funcionalidad de reportes PDF"
git push origin main

# Corregir bugs
git add .
git commit -m "Corregir error en validación de productos"
git push origin main

# Actualizar documentación
git add README.md
git commit -m "Actualizar instrucciones de instalación"
git push origin main
```

## Crear tu propia rama

Si quieres trabajar en una rama separada:

```bash
# Crear rama
git checkout -b mi-rama

# Hacer cambios y commits
git add .
git commit -m "Descripción de cambios"

# Subir la rama
git push origin mi-rama

# Hacer Pull Request en GitHub
```

## Descargar cambios de GitHub

Si otros han subido cambios y quieres descargarlos:

```bash
git pull origin main
```

## Licencia

Proyecto educativo - Libre para usar y modificar.
