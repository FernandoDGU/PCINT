use bdm_pract07;

CREATE TABLE IF NOT EXISTS Carrera (
	id INT NOT NULL PRIMARY KEY,
	nombre VARCHAR(100) NOT NULL
    
);

CREATE TABLE IF NOT EXISTS Alumno (
	matricula 		INT	NOT NULL PRIMARY KEY,
    nombre		VARCHAR(100) NOT NULL, 
    carrera	INT NOT NULL,

	FOREIGN KEY (carrera) REFERENCES Carrera(id)
);

CREATE TABLE IF NOT EXISTS Materias (
	id INT NOT NULL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    carrera INT NOT NULL,
    
    FOREIGN KEY (carrera) REFERENCES Carrera(id)
    
);

CREATE TABLE IF NOT EXISTS Materias_Alumno(
	id INT NOT NULL PRIMARY KEY,
    matricula INT NOT NULL,
    id_Materia INT NOT NULL,
    fecha DATE NOT NULL,
    calificacion INT NULL,
    opc ENUM("PRIMERA OPORTUNIDAD","SEGUNDA OPORTUNIDAD","TERCERA OPORTUNIDAD","CUARTA OPORTUNIDAD","QUINTA OPORTUNIDAD","SEXTA OPORTUNIDAD"),
    
    FOREIGN KEY (matricula) REFERENCES Alumno(matricula),
    FOREIGN KEY (id_Materia) REFERENCES Materias(id)
);

INSERT INTO `bdm_pract06`.`alumno`
(`matricula`,
`nombre`,
`carrera`)
VALUES
(1750017,
"Darien Miguel Sánchez Arévalo",
5);

INSERT INTO `bdm_pract06`.`carrera`
(`id`,
`nombre`)
VALUES
(5,
"LMAD");
    
    DELIMITER $$
CREATE PROCEDURE `getKardex` (
IN pMatricula INT
)
BEGIN


	SELECT Alumno.nombre, Alumno.matricula, Carrera.nombre "carrera", now() "fecha kardex", COUNT(calificacion) "total materias aprobadas"
		FROM Alumno
        INNER JOIN Carrera
	ON Alumno.carrera = Carrera.id
		INNER JOIN  Materias_Alumno
	ON Alumno.matricula = Materias_Alumno.matricula
    WHERE Alumno.matricula = pMatricula AND calificacion > 70;

	SELECT Materias.nombre, Materias_Alumno.fecha, Materias_Alumno.calificacion, Materias_Alumno.opc
		FROM Materias_Alumno
		INNER JOIN  Materias
	ON Materias_Alumno.id_Materia = Materias.id
    WHERE Materias_Alumno.matricula = pMatricula;

	SELECT IF(calificacion IS NULL, "Completo", "Incompleto") "Estado Kardex"
    FROM Materias_Alumno
    WHERE matricula = pMatricula AND calificacion < 70
    LIMIT 1;
    
    
END$$

DELIMITER ;