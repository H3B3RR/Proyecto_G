// Función para hacer peticiones AJAX
async function peticionAjax(url, datos = null, metodo = 'GET') {
    try {
        const opciones = {
            method: metodo,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            }
        };
        
        if (metodo !== 'GET' && datos) {
            opciones.body = new URLSearchParams(datos).toString();
        }
        
        const respuesta = await fetch(url, opciones);
        if (!respuesta.ok) {
            throw new Error(`Error HTTP: ${respuesta.status}`);
        }
        
        return await respuesta.json();
    } catch (error) {
        console.error('Error:', error);
        mostrarAlerta('Error en la solicitud', 'error');
        return null;
    }
}

// Mostrar/Ocultar modal
function abrirModal(idModal) {
    document.getElementById(idModal).classList.add('active');
}

function cerrarModal(idModal) {
    document.getElementById(idModal).classList.remove('active');
}

// Cerrar modal al hacer clic fuera
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('active');
        }
    });
});

// Mostrar alertas
function mostrarAlerta(mensaje, tipo = 'success') {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo}`;
    alerta.textContent = mensaje;
    
    const contenedor = document.querySelector('.main-content') || document.body;
    contenedor.insertBefore(alerta, contenedor.firstChild);
    
    setTimeout(() => alerta.remove(), 4000);
}

// Cargar productos
async function cargarProductos(filtros = {}) {
    let url = 'php/api_productos.php?accion=listar';
    
    if (filtros.categoria) url += `&categoria=${filtros.categoria}`;
    if (filtros.buscar) url += `&buscar=${encodeURIComponent(filtros.buscar)}`;
    
    const productos = await peticionAjax(url);
    
    if (!productos || productos.error) {
        mostrarAlerta('Error al cargar productos', 'error');
        return;
    }
    
    const contenedor = document.getElementById('productos-contenedor');
    if (!contenedor) return;
    
    if (productos.length === 0) {
        contenedor.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: #999;">No hay productos disponibles</p>';
        return;
    }
    
    contenedor.innerHTML = productos.map(p => `
        <div class="producto-card">
            <div class="producto-imagen">
                <img src="${p.imagen || 'https://via.placeholder.com/250x200?text=Sin+Imagen'}" alt="${p.nombre}">
            </div>
            <div class="producto-info">
                <div class="producto-nombre">${p.nombre}</div>
                <div class="producto-codigo">Código: ${p.codigo}</div>
                <div class="producto-precio">$${parseFloat(p.precio).toFixed(2)}</div>
                <div class="producto-cantidad">Stock: <strong>${p.cantidad}</strong></div>
                <button class="btn btn-sm btn-primary" onclick="editarProducto(${p.id})">Editar</button>
            </div>
        </div>
    `).join('');
}

// Editar producto
async function editarProducto(id) {
    const producto = await peticionAjax(`php/api_productos.php?accion=obtener&id=${id}`);
    
    if (!producto || producto.error) {
        mostrarAlerta('Error al cargar el producto', 'error');
        return;
    }
    
    document.getElementById('producto-id').value = producto.id;
    document.getElementById('producto-nombre').value = producto.nombre;
    document.getElementById('producto-codigo').value = producto.codigo;
    document.getElementById('producto-categoria').value = producto.categoria_id;
    document.getElementById('producto-precio').value = producto.precio;
    document.getElementById('producto-cantidad').value = producto.cantidad;
    document.getElementById('producto-cantidad-minima').value = producto.cantidad_minima;
    document.getElementById('producto-descripcion').value = producto.descripcion;
    
    abrirModal('modalProducto');
}

// Guardar producto
async function guardarProducto(e) {
    e.preventDefault();
    
    const formData = new FormData(document.getElementById('formularioProducto'));
    const datos = Object.fromEntries(formData);
    
    const respuesta = await peticionAjax('php/api_productos.php?accion=guardar', datos, 'POST');
    
    if (respuesta && respuesta.exito) {
        mostrarAlerta(datos.id ? 'Producto actualizado correctamente' : 'Producto guardado correctamente', 'success');
        cerrarModal('modalProducto');
        document.getElementById('formularioProducto').reset();
        cargarProductos();
    } else {
        mostrarAlerta('Error al guardar el producto', 'error');
    }
}

// Eliminar producto
async function eliminarProducto(id) {
    if (!confirm('¿Está seguro de que desea eliminar este producto?')) return;
    
    const respuesta = await peticionAjax(`php/api_productos.php?accion=eliminar&id=${id}`);
    
    if (respuesta && respuesta.exito) {
        mostrarAlerta('Producto eliminado correctamente', 'success');
        cargarProductos();
    } else {
        mostrarAlerta('Error al eliminar el producto', 'error');
    }
}

// Buscar y filtrar
function configurarBusqueda() {
    const buscar = document.getElementById('buscar-producto');
    const filtroCategoria = document.getElementById('filtro-categoria');
    
    if (buscar) {
        buscar.addEventListener('keyup', () => {
            cargarProductos({
                buscar: buscar.value,
                categoria: filtroCategoria?.value
            });
        });
    }
    
    if (filtroCategoria) {
        filtroCategoria.addEventListener('change', () => {
            cargarProductos({
                buscar: buscar?.value,
                categoria: filtroCategoria.value
            });
        });
    }
}

// Inicializar al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    cargarProductos();
    configurarBusqueda();
});
