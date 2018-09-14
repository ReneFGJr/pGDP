-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2018 at 12:15 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pgdp`
--

-- --------------------------------------------------------

--
-- Table structure for table `dcr_fields`
--

CREATE TABLE `dcr_fields` (
  `id_f` bigint(20) UNSIGNED NOT NULL,
  `f_group` int(11) NOT NULL,
  `f_descript` char(20) NOT NULL,
  `f_active` int(11) NOT NULL DEFAULT '1',
  `f_form` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcr_fields`
--

INSERT INTO `dcr_fields` (`id_f`, `f_group`, `f_descript`, `f_active`, `f_form`) VALUES
(1, 1, 'proj_title', 1, '$T80:3'),
(2, 1, 'proj_affiliation', 1, '$S100'),
(3, 1, 'proj_funder', 1, '$S100'),
(4, 1, 'btn_create_plan', 1, '$B8'),
(5, 2, 'plan_grant', 1, '$S100'),
(6, 2, 'plan_abstract', 1, '$T80:8'),
(7, 3, 'proj_authors', 1, '$AUTHOR'),
(8, 4, 'proj_repository', 1, '$T80:4'),
(9, 5, 'proj_disclaimer', 1, '$C1');

-- --------------------------------------------------------

--
-- Table structure for table `dcr_form`
--

CREATE TABLE `dcr_form` (
  `id_fr` bigint(20) UNSIGNED NOT NULL,
  `fr_templat` int(11) NOT NULL,
  `fr_group` int(11) NOT NULL,
  `fr_field` int(11) NOT NULL,
  `fr_majoritary` int(11) NOT NULL DEFAULT '0',
  `f_readwrite` int(11) NOT NULL DEFAULT '1',
  `fr_active` int(11) NOT NULL DEFAULT '1',
  `fr_page` int(11) NOT NULL,
  `fr_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcr_form`
--

INSERT INTO `dcr_form` (`id_fr`, `fr_templat`, `fr_group`, `fr_field`, `fr_majoritary`, `f_readwrite`, `fr_active`, `fr_page`, `fr_order`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 1, 1, 2, 1, 1, 1, 1, 2),
(3, 1, 1, 3, 1, 1, 1, 1, 5),
(4, 1, 1, 4, 1, 0, 1, 1, 99),
(5, 1, 2, 5, 1, 1, 1, 2, 2),
(6, 1, 2, 6, 1, 1, 1, 2, 4),
(7, 1, 3, 7, 0, 1, 1, 3, 5),
(8, 1, 4, 8, 0, 1, 1, 4, 10),
(9, 1, 5, 9, 0, 1, 1, 5, 50),
(10, 1, 6, 10, 0, 1, 1, 6, 50);

-- --------------------------------------------------------

--
-- Table structure for table `dcr_groups`
--

CREATE TABLE `dcr_groups` (
  `id_d` bigint(20) UNSIGNED NOT NULL,
  `d_descript` char(40) NOT NULL,
  `d_order` int(11) NOT NULL,
  `d_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcr_groups`
--

INSERT INTO `dcr_groups` (`id_d`, `d_descript`, `d_order`, `d_active`) VALUES
(1, 'group_project_abstract', 1, 1),
(2, 'group_project_about', 2, 1),
(3, 'group_project_method', 3, 1),
(4, 'group_project_team', 4, 1),
(5, 'group_disclaimer', 5, 1),
(6, 'group_export', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dcr_templat`
--

CREATE TABLE `dcr_templat` (
  `id_t` bigint(20) UNSIGNED NOT NULL,
  `t_name` char(20) NOT NULL,
  `t_active` int(11) NOT NULL DEFAULT '1',
  `t_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcr_templat`
--

INSERT INTO `dcr_templat` (`id_t`, `t_name`, `t_active`, `t_created`) VALUES
(1, 'H2020_FAIR_DMP', 1, '2018-09-11 22:18:21'),
(2, 'SOCIASAPLICADAS', 1, '2018-09-14 14:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id_s` bigint(20) UNSIGNED NOT NULL,
  `s_code` int(5) NOT NULL,
  `s_code_master` int(11) NOT NULL,
  `s_ref` char(20) NOT NULL,
  `s_range` int(11) NOT NULL,
  `s_active` int(11) NOT NULL DEFAULT '1',
  `s_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id_s`, `s_code`, `s_code_master`, `s_ref`, `s_range`, `s_active`, `s_created`) VALUES
(1, 1, 0, 'data_summary', 0, 1, '2018-09-11 21:04:30'),
(2, 2, 0, 'fair_data', 0, 1, '2018-09-11 21:04:30'),
(3, 3, 2, 'making_data_findable', 0, 1, '2018-09-11 21:06:51'),
(4, 4, 2, 'making_data_openly', 0, 1, '2018-09-11 21:06:51'),
(5, 0, 3, 'makeing_data_interop', 0, 1, '2018-09-11 21:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_us` bigint(20) UNSIGNED NOT NULL,
  `us_nome` char(80) NOT NULL,
  `us_email` char(80) NOT NULL,
  `us_cidade` char(40) NOT NULL,
  `us_pais` char(40) NOT NULL,
  `us_codigo` char(7) NOT NULL,
  `us_link` char(80) NOT NULL,
  `us_ativo` int(1) NOT NULL,
  `us_nivel` char(1) NOT NULL,
  `us_image` text NOT NULL,
  `us_genero` char(1) NOT NULL,
  `us_verificado` char(1) NOT NULL,
  `us_autenticador` char(3) NOT NULL,
  `us_cadastro` int(11) NOT NULL,
  `us_revisoes` int(11) NOT NULL,
  `us_colaboracoes` int(11) NOT NULL,
  `us_acessos` int(11) NOT NULL,
  `us_pesquisa` int(11) NOT NULL,
  `us_erros` int(11) NOT NULL,
  `us_outros` int(11) NOT NULL,
  `us_last` int(11) NOT NULL,
  `us_perfil` text NOT NULL,
  `us_login` char(200) NOT NULL,
  `us_password` char(255) NOT NULL,
  `us_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `us_last_access` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `us_institution` char(50) NOT NULL,
  `us_perfil_check` int(11) NOT NULL,
  `us_badge` char(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_us`, `us_nome`, `us_email`, `us_cidade`, `us_pais`, `us_codigo`, `us_link`, `us_ativo`, `us_nivel`, `us_image`, `us_genero`, `us_verificado`, `us_autenticador`, `us_cadastro`, `us_revisoes`, `us_colaboracoes`, `us_acessos`, `us_pesquisa`, `us_erros`, `us_outros`, `us_last`, `us_perfil`, `us_login`, `us_password`, `us_created`, `us_last_access`, `us_institution`, `us_perfil_check`, `us_badge`) VALUES
(1, 'Rene F. Gabriel Junior', 'renefgj@gmail.com', '', '', '0000006', 'https://www.facebook.com/app_scoped_user_id/730800790295507/', 1, '9', '', 'M', '1', 'F', 20140706, 0, 0, 283, 0, 0, 0, 20170110, '#ADM#BIB', 'renefgj@gmail.com', '448545ct', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '00001'),
(388, 'Rita Laipelt', 'ritacarmo@yahoo.com.br', '', '', '0000007', '', 1, '9', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '#ADM#BIB', 'ritacarmo@yahoo.com.br', 'santiago', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '00388'),
(389, 'Amanda Pacini de Moura', 'amanda.pacini.moura@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'amanda.pacini.moura@gmail.com', 'testekos', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '00389'),
(390, 'Gabriel Henrique Silva Teixeira', 'loki.gabriel@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'loki.gabriel@gmail.com', '22051989', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '00390'),
(391, 'Marcelo Regis Bernardo', 'mrbernardo@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'mrbernardo@gmail.com', 'Ahml@9032', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '00391'),
(392, 'Daniel Novaes da Silva', 'danielnsilva946@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'danielnsilva946@gmail.com', 'd1075216142', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '00392'),
(393, 'Benildes Coura Moreira dos Santos Maculan', 'benildes@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'benildes@gmail.com', 'Be197197', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, '00393'),
(394, 'Yulia', 'ylaleo@gmail.com', '', '', '', '', -1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'ylaleo@gmail.com', '5f1ae97c9ccd4dbe27b7602cc8e69d3c', '2017-05-05 14:06:22', '0000-00-00 00:00:00', '', 0, '00394'),
(395, 'Gabrielle Senna Viegas', 'gabrielle182@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'gabrielle182@gmail.com', '1234', '2017-05-16 11:41:22', '0000-00-00 00:00:00', '', 0, '00395'),
(396, 'José Vanderlei Simões Junior', 'jjunior_simoes@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'jjunior_simoes@hotmail.com', '1234', '2017-05-16 11:52:02', '0000-00-00 00:00:00', '', 0, '00396'),
(397, 'Samuel Santos da Rosa', 'samuel.sdrosa@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'samuel.sdrosa@gmail.com', '1234', '2017-05-16 11:52:10', '0000-00-00 00:00:00', '', 0, '00397'),
(398, 'Priscila Trindade', 'priscillasantostrindade@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'priscillasantostrindade@hotmail.com', '1234', '2017-05-16 11:52:12', '0000-00-00 00:00:00', '', 0, '00398'),
(399, 'Paloma Marques', 'palomamarques.64@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'palomamarques.64@hotmail.com', '1234', '2017-05-16 11:52:20', '0000-00-00 00:00:00', '', 0, '00399'),
(400, 'Larissa da cruz couto', 'larissadacruzcouto09@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'larissadacruzcouto09@gmail.com', '1234', '2017-05-16 11:52:27', '0000-00-00 00:00:00', '', 0, '00400'),
(401, 'Ana Paula Eibs', 'aninhaeibs@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'aninhaeibs@hotmail.com', '1234', '2017-05-16 11:52:27', '0000-00-00 00:00:00', '', 0, '00401'),
(402, 'Bernardo Rasbold Silva', 'berasbold2010@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'berasbold2010@gmail.com', '02613', '2017-05-16 11:52:29', '0000-00-00 00:00:00', '', 0, '00402'),
(403, 'Christine Carvalho Lima', 'christine.lima@ufrgs.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'christine.lima@ufrgs.br', 'hidden', '2017-05-16 11:52:36', '0000-00-00 00:00:00', '', 0, '00403'),
(404, 'Daniela Ramos Farias', 'danielafarias96@yahoo.com.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'danielafarias96@yahoo.com.br', '1234', '2017-05-16 11:52:36', '0000-00-00 00:00:00', '', 0, '00404'),
(405, 'Paula Martini', 'paula.martini@ufrgs.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'paula.martini@ufrgs.br', '1234', '2017-05-16 11:52:41', '0000-00-00 00:00:00', '', 0, '00405'),
(406, 'Andrius Machado Nunes', 'andrius.nunes@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'andrius.nunes@hotmail.com', '1234', '2017-05-16 11:52:42', '0000-00-00 00:00:00', '', 0, '00406'),
(407, 'Carlos Alberto Garcez Rodrigues', 'carlos.garcez@ufrgs.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'carlos.garcez@ufrgs.br', '1234', '2017-05-16 11:53:17', '0000-00-00 00:00:00', '', 0, '00407'),
(408, 'Ana Paula Goularte Cardoso', 'apg.cardoso@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'apg.cardoso@hotmail.com', '1234', '2017-05-16 11:53:18', '0000-00-00 00:00:00', '', 0, '00408'),
(409, 'Jepherson Santos da Silva', 'jephersonphphmineiro@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'jephersonphphmineiro@gmail.com', '1234', '2017-05-16 11:53:25', '0000-00-00 00:00:00', '', 0, '00409'),
(410, 'Carlos Alberto Garcez Rodrigues', 'garcezju@yahoo.com.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'garcezju@yahoo.com.br', '1234', '2017-05-16 11:53:56', '0000-00-00 00:00:00', '', 0, '00410'),
(411, 'Ana Paula Eibs', 'anaaninhaeibs@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'anaaninhaeibs@gmail.com', '1234', '2017-05-16 11:54:03', '0000-00-00 00:00:00', '', 0, '00411'),
(412, 'Anaida Batista Branco', 'anaidabatista@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'anaidabatista@gmail.com', '1234', '2017-05-16 11:54:49', '0000-00-00 00:00:00', '', 0, '00412'),
(413, 'Pamela da Silva Dorneles', 'pamelasdorneles@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'pamelasdorneles@gmail.com', '1234', '2017-05-16 11:55:32', '0000-00-00 00:00:00', '', 0, '00413'),
(414, 'Carlos Alberto Garcez Rodrigues', 'kasalb10@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'kasalb10@gmail.com', '1234', '2017-05-16 11:57:21', '0000-00-00 00:00:00', '', 0, '00414'),
(415, 'Mariana Marques', 'marianarm.1987@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'marianarm.1987@gmail.com', '1234', '2017-05-16 11:58:24', '0000-00-00 00:00:00', '', 0, '00415'),
(416, 'teste', 'teste', '', '', '', '', 1, '1', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 'teste', 'teste', '2017-05-16 12:27:57', '0000-00-00 00:00:00', '', 0, '00416'),
(417, 'Priscila Macedo', 'macedo.prisciladequeiroz@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'macedo.prisciladequeiroz@gmail.com', '1234', '2017-05-16 12:28:43', '0000-00-00 00:00:00', '', 0, '00417'),
(418, 'Camila de Siqueira Umpierrez', 'camilaumpierrez@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'camilaumpierrez@gmail.com', '1234', '2017-05-16 12:28:48', '0000-00-00 00:00:00', '', 0, '00418'),
(419, 'Luciane Conceição', 'lucibi@bol.com.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'lucibi@bol.com.br', '1234', '2017-05-16 12:32:01', '0000-00-00 00:00:00', '', 0, '00419'),
(420, 'Luísa Vargas Vieira', 'luisavargas222@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'luisavargas222@gmail.com', '1234', '2017-05-16 12:41:11', '0000-00-00 00:00:00', '', 0, '00420'),
(421, 'Sofia da Cunha Gonçalves', 'sofiagon.cunha@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'sofiagon.cunha@gmail.com', '1234', '2017-05-16 12:41:32', '0000-00-00 00:00:00', '', 0, '00421'),
(422, 'Robson Vargas de Mello', 'robsonvargas26@yahoo.com.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'robsonvargas26@yahoo.com.br', '1234', '2017-05-16 12:45:43', '0000-00-00 00:00:00', '', 0, '00422'),
(423, 'Julia Ventura', 'julia.rosauro@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'julia.rosauro@hotmail.com', '1234', '2017-05-16 12:48:49', '0000-00-00 00:00:00', '', 0, '00423'),
(424, 'Matheus Aguiar', 'maguiarcarvalho.bh@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'maguiarcarvalho.bh@hotmail.com', '1234', '2017-05-17 18:40:47', '0000-00-00 00:00:00', '', 0, '00424'),
(425, 'Matheus Aguiar', 'maguiarcarvalho.bh@hotmil.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'maguiarcarvalho.bh@hotmil.com', '1234', '2017-05-17 18:41:44', '0000-00-00 00:00:00', '', 0, '00425'),
(426, 'Matheus Carvalho', 'matheus_salsixao@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'matheus_salsixao@hotmail.com', '1234', '2017-05-17 18:49:17', '0000-00-00 00:00:00', '', 0, '00426'),
(427, 'Renato Correa', 'renatocorrea@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'renatocorrea@gmail.com', '1234', '2017-05-24 20:41:39', '0000-00-00 00:00:00', '', 0, '00427'),
(428, 'Renato', 'fc_renato@yahoo.com.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'fc_renato@yahoo.com.br', '1234', '2017-05-24 20:50:56', '0000-00-00 00:00:00', '', 0, '00428'),
(429, 'Rafael Vicente de Almeida', 'sr.vicente@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'sr.vicente@hotmail.com', '142241', '2017-06-12 18:25:21', '0000-00-00 00:00:00', '', 0, '00429'),
(430, 'Ana Maria Mielniczuk de Moura', 'ana.mmoura@uol.com.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'ana.mmoura@uol.com.br', 'ana1234', '2017-06-14 12:22:42', '0000-00-00 00:00:00', '', 0, '00430'),
(431, 'Priscila Macedo', 'pri.jam@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'pri.jam@hotmail.com', '1234', '2017-06-17 03:56:51', '0000-00-00 00:00:00', '', 0, '00431'),
(432, 'Pablo Gomes', 'pablogomes.pg@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'pablogomes.pg@gmail.com', '1234', '2017-06-17 15:58:06', '0000-00-00 00:00:00', '', 0, '00432'),
(433, 'Gracy Kelli Martins', 'gracykelli@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'gracykelli@gmail.com', '1234', '2017-06-18 17:53:22', '0000-00-00 00:00:00', '', 0, '00433'),
(434, 'Laura Brandolt', 'laubrandolt@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'laubrandolt@gmail.com', 'fliper99', '2017-06-20 12:43:04', '0000-00-00 00:00:00', '', 0, '00434'),
(435, 'Fernanda Bochi dos Santos', 'nandabochi@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'nandabochi@hotmail.com', 'facil1985', '2017-06-21 14:19:16', '0000-00-00 00:00:00', '', 0, '00435'),
(436, 'Leila Moras Silva', 'moras.leila@gmail.com', '', '', '', '', -1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'moras.leila@gmail.com', '342f932fcf4db7d6dff78e0a6f52f729', '2017-06-21 16:43:35', '0000-00-00 00:00:00', '', 0, '00436'),
(437, 'Leila Moras Silva', 'leila.silva@ufrgs.br', '', '', '', '', -1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'leila.silva@ufrgs.br', '373a9f17f7520657de68418dc6e2da4c', '2017-06-21 16:53:25', '0000-00-00 00:00:00', '', 0, '00437'),
(438, 'Thiago Monteiro Alves', 'thiagomonalves@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'thiagomonalves@gmail.com', '14242630', '2017-06-21 17:31:52', '0000-00-00 00:00:00', '', 0, '00438'),
(439, 'Leila Moras Silva', 'leilacaxias@yahoo.com.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'leilacaxias@yahoo.com.br', '27091022', '2017-06-21 21:43:59', '0000-00-00 00:00:00', '', 0, '00439'),
(440, 'Kellen Santanna Peres', 'kellenperes@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'kellenperes@hotmail.com', 'biblioteca1005', '2017-07-31 19:40:45', '0000-00-00 00:00:00', '', 0, '00440'),
(441, 'Decio Wey Berti Junior', 'deciowbj@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'deciowbj@gmail.com', 'alwb1512$', '2017-08-14 13:55:22', '0000-00-00 00:00:00', '', 0, '00441'),
(442, 'Mikaela da Silva Machado', 'mikaela.machado@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'mikaela.machado@hotmail.com', '81204803', '2017-08-17 01:18:35', '0000-00-00 00:00:00', '', 0, '00442'),
(443, 'Greison Jacobi', 'gjacobi@live.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'gjacobi@live.com', 'cd112358', '2017-11-07 19:59:02', '0000-00-00 00:00:00', '', 0, '00443'),
(444, 'andresa marques da silva', 'andresamarques86@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'andresamarques86@gmail.com', 'giovana2012', '2017-11-07 20:14:14', '0000-00-00 00:00:00', '', 0, '00444'),
(445, 'andresa marques da silva', 'deda_ms@hotmail.com', '', '', '', '', -1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'deda_ms@hotmail.com', 'e28cf54ba08dd6f77d71920548c5b5de', '2017-11-07 20:14:43', '0000-00-00 00:00:00', '', 0, '00445'),
(446, 'LUCIMARA FIGUEIRA DUARTE', 'lucimaraduartecid@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'lucimaraduartecid@gmail.com', 'mariadocarmo', '2017-11-21 11:36:28', '0000-00-00 00:00:00', '', 0, '00446'),
(447, 'JUANA BELINASO', 'juana.belinaso@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'juana.belinaso@gmail.com', 'shivinha', '2017-11-21 11:36:32', '0000-00-00 00:00:00', '', 0, '00447'),
(448, 'Grégory Frees NuneS', 'freesgregory@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'freesgregory@gmail.com', 'mastigandohumanos', '2017-11-21 11:36:37', '0000-00-00 00:00:00', '', 0, '00448'),
(449, 'Sandra Maria Baldin', 'sandrambaldin@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'sandrambaldin@gmail.com', 'Rafaela30122015MC', '2017-11-21 11:36:52', '0000-00-00 00:00:00', '', 0, '00449'),
(450, 'Pedro Luiz de Marichal', 'pedro.marichal@ufrgs.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'pedro.marichal@ufrgs.br', 'fireworkscs5', '2017-11-21 11:36:53', '0000-00-00 00:00:00', '', 0, '00450'),
(451, 'Charles Fernando Epolier', 'charlesespolier@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'charlesespolier@gmail.com', 'espolier08', '2017-11-21 11:37:12', '0000-00-00 00:00:00', '', 0, '00451'),
(452, 'Ana Paula Ciecelski', 'anaciecelski@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'anaciecelski@gmail.com', 'enzo2510', '2017-11-21 11:37:20', '0000-00-00 00:00:00', '', 0, '00452'),
(453, 'Camila Teixeira', 'camilao.o@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'camilao.o@hotmail.com', 'B33814350', '2017-11-21 11:37:31', '0000-00-00 00:00:00', '', 0, '00453'),
(454, 'André Luiz Silva de Andrades', '00197493@ufrgs.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', '00197493@ufrgs.br', 'Bibli0713', '2017-11-21 11:37:37', '0000-00-00 00:00:00', '', 0, '00454'),
(455, 'Camila Alves de Melo', 'camilaalvesm@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'camilaalvesm@hotmail.com', 'tcclove65', '2017-11-21 11:37:52', '0000-00-00 00:00:00', '', 0, '00455'),
(456, 'luciane ceretta', 'lufsm@yahoo.com.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'lufsm@yahoo.com.br', 'biblio2017', '2017-11-21 11:37:54', '0000-00-00 00:00:00', '', 0, '00456'),
(457, 'Estêvão Trindade', 'estevaoluisdasilvatrindade@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'estevaoluisdasilvatrindade@gmail.com', 'rocknroll', '2017-11-21 11:38:22', '0000-00-00 00:00:00', '', 0, '00457'),
(458, 'Miguel Henrique Cury', 'miguelhcury@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'miguelhcury@gmail.com', 'leugim', '2017-11-21 11:38:29', '0000-00-00 00:00:00', '', 0, '00458'),
(459, 'Carlos Alexandre Fernandes dos Santos', 'cafs.biblio@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'cafs.biblio@gmail.com', 'kainsama', '2017-11-21 11:38:45', '0000-00-00 00:00:00', '', 0, '00459'),
(460, 'LAURA REGINA DO CANTO LEAL', 'laura0806@bol.com.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'laura0806@bol.com.br', 'lu120900', '2017-11-21 11:39:15', '0000-00-00 00:00:00', '', 0, '00460'),
(461, 'Gabriela Prates da Silva', 'moguy.guynley@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'moguy.guynley@gmail.com', 'trycy456', '2017-11-21 11:42:06', '0000-00-00 00:00:00', '', 0, '00461'),
(462, 'Amanda Schmidt', 'nanis_schmidt@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'nanis_schmidt@hotmail.com', 'MORKHEIM1994', '2017-11-21 11:43:55', '0000-00-00 00:00:00', '', 0, '00462'),
(463, 'Fabiane Simões da Silva', 'fabiane_simoes@hotmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'fabiane_simoes@hotmail.com', '@fabica0018', '2017-11-21 12:02:10', '0000-00-00 00:00:00', '', 0, '00463'),
(464, 'Ana Paula Medeiros Magnus', 'magnus.ana@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'magnus.ana@gmail.com', 'bibmag1204', '2017-11-29 16:11:14', '0000-00-00 00:00:00', '', 0, '00464'),
(465, 'Gabriela Prates da Silva', 'prates.silva.gabi@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'prates.silva.gabi@gmail.com', 'trycy456', '2017-11-29 18:21:44', '0000-00-00 00:00:00', '', 0, '00465'),
(466, 'José Carlos dos Santos', 'zeekbrazil@hotmail.com', '', '', '', '', -1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'zeekbrazil@hotmail.com', 'bd5d218f3873bb1216170d49c0263f8c', '2017-11-30 20:59:03', '0000-00-00 00:00:00', '', 0, '00466'),
(467, 'Bianka Maduell', 'biiamaduell@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'biiamaduell@gmail.com', '229350', '2018-02-07 12:20:05', '0000-00-00 00:00:00', '', 0, '00467'),
(468, 'Marina Plentz', '00143874@ufrgs.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', '00143874@ufrgs.br', 'pui9lies', '2018-02-21 20:00:17', '0000-00-00 00:00:00', '', 0, '00468'),
(469, 'Everton Rodrigues Barbosa', 'evertonpos@gmail.com', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'evertonpos@gmail.com', 'erb241', '2018-03-16 19:34:59', '0000-00-00 00:00:00', '', 0, '00469'),
(470, 'Roberto Cerqueira', 'robertof@pbh.gov.br', '', '', '', '', 1, '0', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'robertof@pbh.gov.br', '1234', '2018-03-21 18:17:38', '0000-00-00 00:00:00', '', 0, '00470'),
(472, 'CLAUDIO JACOSKI', 'claudio@unochapeco.edu.br', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'claudio@unochapeco.edu.br', 'd27e044b69004c872b2176d5cccd442a', '2018-05-05 13:57:51', '0000-00-00 00:00:00', 'unochapecó', 0, '00472'),
(473, 'Ediane Gheno', 'ediane.gheno@ufrgs.br', '', '', '', '', 1, '', '', '', '', 'E', 0, 0, 0, 0, 0, 0, 0, 0, '', 'ediane.gheno@ufrgs.br', '1234', '2018-05-08 17:20:22', '0000-00-00 00:00:00', 'UFRGS', 2050000, '00473'),
(474, 'Francine Conde Cabral', 'fcondecabral@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'fcondecabral@gmail.com', 'cc27802362ead766974b63a06814b64c', '2018-05-15 16:25:10', '0000-00-00 00:00:00', 'UFRGS', 25, '00474'),
(475, 'Rafaella', 'rafaellacau1@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'rafaellacau1@gmail.com', '77922712b903e200f896c899c5623e33', '2018-06-05 11:54:17', '0000-00-00 00:00:00', 'UFRGS', 5, '00475'),
(476, 'Andressa Braga', 'sue.andrade@outlook.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'sue.andrade@outlook.com', 'cf54f8ab0398386cd1af53d928cb1f3f', '2018-06-05 11:54:56', '0000-00-00 00:00:00', 'UFRGS', 598, '00476'),
(477, 'Verônica Medeiros Horn', 'veronicamedeirsohorn@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'veronicamedeirsohorn@gmail.com', 'f5de4fce8ff88979d4fcdd9ddd52ebd0', '2018-06-05 11:55:02', '0000-00-00 00:00:00', 'UFRGS', 74071, '00477'),
(478, 'Rita de Cássia da Rosa', 'rdarosa57@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'rdarosa57@gmail.com', 'dfb801eded7e94edba2f5c6fde2e4b7a', '2018-06-05 11:56:02', '0000-00-00 00:00:00', 'UFRGS', 0, '00478'),
(479, 'Stheve Balbinotti', 'STHEVE@GMAIL.COM', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'STHEVE@GMAIL.COM', '363b86111876c8a11cbeedea0f06cce7', '2018-06-05 11:56:09', '0000-00-00 00:00:00', 'UFRGS', 0, '00479'),
(480, 'Ana Maria Giovanoni Fornos', 'anagiovanonifornos@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'anagiovanonifornos@gmail.com', '791990abaa8a1c2827e15e871bc3a4c8', '2018-06-05 11:56:13', '0000-00-00 00:00:00', 'Universidade Federal do Rio Grande do sul', 6, '00480'),
(481, 'nayamillet gonçalves', 'naya.goncalvesr', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'naya.goncalvesr', '9722cd7a8e3955792895eb2ebabf21a7', '2018-06-05 11:56:14', '0000-00-00 00:00:00', 'ufrgs', 9461, '00481'),
(482, 'nayamillet gonçalves', 'naya.goncalvesr@hotmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'naya.goncalvesr@hotmail.com', '973d09b72867063103be9c660c2e2863', '2018-06-05 11:56:30', '0000-00-00 00:00:00', 'ufrgs', 0, '00482'),
(483, 'Verônica Medeiros Horn', 'veronicamedeiroshorn@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'veronicamedeiroshorn@gmail.com', 'a542a7561fb4ad74fc5c1b4f0d1a3773', '2018-06-05 11:57:29', '0000-00-00 00:00:00', 'UFRGS', 0, '00483'),
(484, 'Maurício Coelho da Silva', 'lovesickmelody666@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'lovesickmelody666@gmail.com', 'db5015a0587bc532fdf00da0d9ec7612', '2018-06-05 11:57:42', '0000-00-00 00:00:00', 'UFRGS', 0, '00484'),
(485, 'Leila Silva Staats', 'leilastaats1997@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'leilastaats1997@gmail.com', '9af7d0644060e0a1f743dad5e5e5e7a0', '2018-06-05 12:05:04', '0000-00-00 00:00:00', 'UFRGS', 218, '00485'),
(486, 'Rene Faustino Gabriel Junior', 'renefgj@yahoo.com.br', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'renefgj@yahoo.com.br', '2e3db7994011c8c5e315e42a0cb439c5', '2018-06-05 12:16:56', '0000-00-00 00:00:00', '', 7, '00486'),
(487, 'Gabriel Matheus Bernard Baum', 'gabriel.matheus96@hotmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'gabriel.matheus96@hotmail.com', 'eb330963ad3c515f7f1b4631fc4ef3f2', '2018-06-05 12:51:41', '0000-00-00 00:00:00', 'UFRGS', 0, '00487'),
(488, 'Jéssica Paola Macedo Müller', 'jesspmuller@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'jesspmuller@gmail.com', '9b9f21075d2124f20da5b67df2a82049', '2018-06-05 12:51:52', '0000-00-00 00:00:00', 'UFRGS', 0, '00488'),
(489, 'Danglar Oliveira Donin', 'danglar.donin@ufrgs.br', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'danglar.donin@ufrgs.br', '837911198602fff31cacc4aa87628ca6', '2018-06-05 12:52:13', '0000-00-00 00:00:00', 'UFRGS', 854, '00489'),
(490, 'Viviane Marques', 'vivisantos@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'vivisantos@gmail.com', '744be797dc7d0c7e3fda6771d07fcf96', '2018-06-05 12:54:04', '0000-00-00 00:00:00', 'UFRGS', 0, '00490'),
(491, 'Bruna Martins Matos', 'brunamartinsmatos@hotmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'brunamartinsmatos@hotmail.com', 'c087c4d20f67b477c9a9cf7d8ca31588', '2018-06-05 13:13:22', '0000-00-00 00:00:00', 'UFRGS', 559, '00491'),
(492, 'Fernanda Motta', 'fehmotta@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'fehmotta@gmail.com', 'bae44f6e0f29b80b067f517a33b760b5', '2018-06-09 15:59:30', '0000-00-00 00:00:00', 'UFRGS', 55, '00492'),
(493, 'DIEGO TONELLO', 'diego-tonelllo@hotmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'diego-tonelllo@hotmail.com', '8ad41707def850b4c9ae6e217e4091e2', '2018-06-09 19:00:36', '0000-00-00 00:00:00', 'Universidade Federal do Rio Grande do Sul', 2, '00493'),
(494, 'Filipi Miranda Soares', 'filipivgp2011@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'filipivgp2011@gmail.com', '279d54ce3499da1b17f46576daf93ebc', '2018-06-09 19:33:29', '0000-00-00 00:00:00', 'UFMG', 1, '00494'),
(495, 'Caliel Cardoso de Oliveira', 'caliel.oliveira@ufrgs.br', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'caliel.oliveira@ufrgs.br', '52c39ed2822057f6019880aac428b233', '2018-06-09 23:03:06', '0000-00-00 00:00:00', 'UFRGS', 2147483647, '00495'),
(496, 'Sandalo Salgado Ribeiro', 'sandalo@ufmg.br', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'sandalo@ufmg.br', '377e289aa9ad7c373183ec6a0af67cc2', '2018-06-11 10:02:40', '0000-00-00 00:00:00', 'UFMG', 0, '00496'),
(497, 'Osmar Weyh', 'osmarweyh@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'osmarweyh@gmail.com', '8b1c59d51c9d18a3adf430427b97d969', '2018-06-11 11:29:21', '0000-00-00 00:00:00', 'UFRGS', 7380, '00497'),
(498, 'Fabio Mariano', 'fabioribeiromariano@yahoo.com.br', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'fabioribeiromariano@yahoo.com.br', '7adcca27b0843d24144c1473999c2cf6', '2018-06-13 12:31:28', '0000-00-00 00:00:00', 'UFRGS', 5, '00498'),
(499, 'clara kralco', 'clarakralco@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'clarakralco@gmail.com', 'd04500dbac51e00df4a6cc0657866b07', '2018-06-16 02:01:59', '0000-00-00 00:00:00', 'Universidade de Brasília', 3, '00499'),
(500, 'Victor Andrews Garcia Lima', 'victor1414x@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'victor1414x@gmail.com', 'f984bd82b297b68083c9c79e4bb80336', '2018-06-19 05:48:51', '0000-00-00 00:00:00', 'UFRGS', 0, '00500'),
(501, 'MONICA CASTRO', 'ninariana@hotmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'ninariana@hotmail.com', 'c6be09534e511734f625e4dbacc60d5b', '2018-06-20 00:25:43', '0000-00-00 00:00:00', 'unirio', 5, '00501'),
(502, 'JAKELINE MARTINS DE MENDONCA', 'jmendonca@senaicni.com.br', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'jmendonca@senaicni.com.br', 'b6f38c401a20add7278a3be4496d24d5', '2018-06-22 19:29:30', '0000-00-00 00:00:00', 'CNI', 0, '00502'),
(503, 'Fernanda Percia', 'fernanda10nov@hotmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'fernanda10nov@hotmail.com', '387810a1a06aa83b5fc69601d62c369d', '2018-06-25 12:44:52', '0000-00-00 00:00:00', 'Universidade de Brasília', 2147483647, '00503'),
(504, 'Raissa Pereira Lima de Souza', 'souzarpl@gmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'souzarpl@gmail.com', 'a880ebcc55b246c2f46864b476029b1c', '2018-06-25 15:35:26', '0000-00-00 00:00:00', 'Universidade Federal de Minas Gerais', 0, '00504'),
(505, 'Ketlyn Santiago Borges', 'ketlynsantiago@hotmail.com', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'ketlynsantiago@hotmail.com', '52b8bb6e682633b0d26d8434a9a80990', '2018-06-25 17:28:00', '0000-00-00 00:00:00', 'Universidade Federal de Minas Gerais', 0, '00505'),
(506, 'DEBORA DORNSBACH SOARES', 'debora.soares@al.rs.gov.br', '', '', '', '', 1, '', '', '', '', 'MD5', 0, 0, 0, 0, 0, 0, 0, 0, '', 'debora.soares@al.rs.gov.br', '39f37359bf7dd3bdc317e0c2573961cd', '2018-06-27 15:32:59', '0000-00-00 00:00:00', 'Assembleia Legislativa do Estado do RS', 0, '00506');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dcr_fields`
--
ALTER TABLE `dcr_fields`
  ADD UNIQUE KEY `id_f` (`id_f`);

--
-- Indexes for table `dcr_form`
--
ALTER TABLE `dcr_form`
  ADD UNIQUE KEY `id_fr` (`id_fr`);

--
-- Indexes for table `dcr_groups`
--
ALTER TABLE `dcr_groups`
  ADD UNIQUE KEY `id_d` (`id_d`);

--
-- Indexes for table `dcr_templat`
--
ALTER TABLE `dcr_templat`
  ADD UNIQUE KEY `id_t` (`id_t`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD UNIQUE KEY `id_s` (`id_s`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id_us` (`id_us`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dcr_fields`
--
ALTER TABLE `dcr_fields`
  MODIFY `id_f` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `dcr_form`
--
ALTER TABLE `dcr_form`
  MODIFY `id_fr` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `dcr_groups`
--
ALTER TABLE `dcr_groups`
  MODIFY `id_d` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `dcr_templat`
--
ALTER TABLE `dcr_templat`
  MODIFY `id_t` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id_s` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_us` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
