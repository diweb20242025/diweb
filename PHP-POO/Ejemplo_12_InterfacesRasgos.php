<?php    // PHP-POO/Ejemplo_12_InterfacesRasgos.php
require("errores.php");

/*  - Clases (atributos y métodos)
    - Encapsulamiento (private/protected + setter/getter) 
    - Herencia (extends)
    - Estáticos (atributos/métodos static) 
    - Abstractas (clases/Métodos abstractos)
    - Composición (Una clase que contiene otra clase)
    - Namespaces (espacios de nombres -> use) 
    - Interfaces (interface -> conjunto de métodos abstractos) 
    - Rasgos (traits -> Intefaces desarrollados) */

// Las Interfaces y los Rasgos se ponen ANTES que las clases
// Una interfaz es una colección de métodos ABSTRACTOS (sin desarrollo)
interface iFlota {      // añadir métodos de interfaces -> implements
    public static function leeTren(
        string $modelo, int $potencia, 
        float $precio, bool $electrico, bool $remolque2
    ) : TrenCarretera;
    public static function crearFlota(
        string $modelo, int $potencia, float $precio, int $numTrenes
    ): string;
}

// Paso1: Traits (Rasgos) -> Interfaz con métodos DESARROLLADOS!
// Los traits solo se emplean en PHP. Hay algo similar en Python
trait tBonito {     // Para añadir métodos de traits -> use
    public static function saludo(): string {
        return "Fin del programa!";
    }
    // Gentileza de ChatGPT
    public static function mostrarNumTrenes() : string {
        return "<br> Nº Trenes Carretera: " . TrenCarretera::$numTrenes;
    }
    // Podemos usar funciones en el trait que impliquen cambios
    // En los atributos. Pero dependerán de la clase, OJO!
    public function descuento(int $porcentaje): void {
        $nuevoPrecio = $this->getPrecio() * $porcentaje / 100;
        $this->setPrecio($this->getPrecio() -$nuevoPrecio);
    }
}

// Esta será la clase PADRE (abstracta)
abstract class Camion        
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

    // Declaro un método abstracto
    abstract public static function leeTren(
        string $modelo, int $potencia, 
        float $precio, bool $electrico, bool $remolque2
    ) : TrenCarretera;
}

// La clase composición (Motor)
class Motor {
    public string $marca;
    public int $cilindrada;

    // Constructor definido completo (sin parámetros opcionales)
    public function __construct(string $marca, int $cilindrada)
    {
        $this->marca = $marca;
        $this->cilindrada = $cilindrada;
    }

    // El método toString
    public function __toString(): string   
    {   return json_encode([
            'Marca' => $this->marca,
            'Cilindrada' => $this->cilindrada
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

// Definimos la clase HIJA con extends (y nombre con camelcase)
class TrenCarretera extends Camion implements iFlota {
    // Paso 2: Añadimos el trait
    // OJO! Se añaden TODOS los métodos del trait
    use tBonito;

    // Atributos (propios)
    // Añado el atributo de composición
    public Motor $motorTren;

    // Y el resto de atributos...
    public bool $remolque2;
    public static int $numTrenes = 0;   // Atributo estático
    

    // El constructor (añadimos datos al padre)
    // bool $remolque2 = true, es un parámetro opcional
    public function __construct( string $modelo, int $potencia, 
        float $precio, bool $electrico, bool $remolque2 = true)
    {
        parent::__construct($modelo, $potencia, $precio, $electrico);
        $this->remolque2 = $remolque2;
        
        // El atributo estático se usa con self::
        self::$numTrenes ++;    // Al crear 1 tren, sumo1
        $this->motorTren = new Motor("Volvo", 3000);
    }

    // Igual con el toString
    public function __toString(): string
    {
        // json_decode: JSON -> string (array)
        $miJSON = json_decode(parent::__toString(), true);

        // Al string le añado otra línea
        $miJSON['Tiene 2ºRemolque?'] = $this->remolque2? "Si" : "No";
        $miJSON['Motor'] = json_decode($this->motorTren);
        // Vuelvo a convertir el resultado (string) en JSON
        return json_encode($miJSON,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
    }

    // Creamos un método estático (static)
    // Esté metodo hay que IMPLEMENTARLO (es decir, {...})
    // Si no se hace, la clase hija SERÁ ABSTRACTA como el padre
    public static function leeTren(
        string $modelo, int $potencia, 
        float $precio, bool $electrico, bool $remolque2
    ) : TrenCarretera {
        return new TrenCarretera(
            $modelo, $potencia,$precio, $electrico, $remolque2);
    }


    // Otro método estático. Incluye arrays!
    public static function crearFlota(
        string $modelo, int $potencia, float $precio, int $numTrenes
    ): string {
        $flota = [];    // Array vacío

        // Creo N trenes, eso si, TODOS IGUALES!
        for ($i=0; $i < $numTrenes; $i++) { 
            $nuevoTren = TrenCarretera::leeTren($modelo, 
                $potencia, $precio, true, true);
            $nuevoTren->descuento(10);    
            $flota[] = $nuevoTren;
        }
        // Devuelvo el string con el JSON de TODOS los trenes
        $mensaje = "";
        foreach ($flota as $num => $tren) {
            $mensaje .= "<br>Tren Nº" . ($num+1). "<br> $tren";
        }
        return $mensaje;
    }
}

// Script principal
$mensaje = "Mensajes";
if (isset($_REQUEST['enviar'])) {
    $modelo = $_REQUEST['texto'];
    $potencia = $_REQUEST['entero'];
    $precio = $_REQUEST['decimal'];
    $electrico = $_REQUEST['booleano'];

    // NO SE PUEDE CREAR OBJETOS (instanciar) de clases abstractas!!
    // $MiCamion = new Camion($modelo, $potencia, $precio, $electrico);
    // $mensaje = $MiCamion;   // clase padre

    $miTren = new TrenCarretera($modelo, $potencia, $precio, $electrico, false);
    $mensaje = "<br> Mi tren! <br>" .  $miTren;

    // Aquí usamos el método estático
    $miTren2 = TrenCarretera::leeTren("Mercedes", 
        $potencia, $precio, $electrico, true);
    $mensaje .= "<br> Mi tren2! <br>" .  $miTren2;

    $miTrenX = new TrenCarretera($modelo, 750, $precio, true, true);
    $mensaje .= "<br> Mi trenX! <br>" .  $miTrenX;
    
    $mensaje .= "<br> Nº Trenes: " . TrenCarretera::$numTrenes;
    $mensaje .= "<br> Modelo Tren2: " . $miTren2->modelo;

    // Vamos a crearnos una flota de Trenes de Carretera
    $flota = TrenCarretera::crearFlota("Volvo FH Electric", 
        $potencia, 450000.95, 5);
    $mensaje .= "<br> Mi FLOTA!: <br> $flota";
    $mensaje .= TrenCarretera::mostrarNumTrenes();

    // Paso 3: Usamos el método del trait
    $mensaje .= "<br> " . TrenCarretera::saludo();
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