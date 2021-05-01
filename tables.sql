CREATE TABLE `usuarios` (
  `id` varchar(24) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `senha` varchar(25) COLLATE utf8_bin NOT NULL,
  `tipo` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `estagiarios` (
  `id` varchar(24) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) CHARACTER SET utf8_bin NOT NULL,
  `senha` varchar(50) CHARACTER SET utf8_bin NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8_bin NOT NULL,
  `curso` varchar(50) CHARACTER SET utf8_bin NOT NULL,
  `anoDeIngresso` int(11) NOT NULL,
  `miniCurriculo` varchar(500) CHARACTER SET latin1 NOT NULL,
  `usuarioID` varchar(24) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `empregadores` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nomeDoResponsavel` varchar(50) NOT NULL,
  `nomeDaEmpresa` varchar(50) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `produtos` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_bin;
