-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 10, 2017 at 10:27 AM
-- Server version: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pgdp`
--

-- --------------------------------------------------------

--
-- Table structure for table `pgdp_form_type`
--

CREATE TABLE IF NOT EXISTS `pgdp_form_type` (
`id_f` bigint(20) unsigned NOT NULL,
  `f_name` char(100) NOT NULL,
  `f_form` text NOT NULL,
  `f_status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pgdp_form_type`
--

INSERT INTO `pgdp_form_type` (`id_f`, `f_name`, `f_form`, `f_status`) VALUES
(1, 'Textbox (5 linhas)', '$T80:5', 1),
(2, 'Texto (100 caracteres)', '$S100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pgdp_plans`
--

CREATE TABLE IF NOT EXISTS `pgdp_plans` (
`id_pl` bigint(20) unsigned NOT NULL,
  `pl_name` text NOT NULL,
  `pl_creadted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pl_type` int(11) NOT NULL,
  `pl_templat` int(11) NOT NULL,
  `pl_own` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pgdp_plans`
--

INSERT INTO `pgdp_plans` (`id_pl`, `pl_name`, `pl_creadted`, `pl_type`, `pl_templat`, `pl_own`) VALUES
(1, 'Plano de teste #1', '2017-10-04 02:59:25', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pgdp_templat`
--

CREATE TABLE IF NOT EXISTS `pgdp_templat` (
`id_t` bigint(20) unsigned NOT NULL,
  `t_name` char(150) NOT NULL,
  `t_descript` text NOT NULL,
  `t_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `t_status` int(11) NOT NULL,
  `t_area` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pgdp_templat`
--

INSERT INTO `pgdp_templat` (`id_t`, `t_name`, `t_descript`, `t_created`, `t_status`, `t_area`) VALUES
(1, 'Plano de Gestão de Dados Geral', '', '2017-10-04 02:37:53', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pgdp_templat_itens`
--

CREATE TABLE IF NOT EXISTS `pgdp_templat_itens` (
`id_it` bigint(20) unsigned NOT NULL,
  `it_tp` int(11) NOT NULL,
  `it_field` char(200) NOT NULL,
  `it_ord` int(11) NOT NULL DEFAULT '1',
  `id_ord_sub` int(11) NOT NULL DEFAULT '0',
  `it_status` int(11) NOT NULL DEFAULT '1',
  `it_descrition` text NOT NULL,
  `it_mandatory` int(11) NOT NULL DEFAULT '0',
  `it_type` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pgdp_templat_itens`
--

INSERT INTO `pgdp_templat_itens` (`id_it`, `it_tp`, `it_field`, `it_ord`, `id_ord_sub`, `it_status`, `it_descrition`, `it_mandatory`, `it_type`) VALUES
(1, 1, 'INFORMAÇÕES SOBRE OS DADOS', 1, 0, 1, 'A pesquisa científica produz e coleta dados que são muito variados e heterogêneos e\r\nque têm natureza, formatos diferentes e são coletados em volumes variados e passam\r\npor diferentes processos que dependem de cada disciplina e dos objetivos da pesquisa, portanto é necessário descrever, com algum grau de detalhe, as principais características desses dados, incluindo a natureza e origem, escopo e a escala dos dados que serão produzidos. Isto vai ajudar os revisores e outros pesquisadores a compreenderem os dados, sua relação com os dados existentes e os possíveis riscos de disseminá-los.\r\n', 0, 1),
(2, 1, 'QUE TIPO DE DADOS SUA PESQUISA VAI PRODUZIR?', 1, 1, 1, 'Liste os dados que seu projeto irá produzir e os caracterize em termos de natureza,\r\norigem e processamento: eles podem ser observacionais, experimentais, brutos ou\r\nderivados, simulações, coleções físicas, modelos, software, imagens, vídeos e muito mais.', 0, 1),
(3, 1, 'QUE QUANTIDADE DE DADOS SERÁ GERADA PELA PESQUISA?', 1, 2, 1, 'Com base na sua hipótese e no plano de amostragem avalie o volume de dados que o seu projeto irá gerar', 0, 1),
(4, 1, 'COMO OS DADOS SERÃO COLETADOS?\r\n', 1, 3, 1, 'Você deve especificar também os métodos como os dados serão adquiridos, isto inclui\r\ninformações sobre quem, o que, quando e onde (como as amostras serão coletadas e\r\nanalisadas? Que instrumentos serão usados?)', 0, 1),
(5, 1, 'COMO OS DADOS SERÃO PROCESSADOS?\r\n', 1, 4, 1, 'Uma vez que os dados foram adquiridos, deve ser especificado como eles serão\r\nprocessados. “Esta etapa deve ser considerada antes do projeto, pois pode afetar a\r\nmaneira como os dados serão organizados, quais formatos serão usados, e quanto deve\r\nser previsto, em termos orçamentários, para hardware e software. Devem ser\r\nconsiderados neste momento itens como que software poderá ser usado, que algoritmos\r\nserão empregados, e como esses itens se enquadram no fluxo de trabalho do projeto”2', 0, 1),
(6, 1, 'QUAIS OS FORMATOS DE ARQUIVO QUE SERÃO USADOS?', 1, 5, 1, 'Os formatos de arquivo dos dados que você planeja usar devem ser declarados e sua\r\nescolha deve ser justificada. Descreva os formatos nas fases de submissão, distribuição e\r\npreservação, observando que esses formatos podem ser os mesmos. Na sua escolha você\r\ndeve considerar os padrões que são usados na sua área de pesquisa. Se os dados forem arquivados por longo prazo, é necessário considerar o uso de formatos padronizados e não proprietários, que são mais fáceis de serem interpretados no futuro, de forma\r\nindependente de plataforma tecnológica (hardware e software).\r\n(Considere se um banco de dados relacional ou outra estratégia de organização de dados pode ser mais apropriado para a sua pesquisa)\r\n', 0, 1),
(7, 0, 'COMO OS ARQUIVOS SERÃO NOMEADOS?', 1, 6, 1, 'É importante descrever também a convenção adotada para dar nomes para seus\r\nconjuntos de dados, arquivos e pastas. Convencionando isso de antemão, você estará\r\nmenos propenso a mudar ou reorganizar os arquivos durante o projeto.', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pgdp_form_type`
--
ALTER TABLE `pgdp_form_type`
 ADD UNIQUE KEY `id_f` (`id_f`);

--
-- Indexes for table `pgdp_plans`
--
ALTER TABLE `pgdp_plans`
 ADD UNIQUE KEY `id_pl` (`id_pl`);

--
-- Indexes for table `pgdp_templat`
--
ALTER TABLE `pgdp_templat`
 ADD UNIQUE KEY `id_t` (`id_t`);

--
-- Indexes for table `pgdp_templat_itens`
--
ALTER TABLE `pgdp_templat_itens`
 ADD UNIQUE KEY `id_it` (`id_it`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pgdp_form_type`
--
ALTER TABLE `pgdp_form_type`
MODIFY `id_f` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pgdp_plans`
--
ALTER TABLE `pgdp_plans`
MODIFY `id_pl` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pgdp_templat`
--
ALTER TABLE `pgdp_templat`
MODIFY `id_t` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pgdp_templat_itens`
--
ALTER TABLE `pgdp_templat_itens`
MODIFY `id_it` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
