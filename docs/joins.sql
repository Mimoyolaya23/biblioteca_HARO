-- Creación de la base de datos bd_biblioteca si no existe
CREATE DATABASE IF NOT EXISTS bd_biblioteca;
USE bd_biblioteca;

-- Tabla usuario
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    correo VARCHAR(100),
    password VARCHAR(100),
    estado VARCHAR(20)
) ENGINE=InnoDB;

-- Tabla libro
CREATE TABLE libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200),
    autor VARCHAR(100),
    genero VARCHAR(50),
    anio_publicacion YEAR,
    estado VARCHAR(20)
) ENGINE=InnoDB;

-- Tabla miembro
CREATE TABLE miembros (
    id_miembro INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    email VARCHAR(100),
    fecha_suscripcion DATE
) ENGINE=InnoDB;

-- Tabla préstamo
CREATE TABLE prestamos (
    id_prestamo INT AUTO_INCREMENT PRIMARY KEY,
    id_libro INT,
    id_miembro INT,
    fecha DATE,
    FOREIGN KEY (id_libro) REFERENCES libros(id_libro) ON DELETE CASCADE,
    FOREIGN KEY (id_miembro) REFERENCES miembros(id_miembro) ON DELETE CASCADE
) ENGINE=InnoDB;


-- Registros 

-- Insertar datos en la tabla usuario
INSERT INTO usuarios (nombre, correo, password, estado) VALUES
('Juan Pérez', 'juan.perez@example.com', 'password123', 'activo'),
('María López', 'maria.lopez@example.com', 'password456', 'inactivo'),
('secre', 'secre', '123', 'activo');

-- Insertar datos en la tabla libro
INSERT INTO libros (titulo, autor, genero, anio_publicacion, estado) VALUES
('Cien Años de Soledad', 'Gabriel García Márquez', 'Realismo Mágico', 1967, 'disponible'),
('Don Quijote de la Mancha', 'Miguel de Cervantes', 'Novela', 1605, 'prestado'),
('1984', 'George Orwell', 'Distopía', 1949, 'disponible');

-- Insertar datos en la tabla miembro
INSERT INTO miembros (nombre, apellido, email, fecha_suscripcion) VALUES
('Ana', 'García', 'ana.garcia@example.com', '2023-01-15'),
('Luis', 'Fernández', 'luis.fernandez@example.com', '2023-03-22'),
('Elena', 'Martínez', 'elena.martinez@example.com', '2023-06-10');

-- Insertar datos en la tabla préstamo
INSERT INTO prestamos (id_libro, id_miembro, fecha) VALUES
(1, 1, '2024-07-01'),
(2, 2, '2024-07-05'),
(3, 3, '2024-07-10');