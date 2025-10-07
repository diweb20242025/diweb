<?php
/* Archivo: includes/insertar-docente.php */


function anidi_pagina_insertar_docente() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        global $wpdb;
        $tabla_docente = $wpdb->prefix . 'docente';

        $nif_docente = sanitize_text_field($_POST['nif_docente']);
        $nombre_docente = sanitize_text_field($_POST['nombre_docente']);
        $salario = floatval($_POST['salario']);
        $fecha_ingreso = sanitize_text_field($_POST['fecha_ingreso']);

        $wpdb->insert(
            $tabla_docente,
            array(
                'nif_docente' => $nif_docente,
                'nombre_docente' => $nombre_docente,
                'salario' => $salario,
                'fecha_ingreso' => $fecha_ingreso
            )
        );

        echo '<div class="notice notice-success is-dismissible"><p>Docente añadido</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Insertar Docente</h1>
        <form method="post" action="">
            <label for="nif_docente">NIF Docente:</label>
            <input type="text" name="nif_docente" required><br>
            <label for="nombre_docente">Nombre Docente:</label>
            <input type="text" name="nombre_docente" required><br>
            <label for="salario">Salario:</label>
            <input type="number" step="0.01" name="salario" required><br>
            <label for="fecha_ingreso">Fecha de Ingreso:</label>
            <input type="date" name="fecha_ingreso" required><br>
            <input type="submit" class="button button-primary" value="Insertar Docente">
        </form>
    </div>
    <?php
}