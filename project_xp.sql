-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09-Mar-2024 às 00:10
-- Versão do servidor: 8.2.0
-- versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `project_xp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_views`
--

DROP TABLE IF EXISTS `site_views`;
CREATE TABLE IF NOT EXISTS `site_views` (
  `id` double UNSIGNED NOT NULL AUTO_INCREMENT,
  `s_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `users` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pages` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ano` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `site_views`
--

INSERT INTO `site_views` (`id`, `s_date`, `users`, `views`, `pages`, `dia`, `mes`, `ano`) VALUES
(1, '2024-02-25', '1', '1', '1', '25', '02', '2024'),
(2, '2024-02-26', '1', '1', '1', '26', '02', '2024'),
(3, '2024-03-08', '1', '1', '1', '08', '03', '2024');

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_views_agent`
--

DROP TABLE IF EXISTS `site_views_agent`;
CREATE TABLE IF NOT EXISTS `site_views_agent` (
  `id` double UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `site_views_agent`
--

INSERT INTO `site_views_agent` (`id`, `name`, `views`) VALUES
(1, 'Chrome', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_views_online`
--

DROP TABLE IF EXISTS `site_views_online`;
CREATE TABLE IF NOT EXISTS `site_views_online` (
  `id` double UNSIGNED NOT NULL AUTO_INCREMENT,
  `session` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `startview` varchar(270) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `endview` varchar(270) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `server_ip` varchar(270) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(270) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(270) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` varchar(270) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `site_views_online`
--

INSERT INTO `site_views_online` (`id`, `session`, `startview`, `endview`, `server_ip`, `ip`, `url`, `agent`, `name`) VALUES
(11, 'actg0866jnj0b449tm1arf78in', '2024-03-09 00:08:29', '2024-03-09 00:14:58', '::1', '::1', '/JorgeViagens/index.php?exe=default/home', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'Chrome');

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_views_static`
--

DROP TABLE IF EXISTS `site_views_static`;
CREATE TABLE IF NOT EXISTS `site_views_static` (
  `id` double UNSIGNED NOT NULL AUTO_INCREMENT,
  `session` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startview` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endview` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `server_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ano` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `site_views_static`
--

INSERT INTO `site_views_static` (`id`, `session`, `startview`, `endview`, `server_ip`, `ip`, `url`, `agent`, `dia`, `mes`, `ano`, `hora`) VALUES
(1, '50bud5d6tablc8892avu4on3ve', '2024-02-25 11:34:18', '2024-02-25 11:39:18', '::1', '::1', '/JorgeViagens/__admin.php', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '25', '02', '2024', '11:34:18'),
(2, '50bud5d6tablc8892avu4on3ve', '2024-02-25 17:45:13', '2024-02-25 17:50:13', '::1', '::1', '/JorgeViagens/__admin.php?exe=create/create&lang=pt', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '25', '02', '2024', '17:45:13'),
(3, '50bud5d6tablc8892avu4on3ve', '2024-02-25 22:35:10', '2024-02-25 22:40:10', '::1', '::1', '/JorgeViagens/__admin.php?exe=config/config_us&lang=pt', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '25', '02', '2024', '22:35:10'),
(4, '50bud5d6tablc8892avu4on3ve', '2024-02-25 22:52:01', '2024-02-25 22:57:01', '::1', '::1', '/JorgeViagens/__admin.php?exe=create/create&lang=pt', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '25', '02', '2024', '22:52:01'),
(5, 'o9aivr5rbhmrihj2lnq7j2nvir', '2024-02-26 22:04:16', '2024-02-26 22:09:16', '::1', '::1', '/JorgeViagens/index.php?exe=deault/home', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '26', '02', '2024', '22:04:16'),
(6, 'fatktknevof85sect7d790093c', '2024-02-26 22:12:11', '2024-02-26 22:17:11', '::1', '::1', '/JorgeViagens/index.php?exe=deault/home', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '26', '02', '2024', '22:12:11'),
(7, 'fatktknevof85sect7d790093c', '2024-02-26 22:31:12', '2024-02-26 22:36:12', '::1', '::1', '/JorgeViagens/__admin.php?exe=config/config_us&lang=pt', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '26', '02', '2024', '22:31:12'),
(8, 'fatktknevof85sect7d790093c', '2024-02-26 22:40:21', '2024-02-26 22:45:21', '::1', '::1', '/JorgeViagens/__admin.php?exe=gallery/create&lang=pt', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '26', '02', '2024', '22:40:21'),
(9, 'actg0866jnj0b449tm1arf78in', '2024-03-08 22:39:44', '2024-03-08 22:44:44', '::1', '::1', '/JorgeViagens/index.php?exe=deault/home', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '08', '03', '2024', '22:39:44'),
(10, 'actg0866jnj0b449tm1arf78in', '2024-03-08 23:50:01', '2024-03-08 23:55:01', '::1', '::1', '/JorgeViagens/__admin.php?exe=create/index_create&lang=pt&page=2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '08', '03', '2024', '23:50:01'),
(11, 'actg0866jnj0b449tm1arf78in', '2024-03-09 00:08:29', '2024-03-09 00:13:29', '::1', '::1', '/JorgeViagens/__admin.php?exe=create/update&postId=9&lang=pt', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', '09', '03', '2024', '00:08:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_author_and_test_and_team`
--

DROP TABLE IF EXISTS `xp_author_and_test_and_team`;
CREATE TABLE IF NOT EXISTS `xp_author_and_test_and_team` (
  `id` double NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `function_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `extra` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posts` double DEFAULT NULL,
  `views` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `xp_author_and_test_and_team`
--

INSERT INTO `xp_author_and_test_and_team` (`id`, `name`, `cover`, `facebook`, `twitter`, `linkedin`, `instagram`, `function_1`, `content`, `extra`, `hora`, `data`, `status`, `type`, `lang`, `posts`, `views`) VALUES
(1, 'Ludgero Cabral', NULL, '', '', '', '', '', '<p>Simpatia, efici&ecirc;ncia e disponibilidade 24 horas por dia. Merece mais estrelas.</p>', '', '23:03:10', '25-02-2024', 1, 'testimonial', 'pt', NULL, NULL),
(2, 'Isabel Silva', 'images/2024/02/0sofia-teixeira.jpg', '', '', '', '', '', '<p>Profissionalismo, simpatia e disponibilidade, inclusive para responder a todas as d&uacute;vidas.</p>', '', '23:03:51', '25-02-2024', 1, 'testimonial', 'pt', NULL, NULL),
(3, 'Ana Rodrigues', 'images/2024/02/0marta-pereira.jpg', '', '', '', '', '', '<p>Minha viagem com a JORGE VIAGENS foi incr&iacute;vel! Equipe dedicada e atenciosa.</p>', '', '23:04:37', '25-02-2024', 1, 'testimonial', 'pt', NULL, NULL),
(4, 'Carla Mendes', 'images/2024/02/0ana-silva.jpg', '', '', '', '', '', '<p>Viajar com a JORGE VIAGENS &eacute; sin&ocirc;nimo de tranquilidade e experi&ecirc;ncias memor&aacute;veis.</p>', '', '23:05:10', '25-02-2024', 1, 'testimonial', 'pt', NULL, NULL),
(5, 'Pedro Almeida', 'images/2024/02/0carlos-santos.jpg', '', '', '', '', '', '<p>Servi&ccedil;o de alta qualidade. Sempre prontos para superar expectativas.</p>', '', '23:05:46', '25-02-2024', 1, 'testimonial', 'pt', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_blog`
--

DROP TABLE IF EXISTS `xp_blog`;
CREATE TABLE IF NOT EXISTS `xp_blog` (
  `id` double NOT NULL AUTO_INCREMENT,
  `id_category` double DEFAULT NULL,
  `id_author` double DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ano` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commint` double DEFAULT NULL,
  `status` int DEFAULT NULL,
  `views` double DEFAULT NULL,
  `likes` double DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credito_imagem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempo_leitura` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key_word` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_category`
--

DROP TABLE IF EXISTS `xp_category`;
CREATE TABLE IF NOT EXISTS `xp_category` (
  `id` double NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `views` double DEFAULT NULL,
  `likes` double DEFAULT NULL,
  `posts` double DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_config`
--

DROP TABLE IF EXISTS `xp_config`;
CREATE TABLE IF NOT EXISTS `xp_config` (
  `id` double NOT NULL AUTO_INCREMENT,
  `instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_rodape` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_host` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_porta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endereco` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `xp_config`
--

INSERT INTO `xp_config` (`id`, `instagram`, `youtube`, `cover`, `cover_rodape`, `icon`, `content`, `email_host`, `email_senha`, `email_porta`, `email_name`, `status`, `name`, `telefone`, `email`, `endereco`, `facebook`, `twitter`, `linkedin`, `whatsapp`) VALUES
(1, '', '', 'images/2024/02/0jorgeviagens-logotype.png', 'images/2024/02/1jorgeviagens-logotype.png', 'images/2024/02/2jorgeviagens-logotype.png', NULL, 'mail.jorgeviagens.ao', '##k@167435', '465', 'Jorge Viagens', 1, 'Jorge Viagens RENT A CAR', '927 261 817 | 941 151 890 | 914 151 890', 'geral@jorgeviagens.ao', 'Lobito - Zona Comercial, rua 15 de Agosto, Benguela - Angola.', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_create_all_in_one`
--

DROP TABLE IF EXISTS `xp_create_all_in_one`;
CREATE TABLE IF NOT EXISTS `xp_create_all_in_one` (
  `id` double NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `xp_create_all_in_one`
--

INSERT INTO `xp_create_all_in_one` (`id`, `title`, `subtitle`, `cover`, `content`, `data`, `hora`, `type`, `status`, `lang`) VALUES
(1, 'Bem-vindo à JORGE VIAGENS RENT A CAR!', '', 'images/2024/02/0home.jpg', '<p>&Eacute; uma empresa de transporte angolana dedicada a fornecer solu&ccedil;&otilde;es confi&aacute;veis e eficientes para nossos clientes.&nbsp;</p>', '25-02-2024', '17:45:14', 'home', 1, 'pt'),
(2, 'Quem Somos?', '', 'images/2024/02/0about.jpg', '<p>A JORGE VIAGENS, pertencente ao grupo JORGE COM&Eacute;RCIO E SERVI&Ccedil;OS (SU), LDA, &eacute; uma empresa de direito angolano que atua especificamente no ramo de TRANSPORTES. Com uma s&oacute;lida base e experi&ecirc;ncia, a JORGE VIAGENS oferece servi&ccedil;os de transporte confi&aacute;veis e eficientes para seus clientes.</p>\r\n<p>Estamos comprometidos em fornecer servi&ccedil;os de alta qualidade, cumprindo os padr&otilde;es de seguran&ccedil;a e atendendo &agrave;s expectativas de nossos clientes. Seja para viagens de neg&oacute;cios, turismo ou transporte de mercadorias, a JORGE VIAGENS est&aacute; pronta para atender &agrave;s suas necessidades.</p>\r\n<p>&nbsp;</p>', '25-02-2024', '17:59:33', 'sobre', 1, 'pt'),
(4, 'Missão', '', 'images/2024/02/0missao.png', '<p>Fornecer servi&ccedil;os de transporte terrestre de forma segura, eficiente e confi&aacute;vel. Nosso compromisso &eacute; cumprir prazos, garantir a seguran&ccedil;a dos passageiros e da carga, e reduzir impactos ambientais.</p>', '25-02-2024', '18:46:17', 'sobre', 1, 'pt'),
(13, 'Valores', '', 'images/2024/03/0valores.png', '<p>Integridade: Compromisso com a honestidade, &eacute;tica e transpar&ecirc;ncia em todas as a&ccedil;&otilde;es. Inova&ccedil;&atilde;o: Busca constante por solu&ccedil;&otilde;es criativas e novas maneiras de fazer as coisas. Qualidade: Compromisso com a excel&ecirc;ncia e a entrega de servi&ccedil;os de alta qualidade. Responsabilidade: Assumir responsabilidade por a&ccedil;&otilde;es e impacto no ambiente, comunidade e funcion&aacute;rios.</p>', '08-03-2024', '23:25:19', 'sobre', 1, 'pt'),
(12, 'Visão', '', 'images/2024/03/0visao.png', '<p>Crescimento; Inova&ccedil;&atilde;o; Posicionamento no mercado; Tornar-se a principal fornecedora de solu&ccedil;&otilde;es de log&iacute;stica sustent&aacute;vel a n&iacute;vel nacional; Expandir nossos servi&ccedil;os a n&iacute;vel nacional e internacional como l&iacute;der em transporte rodovi&aacute;rio de passageiros e de mercadorias.</p>\r\n<p>&nbsp;</p>', '08-03-2024', '23:23:51', 'sobre', 1, 'pt'),
(6, 'Rent a car', '', 'images/2024/02/0rent-a-car.jpg', '', '25-02-2024', '22:41:00', 'servico', 1, 'pt'),
(7, 'Motorista Express', '', 'images/2024/03/0car4.jpg', '', '25-02-2024', '22:41:16', 'servico', 1, 'pt'),
(8, 'Apoio de transporte de mercadorias para motivos de mudanças de residência', '', 'images/2024/03/0car3.jpg', '', '25-02-2024', '22:46:42', 'servico', 1, 'pt'),
(9, 'Viagens rodoviárias interprovinciais e internacionais até a fronteira da Namíbia', '', 'images/2024/03/0car5.jpg', '', '25-02-2024', '22:52:01', 'servico', 1, 'pt'),
(10, 'Transporte de passageiros', '', 'images/2024/03/0car1.jpg', '', '25-02-2024', '22:52:34', 'servico', 1, 'pt'),
(11, 'Transporte de mercadorias de pequeno, médio e grande porte', '', 'images/2024/03/0car2.jpg', '', '25-02-2024', '22:52:47', 'servico', 1, 'pt');

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_faqs`
--

DROP TABLE IF EXISTS `xp_faqs`;
CREATE TABLE IF NOT EXISTS `xp_faqs` (
  `id` double NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_gallery`
--

DROP TABLE IF EXISTS `xp_gallery`;
CREATE TABLE IF NOT EXISTS `xp_gallery` (
  `id` double NOT NULL AUTO_INCREMENT,
  `data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `xp_gallery`
--

INSERT INTO `xp_gallery` (`id`, `data`, `hora`, `name`, `cover`, `status`, `lang`) VALUES
(1, '26-02-2024', '22:40:31', '...', 'gallery/2024/02/050726f536d617274-gb-50726f536d617274-40320.png', 1, 'pt'),
(2, '26-02-2024', '22:40:31', '...', 'gallery/2024/02/050726f536d617274-gb-50726f536d617274-19751.png', 1, 'pt'),
(3, '26-02-2024', '22:40:31', '...', 'gallery/2024/02/050726f536d617274-gb-50726f536d617274-2b915.png', 1, 'pt'),
(4, '26-02-2024', '22:40:31', '...', 'gallery/2024/02/050726f536d617274-gb-50726f536d617274-f007d.png', 1, 'pt'),
(5, '26-02-2024', '22:40:31', '...', 'gallery/2024/02/050726f536d617274-gb-50726f536d617274-00fd8.png', 1, 'pt'),
(6, '26-02-2024', '22:40:31', '...', 'gallery/2024/02/050726f536d617274-gb-50726f536d617274-21f3d.png', 1, 'pt'),
(7, '26-02-2024', '22:40:31', '...', 'gallery/2024/02/050726f536d617274-gb-50726f536d617274-234f9.png', 1, 'pt');

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_gallery_blog`
--

DROP TABLE IF EXISTS `xp_gallery_blog`;
CREATE TABLE IF NOT EXISTS `xp_gallery_blog` (
  `id` double NOT NULL AUTO_INCREMENT,
  `id_news` double DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credito_imagemX` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_legislacao_and_reports`
--

DROP TABLE IF EXISTS `xp_legislacao_and_reports`;
CREATE TABLE IF NOT EXISTS `xp_legislacao_and_reports` (
  `id` double NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_newsletter`
--

DROP TABLE IF EXISTS `xp_newsletter`;
CREATE TABLE IF NOT EXISTS `xp_newsletter` (
  `id` double NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hora` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_numbers`
--

DROP TABLE IF EXISTS `xp_numbers`;
CREATE TABLE IF NOT EXISTS `xp_numbers` (
  `id` double NOT NULL AUTO_INCREMENT,
  `number_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `xp_numbers`
--

INSERT INTO `xp_numbers` (`id`, `number_1`, `number_2`, `number_3`, `number_4`, `status`, `lang`) VALUES
(1, '5', '32', '551', '837', 1, 'pt'),
(2, '53', '-', '-', '-', 1, 'pt'),
(3, '842', '-', '-', '-', 1, 'pt'),
(4, '1832', '-', '-', '-', 1, 'pt');

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_pricing`
--

DROP TABLE IF EXISTS `xp_pricing`;
CREATE TABLE IF NOT EXISTS `xp_pricing` (
  `id` double NOT NULL AUTO_INCREMENT,
  `pricing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plano` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `moeda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_seo`
--

DROP TABLE IF EXISTS `xp_seo`;
CREATE TABLE IF NOT EXISTS `xp_seo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rebots` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `canonical` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `xp_users`
--

DROP TABLE IF EXISTS `xp_users`;
CREATE TABLE IF NOT EXISTS `xp_users` (
  `id` double NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_start` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_end` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastupdate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block` int DEFAULT NULL,
  `level` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `xp_users`
--

INSERT INTO `xp_users` (`id`, `name`, `lastname`, `username`, `password`, `session_start`, `session_end`, `lastupdate`, `registration`, `block`, `level`, `status`, `cover`) VALUES
(1, 'ELiúdy ', 'Tomás', 'galeranerdao@gmail.com', '762569b44f75f46f76577352f928eb7d', '2024-03-08 23:00:44', '2024-03-09 00:10:33', NULL, NULL, NULL, 4, 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
