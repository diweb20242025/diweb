<?php
// IMPORTANTE: Añadir esto para depurar
require("errores.php");

// Archivo: /var/www/html/Curso/PHP-POO/Ejemplo_06_Clases.php
// Navegador: localhost/Curso/PHP-POO/Ejemplo_06_Clases.php

/* Clase -> Plantilla/Molde con Atributos y métodos
    Constructor -> Método que crea el objeto (new)
    Destructor -> Método que elimina el objeto
    Las clases se ponen al INICIO del archivo. 
 */

// Declaración de la clase -> Página 70 Manual
class Camion {
    // Atributos. Añadimos visibilidad -> public
    public $modelo = "";        // Cadena Caracteres (string)
    public $potencia = 0;       // Entero (int)
    public $precio = 0.0;       // Decimal (float)
    public $electrico = true;   // Booleano (boolean)

    // Constructor DEFINIDO COMPLETO (todos los parámetros)
    public function __construct($modelo, $potencia, $precio, $electrico) {
        $this->modelo = $modelo;
        $this->potencia = $potencia;
        $this->precio = $precio;
        $this->electrico = $electrico;
    }

    // Método toString -> Imprime el objeto -> Página 82 Manual
    public function __toString()    // pub...fun...__to
    {   // El objeto lo codificamos (encode) en formato JSON
        // texto -> JSON (encode); JSON -> texto (decode)
        return json_encode([
            'Modelo Camión'     => $this->modelo,
            'Potencia'          => $this->potencia,
            'Precio'            => $this->precio,
            'Eléctrico'         => $this->electrico? "Si" : "No"
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

// Script principal
$mensaje = "Mensajes";

if(isset($_REQUEST['enviar'])) {
    $modelo = $_REQUEST['texto'];
    $potencia = $_REQUEST['entero'];
    $precio = $_REQUEST['decimal'];
    $electrico = $_REQUEST['booleano'];

    // Creamos el camión
    $MiCamion = new Camion($modelo,$potencia, $precio, $electrico);
    // Imprimo el camión
    $mensaje = $MiCamion;
}   
 ?>

 <!DOCTYPE html>
 <html lang="es">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-POO: Clases </title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="all.min.css"> <!-- FontAwesome -->
 </head>
 <body>
    <section class="m-3 p-3 w-50 bg-primary">
        <p class="alert alert-success"><?php echo $mensaje; ?></p>
    </section>
    <section class="m-3 p-3 w-50 bg-secondary">
        <form action="#" method="post">
            <label for="texto">Modelo</label>
            <input type="text" name="texto" id="texto"><br>
            <label for="entero">Potencia</label>
            <input type="number" name="entero" id="entero"><br>
            <label for="decimal">Precio</label>
            <input type="number" name="decimal" id="decimal" step="0.1"><br>
            
            <hr class="m-3 p-1 bg-danger">
            <p>¿Es eléctrico?</p>
            <nav class="form-check">
                <input type="radio" name="booleano" id="1" 
                    class="form-check-input" value="1" checked>
                <label for="1" class="form-check-label">Si</label>
            </nav>
            <nav class="form-check">
                <input type="radio" name="booleano" id="0" 
                    class="form-check-input" value="0">
                <label for="0" class="form-check-label">No</label>
            </nav>
            <hr class="m-3 p-1 bg-danger">
            <input type="submit" value="Enviar" name="enviar">
        </form>
    </section>   
 </body>
 </html>
