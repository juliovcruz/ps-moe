-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 15-Maio-2021 às 12:48
-- Versão do servidor: 8.0.21
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `novo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empregadores`
--

DROP TABLE IF EXISTS `empregadores`;
CREATE TABLE IF NOT EXISTS `empregadores` (
  `id` varchar(24) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nomeDoResponsavel` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nomeDaEmpresa` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `descricao` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `produtos` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `senha` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `empregadores`
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
-- Estrutura da tabela `estagiarios`
--

DROP TABLE IF EXISTS `estagiarios`;
CREATE TABLE IF NOT EXISTS `estagiarios` (
  `id` varchar(24) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `curso` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `anoDeIngresso` int NOT NULL,
  `miniCurriculo` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `senha` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `token` varchar(24) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `emailConfirmado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `estagiarios`
--

INSERT INTO `estagiarios` (`id`, `nome`, `curso`, `anoDeIngresso`, `miniCurriculo`, `email`, `senha`, `token`, `emailConfirmado`) VALUES
('', 'KKKKKK', 'Eng Software', 2021, '', 'lucabbenetti@gmail.com', '1231234', '', 0),
('12345', 'joaoooo', 'engsfotware', 2022, 'algumacoisa', 'juliobobosort@mail.com', '1234564', '', 0),
('123456', 'joaoooo', 'engsfotware', 2022, 'algumacoisa', 'juliobobosort2@mail.com', '1234564', '', 0),
('1234567', 'vamovelho', 'engenharia de softw', 3000, 'eis aqui', 'julinho7@gmail.com', '1234567', '', 0),
('12345678', 'Necessitatibus dolor', 'Nulla amet praesent', 2030, 'Quidem aliquam ut iu', 'cuzeg@mailinator.com', 'Pa$$w0rd!', '', 0),
('1234567810', 'Dignissimos ipsum u', 'Voluptatem ut ipsam', 3333, 'Eius asperiores inci', 'diqovunare@mailinator.com', 'Pa$$w0rd!', '', 0),
('77863711d25d699e087eb542', 'Molestiae ipsum pers', 'Fugiat at quo conseq', 2040, 'Sed qui ea nulla nec', 'pigy@mailinator.com', '$2y$10$Sf7IbotgsnXA1uwFE2ww1OJiI3EMK5D.VqsLrE759atTvPigsTkUC', '', 0),
('es_6090a4dcdb121', 'nomeDaPessoa', 'Curso', 2019, 'miniCUrriculo', 'julio@estagiario.com', '0c7d2830d586c7a2946b484e68eb2754', '', 0),
('es_6090a806c13f8', 'Julio Cesar', 'Ciencias da Computacao', 2019, 'mini curriculo', 'julio@upnid.com', '0c7d2830d586c7a2946b484e68eb2754', '', 0),
('es_6090ad857ce16', 'NomeEstag', 'Cursoa', 2020, 'asdsadasdasda', 'teste@estag.com', '0c7d2830d586c7a2946b484e68eb2754', '', 0),
('f094f08555e1ccfcc7098c32', 'Quidem qui eum incid', 'Ad et impedit ut si', 4040, 'Ut id dolor fuga Se', 'qoqeh@mailinator.com', '$2y$10$U0PbTdEp9Kq7hKFHiYkf6OkohbvGGTKiK77.2.7Javl1AAfkM6zWO', '9f91ad6f74327bb1628686bf', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

DROP TABLE IF EXISTS `vagas`;
CREATE TABLE IF NOT EXISTS `vagas` (
  `id` varchar(24) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `empregadorID` varchar(24) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `descricao` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `listaDeAtividades` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `listaDeHabilidadesRequeridas` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `semestreRequerido` int NOT NULL,
  `quantidadeDeHoras` int NOT NULL,
  `remuneracao` double(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `vagas`
--

INSERT INTO `vagas` (`id`, `empregadorID`, `descricao`, `listaDeAtividades`, `listaDeHabilidadesRequeridas`, `semestreRequerido`, `quantidadeDeHoras`, `remuneracao`) VALUES
('id', 'empregadorID', 'descricao', 'listaDeAtividades', 'listaDeHabilidadesRequeridas', 5, 30, 801),
('id3', 'empregadorID', 'descricao', 'listaDeAtividades', 'listaDeHabilidadesRequeridas', 5, 30, 800),
('id4', 'empregadorID', 'descricao', 'listaDeAtividades', 'listaDeHabilidadesRequeridas', 5, 30, 800),
('ida', 'empregadorID', 'descricao', 'listaDeAtividades', 'listaDeHabilidadesRequeridas', 5, 30, 800);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
