-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: May 01, 2021 at 04:10 PM
-- Server version: 10.3.28-MariaDB-1:10.3.28+maria~focal
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moet`
--

-- --------------------------------------------------------

--
-- Table structure for table `empregadores`
--

CREATE TABLE `empregadores` (
  `id` varchar(24) NOT NULL,
  `nomeDoResponsavel` varchar(50) NOT NULL,
  `nomeDaEmpresa` varchar(50) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `produtos` varchar(250) NOT NULL,
  `usuarioID` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empregadores`
--

INSERT INTO `empregadores` (`id`, `nomeDoResponsavel`, `nomeDaEmpresa`, `descricao`, `produtos`, `usuarioID`) VALUES
('em_608d7adb6f352', 'Luca Baasdsada', 'Auvo LTDA', 'descricaaaao', 'produtooss', 'us_608d7adb6e004');

-- --------------------------------------------------------

--
-- Table structure for table `estagiarios`
--

CREATE TABLE `estagiarios` (
  `id` varchar(24) COLLATE utf8_bin NOT NULL,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `curso` varchar(50) CHARACTER SET latin1 NOT NULL,
  `anoDeIngresso` int(11) NOT NULL,
  `miniCurriculo` varchar(500) CHARACTER SET latin1 NOT NULL,
  `usuarioID` varchar(24) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `estagiarios`
--

INSERT INTO `estagiarios` (`id`, `nome`, `curso`, `anoDeIngresso`, `miniCurriculo`, `usuarioID`) VALUES
('es_608d77072339c', 'Julio Cesar', 'Ciencias da Computacao', 2019, 'miniCurricsulo', 'us_608d770721a28');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` varchar(24) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `tipo`) VALUES
('us_608d770721a28', 'email@test.com', 'senha231', 'ESTAGIARIO'),
('us_608d7adb6e004', 'empregador@gmail.com', 'senha231', 'EMPREGADOR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empregadores`
--
ALTER TABLE `empregadores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estagiarios`
--
ALTER TABLE `estagiarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;