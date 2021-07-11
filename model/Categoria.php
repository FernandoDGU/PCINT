<?php

class Categoria implements JsonSerializable
{
    private $nombre;
    private $descripcion;

    public function jsonSerialize()
    {
        return $this;
    }

    public function __construct($nombre, $descripcion)
    {

        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }
}
