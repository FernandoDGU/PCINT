<?php
class Multimedia implements JsonSerializable
{
    private $id_multimedia;
    private $id_capitulo;
    private $id_curso;
    private $datosArchivo;
    private $nombreArchivo;
    private $tipoArchivo;

    public function jsonSerialize()
    {
        return $this;
    }

    public function __construct($id_multimedia, $id_capitulo, $id_curso, $datosArchivo, $nombreArchivo, $tipoArchivo)
    {

        $this->id_multimedia = $id_multimedia;
        $this->id_capitulo = $id_capitulo;

        $this->id_curso = $id_curso;
        $this->datosArchivo = $datosArchivo;

        $this->nombreArchivo = $nombreArchivo;
        $this->tipoArchivo = $tipoArchivo;
    }

    public function getId_multimedia()
    {
        return $this->id_multimedia;
    }

    public function getId_capitulo()
    {
        return $this->id_capitulo;
    }

    public function getId_curso()
    {
        return $this->id_curso;
    }

    public function getDatosArchivo()
    {
        return $this->datosArchivo;
    }

    public function getNombreArchivo()
    {
        return $this->nombreArchivo;
    }

    public function getTipoArchivo()
    {
        return $this->tipoArchivo;
    }
}
