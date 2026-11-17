<?php
/**
 * Plugin Name:       pedcat-utilidades
 * Description:       Funcionalidades propias del blog Implantación de Aplicaciones Web: caja de contacto al final de las entradas, código corto [anio], ocultación de la versión de WordPress y pantalla de acceso personalizada.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      8.0
 * Author:            Pedro Catalán Catalán
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pedcat-utilidades
 */

// Protección contra el acceso directo: si el fichero no lo carga WordPress, se detiene.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Petición 3: caja «¿Te ha gustado?» al final de cada entrada (no en las páginas).
 */
function pedcat_caja_contacto( $content ) {
	// Solo en entradas individuales y en el contenido principal de la página.
	if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}

	// URL real de la página Contacto, sea cual sea la estructura de enlaces.
	$contacto = get_page_by_path( 'contacto' );
	$url      = $contacto ? get_permalink( $contacto ) : home_url( '/contacto/' );

	$caja  = '<div class="pedcat-caja-contacto">';
	$caja .= '<p>¿Te ha gustado? <a href="' . esc_url( $url ) . '">Escríbeme desde Contacto</a></p>';
	$caja .= '</div>';

	return $content . $caja;
}
add_filter( 'the_content', 'pedcat_caja_contacto' );


/**
 * Petición 4: código corto [anio] que muestra el año actual.
 */
function pedcat_shortcode_anio() {
	return esc_html( wp_date( 'Y' ) );
}
add_shortcode( 'anio', 'pedcat_shortcode_anio' );


/**
 * Petición 5: quitar la versión de WordPress del <head> de las páginas.
 */
function pedcat_quitar_version() {
	remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'pedcat_quitar_version' );


/**
 * Petición 6: pantalla de acceso propia.
 */

// El logotipo enlaza a la portada del blog, en lugar de a wordpress.org.
function pedcat_login_url_logo() {
	return home_url( '/' );
}
add_filter( 'login_headerurl', 'pedcat_login_url_logo' );

// El texto del enlace del logotipo es el nombre del blog.
function pedcat_login_texto_logo() {
	return esc_html( get_bloginfo( 'name' ) );
}
add_filter( 'login_headertext', 'pedcat_login_texto_logo' );

// Aviso sobre el formulario: se añade al mensaje que ya hubiera y se devuelve.
function pedcat_login_aviso( $message ) {
	$aviso = 'Acceso restringido al equipo de ' . get_bloginfo( 'name' );
	return $message . '<p class="message">' . esc_html( $aviso ) . '</p>';
}
add_filter( 'login_message', 'pedcat_login_aviso' );

/**
 * Ampliación: quitar la versión también del feed RSS. La petición 5 solo la
 * quitaba de wp_head; el feed la escribe con la_función the_generator.
 */
add_filter( 'the_generator', '__return_empty_string' );
