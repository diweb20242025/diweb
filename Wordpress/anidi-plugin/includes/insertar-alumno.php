<?php
/* Archivo: includes/insertar-alumno.php */


function anidi_pagina_insertar_alumno() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        global $wpdb;
        $tabla_alumno = $wpdb->prefix . 'alumno';

        $nif_alumno = sanitize_text_field($_POST['nif_alumno']);
        $nombre_alumno = sanitize_text_field($_POST['nombre_alumno']);
        $edad = intval($_POST['edad']);
        $sexo = isset($_POST['sexo']) ? 1 : 0;
        $nif_docente = sanitize_text_field($_POST['nif_docente']);

        $wpdb->insert(
            $tabla_alumno,
            array(
                'nif_alumno' => $nif_alumno,
                'nombre_alumno' => $nombre_alumno,
                'edad' => $edad,
                'sexo' => $sexo,
                'nif_docente' => $nif_docente
            )
        );

        echo '<div class="notice notice-success is-dismissible"><p>Alumno añadido</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Insertar Alumno</h1>
        <form method="post" action="">
            <label for="nif_alumno">NIF Alumno:</label>
            <input type="text" name="nif_alumno" required><br>
            <label for="nombre_alumno">Nombre Alumno:</label>
            <input type="text" name="nombre_alumno" required><br>
            <label for="edad">Edad:</label>
            <input type="number" name="edad" required><br>
            <label for="sexo">Sexo:</label>
            <input type="checkbox" name="sexo" value="1"> Masculino<br>
            <label for="nif_docente">NIF Docente:</label>
            <input type="text" name="nif_docente" required><br>
            <input type="submit" class="button button-primary" value="Insertar Alumno">
        </form>
    </div>
    <?php
}