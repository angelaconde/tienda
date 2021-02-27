# PRÁCTICA SERVIDOR 2ºDAW

<!-- ![Preview](https://github.com/angelaconde/tienda/blob/master/doc/preview.png) -->

## HECHO:

- Mostrar productos
    - Destacados en página inicio
    - Lista de categorias
    - Paginación
- Carrito de la compra
    - Añadir y consultar lista de productos en carrito
    - Eliminar y vaciar producto del carrito
- Usuarios
    - Registro
    - Modificación de datos
    - Baja
    - Restablecer contraseña utilizando el correo
- Proceso de venta (creación de pedido)
    - Mostrar resumen de la lista de productos que forman parte del pedido antes de confirmar la compra
    - Envío por correo del detalle anterior con una presentación apropiada
    - Envío por correo del fichero PDF con los detalles
- Pedidos
    - Mostrar pedidos realizados
    - Anular pedido, sólo si aun no se ha enviado
    - Permitir mostrar información del pedido y albarán/factura de un pedido seleccionado en PDF
- Pruebas
    - Validar que todas las rutas creadas están operativas y funcionan
    - Validar alguno de los formularios
- Generar servicios REST
    - Servicio Rest que devuelva la lista de artículos que tiene la tienda en portada
    - Servicio rest que permita realizar operaciones CRUD en las categorías
- Consumir servicios REST
    - Servicio de geolocalización
- Validar el usuario utilizando los servicios de terceros
    - Validación de usuario mediante Google
- Pago de productos con tarjeta
    - Pago con tarjeta mediante PayPal
- Exportación de datos en formato de hoja de cálculo
    - Exporta la lista de artículos en una hoja de Excel
    - Exportar la lista de categorias en una hoja de Excel
    - Exportar la lista de pedidos y la información del detalle de pedido en una hoja de Excel

## SIN HACER:
- Soporte para múltiples monedas
- Importación y exportación en XML
- Utilización de Ajax con JSON o XML
- Utilización de paquetes que facilitan creación de paneles de administración en otra aplicación

## PAQUETES DE TERCEROS UTILIZADOS:
- Laravel Shopping Cart: https://github.com/darryldecode/laravelshoppingcart
- Laravel PayPal: https://github.com/srmklive/laravel-paypal
- Laravel DOMPDF: https://github.com/barryvdh/laravel-dompdf
- Laravel EXCEL: https://github.com/Maatwebsite/Laravel-Excel