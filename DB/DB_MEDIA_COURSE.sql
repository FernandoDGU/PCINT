-- CREATE DATABASE MEDIA_COURSE; 

-- USE MEDIA_COURSE; 


DROP TABLE IF EXISTS CarroCursos;
DROP TABLE IF EXISTS CarroEstudiante;
DROP TABLE IF EXISTS CursosComprados;
DROP TABLE IF EXISTS Comentarios;
DROP TABLE IF EXISTS ProgresoCapitulos;
DROP TABLE IF EXISTS Multimedia;
DROP TABLE IF EXISTS Mensaje;
DROP TABLE IF EXISTS Curso_Categoria;
DROP TABLE IF EXISTS CapituloCurso;
DROP TABLE IF EXISTS Curso;
DROP TABLE IF EXISTS Categoria;
DROP TABLE IF EXISTS Usuario;

CREATE TABLE IF NOT EXISTS Usuario (
	correo 		VARCHAR(50)	NOT NULL PRIMARY KEY,
    nombre		VARCHAR(20) NOT NULL, 
    contrasena	VARCHAR(20) NOT NULL,
    imgPerfil	MEDIUMBLOB,
    tipoImagen 	TEXT,
    rol			BIT, -- 0 ESCUELA/INSTITUCIÓN, 1 ESTUDIANTE
    fecha		DATETIME,
    fechaModif	DATETIME
); 

CREATE TABLE IF NOT EXISTS Categoria (
	id_categoria 	INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nombre			VARCHAR(100),
    descripcion		TEXT
);



CREATE TABLE IF NOT EXISTS Curso (
	id_curso 		INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    correo_escuela	VARCHAR(50) NOT NULL,
    titulo			VARCHAR(100),
    cantidadCapitulos INT,
    precio			FLOAT,
    imgCurso		MEDIUMBLOB,
    tipoImagen 		TEXT,
    descripcion		TEXT,
    desc_corta		VARCHAR(50),
    puntaje			FLOAT,
    deshabilitado	BIT default 0,
	
    CONSTRAINT FK_CURSO_ESCUELA FOREIGN KEY (correo_escuela) REFERENCES Usuario(correo)
);

CREATE TABLE IF NOT EXISTS CapituloCurso (
	id_capitulo 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_curso			INT NOT NULL,
    orden				INT,
    esGratis			BIT, 
    titulo				VARCHAR(100),
    descripcion 		TEXT,
    video				LONGBLOB,
    tipoVideo 			TEXT,
    
    CONSTRAINT FK_CAPITULO_CURSO FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

CREATE TABLE IF NOT EXISTS Curso_Categoria (
	id_curso_categoria	INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	id_curso 		INT NOT NULL,
    id_categoria	INT NOT NULL,
    
	CONSTRAINT FK_CC_CURSO FOREIGN KEY (id_curso) REFERENCES Curso(id_curso),
	CONSTRAINT FK_CC_CATEGORIA FOREIGN KEY (id_categoria) REFERENCES Categoria(id_categoria)
);

CREATE TABLE IF NOT EXISTS Mensaje (
	id_mensaje 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    correo_remitente VARCHAR(50) NOT NULL,
    correo_destinatario VARCHAR(50) NOT NULL,
    mensaje 		TEXT,
    fecha			DATE, 
    hora 			TIME,
    
    CONSTRAINT FK_MENSAJE_REMITENTE FOREIGN KEY (correo_remitente) REFERENCES Usuario(correo),
    CONSTRAINT FK_MENSAJE_DESTINATARIO FOREIGN KEY (correo_destinatario) REFERENCES Usuario(correo)
);

CREATE TABLE IF NOT EXISTS Multimedia (
	id_multimedia 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_capitulo			INT NOT NULL,
    id_curso			INT NOT NULL,
    datosArchivo		MEDIUMBLOB,
	nombreArchivo		TEXT,
    tipoArchivo			VARCHAR(30),
    
    CONSTRAINT FK_MULTIMEDIA_CAPITULO FOREIGN KEY (id_capitulo) REFERENCES CapituloCurso(id_capitulo),
    CONSTRAINT FK_MULTIMEDIA_CURSO FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

CREATE TABLE IF NOT EXISTS ProgresoCapitulos (
	id_progresoCap 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY, 
    correo_estudiante 	VARCHAR(50) NOT NULL,
    id_curso			INT NOT NULL,
    capitulosVistos		INT NOT NULL,
    
    CONSTRAINT FK_PROGRESO_ESTUDIANTE FOREIGN KEY (correo_estudiante) REFERENCES Usuario(correo),
    CONSTRAINT FK_PROGRESO_CURSO FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

CREATE TABLE IF NOT EXISTS Comentarios (
	id_comentario 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    correo_estudiante	VARCHAR (50) NOT NULL,
    id_curso 			INT NOT NULL,
    comentario			TEXT,
    voto 				BIT,
    fecha				DATETIME,
    
    CONSTRAINT FK_COMENTARIOS_USUARIO FOREIGN KEY (correo_estudiante) REFERENCES Usuario(correo),
    CONSTRAINT FK_COMENTARIOS_CURSO FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

CREATE TABLE IF NOT EXISTS CursosComprados (
	id_compra 			INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    correo_estudiante	VARCHAR(50) NOT NULL,
    id_curso			INT NOT NULL,
    fechaComprado		DATETIME,
    fechaTerminado		DATETIME,
	terminado			BIT,
    
	CONSTRAINT FK_COMPRADOS_ESTUDIANTE FOREIGN KEY (correo_estudiante) REFERENCES Usuario(correo),
    CONSTRAINT FK_COMPRADOS_CURSO FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

CREATE TABLE IF NOT EXISTS CarroEstudiante ( 
	id_carro 			INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    correo_estudiante 	VARCHAR(50) NOT NULL,
    compraTerminada 	BIT,
    
    CONSTRAINT FK_CARRO_ESTUDIANTE FOREIGN KEY (correo_estudiante) REFERENCES Usuario(correo)
);


CREATE TABLE IF NOT EXISTS CarroCursos ( 
	id_carro_cursos		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	id_carro 			INT NOT NULL,
    id_curso 			INT NOT NULL,
    CONSTRAINT FK_CARROCURSO_CARRO FOREIGN KEY (id_carro) REFERENCES CarroEstudiante(id_carro),
    CONSTRAINT FK_CARROCURSO_CURSO FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);



------------------------------


DROP PROCEDURE IF EXISTS sp_Usuario;
DROP PROCEDURE IF EXISTS sp_Categoria; 
DROP PROCEDURE IF EXISTS sp_Curso; 
DROP PROCEDURE IF EXISTS sp_CapituloCurso;
DROP PROCEDURE IF EXISTS sp_Curso_Categoria;
DROP PROCEDURE IF EXISTS sp_Mensaje;
DROP PROCEDURE IF EXISTS sp_Multimedia;
DROP PROCEDURE IF EXISTS sp_Comentarios;
DROP PROCEDURE IF EXISTS sp_ProgresoCapitulos;
DROP PROCEDURE IF EXISTS sp_CursosComprados;
DROP PROCEDURE IF EXISTS sp_CarroEstudiante;
DROP PROCEDURE IF EXISTS sp_CarroCursos;




DELIMITER $$
CREATE PROCEDURE sp_Usuario  (
	pOpc			INT,
    pCorreo			VARCHAR(30),
    pNombre			VARCHAR(30),
    pContrasena		VARCHAR(25),
    pImgPerfil		MEDIUMBLOB,
    pTipoImagen		TEXT,
    pRol			INT,
    pFecha			DATETIME,
    pFechaMod		DATETIME
)
BEGIN
    
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
    
END $$

DELIMITER ; 


DELIMITER $$
CREATE PROCEDURE sp_Categoria (
		pOpc 			INT, 
        pId				INT, 
        pNombre 		VARCHAR(100),
        pDescripcion 	TEXT
)
BEGIN
		IF pOpc = 1 THEN 
			INSERT INTO Categoria(descripcion, nombre)
            VALUES (pDescripcion, pNombre);
		END IF; 
        
        IF pOpc = 2 THEN
			SELECT id_categoria, nombre, descripcion
            FROM Categoria;
        END IF;
        
        IF pOpc = 3 THEN 
			SELECT id_categoria, nombre, descripcion
            FROM Categoria
            WHERE id_categoria = pId;
        END IF; 
        
END $$ 

DELIMITER ; 


DELIMITER $$ 
CREATE PROCEDURE sp_Curso(
	pOpc 			INT,
    pId				INT,
    pCorreoEscuela VARCHAR(50),
    pTitulo			VARCHAR(100),
    pCantCapitulos	INT,
    pPrecio			FLOAT,
    pImgCurso		MEDIUMBLOB,
    pTipoImagen		TEXT,
    pDescripcion	TEXT,
    pDesc_corta		VARCHAR(50),
    pPuntaje		FLOAT,
    pDeshabilitado	BIT
)
BEGIN
		IF pOpc = 1 THEN
        INSERT INTO Curso(correo_escuela, titulo, cantidadCapitulos, precio, imgCurso, tipoImagen, descripcion, desc_corta, puntaje, deshabilitado)
        VALUES (pCorreoEscuela, pTitulo, pCantCapitulos, pPrecio, pImgCurso, pTipoImagen,pDescripcion, pDesc_corta,pPuntaje, pDeshabilitado);
        END IF;
        
        IF pOpc = 2 THEN 
        SELECT id_curso,correo_escuela, titulo, cantidadCapitulos, precio, imgCurso, tipoImagen, descripcion, desc_corta,puntaje, deshabilitado
        FROM Curso;
        END IF;
        
        If pOpc = 3 THEN 
		SELECT id_curso,correo_escuela, titulo, cantidadCapitulos, precio, imgCurso, tipoImagen, descripcion, desc_corta,puntaje, deshabilitado
        FROM Curso
        WHERE id_curso = pId;
        END IF;
        
END $$
DELIMITER ;


DELIMITER $$

CREATE PROCEDURE sp_CapituloCurso (
	pOpc	INT,
    pId_capitulo	INT,
    pId_curso		INT,
    pOrden			INT,
    pGratis			BIT,
    pTitulo			VARCHAR(100),
    pDescripcion	TEXT,
    pVideo			LONGBLOB,
    pTipoVideo		TEXT
)
BEGIN
		IF pOpc = 1 THEN 
			INSERT INTO CapituloCurso(id_curso, orden, esGratis, titulo, descripcion, video, tipoVideo)
            VALUES(pId_curso, pOrden, pGratis, pTitulo, pDescripcion, pVideo, pTipoVideo);
        END IF;
        
        IF pOpc = 2 THEN
			SELECT id_capitulo, id_curso, orden, esGratis, titulo, descripcion, video, tipoVideo
            FROM CapituloCurso;
        END IF;
        
        IF pOpc = 3 THEN 
			SELECT id_capitulo, id_curso, orden, esGratis, titulo, descripcion, video, tipoVideo
            FROM CapituloCurso
            WHERE id_capitulo = pId_capitulo;
        END IF; 

END$$
DELIMITER ; 


DELIMITER $$
CREATE PROCEDURE sp_Curso_Categoria (
	pOpc 				INT, 
    pId_curso_categoria	INT,
    pId_curso			INT,
    pId_categoria		INT
)
BEGIN
		IF pOpc = 1 THEN
			INSERT INTO Curso_Categoria (id_curso, id_categoria)
			VALUES(pId_curso, pId_categoria);
        END IF;
		
        IF pOpc = 2 THEN 
			SELECT  id_curso_categoria,id_curso, id_categoria
            FROM Curso_Categoria;
        END IF;
        
        IF pOpc = 3 THEN 
			SELECT  id_curso_categoria,id_curso, id_categoria
            FROM Curso_Categoria
            WHERE id_curso_categoria = pId_curso_categoria;
        END IF; 
        
END $$
DELIMITER ;


DELIMITER $$

CREATE PROCEDURE sp_Mensaje (
	pOpc 					INT,
    pId_mensaje				INT,
    pCorreo_remitente		VARCHAR(50),
    pCorreo_destinatario 	VARCHAR(50),
    pMensaje				TEXT,
    pFecha					DATE,
    pHora					TIME
)
BEGIN
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
END $$
DELIMITER ; 


DELIMITER $$ 
CREATE PROCEDURE sp_Multimedia (
	pOpc INT,
    pId_multimedia	INT,
    pId_capitulo 	INT,
    pId_curso		INT,
    pDatos_archivo	MEDIUMBLOB,
    pNombrearchivo	TEXT,
    pTipoarchivo	VARCHAR(30)
)
BEGIN 
		IF pOpc = 1 THEN 
			INSERT INTO Multimedia (id_capitulo, id_curso, datosArchivo, nombreArchivo, tipoArchivo)
            VALUES (pId_capitulo, pId_curso, pDatos_archivo, pNombrearchivo, pTipoarchivo);
        END IF; 
		
        IF pOpc = 2 THEN
			SELECT	id_multimedia, id_capitulo, id_curso, datosArchivo, nombreArchivo, tipoArchivo
            FROM Multimedia
            WHERE id_curso = pId_curso 
            AND id_capitulo = pId_capitulo;
        END IF; 
END $$
DELIMITER ;


DELIMITER $$
CREATE PROCEDURE sp_ProgresoCapitulos(
	pOpc 			INT, 
    pId_progresocap	INT,
    pCorreo			VARCHAR(50),
    pId_curso		INT,
    pCapituloVistos	INT
)
BEGIN
		IF pOpc = 1 THEN 
			INSERT INTO ProgresoCapitulos(correo_estudiante, id_curso, capitulosVistos)
            VALUES (pCorreo, pId_curso, pCapituloVistos);
        END IF; 
        
        IF pOpc = 2 THEN 
			SELECT  id_progresoCap ,correo_estudiante, id_curso, capitulosVistos
            FROM ProgresoCapitulos
            WHERE correo_estudiante = pCorreo;
        END IF; 
        
END$$
DELIMITER ;


 DELIMITER $$ 
 CREATE PROCEDURE sp_Comentarios(
	pOpc 			INT,
    pId_comentario	INT,
    pCorreo			VARCHAR(50),
    pId_curso		INT,
    pComentario		TEXT,
    pVoto			BIT
 )
 BEGIN 
 
	IF pOpc = 1 THEN
		INSERT INTO Comentarios (correo_estudiante,  id_curso, comentario, voto, fecha)
        VALUES(pCorreo, pId_curso, pComentario, pVoto, NOW());
	END IF; 
	
    IF pOpc  = 2 THEN 
		SELECT id_comentario, correo_estudiante,  id_curso, comentario, voto, fecha
        FROM Comentarios 
        WHERE id_curso = pId_curso;
    END IF;
    
 END $$
 
 DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_CursosComprados (
	pOpc 			INT,
    pId_compra		INT,
    pCorreo			VARCHAR(50),
    pId_curso		INT,
    pFechaTerminado	DATETIME,
    pTerminado		BIT
)
BEGIN 
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
END $$
DELIMITER ; 

DELIMITER $$
CREATE PROCEDURE sp_CarroEstudiante(
	pOpc 				INT, 
    pId_carro			INT,
    pCorreo				VARCHAR(50),
    pCompraTerminada	BIT
)
BEGIN 
		IF pOpc = 1 THEN 
			INSERT INTO CarroEstudiante(correo_estudiante, compraTerminada)
            VALUES(pCorreo, pCompraTerminada);
        END IF;
        
        IF pOpc = 2 THEN 
			SELECT  id_carro , correo_estudiante, compraTerminada
            FROM CarroEstudiante
            WHERE correo_estudiante = pCorreo;
        END IF;
        
END $$
DELIMITER ; 


DELIMITER $$

CREATE PROCEDURE sp_CarroCursos (
	pOpc 			INT,
    pId_carro_curso	INT,
    pId_carro		INT,
    pId_curso		INT
)
BEGIN
	IF pOpc = 1 THEN
		INSERT INTO CarroCursos(id_carro, id_curso)
        VALUES (pId_carro, pId_curso);
    END IF;
    
    IF pOpc = 2 THEN 
		SELECT id_carro_cursos, id_carro, id_curso
        FROM CarroCursos
        WHERE id_carro_cursos = pId_carro_curso;
    END IF;
    
END $$

DELIMITER ;



