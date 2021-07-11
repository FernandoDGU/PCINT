<?php
require_once "Connection.php";
require_once "Usuario.php";

class UsuarioDAO
{
    private $db;



    public function __construct()
    {
        $this->db = ConnectionClass::conn();
    }

    public function logIn(Usuario $u)
    {
        $result = false;
        $correo = $u->getCorreo();
        $pass = $u->getContrasena();

        $sql = "CALL sp_Usuario(6, ?, null, ?, null, null, null, null, null);";
        $param = $this->db->prepare($sql);
        $param->bind_param('ss', $correo, $pass);
        $param->execute();

        $param->bind_result($resEmail, $resPassword);
        $param->fetch();
        if ($resEmail != null) {
            $result = true;
        }
        $this->db->close();
        return $result;
    }

    public function signUp(Usuario $u)
    {
        $result = false;
        $correo = $u->getCorreo();
        $nombre = $u->getNombre();
        $contra = $u->getContrasena();
        $rol = $u->getRol();
        $imagen = $u->getImgPerfil();
        $tipoImagen = $u->getTipoImagen();
        $sql = "CALL sp_Usuario(1, '" . $correo . "', '" . $nombre . "', '" . $contra . "', '" . $imagen . "', '" . $tipoImagen . "', '" . $rol . "', null, null);";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        }

        $this->db->close();
        return $result;
    }

    public function updateUser(Usuario $u) /////////////ACTUALIZAR PARA LAS FOTOS
    {
        $result = false;
        $correo = $u->getCorreo();
        $nombre = $u->getNombre();
        $contra = $u->getContrasena();
        $imgPerfil = $u->getImgPerfil();
        $tipoImagen = $u->getTipoImagen();
        $sql = "CALL sp_Usuario(2, '" . $correo . "', '" . $nombre . "', '" . $contra . "', '" . $imgPerfil . "', '" . $tipoImagen . "', null, null, null);";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        }
        $this->db->close();
        return $result;
    }

    public function getActualUser($correo)
    {

        $sql = "CALL sp_Usuario(4, ?, null, null, null, null, null, null, null);";
        $param = $this->db->prepare($sql);
        $param->bind_param('s', $correo);
        $param->execute();

        $param->bind_result($Correo, $Nombre, $Contrasena, $ImgPerfil, $TipoImagen, $Rol, $Fecha, $FechaModif);
        $param->fetch();
        $arr = array();
        if ($Correo != null) {

            $arr[] = $Correo;
            $arr[] = $Nombre;
            $arr[] = $Contrasena;
            $arr[] = $ImgPerfil;
            $arr[] = $TipoImagen;
            $arr[] = $Rol;
            $arr[] = $Fecha;
            $arr[] = $FechaModif;
            $this->db->close();
            return $arr;
        } else {
            echo "no se encontró";
            $this->db->close();
            return null;
        }
    }

    public function getUserImage($correo)
    {
        $sql = "CALL sp_Usuario(7, '" . $correo . "', null, null, null, null, null, null, null);";
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

    public function llenarChat($correo)
    {
        $sql = "CALL sp_Usuario(8, '" . $correo . "', null, null, null, null, null, null, null);";
        $result = $this->db->query($sql);

        $arr = array();
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        $this->db->close();
        return $arr;
    }

    public function comprarCursos($correo, $idCurso)
    {
        $result = false;
        $sql = "CALL sp_CursosComprados(1, null, '" . $correo . "', " . $idCurso . ", null, 0);";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        } else
            echo  $this->db->error;
        $this->db->close();
        return $result;
    }

    public function getDiploma($correo, $idCurso)
    {
        $result = false;
        $sql = "CALL sp_CursosComprados(11, null, '" . $correo . "', " . $idCurso . ", null, null);";
        $result = $this->db->query($sql);
        $arrCursosTerminados = array();
        while ($row = $result->fetch_assoc()) {
            $arrCursosTerminados = $row;
        }
        $this->db->close();
        return $arrCursosTerminados;
    }

    public function terminarCurso($correo, $idCurso)
    {
        $result = false;
        $sql = "CALL sp_CursosComprados(5, null, '" . $correo . "', " . $idCurso . ", null, null);";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        } else
            echo  $this->db->error;
        $this->db->close();
        return $result;
    }

    public function cantCursosTerminados($correo)
    {
        $result = false;
        $sql = "CALL sp_CursosComprados(9, null, '" . $correo . "', null, null, null);";
        $result = $this->db->query($sql);
        $arrCursosTerminados = array();
        while ($row = $result->fetch_assoc()) {
            $arrCursosTerminados = $row;
        }
        $this->db->close();
        return $arrCursosTerminados;
    }

    public function cantCursosComprados($correo)
    {
        $result = false;
        $sql = "CALL sp_CursosComprados(8, null, '" . $correo . "', null, null, null);";
        $result = $this->db->query($sql);
        $arrCursosComprados = array();
        while ($row = $result->fetch_assoc()) {
            $arrCursosComprados = $row;
        }
        $this->db->close();
        return $arrCursosComprados;
    }

    public function cantAlumnos($correo)
    {
        $result = false;
        $sql = "CALL sp_CursosComprados(10, null, '" . $correo . "', null, null, null);";
        $result = $this->db->query($sql);
        $arrCantAlumnos = array();
        while ($row = $result->fetch_assoc()) {
            $arrCantAlumnos = $row;
        }
        $this->db->close();
        return $arrCantAlumnos;
    }

    public function actualizarCarro($correo)
    {
        $result = false;
        $sql = "CALL sp_CarroEstudiante(6, null, '" . $correo . "', null);";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        } else
            echo  $this->db->error;
        $this->db->close();
        return $result;
    }

    public function getActualCarroId($correo)
    {
        $sql = "CALL sp_CarroEstudiante(3,null,'" . $correo . "',null);";
        $result = $this->db->query($sql);
        $arrCarro = array();
        while ($row = $result->fetch_assoc()) {
            $arrCarro = $row;
        }
        $this->db->close();
        return $arrCarro;
    }

    public function getCarroCursos($correo)
    {
        $sql = "CALL sp_CarroEstudiante(4,null,'" . $correo . "',null);";
        $result = $this->db->query($sql);
        $arrCursos = array();
        while ($row = $result->fetch_assoc()) {
            $arrCursos[] = $row;
        }
        $this->db->close();
        return $arrCursos;
    }

    public function getCarroCursosId($correo)
    {
        $sql = "CALL sp_CarroEstudiante(5,null,'" . $correo . "',null);";
        $result = $this->db->query($sql);
        $arrCursos = array();
        while ($row = $result->fetch_assoc()) {
            $arrCursos[] = $row;
        }
        $this->db->close();
        return $arrCursos;
    }

    public function agregarCursoCarro($idCarro, $idCurso)
    {
        $result = false;
        $sql = "CALL sp_CarroCursos(1, null, " . $idCarro . "," . $idCurso . ");";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        }

        $this->db->close();
        return $result;
    }

    public function isCursoEnElCarro($idCarro, $idCurso)
    {
        $result = false;

        $sql = "CALL sp_CarroCursos(3, null, ?, ?);";
        $param = $this->db->prepare($sql);
        $param->bind_param('ii', $idCarro, $idCurso);
        $param->execute();

        $param->bind_result($resIdCurso);
        $param->fetch();
        if ($resIdCurso != null) {
            $result = true;
        }
        $this->db->close();
        return $result;
    }

    public function cantidadDeCapitulosVistos($correo, $idCurso)
    {

        $sql = "CALL sp_ProgresoCapitulos(3, null, ?, ?, null);";
        $param = $this->db->prepare($sql);
        $param->bind_param('si', $correo, $idCurso);
        $param->execute();

        $param->bind_result($resCapVistos);
        $param->fetch();

        $this->db->close();
        return $resCapVistos;
    }

    public function actualizarProgreso($correo, $idCurso)
    {
        $result = false;
        $sql = "CALL sp_ProgresoCapitulos(4, null, '" . $correo . "', " . $idCurso . ", null);";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        } else {
            echo $this->db->error;
        }

        $this->db->close();
        return $result;
    }

    public function borrarDelCarro($idCarro, $idCurso)
    {
        $result = false;

        $sql = "CALL sp_CarroCursos(4, null, " . $idCarro . "," . $idCurso . ");";
        if ($this->db->query($sql) === TRUE) {
            $result = true;
        }

        $this->db->close();
        return $result;
    }

    public function getUsuarioCursos($correo)
    {
        $sql = "CALL sp_CursosComprados(4, null, '" . $correo . "', null, null, null);";
        $result = $this->db->query($sql);
        $arrCursos = array();
        while ($row = $result->fetch_assoc()) {
            $arrCursos[] = $row;
        }
        $this->db->close();
        return $arrCursos;
    }

    public function getUsuarioCursosFecha($correo)
    {
        $sql = "CALL sp_CursosComprados(7, null, '" . $correo . "', null, null, null);";
        $result = $this->db->query($sql);
        $arrCursos = array();
        while ($row = $result->fetch_assoc()) {
            $arrCursos[] = $row;
        }
        $this->db->close();
        return $arrCursos;
    }

    public function yaTieneCurso($correo, $idCurso)
    {
        $result = false;

        $sql = "CALL sp_CursosComprados(6, null, ?, ?, null, null);";
        $param = $this->db->prepare($sql);
        $param->bind_param('si', $correo, $idCurso);
        $param->execute();

        $param->bind_result($resIdCurso);
        $param->fetch();
        if ($resIdCurso != null) {
            $result = true;
        }
        $this->db->close();
        return $result;
    }


    public function reInsertCon()
    {
        return $this->db = ConnectionClass::conn();
    }

    public function getCon()
    {
        return $this->db;
    }
}
