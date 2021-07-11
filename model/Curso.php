<?php
class Curso implements JsonSerializable
{
    private $id_curso;
    private $correoEscuela;
    private $titulo;
    private $cantCapitulos;
    private $precio;
    private $imgCurso;
    private $tipoImagen;
    private $descripcion;
    private $desc_corta;
    private $puntaje;
    private $deshabilitado;

    public function jsonSerialize()
    {
        return $this;
    }

    public function __construct($id_curso, $correoEscuela, $titulo, $cantCapitulos, $precio, $imgCurso, $tipoImagen, $descripcion, $desc_corta, $puntaje, $deshabilitado)
    {
        $this->id_curso = $id_curso;
        $this->correoEscuela = $correoEscuela;
        $this->titulo = $titulo;
        $this->cantCapitulos = $cantCapitulos;
        $this->precio = $precio;
        $this->imgCurso = $imgCurso;
        $this->tipoImagen = $tipoImagen;
        $this->descripcion = $descripcion;
        $this->desc_corta = $desc_corta;
        $this->puntaje = $puntaje;
        $this->deshabilitado = $deshabilitado;
    }

    public function getId_curso()
    {
        return $this->id_curso;
    }
    public function getCorreoEscuela()
    {
        return $this->correoEscuela;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getCantCapitulos()
    {
        return $this->cantCapitulos;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getImgCurso()
    {
        return $this->imgCurso;
    }
    public function getTipoImagen()
    {
        return $this->tipoImagen;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getDesc_corta()
    {
        return $this->desc_corta;
    }
    public function getPuntaje()
    {
        return $this->puntaje;
    }
    public function getDeshabilitado()
    {
        return $this->deshabilitado;
    }
}
