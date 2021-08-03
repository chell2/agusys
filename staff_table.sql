-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 7 月 10 日 04:24
-- サーバのバージョン： 10.4.19-MariaDB
-- PHP のバージョン: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `agusys`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `staff_table`
--

CREATE TABLE `staff_table` (
  `id` int(12) NOT NULL,
  `staffname` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` char(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` char(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `staff_table`
--

INSERT INTO `staff_table` (`id`, `staffname`, `password`, `is_admin`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'chell', 'beerbeer11', 1, 0, '2021-07-04 17:10:24', '2021-07-10 10:33:36', '0', 'chell'),
(2, 'charu', '28nouguisu', 0, 0, '2021-07-04 17:13:12', '2021-07-09 06:55:31', '0', ''),
(3, 'cherry', '31024Ki', 0, 0, '2021-07-04 22:34:29', '2021-07-10 11:21:47', '0', 'koitan'),
(8, 'wakame', 'oniichanzurui', 0, 0, '2021-07-08 22:47:31', '2021-07-09 22:50:38', '0', ''),
(9, 'yonnu', '8COLOGY', 1, 0, '2021-07-08 22:53:37', '2021-07-10 10:35:41', '0', 'chell'),
(10, 'koitan', 'kakeh@shi', 1, 0, '2021-07-08 22:55:03', '2021-07-10 11:21:32', '0', 'chell'),
(11, '0001+Mm', 'Alc.4%', 0, 0, '2021-07-10 07:15:18', '2021-07-10 08:01:45', '0', ''),
(12, '557188', 'ukifune//', 0, 0, '2021-07-10 07:58:03', '2021-07-10 09:29:07', '0', 'chell'),
(13, 'CHELL', 'beerbeer11', 0, 0, '2021-07-10 08:01:11', '2021-07-10 08:01:11', '0', ''),
(14, 'BOC', 'fujiwaramotoo!!!', 0, 0, '2021-07-10 08:55:32', '2021-07-10 09:01:44', 'chell', 'yonnu'),
(15, 'accochan', 'teKumaKumayaKon', 0, 0, '2021-07-10 09:28:12', '2021-07-10 09:28:43', 'koitan', 'chell');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `staff_table`
--
ALTER TABLE `staff_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `staff_table`
--
ALTER TABLE `staff_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
