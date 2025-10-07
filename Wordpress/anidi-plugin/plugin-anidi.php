<?php
/*
Plugin Name: Anidi Management
Plugin URI: https://developer.wordpress.org/plugins/
Description: Plugin para la gestión de docentes y alumnos en WordPress
Version: 1.0
Author: Iván Rodríguez
Author URI: https://developer.wordpress.org/plugins/
License: GPL2

* Información adicional:
    ** https://developer.wordpress.org/plugins/
    ** Plugins recomendados:
    *** PHP Intelephense
    *** WordPress Snippet
    *** WordPress Hooks
    *** PHP Debug
    *** PHP Debug

*/

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Incluir archivos necesarios
require_once plugin_dir_path(__FILE__) . 'includes/crear-tablas.php';
require_once plugin_dir_path(__FILE__) . 'includes/menu-admin.php';
require_once plugin_dir_path(__FILE__) . 'includes/insertar-docente.php';
require_once plugin_dir_path(__FILE__) . 'includes/insertar-alumno.php';
require_once plugin_dir_path(__FILE__) . 'includes/gestionar-docente.php';
require_once plugin_dir_path(__FILE__) . 'includes/gestionar-alumno.php';
require_once plugin_dir_path(__FILE__) . 'includes/cargar-scripts.php';

function anidi_management_add_settings_page() {
    add_menu_page(
        'Anidi Management', // Título de la página
        'Anidi Management', // Título del menú
        'manage_options',   // Capacidad requerida
        'anidi-management', // Slug del menú
        'anidi_management_settings_page', // Función que renderiza la página
        'dashicons-admin-users', // Icono del menú
        6 // Posición en el menú
    );
}
add_action('admin_menu', 'anidi_management_add_settings_page');

function anidi_management_settings_page() {
    ?>
    <div class="wrap">
        <h1>Anidi Management</h1>
        <p>Plugin para la gestión de docentes y alumnos en WordPress.</p>

        <h2>Información adicional</h2>
        <ul>
            <li><strong>Documentación oficial de WordPress:</strong> <a href="https://developer.wordpress.org/plugins/" target="_blank">https://developer.wordpress.org/plugins/</a></li>
            <li><strong>Plugins recomendados para desarrollo:</strong>
                <ul>
                    <li>PHP Intelephense</li>
                    <li>WordPress Snippet</li>
                    <li>WordPress Hooks</li>
                    <li>PHP Debug</li>
                </ul>
            </li>
        </ul>
    </div>
    <?php
}