<?php
require_once "Connection.php";
require_once "Mensaje.php";

class MensajeDAO
{
    private $db;

    //CALL sp_Multimedia(1, null, null, null, null, null, null);

    public function __construct()
    {
        $this->db = ConnectionClass::conn();
    }

    public function insertMensaje(Mensaje $m)
    {
        $result = false;
        $correo_remitente = $m->getCorreo_remitente();
        $correo_destinatario = $m->getCorreo_destinatario();
        $mensaje = $m->getMensaje();


        $sql = "CALL sp_Mensaje(1, null, '" . $correo_remitente . "', '" . $correo_destinatario . "', '" . $mensaje . "', null, null);";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        }

        $this->db->close();

        return $result;
    }

    public function getMensajes($correo1, $correo2)
    {
        $sql = "CALL sp_Mensaje(3, null, '" . $correo1 . "', '" . $correo2 . "', null, null, null);";
        $result = $this->db->query($sql);
        $arrMensajes = array();

        while ($row = $result->fetch_assoc()) {
            $arrMensajes[] = $row;
        }

        $this->db->close();
        return $arrMensajes;
    }


    public function reInsertConn()
    {
        $this->db = ConnectionClass::conn();
    }
}
