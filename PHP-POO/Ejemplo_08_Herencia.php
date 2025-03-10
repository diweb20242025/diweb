<?php      // PHP-POO/Ejemplo_08_Herencia.php
require("errores.php");
/*  - Herencia: mecanismo para heredar atributos y métodos -> Pág 103 Manual
        - Se emplea extends dentro de la clase
        - En los métodos, para agregar elementos: parent::  */
class Camion        // Esta será la clase PADRE
{
    public string $modelo = "";         
    public int $potencia = 0;           
    private float $precio = 0.0;         
    public bool $electrico = true;     
    public function __construct(
        string $modelo, int $potencia, float $precio, bool $electrico)
    {
        $this->modelo = $modelo;
        $this->potencia = $potencia;
        $this->setPrecio($precio);     
        $this->electrico = $electrico;
    }

    public function __toString(): string   
    {   return json_encode([
            'Modelo Camión' => $this->modelo,
            'Potencia' => $this->potencia,
            'Precio' => $this->precio,
            'Eléctrico' => $this->electrico ? "Si" : "No"
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function setPrecio (float $precio): void  {
        if($precio > 0) {
            $this->precio = $precio;
        }
    }
    public function getPrecio (): float {
        return $this->precio;
    }
}

// Definimos la clase HIJA con extends (y nombre con camelcase)
class TrenCarretera extends Camion {
    // Atributos (propios)
    public bool $remolque2;

    // El constructor (añadimos datos al padre)
    // bool $remolque2 = true, es un parámetro opcional
    public function __construct( string $modelo, int $potencia, 
        float $precio, bool $electrico, bool $remolque2 = true)
    {
        parent::__construct($modelo, $potencia, $precio, $electrico);
        $this->remolque2 = $remolque2;
    }

    // Igual con el toString
    public function __toString(): string
    {
        // json_decode: JSON -> string (array)
        $miJSON = json_decode(parent::__toString(), true);
        // Al string le añado otra línea
        $miJSON['Tiene 2ºRemolque?'] = $this->remolque2? "Si" : "No";
        // Vuelvo a convertir el resultado (string) en JSON
        return json_encode($miJSON,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
    }
}

// Script principal
$mensaje = "Mensajes";
if (isset($_REQUEST['enviar'])) {
    $modelo = $_REQUEST['texto'];
    $potencia = $_REQUEST['entero'];
    $precio = $_REQUEST['decimal'];
    $electrico = $_REQUEST['booleano'];

    $MiCamion = new Camion($modelo, $potencia, $precio, $electrico);
    $mensaje = $MiCamion;   // clase padre
    // $miTren = new TrenCarretera($modelo, $potencia, $precio, $electrico);
    $miTren = new TrenCarretera($modelo, $potencia, $precio, $electrico, false);
    $mensaje .= "<br> Mi tren! <br>" .  $miTren;
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
        <pre class="alert alert-success"><?php echo html_entity_decode($mensaje); ?></pre>
    </section>
    <section class="m-3 p-3 w-50 bg-secondary text-white">
        <form action="#" method="post">
            <nav class="d-flex mb-3">
                <label for="texto" class="w-50">Modelo</label>
                <input type="text" name="texto" id="texto" class="w-50">
            </nav>
            <nav class="d-flex mb-3">
                <label for="entero" class="w-50">Potencia</label>
                <input type="number" name="entero" id="entero" class="w-50">
            </nav>
            <nav class="d-flex mb-3">
                <label for="decimal" class="w-50">Precio</label>
                <input type="number" name="decimal" id="decimal" 
                    step="0.1" class="w-50">
            </nav>
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