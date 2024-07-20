-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-07-2024 a las 04:01:14
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinic_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `appointments`
--

INSERT INTO `appointments` (`id`, `doctor_id`, `appointment_date`, `start_time`, `end_time`) VALUES
(1, 1, '2024-07-19', '09:00:00', '09:30:00'),
(2, 1, '2024-07-19', '10:00:00', '10:30:00'),
(3, 2, '2024-07-19', '11:00:00', '11:30:00'),
(4, 3, '2024-07-19', '13:00:00', '13:30:00'),
(5, 4, '2024-07-19', '14:00:00', '14:30:00'),
(6, NULL, '2024-07-20', '09:00:00', '09:30:00'),
(7, 1, '2024-07-20', '09:00:00', '09:30:00'),
(8, 1, '2024-07-20', '09:30:00', '10:00:00'),
(10, 2, '2024-07-20', '09:00:00', '09:30:00'),
(11, 7, '2024-07-20', '14:30:00', '15:00:00'),
(12, 3, '2024-07-20', '14:30:00', '15:00:00'),
(13, 1, '2024-07-20', '10:00:00', '10:30:00'),
(14, 4, '2024-07-20', '09:30:00', NULL),
(15, 4, '2024-07-20', '10:00:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialty_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `specialty_id`) VALUES
(1, 'Dr. Juan Pérez', 1),
(2, 'Dra. Laura Gómez', 1),
(3, 'Dr. Luis Fernández', 2),
(4, 'Dra. Ana Martínez', 2),
(5, 'Dr. Carlos Rodríguez', 3),
(6, 'Dra. Patricia López', 3),
(7, 'Dr. Miguel Sánchez', 4),
(8, 'Dra. Julia Morales', 4),
(9, 'Dr. Fernando Silva', 5),
(10, 'Dra. Marta Ruiz', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `patients`
--

INSERT INTO `patients` (`id`, `first_name`, `last_name`, `phone`, `email`, `address`) VALUES
(1, 'Alexander', 'Mendoza', '927085729', 'mendozaelx@gmail.com', 'abc'),
(2, 'Alexander', 'Mendoza', '927085729', 'marshmelloqwe@gmail.com', 'dq'),
(3, 'Alexander', 'Mendoza', '927085729', 'marshmelloqwe@gmail.com', 'dq'),
(4, 'Alexander', 'Mendoza', '927085729', 'u19100070@utp.edu.pe', 'cfa'),
(5, 'Alexander', 'Mendoza', '927085729', 'mendozaelx@gmail.com', '27'),
(6, 'Alexander', 'Mendoza', '927085729', 'mendozaelx@gmail.com', 'gfew');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `specialties`
--

CREATE TABLE `specialties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `specialties`
--

INSERT INTO `specialties` (`id`, `name`) VALUES
(1, 'Cardiología'),
(2, 'Dermatología'),
(3, 'Pediatría'),
(4, 'Ginecología'),
(5, 'Oftalmología');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctor_id` (`doctor_id`,`appointment_date`,`start_time`);

--
-- Indices de la tabla `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialty_id` (`specialty_id`);

--
-- Indices de la tabla `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `specialties`
--
ALTER TABLE `specialties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Filtros para la tabla `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
