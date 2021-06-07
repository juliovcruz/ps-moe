-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 30-Maio-2021 às 13:58
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
-- Estrutura da tabela `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `limiteInferior` int(10) NOT NULL,
  `limiteSuperior` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `limiteInferior`, `limiteSuperior`) VALUES
('0daef1872905405f768163ef', 'Engenharia de Computacao', 2, 4),
('0daef1872905405f768163eg', 'Engenharia de Software', 1, 4),
('19e9eb4428622b2afead33ab', 'Sistemas de Informacao', 1, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empregadores`
--

DROP TABLE IF EXISTS `empregadores`;
CREATE TABLE IF NOT EXISTS `empregadores` (
  `id` varchar(32) COLLATE utf8_bin NOT NULL,
  `nomeDoResponsavel` varchar(50) COLLATE utf8_bin NOT NULL,
  `nomeDaEmpresa` varchar(50) COLLATE utf8_bin NOT NULL,
  `descricao` varchar(250) COLLATE utf8_bin NOT NULL,
  `produtos` varchar(250) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `senha` varchar(60) COLLATE utf8_bin NOT NULL,
  `token` varchar(32) COLLATE utf8_bin NOT NULL,
  `emailConfirmado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `empregadores`
--

INSERT INTO `empregadores` (`id`, `nomeDoResponsavel`, `nomeDaEmpresa`, `descricao`, `produtos`, `email`, `senha`, `token`, `emailConfirmado`) VALUES
('0daef1872905405f768163ef', 'Exercitationem qui e', 'Aut animi velit aut', 'Fugiat veniam dolo', 'Aut eum molestiae cu', 'rize@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '3c9904e6b28d74f127302c77', 0),
('19e9eb4428622b2afead33ab', 'teste', 'Rust', '12323', 'Saepe quia rerum eos', 'julio@empregador.com', 'e7d80ffeefa212b7c5c55700e4f7193e', 'b2fc4d595567aa3f6b707b57', 1),
('61e542823a506453501dbb82', 'Pariatur Culpa qui ', 'Repellendus Qui est', 'asdsadasdasd', '12312312312', 'wadi@mailinator.com', '9011ab17aebf0001e234ca71fe906dee', '02f1bcde21cd38388be33498', 0),
('7b723fa48b7a5a8c4e4e7727', 'Et dolorem quisquam ', 'Totam maxime veniam', 'Non cupidatat fugiat', 'Ratione assumenda qu', 'vury@mailinator.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '61966acd5d41360f676c7e46', 0),
('a7787502af8539ca3c5bed67', 'Doloremque autem ess', 'Corporis sint conse', 'Ut sit Nam expedita ', 'Proident voluptatib', 'omegalgamer@gmail.com', '7ae673cc307a2ec321f58558cbec9beb', 'd915b04ddb4d70f8c818ddec', 0),
('afafc6256dc6b06e9d19e571', 'Adipisci rem anim en', 'Animi excepteur lor', 'Assumenda nisi volup', 'Ut laudantium tempo', 'lekyno@mailinator.com', 'e7d80ffeefa212b7c5c55700e4f7193e', 'bca10e5ce50f9e400a136c62', 0),
('b2050543f4200bc939d5a408', 'Mollitia dolor fuga', 'Consectetur in dolor', 'Perferendis in paria', 'Ratione quae distinc', 'naso@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'da7407a8c857f58bee47d465', 0),
('b6be400cb7b13bb8ed67a92f', 'Nobis laudantium qu', 'Eius occaecat earum ', 'In eum nemo autem no', 'Labore rerum volupta', 'tikywub@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '4929595cf4d407363bbffb8b', 0),
('c442bd0f1ecdda2d693ca2bf', 'Omnis officiis elit', 'Impedit totam est d', 'Reprehenderit sunt ', 'Veniam eum molestia', 'hunidujan@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '778c0fd8bc24f6a098daf701', 0),
('db86954f3d8d514e88a0d006', 'Itaque pariatur Bea', 'Ea dicta et modi ali', 'Sequi id quia offici', 'Et in quo placeat s', 'tuxovan@mailinator.com', '7ae673cc307a2ec321f58558cbec9beb', 'a9f784994e99f7a113c36459', 0),
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
  `id` varchar(32) COLLATE utf8_bin NOT NULL,
  `nome` varchar(50) COLLATE utf8_bin NOT NULL,
  `cursoID` varchar(50) COLLATE utf8_bin NOT NULL,
  `anoDeIngresso` int(11) NOT NULL,
  `miniCurriculo` varchar(500) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `senha` varchar(60) COLLATE utf8_bin NOT NULL,
  `token` varchar(32) COLLATE utf8_bin NOT NULL,
  `emailConfirmado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `estagiarios`
--

INSERT INTO `estagiarios` (`id`, `nome`, `cursoID`, `anoDeIngresso`, `miniCurriculo`, `email`, `senha`, `token`, `emailConfirmado`) VALUES
('', 'KKKKKK', 'Eng Software', 2021, '', 'lucabbenetti@gmail.com', '1231234', '', 0),
('08bcb63724fc6845952dde9d', 'Rerum exercitation s', 'Inteligencia Artificial', 2021, 'Dicta duis atque qui', 'vywy@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'e77e31c0297b9048148eb727', 0),
('12345', 'joaoooo', 'engsfotware', 2022, 'algumacoisa', 'juliobobosort@mail.com', '1234564', '', 0),
('123456', 'joaoooo', 'engsfotware', 2022, 'algumacoisa', 'juliobobosort2@mail.com', '1234564', '', 0),
('1234567', 'vamovelho', 'engenharia de softw', 3000, 'eis aqui', 'julinho7@gmail.com', '1234567', '', 0),
('12345678', 'Necessitatibus dolor', 'Nulla amet praesent', 2030, 'Quidem aliquam ut iu', 'cuzeg@mailinator.com', 'Pa$$w0rd!', '', 0),
('1234567810', 'Dignissimos ipsum u', 'Voluptatem ut ipsam', 3333, 'Eius asperiores inci', 'diqovunare@mailinator.com', 'Pa$$w0rd!', '', 0),
('1c5a6a05448c8ae4e12d386b', 'Ipsum ut praesentium', 'Engenharia de Computacao', 2001, 'Consequatur ut quid', 'gujunil@mailinator.com', 'b40f617ddb056fc9c2d153158df3acb7', 'a5830c20f696748bb744b681', 0),
('42cd3fe83b83c5eece0eb3ae', 'Omnis lorem consecte', 'Dolor accusamus labo', 2020, 'sdasddasda', 'fuhihe@mailinator.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '9a70b35fcb8184f8ca21b092', 0),
('479d44ded4751ad6e8dc619c', 'Aut et et et volupta', 'Engenharia de Computacao', 2019, 'Qui ut qui exercitat', 'wasotasyv@mailinator.com', '7ae673cc307a2ec321f58558cbec9beb', '70d9db3d544daba74efcbdd9', 1),
('497bc409bcdd88a1de9c2f64', 'Repudiandae facere l', 'Dolore ipsum reicie', 2021, 'Voluptas quasi sunt ', 'eu@mailinator.com', '$2y$10$UPYAEk9JunmfdnG0Mn96cO89ThC.lQ0Erc99MF4S2iQCZEv6kdjGq', 'f6973b22caebbff056dc6ba5', 0),
('4e7d61eaae1f8d199af956d3', 'Voluptate consectetu', 'Consequuntur asperio', 2021, 'Aut quasi sint dele', 'mynosa@mailinator.com', 'e7d80ffeefa212b7c5c55700e4f7193e', 'd0e418b2e4cdc3fede7e33d8', 0),
('5fde0c9c90e1066957ae4c89', 'Voluptate iusto quos', 'Qui dolores deleniti', 2021, 'Veritatis quia error', 'zarypisy@mailinator.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '9cb09b4c4f9bd6572a36cb70', 0),
('77863711d25d699e087eb542', 'Molestiae ipsum pers', 'Fugiat at quo conseq', 2040, 'Sed qui ea nulla nec', 'pigy@mailinator.com', '$2y$10$Sf7IbotgsnXA1uwFE2ww1OJiI3EMK5D.VqsLrE759atTvPigsTkUC', '', 0),
('7f51a9809c39be3cfd24d650', 'Tempora consectetur', '19e9eb4428622b2afead33ab', 2018, 'Minim ratione in qui', 'syvypa2@mailinator.com', '6d91b869629e321ffe27c02914a8619c', '580c26f73da049d49f884b82', 1),
('80e1f7f362f4383c4f981083', 'Ut beatae in laborum', '', 2013, 'Voluptate voluptatem', 'syvyp@mailinator.com', '6d91b869629e321ffe27c02914a8619c', '08e52ac55ce4b1bffae878d3', 0),
('84185769845c4e7853c1860e', 'Rerum asperiores sin', '0daef1872905405f768163eg', 2012, 'Illo iusto ullam neq', 'syvypa@mailinator.com', '6d91b869629e321ffe27c02914a8619c', 'a74f3423b3062da39a9a8ccf', 1),
('8b91ee425b701fa6224ddb31', 'Qui maiores tempor n', '', 2019, 'Voluptate ut minus n', 'juliiii@gmail.com', '6d91b869629e321ffe27c02914a8619c', '2647103370e9e61421da54b6', 0),
('a1de2796362d7be00a99b590', 'Voluptas doloribus l', '0daef1872905405f768163ef', 2019, 'asdsadasdas', 'qeho@mailinator.com', '8efb658a31ad595d8c06ca128c8fe2ac', '539a4b95a91a65c408011717', 0),
('b96b5328c1b13a2940d5e575', 'Amet velit vel offi', 'Est soluta animi bl', 2021, 'Quasi magni id eos ', 'nufo@mailinator.com', '$2y$10$JgkTsGjiBNWJedyqgK/O/.Q0F8Ha4Ye3OMCSYwUaFwmbhMuzzrPym', 'c03e8306aabc1dceddea3464', 0),
('d3987bda5eea6e6816536742', 'Animi autem ullamco', '', 2018, 'Dolore quo ullamco v', 'kewafazeny@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '53afe8a67ecaf6d4a8f85375', 0),
('e962a6f6851bdca95254c577', 'Magna lorem quia inv', 'Engenharia de Computacao', 2021, 'Molestiae cum aperia', 'julio@estagiario.com', 'e7d80ffeefa212b7c5c55700e4f7193e', '2567b610711eca5f3c41b3aa', 0),
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
('em_6090ad65dffaf', 'e962a6f6851bdca95254c577'),
('em_6090ad33beb03', 'e962a6f6851bdca95254c577'),
('em_6090a8292c6ee', 'e962a6f6851bdca95254c577'),
('em_6090a786c06c7', 'e962a6f6851bdca95254c577'),
('em_6090a35b0d15e', 'e962a6f6851bdca95254c577'),
('afafc6256dc6b06e9d19e571', 'e962a6f6851bdca95254c577'),
('b2050543f4200bc939d5a408', 'e962a6f6851bdca95254c577'),
('7b723fa48b7a5a8c4e4e7727', 'e962a6f6851bdca95254c577'),
('19e9eb4428622b2afead33ab', 'e962a6f6851bdca95254c577'),
('0daef1872905405f768163ef', 'e962a6f6851bdca95254c577'),
('b2050543f4200bc939d5a408', '1c5a6a05448c8ae4e12d386b'),
('em_6090a35b0d15e', '1c5a6a05448c8ae4e12d386b'),
('em_6090a786c06c7', '1c5a6a05448c8ae4e12d386b'),
('em_6090a8292c6ee', '1c5a6a05448c8ae4e12d386b'),
('em_6090ad33beb03', '1c5a6a05448c8ae4e12d386b'),
('em_6090ad65dffaf', '1c5a6a05448c8ae4e12d386b'),
('f6ebe7dda858c2443962ee14', 'e962a6f6851bdca95254c577'),
('fb1c1e8e2ac60b0156999def', 'e962a6f6851bdca95254c577'),
('0daef1872905405f768163ef', '479d44ded4751ad6e8dc619c'),
('19e9eb4428622b2afead33ab', '479d44ded4751ad6e8dc619c'),
('24a64e6024ab8b09fac82fd6', '479d44ded4751ad6e8dc619c'),
('61e542823a506453501dbb82', '479d44ded4751ad6e8dc619c'),
('7b723fa48b7a5a8c4e4e7727', '479d44ded4751ad6e8dc619c'),
('19e9eb4428622b2afead33ab', '7f51a9809c39be3cfd24d650'),
('61e542823a506453501dbb82', '7f51a9809c39be3cfd24d650'),
('7b723fa48b7a5a8c4e4e7727', '7f51a9809c39be3cfd24d650');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

DROP TABLE IF EXISTS `vagas`;
CREATE TABLE IF NOT EXISTS `vagas` (
  `id` varchar(32) COLLATE utf8_bin NOT NULL,
  `empregadorID` varchar(32) COLLATE utf8_bin NOT NULL,
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
('06b84f6cb3c555a833ed94dc', '19e9eb4428622b2afead33ab', 'Desenvolvimento de software utilizando a linguagem javascript', 'Nam est reprehenderi', 'Necessitatibus volup', 30, 20, 1500, 'FrontEnd Intern'),
('3089fce4ce056c66f0d5c764', '19e9eb4428622b2afead33ab', 'Ut fugiat proident ', 'Ex nihil voluptatibu', 'Dolore nihil sequi d', 3, 3, 3, 'Qui ratione totam ac'),
('5a91b0f76ceb606cae81dedc', '19e9eb4428622b2afead33ab', 'Quo sint est asperna', 'Atque dolorum esse ', 'Sit aut numquam dist', 30, 30, 1500, 'Harum esse nulla ali'),
('5af3e0c255a1fc98c41420f5', '19e9eb4428622b2afead33ab', 'Non itaque corrupti', 'Delectus dolor eius', 'Et reprehenderit asp', 3, 30, 1500, 'Magni numquam nisi s'),
('7d6df48ea7526f01863744bb', '19e9eb4428622b2afead33ab', 'Desenvolvimento de software utilizando a linguagem Golang', 'Necessitatibus tempo', 'Velit consequatur ', 3, 30, 2000, 'Back-End Intern'),
('7eb0cb104a7ea02ead2ed3a8', '19e9eb4428622b2afead33ab', 'Descrição grande da vaga asd sad asd asd as dasdasd as dsa dasd asd a', 'Dolorem quo inventor', 'Aut in saepe archite', 30, 30, 2000, 'Tester'),
('93d57536feece4b7d83cede2', '19e9eb4428622b2afead33ab', 'Molestiae ducimus c', 'Est maxime rem non u', 'Commodi eum mollit c', 3, 20, 1500, 'Sed corporis veniam'),
('9a3abf32de8c49beff396d10', '19e9eb4428622b2afead33ab', 'Tempore soluta vita', 'Enim reprehenderit e', 'Non aperiam repellen', 3, 3, 3, ''),
('b7bc78bfb2d5c902ed7a06dc', '19e9eb4428622b2afead33ab', 'Eum sunt praesentium', 'Voluptates est volup', 'Voluptas nisi aut ex', 10, 20, 900, 'Quia mollit aut eius'),
('d537d7d159675bc50fb2990a', '19e9eb4428622b2afead33ab', 'Facilis eum dolorem ', 'Illum aperiam quia ', 'Nulla consequatur po', 1, 20, 2000, 'Molestiae cum except'),
('eebf88fbb0e9639808bc628f', '19e9eb4428622b2afead33ab', 'Vel elit ad provide', 'A debitis accusamus ', 'Sapiente porro provi', 1, 1, 1, 'Titulo asdada');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
