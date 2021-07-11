<?php
require_once "Connection.php";
require_once "CapitulosCurso.php";

class CapitulosCursoDAO
{
    private $db;

    // CALL sp_CapituloCurso(opc, null, null, null, null, null, null, null, null);

    public function __construct()
    {
        $this->db = ConnectionClass::conn();
    }

    public function insertarCaptitulo(CapitulosCurso $cc)
    {
        $result = false;
        $id_curso = $cc->getId_curso();
        $orden = $cc->getOrden();
        $gratis = $cc->getGratis();
        $titulo = $cc->getTitulo();
        $descripcion = $cc->getDescripcion();
        $video = $cc->getVideo();
        $tipoVideo = $cc->getTipoVideo();
        $sql = "CALL sp_CapituloCurso(1, null, " . $id_curso . ", " . $orden . ", " . $gratis . ", '" . $titulo . "', '" . $descripcion . "', '" . $video . "', '" . $tipoVideo . "')";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        } else {
            echo $this->db->error;
        }
        $this->db->close();
        return $result;
    }

    public function getUltimoCapituloCurso($id_curso)
    {
        $sql = "CALL sp_CapituloCurso(4, null, " . $id_curso . ", null, null, null, null, null, null)";
        $result = $this->db->query($sql);
        $arrCapituloCurso = array();

        while ($row = $result->fetch_assoc()) {
            $arrCapituloCurso = $row;
        }

        $this->db->close();

        return $arrCapituloCurso;
    }

    public function getCapitulosDeCurso($id_curso)
    {
        $sql = "CALL sp_CapituloCurso(5, null, " . $id_curso . ", null, null, null, null, null, null)";
        $result = $this->db->query($sql);
        $arrCapituloCurso = array();

        while ($row = $result->fetch_assoc()) {
            $arrCapituloCurso[] = $row;
        }

        $this->db->close();

        return $arrCapituloCurso;
    }

    public function getVideoCapitulo($idCurso, $orden)
    {
        $sql = "CALL sp_CapituloCurso(6, null, " . $idCurso . ", " . $orden . ", null, null, null, null, null);";
        $result = $this->db->query($sql);
        $arrVideoCapitulo = array();
        while ($row = $result->fetch_assoc()) {
            $arrVideoCapitulo = $row;
        }
        $this->db->close();
        return $arrVideoCapitulo;
    }

    public function reInsertConn()
    {
        $this->db = ConnectionClass::conn();
    }
}
