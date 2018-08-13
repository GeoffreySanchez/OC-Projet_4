-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 13 août 2018 à 13:43
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_4`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `publish` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `summary`, `publish`) VALUES
(1, 'Billet simple pour l\'Alaska', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n<p>\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\n</p>\r\n<p>\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 1),
(2, 'Billet simple pour le Congo', '<p style=\"text-align: center;\">Ce roman est en cours de construction.</p>\r\n<p style=\"text-align: center;\">En attendant, vous pouvez lire le roman d&eacute;j&agrave; disponible.</p>', 0),
(3, 'Billet simple pour l\'Amazonie', '<p style=\"text-align: center;\">Ce roman est en cours de construction.</p>\r\n<p style=\"text-align: center;\">En attendant, vous pouvez lire le roman d&eacute;j&agrave; disponible.</p>', 0);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `report` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `DeleteAllAssociateCommentsWhenPostDelete` (`post_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `comment_date`, `report`) VALUES
(15, 3, 1, 'Commentaire normal', '2018-08-13 15:41:48', 0),
(16, 3, 1, 'Commentaire à signaler', '2018-08-13 15:41:56', 0),
(17, 3, 1, 'Commentaire signalé', '2018-08-13 15:42:06', 1),
(18, 3, 1, 'Commentaire à supprimer', '2018-08-13 15:42:14', 1);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `DeleteAllAssociatePostsWhenBookDelete` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `book_id`, `title`, `content`, `creation_date`) VALUES
(1, 1, 'Jour 1', '<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut eros ut urna malesuada tincidunt. Fusce elementum nibh vitae massa posuere, at placerat mauris sodales. Nulla efficitur condimentum ultricies. Proin et lectus nec felis accumsan vulputate eu in nisl. Sed dictum elit non odio elementum gravida. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc ut ante sed nisi blandit congue vitae eget elit. Nam finibus sollicitudin metus, eget viverra mauris dapibus at. Curabitur eu maximus augue. Cras blandit eu erat a feugiat. Aenean a eleifend sapien, vel semper ante. Nunc et est orci. Fusce vel sollicitudin risus, ut suscipit ante. Cras fringilla enim tellus, sed pellentesque risus bibendum tempus. In blandit dignissim ex, ut aliquet risus pellentesque quis. Donec tempor risus sit amet lacinia mattis. Aliquam auctor ligula non nisl sollicitudin, ut pharetra libero mollis. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Quisque malesuada lorem auctor nisl auctor maximus. Nunc leo eros, feugiat at hendrerit ut, dapibus at felis. Fusce arcu purus, ornare sed tempor eu, lobortis id nunc. Curabitur facilisis velit mollis risus auctor pulvinar. Sed id neque mollis, dapibus erat id, imperdiet nunc. Proin a turpis dignissim, sagittis orci id, consequat mi. Sed in nulla in leo vestibulum iaculis. Maecenas faucibus, turpis in egestas rutrum, ipsum nulla euismod leo, vel finibus lorem augue non sem. Mauris non lacus dictum, varius nibh eget, sodales tellus. Integer laoreet feugiat accumsan. Vestibulum sit amet erat diam. Etiam accumsan quam nunc, eget pulvinar mi dapibus ac. Donec non feugiat neque. Donec ullamcorper, ex sed vulputate semper, libero lorem vestibulum nisi, ac placerat sem odio ac arcu. Fusce vitae nunc sit amet sapien placerat pretium non at magna. Morbi sapien lectus, aliquet sed risus eget, blandit accumsan ante. Morbi tempus est est, quis ultricies turpis porta sit amet. Vivamus gravida fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut eros ut urna malesuada tincidunt. Fusce elementum nibh vitae massa posuere, at placerat mauris sodales. Nulla efficitur condimentum ultricies. Proin et lectus nec felis accumsan vulputate eu in nisl. Sed dictum elit non odio elementum gravida. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc ut ante sed nisi blandit congue vitae eget elit. Nam finibus sollicitudin metus, eget viverra mauris dapibus at. Curabitur eu maximus augue. Cras blandit eu erat a feugiat. Aenean a eleifend sapien, vel semper ante. Nunc et est orci. Morbi rhoncus odio ac condimentum viverra. Quisque sollicitudin mauris ut eros luctus, ac ornare elit ultricies. Nunc ipsum risus, finibus at neque at, molestie cursus nunc. Etiam in malesuada metus, eleifend pellentesque arcu. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Duis lobortis congue risus, sit amet scelerisque libero faucibus laoreet. In ac vestibulum quam, dignissim sodales erat. Aenean volutpat aliquet dolor. Vestibulum lacinia dapibus scelerisque. Pellentesque mi massa, ultrices eget diam nec, faucibus egestas tellus. Aliquam sit amet lacinia lorem. Praesent nec ligula nibh. Vestibulum interdum nulla rutrum magna tincidunt, vel vestibulum diam vehicula. Ut in purus ligula. Mauris nec commodo diam, vehicula suscipit augue. Maecenas leo nulla, mattis vel lectus vitae, finibus tempus leo. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Vestibulum ut ipsum non risus vulputate ultrices vel quis velit. Morbi sed ultrices libero, nec fringilla diam. Aenean tempor quam nulla, nec tincidunt urna gravida venenatis. Fusce vel sollicitudin risus, ut suscipit ante. Cras fringilla enim tellus, sed pellentesque risus bibendum tempus. In blandit dignissim ex, ut aliquet risus pellentesque quis. Donec tempor risus sit amet lacinia mattis. Aliquam auctor ligula non nisl sollicitudin, ut pharetra libero mollis. Quisque malesuada lorem auctor nisl auctor maximus. Nunc leo eros, feugiat at hendrerit ut, dapibus at felis. Fusce arcu purus, ornare sed tempor eu, lobortis id nunc. Curabitur facilisis velit mollis risus auctor pulvinar. Sed id neque mollis, dapibus erat id, imperdiet nunc. Proin a turpis dignissim, sagittis orci id, consequat mi. Sed in nulla in leo vestibulum iaculis. Maecenas faucibus, turpis in egestas rutrum, ipsum nulla euismod leo, vel finibus lorem augue non sem. Morbi rhoncus odio ac condimentum viverra. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Quisque sollicitudin mauris ut eros luctus, ac ornare elit ultricies. Nunc ipsum risus, finibus at neque at, molestie cursus nunc. Etiam in malesuada metus, eleifend pellentesque arcu. Duis lobortis congue risus, sit amet scelerisque libero faucibus laoreet. In ac vestibulum quam, dignissim sodales erat. Aenean volutpat aliquet dolor. Vestibulum lacinia dapibus scelerisque. Pellentesque mi massa, ultrices eget diam nec, faucibus egestas tellus. Aliquam sit amet lacinia lorem. Praesent nec ligula nibh. Vestibulum interdum nulla rutrum magna tincidunt, vel vestibulum diam vehicula. Ut in purus ligula. Mauris nec commodo diam, vehicula suscipit augue. Maecenas leo nulla, mattis vel lectus vitae, finibus tempus leo. Vestibulum ut ipsum non risus vulputate ultrices vel quis velit. Morbi sed ultrices libero, nec fringilla diam. Aenean tempor quam nulla, nec tincidunt urna gravida venenatis. Mauris non lacus dictum, varius nibh eget, sodales tellus. Integer laoreet feugiat accumsan. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Vestibulum sit amet erat diam. Etiam accumsan quam nunc, eget pulvinar mi dapibus ac. Donec non feugiat neque. Donec ullamcorper, ex sed vulputate semper, libero lorem vestibulum nisi, ac placerat sem odio ac arcu. Fusce vitae nunc sit amet sapien placerat pretium non at magna. Morbi sapien lectus, aliquet sed risus eget, blandit accumsan ante. Morbi tempus est est, quis ultricies turpis porta sit amet. Vivamus gravida fringilla interdum.</span></p>', '2018-07-23 12:00:10'),
(2, 1, 'Jour 2', '<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut eros ut urna malesuada tincidunt. Fusce elementum nibh vitae massa posuere, at placerat mauris sodales. Nulla efficitur condimentum ultricies. Proin et lectus nec felis accumsan vulputate eu in nisl. Sed dictum elit non odio elementum gravida. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc ut ante sed nisi blandit congue vitae eget elit. Nam finibus sollicitudin metus, eget viverra mauris dapibus at. Curabitur eu maximus augue. Cras blandit eu erat a feugiat. Aenean a eleifend sapien, vel semper ante. Nunc et est orci. Fusce vel sollicitudin risus, ut suscipit ante. Cras fringilla enim tellus, sed pellentesque risus bibendum tempus. In blandit dignissim ex, ut aliquet risus pellentesque quis. Donec tempor risus sit amet lacinia mattis. Aliquam auctor ligula non nisl sollicitudin, ut pharetra libero mollis. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Quisque malesuada lorem auctor nisl auctor maximus. Nunc leo eros, feugiat at hendrerit ut, dapibus at felis. Fusce arcu purus, ornare sed tempor eu, lobortis id nunc. Curabitur facilisis velit mollis risus auctor pulvinar. Sed id neque mollis, dapibus erat id, imperdiet nunc. Proin a turpis dignissim, sagittis orci id, consequat mi. Sed in nulla in leo vestibulum iaculis. Maecenas faucibus, turpis in egestas rutrum, ipsum nulla euismod leo, vel finibus lorem augue non sem. Mauris non lacus dictum, varius nibh eget, sodales tellus. Integer laoreet feugiat accumsan. Vestibulum sit amet erat diam. Etiam accumsan quam nunc, eget pulvinar mi dapibus ac. Donec non feugiat neque. Donec ullamcorper, ex sed vulputate semper, libero lorem vestibulum nisi, ac placerat sem odio ac arcu. Fusce vitae nunc sit amet sapien placerat pretium non at magna. Morbi sapien lectus, aliquet sed risus eget, blandit accumsan ante. Morbi tempus est est, quis ultricies turpis porta sit amet. Vivamus gravida fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut eros ut urna malesuada tincidunt. Fusce elementum nibh vitae massa posuere, at placerat mauris sodales. Nulla efficitur condimentum ultricies. Proin et lectus nec felis accumsan vulputate eu in nisl. Sed dictum elit non odio elementum gravida. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc ut ante sed nisi blandit congue vitae eget elit. Nam finibus sollicitudin metus, eget viverra mauris dapibus at. Curabitur eu maximus augue. Cras blandit eu erat a feugiat. Aenean a eleifend sapien, vel semper ante. Nunc et est orci. Morbi rhoncus odio ac condimentum viverra. Quisque sollicitudin mauris ut eros luctus, ac ornare elit ultricies. Nunc ipsum risus, finibus at neque at, molestie cursus nunc. Etiam in malesuada metus, eleifend pellentesque arcu. Duis lobortis congue risus, sit amet scelerisque libero faucibus laoreet. In ac vestibulum quam, dignissim sodales erat. Aenean volutpat aliquet dolor. Vestibulum lacinia dapibus scelerisque. Pellentesque mi massa, ultrices eget diam nec, faucibus egestas tellus. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Aliquam sit amet lacinia lorem. Praesent nec ligula nibh. Vestibulum interdum nulla rutrum magna tincidunt, vel vestibulum diam vehicula. Ut in purus ligula. Mauris nec commodo diam, vehicula suscipit augue. Maecenas leo nulla, mattis vel lectus vitae, finibus tempus leo. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Vestibulum ut ipsum non risus vulputate ultrices vel quis velit. Morbi sed ultrices libero, nec fringilla diam. Aenean tempor quam nulla, nec tincidunt urna gravida venenatis. Fusce vel sollicitudin risus, ut suscipit ante. Cras fringilla enim tellus, sed pellentesque risus bibendum tempus. In blandit dignissim ex, ut aliquet risus pellentesque quis. Donec tempor risus sit amet lacinia mattis. Aliquam auctor ligula non nisl sollicitudin, ut pharetra libero mollis. Quisque malesuada lorem auctor nisl auctor maximus. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Nunc leo eros, feugiat at hendrerit ut, dapibus at felis. Fusce arcu purus, ornare sed tempor eu, lobortis id nunc. Curabitur facilisis velit mollis risus auctor pulvinar. Sed id neque mollis, dapibus erat id, imperdiet nunc. Proin a turpis dignissim, sagittis orci id, consequat mi. Sed in nulla in leo vestibulum iaculis. Maecenas faucibus, turpis in egestas rutrum, ipsum nulla euismod leo, vel finibus lorem augue non sem. Morbi rhoncus odio ac condimentum viverra. Quisque sollicitudin mauris ut eros luctus, ac ornare elit ultricies. Nunc ipsum risus, finibus at neque at, molestie cursus nunc. Etiam in malesuada metus, eleifend pellentesque arcu. Duis lobortis congue risus, sit amet scelerisque libero faucibus laoreet. In ac vestibulum quam, dignissim sodales erat. Aenean volutpat aliquet dolor. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Vestibulum lacinia dapibus scelerisque. Pellentesque mi massa, ultrices eget diam nec, faucibus egestas tellus. Aliquam sit amet lacinia lorem. Praesent nec ligula nibh. Vestibulum interdum nulla rutrum magna tincidunt, vel vestibulum diam vehicula. Ut in purus ligula. Mauris nec commodo diam, vehicula suscipit augue. Maecenas leo nulla, mattis vel lectus vitae, finibus tempus leo. Vestibulum ut ipsum non risus vulputate ultrices vel quis velit. Morbi sed ultrices libero, nec fringilla diam. Aenean tempor quam nulla, nec tincidunt urna gravida venenatis. Mauris non lacus dictum, varius nibh eget, sodales tellus. Integer laoreet feugiat accumsan. Vestibulum sit amet erat diam. Etiam accumsan quam nunc, eget pulvinar mi dapibus ac. Donec non feugiat neque. Donec ullamcorper, ex sed vulputate semper, libero lorem vestibulum nisi, ac placerat sem odio ac arcu. Fusce vitae nunc sit amet sapien placerat pretium non at magna. Morbi sapien lectus, aliquet sed risus eget, blandit accumsan ante. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Morbi tempus est est, quis ultricies turpis porta sit amet. Vivamus gravida fringilla interdum.</span></p>', '2018-07-23 12:03:22'),
(3, 1, 'Jour 3', '<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut eros ut urna malesuada tincidunt. Fusce elementum nibh vitae massa posuere, at placerat mauris sodales. Nulla efficitur condimentum ultricies. Proin et lectus nec felis accumsan vulputate eu in nisl. Sed dictum elit non odio elementum gravida. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc ut ante sed nisi blandit congue vitae eget elit. Nam finibus sollicitudin metus, eget viverra mauris dapibus at. Curabitur eu maximus augue. Cras blandit eu erat a feugiat. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Aenean a eleifend sapien, vel semper ante. Nunc et est orci. Fusce vel sollicitudin risus, ut suscipit ante. Cras fringilla enim tellus, sed pellentesque risus bibendum tempus. In blandit dignissim ex, ut aliquet risus pellentesque quis. Donec tempor risus sit amet lacinia mattis. Aliquam auctor ligula non nisl sollicitudin, ut pharetra libero mollis. Quisque malesuada lorem auctor nisl auctor maximus. Nunc leo eros, feugiat at hendrerit ut, dapibus at felis. Fusce arcu purus, ornare sed tempor eu, lobortis id nunc. Curabitur facilisis velit mollis risus auctor pulvinar. Sed id neque mollis, dapibus erat id, imperdiet nunc. Proin a turpis dignissim, sagittis orci id, consequat mi. Sed in nulla in leo vestibulum iaculis. Maecenas faucibus, turpis in egestas rutrum, ipsum nulla euismod leo, vel finibus lorem augue non sem. Morbi rhoncus odio ac condimentum viverra. Quisque sollicitudin mauris ut eros luctus, ac ornare elit ultricies. Nunc ipsum risus, finibus at neque at, molestie cursus nunc. Etiam in malesuada metus, eleifend pellentesque arcu. Duis lobortis congue risus, sit amet scelerisque libero faucibus laoreet. In ac vestibulum quam, dignissim sodales erat. Aenean volutpat aliquet dolor. Vestibulum lacinia dapibus scelerisque. Pellentesque mi massa, ultrices eget diam nec, faucibus egestas tellus. Aliquam sit amet lacinia lorem. Praesent nec ligula nibh. Mauris non lacus dictum, varius nibh eget, sodales tellus. Integer laoreet feugiat accumsan. Vestibulum sit amet erat diam. Etiam accumsan quam nunc, eget pulvinar mi dapibus ac. Donec non feugiat neque. Donec ullamcorper, ex sed vulputate semper, libero lorem vestibulum nisi, ac placerat sem odio ac arcu. Fusce vitae nunc sit amet sapien placerat pretium non at magna. Morbi sapien lectus, aliquet sed risus eget, blandit accumsan ante. Morbi tempus est est, quis ultricies turpis porta sit amet. Vivamus gravida fringilla interdum. Vestibulum interdum nulla rutrum magna tincidunt, vel vestibulum diam vehicula. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Ut in purus ligula. Mauris nec commodo diam, vehicula suscipit augue. Maecenas leo nulla, mattis vel lectus vitae, finibus tempus leo. Vestibulum ut ipsum non risus vulputate ultrices vel quis velit. Morbi sed ultrices libero, nec fringilla diam. Aenean tempor quam nulla, nec tincidunt urna gravida venenatis. Mauris non lacus dictum, varius nibh eget, sodales tellus. Integer laoreet feugiat accumsan. Vestibulum sit amet erat diam. Etiam accumsan quam nunc, eget pulvinar mi dapibus ac. Donec non feugiat neque. Donec ullamcorper, ex sed vulputate semper, libero lorem vestibulum nisi, ac placerat sem odio ac arcu. Fusce vitae nunc sit amet sapien placerat pretium non at magna. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Morbi sapien lectus, aliquet sed risus eget, blandit accumsan ante. Morbi tempus est est, quis ultricies turpis porta sit amet. Vivamus gravida fringilla interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ut eros ut urna malesuada tincidunt. Fusce elementum nibh vitae massa posuere, at placerat mauris sodales. Nulla efficitur condimentum ultricies. Proin et lectus nec felis accumsan vulputate eu in nisl. Sed dictum elit non odio elementum gravida. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc ut ante sed nisi blandit congue vitae eget elit. Nam finibus sollicitudin metus, eget viverra mauris dapibus at. Curabitur eu maximus augue. Cras blandit eu erat a feugiat. Aenean a eleifend sapien, vel semper ante. Nunc et est orci. Fusce vel sollicitudin risus, ut suscipit ante. Cras fringilla enim tellus, sed pellentesque risus bibendum tempus. In blandit dignissim ex, ut aliquet risus pellentesque quis. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Donec tempor risus sit amet lacinia mattis. Aliquam auctor ligula non nisl sollicitudin, ut pharetra libero mollis. Quisque malesuada lorem auctor nisl auctor maximus. Nunc leo eros, feugiat at hendrerit ut, dapibus at felis. Fusce arcu purus, ornare sed tempor eu, lobortis id nunc. Curabitur facilisis velit mollis risus auctor pulvinar. Sed id neque mollis, dapibus erat id, imperdiet nunc. </span></p>\r\n<p><span style=\"font-family: \'Times New Roman\'; font-size: medium;\">Proin a turpis dignissim, sagittis orci id, consequat mi. Sed in nulla in leo vestibulum iaculis. Maecenas faucibus, turpis in egestas rutrum, ipsum nulla euismod leo, vel finibus lorem augue non sem. Morbi rhoncus odio ac condimentum viverra. Quisque sollicitudin mauris ut eros luctus, ac ornare elit ultricies. Nunc ipsum risus, finibus at neque at, molestie cursus nunc. Etiam in malesuada metus, eleifend pellentesque arcu. Duis lobortis congue risus, sit amet scelerisque libero faucibus laoreet. In ac vestibulum quam, dignissim sodales erat. Aenean volutpat aliquet dolor. Vestibulum lacinia dapibus scelerisque. Pellentesque mi massa, ultrices eget diam nec, faucibus egestas tellus. Aliquam sit amet lacinia lorem. Praesent nec ligula nibh. Vestibulum interdum nulla rutrum magna tincidunt, vel vestibulum diam vehicula. Ut in purus ligula. Mauris nec commodo diam, vehicula suscipit augue. Maecenas leo nulla, mattis vel lectus vitae, finibus tempus leo. Vestibulum ut ipsum non risus vulputate ultrices vel quis velit. Morbi sed ultrices libero, nec fringilla diam. Aenean tempor quam nulla, nec tincidunt urna gravida venenatis.</span></p>', '2018-07-23 12:04:12');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `permission`, `password`) VALUES
(1, 'Jean', 1, '$2y$10$fxob5vSRLhRp5cy6.pfqJuk7Ke.TZePrufAqle8zc9TRc9dP8by/K'),
(2, 'Administrateur', 1, '$2y$10$9.cpLPBaCg3f3ZQvX9.CLOpAl4qsfuvcVV7b0crCxpqdM9HOWVMqS'),
(3, 'Modérateur', 2, '$2y$10$pvLmpkDXNBkrzjthINtzoug4uRq8BKIZHA5Mk25OsCNlWGibTl7Qm'),
(4, 'Invité', 3, '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `deleteComments` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `DeleteAllAssociatePostsWhenBookDelete` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
