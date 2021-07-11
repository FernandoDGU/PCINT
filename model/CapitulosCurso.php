<?php
class CapitulosCurso implements JsonSerializable
{
    private $id_capitulo;
    private $id_curso;
    private $orden;
    private $gratis;
    private $titulo;
    private $descripcion;
    private $video;
    private $tipoVideo;

    public function jsonSerialize()
    {
        return $this;
    }

    public function __construct($id_capitulo, $id_curso, $orden, $gratis, $titulo, $descripcion, $video, $tipoVideo)
    {
        $this->id_capitulo = $id_capitulo;
        $this->id_curso = $id_curso;
        $this->orden = $orden;
        $this->gratis = $gratis;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->video = $video;
        $this->tipoVideo = $tipoVideo;
    }

    public function getId_capitulo()
    {
        return $this->id_capitulo;
    }
    public function getId_curso()
    {
        return $this->id_curso;
    }
    public function getOrden()
    {
        return $this->orden;
    }
    public function getGratis()
    {
        return $this->gratis;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getVideo()
    {
        return $this->video;
    }
    public function getTipoVideo()
    {
        return $this->tipoVideo;
    }
}
