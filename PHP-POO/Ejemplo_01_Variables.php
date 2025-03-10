<?php   // PHP-POO/Ejemplo_01_Variables.php
/* Si solo hay PHP, NO CERRAR PHP!! 
  localhost/Curso/PHP-POO/Ejemplo_01_Variables.php */
# Tipos de variables (Primitivos): 
# Números (enteros/flotantes), booleanos, cadenas caracteres (string)
# No primitivos: arrays y objetos
if (isset($_REQUEST['enviar'])) {   # $_REQUEST -> Variable predefinida
    $n1 = $_REQUEST['n1'];
    $n2 = $_REQUEST['n2'];
    $resultado = $n1 + $n2; # Operador suma
    $mensaje = "La suma es $resultado";
    // Esto es una constante 
    define('PI', 3.1416);
    $resultado = $n1 + $n2 * PI;
    // .= Concateno el mensaje anterior a este de abajo
    $mensaje .= "<br> Resultado * 'PI' = $resultado";
    /* Operadores:
    Aritméticos: + , - , * , / , % (módulo), ** (potencia)
    Comparación: >, >=, <, <=, ==, !== (distinto, <>), === (igual estricto) 
    Incremento/Disminución: ++, --, += , -= 
    Concatenación: . , .= 
    Bit a Bit: && (and), || (or), ^ (xor), ~ (not) */
    $resultado = $n1 > $n2;
    if(!$resultado) $resultado = 0;     // Si es false = 0
    $mensaje .= "<br> Comparo $n1 > $n2 -> $resultado ";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=., initial-scale=1.0">
    <title>Variables PHP</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <section>
        <p class="alert alert-primary m-3 p-3 w-50">
            <?php echo $mensaje; ?></p>
    </section>
    <hr class="m-3 p-1 bg-primary">
    <form action="#" method="post" class="form m-3 p-3 w-50">
        <label for="n1" class="form-label">N1</label>
        <input type="number" name="n1" id="n1" class="form-control"><br>
        <label for="n2" class="form-label">N2</label>
        <input type="number" name="n2" id="n2" class="form-control"><br>
        <input type="submit" value="Enviar" class="btn btn-success" name="enviar">
    </form>
</body>
</html>
