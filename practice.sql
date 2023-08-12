-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 8 月 12 日 16:03
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `practice`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `admin_table`
--

CREATE TABLE `admin_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `lid` varchar(128) NOT NULL,
  `lpw` varchar(64) NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `admin_user_table`
--

CREATE TABLE `admin_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `lid` varchar(128) NOT NULL,
  `lpw` varchar(64) NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `admin_user_table`
--

INSERT INTO `admin_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'テスト１管理者', 'test1', 'test1', 1, 0),
(2, 'テスト2一般', 'test2', 'test2', 0, 0),
(3, 'テスト３', 'test3', 'test3', 0, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `client_table`
--

CREATE TABLE `client_table` (
  `id` int(12) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `birthday` date NOT NULL,
  `client_email` varchar(128) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `client_table`
--

INSERT INTO `client_table` (`id`, `nickname`, `password`, `birthday`, `client_email`, `datetime`) VALUES
(1, 'Simone', 'simone', '2020-08-17', 'simone@neco.com', '2023-07-20 19:43:57'),
(3, 'Simon', 'simon', '2014-04-17', 'simon@neco.com', '2023-07-20 20:10:57'),
(4, 'ねこさん', 'neco', '2023-07-01', 'neco@neco.com', '2023-07-21 10:40:03'),
(5, '新しいねこさん', 'new_neco', '2009-02-11', 'new_neco@neco.com', '2023-08-11 19:31:29'),
(6, '新しいねこさん', 'new_neco', '2005-10-10', 'new_neco@neco.com', '2023-08-11 19:31:52');

-- --------------------------------------------------------

--
-- テーブルの構造 `counselor_table`
--

CREATE TABLE `counselor_table` (
  `id` int(12) NOT NULL,
  `organization` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `kana` varchar(64) NOT NULL,
  `certification` varchar(64) NOT NULL,
  `email` varchar(124) NOT NULL,
  `password` varchar(12) NOT NULL,
  `tel` varchar(64) NOT NULL,
  `website` varchar(124) NOT NULL,
  `address` varchar(124) NOT NULL,
  `details` text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `update_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `counselor_table`
--

INSERT INTO `counselor_table` (`id`, `organization`, `name`, `kana`, `certification`, `email`, `password`, `tel`, `website`, `address`, `details`, `file_name`, `file_path`, `date_time`, `update_time`) VALUES
(9, 'Snow Leopard', 'てすと', 'てうと', 'a jrh;ai', 'snowleopard@neco.com', 'snowleopard', '999999', 'www.snowleopard.com', 'アフガニスタン東部、インド北部、ウズベキスタン東部、カザフスタン東部、キルギス、タジキスタン等の標高600～6,000mにある岩場や草原・樹高の低い針葉樹林', ' ネコ科の哺乳類、ユキヒョウ更新テスト ', 'user_update1.png', 'images/20230710125955user_update1.png', '2023-07-18 10:01:48', '2023-07-18 10:01:48'),
(10, 'オセロット', 'Ocelot', 'Ocelot', 'nyan', 'ocelot@neco.com', 'ocelot', '22222222', 'www.ocelot.com', '中南米', 'オセロットは、主に中南米に生息する美しい斑点模様をもつネコ科動物。大きさはイエネコの2倍ほどある。\r\n\r\n', 'user_update3.png', 'images/20230710145909user_update3.png', '2023-07-17 20:50:39', '2023-07-17 20:50:39'),
(11, 'nya-', 'にゃー', 'にゃー', 'nya', 'nya@neco.com', 'nya', '67562562', 'www.nya-.com', 'nya', 'nya\r\n更新しました\r\nもう一度更新\r\n更新三回目', 'user4.png', 'images/20230710153959user4.png', '2023-07-10 22:40:11', '2023-07-17 19:50:49'),
(13, 'チーター', 'ちーたー', 'ちーたー', '走るのが早い', 'cheetah@neco.com', 'cheetah', '00000000', 'www.cheetah.com', 'アフリカ大陸全域', '約3秒で時速0キロから96キロまで加速できるとされ、世界最速の哺乳類', 'user_update2.png', 'images/20230710122907user_update2.png', '2023-07-10 22:43:36', '2023-07-17 19:50:57'),
(15, '長毛もふもふ', 'もふもふ', 'モフモフ', 'かわいい', 'mofu@neco.com', 'mofu', '5555-5555', 'www.mofu.com', '長毛ねこちゃん', '長毛猫さんは、被毛のケアが必要です。摂取するタンパク質の３０％が被毛になります。', 'user_update4.png', 'images/20230711025724user_update4.png', '2023-07-14 08:58:11', '2023-07-17 19:51:08'),
(17, 'manul neco', 'manul neco', 'マヌルネコ', '長毛', 'manul@neco.com', 'manul', '2222-2222', 'www.manulneco.com', 'ヒマラヤ山脈', 'まぬるねこ　更新 最更新', 'manul-neco.png', 'images/20230717124913manul-neco.png', '2023-07-18 10:00:02', '2023-07-18 10:00:02'),
(18, 'kitten', 'kitten', 'kitten', 'かわいい', 'kitten@neco.com', 'kitten', '99999-00000', 'www.kitten.com', 'いろいろな家、NNN', ' “Time spent with cats is never wasted.” — Psychoanalyst Sigmund Freud', 'kitten.png', 'images/20230721024013kitten.png', '2023-07-21 09:41:21', '2023-07-21 09:41:21');

-- --------------------------------------------------------

--
-- テーブルの構造 `history_table`
--

CREATE TABLE `history_table` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `datetime` date NOT NULL,
  `emotion` varchar(128) NOT NULL,
  `scale` int(11) NOT NULL,
  `color` varchar(128) NOT NULL,
  `theme` varchar(128) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `admin_user_table`
--
ALTER TABLE `admin_user_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `client_table`
--
ALTER TABLE `client_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `counselor_table`
--
ALTER TABLE `counselor_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `history_table`
--
ALTER TABLE `history_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `admin_user_table`
--
ALTER TABLE `admin_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `client_table`
--
ALTER TABLE `client_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `counselor_table`
--
ALTER TABLE `counselor_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- テーブルの AUTO_INCREMENT `history_table`
--
ALTER TABLE `history_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `history_table`
--
ALTER TABLE `history_table`
  ADD CONSTRAINT `history_table_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_table` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
