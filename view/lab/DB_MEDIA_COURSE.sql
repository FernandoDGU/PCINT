-- CREATE DATABASE MEDIA_COURSE; 

-- USE MEDIA_COURSE; 


DROP TABLE IF EXISTS Carro;
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
	correo 		VARCHAR(100)	NOT NULL PRIMARY KEY,
    nombre		VARCHAR(100) NOT NULL, 
    contrasena	VARCHAR(20) NOT NULL,
    imgPerfil	BLOB,
    rol			BIT, -- 0 ESCUELA, 1 ESTUDIANTE
    fecha		DATETIME,
    fechaModif	DATETIME
); 

CREATE TABLE IF NOT EXISTS Categoria (
	id_categoria 	INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nombre			VARCHAR(100),
    descripcion		VARCHAR(250)
);

CREATE TABLE IF NOT EXISTS Curso (
	id_curso 		INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    correo_escuela	VARCHAR(60) NOT NULL,
    titulo			VARCHAR(100),
    cantidadCapitulos INT,
    precio			FLOAT,
    imgCurso		BLOB,
    descripcion		VARCHAR(250),
    desc_corta		VARCHAR(100),
    puntaje			FLOAT,
	
    FOREIGN KEY (correo_escuela) REFERENCES Usuario(correo)
);

CREATE TABLE IF NOT EXISTS CapituloCurso (
	id_capitulo 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_curso			INT NOT NULL,
    orden				INT,
    esGratis			BIT, 
    titulo				VARCHAR(100),
    descripcion 		VARCHAR(250),
    video				VARCHAR(250),
    
    FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

CREATE TABLE IF NOT EXISTS Curso_Categoria (
	id_curso 		INT NOT NULL,
    id_categoria	INT NOT NULL PRIMARY KEY NOT NULL,
    
	FOREIGN KEY (id_curso) REFERENCES Curso(id_curso),
	FOREIGN KEY (id_categoria) REFERENCES Categoria(id_categoria)
);

CREATE TABLE IF NOT EXISTS Mensaje (
	id_mensaje 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    correo_remitente VARCHAR(100) NOT NULL,
    correo_destinatario VARCHAR(100) NOT NULL,
    mensaje 		VARCHAR(250),
    fecha			DATE, 
    hora 			TIME,
    
    FOREIGN KEY (correo_remitente) REFERENCES Usuario(correo),
    FOREIGN KEY (correo_destinatario) REFERENCES Usuario(correo)
);

CREATE TABLE IF NOT EXISTS Multimedia (
	id_multimedia 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    id_capitulo			INT NOT NULL,
    id_curso			INT NOT NULL,
    rutaArchivo			VARCHAR(200),
	nombreArchivo		VARCHAR(100),
    tipoArchivo			VARCHAR(30),
    
    FOREIGN KEY (id_capitulo) REFERENCES CapituloCurso(id_capitulo),
    FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

CREATE TABLE IF NOT EXISTS ProgresoCapitulos (
	id_progresoCap 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY, 
    correo_estudiante 	VARCHAR(100) NOT NULL,
    id_curso			INT NOT NULL,
    capitulosVistos		INT NOT NULL,
    
    FOREIGN KEY (correo_estudiante) REFERENCES Usuario(correo),
    FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

CREATE TABLE IF NOT EXISTS Comentarios (
	id_comentario 		INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    correo_estudiante	VARCHAR (100) NOT NULL,
    id_curso 			INT NOT NULL,
    comentario			VARCHAR(200),
    voto 				BIT,
    fecha				DATETIME,
    
    FOREIGN KEY (correo_estudiante) REFERENCES Usuario(correo),
    FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

CREATE TABLE IF NOT EXISTS CursosComprados (
	id_compra 			INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    correo_estudiante	VARCHAR(100) NOT NULL,
    id_curso			INT NOT NULL,
    fecha				DATETIME,
	terminado			BIT,
    
	FOREIGN KEY (correo_estudiante) REFERENCES Usuario(correo),
    FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

CREATE TABLE IF NOT EXISTS Carro ( 
	id_carro 			INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    correo_estudiante 	VARCHAR(100) NOT NULL,
    id_curso 			INT NOT NULL,
    
    FOREIGN KEY (correo_estudiante) REFERENCES Usuario(correo),
    FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);

/* -------------------------------------------------------------- */
-- Stored procedure 

DROP PROCEDURE IF EXISTS sp_Usuario;

DELIMITER $$
CREATE PROCEDURE sp_Usuario  (
	pOpc			INT,
    pCorreo			VARCHAR(30),
    pNombre			VARCHAR(30),
    pContrasena		VARCHAR(25),
    pImgPerfil		VARCHAR(250),
    pRol			INT,
    pFecha			DATETIME,
    pFechaMod		DATETIME
)
BEGIN
	DECLARE i INT; 
    SET i = 0;
    
    IF pOpc = 1 THEN #Insertar o moficar
		REPLACE Usuario VALUES(pCorreo, pNombre, pContrasena, pImgPerfil, pRol, pFecha,pFechaMod );
	END IF;
    
    IF pOpc = 2 THEN #Eliminar
		DELETE FROM Usuario
        WHERE correo = pCorreo;
	END IF;
    
    IF pOpc = 3 THEN #Consulta un usuario
		SELECT Correo, Nombre,Contrasena, ImgPerfil, Rol, Fecha, FechaModif
        FROM Usuario
        WHERE correo = pCorreo;
    END IF;
    
    IF pOpc = 4 THEN #TRAER TODOS LOS USUARIOS 
		SELECT Correo, Nombre, Contrasena, ImgPerfil, Rol, Fecha, FechaModif 
        FROM Usuario
        ORDER BY correo;
	END IF;
    
    IF pOpc = 5 THEN #LOGIN 
		SELECT Correo, Nombre,Contrasena, ImgPerfil, Rol, Fecha, FechaModif
        FROM Usuario
        WHERE correo = pCorreo 
        AND contrasena = pContrasena;
	END IF;
    
END $$

DELIMITER ; 

SELECT * FROM Usuario;
CALL sp_Usuario (1,'Darien@gmail.com', 'Darien', '1231', 'Piolin.jpg', 1, null, null);
CALL sp_Usuario (1,'fer@gmail.com', 'fer', '1231', 'Piolin.jpg', 1, null, null);

-- Modifica
CALL sp_Usuario (1,'Darien@gmail.com', 'Darien', 'asdadasda', 'Piolin.jpg', 1, null, null);

CALL sp_Usuario (2,'fer@gmail.com', null, null, null, null, null, null);

CALL sp_Usuario (3,'Darien@gmail.com', null, null, null, null, null, null);

CALL sp_Usuario (4,null, null, null, null, null, null, null);
