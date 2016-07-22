-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2016 at 10:48 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testna`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`category_id` int(11) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `parent_id`) VALUES
(1, 'Vijesti', 0),
(2, 'Crna hronika', 0),
(3, 'Svijet', 0),
(4, 'Ekonomija', 0),
(5, 'Kultura', 0),
(6, 'Sport', 0),
(7, 'Zanimljivosti', 0),
(8, 'Zdravlje i ljepota', 0),
(9, 'Showbiz', 0),
(10, 'Ostalo', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`comment_id` int(50) NOT NULL,
  `post_id` int(50) NOT NULL,
  `comment_time` date NOT NULL,
  `comment_body` text NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`message_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `recipient_user_id` int(50) NOT NULL,
  `message_title` varchar(200) NOT NULL,
  `message_time` date NOT NULL,
  `message_body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `post_name` varchar(255) NOT NULL,
  `post_time` date NOT NULL,
  `post_topic` varchar(255) NOT NULL,
  `post_body` text NOT NULL,
  `post_image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_name`, `post_time`, `post_topic`, `post_body`, `post_image`) VALUES
(40, 67, 'Why do we use it?', '2016-07-21', 'Why do we use it?', '<p><span style="font-family:Georgia,serif">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non magna lorem. Proin semper, magna at lacinia viverra, velit velit hendrerit nibh, ut volutpat tellus orci in eros. Aenean augue risus, gravida ac molestie in, venenatis vitae ipsum. Etiam augue mi, lobortis in cursus sed, laoreet a felis. Phasellus malesuada, ligula nec laoreet viverra, tortor est pulvinar risus, quis vulputate ante magna a neque. Cras consequat elit nec lectus molestie dignissim eu et est. Sed rutrum elementum metus, nec tincidunt tortor sodales vel. Vestibulum quis mi nec enim tincidunt gravida et vel leo. Donec euismod mi et ex scelerisque, quis iaculis dui imperdiet. Duis sodales gravida aliquam. Cras tempor sodales pretium. Nullam eu semper mi. Mauris sagittis blandit risus, eu blandit sem ullamcorper ac.</span></p>\r\n\r\n<p><span style="font-family:Georgia,serif">Aenean lacinia elit ut elit placerat auctor. Suspendisse finibus elit sapien, et sagittis lectus porttitor eu. Vestibulum vulputate ornare augue non commodo. Nam libero sapien, accumsan et viverra id, vestibulum vel libero. Vivamus sit amet tempor mi. Morbi vulputate vitae sem non lobortis. In hac habitasse platea dictumst. Praesent non arcu id lacus auctor dapibus eget ac neque. Pellentesque feugiat fermentum lectus, efficitur bibendum augue ornare non. Duis porttitor varius quam ac sagittis.</span></p>\r\n\r\n<p><span style="font-family:Georgia,serif">Integer placerat a diam eu consectetur. Proin efficitur lacinia ullamcorper. Phasellus ullamcorper posuere ligula. Vivamus elementum lectus eget rhoncus pulvinar. Aliquam quis pharetra ante, id interdum risus. Sed fringilla, velit eu blandit scelerisque, orci tortor commodo erat, quis sagittis massa diam aliquam massa. Donec aliquam tempus libero, id efficitur purus volutpat nec.</span></p>\r\n\r\n<p><span style="font-family:Georgia,serif">Proin nec mattis sem. Suspendisse malesuada efficitur mollis. Duis ac ex quis ipsum efficitur vulputate non in turpis. Phasellus faucibus, nibh vel fringilla hendrerit, eros ex vehicula urna, vitae placerat tortor felis id velit. Donec interdum felis sit amet porta posuere. Phasellus enim sapien, posuere id placerat eget, mattis sit amet nunc. Nunc dignissim lorem a tincidunt congue. Vestibulum placerat sed odio non feugiat. Ut ipsum diam, posuere sit amet feugiat eget, fringilla at ante. Nunc eu orci eget dui ornare tincidunt. Etiam tincidunt commodo dignissim. Sed eleifend arcu sed imperdiet lacinia.</span></p>\r\n\r\n<p><span style="font-family:Georgia,serif">Donec imperdiet ut ex non semper. Suspendisse a consequat lacus. Nulla a feugiat nisl, eu ultricies lacus. Nulla sit amet elit mauris. Quisque suscipit ullamcorper fringilla. Phasellus dapibus gravida leo sed porta. Donec molestie purus a elementum gravida.</span></p>\r\n\r\n<p><span style="font-family:Georgia,serif">Cras auctor maximus augue lacinia ultrices. Proin interdum odio non iaculis sollicitudin. Aenean tincidunt vestibulum quam, ac aliquet enim feugiat quis. Duis sed felis vitae orci placerat vestibulum sed in quam. Suspendisse rutrum suscipit mauris, nec ultrices turpis. Duis nec ante posuere, dictum elit eu, faucibus augue. Integer ligula felis, hendrerit in suscipit tempus, posuere et sapien. Phasellus maximus lacus sed arcu dictum, eu eleifend sapien hendrerit. Vestibulum elementum felis et nisi cursus fermentum eu eu lorem. In sit amet elit eu ligula sollicitudin dictum. Maecenas vel orci libero. Curabitur pellentesque est et nisl pulvinar faucibus. Etiam sit amet rutrum ante, sit amet venenatis mi. Duis consequat tristique ipsum.</span></p>\r\n\r\n<p><span style="font-family:Georgia,serif">Nunc vel iaculis lorem, id semper risus. Curabitur tristique nulla nunc, sit amet condimentum magna pharetra at. Pellentesque fermentum imperdiet magna, a lobortis lacus finibus a. Morbi ut elit sapien. Suspendisse potenti. Sed lacinia dolor vel nisi fermentum congue. Vestibulum gravida nulla vel nisl maximus, vel aliquet enim fringilla. Quisque rhoncus molestie ante placerat varius. Mauris sit amet cursus nisi. Sed sagittis in elit nec ultrices. Aenean mattis quis nulla non porttitor. Fusce tincidunt quis tortor sed congue. Etiam et faucibus augue. Cras lobortis laoreet risus. Maecenas sagittis velit sed cursus lobortis.</span></p>\r\n', 'images/batman.jpg'),
(41, 67, 'What is Lorem Ipsum?', '2016-07-22', 'What is Lorem Ipsum?', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam venenatis lorem non dui fermentum maximus. Nullam et eros elementum, volutpat felis vel, porttitor diam. Quisque eu lorem ornare, dictum tortor eu, molestie nisi. Phasellus sed rhoncus augue. Ut sed posuere sapien, ac rhoncus urna. Phasellus sed semper massa. Integer faucibus libero vitae velit condimentum faucibus.</p>\r\n\r\n<p>Nulla auctor volutpat velit, sed vulputate leo. Aenean venenatis nunc risus, in suscipit dui pulvinar sit amet. Pellentesque ut nunc est. Sed sit amet neque vel leo mollis viverra. Nam nunc libero, ornare et dignissim ut, varius in purus. Vestibulum dolor nibh, suscipit nec volutpat a, accumsan in metus. Donec aliquet dui porttitor, feugiat velit id, hendrerit urna. Sed posuere, neque sed fermentum venenatis, nisl justo sagittis purus, ut tincidunt ex metus sed lacus. Mauris euismod placerat suscipit. Vestibulum erat tortor, pharetra vitae sodales eget, sagittis ac turpis. Etiam lacinia tellus est, quis sollicitudin ex varius eget. Vivamus elementum est quis lorem laoreet, sed vulputate sapien faucibus. Phasellus ut sem rutrum, venenatis lectus in, lobortis nunc. Vestibulum scelerisque eros risus, sed porttitor mi blandit in. Vivamus id ligula quis tellus elementum tempus. Vestibulum pellentesque tellus a dui finibus, vitae fringilla ligula bibendum.</p>\r\n\r\n<p>Morbi ornare ipsum diam, vel ullamcorper ante tempus id. Praesent imperdiet vehicula semper. Aenean faucibus dolor sit amet metus commodo, at commodo lectus feugiat. Nam in sapien lacinia, tincidunt leo vel, viverra velit. Sed enim nibh, laoreet quis vulputate vel, porttitor et augue. Proin id nibh sodales, suscipit enim ac, mattis nunc. Mauris dictum dolor non gravida volutpat. Nulla ante diam, maximus eget orci non, aliquam mollis nisi.</p>\r\n\r\n<p>Vestibulum posuere, orci in semper facilisis, nunc erat pharetra nisl, ac molestie elit arcu ut neque. Praesent commodo tellus ante, ut finibus erat dictum et. Etiam egestas sed nulla ut placerat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed nec arcu sodales, posuere orci sed, volutpat turpis. Sed nisl felis, eleifend in lorem vitae, malesuada blandit est. Nullam mollis mi et dapibus elementum. Morbi lectus est, pharetra quis tristique a, tincidunt sit amet nisl. Etiam consectetur eu mauris id bibendum. Morbi quis mi nec urna consectetur feugiat at ac arcu. Proin viverra, arcu sed tempor pharetra, nisl eros congue lacus, ac laoreet sem diam in enim. Pellentesque semper blandit quam, in rutrum leo varius a.</p>\r\n\r\n<p>Nullam consectetur, enim at porttitor vulputate, eros sapien fringilla sapien, eget blandit ipsum neque vel ante. Duis ornare velit pellentesque elit finibus, at feugiat mi dapibus. Suspendisse in urna maximus leo porta blandit. Nulla nisi felis, aliquet quis dignissim quis, rutrum nec eros. Fusce sed euismod orci, vitae egestas ligula. Nam interdum magna volutpat diam pretium suscipit. Nam mollis a sapien scelerisque aliquam. Nulla cursus, arcu sit amet vestibulum tempus, purus diam mollis purus, non tempor erat ex quis augue.</p>\r\n\r\n<p>Sed blandit elementum metus et porta. Donec dapibus lacus nec placerat rhoncus. Nam non erat sit amet nisl gravida cursus. Praesent imperdiet a purus vitae tincidunt. Nunc vulputate ac ligula ut semper. Vestibulum suscipit pharetra lacus, quis feugiat enim tincidunt eu. Maecenas sodales purus et velit luctus varius eget a ligula. Mauris fringilla, ex in rhoncus vehicula, ligula leo pretium ex, vitae ornare massa neque ut leo. Nulla pellentesque finibus nisl, sit amet aliquam massa feugiat sit amet. Suspendisse lobortis velit vel dolor molestie, quis ornare risus dignissim. Vivamus condimentum, libero non aliquet hendrerit, mauris tellus posuere magna, pellentesque placerat ex nulla et mauris. Maecenas dui leo, posuere sed enim ac, feugiat sodales turpis. Vivamus fermentum sodales magna, ac sodales enim suscipit at.</p>\r\n\r\n<p>Aliquam erat volutpat. Integer non ex ultrices, iaculis tortor sit amet, pulvinar risus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam quis velit volutpat, convallis nisl id, euismod nisl. Cras eleifend nisl velit, in dictum eros posuere sit amet. Phasellus non vehicula orci. Curabitur eget metus ante. Maecenas mollis eget risus cursus laoreet. Vestibulum laoreet metus libero, vitae pharetra ligula condimentum id.</p>\r\n', 'images/lorem ipsum logo2.jpg'),
(42, 67, 'Where does it come from?', '2016-07-20', 'Where does it come from?', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu blandit lorem. Mauris porta consectetur sem, in aliquam metus gravida vitae. Proin non pharetra ipsum. Mauris et sapien ligula. Fusce odio lorem, facilisis sit amet ligula nec, feugiat placerat risus. Proin ultrices cursus sem, vel tempor augue efficitur at. Etiam ut quam sed magna molestie aliquet ac egestas elit. Sed nec rhoncus ante.</p>\r\n\r\n<p>Integer luctus pulvinar metus, eget dapibus velit semper vitae. Donec vestibulum lectus turpis, quis iaculis sem lacinia nec. Ut at ornare ante. Donec et enim consequat, convallis ipsum eu, dictum augue. Quisque ac vehicula mauris. Aliquam at aliquam velit, nec sollicitudin nisl. Cras posuere, risus vitae tristique tincidunt, dolor dolor accumsan lorem, a dapibus sem sem ut nunc. Aliquam ex est, accumsan eget imperdiet sed, mollis a eros. Sed varius magna justo, quis maximus elit ultricies a.</p>\r\n\r\n<p>Curabitur fringilla leo eu convallis condimentum. Vivamus placerat mi ac odio molestie aliquet. Vivamus sit amet sodales turpis. Etiam porta nisl odio, id lacinia enim egestas eu. Duis felis quam, molestie sit amet risus varius, aliquet elementum risus. Pellentesque venenatis libero luctus, imperdiet mauris sit amet, pellentesque dolor. Nunc dignissim pulvinar eros, condimentum porttitor mi porttitor vel. Curabitur placerat semper dui, eu pharetra ipsum pretium ac. Nunc porta turpis at leo tincidunt, nec vulputate nisl auctor. Nullam fermentum nibh blandit, congue nisi at, dapibus ipsum. Nullam non est a nisl rhoncus elementum.</p>\r\n\r\n<p>Ut viverra sagittis lacus, sit amet malesuada ipsum elementum sit amet. Ut ut cursus nibh. Vestibulum nulla sapien, eleifend non justo id, cursus feugiat lacus. Proin congue dui ante, non ultricies nisi tincidunt eu. Nulla vitae interdum eros. Pellentesque eu congue nisl. Nulla facilisi. Vestibulum tempor commodo magna bibendum sagittis.</p>\r\n', 'images/batman.jpg'),
(43, 67, 'Where can I get some?', '2016-07-21', 'Where can I get some?', '<p>Nunc in aliquam tortor. Pellentesque id eros dapibus, feugiat orci tristique, lacinia tellus. Quisque venenatis, dui eget pharetra semper, massa justo scelerisque felis, at malesuada ligula purus at nibh. Sed consequat sem vel ex ullamcorper luctus. Sed scelerisque eu dolor a bibendum. Ut tortor augue, rhoncus sit amet elit sit amet, vestibulum luctus ante. Cras ut vestibulum leo, sit amet pulvinar nulla. Maecenas vel tortor sollicitudin, consectetur quam in, dapibus libero. Aliquam pretium mattis lorem, at maximus velit tempor in. Etiam ornare vehicula augue vitae consequat. Nam ultrices ac ligula iaculis ultrices. Curabitur vulputate quam libero, non fringilla ex eleifend sed. Sed sagittis feugiat libero eu efficitur.</p>\r\n\r\n<p>Maecenas rhoncus eget dui eu vehicula. In justo lectus, ultricies nec pretium et, luctus a dui. Sed sollicitudin consequat nisl eu vestibulum. Aenean pulvinar est ut dignissim rhoncus. Aenean eget nisi pulvinar, porttitor mauris eu, porttitor arcu. Nullam in libero urna. Fusce pellentesque risus quis sem porta malesuada. Sed laoreet purus sit amet dignissim malesuada. Nullam accumsan nibh in mattis interdum. Phasellus porttitor dui quis ante efficitur consequat. Mauris aliquam, velit quis fringilla dignissim, dolor odio porta leo, vehicula pretium nulla neque id orci. Integer at massa erat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent turpis magna, condimentum quis congue vitae, bibendum nec dui. Curabitur sit amet commodo ante, rhoncus feugiat nibh. Cras in leo in ligula cursus sollicitudin tempus sit amet mauris.</p>\r\n\r\n<p>Proin iaculis hendrerit venenatis. Cras et egestas risus, vel aliquet sapien. Suspendisse sed ipsum non justo mollis aliquam in non metus. Sed et ultrices risus. Morbi semper ipsum vitae mi malesuada hendrerit. Proin facilisis cursus turpis, ac placerat felis lobortis et. Etiam mi justo, eleifend vitae sodales sed, facilisis non quam. Vestibulum sed pretium lectus, non hendrerit mi. Pellentesque non faucibus nunc. Vestibulum pretium massa magna, sed iaculis nisi iaculis non. Duis in diam luctus, tristique ante ut, varius sapien. Pellentesque arcu nisl, malesuada vel sem ac, imperdiet ornare nisl. Nam pellentesque lectus ut felis sagittis sagittis. Maecenas mollis egestas gravida. Nam sed sem vestibulum, varius felis in, semper arcu.</p>\r\n', 'images/cicero_gradient.png');

-- --------------------------------------------------------

--
-- Table structure for table `posts_has_categories`
--

CREATE TABLE IF NOT EXISTS `posts_has_categories` (
  `post_id` int(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts_has_categories`
--

INSERT INTO `posts_has_categories` (`post_id`, `category_id`) VALUES
(40, 1),
(42, 1),
(40, 2),
(42, 2),
(40, 3),
(41, 3),
(42, 3),
(43, 3),
(41, 4),
(42, 4),
(43, 4),
(43, 5),
(40, 6),
(42, 6),
(43, 6),
(42, 7),
(41, 9),
(42, 9),
(43, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_registration_time` date NOT NULL,
  `user_country` varchar(255) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_date_of_birth` date NOT NULL,
  `user_type` enum('ADMIN','USER') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_registration_time`, `user_country`, `user_city`, `user_date_of_birth`, `user_type`) VALUES
(67, 'Dejan', '$2y$10$jlUL3AR9QKxhtWJ7NoPWQ.73tWP1qNSW92NsI2XJo1/MK28bOVMUy', '123@gmail.com', '2016-07-18', 'Bosna i Hercegovina', 'Banja Luka', '2016-07-03', 'ADMIN'),
(68, 'Marko', '$2y$10$eVeiVsTA.i2GFYolZc37J.COTDMK31RfW3l3vocjf2mYVKxJSeJuO', '123@gmail.com', '2016-07-19', 'Bosna i Hercegovina', 'Banja Luka', '2016-07-10', 'USER'),
(75, '222', '$2y$10$IfBReiZO8BVEwqK5MDbSh.//q81xWrnpbNQi7Sixe/8V8p0wKTcnm', '123@gmail.com', '2016-07-19', 'Bosna i Hercegovina', 'Banja Luka', '2016-07-01', 'USER'),
(76, 'Maja', '$2y$10$MPdl4gWJQJhwCr0141TWe.iIH2uJYsKmqv/pHySKJPZcg0SZrFJoC', '123@gmail.com', '2016-07-20', 'Bosna i Hercegovina', 'Banja Luka', '2016-07-14', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE IF NOT EXISTS `visits` (
  `visit` int(11) DEFAULT NULL,
  `visit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`visit`, `visit_id`) VALUES
(64, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`comment_id`), ADD KEY `fk_comments_users1_idx` (`user_id`), ADD KEY `fk_comment_posts_post_id` (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`message_id`), ADD KEY `FK_messages_users` (`user_id`), ADD KEY `FK_messages_users_2` (`recipient_user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`), ADD KEY `fk_users_user_id` (`user_id`);

--
-- Indexes for table `posts_has_categories`
--
ALTER TABLE `posts_has_categories`
 ADD PRIMARY KEY (`post_id`,`category_id`), ADD KEY `fk_posts_has_categories_categories1_idx` (`category_id`), ADD KEY `fk_posts_has_categories_posts1_idx` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `comment_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `message_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `fk_comment_posts_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
ADD CONSTRAINT `FK_messages_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `FK_messages_users_2` FOREIGN KEY (`recipient_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `fk_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `posts_has_categories`
--
ALTER TABLE `posts_has_categories`
ADD CONSTRAINT `fk_posts_has_categories_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_posts_has_categories_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
