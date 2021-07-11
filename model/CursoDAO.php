<?php
require_once "Connection.php";
require_once "Curso.php";

class CursoDAO
{
    private $db;

    // CALL sp_Curso(opc, null, null, null, null, null, null, null, null, null, null, null);

    public function __construct()
    {
        $this->db = ConnectionClass::conn();
    }

    public function insertarCurso(Curso $c)
    {
        $result = false;
        $correo_escuela = $c->getCorreoEscuela();
        $titulo = $c->getTitulo();
        $cantCapitulos = $c->getCantCapitulos();
        $precio = $c->getPrecio();
        $imgCurso = $c->getImgCurso();
        $tipoImagen = $c->getTipoImagen();
        $descripcion = $c->getDescripcion();
        $desc_corta = $c->getDesc_corta();
        $sql = "CALL sp_Curso(1, null, '" . $correo_escuela . "', '" . $titulo . "'," . $cantCapitulos . ", " . $precio . ", '" . $imgCurso . "', '" . $tipoImagen . "', '" . $descripcion . "', '" . $desc_corta . "', null, null);";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        }
        $this->db->close();
        return $result;
    }

    public function eliminarCurso($cursoID)
    {
        $result = false;

        $sql = "CALL sp_Curso(14, " . $cursoID . ", null, null, null, null, null, null, null, null, null, null);";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        }
        $this->db->close();
        return $result;
    }

    public function cursoPorID($id)
    {
        $sql = "CALL sp_Curso(3, " . $id . ", null, null, null, null, null, null, null, null, null, null);";
        $result = $this->db->query($sql);
        $arrCurso = array();
        while ($row = $result->fetch_assoc()) {
            $arrCurso = $row;
        }
        $this->db->close();
        return $arrCurso;
    }

    public function cursosEscuela($correo)
    {
        $sql = "CALL sp_Curso(4, null, '" . $correo . "', null, null, null, null, null, null, null, null, null);";
        $result = $this->db->query($sql);
        $arrCurso = array();
        while ($row = $result->fetch_assoc()) {
            $arrCurso[] = $row;
        }
        $this->db->close();
        return $arrCurso;
    }

    public function cursosEscuelaPrecios($correo)
    {
        $sql = "CALL sp_Curso(11, null, '" . $correo . "', null, null, null, null, null, null, null, null, null);";
        $result = $this->db->query($sql);
        $arrCurso = array();
        while ($row = $result->fetch_assoc()) {
            $arrCurso[] = $row;
        }
        $this->db->close();
        return $arrCurso;
    }

    public function getCursosPopulares()
    {
        $sql = "CALL sp_Curso(8, null, null, null, null, null, null, null, null, null, null, null);";
        $result = $this->db->query($sql);
        $arrCurso = array();
        while ($row = $result->fetch_assoc()) {
            $arrCurso[] = $row;
        }
        $this->db->close();
        return $arrCurso;
    }

    public function getUltimosCursos()
    {
        $sql = "CALL sp_Curso(9, null, null, null, null, null, null, null, null, null, null, null);";
        $result = $this->db->query($sql);
        $arrCurso = array();
        while ($row = $result->fetch_assoc()) {
            $arrCurso[] = $row;
        }
        $this->db->close();
        return $arrCurso;
    }

    public function getCursosMasVendidos()
    {
        $sql = "CALL sp_Curso(10, null, null, null, null, null, null, null, null, null, null, null);";
        $result = $this->db->query($sql);
        $arrCurso = array();
        while ($row = $result->fetch_assoc()) {
            $arrCurso[] = $row;
        }
        $this->db->close();
        return $arrCurso;
    }

    public function getUltimoCursoEscuela($correo)
    {
        $sql = "CALL sp_Curso(5, null, '" . $correo . "', null, null, null, null, null, null, null, null, null);";
        $result = $this->db->query($sql);
        $arrCurso = array();
        while ($row = $result->fetch_assoc()) {
            $arrCurso = $row;
        }
        $this->db->close();
        return $arrCurso;
    }

    public function getImagenCurso($id)
    {
        $sql = "CALL sp_Curso(6, '.$id.', null, null, null, null, null, null, null, null, null, null);";
        $result = $this->db->query($sql);
        $arrCursoImagen = array();
        while ($row = $result->fetch_assoc()) {
            $arrCursoImagen = $row;
        }
        $this->db->close();
        return $arrCursoImagen;
    }

    public function getCursosCategoriaPorID($id)
    {
        $sql = "CALL sp_Curso(7, '.$id.', null, null, null, null, null, null, null, null, null, null);";
        $result = $this->db->query($sql);
        $arrCursosCategoria = array();
        while ($row = $result->fetch_assoc()) {
            $arrCursosCategoria[] = $row;
        }
        $this->db->close();
        return $arrCursosCategoria;
    }

    public function getCantCursos($correo)
    {
        $sql = "CALL sp_Curso(13, null, '" . $correo . "', null, null, null, null, null, null, null, null, null);";
        $result = $this->db->query($sql);
        $arrCursos = array();
        while ($row = $result->fetch_assoc()) {
            $arrCursos = $row;
        }
        $this->db->close();
        return $arrCursos;
    }

    public function actualizarCurso($idCurso, $titulo, $imagen, $tipoImagen, $descripcion, $desc_corta)
    {
        $result = false;
        $sql = "CALL sp_Curso(12, " . $idCurso . ", null, '" . $titulo . "', null, null, '" . $imagen . "', '" . $tipoImagen . "', '" . $descripcion . "', '" . $desc_corta . "', null, null);";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        } else {
            echo $this->db->error;
        }

        $this->db->close();
        return $result;
    }

    public function busquedaDeCursos($opc, $text)
    {
        $sql = "CALL sp_Busqueda(" . $opc . ",'" . $text . "');";
        $result = $this->db->query($sql);
        $arrCursos = array();
        while ($row = $result->fetch_assoc()) {
            $arrCursos[] = $row;
        }
        $this->db->close();
        return $arrCursos;
    }

    public function reInsertCon()
    {
        $this->db = ConnectionClass::conn();
    }
}
