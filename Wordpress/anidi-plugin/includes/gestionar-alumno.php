<?php

/* Archivo: includes/gestionar-docente.php */

function anidi_pagina_gestionar_alumno() {
    global $wpdb;
    $tabla_alumno = $wpdb->prefix . 'alumno';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modificar_alumno'])) {
        $nif_alumno = sanitize_text_field($_POST['nif_alumno']);
        $nombre_alumno = sanitize_text_field($_POST['nombre_alumno']);
        $edad = intval($_POST['edad']);
        $sexo = isset($_POST['sexo']) ? 1 : 0;

        $wpdb->update(
            $tabla_alumno,
            array(
                'nombre_alumno' => $nombre_alumno,
                'edad' => $edad,
                'sexo' => $sexo
            ),
            array('nif_alumno' => $nif_alumno)
        );

        echo '<div class="notice notice-success is-dismissible"><p>Registro modificado</p></div>';
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_alumno'])) {
        $nif_alumno = sanitize_text_field($_POST['nif_alumno']);

        $wpdb->delete(
            $tabla_alumno,
            array('nif_alumno' => $nif_alumno)
        );

        echo '<div class="notice notice-success is-dismissible"><p>Alumno eliminado</p></div>';
    }

    $alumnos = $wpdb->get_results("SELECT * FROM $tabla_alumno");
    ?>
    <div class="wrap">
        <h1>Gestión Alumno</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>NIF Alumno</th>
                    <th>Nombre Alumno</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>NIF Docente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $alumno): ?>
                <tr>
                    <td><?php echo $alumno->nif_alumno; ?></td>
                    <td><?php echo $alumno->nombre_alumno; ?></td>
                    <td><?php echo $alumno->edad; ?></td>
                    <td><?php echo $alumno->sexo ? 'Masculino' : 'Femenino'; ?></td>
                    <td><?php echo $alumno->nif_docente; ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="nif_alumno" value="<?php echo $alumno->nif_alumno; ?>">
                            <input type="text" name="nombre_alumno" value="<?php echo $alumno->nombre_alumno; ?>">
                            <input type="number" name="edad" value="<?php echo $alumno->edad; ?>">
                            <input type="checkbox" name="sexo" value="1" <?php echo $alumno->sexo ? 'checked' : ''; ?>> Masculino<br>
                            <input type="submit" name="modificar_alumno" class="button button-primary" value="Modificar">
                        </form>
                        <form method="post" action="">
                            <input type="hidden" name="nif_alumno" value="<?php echo $alumno->nif_alumno; ?>">
                            <input type="submit" name="eliminar_alumno" class="button button-secondary" value="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar a <?php echo $alumno->nombre_alumno; ?>?');">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}