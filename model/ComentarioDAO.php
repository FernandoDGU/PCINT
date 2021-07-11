<?php
require_once "Connection.php";
require_once "Comentario.php";

class ComentarioDAO
{
    private $db;

    public function __construct()
    {
        $this->db = ConnectionClass::conn();
    }

    //CALL sp_Comentarios(opc, null, null, null, null, null);

    public function comentariosPorCurso($idCurso)
    {
        $sql = "CALL sp_Comentarios(2, null, null, " . $idCurso . ", null, null);";
        $result = $this->db->query($sql);
        $arrCom = array();
        while ($row = $result->fetch_assoc()) {
            $arrCom[] = $row;
        }
        $this->db->close();
        return $arrCom;
    }

    public function comentariosDeCursosEscuela($correo)
    {
        $sql = "CALL sp_Comentarios(4, null, '" . $correo . "', null, null, null);";
        $result = $this->db->query($sql);
        $arrCom = array();
        while ($row = $result->fetch_assoc()) {
            $arrCom[] = $row;
        }
        $this->db->close();
        return $arrCom;
    }

    public function comentariosDeAlumno($correo)
    {
        $sql = "CALL sp_Comentarios(5, null, '" . $correo . "', null, null, null);";
        $result = $this->db->query($sql);
        $arrCom = array();
        while ($row = $result->fetch_assoc()) {
            $arrCom[] = $row;
        }
        $this->db->close();
        return $arrCom;
    }

    public function insertarComentario($correo, $idCurso, $comentario, $voto)
    {
        $result = false;
        $sql = "CALL sp_Comentarios(1, null, '" . $correo . "', " . $idCurso . ", '" . $comentario . "', " . $voto . ");";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        } else
            echo  $this->db->error;
        $this->db->close();
        return $result;
    }

    public function verSiComento($correo, $idCurso)
    {
        $result = false;

        $sql = "CALL sp_Comentarios(3, null, ?, ?, null, null);";
        $param = $this->db->prepare($sql);
        $param->bind_param('si', $correo, $idCurso);
        $param->execute();

        $param->bind_result($resId);
        $param->fetch();
        if ($resId != null) {
            $result = true;
        }
        $this->db->close();
        return $result;
    }

    public function reInsertCon()
    {
        return $this->db = ConnectionClass::conn();
    }
}
