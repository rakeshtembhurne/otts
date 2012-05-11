-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2012 at 10:18 PM
-- Server version: 5.5.22
-- PHP Version: 5.3.10-1ubuntu3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";




/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `onlinetestsystem`
--


CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
);



CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'Admin', 1, 4),
(2, NULL, NULL, NULL, 'Anonymous', 5, 14),
(3, 2, NULL, NULL, 'Student', 6, 7),
(4, 2, NULL, NULL, 'Teacher', 8, 9),
(5, 2, NULL, NULL, 'Employee', 10, 13),
(6, 1, NULL, 1, 'User::1', 2, 3);



CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE IF NOT EXISTS `boards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Maharashtra', '2012-05-06 14:02:57', '2012-05-06 14:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `experience_months` smallint(6) DEFAULT NULL,
  `experience_years` smallint(6) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `name`, `email`, `experience_months`, `experience_years`, `created`, `modified`) VALUES
(4, 'Amitabh Bachchan', 'amitabh@bachchan.com', 2, 4, '2012-01-03 11:55:28', '2012-01-03 11:55:28'),
(3, 'Amir Khan', 'amir@khan.com', 3, 5, '2012-01-03 09:38:43', '2012-01-04 16:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `tutorial_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'it''s a teacher id',
  `title` text,
  `option_1` text NOT NULL,
  `option_2` text NOT NULL,
  `option_3` text NOT NULL,
  `option_4` text NOT NULL,
  `answer` smallint(6) NOT NULL,
  `paid_enable` tinyint(4) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `subject_id`, `user_id`, `title`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `paid_enable`, `created`, `modified`) VALUES
(19, 10, NULL, 'A script is a ...', 'Program or sequence of instructions that is interpreted or carried out by processor directly', 'Program or sequence of instruction that is interpreted or carried out by another program', 'Program or sequence of instruction that is interpreted or carried out by web server only', 'None of above', 2, 0, '2012-01-06 10:25:02', '2012-01-06 10:25:02'),
(20, 10, NULL, ' When compared to the compiled program, scripts run', 'Faster', 'Slower', 'The execution speed is similar', 'All of above', 2, 0, '2012-01-06 10:26:07', '2012-01-06 10:26:07'),
(21, 10, NULL, 'PHP is a widely used â€¦â€¦â€¦â€¦â€¦. scripting language that is especially suited for web development and can be embedded into html', 'Open source general purpose', 'Proprietary general purpose', 'Open source special purpose', 'Proprietary special purpose', 1, 0, '2012-01-06 10:27:53', '2012-01-06 10:27:53'),
(22, 10, NULL, 'Which of the following is not true?', 'PHP can be used to develop web applications.', 'PHP makes a website dynamic.', 'PHP applications can not be compiled.', 'PHP can not be embedded into html.', 4, 0, '2012-01-06 10:29:42', '2012-01-06 10:29:42'),
(23, 10, NULL, 'The most portable version of PHP tag that is compatible to embed in XML or XHTML too is:', '&lt;? ... ?>', '&lt;script language="php"> ... &lt;/script>', '&lt;% ... %>', '&lt;php ... ?>', 4, 0, '2012-01-06 10:31:39', '2012-01-06 11:14:36'),
(24, 10, NULL, 'Which of the following variables is not a predefined variable?', '$_GET', '$_ASK', '$_REQUEST', '$_POST', 2, 0, '2012-01-06 10:32:46', '2012-01-06 10:32:46'),
(25, 10, NULL, 'You can define a constant by using the define() function. Once a constant is defined', 'It can never be changed or undefined', 'It can never be changed but can be undefined', 'It can be changed but can not be undefined', 'It can be changed and can be undefined', 2, 0, '2012-01-06 10:34:38', '2012-01-06 10:34:38'),
(26, 10, NULL, 'The following piece of script will output:\r\n<?\r\n$email=''admin@psexam.com'';\r\n$new=strstr($email, ''@'');\r\nprint $new;\r\n?>', 'admin', 'admin@psexam', '@psexam.com', 'psexam.com', 3, 0, '2012-01-06 10:38:31', '2012-01-06 10:38:31'),
(27, 10, NULL, 'Which of the following function returns the number of characters in a string variable?', 'count($variable)', 'len($variable)', 'strcount($variable)', 'strlen($variable)', 4, 0, '2012-01-06 10:39:18', '2012-01-06 10:39:18'),
(28, 10, NULL, 'When you need to obtain the ASCII value of a character which of the following function you apply in PHP?', 'chr( );', 'asc( );', 'ord( );', 'val( );', 3, 0, '2012-01-06 10:41:03', '2012-01-06 10:41:03'),
(29, 10, NULL, 'A variable $word is set to "HELLO WORLD", which of the following script returns in title case?', 'echo ucwords($word)', 'echo ucwords(strtolower($word)', 'echo ucfirst($word)', 'echo ucfirst(strtolower($word)', 2, 0, '2012-01-06 10:44:43', '2012-01-06 10:44:43'),
(30, 10, NULL, 'The difference between include() and require()', 'are different how they handle failure', 'both are same in every aspects', 'is include() produced a Fatal Error while require results in a Warning', 'none of above', 1, 0, '2012-01-06 10:45:58', '2012-01-06 10:45:58'),
(31, 10, NULL, 'When a file is included the code it contains, behave for variable scope of the line on which the include occurs', 'Any variable available at that line in the calling file will be available within the called file from that point', 'Any variable available at that line in the calling file will not be available within the called file', 'Variables are local in both called and calling files', 'None of above', 1, 0, '2012-01-06 10:47:21', '2012-01-06 10:47:21'),
(32, 10, NULL, 'Which of the following method sends input to a script via a URL?', 'Get', 'Post', 'Both', 'None', 1, 0, '2012-01-06 10:48:23', '2012-01-06 10:48:23'),
(33, 10, NULL, 'Which of the following method is suitable when you need to send larger form submissions?', 'Get', 'Post', 'Both Get and Post', 'There is no direct way for larger form. You need to store them in a file and retrieve', 2, 0, '2012-01-06 10:49:11', '2012-01-06 10:49:11'),
(34, 10, NULL, 'Which of the following mode of fopen() function opens a file only for writing. If a file with that name does not exist, attempts to create anew file. If the file exist, place the file pointer at the end of the file after all other data.', 'W', 'W+', 'A', 'A+', 3, 0, '2012-01-06 10:49:58', '2012-01-06 10:49:58'),
(35, 10, NULL, 'The function setcookie( ) is used to', 'Enable or disable cookie support', 'Declare cookie variables', 'Store data in cookie variable', 'All of above', 3, 0, '2012-01-06 10:50:52', '2012-01-06 10:50:52'),
(36, 10, NULL, 'To work with remote files in PHP you need to enable', 'allow_url_fopen', 'allow_remote_files', 'both of above', 'none of above', 1, 0, '2012-01-06 10:51:37', '2012-01-06 10:51:37'),
(37, 10, NULL, 'fopen($file_doc,''r+'') opens a file for', 'reading', 'writing', 'none of above', 'both of above', 4, 0, '2012-01-06 10:52:48', '2012-01-06 10:52:48'),
(38, 10, NULL, 'In mail($param2, $param2, $param3, $param4), the $param2 contains:', 'The message', 'The recipient', 'The header', 'The subject ', 4, 0, '2012-01-06 10:54:00', '2012-01-06 10:54:00'),
(39, 10, NULL, 'mysql_connect( ) does not take following parameter', 'database host', 'user ID', 'password', 'database name', 4, 0, '2012-01-06 10:55:10', '2012-01-06 10:55:10'),
(40, 10, NULL, 'Study following steps and determine the correct order\r\n(1)   Open a connection to MySql server\r\n(2)   Execute the SQL query\r\n(3)   Fetch the data from query\r\n(4)   Select database\r\n(5)   Close Connection', '1, 4, 2, 3, 5', '4, 1, 2, 3, 5', '1, 5, 4, 2, 1', '4, 1, 3, 2, 5', 1, 0, '2012-01-06 10:56:12', '2012-01-06 10:56:12'),
(41, 10, NULL, 'Which of the following is not a session function?', 'session_decode', 'session_destroy', 'session_id', 'session_pw', 4, 0, '2012-01-06 10:58:26', '2012-01-06 10:58:26'),
(42, 10, NULL, 'When uploading a file if the UPLOAD_ERR-OK contains value 0 it means', 'Uplaod is not successful, error occurred', 'The file uploaded with success', 'Uploaded file size is 0', ' File upload progress is 0% completed ', 2, 0, '2012-01-06 11:00:01', '2012-01-06 11:00:01'),
(43, 10, NULL, ' Which of the following delimiter syntax is PHP''s default delimiter syntax', '&lt;?php ... ?>', '&lt;%   %>', '&lt;?     ?>', '&lt;script language="php"> &lt;/script>', 1, 0, '2012-01-06 11:00:49', '2012-01-06 11:15:18'),
(44, 10, NULL, 'Which of the following statement produce different output', '&lt;?echo "This is php example"; ?>', '&lt;P="This is php example"; ?>', '&lt;?PHP echo "This is php example"; php?>', '&lt;script language="php"> print "This is php example";&lt;/script>', 3, 0, '2012-01-06 11:02:07', '2012-01-06 11:16:26'),
(45, 10, NULL, 'Which of the following delimiter is ASP style?', '&lt;?php ?>', '&lt;% %>', '&lt;? ?>', '&lt;script language="php"> &lt;/script>', 2, 0, '2012-01-06 11:03:21', '2012-01-06 11:15:41'),
(46, 10, NULL, 'Php supports all four different ways of delimiting. In this context identify the false statement', 'You can use any of the delimiting style', 'You can use different delimiting styles in same page', 'You can use any delimiting style but must use a single style consistently for a page', 'Variables declared in previous blocks are remenbered on later blocks too!', 3, 0, '2012-01-06 11:04:24', '2012-01-06 11:04:24'),
(47, 10, NULL, 'Which of following commenting is supported by Php', 'Single line c++ syntax - //', 'Shell syntax - #', 'Both of above', 'None of above', 3, 0, '2012-01-06 11:05:19', '2012-01-06 11:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `course_id`, `created`, `modified`) VALUES
(10, 'PHP', 0, '2012-01-06 10:21:49', '2012-01-06 10:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) unsigned DEFAULT NULL,
  `subject_id` int(10) unsigned DEFAULT NULL,
  `code` varchar(4) CHARACTER SET latin1 DEFAULT NULL,
  `started` datetime DEFAULT NULL,
  `submitted` datetime DEFAULT NULL,
  `last_question` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `candidate_id`, `subject_id`, `code`, `started`, `submitted`, `last_question`, `created`, `modified`) VALUES
(625, 4, 10, '8KR9', '2012-01-13 13:22:10', NULL, 15, '2012-01-13 13:21:30', '2012-01-13 14:02:15'),
(626, 3, 10, 'YKAf', '2012-01-13 14:17:39', NULL, 16, '2012-01-13 14:17:23', '2012-01-13 14:20:32'),
(632, 3, 10, '7AUj', '2012-01-13 16:30:22', NULL, 4, '2012-01-13 16:30:13', '2012-01-13 16:31:06'),
(633, 4, 10, 'R7Vw', '2012-01-13 16:32:29', NULL, 12, '2012-01-13 16:32:16', '2012-01-13 16:33:38'),
(634, 4, 10, 'n5pV', '2012-01-13 16:35:17', NULL, 9, '2012-01-13 16:35:07', '2012-01-13 16:37:31'),
(635, 3, 10, 'epvg', '2012-01-13 16:38:14', NULL, 2, '2012-01-13 16:37:46', '2012-01-13 16:39:26'),
(636, 4, 10, 'bJ7y', '2012-05-04 21:13:44', NULL, 25, '2012-05-04 21:13:35', '2012-05-04 21:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `test_questions`
--

CREATE TABLE IF NOT EXISTS `test_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `test_id` int(10) unsigned DEFAULT NULL,
  `title` text,
  `option_1` text,
  `option_2` text,
  `option_3` text,
  `option_4` text,
  `answer` smallint(6) DEFAULT NULL,
  `selected_option` smallint(6) DEFAULT NULL,
  `subject` varchar(250) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `test_questions`
--

INSERT INTO `test_questions` (`id`, `test_id`, `title`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `selected_option`, `subject`, `created`, `modified`) VALUES
(1, 625, 'To work with remote files in PHP you need to enable', 'allow_url_fopen', 'allow_remote_files', 'both of above', 'none of above', 1, 3, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:24:49'),
(2, 625, 'The difference between include() and require()', 'are different how they handle failure', 'both are same in every aspects', 'is include() produced a Fatal Error while require results in a Warning', 'none of above', 1, 3, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:25:18'),
(3, 625, ' Which of the following delimiter syntax is PHP''s default delimiter syntax', '&lt;?php ... ?>', '&lt;%   %>', '&lt;?     ?>', '&lt;script language="php"> &lt;/script>', 1, 1, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:25:25'),
(4, 625, 'Which of the following is not true?', 'PHP can be used to develop web applications.', 'PHP makes a website dynamic.', 'PHP applications can not be compiled.', 'PHP can not be embedded into html.', 4, 3, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:25:57'),
(5, 625, 'Which of the following variables is not a predefined variable?', '$_GET', '$_ASK', '$_REQUEST', '$_POST', 2, 2, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:26:11'),
(6, 625, 'Which of the following method sends input to a script via a URL?', 'Get', 'Post', 'Both', 'None', 1, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:26:20'),
(7, 625, 'Which of the following delimiter is ASP style?', '&lt;?php ?>', '&lt;% %>', '&lt;? ?>', '&lt;script language="php"> &lt;/script>', 2, 4, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:26:55'),
(8, 625, 'Php supports all four different ways of delimiting. In this context identify the false statement', 'You can use any of the delimiting style', 'You can use different delimiting styles in same page', 'You can use any delimiting style but must use a single style consistently for a page', 'Variables declared in previous blocks are remenbered on later blocks too!', 3, 4, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:27:18'),
(9, 625, 'Which of the following function returns the number of characters in a string variable?', 'count($variable)', 'len($variable)', 'strcount($variable)', 'strlen($variable)', 4, 3, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:27:36'),
(10, 625, 'When a file is included the code it contains, behave for variable scope of the line on which the include occurs', 'Any variable available at that line in the calling file will be available within the called file from that point', 'Any variable available at that line in the calling file will not be available within the called file', 'Variables are local in both called and calling files', 'None of above', 1, 2, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:27:47'),
(11, 625, 'When you need to obtain the ASCII value of a character which of the following function you apply in PHP?', 'chr( );', 'asc( );', 'ord( );', 'val( );', 3, 3, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:27:50'),
(12, 625, 'The following piece of script will output:\r\n<?\r\n$email=''admin@psexam.com'';\r\n$new=strstr($email, ''@'');\r\nprint $new;\r\n?>', 'admin', 'admin@psexam', '@psexam.com', 'psexam.com', 3, 3, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:28:16'),
(13, 625, 'Which of the following method is suitable when you need to send larger form submissions?', 'Get', 'Post', 'Both Get and Post', 'There is no direct way for larger form. You need to store them in a file and retrieve', 2, 3, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:28:35'),
(14, 625, ' When compared to the compiled program, scripts run', 'Faster', 'Slower', 'The execution speed is similar', 'All of above', 2, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:28:57'),
(15, 625, 'Which of the following is not a session function?', 'session_decode', 'session_destroy', 'session_id', 'session_pw', 4, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 14:02:15'),
(16, 625, 'PHP is a widely used â€¦â€¦â€¦â€¦â€¦. scripting language that is especially suited for web development and can be embedded into html', 'Open source general purpose', 'Proprietary general purpose', 'Open source special purpose', 'Proprietary special purpose', 1, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:21:30'),
(17, 625, 'The function setcookie( ) is used to', 'Enable or disable cookie support', 'Declare cookie variables', 'Store data in cookie variable', 'All of above', 3, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:21:30'),
(18, 625, 'The most portable version of PHP tag that is compatible to embed in XML or XHTML too is:', '&lt;? ... ?>', '&lt;script language="php"> ... &lt;/script>', '&lt;% ... %>', '&lt;php ... ?>', 4, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:21:30'),
(19, 625, 'Which of the following mode of fopen() function opens a file only for writing. If a file with that name does not exist, attempts to create anew file. If the file exist, place the file pointer at the end of the file after all other data.', 'W', 'W+', 'A', 'A+', 3, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:21:30'),
(20, 625, 'fopen($file_doc,''r+'') opens a file for', 'reading', 'writing', 'none of above', 'both of above', 4, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:21:30'),
(21, 625, 'Study following steps and determine the correct order\r\n(1)   Open a connection to MySql server\r\n(2)   Execute the SQL query\r\n(3)   Fetch the data from query\r\n(4)   Select database\r\n(5)   Close Connection', '1, 4, 2, 3, 5', '4, 1, 2, 3, 5', '1, 5, 4, 2, 1', '4, 1, 3, 2, 5', 1, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:21:30'),
(22, 625, 'You can define a constant by using the define() function. Once a constant is defined', 'It can never be changed or undefined', 'It can never be changed but can be undefined', 'It can be changed but can not be undefined', 'It can be changed and can be undefined', 2, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:21:30'),
(23, 625, 'A script is a ...', 'Program or sequence of instructions that is interpreted or carried out by processor directly', 'Program or sequence of instruction that is interpreted or carried out by another program', 'Program or sequence of instruction that is interpreted or carried out by web server only', 'None of above', 2, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:21:30'),
(24, 625, 'Which of following commenting is supported by Php', 'Single line c++ syntax - //', 'Shell syntax - #', 'Both of above', 'None of above', 3, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:21:30'),
(25, 625, 'When uploading a file if the UPLOAD_ERR-OK contains value 0 it means', 'Uplaod is not successful, error occurred', 'The file uploaded with success', 'Uploaded file size is 0', ' File upload progress is 0% completed ', 2, NULL, 'PHP', '2012-01-13 13:21:30', '2012-01-13 13:21:30'),
(26, 626, 'The difference between include() and require()', 'are different how they handle failure', 'both are same in every aspects', 'is include() produced a Fatal Error while require results in a Warning', 'none of above', 1, 3, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:17:52'),
(27, 626, 'PHP is a widely used â€¦â€¦â€¦â€¦â€¦. scripting language that is especially suited for web development and can be embedded into html', 'Open source general purpose', 'Proprietary general purpose', 'Open source special purpose', 'Proprietary special purpose', 1, 1, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:17:56'),
(28, 626, 'Php supports all four different ways of delimiting. In this context identify the false statement', 'You can use any of the delimiting style', 'You can use different delimiting styles in same page', 'You can use any delimiting style but must use a single style consistently for a page', 'Variables declared in previous blocks are remenbered on later blocks too!', 3, 2, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:18:11'),
(29, 626, 'The following piece of script will output:\r\n<?\r\n$email=''admin@psexam.com'';\r\n$new=strstr($email, ''@'');\r\nprint $new;\r\n?>', 'admin', 'admin@psexam', '@psexam.com', 'psexam.com', 3, 3, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:18:13'),
(30, 626, 'When a file is included the code it contains, behave for variable scope of the line on which the include occurs', 'Any variable available at that line in the calling file will be available within the called file from that point', 'Any variable available at that line in the calling file will not be available within the called file', 'Variables are local in both called and calling files', 'None of above', 1, 2, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:18:22'),
(31, 626, 'Which of the following delimiter is ASP style?', '&lt;?php ?>', '&lt;% %>', '&lt;? ?>', '&lt;script language="php"> &lt;/script>', 2, 4, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:18:28'),
(32, 626, 'Which of the following mode of fopen() function opens a file only for writing. If a file with that name does not exist, attempts to create anew file. If the file exist, place the file pointer at the end of the file after all other data.', 'W', 'W+', 'A', 'A+', 3, 3, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:18:39'),
(33, 626, 'When you need to obtain the ASCII value of a character which of the following function you apply in PHP?', 'chr( );', 'asc( );', 'ord( );', 'val( );', 3, 3, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:19:14'),
(34, 626, 'The most portable version of PHP tag that is compatible to embed in XML or XHTML too is:', '&lt;? ... ?>', '&lt;script language="php"> ... &lt;/script>', '&lt;% ... %>', '&lt;php ... ?>', 4, 4, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:19:47'),
(35, 626, 'Which of the following is not true?', 'PHP can be used to develop web applications.', 'PHP makes a website dynamic.', 'PHP applications can not be compiled.', 'PHP can not be embedded into html.', 4, 2, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:19:50'),
(36, 626, 'A variable $word is set to "HELLO WORLD", which of the following script returns in title case?', 'echo ucwords($word)', 'echo ucwords(strtolower($word)', 'echo ucfirst($word)', 'echo ucfirst(strtolower($word)', 2, 4, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:19:53'),
(37, 626, 'Which of the following method sends input to a script via a URL?', 'Get', 'Post', 'Both', 'None', 1, 1, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:20:01'),
(38, 626, 'When uploading a file if the UPLOAD_ERR-OK contains value 0 it means', 'Uplaod is not successful, error occurred', 'The file uploaded with success', 'Uploaded file size is 0', ' File upload progress is 0% completed ', 2, 4, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:20:14'),
(39, 626, 'Study following steps and determine the correct order\r\n(1)   Open a connection to MySql server\r\n(2)   Execute the SQL query\r\n(3)   Fetch the data from query\r\n(4)   Select database\r\n(5)   Close Connection', '1, 4, 2, 3, 5', '4, 1, 2, 3, 5', '1, 5, 4, 2, 1', '4, 1, 3, 2, 5', 1, 1, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:20:18'),
(40, 626, ' Which of the following delimiter syntax is PHP''s default delimiter syntax', '&lt;?php ... ?>', '&lt;%   %>', '&lt;?     ?>', '&lt;script language="php"> &lt;/script>', 1, 1, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:20:23'),
(41, 626, 'Which of the following method is suitable when you need to send larger form submissions?', 'Get', 'Post', 'Both Get and Post', 'There is no direct way for larger form. You need to store them in a file and retrieve', 2, 2, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:20:32'),
(42, 626, 'Which of the following variables is not a predefined variable?', '$_GET', '$_ASK', '$_REQUEST', '$_POST', 2, NULL, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:17:23'),
(43, 626, 'You can define a constant by using the define() function. Once a constant is defined', 'It can never be changed or undefined', 'It can never be changed but can be undefined', 'It can be changed but can not be undefined', 'It can be changed and can be undefined', 2, NULL, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:17:23'),
(44, 626, 'Which of the following is not a session function?', 'session_decode', 'session_destroy', 'session_id', 'session_pw', 4, NULL, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:17:23'),
(45, 626, 'To work with remote files in PHP you need to enable', 'allow_url_fopen', 'allow_remote_files', 'both of above', 'none of above', 1, NULL, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:17:23'),
(46, 626, ' When compared to the compiled program, scripts run', 'Faster', 'Slower', 'The execution speed is similar', 'All of above', 2, NULL, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:17:23'),
(47, 626, 'The function setcookie( ) is used to', 'Enable or disable cookie support', 'Declare cookie variables', 'Store data in cookie variable', 'All of above', 3, NULL, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:17:23'),
(48, 626, 'A script is a ...', 'Program or sequence of instructions that is interpreted or carried out by processor directly', 'Program or sequence of instruction that is interpreted or carried out by another program', 'Program or sequence of instruction that is interpreted or carried out by web server only', 'None of above', 2, NULL, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:17:23'),
(49, 626, 'Which of following commenting is supported by Php', 'Single line c++ syntax - //', 'Shell syntax - #', 'Both of above', 'None of above', 3, NULL, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:17:23'),
(50, 626, 'mysql_connect( ) does not take following parameter', 'database host', 'user ID', 'password', 'database name', 4, NULL, 'PHP', '2012-01-13 14:17:23', '2012-01-13 14:17:23'),
(213, 633, 'When uploading a file if the UPLOAD_ERR-OK contains value 0 it means', 'Uplaod is not successful, error occurred', 'The file uploaded with success', 'Uploaded file size is 0', ' File upload progress is 0% completed ', 2, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(212, 633, 'Which of the following is not true?', 'PHP can be used to develop web applications.', 'PHP makes a website dynamic.', 'PHP applications can not be compiled.', 'PHP can not be embedded into html.', 4, 4, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:33:38'),
(211, 633, 'Study following steps and determine the correct order\r\n(1)   Open a connection to MySql server\r\n(2)   Execute the SQL query\r\n(3)   Fetch the data from query\r\n(4)   Select database\r\n(5)   Close Connection', '1, 4, 2, 3, 5', '4, 1, 2, 3, 5', '1, 5, 4, 2, 1', '4, 1, 3, 2, 5', 1, 1, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:33:33'),
(209, 633, 'Which of the following delimiter is ASP style?', '&lt;?php ?>', '&lt;% %>', '&lt;? ?>', '&lt;script language="php"> &lt;/script>', 2, 4, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:33:20'),
(208, 633, 'Which of the following method is suitable when you need to send larger form submissions?', 'Get', 'Post', 'Both Get and Post', 'There is no direct way for larger form. You need to store them in a file and retrieve', 2, 2, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:33:17'),
(205, 633, 'The function setcookie( ) is used to', 'Enable or disable cookie support', 'Declare cookie variables', 'Store data in cookie variable', 'All of above', 3, 3, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:33:09'),
(206, 633, 'When you need to obtain the ASCII value of a character which of the following function you apply in PHP?', 'chr( );', 'asc( );', 'ord( );', 'val( );', 3, 3, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:33:10'),
(204, 633, 'Which of the following variables is not a predefined variable?', '$_GET', '$_ASK', '$_REQUEST', '$_POST', 2, 2, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:33:05'),
(203, 633, 'Which of the following function returns the number of characters in a string variable?', 'count($variable)', 'len($variable)', 'strcount($variable)', 'strlen($variable)', 4, 4, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:58'),
(200, 632, ' When compared to the compiled program, scripts run', 'Faster', 'Slower', 'The execution speed is similar', 'All of above', 2, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(184, 632, 'When you need to obtain the ASCII value of a character which of the following function you apply in PHP?', 'chr( );', 'asc( );', 'ord( );', 'val( );', 3, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(183, 632, 'fopen($file_doc,''r+'') opens a file for', 'reading', 'writing', 'none of above', 'both of above', 4, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(182, 632, 'Which of the following function returns the number of characters in a string variable?', 'count($variable)', 'len($variable)', 'strcount($variable)', 'strlen($variable)', 4, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(181, 632, 'Which of the following method is suitable when you need to send larger form submissions?', 'Get', 'Post', 'Both Get and Post', 'There is no direct way for larger form. You need to store them in a file and retrieve', 2, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(180, 632, ' Which of the following delimiter syntax is PHP''s default delimiter syntax', '&lt;?php ... ?>', '&lt;%   %>', '&lt;?     ?>', '&lt;script language="php"> &lt;/script>', 1, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(179, 632, 'A variable $word is set to "HELLO WORLD", which of the following script returns in title case?', 'echo ucwords($word)', 'echo ucwords(strtolower($word)', 'echo ucfirst($word)', 'echo ucfirst(strtolower($word)', 2, 4, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:31:06'),
(178, 632, 'The following piece of script will output:\r\n<?\r\n$email=''admin@psexam.com'';\r\n$new=strstr($email, ''@'');\r\nprint $new;\r\n?>', 'admin', 'admin@psexam', '@psexam.com', 'psexam.com', 3, 2, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:47'),
(177, 632, 'Php supports all four different ways of delimiting. In this context identify the false statement', 'You can use any of the delimiting style', 'You can use different delimiting styles in same page', 'You can use any delimiting style but must use a single style consistently for a page', 'Variables declared in previous blocks are remenbered on later blocks too!', 3, 3, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:36'),
(176, 632, 'You can define a constant by using the define() function. Once a constant is defined', 'It can never be changed or undefined', 'It can never be changed but can be undefined', 'It can be changed but can not be undefined', 'It can be changed and can be undefined', 2, 3, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:25'),
(210, 633, 'Which of the following method sends input to a script via a URL?', 'Get', 'Post', 'Both', 'None', 1, 2, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:33:30'),
(207, 633, 'When a file is included the code it contains, behave for variable scope of the line on which the include occurs', 'Any variable available at that line in the calling file will be available within the called file from that point', 'Any variable available at that line in the calling file will not be available within the called file', 'Variables are local in both called and calling files', 'None of above', 1, 3, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:33:13'),
(202, 633, 'PHP is a widely used â€¦â€¦â€¦â€¦â€¦. scripting language that is especially suited for web development and can be embedded into html', 'Open source general purpose', 'Proprietary general purpose', 'Open source special purpose', 'Proprietary special purpose', 1, 4, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:42'),
(201, 633, 'Which of following commenting is supported by Php', 'Single line c++ syntax - //', 'Shell syntax - #', 'Both of above', 'None of above', 3, 3, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:31'),
(185, 632, 'The difference between include() and require()', 'are different how they handle failure', 'both are same in every aspects', 'is include() produced a Fatal Error while require results in a Warning', 'none of above', 1, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(186, 632, 'Study following steps and determine the correct order\r\n(1)   Open a connection to MySql server\r\n(2)   Execute the SQL query\r\n(3)   Fetch the data from query\r\n(4)   Select database\r\n(5)   Close Connection', '1, 4, 2, 3, 5', '4, 1, 2, 3, 5', '1, 5, 4, 2, 1', '4, 1, 3, 2, 5', 1, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(187, 632, 'The most portable version of PHP tag that is compatible to embed in XML or XHTML too is:', '&lt;? ... ?>', '&lt;script language="php"> ... &lt;/script>', '&lt;% ... %>', '&lt;php ... ?>', 4, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(188, 632, 'When uploading a file if the UPLOAD_ERR-OK contains value 0 it means', 'Uplaod is not successful, error occurred', 'The file uploaded with success', 'Uploaded file size is 0', ' File upload progress is 0% completed ', 2, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(189, 632, 'Which of the following mode of fopen() function opens a file only for writing. If a file with that name does not exist, attempts to create anew file. If the file exist, place the file pointer at the end of the file after all other data.', 'W', 'W+', 'A', 'A+', 3, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(190, 632, 'In mail($param2, $param2, $param3, $param4), the $param2 contains:', 'The message', 'The recipient', 'The header', 'The subject ', 4, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(191, 632, 'Which of the following variables is not a predefined variable?', '$_GET', '$_ASK', '$_REQUEST', '$_POST', 2, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(192, 632, 'PHP is a widely used â€¦â€¦â€¦â€¦â€¦. scripting language that is especially suited for web development and can be embedded into html', 'Open source general purpose', 'Proprietary general purpose', 'Open source special purpose', 'Proprietary special purpose', 1, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(193, 632, 'Which of the following statement produce different output', '&lt;?echo "This is php example"; ?>', '&lt;P="This is php example"; ?>', '&lt;?PHP echo "This is php example"; php?>', '&lt;script language="php"> print "This is php example";&lt;/script>', 3, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(194, 632, 'Which of following commenting is supported by Php', 'Single line c++ syntax - //', 'Shell syntax - #', 'Both of above', 'None of above', 3, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(195, 632, 'Which of the following is not a session function?', 'session_decode', 'session_destroy', 'session_id', 'session_pw', 4, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(196, 632, 'To work with remote files in PHP you need to enable', 'allow_url_fopen', 'allow_remote_files', 'both of above', 'none of above', 1, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(197, 632, 'Which of the following delimiter is ASP style?', '&lt;?php ?>', '&lt;% %>', '&lt;? ?>', '&lt;script language="php"> &lt;/script>', 2, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(198, 632, 'mysql_connect( ) does not take following parameter', 'database host', 'user ID', 'password', 'database name', 4, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(199, 632, 'When a file is included the code it contains, behave for variable scope of the line on which the include occurs', 'Any variable available at that line in the calling file will be available within the called file from that point', 'Any variable available at that line in the calling file will not be available within the called file', 'Variables are local in both called and calling files', 'None of above', 1, NULL, 'PHP', '2012-01-13 16:30:13', '2012-01-13 16:30:13'),
(256, 635, 'A script is a ...', 'Program or sequence of instructions that is interpreted or carried out by processor directly', 'Program or sequence of instruction that is interpreted or carried out by another program', 'Program or sequence of instruction that is interpreted or carried out by web server only', 'None of above', 2, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(255, 635, 'When a file is included the code it contains, behave for variable scope of the line on which the include occurs', 'Any variable available at that line in the calling file will be available within the called file from that point', 'Any variable available at that line in the calling file will not be available within the called file', 'Variables are local in both called and calling files', 'None of above', 1, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(254, 635, 'The most portable version of PHP tag that is compatible to embed in XML or XHTML too is:', '&lt;? ... ?>', '&lt;script language="php"> ... &lt;/script>', '&lt;% ... %>', '&lt;php ... ?>', 4, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(253, 635, 'Which of the following is not a session function?', 'session_decode', 'session_destroy', 'session_id', 'session_pw', 4, 1, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:39:08'),
(252, 635, 'A variable $word is set to "HELLO WORLD", which of the following script returns in title case?', 'echo ucwords($word)', 'echo ucwords(strtolower($word)', 'echo ucfirst($word)', 'echo ucfirst(strtolower($word)', 2, 3, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:39:26'),
(251, 635, 'Which of the following is not true?', 'PHP can be used to develop web applications.', 'PHP makes a website dynamic.', 'PHP applications can not be compiled.', 'PHP can not be embedded into html.', 4, 4, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:38:40'),
(214, 633, 'fopen($file_doc,''r+'') opens a file for', 'reading', 'writing', 'none of above', 'both of above', 4, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(215, 633, 'mysql_connect( ) does not take following parameter', 'database host', 'user ID', 'password', 'database name', 4, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(216, 633, 'Which of the following is not a session function?', 'session_decode', 'session_destroy', 'session_id', 'session_pw', 4, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(217, 633, 'Php supports all four different ways of delimiting. In this context identify the false statement', 'You can use any of the delimiting style', 'You can use different delimiting styles in same page', 'You can use any delimiting style but must use a single style consistently for a page', 'Variables declared in previous blocks are remenbered on later blocks too!', 3, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(218, 633, ' When compared to the compiled program, scripts run', 'Faster', 'Slower', 'The execution speed is similar', 'All of above', 2, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(219, 633, ' Which of the following delimiter syntax is PHP''s default delimiter syntax', '&lt;?php ... ?>', '&lt;%   %>', '&lt;?     ?>', '&lt;script language="php"> &lt;/script>', 1, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(220, 633, 'A variable $word is set to "HELLO WORLD", which of the following script returns in title case?', 'echo ucwords($word)', 'echo ucwords(strtolower($word)', 'echo ucfirst($word)', 'echo ucfirst(strtolower($word)', 2, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(221, 633, 'The following piece of script will output:\r\n<?\r\n$email=''admin@psexam.com'';\r\n$new=strstr($email, ''@'');\r\nprint $new;\r\n?>', 'admin', 'admin@psexam', '@psexam.com', 'psexam.com', 3, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(222, 633, 'To work with remote files in PHP you need to enable', 'allow_url_fopen', 'allow_remote_files', 'both of above', 'none of above', 1, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(223, 633, 'You can define a constant by using the define() function. Once a constant is defined', 'It can never be changed or undefined', 'It can never be changed but can be undefined', 'It can be changed but can not be undefined', 'It can be changed and can be undefined', 2, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(224, 633, 'Which of the following statement produce different output', '&lt;?echo "This is php example"; ?>', '&lt;P="This is php example"; ?>', '&lt;?PHP echo "This is php example"; php?>', '&lt;script language="php"> print "This is php example";&lt;/script>', 3, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(225, 633, 'The difference between include() and require()', 'are different how they handle failure', 'both are same in every aspects', 'is include() produced a Fatal Error while require results in a Warning', 'none of above', 1, NULL, 'PHP', '2012-01-13 16:32:16', '2012-01-13 16:32:16'),
(226, 634, 'To work with remote files in PHP you need to enable', 'allow_url_fopen', 'allow_remote_files', 'both of above', 'none of above', 1, 2, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:35'),
(227, 634, 'Which of the following variables is not a predefined variable?', '$_GET', '$_ASK', '$_REQUEST', '$_POST', 2, 2, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:44'),
(228, 634, 'The most portable version of PHP tag that is compatible to embed in XML or XHTML too is:', '&lt;? ... ?>', '&lt;script language="php"> ... &lt;/script>', '&lt;% ... %>', '&lt;php ... ?>', 4, 4, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:49'),
(229, 634, 'You can define a constant by using the define() function. Once a constant is defined', 'It can never be changed or undefined', 'It can never be changed but can be undefined', 'It can be changed but can not be undefined', 'It can be changed and can be undefined', 2, 4, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:54'),
(230, 634, 'A variable $word is set to "HELLO WORLD", which of the following script returns in title case?', 'echo ucwords($word)', 'echo ucwords(strtolower($word)', 'echo ucfirst($word)', 'echo ucfirst(strtolower($word)', 2, 3, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:37:21'),
(231, 634, 'When uploading a file if the UPLOAD_ERR-OK contains value 0 it means', 'Uplaod is not successful, error occurred', 'The file uploaded with success', 'Uploaded file size is 0', ' File upload progress is 0% completed ', 2, 4, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:37:23'),
(232, 634, 'The following piece of script will output:\r\n<?\r\n$email=''admin@psexam.com'';\r\n$new=strstr($email, ''@'');\r\nprint $new;\r\n?>', 'admin', 'admin@psexam', '@psexam.com', 'psexam.com', 3, 3, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:37:26'),
(233, 634, 'Which of following commenting is supported by Php', 'Single line c++ syntax - //', 'Shell syntax - #', 'Both of above', 'None of above', 3, 3, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:37:28'),
(234, 634, 'PHP is a widely used â€¦â€¦â€¦â€¦â€¦. scripting language that is especially suited for web development and can be embedded into html', 'Open source general purpose', 'Proprietary general purpose', 'Open source special purpose', 'Proprietary special purpose', 1, 1, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:37:31'),
(235, 634, 'In mail($param2, $param2, $param3, $param4), the $param2 contains:', 'The message', 'The recipient', 'The header', 'The subject ', 4, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(236, 634, ' When compared to the compiled program, scripts run', 'Faster', 'Slower', 'The execution speed is similar', 'All of above', 2, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(237, 634, 'Which of the following is not true?', 'PHP can be used to develop web applications.', 'PHP makes a website dynamic.', 'PHP applications can not be compiled.', 'PHP can not be embedded into html.', 4, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(238, 634, 'When a file is included the code it contains, behave for variable scope of the line on which the include occurs', 'Any variable available at that line in the calling file will be available within the called file from that point', 'Any variable available at that line in the calling file will not be available within the called file', 'Variables are local in both called and calling files', 'None of above', 1, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(239, 634, 'Which of the following statement produce different output', '&lt;?echo "This is php example"; ?>', '&lt;P="This is php example"; ?>', '&lt;?PHP echo "This is php example"; php?>', '&lt;script language="php"> print "This is php example";&lt;/script>', 3, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(240, 634, 'The function setcookie( ) is used to', 'Enable or disable cookie support', 'Declare cookie variables', 'Store data in cookie variable', 'All of above', 3, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(241, 634, 'A script is a ...', 'Program or sequence of instructions that is interpreted or carried out by processor directly', 'Program or sequence of instruction that is interpreted or carried out by another program', 'Program or sequence of instruction that is interpreted or carried out by web server only', 'None of above', 2, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(242, 634, ' Which of the following delimiter syntax is PHP''s default delimiter syntax', '&lt;?php ... ?>', '&lt;%   %>', '&lt;?     ?>', '&lt;script language="php"> &lt;/script>', 1, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(243, 634, 'When you need to obtain the ASCII value of a character which of the following function you apply in PHP?', 'chr( );', 'asc( );', 'ord( );', 'val( );', 3, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(244, 634, 'Php supports all four different ways of delimiting. In this context identify the false statement', 'You can use any of the delimiting style', 'You can use different delimiting styles in same page', 'You can use any delimiting style but must use a single style consistently for a page', 'Variables declared in previous blocks are remenbered on later blocks too!', 3, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(245, 634, 'Which of the following delimiter is ASP style?', '&lt;?php ?>', '&lt;% %>', '&lt;? ?>', '&lt;script language="php"> &lt;/script>', 2, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(246, 634, 'mysql_connect( ) does not take following parameter', 'database host', 'user ID', 'password', 'database name', 4, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(247, 634, 'Which of the following function returns the number of characters in a string variable?', 'count($variable)', 'len($variable)', 'strcount($variable)', 'strlen($variable)', 4, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(248, 634, 'fopen($file_doc,''r+'') opens a file for', 'reading', 'writing', 'none of above', 'both of above', 4, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(249, 634, 'The difference between include() and require()', 'are different how they handle failure', 'both are same in every aspects', 'is include() produced a Fatal Error while require results in a Warning', 'none of above', 1, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(250, 634, 'Which of the following mode of fopen() function opens a file only for writing. If a file with that name does not exist, attempts to create anew file. If the file exist, place the file pointer at the end of the file after all other data.', 'W', 'W+', 'A', 'A+', 3, NULL, 'PHP', '2012-01-13 16:35:07', '2012-01-13 16:35:07'),
(264, 635, 'When you need to obtain the ASCII value of a character which of the following function you apply in PHP?', 'chr( );', 'asc( );', 'ord( );', 'val( );', 3, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(265, 635, 'Which of the following statement produce different output', '&lt;?echo "This is php example"; ?>', '&lt;P="This is php example"; ?>', '&lt;?PHP echo "This is php example"; php?>', '&lt;script language="php"> print "This is php example";&lt;/script>', 3, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(263, 635, 'mysql_connect( ) does not take following parameter', 'database host', 'user ID', 'password', 'database name', 4, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(262, 635, 'To work with remote files in PHP you need to enable', 'allow_url_fopen', 'allow_remote_files', 'both of above', 'none of above', 1, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(261, 635, 'Php supports all four different ways of delimiting. In this context identify the false statement', 'You can use any of the delimiting style', 'You can use different delimiting styles in same page', 'You can use any delimiting style but must use a single style consistently for a page', 'Variables declared in previous blocks are remenbered on later blocks too!', 3, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(260, 635, 'In mail($param2, $param2, $param3, $param4), the $param2 contains:', 'The message', 'The recipient', 'The header', 'The subject ', 4, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(259, 635, 'When uploading a file if the UPLOAD_ERR-OK contains value 0 it means', 'Uplaod is not successful, error occurred', 'The file uploaded with success', 'Uploaded file size is 0', ' File upload progress is 0% completed ', 2, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(258, 635, 'The following piece of script will output:\r\n<?\r\n$email=''admin@psexam.com'';\r\n$new=strstr($email, ''@'');\r\nprint $new;\r\n?>', 'admin', 'admin@psexam', '@psexam.com', 'psexam.com', 3, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(257, 635, 'Study following steps and determine the correct order\r\n(1)   Open a connection to MySql server\r\n(2)   Execute the SQL query\r\n(3)   Fetch the data from query\r\n(4)   Select database\r\n(5)   Close Connection', '1, 4, 2, 3, 5', '4, 1, 2, 3, 5', '1, 5, 4, 2, 1', '4, 1, 3, 2, 5', 1, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(266, 635, 'Which of the following variables is not a predefined variable?', '$_GET', '$_ASK', '$_REQUEST', '$_POST', 2, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(267, 635, 'fopen($file_doc,''r+'') opens a file for', 'reading', 'writing', 'none of above', 'both of above', 4, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(268, 635, 'You can define a constant by using the define() function. Once a constant is defined', 'It can never be changed or undefined', 'It can never be changed but can be undefined', 'It can be changed but can not be undefined', 'It can be changed and can be undefined', 2, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(269, 635, 'Which of the following delimiter is ASP style?', '&lt;?php ?>', '&lt;% %>', '&lt;? ?>', '&lt;script language="php"> &lt;/script>', 2, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(270, 635, 'Which of following commenting is supported by Php', 'Single line c++ syntax - //', 'Shell syntax - #', 'Both of above', 'None of above', 3, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(271, 635, 'The function setcookie( ) is used to', 'Enable or disable cookie support', 'Declare cookie variables', 'Store data in cookie variable', 'All of above', 3, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(272, 635, 'The difference between include() and require()', 'are different how they handle failure', 'both are same in every aspects', 'is include() produced a Fatal Error while require results in a Warning', 'none of above', 1, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(273, 635, 'Which of the following method is suitable when you need to send larger form submissions?', 'Get', 'Post', 'Both Get and Post', 'There is no direct way for larger form. You need to store them in a file and retrieve', 2, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(274, 635, ' Which of the following delimiter syntax is PHP''s default delimiter syntax', '&lt;?php ... ?>', '&lt;%   %>', '&lt;?     ?>', '&lt;script language="php"> &lt;/script>', 1, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(275, 635, 'Which of the following method sends input to a script via a URL?', 'Get', 'Post', 'Both', 'None', 1, NULL, 'PHP', '2012-01-13 16:37:46', '2012-01-13 16:37:46'),
(276, 636, 'The function setcookie( ) is used to', 'Enable or disable cookie support', 'Declare cookie variables', 'Store data in cookie variable', 'All of above', 3, 3, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:13:55'),
(277, 636, 'Which of the following method is suitable when you need to send larger form submissions?', 'Get', 'Post', 'Both Get and Post', 'There is no direct way for larger form. You need to store them in a file and retrieve', 2, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:14:01'),
(278, 636, 'When a file is included the code it contains, behave for variable scope of the line on which the include occurs', 'Any variable available at that line in the calling file will be available within the called file from that point', 'Any variable available at that line in the calling file will not be available within the called file', 'Variables are local in both called and calling files', 'None of above', 1, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:14:02'),
(279, 636, 'The difference between include() and require()', 'are different how they handle failure', 'both are same in every aspects', 'is include() produced a Fatal Error while require results in a Warning', 'none of above', 1, 4, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:14:47'),
(280, 636, 'Which of the following mode of fopen() function opens a file only for writing. If a file with that name does not exist, attempts to create anew file. If the file exist, place the file pointer at the end of the file after all other data.', 'W', 'W+', 'A', 'A+', 3, 2, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:14:51'),
(281, 636, 'When you need to obtain the ASCII value of a character which of the following function you apply in PHP?', 'chr( );', 'asc( );', 'ord( );', 'val( );', 3, 3, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:14:56'),
(282, 636, 'PHP is a widely used â€¦â€¦â€¦â€¦â€¦. scripting language that is especially suited for web development and can be embedded into html', 'Open source general purpose', 'Proprietary general purpose', 'Open source special purpose', 'Proprietary special purpose', 1, 3, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:14:59'),
(283, 636, 'In mail($param2, $param2, $param3, $param4), the $param2 contains:', 'The message', 'The recipient', 'The header', 'The subject ', 4, 4, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:15:06'),
(284, 636, 'To work with remote files in PHP you need to enable', 'allow_url_fopen', 'allow_remote_files', 'both of above', 'none of above', 1, 3, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:15:10'),
(285, 636, 'Which of following commenting is supported by Php', 'Single line c++ syntax - //', 'Shell syntax - #', 'Both of above', 'None of above', 3, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:15:34'),
(286, 636, 'Which of the following variables is not a predefined variable?', '$_GET', '$_ASK', '$_REQUEST', '$_POST', 2, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:15:36'),
(287, 636, ' Which of the following delimiter syntax is PHP''s default delimiter syntax', '&lt;?php ... ?>', '&lt;%   %>', '&lt;?     ?>', '&lt;script language="php"> &lt;/script>', 1, 4, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:15:38'),
(288, 636, 'Study following steps and determine the correct order\r\n(1)   Open a connection to MySql server\r\n(2)   Execute the SQL query\r\n(3)   Fetch the data from query\r\n(4)   Select database\r\n(5)   Close Connection', '1, 4, 2, 3, 5', '4, 1, 2, 3, 5', '1, 5, 4, 2, 1', '4, 1, 3, 2, 5', 1, 2, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:15:42'),
(289, 636, 'Which of the following is not true?', 'PHP can be used to develop web applications.', 'PHP makes a website dynamic.', 'PHP applications can not be compiled.', 'PHP can not be embedded into html.', 4, 3, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:08'),
(290, 636, 'When uploading a file if the UPLOAD_ERR-OK contains value 0 it means', 'Uplaod is not successful, error occurred', 'The file uploaded with success', 'Uploaded file size is 0', ' File upload progress is 0% completed ', 2, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:09'),
(291, 636, 'Which of the following method sends input to a script via a URL?', 'Get', 'Post', 'Both', 'None', 1, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:10'),
(292, 636, 'Php supports all four different ways of delimiting. In this context identify the false statement', 'You can use any of the delimiting style', 'You can use different delimiting styles in same page', 'You can use any delimiting style but must use a single style consistently for a page', 'Variables declared in previous blocks are remenbered on later blocks too!', 3, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:10'),
(293, 636, ' When compared to the compiled program, scripts run', 'Faster', 'Slower', 'The execution speed is similar', 'All of above', 2, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:11'),
(294, 636, 'Which of the following statement produce different output', '&lt;?echo "This is php example"; ?>', '&lt;P="This is php example"; ?>', '&lt;?PHP echo "This is php example"; php?>', '&lt;script language="php"> print "This is php example";&lt;/script>', 3, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:15'),
(295, 636, 'Which of the following function returns the number of characters in a string variable?', 'count($variable)', 'len($variable)', 'strcount($variable)', 'strlen($variable)', 4, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:16'),
(296, 636, 'Which of the following is not a session function?', 'session_decode', 'session_destroy', 'session_id', 'session_pw', 4, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:17'),
(297, 636, 'The most portable version of PHP tag that is compatible to embed in XML or XHTML too is:', '&lt;? ... ?>', '&lt;script language="php"> ... &lt;/script>', '&lt;% ... %>', '&lt;php ... ?>', 4, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:18'),
(298, 636, 'You can define a constant by using the define() function. Once a constant is defined', 'It can never be changed or undefined', 'It can never be changed but can be undefined', 'It can be changed but can not be undefined', 'It can be changed and can be undefined', 2, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:18'),
(299, 636, 'The following piece of script will output:\r\n<?\r\n$email=''admin@psexam.com'';\r\n$new=strstr($email, ''@'');\r\nprint $new;\r\n?>', 'admin', 'admin@psexam', '@psexam.com', 'psexam.com', 3, NULL, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:19'),
(300, 636, 'mysql_connect( ) does not take following parameter', 'database host', 'user ID', 'password', 'database name', 4, 3, 'PHP', '2012-05-04 21:13:35', '2012-05-04 21:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE IF NOT EXISTS `tutorials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image` text CHARACTER SET latin1 NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `contact` int(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `last_ip` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `contact`, `address`, `last_ip`, `created`, `modified`) VALUES
(1, 'admin', 'b76adb608aad94361d3110932ed31217e029fd4c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
