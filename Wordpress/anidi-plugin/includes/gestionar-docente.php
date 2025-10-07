<?php

/* Archivo: includes/gestionar-docente.php */

function anidi_pagina_gestionar_docente() {
    global $wpdb;
    $tabla_docente = $wpdb->prefix . 'docente';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modificar_docente'])) {
        $nif_docente = sanitize_text_field($_POST['nif_docente']);
        $nombre_docente = sanitize_text_field($_POST['nombre_docente']);
        $salario = floatval($_POST['salario']);
        $fecha_ingreso = sanitize_text_field($_POST['fecha_ingreso']);

        $wpdb->update(
            $tabla_docente,
            array(
                'nombre_docente' => $nombre_docente,
                'salario' => $salario,
                'fecha_ingreso' => $fecha_ingreso
            ),
            array('nif_docente' => $nif_docente)
        );

        echo '<div class="notice notice-success is-dismissible"><p>Registro modificado</p></div>';
    }

    $docentes = $wpdb->get_results("SELECT * FROM $tabla_docente");
    ?>
    <div class="wrap">
        <h1>Gestión Docente</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>NIF Docente</th>
                    <th>Nombre Docente</th>
                    <th>Salario</th>
                    <th>Fecha de Ingreso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docentes as $docente): ?>
                <tr>
                    <td><?php echo $docente->nif_docente; ?></td>
                    <td><?php echo $docente->nombre_docente; ?></td>
                    <td><?php echo $docente->salario; ?></td>
                    <td><?php echo $docente->fecha_ingreso; ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="nif_docente" value="<?php echo $docente->nif_docente; ?>">
                            <input type="text" name="nombre_docente" value="<?php echo $docente->nombre_docente; ?>">
                            <input type="number" step="0.01" name="salario" value="<?php echo $docente->salario; ?>">
                            <input type="date" name="fecha_ingreso" value="<?php echo $docente->fecha_ingreso; ?>">
                            <input type="submit" name="modificar_docente" class="button button-primary" value="Modificar">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}