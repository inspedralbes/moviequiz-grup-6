-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 17-12-2021 a les 10:39:57
-- Versió del servidor: 10.4.21-MariaDB
-- Versió de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `moviequiz6`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `peli`
--

CREATE TABLE `peli` (
  `Poster` varchar(50) NOT NULL,
  `Title` varchar(10) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Year` int(10) NOT NULL,
  `imdbID` varchar(10) NOT NULL,
  `puntuacio` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de la taula `puntuacio`
--

CREATE TABLE `puntuacio` (
  `numpun` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de la taula `usuari`
--

CREATE TABLE `usuari` (
  `id` int(30) NOT NULL,
  `nom` varchar(15) NOT NULL,
  `contrasena` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Bolcament de dades per a la taula `usuari`
--

INSERT INTO `usuari` (`id`, `nom`, `contrasena`, `email`) VALUES
(33, 'user1', '12345', 'a20mohwafche@inspedralbes.cat'),
(34, 'valeria', '12356', 'a20mohwafche@inspedralbes.cat'),
(35, 'cheryl', '12345', 'a20valzavvas@inspedralbes.cat');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `peli`
--
ALTER TABLE `peli`
  ADD PRIMARY KEY (`imdbID`,`puntuacio`),
  ADD KEY `puntuacio` (`puntuacio`);

--
-- Índexs per a la taula `puntuacio`
--
ALTER TABLE `puntuacio`
  ADD PRIMARY KEY (`numpun`);

--
-- Índexs per a la taula `usuari`
--
ALTER TABLE `usuari`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `usuari`
--
ALTER TABLE `usuari`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `peli`
--
ALTER TABLE `peli`
  ADD CONSTRAINT `peli_ibfk_1` FOREIGN KEY (`puntuacio`) REFERENCES `puntuacio` (`numpun`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
