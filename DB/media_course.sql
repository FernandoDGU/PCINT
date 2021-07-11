-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2021 a las 16:52:27
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `media_course`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`CURRENT_USER`@`localhost` PROCEDURE `sp_Busqueda` (`pOpc` INT, `pTexto` TEXT)  BEGIN
	IF pOpc = 1 THEN #Buscar por nombre de escuela
		SELECT DISTINCT cur.id_curso, cur.correo_escuela, cur.titulo, cur.cantidadCapitulos, cur.precio, cur.descripcion, cur.desc_corta, cur.puntaje, usu.nombre
        FROM Curso as cur
        JOIN Usuario as usu
        ON cur.correo_escuela = usu.correo
        WHERE usu.nombre LIKE CONCAT('%', pTexto , '%');
    END IF;
    
    IF pOpc = 2 THEN #Buscar por nombre de curso
		SELECT DISTINCT cur.id_curso, cur.correo_escuela, cur.titulo, cur.cantidadCapitulos, cur.precio, cur.descripcion, cur.desc_corta, cur.puntaje, usu.nombre
        FROM Curso as cur
        JOIN Usuario as usu
        ON cur.correo_escuela = usu.correo
        WHERE cur.titulo LIKE CONCAT('%', pTexto , '%');
    END IF;
    
     IF pOpc = 3 THEN #Buscar por categorias
		SELECT DISTINCT cur.id_curso, cur.correo_escuela, cur.titulo, cur.cantidadCapitulos, cur.precio, cur.descripcion, cur.desc_corta, cur.puntaje, usu.nombre
        FROM Curso as cur
        JOIN Usuario as usu
        ON cur.correo_escuela = usu.correo
        JOIN Curso_Categoria as curcat
        ON cur.id_curso = curcat.id_curso
        WHERE curcat.nombre LIKE CONCAT('%', pTexto , '%');
    END IF;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CapituloCurso` (`pOpc` INT, `pId_capitulo` INT, `pId_curso` INT, `pOrden` INT, `pGratis` BIT, `pTitulo` VARCHAR(100), `pDescripcion` TEXT, `pVideo` LONGBLOB, `pTipoVideo` TEXT)  BEGIN
		IF pOpc = 1 THEN #Insertar capítulo
			INSERT INTO CapituloCurso(id_curso, orden, esGratis, titulo, descripcion, video, tipoVideo)
            VALUES(pId_curso, pOrden, pGratis, pTitulo, pDescripcion, pVideo, pTipoVideo);
        END IF;
        
        IF pOpc = 2 THEN #Traer todos los capítulos
			SELECT id_capitulo, id_curso, orden, esGratis, titulo, descripcion
            FROM CapituloCurso;
        END IF;
        
        IF pOpc = 3 THEN #Traer un capítulo por ID
			SELECT id_capitulo, id_curso, orden, esGratis, titulo, descripcion
            FROM CapituloCurso
            WHERE id_capitulo = pId_capitulo;
        END IF; 
        
        IF pOpc = 4 THEN #Traer el último capítulo creado
        SELECT id_capitulo
        FROM CapituloCurso
        WHERE id_curso = pId_curso
        ORDER BY id_capitulo DESC
        LIMIT 1;
        END IF;
        
        IF pOpc = 5 THEN #Traer los capítulos de un curso
			SELECT capcur.id_capitulo, capcur.id_curso, capcur.orden, capcur.esGratis, capcur.titulo, capcur.descripcion
            FROM CapituloCurso as capcur
            JOIN Curso as cur
            ON capcur.id_curso = cur.id_curso
            WHERE capcur.id_curso = pId_curso;
        END IF; 
        
        IF pOpc = 6 THEN #Traer el video de un capítulo
			SELECT video, tipoVideo
            FROM CapituloCurso
            WHERE id_curso = pId_curso
				AND orden = pOrden;
        END IF; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CarroCursos` (`pOpc` INT, `pId_carro_curso` INT, `pId_carro` INT, `pId_curso` INT)  BEGIN
	IF pOpc = 1 THEN
		INSERT INTO CarroCursos(id_carro, id_curso)
        VALUES (pId_carro, pId_curso);
    END IF;
    
    IF pOpc = 2 THEN 
		SELECT id_carro_cursos, id_carro, id_curso
        FROM CarroCursos
        WHERE id_carro_cursos = pId_carro_curso;
    END IF;
    
     IF pOpc = 3 THEN 
		SELECT carcur.id_curso
        FROM CarroCursos as carcur
        JOIN CarroEstudiante as carest
        ON carcur.id_carro = carest.id_carro
        WHERE carcur.id_curso = pId_curso
        AND carcur.id_carro = pId_carro;
    END IF;
    
    IF pOpc = 4 THEN #Eliminar
		DELETE FROM CarroCursos
        WHERE 	id_carro = pId_carro
        AND		id_curso = pId_curso;
	END IF;
    
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CarroEstudiante` (`pOpc` INT, `pId_carro` INT, `pCorreo` VARCHAR(50), `pCompraTerminada` BIT)  BEGIN 
		IF pOpc = 1 THEN 
			INSERT INTO CarroEstudiante(correo_estudiante, compraTerminada)
            VALUES(pCorreo, pCompraTerminada);
        END IF;
        
        IF pOpc = 2 THEN 
			SELECT  id_carro , correo_estudiante, compraTerminada
            FROM CarroEstudiante
            WHERE correo_estudiante = pCorreo;
        END IF;
        
        IF pOpc = 3 THEN #Regresa el id del carro actual
			SELECT  id_carro
            FROM CarroEstudiante
            WHERE correo_estudiante = pCorreo AND compraTerminada = 0;
        END IF;
        
        IF pOpc = 4 THEN #Obtener cursos del carro actual
			SELECT  cur.id_curso, cur.correo_escuela, cur.titulo, cur.precio, cur.descripcion, usu.nombre
            FROM CarroEstudiante as carest
            JOIN CarroCursos as carcur
            ON carest.id_carro = carcur.id_carro
            JOIN Curso as cur
            ON carcur.id_curso = cur.id_curso
            JOIN Usuario as usu
            ON cur.correo_escuela = usu.correo
            WHERE carest.correo_estudiante = pCorreo AND carest.compraTerminada = 0;
        END IF;
        
        IF pOpc = 5 THEN #Obtener el id de los cursos del carro actual
			SELECT  cur.id_curso
            FROM CarroEstudiante as carest
            JOIN CarroCursos as carcur
            ON carest.id_carro = carcur.id_carro
            JOIN Curso as cur
            ON carcur.id_curso = cur.id_curso
            JOIN Usuario as usu
            ON cur.correo_escuela = usu.correo
            WHERE carest.correo_estudiante = pCorreo AND carest.compraTerminada = 0;
        END IF;
        
        IF pOpc = 6 THEN #Compra Terminada
			UPDATE CarroEstudiante
				SET compraTerminada = 1
					WHERE 	correo_estudiante = pCorreo
					AND 	compraTerminada = 0;
                    
			INSERT INTO CarroEstudiante(correo_estudiante, compraTerminada)
            VALUES(pCorreo, 0);
		END IF;
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Categoria` (`pOpc` INT, `pNombre` VARCHAR(100), `pDescripcion` TEXT)  BEGIN
		IF pOpc = 1 THEN #Insertar categoría
			INSERT INTO Categoria(descripcion, nombre)
            VALUES (pDescripcion, pNombre);
		END IF; 
        
        IF pOpc = 2 THEN #Traer todas las categorías
			SELECT * FROM traerTodasCategorias;
        END IF;
        
        IF pOpc = 3 THEN #Traer una categoría por Id
			SELECT nombre, descripcion
            FROM Categoria
            WHERE nombre = pNombre;
        END IF; 
     

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Comentarios` (`pOpc` INT, `pId_comentario` INT, `pCorreo` VARCHAR(50), `pId_curso` INT, `pComentario` TEXT, `pVoto` BIT)  BEGIN 
 
	IF pOpc = 1 THEN
		INSERT INTO Comentarios (correo_estudiante,  id_curso, comentario, voto, fecha)
        VALUES(pCorreo, pId_curso, pComentario, pVoto, NOW());
	END IF; 
	
    IF pOpc  = 2 THEN #Comentarios por curso
		SELECT com.id_comentario, com.correo_estudiante,  com.id_curso, com.comentario, com.voto, com.fecha, usu.nombre
        FROM Comentarios as com
        JOIN Usuario as usu
        ON com.correo_estudiante = usu.correo
        WHERE id_curso = pId_curso
		ORDER BY id_comentario DESC;
    END IF;
    
    IF pOpc  = 3 THEN #Ver si estudiante comentó curso
		SELECT id_comentario
        FROM Comentarios
        WHERE id_curso = pId_curso
        AND		correo_estudiante = pCorreo
        LIMIT 1;
    END IF;
    
    IF pOpc  = 4 THEN #Comentarios a los cursos de escuela
		SELECT com.id_comentario, com.correo_estudiante,  com.id_curso, com.comentario, com.voto, com.fecha, usu.nombre, cur.titulo
        FROM Comentarios as com
        JOIN Usuario as usu
        ON com.correo_estudiante = usu.correo
        JOIN Curso as cur
        ON com.id_curso = cur.id_curso
        WHERE cur.correo_escuela = pCorreo
		ORDER BY id_comentario DESC;
    END IF;
    
    IF pOpc  = 5 THEN #Comentarios de un alumno
		SELECT com.id_comentario, com.correo_estudiante,  com.id_curso, com.comentario, com.voto, com.fecha, usu.nombre, cur.titulo
        FROM Comentarios as com
        JOIN Curso as cur
        ON com.id_curso = cur.id_curso
        JOIN Usuario as usu
        ON cur.correo_escuela = usu.correo
        WHERE com.correo_estudiante = pCorreo
		ORDER BY id_comentario DESC;
    END IF;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Curso` (`pOpc` INT, `pId` INT, `pCorreoEscuela` VARCHAR(50), `pTitulo` VARCHAR(100), `pCantCapitulos` INT, `pPrecio` FLOAT, `pImgCurso` MEDIUMBLOB, `pTipoImagen` TEXT, `pDescripcion` TEXT, `pDesc_corta` VARCHAR(50), `pPuntaje` FLOAT, `pDeshabilitado` BIT)  BEGIN
		IF pOpc = 1 THEN #Insertar Curso
        INSERT INTO Curso(correo_escuela, titulo, cantidadCapitulos, precio, imgCurso, tipoImagen, descripcion, desc_corta, puntaje, deshabilitado)
        VALUES (pCorreoEscuela, pTitulo, pCantCapitulos, pPrecio, pImgCurso, pTipoImagen,pDescripcion, pDesc_corta,0, 0);
        END IF;
        
        IF pOpc = 2 THEN #Traer todos los cursos
        SELECT id_curso,correo_escuela, titulo, cantidadCapitulos, precio, descripcion, desc_corta,puntaje, deshabilitado
        FROM Curso;
        END IF;
        
        If pOpc = 3 THEN  #Traer un curso por Id
		SELECT cur.id_curso,correo_escuela, cur.titulo, cur.cantidadCapitulos, cur.precio, cur.descripcion, cur.desc_corta, cur.puntaje, cur.deshabilitado, usu.nombre, totalVotos(id_curso) 'Votos Totales'
        FROM Curso as cur
        JOIN Usuario as usu
        ON cur.correo_escuela = usu.correo
        WHERE id_curso = pId;
        END IF;
        
        If pOpc = 4 THEN  #Traer los cursos de una escuela
		SELECT id_curso, correo_escuela, titulo, cantidadCapitulos, precio, descripcion, desc_corta,puntaje, deshabilitado, totalVotos(id_curso) 'Votos Totales'
        FROM Curso
        WHERE correo_escuela = pCorreoEscuela;
        END IF;
        
         IF pOpc = 5 THEN #Traer el último curso creado
        SELECT id_curso
        FROM Curso
        WHERE correo_escuela = pCorreoEscuela
        ORDER BY id_curso DESC
        LIMIT 1;
        END IF;
        
        IF pOpc = 6 THEN #Traer imagen del curso
        SELECT imgCurso, tipoImagen
        FROM Curso
        WHERE id_curso = pId;
        END IF;
        
        IF pOpc = 7 THEN #Traer las categorias del curso por id
        SELECT cc.nombre
        FROM Curso as cur
        JOIN curso_categoria as cc
        ON cur.id_curso = cc.id_curso
        WHERE cur.id_curso = pId;
        END IF;
        
        IF pOpc = 8 THEN #Traer cursos populares
        select * from cursosPopulares;
        END IF;
        
        IF pOpc = 9 THEN #Ultimos cursos
        select * from ultimosCursos;
        END IF;
        
        IF pOpc = 10 THEN #Cursos más vendidos
        select * from cursosMasVendidos;
        END IF;
        
        If pOpc = 11 THEN  #Traer los cursos de una escuela y precio total
		SELECT id_curso, correo_escuela, titulo, cantidadCapitulos, precio, descripcion, desc_corta,puntaje, deshabilitado, (cursosVendidos(id_curso) * precio) 'Ganancias'
        FROM Curso
        WHERE correo_escuela = pCorreoEscuela;
        END IF;
        
        If pOpc = 12 THEN  #Modificar
		UPDATE Curso
			SET titulo = pTitulo, imgCurso = pImgCurso, tipoImagen = pTipoImagen, descripcion = pDescripcion, desc_corta = pDesc_corta
		WHERE id_curso = pId;
        END IF;
        
        If pOpc = 13 THEN  #Traer la cantidad de cursos de una escuela
		SELECT COUNT(1) 'cantidadCursos'
        FROM Curso
        WHERE correo_escuela = pCorreoEscuela;
        END IF;
        
        If pOpc = 14 THEN  #Eliminar Curso
				DELETE FROM CarroCursos
					WHERE id_curso = pId;
                DELETE FROM CursosComprados
					WHERE id_curso = pId;
				DELETE FROM Comentarios
					WHERE id_curso = pId;
				DELETE FROM ProgresoCapitulos
					WHERE id_curso = pId;
				DELETE FROM Multimedia
					WHERE id_curso = pId;
				DELETE FROM Curso_Categoria
					WHERE id_curso = pId;
				DELETE FROM CapituloCurso
					WHERE id_curso = pId;
                
				DELETE FROM Curso
					WHERE id_curso = pId;

        END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CursosComprados` (`pOpc` INT, `pId_compra` INT, `pCorreo` VARCHAR(50), `pId_curso` INT, `pFechaTerminado` DATETIME, `pTerminado` BIT)  BEGIN 
		IF pOpc = 1 THEN
			INSERT INTO CursosComprados(correo_estudiante, id_curso, fechaComprado, fechaTerminado, terminado)
            VALUES (pCorreo, pId_curso, NOW(), pFechaTerminado, pTerminado);
        END IF;
        
        IF pOpc = 2 THEN 
			UPDATE CursosComprados
            SET fechaTerminado = pFechaTerminado,
            terminado = pTerminado
            WHERE id_compra = pId_compra;
        END IF ;
        
        IF pOpc = 3 THEN 
			SELECT	 id_compra, correo_estudiante, id_curso, fechaComprado, fechaTerminado, terminado
            FROM 	CursosComprados
            WHERE correo_estudiante = pCorreo;
        END IF;
        
        IF pOpc = 4 THEN #Traer todos los cursos comprados de un usuario
			SELECT	 cur.id_curso, cur.titulo, cur.descripcion, usu.nombre, ROUND((progresoCurso(cur.id_curso, pCorreo) / cur.cantidadCapitulos) * 300) 'progresoBarra', ROUND((progresoCurso(cur.id_curso, pCorreo) / cur.cantidadCapitulos) * 100) 'progreso'
            FROM 	CursosComprados as curcom
            JOIN Curso as cur
            ON curcom.id_curso = cur.id_curso
            JOIN Usuario as usu
            ON cur.correo_escuela = usu.correo
            WHERE correo_estudiante = pCorreo;
        END IF;
        
        IF pOpc = 5 THEN #Curso Terminado
			UPDATE CursosComprados
				SET terminado = 1, fechaTerminado = NOW()
			WHERE	correo_estudiante = pCorreo
				AND	id_curso = pId_curso;
        END IF;
        
        IF pOpc = 6 THEN #Ver si ya compró curso
			SELECT id_compra
            FROM CursosComprados
            WHERE correo_estudiante = pCorreo
            AND id_curso = pId_curso;
        END IF;
        
        IF pOpc = 7 THEN #Traer todos los cursos comprados de un usuario
			SELECT	 cur.id_curso, cur.titulo, cur.descripcion, usu.nombre, curcom.fechaComprado, cur.precio
            FROM 	CursosComprados as curcom
            JOIN Curso as cur
            ON curcom.id_curso = cur.id_curso
            JOIN Usuario as usu
            ON cur.correo_escuela = usu.correo
            WHERE correo_estudiante = pCorreo
            ORDER BY curcom.id_compra DESC;
        END IF;
        
        IF pOpc = 8 THEN #Traer la cantidad de cursos comprados de un alumno
			SELECT	 COUNT(1) 'cursosComprados'
            FROM 	CursosComprados
            WHERE correo_estudiante = pCorreo;
        END IF;
        
        IF pOpc = 9 THEN #Traer la cantidad de cursos completados de un alumno
			SELECT	 COUNT(1) 'cursosTerminados'
            FROM 	CursosComprados
            WHERE correo_estudiante = pCorreo
				AND	terminado = 1;
        END IF;
        
         IF pOpc = 10 THEN #Traer la cantidad de alumnos de una escuela
			SELECT	 COUNT(1) 'cantAlumnos'
            FROM 	CursosComprados as curcom
            JOIN Curso as cur
            ON cur.id_curso = curcom.id_curso
            WHERE cur.correo_escuela = pCorreo;
        END IF;
        
        IF pOpc = 11 THEN #Diploma
			SELECT	 curcom.fechaTerminado, usu.nombre, cur.titulo
            FROM 	CursosComprados as curcom
            JOIN Curso as cur
            ON cur.id_curso = curcom.id_curso
            JOIN Usuario as usu
            ON cur.correo_escuela = usu.correo
            WHERE curcom.correo_estudiante = pCorreo
            AND	cur.id_curso = pId_curso
            AND terminado = 1;
        END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Curso_Categoria` (`pOpc` INT, `pId_curso_categoria` INT, `pId_curso` INT, `pNombre` VARCHAR(100))  BEGIN
		IF pOpc = 1 THEN
			INSERT INTO Curso_Categoria (id_curso, nombre)
			VALUES(pId_curso, pNombre);
        END IF;
		
        IF pOpc = 2 THEN 
			SELECT  id_curso_categoria,id_curso, nombre
            FROM Curso_Categoria;
        END IF;
        
        IF pOpc = 3 THEN 
			SELECT  id_curso_categoria,id_curso, nombre
            FROM Curso_Categoria
            WHERE id_curso_categoria = pId_curso_categoria;
        END IF; 
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Mensaje` (`pOpc` INT, `pId_mensaje` INT, `pCorreo_remitente` VARCHAR(50), `pCorreo_destinatario` VARCHAR(50), `pMensaje` TEXT, `pFecha` DATE, `pHora` TIME)  BEGIN
		IF pOpc = 1 THEN 
			INSERT INTO Mensaje(correo_remitente, correo_destinatario, mensaje, fecha, hora)
            VALUES (pCorreo_remitente, pCorreo_destinatario, pMensaje, NOW(), NOW());
        END IF;
        
        IF pOpc = 2 THEN
			SELECT  id_mensaje,correo_remitente, correo_destinatario, mensaje, fecha, hora
            FROM	Mensaje
            WHERE 	correo_remitente = pCorreo_remitente
            AND 	correo_destinatario = pCorreo_destinatario;
        END IF; 
        
        IF pOpc = 3 THEN
			SELECT  id_mensaje,correo_remitente, correo_destinatario, mensaje, CONCAT(fecha, " ",  hora) 'fechaHora'
			FROM	Mensaje
            WHERE 	(correo_remitente = pCorreo_remitente OR correo_destinatario = pCorreo_remitente)
            AND 	(correo_destinatario = pCorreo_destinatario OR correo_remitente = pCorreo_destinatario)
            ORDER BY id_mensaje;
        END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Multimedia` (`pOpc` INT, `pId_multimedia` INT, `pId_capitulo` INT, `pId_curso` INT, `pDatos_archivo` MEDIUMBLOB, `pNombrearchivo` TEXT, `pTipoarchivo` VARCHAR(30))  BEGIN 
		IF pOpc = 1 THEN 
			INSERT INTO Multimedia (id_capitulo, id_curso, datosArchivo, nombreArchivo, tipoArchivo)
            VALUES (pId_capitulo, pId_curso, pDatos_archivo, pNombrearchivo, pTipoarchivo);
        END IF; 
		
        IF pOpc = 2 THEN
			SELECT	id_multimedia, id_capitulo, id_curso,nombreArchivo, tipoArchivo
            FROM Multimedia
            WHERE id_curso = pId_curso 
            AND id_capitulo = pId_capitulo;
        END IF; 
        
        IF pOpc = 3 THEN
			SELECT	datosArchivo, tipoArchivo
            FROM Multimedia
            WHERE id_multimedia = pId_multimedia;
        END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ProgresoCapitulos` (`pOpc` INT, `pId_progresocap` INT, `pCorreo` VARCHAR(50), `pId_curso` INT, `pCapituloVistos` INT)  BEGIN
		IF pOpc = 1 THEN 
			INSERT INTO ProgresoCapitulos(correo_estudiante, id_curso, capitulosVistos)
            VALUES (pCorreo, pId_curso, pCapituloVistos);
        END IF; 
        
        IF pOpc = 2 THEN 
			SELECT  id_progresoCap ,correo_estudiante, id_curso, capitulosVistos
            FROM ProgresoCapitulos
            WHERE correo_estudiante = pCorreo;
        END IF; 
        
        IF pOpc = 3 THEN #obtener capitulosVistos
			SELECT  capitulosVistos
            FROM ProgresoCapitulos
            WHERE correo_estudiante = pCorreo
            AND id_curso = pId_curso;
        END IF;
        
        IF pOpc = 4 THEN #aumenta capitulo
        UPDATE 	ProgresoCapitulos 
			SET capitulosVistos = capitulosVistos + 1 
		WHERE 	correo_estudiante = pCorreo
			AND	id_curso = pId_curso;
        END IF;
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Usuario` (`pOpc` INT, `pCorreo` VARCHAR(30), `pNombre` VARCHAR(30), `pContrasena` VARCHAR(25), `pImgPerfil` MEDIUMBLOB, `pTipoImagen` TEXT, `pRol` INT, `pFecha` DATETIME, `pFechaMod` DATETIME)  BEGIN
    
    IF pOpc = 1 THEN #Insertar
		INSERT INTO Usuario VALUES(pCorreo, pNombre, pContrasena, pImgPerfil, pTipoImagen, pRol, NOW(), NOW() );
	END IF;
    
    IF pOpc = 2 THEN #Actualizar
		UPDATE Usuario
			SET nombre = pNombre, contrasena = pContrasena, imgPerfil = pImgPerfil, tipoImagen = pTipoImagen, fechaModif = NOW()
        WHERE correo = pCorreo;
	END IF;
    
    IF pOpc = 3 THEN #Eliminar
		DELETE FROM Usuario
        WHERE correo = pCorreo;
	END IF;
    
    IF pOpc = 4 THEN #Consulta un usuario
		SELECT Correo, Nombre,Contrasena, ImgPerfil, tipoImagen, Rol, Fecha, FechaModif
        FROM Usuario
        WHERE correo = pCorreo;
    END IF;
    
    IF pOpc = 5 THEN #TRAER TODOS LOS USUARIOS 
		SELECT Correo, Nombre, Contrasena, ImgPerfil, tipoImagen, Rol, Fecha, FechaModif 
        FROM Usuario
        ORDER BY correo;
	END IF;
    
    IF pOpc = 6 THEN #LOGIN 
		SELECT Correo, Contrasena
        FROM Usuario
        WHERE correo = pCorreo 
        AND contrasena = pContrasena;
	END IF;
    
    IF pOpc = 7 THEN #MOSTRAR IMAGEN
		SELECT imgPerfil, tipoImagen
        FROM Usuario
        WHERE correo = pCorreo;
	END IF;
    
    IF pOpc = 8 THEN #TRAER TODOS LOS USUARIOS EXCEPTO EL ACTUAL
		SELECT Correo, Nombre, Contrasena, Rol, Fecha, FechaModif 
        FROM Usuario
        WHERE Correo <> pCorreo
        ORDER BY Nombre;
	END IF;
    
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `cursosVendidos` (`pId_curso` INT) RETURNS INT(11) BEGIN
DECLARE totalVendidos INT;
	SELECT COUNT(1) INTO totalVendidos
    FROM cursoscomprados as curcom
    JOIN Curso as cur
    ON curcom.id_curso = cur.id_curso
    WHERE cur.id_curso = pId_curso;
    
    RETURN totalVendidos;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `progresoCurso` (`pId_curso` INT, `pCorreo` VARCHAR(100)) RETURNS INT(11) BEGIN
DECLARE progreso INT;
	SELECT capitulosVistos INTO progreso
    FROM progresocapitulos
    WHERE id_curso = pId_curso
    AND correo_estudiante = pCorreo;
    
    RETURN progreso;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `totalVotos` (`pId_curso` INT) RETURNS INT(11) BEGIN
DECLARE totalVotos INT;
	SELECT COUNT(1) INTO totalVotos
    FROM Comentarios as com
    JOIN Curso as cur
    ON com.id_curso = cur.id_curso
    WHERE cur.id_curso = pId_curso;
    
    RETURN totalVotos;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulocurso`
--

CREATE TABLE `capitulocurso` (
  `id_capitulo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL,
  `esGratis` bit(1) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `video` longblob DEFAULT NULL,
  `tipoVideo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrocursos`
--

CREATE TABLE `carrocursos` (
  `id_carro_cursos` int(11) NOT NULL,
  `id_carro` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carroestudiante`
--

CREATE TABLE `carroestudiante` (
  `id_carro` int(11) NOT NULL,
  `correo_estudiante` varchar(50) NOT NULL,
  `compraTerminada` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `correo_estudiante` varchar(50) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `voto` bit(1) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `comentarios`
--
DELIMITER $$
CREATE TRIGGER `puntajePositivoCursoComentario` AFTER INSERT ON `comentarios` FOR EACH ROW BEGIN
	IF NEW.voto = 1 THEN
		UPDATE Curso
        SET puntaje = puntaje + 1
        WHERE id_curso = new.id_curso;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `correo_escuela` varchar(50) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `cantidadCapitulos` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `imgCurso` mediumblob DEFAULT NULL,
  `tipoImagen` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `desc_corta` varchar(50) DEFAULT NULL,
  `puntaje` float DEFAULT NULL,
  `deshabilitado` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursoscomprados`
--

CREATE TABLE `cursoscomprados` (
  `id_compra` int(11) NOT NULL,
  `correo_estudiante` varchar(50) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `fechaComprado` datetime DEFAULT NULL,
  `fechaTerminado` datetime DEFAULT NULL,
  `terminado` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `cursoscomprados`
--
DELIMITER $$
CREATE TRIGGER `despuesDeComprar` AFTER INSERT ON `cursoscomprados` FOR EACH ROW BEGIN
	INSERT INTO ProgresoCapitulos(correo_estudiante, id_curso, capitulosVistos)
            VALUES (NEW.correo_estudiante, NEW.id_curso, 0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `cursosmasvendidos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `cursosmasvendidos` (
`id_curso` int(11)
,`correo_escuela` varchar(50)
,`titulo` varchar(100)
,`cantidadCapitulos` int(11)
,`precio` float
,`descripcion` text
,`desc_corta` varchar(50)
,`puntaje` float
,`deshabilitado` bit(1)
,`Votos Totales` int(11)
,`curVen` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `cursospopulares`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `cursospopulares` (
`id_curso` int(11)
,`correo_escuela` varchar(50)
,`titulo` varchar(100)
,`cantidadCapitulos` int(11)
,`precio` float
,`descripcion` text
,`desc_corta` varchar(50)
,`puntaje` float
,`deshabilitado` bit(1)
,`Votos Totales` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_categoria`
--

CREATE TABLE `curso_categoria` (
  `id_curso_categoria` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `correo_remitente` varchar(50) NOT NULL,
  `correo_destinatario` varchar(50) NOT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `id_multimedia` int(11) NOT NULL,
  `id_capitulo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `datosArchivo` mediumblob DEFAULT NULL,
  `nombreArchivo` text DEFAULT NULL,
  `tipoArchivo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progresocapitulos`
--

CREATE TABLE `progresocapitulos` (
  `id_progresoCap` int(11) NOT NULL,
  `correo_estudiante` varchar(50) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `capitulosVistos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `traertodascategorias`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `traertodascategorias` (
`nombre` varchar(100)
,`descripcion` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `ultimoscursos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `ultimoscursos` (
`id_curso` int(11)
,`correo_escuela` varchar(50)
,`titulo` varchar(100)
,`cantidadCapitulos` int(11)
,`precio` float
,`descripcion` text
,`desc_corta` varchar(50)
,`puntaje` float
,`deshabilitado` bit(1)
,`Votos Totales` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `correo` varchar(50) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `imgPerfil` mediumblob DEFAULT NULL,
  `tipoImagen` text DEFAULT NULL,
  `rol` bit(1) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `fechaModif` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `insertarPrimerCarroUsuario` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
	IF NEW.rol = 1 THEN
		INSERT INTO CarroEstudiante(correo_estudiante, compraTerminada)
            VALUES(NEW.correo, 0);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura para la vista `cursosmasvendidos`
--
DROP TABLE IF EXISTS `cursosmasvendidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cursosmasvendidos`  AS SELECT `cur`.`id_curso` AS `id_curso`, `cur`.`correo_escuela` AS `correo_escuela`, `cur`.`titulo` AS `titulo`, `cur`.`cantidadCapitulos` AS `cantidadCapitulos`, `cur`.`precio` AS `precio`, `cur`.`descripcion` AS `descripcion`, `cur`.`desc_corta` AS `desc_corta`, `cur`.`puntaje` AS `puntaje`, `cur`.`deshabilitado` AS `deshabilitado`, `totalVotos`(`cur`.`id_curso`) AS `Votos Totales`, `cursosVendidos`(`cur`.`id_curso`) AS `curVen` FROM `curso` AS `cur` ORDER BY `cursosVendidos`(`cur`.`id_curso`) DESC LIMIT 0, 20 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `cursospopulares`
--
DROP TABLE IF EXISTS `cursospopulares`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cursospopulares`  AS SELECT `curso`.`id_curso` AS `id_curso`, `curso`.`correo_escuela` AS `correo_escuela`, `curso`.`titulo` AS `titulo`, `curso`.`cantidadCapitulos` AS `cantidadCapitulos`, `curso`.`precio` AS `precio`, `curso`.`descripcion` AS `descripcion`, `curso`.`desc_corta` AS `desc_corta`, `curso`.`puntaje` AS `puntaje`, `curso`.`deshabilitado` AS `deshabilitado`, `totalVotos`(`curso`.`id_curso`) AS `Votos Totales` FROM `curso` ORDER BY `curso`.`puntaje`/ `totalVotos`(`curso`.`id_curso`) * 100 DESC LIMIT 0, 20 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `traertodascategorias`
--
DROP TABLE IF EXISTS `traertodascategorias`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `traertodascategorias`  AS SELECT `categoria`.`nombre` AS `nombre`, `categoria`.`descripcion` AS `descripcion` FROM `categoria` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `ultimoscursos`
--
DROP TABLE IF EXISTS `ultimoscursos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ultimoscursos`  AS SELECT `curso`.`id_curso` AS `id_curso`, `curso`.`correo_escuela` AS `correo_escuela`, `curso`.`titulo` AS `titulo`, `curso`.`cantidadCapitulos` AS `cantidadCapitulos`, `curso`.`precio` AS `precio`, `curso`.`descripcion` AS `descripcion`, `curso`.`desc_corta` AS `desc_corta`, `curso`.`puntaje` AS `puntaje`, `curso`.`deshabilitado` AS `deshabilitado`, `totalVotos`(`curso`.`id_curso`) AS `Votos Totales` FROM `curso` ORDER BY `curso`.`id_curso` DESC LIMIT 0, 20 ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `capitulocurso`
--
ALTER TABLE `capitulocurso`
  ADD PRIMARY KEY (`id_capitulo`),
  ADD KEY `FK_CAPITULO_CURSO` (`id_curso`);

--
-- Indices de la tabla `carrocursos`
--
ALTER TABLE `carrocursos`
  ADD PRIMARY KEY (`id_carro_cursos`),
  ADD KEY `FK_CARROCURSO_CARRO` (`id_carro`),
  ADD KEY `FK_CARROCURSO_CURSO` (`id_curso`);

--
-- Indices de la tabla `carroestudiante`
--
ALTER TABLE `carroestudiante`
  ADD PRIMARY KEY (`id_carro`),
  ADD KEY `FK_CARRO_ESTUDIANTE` (`correo_estudiante`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `FK_COMENTARIOS_USUARIO` (`correo_estudiante`),
  ADD KEY `FK_COMENTARIOS_CURSO` (`id_curso`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `FK_CURSO_ESCUELA` (`correo_escuela`);

--
-- Indices de la tabla `cursoscomprados`
--
ALTER TABLE `cursoscomprados`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `FK_COMPRADOS_ESTUDIANTE` (`correo_estudiante`),
  ADD KEY `FK_COMPRADOS_CURSO` (`id_curso`);

--
-- Indices de la tabla `curso_categoria`
--
ALTER TABLE `curso_categoria`
  ADD PRIMARY KEY (`id_curso_categoria`),
  ADD KEY `FK_CC_CURSO` (`id_curso`),
  ADD KEY `FK_CC_CATEGORIA` (`nombre`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `FK_MENSAJE_REMITENTE` (`correo_remitente`),
  ADD KEY `FK_MENSAJE_DESTINATARIO` (`correo_destinatario`);

--
-- Indices de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`id_multimedia`),
  ADD KEY `FK_MULTIMEDIA_CAPITULO` (`id_capitulo`),
  ADD KEY `FK_MULTIMEDIA_CURSO` (`id_curso`);

--
-- Indices de la tabla `progresocapitulos`
--
ALTER TABLE `progresocapitulos`
  ADD PRIMARY KEY (`id_progresoCap`),
  ADD KEY `FK_PROGRESO_ESTUDIANTE` (`correo_estudiante`),
  ADD KEY `FK_PROGRESO_CURSO` (`id_curso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `capitulocurso`
--
ALTER TABLE `capitulocurso`
  MODIFY `id_capitulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrocursos`
--
ALTER TABLE `carrocursos`
  MODIFY `id_carro_cursos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carroestudiante`
--
ALTER TABLE `carroestudiante`
  MODIFY `id_carro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cursoscomprados`
--
ALTER TABLE `cursoscomprados`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `curso_categoria`
--
ALTER TABLE `curso_categoria`
  MODIFY `id_curso_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `id_multimedia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `progresocapitulos`
--
ALTER TABLE `progresocapitulos`
  MODIFY `id_progresoCap` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `capitulocurso`
--
ALTER TABLE `capitulocurso`
  ADD CONSTRAINT `FK_CAPITULO_CURSO` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Filtros para la tabla `carrocursos`
--
ALTER TABLE `carrocursos`
  ADD CONSTRAINT `FK_CARROCURSO_CARRO` FOREIGN KEY (`id_carro`) REFERENCES `carroestudiante` (`id_carro`),
  ADD CONSTRAINT `FK_CARROCURSO_CURSO` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Filtros para la tabla `carroestudiante`
--
ALTER TABLE `carroestudiante`
  ADD CONSTRAINT `FK_CARRO_ESTUDIANTE` FOREIGN KEY (`correo_estudiante`) REFERENCES `usuario` (`correo`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `FK_COMENTARIOS_CURSO` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `FK_COMENTARIOS_USUARIO` FOREIGN KEY (`correo_estudiante`) REFERENCES `usuario` (`correo`);

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `FK_CURSO_ESCUELA` FOREIGN KEY (`correo_escuela`) REFERENCES `usuario` (`correo`);

--
-- Filtros para la tabla `cursoscomprados`
--
ALTER TABLE `cursoscomprados`
  ADD CONSTRAINT `FK_COMPRADOS_CURSO` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `FK_COMPRADOS_ESTUDIANTE` FOREIGN KEY (`correo_estudiante`) REFERENCES `usuario` (`correo`);

--
-- Filtros para la tabla `curso_categoria`
--
ALTER TABLE `curso_categoria`
  ADD CONSTRAINT `FK_CC_CATEGORIA` FOREIGN KEY (`nombre`) REFERENCES `categoria` (`nombre`),
  ADD CONSTRAINT `FK_CC_CURSO` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `FK_MENSAJE_DESTINATARIO` FOREIGN KEY (`correo_destinatario`) REFERENCES `usuario` (`correo`),
  ADD CONSTRAINT `FK_MENSAJE_REMITENTE` FOREIGN KEY (`correo_remitente`) REFERENCES `usuario` (`correo`);

--
-- Filtros para la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `FK_MULTIMEDIA_CAPITULO` FOREIGN KEY (`id_capitulo`) REFERENCES `capitulocurso` (`id_capitulo`),
  ADD CONSTRAINT `FK_MULTIMEDIA_CURSO` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Filtros para la tabla `progresocapitulos`
--
ALTER TABLE `progresocapitulos`
  ADD CONSTRAINT `FK_PROGRESO_CURSO` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `FK_PROGRESO_ESTUDIANTE` FOREIGN KEY (`correo_estudiante`) REFERENCES `usuario` (`correo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
