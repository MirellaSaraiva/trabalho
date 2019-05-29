-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Maio-2019 às 00:34
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rede_social_mm`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adicional`
--

CREATE TABLE `adicional` (
  `id_adic` int(100) NOT NULL,
  `id_usuario` int(100) NOT NULL,
  `localizacao` varchar(100) NOT NULL,
  `tatuador` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL COMMENT '1 para tatuador 0 para tatuado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `amizade`
--

CREATE TABLE `amizade` (
  `id_amizade` int(11) NOT NULL,
  `cod_enviado` int(11) NOT NULL,
  `cod_recebido` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `amizade`
--

INSERT INTO `amizade` (`id_amizade`, `cod_enviado`, `cod_recebido`, `status`) VALUES
(13, 9, 1, 2),
(14, 8, 1, 2),
(15, 6, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id_coment` int(100) NOT NULL,
  `cd_post` int(100) NOT NULL,
  `id_usuario` int(100) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `data_comentario` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id_coment`, `cd_post`, `id_usuario`, `comentario`, `data_comentario`) VALUES
(2, 1, 1, 'weqweqw', '12'),
(4, 9, 1, 'Massa', '25/12/2018'),
(5, 9, 1, 'Comentario', '25/05/2019'),
(6, 11, 1, 'Comentario', '25/05/2019');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtir`
--

CREATE TABLE `curtir` (
  `id_like` int(100) NOT NULL,
  `cod_post` int(100) NOT NULL,
  `cd_usuario` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curtir`
--

INSERT INTO `curtir` (`id_like`, `cod_post`, `cd_usuario`) VALUES
(1, 4, 2),
(2, 2, 6),
(5, 7, 1),
(12, 5, 1),
(15, 9, 1),
(16, 11, 1),
(17, 8, 1),
(18, 16, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

CREATE TABLE `post` (
  `id_post` int(100) NOT NULL,
  `post` varchar(200) NOT NULL,
  `img` varchar(200) NOT NULL,
  `cod_usuario` int(100) NOT NULL,
  `data_post` varchar(12) NOT NULL,
  `hora_post` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `post`
--

INSERT INTO `post` (`id_post`, `post`, `img`, `cod_usuario`, `data_post`, `hora_post`) VALUES
(1, 'postagem', 'https://bizimages.withfloats.com/actual/5c02667bf99440000146e020.jpg', 13, '2019-05-23', '01:53:49'),
(6, 'O Homem Vitruviano', 'https://i.ytimg.com/vi/qsVK5Vz8c0Y/maxresdefault.jpg', 9, '23/05/2019', '07:14:33'),
(7, 'Ultima ceia', 'https://www.tintanapele.com/wp-content/uploads/2016/11/Last-supper-Leonardo-Da-Vinci.jpg', 9, '23/05/2019', '07:15:10'),
(8, 'La Gioconda', 'https://www.pavablog.com/wp-content/uploads/2013/08/ta8.jpg', 9, '23/05/2019', '07:16:08'),
(9, 'light bulb', 'http://www.ondrash.com/pictures/ink/10.jpg', 8, '23/05/2019', '07:17:36'),
(10, 'ink', 'http://tattoooideas.com/wp-content/uploads/parser/Watercolor-Map-Tattoo-On-Arm-1.jpg', 8, '23/05/2019', '07:17:57'),
(11, 'Fox', 'http://www.ondrash.com/pictures/slider/03.jpg', 8, '23/05/2019', '07:18:12'),
(12, 'wolf', 'https://i.pinimg.com/originals/f8/e9/ca/f8e9caae6897483c665f4e8fe35cdf55.jpg', 8, '23/05/2019', '07:18:29'),
(13, 'tatuagens cubistas e cheias de cor', 'http://images.virgula.com.br/2017/03/tattoos-cubistas.jpg', 7, '23/05/2019', '07:28:17'),
(14, 'Cubismo', 'https://static.tudointeressante.com.br/uploads/2015/09/tatuagens-cubistas-4.jpg', 7, '23/05/2019', '07:28:31'),
(15, 'Inspirado pela obra de Gustav Klimt, Egon Schiele e Pablo Picasso', 'https://i.pinimg.com/originals/cf/65/a7/cf65a7997b4e46814aae039e2de1451d.jpg', 7, '23/05/2019', '07:29:23'),
(16, 'sailor', 'https://imgc.allpostersimages.com/img/print/u-g-Q19C61M0.jpg?w=550&h=550&p=0', 6, '28/05/2019', '00:20:31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(100) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `username`, `senha`, `foto`) VALUES
(1, 'Mirella', 'mirellalima', '3096a12945d046cd218d871a1b8f6288', 'https://http2.mlstatic.com/capa-de-celular-princesa-ariel-tatuada-iphone-5-5s-D_NQ_NP_22163-MLB20224599988_012015-F.jpgq=tbn:ANd9GcQNYErH29mIi-B3kx0WY6oP8vuYBywGwmk9MQBjKa4WN59wDItNFg'),
(6, 'Mariana R', 'mari.ribs', '81dc9bdb52d04dc20036dbd8313ed055', 'https://www.ahnegao.com.br/wp-content/uploads/2013/08/sailor.jpg'),
(7, 'Pablo Ruiz Picasso', 'picasso', '202cb962ac59075b964b07152d234b70', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Pablo_picasso_1.jpg/200px-Pablo_picasso_1.jpg'),
(8, 'Ondrash', 'ondrash', '202cb962ac59075b964b07152d234b70', 'https://images.britcdn.com/wp-content/uploads/2015/09/ondrash-tattoo-artist-instagram.png?w=1000&auto=format'),
(9, 'Leonardo da Vinci', 'leo', '202cb962ac59075b964b07152d234b70', 'https://s5.static.brasilescola.uol.com.br/img/2018/03/davinci.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adicional`
--
ALTER TABLE `adicional`
  ADD PRIMARY KEY (`id_adic`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `amizade`
--
ALTER TABLE `amizade`
  ADD PRIMARY KEY (`id_amizade`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id_coment`);

--
-- Indexes for table `curtir`
--
ALTER TABLE `curtir`
  ADD PRIMARY KEY (`id_like`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adicional`
--
ALTER TABLE `adicional`
  MODIFY `id_adic` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amizade`
--
ALTER TABLE `amizade`
  MODIFY `id_amizade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id_coment` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `curtir`
--
ALTER TABLE `curtir`
  MODIFY `id_like` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
