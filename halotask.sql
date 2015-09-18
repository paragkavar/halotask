-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 17, 2013 at 02:32 PM
-- Server version: 5.5.32-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `djogalzw_halotask`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'engineer', ''),
(2, 'admin', '');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(50) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `achievement` varchar(50) NOT NULL,
  `hours` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `uid` int(11) NOT NULL,
  `uid_modified` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project`, `activity`, `achievement`, `hours`, `date`, `uid`, `uid_modified`) VALUES
(1, 'HI - Hours Registration', 'Upload and setting Apps', 'Done', 1, '2011-01-31', 1, 0),
(2, 'HI - Hours Registration', 'Fixing Privilege', 'Done', 3, '2011-01-31', 1, 0),
(3, 'TNT - DAP', 'Managing Zone and Zipcode range', '- Table created\n- Setup module\n- Model and Control', 3, '2011-01-31', 1, 0),
(4, 'TNT - DAP', 'Setup new environment', 'Done', 1, '2011-02-01', 1, 0),
(5, 'TNT - DAP', 'Managing Zone and Zipcode range', '- CRUD Zipcode range created', 5, '2011-02-01', 1, 0),
(6, 'TNT - DAP', 'Managing Zone and Zipcode range', 'Done', 2, '2011-02-02', 1, 0),
(7, 'TNT - DAP', 'Creating new base model', '- making more good model ', 4, '2011-02-02', 1, 0),
(8, 'TNT - DAP', 'Managing Status Code and related Events', '- Model created\n- Status Controller created', 2, '2011-02-02', 1, 0),
(9, 'TNT - DAP', 'Managing Status Code and related Events', '- List, delete and edit status', 4, '2011-02-04', 1, 0),
(10, 'TNT - DAP', 'Designing new model', 'fixing bugs', 3, '2011-02-04', 1, 0),
(11, 'TNT - DAP', 'Managing Status Code and related Events', '- StatusPagination\n- Events list and pagination', 2, '2011-02-07', 1, 0),
(12, 'TNT - DAP', 'Designing new model', '- fixing error strict standard', 2, '2011-02-07', 1, 0),
(13, 'Lafarge RetailMapping Android', 'Modify webservice : Paging for Search Shop by keyword and by Distance,  Add field Active for UserPro', 'Done', 3, '2011-02-16', 9, 0),
(14, 'TNT - BUA', 'model reworks', '- designing and implement new model', 4, '2011-02-08', 1, 0),
(15, 'Lafarge Retail Mapping Android', 'Add Paging funtionality in Search Shop from in Andoid', 'Done', 4, '2011-02-16', 9, 0),
(16, 'TNT - BUA', 'Managing Failure', '40%', 3, '2011-02-08', 1, 0),
(17, 'TNT - BUA', 'Managing Failure', 'done', 3, '2011-02-09', 1, 0),
(18, 'TNT - BUA', 'Managing SMS Email', '- 30%\n- redesign table schema', 3, '2011-02-09', 1, 0),
(19, 'TNT - BUA', 'Managing TNT Clients', '80%', 6, '2011-02-16', 1, 0),
(21, 'TNT - BUA', 'Managing TNT Clients', 'done', 1, '2011-02-17', 1, 0),
(22, 'TNT - BUA', 'Managing Time Slots', 'done', 6, '2011-02-17', 1, 0),
(24, '--', 'sakit', '--', 8, '2011-02-14', 1, 0),
(25, 'Lafarge Retail Mapping Android', 'Prepare for presentation to Lafarge, Create function run in emulator for camera and qrcode model, La', 'Done', 5, '2011-02-17', 9, 0),
(26, 'Lafarge Retail Mapping Android', 'Go to Lafarge Office, RFC Android prenstation', 'Done', 2, '2011-02-17', 9, 0),
(27, 'TNT - BUA', 'Managing TNT Clients Authentications', 'done', 4, '2011-02-18', 1, 0),
(28, 'Lafarge Retail Mapping Android', 'Prepare to send new release Android : - implement webservice from development to server production, ', 'Done', 2, '2011-02-18', 9, 0),
(29, 'Safety Reporting', 'Report Observation', '60%', 5, '2011-02-18', 9, 0),
(32, 'TNT - BUA', 'Managing TNT Contracts', '- Done', 6, '2011-02-22', 1, 0),
(31, 'TNT - BUA', 'Managing TNT Contracts', '- 30%', 2, '2011-02-18', 1, 0),
(33, 'TNT - BUA', 'Manage status codes and event codes per contract per TNT client', '- Done', 5, '2011-02-23', 1, 0),
(34, 'Lafarge Safety - Reporting', 'ObservationAnalys Report', 'Done', 2, '2011-02-23', 9, 0),
(35, 'Lafarge Safety - Reporting', 'ObservationTimeLine Report', 'Done', 4, '2011-02-23', 9, 0),
(36, 'Lafarge Safety - Reporting', 'ObservationEmployee Report', 'Done', 1, '2011-02-23', 9, 0),
(37, 'TNT - BUA', 'Managing Failure Reason', 'done', 1, '2011-02-23', 1, 0),
(38, 'TNT - BUA', 'Managing Failure Status', 'Done', 1, '2011-02-23', 1, 0),
(39, 'TNT - BUA', 'Managing Failure', 'Done', 6, '2011-02-24', 1, 0),
(40, 'TNT - BUA', 'Manage quota per zone per contract per TNT client', '30%', 2, '2011-02-25', 1, 0),
(41, 'TNT - BUA', 'Call for appointment', 'Creating views, models and controller', 4, '2011-02-25', 1, 0),
(42, 'TNT - BUA', 'Call for appointment', 'Creating views, edit controller', 5, '2011-02-28', 1, 0),
(43, 'TNT - BUA', 'Unlock call', '50%', 3, '2011-02-28', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE IF NOT EXISTS `user_tokens` (
  `token_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `token` varchar(32) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`token_id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `role` varchar(10) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` char(50) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `role`, `fullname`, `password`, `logins`, `last_login`, `token`) VALUES
(1, 'rizky@halotec-indonesia.com;rizkyz@gmail.com', 'rizky', 'engineer', 'Rizky Zulkarnaen', '7a61721ed4832664aa3ce8e2234dcdb4', 33, '0000-00-00 00:00:00', ''),
(11, 'andra@halotec-indonesia.com', 'andra', 'engineer', 'andra', '14180f38f11db420937b98aa24fad581', 0, '2011-02-16 05:00:00', ''),
(12, 'rimbun@halotec-indonesia.com', 'rimbun', 'engineer', 'rimbun', '340e68aed3c0beeac8d787650eba52fd', 0, '2011-02-16 05:00:00', ''),
(4, 'novari@halotec-indonesia.com', 'novari', 'eningeer', 'novari', 'd1cca1e4d3d0bb0d4421dcd8944a7dbd', 0, '2011-01-28 05:00:00', ''),
(10, 'mhdalvin@gmail.com', 'alvin', 'engineer', 'Muhammad Alvin', '9573534ee6a886f4831ac5bcdfe85565', 0, '2011-02-16 05:00:00', ''),
(8, 'admin@halotec-indonesia.com', 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 20, '0000-00-00 00:00:00', ''),
(9, 'sawal@halotec-indonesia.com', 'sawal', 'engineer', 'sawal', '333054eb11308fed23a2012080efce71', 5, '0000-00-00 00:00:00', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
