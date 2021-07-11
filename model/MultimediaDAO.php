<?php
require_once "Connection.php";
require_once "Multimedia.php";

class MultimediaDAO
{
    private $db;

    //CALL sp_Multimedia(1, null, null, null, null, null, null);

    public function __construct()
    {
        $this->db = ConnectionClass::conn();
    }

    public function insertMultimedia(Multimedia $m)
    {
        $result = false;
        $id_capitulo = $m->getId_capitulo();
        $id_curso = $m->getId_curso();
        $datosArchivo = $m->getDatosArchivo();
        $nombreArchivo = $m->getNombreArchivo();
        $tipoArchivo = $m->getTipoArchivo();

        $sql = "CALL sp_Multimedia(1, null, " . $id_capitulo . ", " . $id_curso . ", '" . $datosArchivo . "', '" . $nombreArchivo . "', '" . $tipoArchivo . "');";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        }

        $this->db->close();

        return $result;
    }

    public function getMultimediaCapítuloCurso($idCap, $idCurso)
    {
        $sql = "CALL sp_Multimedia(2,null," . $idCap . "," . $idCurso . ",null,null,null);";
        $result = $this->db->query($sql);
        $arrMultimedia = array();

        while ($row = $result->fetch_assoc()) {
            $arrMultimedia[] = $row;
        }

        $this->db->close();
        return $arrMultimedia;
    }

    public function getMultimedia($id)
    {
        $sql = "CALL sp_Multimedia(3," . $id . ",null, null ,null,null,null);";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $arr = array();
            while ($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            $this->db->close();
            return $arr;
        } else {
            $this->db->close();
            return "0 results";
        }
    }

    public function reInsertConn()
    {
        $this->db = ConnectionClass::conn();
    }
}
