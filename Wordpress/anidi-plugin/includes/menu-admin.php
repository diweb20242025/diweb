<?php

/* Archivo: includes/menu.php */

function anidi_menu_admin() {
    add_menu_page(
        'Plugin Anidi',
        'Anidi',
        'manage_options',
        'plugin-anidi',
        'anidi_pagina_crear',
        'dashicons-admin-users',
        6
    );

    add_submenu_page(
        'plugin-anidi',
        'Insertar Docente',
        'Insertar Docente',
        'manage_options',
        'insertar-docente',
        'anidi_pagina_insertar_docente'
    );

    add_submenu_page(
        'plugin-anidi',
        'Insertar Alumno',
        'Insertar Alumno',
        'manage_options',
        'insertar-alumno',
        'anidi_pagina_insertar_alumno'
    );

    add_submenu_page(
        'plugin-anidi',
        'Gestión Docente',
        'Gestión Docente',
        'manage_options',
        'gestionar-docente',
        'anidi_pagina_gestionar_docente'
    );

    add_submenu_page(
        'plugin-anidi',
        'Gestión Alumno',
        'Gestión Alumno',
        'manage_options',
        'gestionar-alumno',
        'anidi_pagina_gestionar_alumno'
    );
}

add_action('admin_menu', 'anidi_menu_admin');



function anidi_pagina_crear() {
    if (isset($_POST['crear_bd'])) {
        anidi_crear_tablas();
        echo '<div class="notice notice-success is-dismissible"><p>BBDD creada</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Crear Anidi</h1>
        <p>Instrucciones para crear la base de datos.</p>
        <form method="post" action="">
            <input type="submit" name="crear_bd" class="button button-primary" value="Crear Base de datos">
        </form>
    </div>
    <?php
}