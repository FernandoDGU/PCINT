<?php
require_once "Connection.php";
require_once "Categoria.php";

class CategoriaDAO
{
    private $db;

    public function __construct()
    {
        $this->db = ConnectionClass::conn();
    }

    public function insertarCategoria(Categoria $cat)
    {
        $result = false;
        $nombre = $cat->getNombre();
        $descripcion = $cat->getDescripcion();

        $sql = "CALL sp_Categoria(1, '" . $nombre . "', '" . $descripcion . "');";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        }
        $this->db->close();
        return $result;
    }

    public function getAllCategories()
    {

        $sql = "CALL sp_Categoria(2, null, null);";
        $result = $this->db->query($sql);
        $arrCat = array();
        while ($row = $result->fetch_assoc()) {
            $arrCat[] = $row;
        }
        $this->db->close();
        return $arrCat;
    }

    public function insertarCursoCategoria($id_curso, $nombre)
    {
        $result = false;
        $sql = "CALL sp_Curso_Categoria(1, null, " . $id_curso . ", '" . $nombre . "');";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        }
        $this->db->close();
        return $result;
    }

    public function getCategoryDescription($name)
    {
        $sql = "CALL sp_Categoria(3, '" . $name . "', null);";
        $result = $this->db->query($sql);
        $arrCat = array();
        while ($row = $result->fetch_assoc()) {
            $arrCat = $row;
        }
        $this->db->close();
        return $arrCat;
    }

    public function reInsertConn()
    {
        $this->db = ConnectionClass::conn();
    }
}
