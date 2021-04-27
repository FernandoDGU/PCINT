CREATE DATABASE bdm_lab;
use bdm_lab;

CREATE TABLE IF NOT EXISTS Carrera (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(100) NOT NULL,
    fechaHora TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Alumno (
	matricula 		INT	NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre		VARCHAR(100) NOT NULL, 
    carrera	INT NOT NULL,
    fechaHora TIMESTAMP,
    
	FOREIGN KEY (carrera) REFERENCES Carrera(id)
);

CREATE TABLE IF NOT EXISTS Materias (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    carrera INT NOT NULL,
    fechaHora TIMESTAMP,
    
    FOREIGN KEY (carrera) REFERENCES Carrera(id)
);

CREATE TABLE IF NOT EXISTS Materias_Alumno(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    matricula INT NOT NULL,
    id_Materia INT NOT NULL,
    fecha DATE NOT NULL,
    calificacion INT NULL,
    opc ENUM("PRIMERA OPORTUNIDAD","SEGUNDA OPORTUNIDAD","TERCERA OPORTUNIDAD","CUARTA OPORTUNIDAD","QUINTA OPORTUNIDAD","SEXTA OPORTUNIDAD"),
    fechaHora TIMESTAMP,
    
    FOREIGN KEY (matricula) REFERENCES Alumno(matricula),
    FOREIGN KEY (id_Materia) REFERENCES Materias(id)
);
select * from Carrera;
INSERT INTO Carrera (nombre, fechaHora) VALUES("Carrera1", now());
INSERT INTO Carrera (nombre, fechaHora) VALUES("Carrera2", now());
INSERT INTO Carrera (nombre, fechaHora) VALUES("Carrera3", now());
INSERT INTO Carrera (nombre, fechaHora) VALUES("Carrera4", now());
INSERT INTO Carrera (nombre, fechaHora) VALUES("Carrera5", now());
INSERT INTO Carrera (nombre, fechaHora) VALUES("Carrera6", now());
INSERT INTO Carrera (nombre, fechaHora) VALUES("Carrera7", now());
INSERT INTO Carrera (nombre, fechaHora) VALUES("Carrera8", now());
INSERT INTO Carrera (nombre, fechaHora) VALUES("Carrera9", now());
INSERT INTO Carrera (nombre, fechaHora) VALUES("Carrera10", now());

select * from Alumno;
INSERT INTO Alumno (nombre, carrera, fechaHora) VALUES("AlumnoA", 10, now());
INSERT INTO Alumno (nombre, carrera, fechaHora) VALUES("AlumnoB", 9, now());
INSERT INTO Alumno (nombre, carrera, fechaHora) VALUES("AlumnoC", 8, now());
INSERT INTO Alumno (nombre, carrera, fechaHora) VALUES("AlumnoD", 7, now());
INSERT INTO Alumno (nombre, carrera, fechaHora) VALUES("AlumnoE", 6, now());
INSERT INTO Alumno (nombre, carrera, fechaHora) VALUES("AlumnoF", 5, now());
INSERT INTO Alumno (nombre, carrera, fechaHora) VALUES("AlumnoG", 4, now());
INSERT INTO Alumno (nombre, carrera, fechaHora) VALUES("AlumnoH", 3, now());
INSERT INTO Alumno (nombre, carrera, fechaHora) VALUES("AlumnoI", 2, now());
INSERT INTO Alumno (nombre, carrera, fechaHora) VALUES("AlumnoJ", 1, now());

select * from Materias;
INSERT INTO Materias (nombre, carrera, fechaHora) VALUES("MateriaAA", 1, now());
INSERT INTO Materias (nombre, carrera, fechaHora) VALUES("MateriaAB", 2, now());
INSERT INTO Materias (nombre, carrera, fechaHora) VALUES("MateriaAC", 3, now());
INSERT INTO Materias (nombre, carrera, fechaHora) VALUES("MateriaAD", 4, now());
INSERT INTO Materias (nombre, carrera, fechaHora) VALUES("MateriaAE", 5, now());
INSERT INTO Materias (nombre, carrera, fechaHora) VALUES("MateriaAF", 6, now());
INSERT INTO Materias (nombre, carrera, fechaHora) VALUES("MateriaAG", 7, now());
INSERT INTO Materias (nombre, carrera, fechaHora) VALUES("MateriaAH", 8, now());
INSERT INTO Materias (nombre, carrera, fechaHora) VALUES("MateriaAI", 9, now());
INSERT INTO Materias (nombre, carrera, fechaHora) VALUES("MateriaAJ", 10, now());

select * from Materias_Alumno;
INSERT INTO Materias_Alumno (matricula, id_Materia, fecha, calificacion, opc, fechaHora) VALUES(2, 1, now(), NULL, "PRIMERA OPORTUNIDAD", now());
INSERT INTO Materias_Alumno (matricula, id_Materia, fecha, calificacion, opc, fechaHora) VALUES(3, 2, now(), 60, "SEGUNDA OPORTUNIDAD", now());
INSERT INTO Materias_Alumno (matricula, id_Materia, fecha, calificacion, opc, fechaHora) VALUES(4, 3, now(), 54, "TERCERA OPORTUNIDAD", now());
INSERT INTO Materias_Alumno (matricula, id_Materia, fecha, calificacion, opc, fechaHora) VALUES(5, 4, now(), 12, "CUARTA OPORTUNIDAD", now());
INSERT INTO Materias_Alumno (matricula, id_Materia, fecha, calificacion, opc, fechaHora) VALUES(6, 5, now(), 100, "QUINTA OPORTUNIDAD", now());
INSERT INTO Materias_Alumno (matricula, id_Materia, fecha, calificacion, opc, fechaHora) VALUES(7, 6, now(), 80, "PRIMERA OPORTUNIDAD", now());
INSERT INTO Materias_Alumno (matricula, id_Materia, fecha, calificacion, opc, fechaHora) VALUES(8, 7, now(), 60, "SEGUNDA OPORTUNIDAD", now());
INSERT INTO Materias_Alumno (matricula, id_Materia, fecha, calificacion, opc, fechaHora) VALUES(9, 8, now(), 90, "PRIMERA OPORTUNIDAD", now());
INSERT INTO Materias_Alumno (matricula, id_Materia, fecha, calificacion, opc, fechaHora) VALUES(10, 9, now(), 95, "PRIMERA OPORTUNIDAD", now());
INSERT INTO Materias_Alumno (matricula, id_Materia, fecha, calificacion, opc, fechaHora) VALUES(11, 10, now(), 90, "PRIMERA OPORTUNIDAD", now());


 DELIMITER $$
CREATE PROCEDURE `insertCarrera` (
IN pNombre VARCHAR(100)
)
BEGIN
    INSERT INTO Carrera (nombre, fechaHora) VALUES(pNombre, now());
END$$
DELIMITER ;

 DELIMITER $$
CREATE PROCEDURE `insertAlumno` (
IN pNombre VARCHAR(100),
IN pCarrera VARCHAR(100)
)
BEGIN
    INSERT INTO Alumno (nombre, carrera, fechaHora) VALUES(pNombre, pCarrera, now());
END$$
DELIMITER ;

 DELIMITER $$
CREATE PROCEDURE `insertMateria` (
IN pNombre VARCHAR(100),
IN pCarrera VARCHAR(100)
)
BEGIN
    INSERT INTO Materias (nombre, carrera, fechaHora) VALUES(pNombre, pCarrera, now());
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `insertMateria_Alumno` (
IN pMatricula INT,
IN pId_Materia INT,
IN pCalificacion INT,
IN pOpc ENUM("PRIMERA OPORTUNIDAD","SEGUNDA OPORTUNIDAD","TERCERA OPORTUNIDAD","CUARTA OPORTUNIDAD","QUINTA OPORTUNIDAD","SEXTA OPORTUNIDAD")
)
BEGIN
    INSERT INTO Materias_Alumno (matricula, id_Materia, fecha, calificacion, opc, fechaHora) VALUES(pMatricula, pId_Materia, now(), pCalificacion, pOpc, now());
END$$
DELIMITER ;

CALL insertCarrera("Carrera11");
CALL insertCarrera("Carrera12");
CALL insertCarrera("Carrera13");
CALL insertCarrera("Carrera14");
CALL insertCarrera("Carrera15");
CALL insertCarrera("Carrera16");
CALL insertCarrera("Carrera17");
CALL insertCarrera("Carrera18");
CALL insertCarrera("Carrera19");
CALL insertCarrera("Carrera20");

CALL insertAlumno("AlumnoK", 11);
CALL insertAlumno("AlumnoL", 12);
CALL insertAlumno("AlumnoM", 13);
CALL insertAlumno("AlumnoN", 14);
CALL insertAlumno("AlumnoO", 15);
CALL insertAlumno("AlumnoP", 16);
CALL insertAlumno("AlumnoQ", 17);
CALL insertAlumno("AlumnoR", 18);
CALL insertAlumno("AlumnoS", 19);
CALL insertAlumno("AlumnoT", 20);

CALL insertMateria("MateriaBA", 11);
CALL insertMateria("MateriaBB", 12);
CALL insertMateria("MateriaBC", 13);
CALL insertMateria("MateriaBD", 14);
CALL insertMateria("MateriaBE", 15);
CALL insertMateria("MateriaBF", 16);
CALL insertMateria("MateriaBG", 17);
CALL insertMateria("MateriaBH", 18);
CALL insertMateria("MateriaBI", 19);
CALL insertMateria("MateriaBJ", 20);

CALL insertMateria_Alumno(12, 12, 50, "PRIMERA OPORTUNIDAD");
CALL insertMateria_Alumno(13, 13, 50, "PRIMERA OPORTUNIDAD");
CALL insertMateria_Alumno(14, 14, 50, "PRIMERA OPORTUNIDAD");
CALL insertMateria_Alumno(15, 15, 50, "PRIMERA OPORTUNIDAD");
CALL insertMateria_Alumno(16, 16, 50, "PRIMERA OPORTUNIDAD");
CALL insertMateria_Alumno(17, 17, 50, "PRIMERA OPORTUNIDAD");
CALL insertMateria_Alumno(18, 18, 50, "PRIMERA OPORTUNIDAD");
CALL insertMateria_Alumno(19, 19, 50, "PRIMERA OPORTUNIDAD");
CALL insertMateria_Alumno(20, 20, 50, "PRIMERA OPORTUNIDAD");
CALL insertMateria_Alumno(21, 11, 50, "PRIMERA OPORTUNIDAD");


UPDATE Carrera SET fechaHora = now()
WHERE id = 5;
UPDATE Carrera SET fechaHora = now()
WHERE id = 1;

UPDATE Alumno SET fechaHora = now()
WHERE Matricula = 5;
UPDATE Alumno SET fechaHora = now()
WHERE Matricula = 3;

UPDATE Materias SET fechaHora = now()
WHERE id = 15;
UPDATE Materias SET fechaHora = now()
WHERE id = 13;

UPDATE Materias_Alumno SET fechaHora = now()
WHERE id = 20;
UPDATE Materias_Alumno SET fechaHora = now()
WHERE id = 11;

 DELIMITER $$
CREATE PROCEDURE `updateCarrera` (
IN pId INT,
IN pNombre VARCHAR(100)
)
BEGIN
    UPDATE Carrera SET nombre = pNombre, fechaHora = now()
	WHERE id = pId;
END$$
DELIMITER ;

 DELIMITER $$
CREATE PROCEDURE `updateAlumno` (
IN pMatricula INT,
IN pNombre VARCHAR(100),
IN pCarrera VARCHAR(100)
)
BEGIN
    UPDATE Alumno SET nombre = pNombre, carrera = pCarrera, fechaHora = now()
	WHERE matricula = pMatricula;
END$$
DELIMITER ;

 DELIMITER $$
CREATE PROCEDURE `updateMateria` (
IN pId INT,
IN pNombre VARCHAR(100),
IN pCarrera VARCHAR(100)
)
BEGIN
     UPDATE Materias SET nombre = pNombre, carrera = pCarrera, fechaHora = now()
	WHERE id = pId;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `updateMateria_Alumno` (
IN pId INT,
IN pMatricula INT,
IN pId_Materia INT,
IN pCalificacion INT,
IN pOpc ENUM("PRIMERA OPORTUNIDAD","SEGUNDA OPORTUNIDAD","TERCERA OPORTUNIDAD","CUARTA OPORTUNIDAD","QUINTA OPORTUNIDAD","SEXTA OPORTUNIDAD")
)
BEGIN
    UPDATE Materias_Alumno SET matricula = pMatricula, id_Materia = pId_Materia, fecha = now(), calificacion = pCalificacion, opc = pOpc, fechaHora = now()
	WHERE id = pId;
END$$
DELIMITER ;

DROP PROCEDURE `updateMateria_Alumno`;

CALL updateCarrera(1, "ASKD");
CALL updateCarrera(2, "FGSDFG");
CALL updateCarrera(3, "WERW");
CALL updateCarrera(4, "FSADFWE");
CALL updateCarrera(5, "ASXCVBKD");
CALL updateCarrera(6, "ASKXCVBD");
CALL updateCarrera(7, "DFS");
CALL updateCarrera(8, "ASXCVBKD");
CALL updateCarrera(9, "ASKXCVBD");
CALL updateCarrera(10, "XCVBXCVBXCVB");

CALL updateAlumno(11, "AlumnoKSDF", 11);
CALL updateAlumno(12, "AlumnoKSDF", 11);
CALL updateAlumno(13, "AlumnoKSDF", 11);
CALL updateAlumno(14, "AlumnoKSADF", 11);
CALL updateAlumno(15, "AlumnoKASDF", 11);
CALL updateAlumno(16, "AlumnoKASD", 11);
CALL updateAlumno(17, "AlumnoKASDF", 11);
CALL updateAlumno(18, "AlumnoKDSF", 11);
CALL updateAlumno(19, "AlumnoKSDG", 11);
CALL updateAlumno(20, "AlumnoKWQE", 11);

CALL updateMateria(1, "MaterASDiaBA", 11);
CALL updateMateria(2, "MateriaBAASDA", 11);
CALL updateMateria(3, "MateriaBASDA", 11);
CALL updateMateria(4, "MateriaBASDA", 11);
CALL updateMateria(5, "MateriaBSDASA", 11);
CALL updateMateria(6, "MateriaBDASDA", 11);
CALL updateMateria(7, "MateriaBASD", 11);
CALL updateMateria(8, "MaterSDiaBA", 11);
CALL updateMateria(9, "MateriaBASDA", 11);
CALL updateMateria(10, "MateASDriaBA", 11);

CALL updateMateria_Alumno(7, 12, 12, 80, "PRIMERA OPORTUNIDAD");
CALL updateMateria_Alumno(8, 12, 12, 50, "PRIMERA OPORTUNIDAD");
CALL updateMateria_Alumno(9, 12, 12, 50, "PRIMERA OPORTUNIDAD");
CALL updateMateria_Alumno(10, 12, 12, 50, "PRIMERA OPORTUNIDAD");
CALL updateMateria_Alumno(11, 12, 12, 50, "PRIMERA OPORTUNIDAD");
CALL updateMateria_Alumno(12, 12, 12, 50, "PRIMERA OPORTUNIDAD");
CALL updateMateria_Alumno(13, 12, 12, 50, "PRIMERA OPORTUNIDAD");
CALL updateMateria_Alumno(15, 12, 12, 50, "PRIMERA OPORTUNIDAD");
CALL updateMateria_Alumno(16, 12, 12, 50, "PRIMERA OPORTUNIDAD");
CALL updateMateria_Alumno(17, 12, 12, 50, "PRIMERA OPORTUNIDAD");
