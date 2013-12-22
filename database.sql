-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2013 at 11:16 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `suseelas_p4_suseelaskitchen_com`
--
CREATE DATABASE IF NOT EXISTS `suseelas_p4_suseelaskitchen_com` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `suseelas_p4_suseelaskitchen_com`;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `created`, `modified`, `user_id`, `content`) VALUES
(1, 1387735622, 1387735622, 13, 'Hello World!'),
(2, 1387736273, 1387736273, 13, 'This post is to test P4 project'),
(3, 1387736344, 1387736344, 13, 'Working as a Software Quality Assurance group leader.'),
(4, 1387736940, 1387736940, 14, 'Restaurants in Boston area are busy for Christmas eve dinner reservations.'),
(5, 1387737134, 1387737134, 14, 'Video game Sales are up 15% in 2013.'),
(6, 1387737254, 1387737254, 14, 'As of December 22nd around 1 million users signed up for Obama Health Care.'),
(7, 1387737809, 1387737809, 15, 'The forecast on Christmas eve is partly sunny.'),
(8, 1387737866, 1387737866, 15, 'The forecast on Christmas day in Boston is Partly Cloudy and a little chance of snow.'),
(9, 1387737993, 1387737993, 15, 'The forecast for New year 2014 day in Boston area is Sunny. ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `timezone` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `created`, `modified`, `token`, `password`, `last_login`, `timezone`, `first_name`, `last_name`, `email`, `location`, `bio`, `avatar`, `alt`) VALUES
(13, 1387735508, 1387746948, 'c6922c447afa2e589225f37451c33100797a26f2', 'b04167fbc65d121b99da1081a9f7ea9f74675b84', 0, 0, 'Krishna', 'Majeti', 'krishna@test.com', 'Boston', 'Boston Strong!!!', 'avatar_13.jpg', 'avatar of Krishna'),
(14, 1387736523, 1387736673, '3ea99b34eefb9bcc41852b7c18803ae332237611', '6d2e84b6a5546e3a0be4e32cf3109169a8f04514', 0, 0, 'CNN', 'News', 'cnn@test.com', 'New York', 'CNN Image and Posts are taken from CNN site and they belongs to CNN. I am just using them as a sample for this porject.', 'avatar_14.png', 'avatar of CNN'),
(15, 1387737482, 1387737588, '7a45a67ff5ed73294b5f93ffd994bc13466dd7db', 'c810760a98f0dbe682aef21eb8b48e127874016f', 0, 0, 'Weather', 'News', 'weather@test.com', 'Boston', 'The weather image and its posts are copyright of Weather channel. I am just using them as samples for this project.', 'avatar_15.jpg', 'avatar of Weather');

-- --------------------------------------------------------

--
-- Table structure for table `users_users`
--

CREATE TABLE IF NOT EXISTS `users_users` (
  `user_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'FK. Follower.',
  `user_id_followed` int(11) NOT NULL COMMENT 'Followed.',
  PRIMARY KEY (`user_user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users_users`
--

INSERT INTO `users_users` (`user_user_id`, `created`, `user_id`, `user_id_followed`) VALUES
(2, 1387737080, 14, 14),
(3, 1387737081, 14, 13),
(4, 1387737871, 15, 14),
(5, 1387737871, 15, 13),
(6, 1387737872, 15, 15),
(14, 1387748241, 13, 15),
(15, 1387748690, 13, 13);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_users`
--
ALTER TABLE `users_users`
  ADD CONSTRAINT `users_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
