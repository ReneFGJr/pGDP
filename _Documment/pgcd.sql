-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Jul-2022 às 10:59
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pgcd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `plans`
--

DROP TABLE IF EXISTS `plans`;
CREATE TABLE IF NOT EXISTS `plans` (
  `id_p` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `p_persistent_id` char(30) COLLATE utf8_bin NOT NULL,
  `p_title` text COLLATE utf8_bin NOT NULL,
  `p_lang` char(5) COLLATE utf8_bin DEFAULT NULL,
  `p_own` int(11) DEFAULT NULL,
  `p_nr` int(11) DEFAULT NULL,
  `p_year` int(11) DEFAULT NULL,
  `p_version` float NOT NULL DEFAULT '1',
  `p_draft` int(11) NOT NULL DEFAULT '1',
  `p_status` int(11) NOT NULL DEFAULT '0',
  `p_form` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL,
  UNIQUE KEY `id_p` (`id_p`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `plans`
--

INSERT INTO `plans` (`id_p`, `p_persistent_id`, `p_title`, `p_lang`, `p_own`, `p_nr`, `p_year`, `p_version`, `p_draft`, `p_status`, `p_form`, `created_at`, `updated_at`) VALUES
(1, '', 'Plano de testes', NULL, 1, 1, 2022, 1, 1, 0, 1, '2022-07-10 18:31:43', '2022-07-10'),
(2, '', 'Plano de testeasd', NULL, 1, 1, 2022, 1, 1, 0, 1, '2022-07-10 18:31:43', '2022-07-10'),
(3, '', 'Plano de teste', NULL, 1, 1, 2022, 1, 1, 0, 1, '2022-07-10 18:31:43', '2022-07-10'),
(4, '', 'teste 2', NULL, 1, 1, 2022, 1, 1, 0, 1, '2022-07-10 22:26:28', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plan_form`
--

DROP TABLE IF EXISTS `plan_form`;
CREATE TABLE IF NOT EXISTS `plan_form` (
  `id_pf` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pf_acronic` char(15) COLLATE utf8_bin NOT NULL,
  `pf_name` char(100) COLLATE utf8_bin NOT NULL,
  `pf_lang` char(5) COLLATE utf8_bin NOT NULL,
  `pf_active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `id_pf` (`id_pf`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `plan_form`
--

INSERT INTO `plan_form` (`id_pf`, `pf_acronic`, `pf_name`, `pf_lang`, `pf_active`, `created_at`) VALUES
(1, 'CNPq2022', 'Plano Modelo CNPq', 'pt-BR', 1, '2022-07-10 22:05:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `plan_form_collaboration`
--

DROP TABLE IF EXISTS `plan_form_collaboration`;
CREATE TABLE IF NOT EXISTS `plan_form_collaboration` (
  `id_pfc` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pfc_nr` int(11) NOT NULL,
  `pfc_email` char(100) COLLATE utf8_bin NOT NULL,
  `pfc_status` int(11) NOT NULL DEFAULT '1',
  `pfc_name` char(100) COLLATE utf8_bin NOT NULL,
  `pfc_actions` int(11) NOT NULL,
  `pfc_order` int(11) NOT NULL DEFAULT '99',
  UNIQUE KEY `id_pfc` (`id_pfc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plan_form_fields`
--

DROP TABLE IF EXISTS `plan_form_fields`;
CREATE TABLE IF NOT EXISTS `plan_form_fields` (
  `id_plf` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `plf_plan_id` int(11) NOT NULL,
  `plf_plan_section` int(11) NOT NULL DEFAULT '0',
  `plf_field` char(50) COLLATE utf8_bin NOT NULL,
  `plf_type` char(50) COLLATE utf8_bin NOT NULL,
  `plf_ord` int(11) NOT NULL DEFAULT '99',
  `plf_mandatory` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `id_plf` (`id_plf`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `plan_form_fields`
--

INSERT INTO `plan_form_fields` (`id_plf`, `plf_plan_id`, `plf_plan_section`, `plf_field`, `plf_type`, `plf_ord`, `plf_mandatory`) VALUES
(1, 1, 1, 'abstract', 'TEXTAREA', 1, 0),
(2, 1, 1, 'keywords', 'KEYWORDS', 2, 0),
(3, 1, 1, 'date_harvesting_start', 'DATE', 5, 0),
(4, 1, 1, 'date_harvesting_end', 'DATE', 6, 0),
(5, 1, 2, 'collaborations', 'collaborations_authors', 1, 0),
(6, 1, 2, 'collaborations_institutions', 'collaborations_institutions', 5, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plan_form_section`
--

DROP TABLE IF EXISTS `plan_form_section`;
CREATE TABLE IF NOT EXISTS `plan_form_section` (
  `id_pfs` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pfs_form` int(11) NOT NULL,
  `pfs_order` int(11) NOT NULL DEFAULT '99',
  `pfs_section_name` char(100) COLLATE utf8_bin NOT NULL,
  `pfs_section_info` text COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `id_pfs` (`id_pfs`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `plan_form_section`
--

INSERT INTO `plan_form_section` (`id_pfs`, `pfs_form`, `pfs_order`, `pfs_section_name`, `pfs_section_info`) VALUES
(1, 1, 1, 'Geral', ''),
(2, 1, 2, 'Colaborations', ''),
(3, 1, 3, 'Descriptions', ''),
(4, 1, 4, 'DesignStudy', ''),
(5, 1, 5, 'DataDescriptions', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `plan_form_values`
--

DROP TABLE IF EXISTS `plan_form_values`;
CREATE TABLE IF NOT EXISTS `plan_form_values` (
  `id_pv` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pv_nr` int(11) NOT NULL,
  `pv_field` int(11) NOT NULL,
  `pv_value` longtext COLLATE utf8_bin NOT NULL,
  `pv_version` float NOT NULL DEFAULT '1',
  UNIQUE KEY `id_pv` (`id_pv`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `plan_form_values`
--

INSERT INTO `plan_form_values` (`id_pv`, `pv_nr`, `pv_field`, `pv_value`, `pv_version`) VALUES
(1, 1, 2, 'Palavra-chave', 1),
(2, 1, 2, 'Plano de Gestão de Dados', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
