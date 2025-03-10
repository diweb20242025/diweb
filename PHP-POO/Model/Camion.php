<?php

declare(strict_types=1);


abstract class Camion
{

    /** @var string */
    public string $modelo;

    /** @var int */
    public int $potencia;

    /** @var float */
    private float $precio;

    /** @var bool */
    public bool $electrico;

    /**
     * Default constructor
     */
    public function __construct()
    {
        // ...
    }

    /**
     * @param  $modelo 
     * @param  $potencia 
     * @param  $precio 
     * @param  $electrico
     */
    public static function construct( $modelo,  $potencia,  $precio,  $electrico)
    {
        // TODO implement here
    }

}
