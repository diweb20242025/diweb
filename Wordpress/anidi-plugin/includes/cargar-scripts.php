<?php
/* Archivo: includes/cargar-scripts.php */

function anidi_cargar_scripts() {
    // Cargar Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');

    // Cargar FontAwesome
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

    // Cargar estilos personalizados
    wp_enqueue_style('anidi-estilos', plugin_dir_url(__FILE__) . '../assets/estilos.css');
}

add_action('admin_enqueue_scripts', 'anidi_cargar_scripts');