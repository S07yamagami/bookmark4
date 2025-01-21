-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: mysql3104.db.sakura.ne.jp
-- 生成日時: 2025 年 1 月 21 日 23:01
-- サーバのバージョン： 8.0.40
-- PHP のバージョン: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `tealtapir84_gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `data_image`
--

CREATE TABLE `data_image` (
  `id` int NOT NULL,
  `name` varchar(64) NOT NULL,
  `url` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(64) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- テーブルのデータのダンプ `data_image`
--

INSERT INTO `data_image` (`id`, `name`, `url`, `content`, `image`, `date`) VALUES
(1, 'test', 'iii', 'yuyuyuy', 'uploads/dora_4.png', '2025-01-20 21:35:07'),
(3, '大山', 'oooo', 'えええ', 'uploads/dora_5.png', '2025-01-20 22:12:13'),
(4, '陰翳礼讃', 'https://www.aozora.gr.jp/cards/001383/files/56642_59575.html', '好きな本', 'uploads/dora_9.png', '2025-01-20 22:24:07'),
(5, '内海', 'url', 'rrrr', 'uploads/dora_12.png', '2025-01-21 20:48:49'),
(6, '', '', '', '', '2025-01-21 21:11:52'),
(7, 'テスト', 'sshh', 'テスト！', 'uploads/dora18.png', '2025-01-21 22:37:15');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `data_image`
--
ALTER TABLE `data_image`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `data_image`
--
ALTER TABLE `data_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
