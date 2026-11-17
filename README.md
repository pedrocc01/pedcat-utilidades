# pedcat-utilidades

Plugin de WordPress con las funcionalidades propias del blog *Implantación de Aplicaciones Web*. Van en un plugin, y no en el tema, para que sigan funcionando aunque se cambie de tema.

## Qué hace

- **Caja de contacto:** añade al final de cada entrada (no en las páginas) el texto «¿Te ha gustado? Escríbeme desde Contacto», enlazado a la página Contacto.
- **Código corto `[anio]`:** muestra el año actual. Se usa en el pie: `© [anio] Pedro Catalán Catalán`.
- **Versión de WordPress oculta:** quita la etiqueta `<meta name="generator">` del `<head>` y la versión del feed RSS.
- **Pantalla de acceso propia:** el logotipo de `/wp-login.php` enlaza a la portada y sobre el formulario aparece el aviso «Acceso restringido al equipo de Implantación de Aplicaciones Web».

## Instalación

1. Copia la carpeta `pedcat-utilidades` en `wp-content/plugins/`.
2. Actívalo en **Plugins › Plugins instalados**.

## Dependencias

- WordPress 6.7 o superior y PHP 8.0 o superior.
- Una página con el slug `contacto`, a la que enlaza la caja.
- Opcional: el tema hijo `pedcat-hijo`, que da estilo a la caja (`.pedcat-caja-contacto`) y usa `[anio]` en el pie.

## Autor

Pedro Catalán Catalán
