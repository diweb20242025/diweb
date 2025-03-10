<?php       // PHP-POO/Ejemplo_07_EncapsulamientoTipado.php
require("errores.php");
/*  - Encapsulamiento: oculta atributos y métodos -> Página 84 Manual
        - Se emplea public | protected | private
        - protected -> Visible sólo para descendientes
        - private -> visible sólo para la propia clase
    - Tipado: Definir tipos de datos para entrada|salida    */
class Camion
{
    // Tipamos las entradas de atributos: string | int | float | bool
    // Definimos un atributo como PRIVADO (por ej: precio)
    public string $modelo = "";         // Cadena Caracteres (string)
    public int $potencia = 0;           // Entero (int)
    private float $precio = 0.0;         // Decimal (float)
    public bool $electrico = true;      // Booleano (boolean)

    // En el constructor tipamos las entradas y usamos el setter
    public function __construct(
        string $modelo, int $potencia, float $precio, bool $electrico)
    {
        $this->modelo = $modelo;
        $this->potencia = $potencia;
        $this->setPrecio($precio);      // Usamos el setter
        $this->electrico = $electrico;
    }

    // Método toString: tipamos la salida (:string)
    public function __toString(): string    // pub...fun...__to
    {   return json_encode([
            'Modelo Camión' => $this->modelo,
            'Potencia' => $this->potencia,
            'Precio' => $this->precio,
            'Eléctrico' => $this->electrico ? "Si" : "No"
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    // Al atributo privado (precio) le definimos el set/get
    // El setter es public y la salida es :void (sin salida)
    public function setPrecio (float $precio): void  {
        if($precio > 0) {
            $this->precio = $precio;
        }
    }
    // El getter es public y la salida es :tipo (aquí, float)
    public function getPrecio (): float {
        return $this->precio;
    }
}
$mensaje = "Mensajes";
if (isset($_REQUEST['enviar'])) {
    $modelo = $_REQUEST['texto'];
    $potencia = $_REQUEST['entero'];
    $precio = $_REQUEST['decimal'];
    $electrico = $_REQUEST['booleano'];
    // Creamos el camión
    $MiCamion = new Camion($modelo, $potencia, $precio, $electrico);
    // $MiCamion->precio = -50000;  (ERROR!! NO hay acceso)
    $mensaje = $MiCamion;   // Imprimo el camión
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
        <pre class="alert alert-success"><?php echo $mensaje; ?></pre>
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