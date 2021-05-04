-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: May 04, 2021 at 02:12 AM
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
                                `id` varchar(24) COLLATE utf8_bin NOT NULL,
                                `nomeDoResponsavel` varchar(50) COLLATE utf8_bin NOT NULL,
                                `nomeDaEmpresa` varchar(50) COLLATE utf8_bin NOT NULL,
                                `descricao` varchar(250) COLLATE utf8_bin NOT NULL,
                                `produtos` varchar(250) COLLATE utf8_bin NOT NULL,
                                `email` varchar(50) COLLATE utf8_bin NOT NULL,
                                `senha` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `empregadores`
--

INSERT INTO `empregadores` (`id`, `nomeDoResponsavel`, `nomeDaEmpresa`, `descricao`, `produtos`, `email`, `senha`) VALUES
('em_6090a35b0d15e', 'nomeDoResponsavel', 'nomeDaEmpresa', 'descricao', 'produtos', 'julio@gmail.com', '0c7d2830d586c7a2946b484e68eb2754'),
('em_6090a476371dc', 'nomeDoResponsavel', 'nomeDaEmpresa', 'descricao', 'produtos', 'julio@empregador.com', '0c7d2830d586c7a2946b484e68eb2754'),
('em_6090a786c06c7', 'Julio Cesar', 'Auvo LTDA', 'DESCRICAO', 'PRODUTOS', 'cto@auvo.com', '0c7d2830d586c7a2946b484e68eb2754'),
('em_6090a8292c6ee', 'Julio Cesar', 'AUVO ltda', 'steansada', 'sdasdasda', 'teste@auvo.com', '0c7d2830d586c7a2946b484e68eb2754'),
('em_6090ad33beb03', 'TesteResponsa', 'TesteEpresa', 'DESCRICAO', 'Produtos', 'teste@teste.com', '0c7d2830d586c7a2946b484e68eb2754'),
('em_6090ad65dffaf', 'TesteResponsa', 'TesteEpresa', 'DESCRICAO', 'Produtos', 'teste@test1.com', '0c7d2830d586c7a2946b484e68eb2754');

-- --------------------------------------------------------

--
-- Table structure for table `estagiarios`
--

CREATE TABLE `estagiarios` (
                               `id` varchar(24) COLLATE utf8_bin NOT NULL,
                               `nome` varchar(50) COLLATE utf8_bin NOT NULL,
                               `curso` varchar(50) COLLATE utf8_bin NOT NULL,
                               `anoDeIngresso` int(11) NOT NULL,
                               `miniCurriculo` varchar(500) COLLATE utf8_bin NOT NULL,
                               `email` varchar(50) COLLATE utf8_bin NOT NULL,
                               `senha` varchar(60) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `estagiarios`
--

INSERT INTO `estagiarios` (`id`, `nome`, `curso`, `anoDeIngresso`, `miniCurriculo`, `email`, `senha`) VALUES
('es_6090a4dcdb121', 'nomeDaPessoa', 'Curso', 2019, 'miniCUrriculo', 'julio@estagiario.com', '0c7d2830d586c7a2946b484e68eb2754'),
('es_6090a806c13f8', 'Julio Cesar', 'Ciencias da Computacao', 2019, 'mini curriculo', 'julio@upnid.com', '0c7d2830d586c7a2946b484e68eb2754'),
('es_6090ad857ce16', 'NomeEstag', 'Cursoa', 2020, 'asdsadasdasda', 'teste@estag.com', '0c7d2830d586c7a2946b484e68eb2754');

-- --------------------------------------------------------

--
-- Table structure for table `vagas`
--

CREATE TABLE `vagas` (
                         `id` varchar(24) COLLATE utf8_bin NOT NULL,
                         `empregadorID` varchar(24) COLLATE utf8_bin NOT NULL,
                         `descricao` varchar(250) COLLATE utf8_bin NOT NULL,
                         `listaDeAtividades` varchar(250) COLLATE utf8_bin NOT NULL,
                         `listaDeHabilidadesRequeridas` varchar(250) COLLATE utf8_bin NOT NULL,
                         `semestreRequerido` int(11) NOT NULL,
                         `quantidadeDeHoras` int(11) NOT NULL,
                         `remuneracao` double(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vagas`
--

INSERT INTO `vagas` (`id`, `empregadorID`, `descricao`, `listaDeAtividades`, `listaDeHabilidadesRequeridas`, `semestreRequerido`, `quantidadeDeHoras`, `remuneracao`) VALUES
('id', 'empregadorID', 'descricao', 'listaDeAtividades', 'listaDeHabilidadesRequeridas', 5, 30, 801),
('id3', 'empregadorID', 'descricao', 'listaDeAtividades', 'listaDeHabilidadesRequeridas', 5, 30, 800),
('id4', 'empregadorID', 'descricao', 'listaDeAtividades', 'listaDeHabilidadesRequeridas', 5, 30, 800),
('ida', 'empregadorID', 'descricao', 'listaDeAtividades', 'listaDeHabilidadesRequeridas', 5, 30, 800);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empregadores`
--
ALTER TABLE `empregadores`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `estagiarios`
--
ALTER TABLE `estagiarios`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vagas`
--
ALTER TABLE `vagas`
    ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;