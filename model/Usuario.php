<?php

class Usuario implements JsonSerializable
{
    private $correo;
    private $nombre;
    private $contrasena;
    private $imgPerfil;
    private $tipoImagen;
    private $rol;
    private $fecha;
    private $fechaModif;

    public function jsonSerialize()
    {
        return $this;
    }

    public function __construct($correo, $nombre, $contrasena, $imgPerfil, $tipoImagen, $rol, $fecha, $fechaModif)
    {
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->contrasena = $contrasena;
        $this->imgPerfil = $imgPerfil;
        $this->tipoImagen = $tipoImagen;
        $this->rol = $rol;
        $this->fecha = $fecha;
        $this->fechaModif = $fechaModif;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    public function getImgPerfil()
    {
        return $this->imgPerfil;
    }

    public function getTipoImagen()
    {
        return $this->tipoImagen;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getFechaModif()
    {
        return $this->fechaModif;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
}
