
-- Base de datos: `comedor`

--
-- Estructura de tabla para la tabla `ALUMNOS`
--

CREATE TABLE IF NOT EXISTS `ALUMNOS`(
    `DNI` VARCHAR(9) NOT NULL PRIMARY KEY,
    `NOMBRE` VARCHAR(20) NOT NULL,
    `CLAVE_CURSO` VARCHAR(4) NOT NULL,
    `CUENTA_CORRIENTE` INT(20),
    `MESA_ASIGNADA` INT(11)
);

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`DNI`, `NOMBRE`, `CLAVE_CURSO`, `CUENTA_CORRIENTE`, `MESA_ASIGNADA`) VALUES
('11111111A', 'Lucas', '3INF', '-1111111121', 1),
('12121212X', 'Mar', '4INF', '-1234123394', 2),
('22222222B', 'Lucía', '3INF', '-1234567902', 2),
('33333333C', 'Carlos', '5INF', '-1234567902', 1),
('51992527S', 'Teresa', '4INF', '-1111111121', 1),
('51992528Q', 'Víctor', '3INF', '-1234567902', 3),
('54322344A', 'Marcos', '5INF', '-1122332303', 4),
('67554765W', 'Claudia', '5INF', '-1234123394', 4),
('91384756A', 'Guillermo', '4INF', '-9876543420', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ASISTENCIA`
--

CREATE TABLE `ASISTENCIA`(
    `DNI` VARCHAR(9) NOT NULL,
    `FECHA` VARCHAR(10) NOT NULL,
    `ASISTENCIA` ENUM('SI', 'NO'),
    `CLAVE_CURSO` VARCHAR(4) NOT NULL,
    FOREIGN KEY (`DNI`) REFERENCES `ALUMNOS`(`DNI`) ON UPDATE CASCADE ON DELETE CASCADE
);

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`DNI`, `FECHA`, `ASISTENCIA`, `CLAVE_CURSO`) VALUES
('11111111A', '2022-02-24', 'NO', '3inf'),
('22222222B', '2022-02-24', 'NO', '3inf'),
('51992528Q', '2022-02-24', 'NO', '3inf'),
('33333333C', '2022-02-24', 'NO', '5inf'),
('54322344A', '2022-02-24', 'NO', '5inf'),
('67554765W', '2022-02-24', 'NO', '5inf'),
('12121212X', '2022-02-24', 'NO', '4inf'),
('51992527S', '2022-02-24', 'NO', '4inf'),
('91384756A', '2022-02-24', 'NO', '4inf'),
('11111111A', '2022-02-23', 'SI', '3inf'),
('22222222B', '2022-02-23', 'SI', '3inf'),
('51992528Q', '2022-02-23', 'SI', '3inf'),
('12121212X', '2022-02-23', 'SI', '4inf'),
('51992527S', '2022-02-23', 'SI', '4inf'),
('91384756A', '2022-02-23', 'SI', '4inf'),
('33333333C', '2022-02-23', 'SI', '5inf'),
('54322344A', '2022-02-23', 'SI', '5inf'),
('67554765W', '2022-02-23', 'SI', '5inf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `LOGIN`(
    `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `NOMBRE` VARCHAR(10) NOT NULL,
    `USUARIO` VARCHAR(4) NOT NULL,
    `PASSWORD` INT(4) NOT NULL
);

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`ID`, `NOMBRE`, `USUARIO`, `PASSWORD`) VALUES
(1, 'Víctor', 'vic', 1234),
(2, 'Lucas', 'luc', 1111),
(3, 'Susana', 'sus', 1212);


