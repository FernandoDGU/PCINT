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
	correo 		VARCHAR(50)	NOT NULL PRIMARY KEY,
    nombre		VARCHAR(20) NOT NULL, 
    contrasena	VARCHAR(20) NOT NULL,
    imgPerfil	BLOB,
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
    imgCurso		BLOB,
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
    video				TEXT,
    
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
    rutaArchivo			TEXT,
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
    
    IF pOpc = 1 THEN #Insertar o moficar
		INSERT INTO Usuario VALUES(pCorreo, pNombre, pContrasena, pImgPerfil, pRol, NOW(), NOW() );
	END IF;
    
    IF pOpc = 2 THEN #Actualizar
		UPDATE Usuario
			SET nombre = pNombre, contrasena = pContrasena, imgPerfil = pImgPerfil, fechaModif = NOW()
        WHERE correo = pCorreo;
	END IF;
    
    IF pOpc = 3 THEN #Eliminar
		DELETE FROM Usuario
        WHERE correo = pCorreo;
	END IF;
    
    IF pOpc = 4 THEN #Consulta un usuario
		SELECT Correo, Nombre,Contrasena, ImgPerfil, Rol, Fecha, FechaModif
        FROM Usuario
        WHERE correo = pCorreo;
    END IF;
    
    IF pOpc = 5 THEN #TRAER TODOS LOS USUARIOS 
		SELECT Correo, Nombre, Contrasena, ImgPerfil, Rol, Fecha, FechaModif 
        FROM Usuario
        ORDER BY correo;
	END IF;
    
    IF pOpc = 6 THEN #LOGIN 
		SELECT Correo, Nombre,Contrasena, ImgPerfil, Rol, Fecha, FechaModif
        FROM Usuario
        WHERE correo = pCorreo 
        AND contrasena = pContrasena;
	END IF;
    
END $$

DELIMITER ; 