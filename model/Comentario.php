<?php

class Comentario implements JsonSerializable
{
    private $id_comentario;
    private $correo_estudiante;
    private $id_curso;
    private $comentario;
    private $voto;
    private $fecha;

    public function jsonSerialize()
    {
        return $this;
    }

    public function __construct($id_comentario, $correo_estudiante, $id_curso, $comentario, $voto, $fecha)
    {

        $this->id_comentario = $id_comentario;
        $this->correo_estudiante = $correo_estudiante;
        $this->id_curso = $id_curso;
        $this->comentario = $comentario;
        $this->voto = $voto;
        $this->fecha = $fecha;
    }

    public function getId_comentario()
    {
        return $this->id_comentario;
    }

    public function getCorreo_estudiante()
    {
        return $this->correo_estudiante;
    }

    public function getId_curso()
    {
        return $this->id_curso;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function getVoto()
    {
        return $this->voto;
    }

    public function getFecha()
    {
        return $this->fecha;
    }
}
