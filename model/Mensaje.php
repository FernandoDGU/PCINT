<?php
class Mensaje implements JsonSerializable
{
    private $id_mensaje;
    private $correo_remitente;
    private $correo_destinatario;
    private $mensaje;
    private $fecha;
    private $hora;

    public function jsonSerialize()
    {
        return $this;
    }

    public function __construct($id_mensaje, $correo_remitente, $correo_destinatario, $mensaje, $fecha, $hora)
    {
        $this->id_mensaje = $id_mensaje;
        $this->correo_remitente = $correo_remitente;
        $this->correo_destinatario = $correo_destinatario;
        $this->mensaje = $mensaje;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }

    public function getId_mensaje()
    {
        return $this->id_mensaje;
    }

    public function getCorreo_remitente()
    {
        return $this->correo_remitente;
    }

    public function getCorreo_destinatario()
    {
        return $this->correo_destinatario;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getHora()
    {
        return $this->hora;
    }
}
