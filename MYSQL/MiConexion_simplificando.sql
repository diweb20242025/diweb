-- Tema 09 y 10 del Manual
-- Crear BBDD, Tablas y Relaciones
CREATE DATABASE IF NOT EXISTS simplificando
CHARACTER SET utf8mb4
COLLATE utf8mb4_spanish2_ci;
USE simplificando;

-- Borrar BBDD
DROP DATABASE simplificando;

-- Crear Tablas: En primer lugar las PRINCIPALES!!!!!!
-- Tabla productos
CREATE TABLE IF NOT EXISTS productos
(
    Referencia TINYINT UNSIGNED NOT NULL,   -- Not null = No vacio
    Descripcion VARCHAR(40) NOT NULL,
    Precio DECIMAL(5,2) NOT NULL,
    Stock INT UNSIGNED NULL,
    PRIMARY KEY pk_productos (Referencia),  -- pk_productos: nombre PK
    INDEX idx_productos (Descripcion)
) ENGINE = innodb
COMMENT = "Tabla productos: ENGINE Motor BBDD";

-- Tabla clientes
CREATE TABLE IF NOT EXISTS clientes
(
    Nif CHAR(9) NOT NULL,
    Nombre VARCHAR(40) NOT NULL,
    Genero BOOLEAN NULL,            -- Verdadero / Falso
    CodigoPostal INT NOT NULL,
    PRIMARY KEY pk_clientes (Nif),
    INDEX idx_clientes (Nombre),
    INDEX idx2_clientes (CodigoPostal)
) ENGINE = innodb
COMMENT = "Tabla Principal Clientes";

-- Tabla ventas
CREATE TABLE IF NOT EXISTS ventas 
(
    Fecha DATE NOT NULL,
    Referencia TINYINT UNSIGNED NOT NULL,
    Nif CHAR(9) NOT NULL,
    PRIMARY KEY pk_ventas (Fecha, Referencia, Nif),
    FOREIGN KEY fk_productos (Referencia) REFERENCES productos(Referencia),
    FOREIGN KEY fk_clientes (Nif) REFERENCES clientes(Nif)
) ENGINE = innodb
COMMENT = "Tabla Relacionada ventas";

