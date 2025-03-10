<?php   
// PHP-POO/Ejemplo_04_EstructurasControl.php
/*  - if...else (si... si no...)
    - switch (si anidado)
    - while (bucle: mientras)
    - for (bucle: para... hasta)
        - Se puede usar para recorrer PARCIALMENTE arrays
    - continue/break (para y reanuda iteración/rompe iteración)
 */

 // Si se envía el formulario
if (isset($_REQUEST['enviar'])) {
    $n1 = $_REQUEST['n1'];
    $n2 = $_REQUEST['n2'];
    // Inicializo la cadena de caracteres
    $mensaje = "";

    // Ambos números deben ser positivos y n2 >= n1
    // En caso contrario, poner mensaje...
    if ($n1 <= 0 || $n2 <= 0) {
        $n1 = abs($n1);     # abs -> Valor absoluto
        $n2 = abs($n2);     # Ej: abs(5) -> 5; abs(-5) -> 5
    }

    // Hace doble comprobación...
    if ($n1 > $n2) {
        $mensaje = "ERROR en datos de entrada <br>";
        $aux = $n2;
        $n2 = $n1;
        $n1 = $aux;
        // si son iguales los números
    } else if ($n1 == $n2) {
        $mensaje = "Ambos datos son iguales <br>";
    } else {
        $mensaje = "Datos de entrada NORMALIZADOS! <br>";
    }

    // Bucle while para ir de $n1 a $n2
    $contador = $n1;
    while ($contador <= $n2) {
        $mensaje .= "$contador <br>";
        $contador++;    // $contador = $contador +1;
    }

    // Bucle for -> $contador -> $i (indice)
    // Lo mismo de arriba pero con el for...
    $mensaje .= "Lo mismo con for <br>";
    for ($i = $n1; $i <= $n2 ; $i++) { 
        $mensaje .= "$i <br>";
    }

    
    // El bucle for se puede usar para recorrer vectores
    $vector = [1,4,2,2,3,4,2,1];
    // Vamos a sacar coordenadas X (filas) -> Desde 0, indices pares
    // Longitud del array => count($vector)
    $longitud = count($vector);     // = 8 (elementos)
    $mensaje .= "Coordenadas X <br>";
    for ($i=0; $i < $longitud; $i+=2) {     // $i+=2 => $i = $i+2
        $mensaje .= "$vector[$i] <br>";
    }
    // Vamos a sacar coordenadas Y (columnas) -> Desde 1, indices impares
    $mensaje .= "Coordenadas Y <br>";
    for ($i=1; $i < $longitud; $i+=2) { 
        $mensaje .= "$vector[$i] <br>";
    }
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
    <form action="#" method="post" class="form m-3 p-3 w-50">
        <label for="n1" class="form-label">Num1</label>
        <input type="number" name="n1" id="n1"
            class="form-control"><br>
        <label for="n2" class="form-label">Num2</label>
        <input type="number" name="n2" id="n2"
            class="form-control"><br>
        <input type="submit" value="Enviar" class="btn btn-success" name="enviar">
    </form>
</body>

</html>