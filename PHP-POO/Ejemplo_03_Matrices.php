<?php   // PHP-POO/Ejemplo_03_Matrices.php
/* Arrays Bidimensionales -> Matrices (Formato moderno) */
$matriz = [
    [1,3,7,2,4],          # Fila1, indice = 0
    [3,2,1,0,3],
    [6,2,2,1,6],
    [4,5,8,4,2],          # $matriz[3,2] = 8
    [1,1,1,0,1]
];
// Recogemos los datos del formulario
if(isset($_REQUEST['enviar'])) {
    $fila = $_REQUEST['n1'] -1;
    $columna = $_REQUEST['n2'] -1;
    // Para probarlo: Fila=4 y Columna=3
    $mensaje = "El elemento es: {$matriz[$fila][$columna]}";
}

$mensaje .= "<br> Matriz <br>";
// Para imprimir la matriz (doble foreach)
foreach ($matriz as $fila) {
    foreach ($fila as $columna) {
        $mensaje .= $columna . "\t";
    }
    $mensaje .= "<br>";
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
        <label for="n1" class="form-label">Fila</label>
        <input type="number" name="n1" id="n1" 
        class="form-control" min="1" max="5"><br>
        <label for="n2" class="form-label">Columna</label>
        <input type="number" name="n2" id="n2" 
        class="form-control" min="1" max="4"><br>
        <input type="submit" value="Enviar" class="btn btn-success" name="enviar">
    </form>
</body>
</html>
