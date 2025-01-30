<?php
/**
 * Plugin Name: Datos Entradas
 * Description: Muestra una lista de publicaciones usando el bucle de WordPress.
 * Version: 1.0
 * Author: Tu Nombre
 * 
 * Plugins imprescindibles:
 * 1️⃣ PHP Intelephense
 * 2️⃣ WordPress Snippets
 * 3️⃣ WordPress Toolbox
 */

if (!defined('ABSPATH')) {
    exit;
}

// Función para generar el bucle personalizado
function datos_entradas_shortcode($atts) {
    ob_start();
    
    $query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => 5,
    ));
    
    if ($query->have_posts()):
        echo '<div class="datos-entradas" style="color: blue;">';
        while ($query->have_posts()): $query->the_post();
            echo '<article class="entrada">';
            echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            if (has_post_thumbnail()) {
                echo '<div class="imagen">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</div>';
            }
            echo '<p class="meta">Por <strong>' . get_the_author() . '</strong> el ' . get_the_time('d/m/Y') . '</p>';
            echo '<div class="extracto">' . get_the_excerpt() . '</div>';
            echo '<p class="categorias">Categorías: ' . get_the_category_list(', ') . '</p>';
            echo '</article>';
        endwhile;
        echo '</div>';
    endif;
    
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('datos_entradas', 'datos_entradas_shortcode');
