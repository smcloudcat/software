-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:3306
-- 生成日期： 2024-05-23 21:25:14
-- 服务器版本： 5.7.38-log
-- PHP 版本： 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `site_info`
--

CREATE TABLE `site_info` (
  `id` int(11) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `site_description` text,
  `site_keywords` varchar(255) DEFAULT NULL,
  `site_announcement` text,
  `footer_content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `site_info`
--

INSERT INTO `site_info` (`id`, `site_name`, `site_description`, `site_keywords`, `site_announcement`, `footer_content`) VALUES
(1, '小猫咪软件库', '小猫咪软件库，分享实用软件', '小猫咪软件库', '公告', '© 2024 YUNCAT. All rights reserved.');

-- --------------------------------------------------------

--
-- 表的结构 `software`
--

CREATE TABLE `software` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  `details` text,
  `concise` text,
  `update_info` text,
  `file_path` varchar(255) DEFAULT NULL,
  `icon_path` varchar(255) DEFAULT NULL,
  `download_count` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `software_images`
--

CREATE TABLE `software_images` (
  `id` int(11) NOT NULL,
  `software_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$HBQ4VPdS9NFxCpgE/czpZeBOdg9pciifa8cqEZ0G2D8ql4J3XNd16');

--
-- 转储表的索引
--

--
-- 表的索引 `site_info`
--
ALTER TABLE `site_info`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `software_images`
--
ALTER TABLE `software_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `software_id` (`software_id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `site_info`
--
ALTER TABLE `site_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `software`
--
ALTER TABLE `software`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `software_images`
--
ALTER TABLE `software_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 限制导出的表
--

--
-- 限制表 `software_images`
--
ALTER TABLE `software_images`
  ADD CONSTRAINT `software_images_ibfk_1` FOREIGN KEY (`software_id`) REFERENCES `software` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
