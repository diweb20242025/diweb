<?php
/* Archivo: includes/crear-tablas.php */

function anidi_crear_tablas() {
    global $wpdb;

    $tabla_docente = $wpdb->prefix . 'docente';
    $tabla_alumno = $wpdb->prefix . 'alumno';

    $charset_collate = $wpdb->get_charset_collate();

    $sql_docente = "CREATE TABLE $tabla_docente (
        nif_docente CHAR(9) NOT NULL,
        nombre_docente VARCHAR(50) NOT NULL,
        salario DECIMAL(10,2) NOT NULL,
        fecha_ingreso DATE NOT NULL,
        PRIMARY KEY (nif_docente)
    ) $charset_collate;";

    $sql_alumno = "CREATE TABLE $tabla_alumno (
        nif_alumno CHAR(9) NOT NULL,
        nombre_alumno VARCHAR(50) NOT NULL,
        edad INT NOT NULL,
        sexo BOOLEAN NOT NULL,
        nif_docente CHAR(9) NOT NULL,
        PRIMARY KEY (nif_alumno),
        FOREIGN KEY (nif_docente) REFERENCES $tabla_docente(nif_docente)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_docente);
    dbDelta($sql_alumno);
}

register_activation_hook(__FILE__, 'anidi_crear_tablas');