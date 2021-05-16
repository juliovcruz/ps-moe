-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16-Maio-2021 às 03:46
-- Versão do servidor: 5.7.31
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
  `id` varchar(24) COLLATE utf8_bin NOT NULL,
  `nomeDoResponsavel` varchar(50) COLLATE utf8_bin NOT NULL,
  `nomeDaEmpresa` varchar(50) COLLATE utf8_bin NOT NULL,
  `descricao` varchar(250) COLLATE utf8_bin NOT NULL,
  `produtos` varchar(250) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `senha` varchar(60) COLLATE utf8_bin NOT NULL,
  `token` varchar(24) COLLATE utf8_bin NOT NULL,
  `emailConfirmado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `empregadores`
--

INSERT INTO `empregadores` (`id`, `nomeDoResponsavel`, `nomeDaEmpresa`, `descricao`, `produtos`, `email`, `senha`, `token`, `emailConfirmado`) VALUES
('0daef1872905405f768163ef', 'Exercitationem qui e', 'Aut animi velit aut', 'Fugiat veniam dolo', 'Aut eum molestiae cu', 'rize@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '3c9904e6b28d74f127302c77', 0),
('19e9eb4428622b2afead33ab', 'teste', 'Nemo non eaque eos ', '12323', 'Saepe quia rerum eos', 'julio@empregador.com', 'e7d80ffeefa212b7c5c55700e4f7193e', 'b2fc4d595567aa3f6b707b57', 0),
('7b723fa48b7a5a8c4e4e7727', 'Et dolorem quisquam ', 'Totam maxime veniam', 'Non cupidatat fugiat', 'Ratione assumenda qu', 'vury@mailinator.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '61966acd5d41360f676c7e46', 0),
('afafc6256dc6b06e9d19e571', 'Adipisci rem anim en', 'Animi excepteur lor', 'Assumenda nisi volup', 'Ut laudantium tempo', 'lekyno@mailinator.com', 'e7d80ffeefa212b7c5c55700e4f7193e', 'bca10e5ce50f9e400a136c62', 0),
('b2050543f4200bc939d5a408', 'Mollitia dolor fuga', 'Consectetur in dolor', 'Perferendis in paria', 'Ratione quae distinc', 'naso@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'da7407a8c857f58bee47d465', 0),
('em_6090a35b0d15e', 'nomeDoResponsavel', 'nomeDaEmpresa', 'descricao', 'produtos', 'julio@gmail.com', '0c7d2830d586c7a2946b484e68eb2754', '', 0),
('em_6090a786c06c7', 'Julio Cesar', 'Auvo LTDA', 'DESCRICAO', 'PRODUTOS', 'cto@auvo.com', '0c7d2830d586c7a2946b484e68eb2754', '', 0),
('em_6090a8292c6ee', 'Julio Cesar', 'AUVO ltda', 'steansada', 'sdasdasda', 'teste@auvo.com', '0c7d2830d586c7a2946b484e68eb2754', '', 0),
('em_6090ad33beb03', 'TesteResponsa', 'TesteEpresa', 'DESCRICAO', 'Produtos', 'teste@teste.com', '0c7d2830d586c7a2946b484e68eb2754', '', 0),
('em_6090ad65dffaf', 'TesteResponsa', 'TesteEpresa', 'DESCRICAO', 'Produtos', 'teste@test1.com', '0c7d2830d586c7a2946b484e68eb2754', '', 0),
('f6ebe7dda858c2443962ee14', 'nomeRespon', 'nomeDaEmp', 'sadasdasdasd', 'sfasfasfasfas', 'teste@empregador.com', '69a7c30fa11c7c832965ae1527368177', 'fb0db050bb3ccd9b6b0c5b54', 0),
('fb1c1e8e2ac60b0156999def', 'Nemo quis cupiditate', 'Quaerat et soluta qu', 'Laborum quibusdam cu', 'Aliquid excepteur ne', 'wojadubi@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'a9fb5bdc54e72f8304adc3a6', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estagiarios`
--

DROP TABLE IF EXISTS `estagiarios`;
CREATE TABLE IF NOT EXISTS `estagiarios` (
  `id` varchar(24) COLLATE utf8_bin NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `curso` varchar(50) COLLATE utf8_bin NOT NULL,
  `anoDeIngresso` int(11) NOT NULL,
  `miniCurriculo` varchar(500) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `senha` varchar(60) COLLATE utf8_bin NOT NULL,
  `token` varchar(24) COLLATE utf8_bin NOT NULL,
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
('42cd3fe83b83c5eece0eb3ae', 'Omnis lorem consecte', 'Dolor accusamus labo', 2020, 'sdasddasda', 'fuhihe@mailinator.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '9a70b35fcb8184f8ca21b092', 0),
('497bc409bcdd88a1de9c2f64', 'Repudiandae facere l', 'Dolore ipsum reicie', 2021, 'Voluptas quasi sunt ', 'eu@mailinator.com', '$2y$10$UPYAEk9JunmfdnG0Mn96cO89ThC.lQ0Erc99MF4S2iQCZEv6kdjGq', 'f6973b22caebbff056dc6ba5', 0),
('4e7d61eaae1f8d199af956d3', 'Voluptate consectetu', 'Consequuntur asperio', 2021, 'Aut quasi sint dele', 'mynosa@mailinator.com', 'e7d80ffeefa212b7c5c55700e4f7193e', 'd0e418b2e4cdc3fede7e33d8', 0),
('5fde0c9c90e1066957ae4c89', 'Voluptate iusto quos', 'Qui dolores deleniti', 2021, 'Veritatis quia error', 'zarypisy@mailinator.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '9cb09b4c4f9bd6572a36cb70', 0),
('77863711d25d699e087eb542', 'Molestiae ipsum pers', 'Fugiat at quo conseq', 2040, 'Sed qui ea nulla nec', 'pigy@mailinator.com', '$2y$10$Sf7IbotgsnXA1uwFE2ww1OJiI3EMK5D.VqsLrE759atTvPigsTkUC', '', 0),
('b96b5328c1b13a2940d5e575', 'Amet velit vel offi', 'Est soluta animi bl', 2021, 'Quasi magni id eos ', 'nufo@mailinator.com', '$2y$10$JgkTsGjiBNWJedyqgK/O/.Q0F8Ha4Ye3OMCSYwUaFwmbhMuzzrPym', 'c03e8306aabc1dceddea3464', 0),
('e962a6f6851bdca95254c577', 'Magna lorem quia inv', 'Id laborum Illum ', 2021, 'Molestiae cum aperia', 'julio@estagiario.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '2567b610711eca5f3c41b3aa', 0),
('es_6090a806c13f8', 'Julio Cesar', 'Ciencias da Computacao', 2019, 'mini curriculo', 'julio@upnid.com', '0c7d2830d586c7a2946b484e68eb2754', '', 0),
('es_6090ad857ce16', 'NomeEstag', 'Cursoa', 2020, 'asdsadasdasda', 'teste@estag.com', '0c7d2830d586c7a2946b484e68eb2754', '', 0),
('f094f08555e1ccfcc7098c32', 'Quidem qui eum incid', 'Ad et impedit ut si', 4040, 'Ut id dolor fuga Se', 'qoqeh@mailinator.com', '$2y$10$U0PbTdEp9Kq7hKFHiYkf6OkohbvGGTKiK77.2.7Javl1AAfkM6zWO', '9f91ad6f74327bb1628686bf', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `interesse`
--

DROP TABLE IF EXISTS `interesse`;
CREATE TABLE IF NOT EXISTS `interesse` (
  `empregadorId` varchar(35) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `estagiarioId` varchar(35) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `interesse`
--

INSERT INTO `interesse` (`empregadorId`, `estagiarioId`) VALUES
('19e9eb4428622b2afead33ab', 'e962a6f6851bdca95254c577'),
('7b723fa48b7a5a8c4e4e7727', 'e962a6f6851bdca95254c577'),
('afafc6256dc6b06e9d19e571', 'e962a6f6851bdca95254c577');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

DROP TABLE IF EXISTS `vagas`;
CREATE TABLE IF NOT EXISTS `vagas` (
  `id` varchar(24) COLLATE utf8_bin NOT NULL,
  `empregadorID` varchar(24) COLLATE utf8_bin NOT NULL,
  `descricao` varchar(250) COLLATE utf8_bin NOT NULL,
  `listaDeAtividades` varchar(250) COLLATE utf8_bin NOT NULL,
  `listaDeHabilidadesRequeridas` varchar(250) COLLATE utf8_bin NOT NULL,
  `semestreRequerido` int(11) NOT NULL,
  `quantidadeDeHoras` int(11) NOT NULL,
  `remuneracao` double(10,0) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `vagas`
--

INSERT INTO `vagas` (`id`, `empregadorID`, `descricao`, `listaDeAtividades`, `listaDeHabilidadesRequeridas`, `semestreRequerido`, `quantidadeDeHoras`, `remuneracao`, `titulo`) VALUES
('3089fce4ce056c66f0d5c764', '19e9eb4428622b2afead33ab', 'Ut fugiat proident ', 'Ex nihil voluptatibu', 'Dolore nihil sequi d', 3, 3, 3, 'Qui ratione totam ac'),
('9a3abf32de8c49beff396d10', '19e9eb4428622b2afead33ab', 'Tempore soluta vita', 'Enim reprehenderit e', 'Non aperiam repellen', 3, 3, 3, ''),
('eebf88fbb0e9639808bc628f', '19e9eb4428622b2afead33ab', 'Vel elit ad provide', 'A debitis accusamus ', 'Sapiente porro provi', 1, 1, 1, 'Titulo asdada');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
