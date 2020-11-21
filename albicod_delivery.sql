-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Nov-2020 às 15:41
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `albicod_delivery`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'BEBIDAS'),
(2, 'PIZZAS'),
(3, 'LANCHES'),
(4, 'SALGADOS'),
(5, 'PROMOÇÕES'),
(6, 'SUCOS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidades`
--

CREATE TABLE `cidades` (
  `id` int(11) NOT NULL,
  `cidade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidades`
--

INSERT INTO `cidades` (`id`, `cidade`) VALUES
(1, 'Gandu/BA'),
(2, 'Wenceslau Guimarães/BA'),
(3, 'Ipiau/BA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `favicon` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `id_cidade` varchar(50) NOT NULL,
  `tempo_espera` varchar(100) NOT NULL,
  `taxa_envio` varchar(30) NOT NULL,
  `whatsapp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`id`, `empresa`, `logo`, `favicon`, `titulo`, `endereco`, `bairro`, `id_cidade`, `tempo_espera`, `taxa_envio`, `whatsapp`) VALUES
(1, 'Albicod Desenvolvimentos', 'c4bd0fdf9d5f0f67381652fdaae89f3b.png', '94e8d01761cd3e2ba488557f841a3d49.png', 'Albicod - Pediu Chegou', 'Rua Pracinio Ricardo da Silva, 103', 'Teotonio Callheira', '1', '35m - 1h10m', '3.00', '73999412514');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config_horario_funcionamento`
--

CREATE TABLE `config_horario_funcionamento` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config_horario_funcionamento`
--

INSERT INTO `config_horario_funcionamento` (`id`, `descricao`) VALUES
(1, 'Almoço Executivo das 11h às 15h'),
(2, 'Lanchonete e Pizzaria das 18h às 00:40hs');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `forma_entrega` int(11) NOT NULL,
  `descricao` text,
  `cliente` varchar(100) NOT NULL,
  `contato` varchar(100) NOT NULL,
  `forma_pagamento` int(11) NOT NULL,
  `troco` int(50) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `id_cidade` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `forma_entrega`, `descricao`, `cliente`, `contato`, `forma_pagamento`, `troco`, `endereco`, `bairro`, `id_cidade`, `status`, `data_registro`) VALUES
(1, 1, '', 'Thiago Alves', '73999412514', 1, 20, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 1, '2020-10-30 18:30:14'),
(2, 1, '2 Sabores: 4 queijos e calabreza', 'Thiago Alves', '73999412514', 1, 100, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 1, '2020-10-30 03:00:00'),
(3, 2, '', 'Thiago Alves', '73999412514', 0, 0, '', '', 1, 1, '2020-10-28 18:33:39'),
(4, 2, '', 'Thiago Alves', '73999412514', 0, 0, '', '', 1, 1, '2020-10-28 18:49:48'),
(5, 2, '', 'Thiago Alves', '73999412514', 0, 0, '', '', 1, 1, '2020-10-28 18:55:38'),
(6, 1, '', 'Thiago Alves', '73999412514', 2, 0, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 1, '2020-10-28 18:57:09'),
(7, 1, '', 'Thiago Alves', '73999412514', 1, 10, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 1, '2020-10-28 18:59:48'),
(8, 1, 'OK', 'Thiago Alves', '73999412514', 1, 5, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 2, '2020-10-29 11:38:40'),
(9, 2, 'Pizza 2 Sabores - 4 queijos e calabresa', 'Thiago Alves', '73999179660', 0, 0, '', '', 1, 2, '2020-10-29 12:59:25'),
(10, 1, 'OK', 'Thiago Alves', '73999412514', 1, 100, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 2, '2020-10-29 17:37:25'),
(11, 1, 'OK', 'Thiago Alves', '73999412514', 1, 50, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 2, '2020-10-29 17:46:46'),
(12, 1, '', 'Thiago Alves', '73999412514', 1, 5, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 1, '2020-10-29 17:48:37'),
(13, 1, '', 'Thiago Alves', '73999412514', 1, 6, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 2, '2020-10-29 17:49:20'),
(14, 1, '', 'Thiago Alves', '73999412514', 1, 6, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 2, '2020-10-29 17:53:05'),
(15, 1, '', 'Teste', '73999179660', 1, 10, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 2, '2020-10-29 18:06:20'),
(16, 1, '', 'Thiago Alves', '73999412514', 1, 10, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 1, '2020-10-29 18:11:25'),
(17, 1, '', 'Thiago Alves', '73999412514', 1, 4, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 1, '2020-10-29 18:26:26'),
(18, 1, '', 'Thiago Alves', '73999412514', 1, 5, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 1, '2020-11-03 20:13:29'),
(19, 1, '', 'Thiago Alves', '73999412514', 1, 11, 'Rua da Tulipa, 103', 'Teotonio Calheira', 1, 1, '2020-11-03 20:31:15'),
(20, 2, '', 'Thiago Alves', '73999412514', 0, 0, '', '', 1, 1, '2020-11-06 19:17:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_produtos`
--

CREATE TABLE `pedidos_produtos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos_produtos`
--

INSERT INTO `pedidos_produtos` (`id`, `id_pedido`, `id_produto`, `quantidade`) VALUES
(1, 1, 6, 1),
(2, 1, 5, 1),
(3, 2, 6, 2),
(4, 2, 10, 2),
(5, 3, 9, 1),
(6, 4, 6, 1),
(7, 5, 6, 1),
(8, 6, 7, 2),
(9, 6, 5, 1),
(10, 6, 4, 1),
(11, 7, 7, 1),
(12, 7, 1, 3),
(13, 8, 6, 1),
(14, 9, 6, 2),
(15, 9, 8, 1),
(16, 10, 6, 1),
(17, 10, 8, 1),
(18, 10, 9, 2),
(19, 11, 6, 1),
(20, 11, 8, 1),
(21, 12, 6, 1),
(22, 13, 6, 1),
(23, 14, 6, 1),
(24, 15, 6, 1),
(25, 16, 7, 1),
(26, 16, 4, 1),
(27, 17, 6, 1),
(28, 18, 6, 1),
(29, 18, 7, 1),
(30, 19, 6, 1),
(31, 19, 7, 1),
(32, 20, 6, 2),
(33, 20, 8, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `valor` varchar(50) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `id_categoria` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `valor`, `imagem`, `status`, `id_categoria`, `data_registro`) VALUES
(1, 'Banana Real', 'Tamanho: P\r\nRecheio: Banana da Terra Frita', '2.00', '0e7da08bf429290e3aa6532a915bb7e4.png', 1, 4, '2020-10-27 12:36:20'),
(2, 'Pastel de Carne', 'Tamanho M', '2.50', 'f5801d49b7c609c0fedc9ea14b639901.png', 1, 4, '2020-10-27 12:38:39'),
(3, 'Pastel de Frango', 'Tamanho: M\r\nRecheio: Frango', '3.00', '4b0ec7407db71dec7fa0bc7eea13f880.png', 1, 4, '2020-10-27 12:40:03'),
(4, 'Hamburguer', 'Recheio\r\nCarne\r\nQueijo\r\nAlface\r\nTomate', '5.00', '3ed449680c5e6bc4154b3c07214c5c52.png', 1, 3, '2020-10-27 12:41:34'),
(5, 'Combo X1', 'Hamburguer + Batata Frita', '8.00', '127783de9acb04f6985d332cb3e830b8.png', 1, 3, '2020-10-27 12:42:44'),
(6, 'Coca-Cola 600ml', 'Tamanho: 600ml', '3.50', '8f4e9ae18703b1ab2e5232414d3e842a.png', 1, 1, '2020-10-27 12:44:29'),
(7, 'Coca-Cola - Latinha', 'Coca-Cola - Latinha\r\n300ml', '3.50', '949228d96db010dbf4ff3f6924a32093.png', 1, 1, '2020-10-27 12:45:42'),
(8, 'Pizza Calabresa - Tamanho P', 'Tamanho P\r\n4 Fatias', '22.00', 'ec1c616ce25f7594ada10f21b3ed5cc3.png', 1, 2, '2020-10-27 12:48:33'),
(9, 'Pizza Calabresa - Tamanho M', 'Pizza Calabresa\r\nTamanho M\r\n06 Fatias', '28.00', '10deb54fcebc5288991ae4421c96ff10.png', 1, 2, '2020-10-27 12:49:30'),
(10, 'Pizza Calabresa - Tamanho G', 'Pizza Calabresa\r\nTamanho G\r\n08 Fatias', '32.00', '5d6f2b7b7d1bfd273716e448fa70af56.png', 1, 2, '2020-10-27 12:50:01'),
(11, 'Pizza Calabresa - Tamanho EG', 'Pizza Calabresa\r\nTamanho EX\r\n12 Fatias', '45.00', '1f0d717d808521e6427e0c41aa7a3484.png', 1, 5, '2020-10-27 12:50:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_acrescimos`
--

CREATE TABLE `produtos_acrescimos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `item` varchar(100) NOT NULL,
  `valor` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos_acrescimos`
--

INSERT INTO `produtos_acrescimos` (`id`, `id_categoria`, `item`, `valor`, `status`) VALUES
(1, 2, 'Queijo Muzzarela', '1.00', 1),
(2, 2, 'Queijo Parmesão', '1.50', 1),
(3, 3, 'Frango', '0.60', 1),
(4, 3, 'Queijo Muzzarela', '1.00', 1),
(5, 4, 'Frango', '0.60', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `definicao` int(11) NOT NULL DEFAULT '1',
  `data_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `status`, `definicao`, `data_registro`) VALUES
(1, 'System', 'thiagoalves@albicod.com', '202cb962ac59075b964b07152d234b70', 1, 1, '2020-10-26 11:52:19'),
(2, 'Admin', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 1, 1, '2020-10-26 11:52:51'),
(3, 'Colaborador', 'colaborador@delivery.com', '202cb962ac59075b964b07152d234b70', 1, 2, '2020-10-26 11:53:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_horario_funcionamento`
--
ALTER TABLE `config_horario_funcionamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos_acrescimos`
--
ALTER TABLE `produtos_acrescimos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `config_horario_funcionamento`
--
ALTER TABLE `config_horario_funcionamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produtos_acrescimos`
--
ALTER TABLE `produtos_acrescimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
