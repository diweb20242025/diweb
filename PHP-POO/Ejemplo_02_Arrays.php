<?php   // PHP-POO/Ejemplo_02_Arrays.php
/* Arrays Unidimensionales -> Vectores */
// Los tipos dentro del array pueden ser variados
# Array en formato clásico: array()
$frutas = array("Peras", "Fresas", "Kiwis");
$mensaje = "";
// Recorremos array con foreach
// $variable = array; $key = indice; $value = elemento
foreach ($frutas as $indice => $fruta) {
    $mensaje .= "$fruta <br>";
}
# Array formato moderno, con []
$elementos = ["Camion", true, 12, 3.1416];
$mensaje .= "Array moderno <br>";
$elementos[0] = "Coche";
$elementos[] = 5000;    # Añadimos un elemento al array
# array_splice sirve para quitar/poner elementos al array
# Ponemos entre el 12 (2) y el 3.1416 (3) el elemento "Moto"
array_splice($elementos, 2, 0, "Moto");
foreach ($elementos as $indice => $elemento) {
    $mensaje .= "[$indice] -> $elemento <br>";
}

# Arrays asociativos
$alumna = [
    "nombre" => "Ana",
    "edad" => 30,
    "aprobada" => true
];
$alumna["edad"] = 31;
$mensaje .= "Array Asociativo <br>";
foreach ($alumna as $campo => $dato) {
    $mensaje .= "[$campo] => $dato <br>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=., initial-scale=1.0">
    <title>Arrays/Vectores PHP</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <section>
        <p class="alert alert-primary m-3 p-3 w-50">
            <?php echo $mensaje; ?></p>
    </section>
    <hr class="m-3 p-1 bg-primary">
</body>
</html>
