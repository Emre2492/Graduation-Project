-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Haz 2018, 11:34:54
-- Sunucu sürümü: 5.7.14
-- PHP Sürümü: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `uzem2`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `announces`
--

CREATE TABLE `announces` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `content` text COLLATE utf8_turkish_ci NOT NULL,
  `annTo` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `announces`
--

INSERT INTO `announces` (`id`, `title`, `content`, `annTo`, `created`) VALUES
(1, 'hello world', 'demo contenti', 'CS410', '2018-05-14 18:47:16'),
(2, 'this is another one', 'hey this is another text too!', 'CS410', '2018-05-14 18:51:03'),
(3, 'CS ann', 'CS Ann content', 'CS', '2018-05-14 19:37:04'),
(4, 'Another CS Ann', 'Another CS Ann context', 'CS', '2018-05-14 19:41:00'),
(5, 'Lorem ipsum', 'dolor sit amet', 'CS', '2018-05-14 19:41:15'),
(6, 'ENSCI demo', 'ENSCI demo content', 'ENSCI', '2018-05-14 19:45:43'),
(7, 'denemeeeALL', 'Lorem ipsum', 'ALL', '2018-05-26 21:22:14'),
(8, 'Deneme duyuru', '<p>Hello <strong>world</strong></p>\r\n<p><strong>Merhaba</strong> dunya</p>', 'ALL', '2018-05-26 21:49:27'),
(9, 'Merhaba Dunya', '<p>Dekan yaziyor...</p>', 'PLSCI', '2018-05-27 16:05:17'),
(10, 'eco101 deneme duyuru', '<p><strong>eco</strong>101</p>', 'ECO101', '2018-05-29 17:56:27'),
(11, 'Hoşgeldiniz', '<p>Merhaba arkadaslar,</p>\r\n<p>CS519 dersine hosgeldiniz. Bu donem dersleri beraber isleyecegiz. Yararli olmasi dilegi ile.</p>\r\n<p>Derste gorusmek uzere</p>\r\n<p>&nbsp;</p>', 'CS519', '2018-05-29 18:14:48'),
(12, 'a', '<p>a</p>', 'ENSCI2', '2018-05-31 17:12:29'),
(13, 'a', '<p>a</p>', 'ENSCI2', '2018-05-31 18:28:31'),
(14, 'fafdsfsdfdsfdsf', '<p>sdfsdfsdfdsfdsfsf</p>', 'ENSCI2', '2018-05-31 18:29:59'),
(15, 'Ömer', '<p>aşağıdan bekleniyorsunuz&nbsp;</p>\r\n<p>&nbsp;</p>', 'HIS', '2018-06-01 07:47:48'),
(16, 'Ödevi unutmayın', '<p>&Ouml;DEVİ UNUTMAYIN</p>', 'ECO101', '2018-06-01 09:31:41'),
(17, 'dfsdfdssdfsds', '<p>dfsdfdsdfsdf</p>', 'ALL', '2018-06-01 09:38:19');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `rowIndex` int(11) NOT NULL,
  `columnIndex` int(11) NOT NULL,
  `userEmail` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `roomNum` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `appointments`
--

INSERT INTO `appointments` (`id`, `rowIndex`, `columnIndex`, `userEmail`, `roomNum`) VALUES
(2, 0, 0, 'admin@uzemplus.com', 3),
(3, 0, 1, 'admin@uzemplus.com', 3),
(4, 0, 2, 'admin@uzemplus.com', 3),
(5, 0, 3, 'admin@uzemplus.com', 3),
(6, 0, 4, 'admin@uzemplus.com', 3),
(7, 1, 2, 'admin@uzemplus.com', 3),
(8, 2, 2, 'admin@uzemplus.com', 3),
(9, 3, 2, 'admin@uzemplus.com', 3),
(10, 1, 0, 'admin@uzemplus.com', 3),
(11, 2, 0, 'admin@uzemplus.com', 3),
(12, 4, 1, 'admin@uzemplus.com', 3),
(13, 7, 2, 'admin@uzemplus.com', 3),
(14, 0, 0, 'admin@uzemplus.com', 1),
(15, 1, 0, 'admin@uzemplus.com', 1),
(16, 2, 0, 'admin@uzemplus.com', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `content` text COLLATE utf8_turkish_ci NOT NULL,
  `dueDate` date NOT NULL,
  `lecCode` varchar(10) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `assignments`
--

INSERT INTO `assignments` (`id`, `title`, `content`, `dueDate`, `lecCode`) VALUES
(1, 'Hello world in C++', 'you should implement a hello world program in c++ language', '2018-05-16', 'CS410'),
(2, 'hello world in python', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ex leo, fermentum vitae quam non, viverra eleifend mauris. Curabitur commodo, libero ac porttitor semper, nisi dolor efficitur diam, ac pretium tortor tortor et nibh. Quisque rhoncus ex sem, non aliquam metus hendrerit ac. Quisque sapien nulla, efficitur pretium neque ac, suscipit hendrerit nisi. Phasellus eleifend nisl id fringilla hendrerit. Proin sapien elit, ultrices sed lorem non, lobortis vulputate ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ultrices, tortor at finibus ultricies, lacus tellus rutrum sapien, at sodales lorem augue ac odio.\r\n\r\nMorbi egestas, lorem vel lobortis scelerisque, massa lorem convallis neque, vel aliquet arcu augue eget purus. Cras quis mollis nibh. Etiam iaculis enim quis nunc dictum, at lobortis est sagittis. Nullam tempus neque et ante tempus ultricies. Suspendisse lacinia et nisi in hendrerit. Donec finibus non nisi in mattis. Ut lacinia, quam vitae cursus fringilla, quam sapien pharetra sapien, vitae malesuada enim quam quis augue. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean in faucibus nulla, ac placerat urna. Proin tincidunt eu ante vitae pellentesque. Vivamus sagittis cursus urna ac fringilla. Aliquam a sagittis ante, id euismod ex. Duis at ligula odio. Vestibulum faucibus lectus in orci semper condimentum vel facilisis leo. Cras eget malesuada nulla. Fusce lobortis eros mauris, sit amet congue velit dignissim in.\r\n\r\nCurabitur mollis mi in sem dignissim convallis. Integer accumsan varius scelerisque. Aenean at volutpat felis. Proin eros ipsum, feugiat nec tincidunt vitae, tristique ac orci. Donec scelerisque libero quis tellus ultrices congue. Pellentesque vehicula magna at leo egestas aliquet. Duis lobortis molestie porta. Ut ultricies dolor a vulputate egestas. Sed vel venenatis felis. Nam non pellentesque est. Fusce viverra iaculis sagittis. Curabitur at sollicitudin nisl. Etiam lacinia finibus nunc fringilla efficitur. Aenean pellentesque ac tortor ac maximus. Maecenas porttitor augue quam, sit amet cursus diam aliquam vel. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.\r\n\r\nDuis maximus venenatis pellentesque. In sed nunc ipsum. Nam malesuada consectetur mi ultricies ullamcorper. Pellentesque eu purus ut massa ultricies efficitur. Etiam rhoncus, nisl quis sagittis dapibus, felis nulla faucibus nisl, at egestas enim metus at erat. Proin luctus condimentum ex ac aliquam. Nunc neque enim, tincidunt suscipit massa quis, viverra lacinia arcu. Praesent eget nibh ex. Integer lacus tortor, rhoncus sed malesuada a, scelerisque non nunc. Curabitur commodo posuere purus eget auctor. Maecenas ac dui in arcu tempus faucibus. Duis ac neque libero. Cras ultricies eu felis vitae suscipit. Donec sed nisl eleifend est ultrices interdum quis eu nulla.\r\n\r\nPhasellus egestas nulla in gravida facilisis. Nullam egestas dapibus dolor, vitae tempus ante vestibulum vitae. Maecenas imperdiet, massa sed commodo scelerisque, lacus felis feugiat sapien, non consectetur urna libero sit amet ipsum. Nunc eget semper neque. Pellentesque fringilla mauris risus, vel eleifend orci viverra non. Aliquam tincidunt facilisis justo non scelerisque. Fusce et lacinia ante, ut cursus nisl. Morbi congue urna eu tellus molestie, ullamcorper accumsan purus finibus. Pellentesque fringilla rutrum vulputate.', '2018-05-26', 'CS410'),
(3, 'Ilk odev', '<p>Merhaba arkadaslar</p>\r\n\r\n<p>Ilk odeviniz olarak derste size cozdugum orneklerin benzerlerinden 20 soru cozmenizi bekliyorum</p>\r\n\r\n<p>Basarilar</p>', '2018-05-29', 'ECO102'),
(5, 'asdasdadasd', '<p>asasdasdasasdad</p>', '2018-06-03', 'ECO102'),
(6, 'asdadsfasfsfasdfdsfasf', '<p>sdsafsdfdasfsadfsa</p>', '2018-09-12', 'ECO102'),
(7, 'a', '<p>aaaaa</p>', '2018-06-02', 'CS410'),
(8, 'deneme', '<p>DFS , BFS Search araştırınız ve kodlayınız</p>', '2018-06-02', 'CS410'),
(9, 'Deneme500', '<p>dfdslşfdşllk</p>', '2018-06-02', 'ECO101');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `isbn` varchar(13) COLLATE utf8_turkish_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `publisher` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `books`
--

INSERT INTO `books` (`id`, `isbn`, `title`, `author`, `publisher`) VALUES
(1, '9780262033848', 'Introduction to Algorithms, 3rd Edition (MIT Press)', 'Thomas H. Cormen', 'MIT Press'),
(2, '9780321573513', 'Algorithms (4th Edition)', 'Robert Sedgewick', 'Addison-Wesley Professional'),
(3, '9780134694726', 'Core Java SE 9 for the Impatient (2nd Edition)', 'Cay S. Horstmann', 'Addison-Wesley Professional'),
(4, '9780321776419', 'Programming in C (4th Edition) (Developer\'s Library) 2', 'Stephen G. Kochan', 'Addison-Wesley Professional'),
(7, '98998988', 'Deneme kitap', 'deneme yazar', 'deneme yayinci');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `book_rental`
--

CREATE TABLE `book_rental` (
  `bookID` int(11) NOT NULL,
  `userEmail` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `returnDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `book_rental`
--

INSERT INTO `book_rental` (`bookID`, `userEmail`, `returnDate`) VALUES
(2, 'jane@doe.org', '2018-05-31'),
(3, 'admin@uzemplus.com', '2018-04-04'),
(7, 'ebulbul@uzemplus.com', '2018-06-11');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `class_list`
--

CREATE TABLE `class_list` (
  `stuID` int(11) NOT NULL,
  `lecCode` varchar(10) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `class_list`
--

INSERT INTO `class_list` (`stuID`, `lecCode`) VALUES
(20180000, 'CS410'),
(20180000, 'ECO101'),
(20180000, 'ECO102'),
(20180000, 'IC100'),
(20180001, 'IC100'),
(20180008, 'IC100');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `abbr` varchar(5) COLLATE utf8_turkish_ci NOT NULL,
  `chair` int(11) NOT NULL,
  `faculty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `departments`
--

INSERT INTO `departments` (`id`, `title`, `abbr`, `chair`, `faculty`) VALUES
(1, 'Computer Science', 'CS', 3, 1),
(2, 'Economics', 'ECO', 2, 3),
(3, 'Public Finance', 'PUBFI', 1, 3),
(4, 'International Relations', 'INRE2', 2, 3),
(5, 'History', 'HIS', 4, 2),
(6, 'Philosophy', 'PHIL', 2, 2),
(7, 'Psychology', 'PSYC', 2, 2),
(8, 'İç Mimarlık', 'ICM', 11, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `abbr` varchar(6) COLLATE utf8_turkish_ci NOT NULL,
  `dean` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `faculties`
--

INSERT INTO `faculties` (`id`, `title`, `abbr`, `dean`) VALUES
(1, 'Engineering and Natural Sciences2', 'ENSCI2', 3),
(2, 'Faculty of Humanities and Social Sciences', 'SOSCI', 5),
(3, 'Faculty of Political Sciences', 'PLSCI', 1),
(4, 'Mimarlık Fakültesi', 'MIM', 12);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lectures`
--

CREATE TABLE `lectures` (
  `lecCode` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `title` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `professor` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `persentages` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `lectures`
--

INSERT INTO `lectures` (`lecCode`, `title`, `professor`, `department`, `persentages`) VALUES
('CS222', 'Discrete Math', 3, 1, '{"quiz": 10, "final": 50, "attempt": true, "midterm": 40, "project": 0}'),
('CS410', 'Artificial Intelligence', 3, 1, '{"quiz": 10, "final": 50, "attempt": true, "midterm": 40, "project": 0}'),
('CS519', 'Big Data', 5, 1, '{"quiz": 10, "final": 50, "attempt": true, "midterm": 40, "project": 0}'),
('DENM', 'Deneme ders', 1, 1, '{"quiz": 12, "final": 1, "attempt": true, "midterm": 15, "project": 3}'),
('ECO101', 'Ekonomiye Giriş', 2, 2, '{"quiz": 10, "final": 50, "attempt": true, "midterm": 40, "project": 0}'),
('ECO102', 'Ekonomik İstatistik', 2, 2, '{"quiz": 10, "final": 50, "attempt": false, "midterm": 40, "project": 0}'),
('IC100', 'İç Mimarlığa Giriş', 10, 8, '{"quiz": 10, "final": 30, "attempt": true, "midterm": 20, "project": 40}');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lecture_environments`
--

CREATE TABLE `lecture_environments` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `lectureCode` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `path` varchar(500) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `lecture_environments`
--

INSERT INTO `lecture_environments` (`id`, `title`, `lectureCode`, `path`) VALUES
(1, 'Intro to AI', 'CS410', 'FILE_xSSsfafaDS.pdf'),
(2, 'Lecture 2', 'CS410', 'FILE_HAbfakjASN.zip'),
(3, 'book1', 'ECO102', '1_2.PNG'),
(4, 'Deneme', 'ECO101', 'czo8rnm4lwma.pdf');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `lec_enrollment`
--

CREATE TABLE `lec_enrollment` (
  `stuID` int(11) NOT NULL,
  `lecCode` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `operation` varchar(20) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `lec_enrollment`
--

INSERT INTO `lec_enrollment` (`stuID`, `lecCode`, `operation`) VALUES
(20180000, 'CS519', 'enroll');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `logs`
--

CREATE TABLE `logs` (
  `logID` int(11) NOT NULL,
  `logType` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user` int(11) NOT NULL,
  `userType` int(11) NOT NULL,
  `event` text COLLATE utf8_turkish_ci NOT NULL,
  `eventTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `logs`
--

INSERT INTO `logs` (`logID`, `logType`, `user`, `userType`, `event`, `eventTime`) VALUES
(1, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 16:29:08'),
(2, 'DELETEDEPARTMENT', 2, 1, '2, deleted a department: DENN(bu bir deneme basligi)', '2018-05-31 16:29:30'),
(3, 'UPDATEPROFILEPIC', 2, 1, '2 updated their profile picture.', '2018-05-31 16:31:39'),
(4, 'CREATESTAFF', 2, 1, '2 created a user: (ali@uzemplus.com)', '2018-05-31 16:32:45'),
(5, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 16:33:05'),
(6, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 16:33:10'),
(7, 'UPDATEPROFILEPIC', 20180000, 3, '20180000 updated their profile picture.', '2018-05-31 16:33:34'),
(8, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 16:33:37'),
(9, 'LOGIN', 1, 2, '1 logged in.', '2018-05-31 16:34:27'),
(10, 'LOGOUT', 1, 2, '1 logged out.', '2018-05-31 16:59:54'),
(11, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 16:59:59'),
(12, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 17:00:26'),
(13, 'LOGIN', 3, 4, '3 logged in.', '2018-05-31 17:00:35'),
(14, 'LOGOUT', 3, 4, '3 logged out.', '2018-05-31 17:00:39'),
(15, 'LOGIN', 1, 2, '1 logged in.', '2018-05-31 17:00:52'),
(16, 'LOGOUT', 1, 2, '1 logged out.', '2018-05-31 17:02:13'),
(17, 'LOGIN', 3, 4, '3 logged in.', '2018-05-31 17:02:20'),
(18, 'CREATEANN', 3, 4, '3 created an announcement (a)', '2018-05-31 17:12:29'),
(19, 'CREATEPOLL', 3, 4, '3 created a poll (a)', '2018-05-31 17:43:16'),
(20, 'LOGOUT', 3, 4, '3 logged out.', '2018-05-31 17:43:37'),
(21, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 17:44:24'),
(22, 'LOGIN', 3, 4, '3 logged in.', '2018-05-31 17:49:37'),
(23, 'LOGOUT', 3, 4, '3 logged out.', '2018-05-31 17:49:44'),
(24, 'LOGOUT', 4, 5, '4 logged out.', '2018-05-31 17:52:27'),
(25, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 17:52:32'),
(26, 'LOGOUT', 4, 5, '4 logged out.', '2018-05-31 17:53:55'),
(27, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 17:54:00'),
(28, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 18:16:44'),
(29, 'LOGIN', 3, 4, '3 logged in.', '2018-05-31 18:16:53'),
(30, 'CREATEANN', 3, 4, '3 created an announcement (a)', '2018-05-31 18:28:31'),
(31, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 18:28:44'),
(32, 'CREATEANN', 3, 4, '3 created an announcement (fafdsfsdfdsfdsf)', '2018-05-31 18:29:59'),
(33, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 18:30:24'),
(34, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 18:30:45'),
(35, 'LOGIN', 20180003, 3, '20180003 logged in.', '2018-05-31 18:31:34'),
(36, 'LOGOUT', 20180003, 3, '20180003 logged out.', '2018-05-31 18:32:16'),
(37, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 18:32:22'),
(38, 'CREATEPOLL', 3, 4, '3 created a poll (naptın )', '2018-05-31 18:34:35'),
(39, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 18:34:45'),
(40, 'LOGIN', 20180003, 3, '20180003 logged in.', '2018-05-31 18:34:52'),
(41, 'LOGOUT', 3, 4, '3 logged out.', '2018-05-31 18:43:01'),
(42, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 18:43:11'),
(43, 'LOGOUT', 20180003, 3, '20180003 logged out.', '2018-05-31 19:17:31'),
(44, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 19:18:20'),
(45, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 19:19:05'),
(46, 'LOGOUT', 4, 5, '4 logged out.', '2018-05-31 19:32:03'),
(47, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 19:32:09'),
(48, 'LOGOUT', 4, 5, '4 logged out.', '2018-05-31 19:32:48'),
(49, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 19:33:06'),
(50, 'LOGOUT', 4, 5, '4 logged out.', '2018-05-31 19:34:27'),
(51, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 19:34:35'),
(52, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 19:34:43'),
(53, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 19:34:48'),
(54, 'LOGOUT', 4, 5, '4 logged out.', '2018-05-31 19:34:54'),
(55, 'LOGIN', 3, 4, '3 logged in.', '2018-05-31 19:35:01'),
(56, 'LOGOUT', 3, 4, '3 logged out.', '2018-05-31 19:35:08'),
(57, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 19:35:16'),
(58, 'LOGOUT', 4, 5, '4 logged out.', '2018-05-31 19:42:09'),
(59, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 19:42:15'),
(60, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 20:17:59'),
(61, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 20:18:05'),
(62, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 20:18:18'),
(63, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 20:18:26'),
(64, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 20:18:36'),
(65, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 20:18:42'),
(66, 'LOGOUT', 4, 5, '4 logged out.', '2018-05-31 20:19:38'),
(67, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 20:20:10'),
(68, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 20:21:44'),
(69, 'LOGIN', 7, 5, '7 logged in.', '2018-05-31 20:21:58'),
(70, 'LOGOUT', 7, 5, '7 logged out.', '2018-05-31 20:22:26'),
(71, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 20:22:32'),
(72, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 20:22:53'),
(73, 'CREATEPOLL', 4, 5, '4 created a poll (ankara)', '2018-05-31 20:23:28'),
(74, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 20:24:14'),
(75, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 21:09:25'),
(76, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 21:09:27'),
(77, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 21:13:45'),
(78, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 21:13:51'),
(79, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 21:13:57'),
(80, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 21:16:08'),
(81, 'LOGOUT', 4, 5, '4 logged out.', '2018-05-31 21:21:06'),
(82, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 21:21:13'),
(83, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 21:24:31'),
(84, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 21:24:41'),
(85, 'DELETEPROFILEPIC', 2, 1, '2, deleted their profile picture', '2018-05-31 21:24:45'),
(86, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 21:25:22'),
(87, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 21:25:29'),
(88, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 21:30:08'),
(89, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 21:30:15'),
(90, 'CREATESTAFF', 2, 1, '2 created a user: (a@uzemplus.com)', '2018-05-31 21:31:02'),
(91, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 21:32:10'),
(92, 'LOGIN', 3, 4, '3 logged in.', '2018-05-31 21:32:17'),
(93, 'CREATEHW', 3, 4, '3 created ', '2018-05-31 21:32:46'),
(94, 'LOGOUT', 3, 4, '3 logged out.', '2018-05-31 21:32:49'),
(95, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 21:32:55'),
(96, 'SENDHW', 20180000, 3, '20180000 sent a homework', '2018-05-31 21:33:15'),
(97, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 21:34:10'),
(98, 'LOGIN', 3, 4, '3 logged in.', '2018-05-31 21:34:46'),
(99, 'DELETEPROFILEPIC', 3, 4, '3, deleted their profile picture', '2018-05-31 21:36:58'),
(100, 'LOGOUT', 3, 4, '3 logged out.', '2018-05-31 21:41:09'),
(101, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 21:41:14'),
(102, 'DELETEPROFILEPIC', 20180000, 3, '20180000, deleted their profile picture', '2018-05-31 21:41:22'),
(103, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 21:41:31'),
(104, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 21:41:36'),
(105, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 21:43:45'),
(106, 'LOGIN', 4, 5, '4 logged in.', '2018-05-31 21:43:55'),
(107, 'LOGOUT', 4, 5, '4 logged out.', '2018-05-31 21:44:06'),
(108, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 21:44:11'),
(109, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 21:44:19'),
(110, 'LOGIN', 3, 4, '3 logged in.', '2018-05-31 21:44:27'),
(111, 'LOGOUT', 3, 4, '3 logged out.', '2018-05-31 21:50:56'),
(112, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 21:51:02'),
(113, 'DELETEPROFILEPIC', 20180000, 3, '20180000, deleted their profile picture', '2018-05-31 21:51:14'),
(114, 'ANSPOLL', 20180000, 3, '20180000, answered a poll (id=2)', '2018-05-31 21:51:44'),
(115, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 21:51:48'),
(116, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 21:51:55'),
(117, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 21:52:40'),
(118, 'CREATEPOLLQ', 2, 1, '2 created a poll question', '2018-05-31 21:53:20'),
(119, 'ANSPOLL', 20180000, 3, '20180000, answered a poll (id=4)', '2018-05-31 21:53:28'),
(120, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 21:53:45'),
(121, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 21:53:53'),
(122, 'LOGIN', 2, 1, '2 logged in.', '2018-05-31 21:56:32'),
(123, 'LOGOUT', 2, 1, '2 logged out.', '2018-05-31 21:58:59'),
(124, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-05-31 21:59:03'),
(125, 'INFO', 20180000, 3, '20180000 sent an email to administrator.', '2018-05-31 21:59:26'),
(126, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-05-31 22:00:08'),
(127, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 06:34:48'),
(128, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 06:36:47'),
(129, 'LOGIN', 3, 4, '3 logged in.', '2018-06-01 06:36:57'),
(130, 'CHANGETS', 3, 4, '3 changed time schedule CS410', '2018-06-01 06:37:14'),
(131, 'LOGOUT', 3, 4, '3 logged out.', '2018-06-01 06:37:18'),
(132, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 06:37:28'),
(133, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 06:46:04'),
(134, 'LOGIN', 3, 4, '3 logged in.', '2018-06-01 06:46:11'),
(135, 'CREATEHW', 3, 4, '3 created ', '2018-06-01 06:47:20'),
(136, 'LOGOUT', 3, 4, '3 logged out.', '2018-06-01 06:47:22'),
(137, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 06:47:32'),
(138, 'SENDHW', 20180000, 3, '20180000 sent a homework', '2018-06-01 06:49:53'),
(139, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 06:50:34'),
(140, 'LOGIN', 2, 1, '2 logged in.', '2018-06-01 06:52:24'),
(141, 'CREATESTAFF', 2, 1, '2 created a user: (t@uzemplus.com)', '2018-06-01 06:53:29'),
(142, 'DELETEUSER', 2, 1, '2, deleted a user id:', '2018-06-01 07:08:27'),
(143, 'LOGOUT', 2, 1, '2 logged out.', '2018-06-01 07:16:03'),
(144, 'LOGIN', 4, 5, '4 logged in.', '2018-06-01 07:16:50'),
(145, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 07:18:35'),
(146, 'LOGOUT', 4, 5, '4 logged out.', '2018-06-01 07:27:04'),
(147, 'LOGIN', 2, 1, '2 logged in.', '2018-06-01 07:27:24'),
(148, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 07:29:14'),
(149, 'LOGIN', 3, 4, '3 logged in.', '2018-06-01 07:29:22'),
(150, 'INFO', 2, 1, '2 sent an email to administrator.', '2018-06-01 07:38:11'),
(151, 'DELETEUSER', 2, 1, '2, deleted a user id:', '2018-06-01 07:39:21'),
(152, 'LOGOUT', 2, 1, '2 logged out.', '2018-06-01 07:40:24'),
(153, 'LOGIN', 3, 4, '3 logged in.', '2018-06-01 07:40:32'),
(154, 'CREATEPOLLQ', 3, 4, '3 created a poll question', '2018-06-01 07:42:40'),
(155, 'CREATEPOLLQ', 3, 4, '3 created a poll question', '2018-06-01 07:42:45'),
(156, 'LOGOUT', 3, 4, '3 logged out.', '2018-06-01 07:43:50'),
(157, 'LOGIN', 4, 5, '4 logged in.', '2018-06-01 07:44:04'),
(158, 'RENTBOOK', 4, 5, '4 rented book,id=1', '2018-06-01 07:44:37'),
(159, 'RETURNBOOK', 4, 5, '4 returned book,id=1', '2018-06-01 07:44:43'),
(160, 'CREATEANN', 4, 5, '4 created an announcement (Ömer)', '2018-06-01 07:47:48'),
(161, 'LOGOUT', 4, 5, '4 logged out.', '2018-06-01 07:48:53'),
(162, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 07:49:23'),
(163, 'LOGIN', 2, 1, '2 logged in.', '2018-06-01 07:50:54'),
(164, 'CREATESTUDENT', 2, 1, '2 created a user: (ozturk@uzemplus.com)', '2018-06-01 07:52:19'),
(165, 'LOGOUT', 2, 1, '2 logged out.', '2018-06-01 07:52:59'),
(166, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 07:53:21'),
(167, 'LOGIN', 2, 1, '2 logged in.', '2018-06-01 07:53:31'),
(168, 'CREATESTUDENT', 2, 1, '2 created a user: (k@uzemplus.com)', '2018-06-01 07:54:13'),
(169, 'CREATESTAFF', 2, 1, '2 created a user: (b@uzemplus.com)', '2018-06-01 07:55:30'),
(170, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 07:56:55'),
(171, 'CREATESTUDENT', 2, 1, '2 created a user: (memati@uzemplus.com)', '2018-06-01 07:58:14'),
(172, 'CREATESTUDENT', 2, 1, '2 created a user: (beyza@uzemplus.com)', '2018-06-01 07:59:30'),
(173, 'LECTUREREQ', 20180000, 3, '20180000, enroll, CS519', '2018-06-01 08:01:07'),
(174, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 08:01:33'),
(175, 'CREATESTAFF', 2, 1, '2 created a user: (beyza@uzemplus.com)', '2018-06-01 08:02:34'),
(176, 'CREATESTAFF', 2, 1, '2 created a user: (erol@uzemplus.com)', '2018-06-01 08:03:39'),
(177, 'CREATEFACULTY', 2, 1, '2 created MIM', '2018-06-01 08:04:40'),
(178, 'CREATEDEPARTMENT', 2, 1, '2 created ICM', '2018-06-01 08:05:11'),
(179, 'LOGOUT', 2, 1, '2 logged out.', '2018-06-01 08:05:15'),
(180, 'LOGIN', 11, 5, '11 logged in.', '2018-06-01 08:07:06'),
(181, 'CREATELECTURE', 11, 5, '11 created IC100', '2018-06-01 08:08:35'),
(182, 'LOGOUT', 11, 5, '11 logged out.', '2018-06-01 08:08:38'),
(183, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 08:08:47'),
(184, 'LECTUREREQ', 20180000, 3, '20180000, enroll, IC100', '2018-06-01 08:08:55'),
(185, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 08:08:58'),
(186, 'LOGIN', 10, 2, '10 logged in.', '2018-06-01 08:09:16'),
(187, 'ENROLL', 20180000, 3, '20180000, enrolled IC100', '2018-06-01 08:09:35'),
(188, 'LOGOUT', 10, 2, '10 logged out.', '2018-06-01 08:09:56'),
(189, 'LOGIN', 20180001, 3, '20180001 logged in.', '2018-06-01 08:11:32'),
(190, 'LECTUREREQ', 20180001, 3, '20180001, enroll, IC100', '2018-06-01 08:11:41'),
(191, 'LOGOUT', 20180001, 3, '20180001 logged out.', '2018-06-01 08:11:43'),
(192, 'LOGIN', 10, 2, '10 logged in.', '2018-06-01 08:11:50'),
(193, 'ENROLL', 20180001, 3, '20180001, enrolled IC100', '2018-06-01 08:11:59'),
(194, 'LOGOUT', 10, 2, '10 logged out.', '2018-06-01 08:12:04'),
(195, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 08:12:13'),
(196, 'LOGIN', 20180001, 3, '20180001 logged in.', '2018-06-01 08:12:52'),
(197, 'LOGOUT', 20180001, 3, '20180001 logged out.', '2018-06-01 08:13:12'),
(198, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 08:13:19'),
(199, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 08:24:15'),
(200, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 08:24:23'),
(201, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 08:48:25'),
(202, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 08:51:55'),
(203, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 08:52:19'),
(204, 'LOGIN', 2, 1, '2 logged in.', '2018-06-01 08:52:27'),
(205, 'CREATESTUDENT', 2, 1, '2 created a user: (kgt@uzemplus.com)', '2018-06-01 08:53:36'),
(206, 'LOGOUT', 2, 1, '2 logged out.', '2018-06-01 08:54:39'),
(207, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 09:13:54'),
(208, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 09:14:22'),
(209, 'LOGIN', 2, 1, '2 logged in.', '2018-06-01 09:14:36'),
(210, 'CREATESTUDENT', 2, 1, '2 created a user: (abulbul@uzemplus.com)', '2018-06-01 09:15:37'),
(211, 'CREATESTAFF', 2, 1, '2 created a user: (hbeyza.sava@gmail.com)', '2018-06-01 09:18:14'),
(212, 'LOGOUT', 2, 1, '2 logged out.', '2018-06-01 09:19:06'),
(213, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 09:19:16'),
(214, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 09:29:56'),
(215, 'LOGIN', 2, 1, '2 logged in.', '2018-06-01 09:30:05'),
(216, 'CREATEENV', 2, 1, '2 created an environment.', '2018-06-01 09:30:33'),
(217, 'CREATEANN', 2, 1, '2 created an announcement (Ödevi unutmayın)', '2018-06-01 09:31:41'),
(218, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 09:32:26'),
(219, 'CREATEHW', 2, 1, '2 created ', '2018-06-01 09:34:10'),
(220, 'SENDHW', 20180000, 3, '20180000 sent a homework', '2018-06-01 09:34:50'),
(221, 'SETGRADE', 2, 1, '2 graded, id:9', '2018-06-01 09:35:17'),
(222, 'CREATEPOLL', 2, 1, '2 created a poll (Ders deneyim)', '2018-06-01 09:36:07'),
(223, 'CREATEPOLLQ', 2, 1, '2 created a poll question', '2018-06-01 09:36:59'),
(224, 'CREATEPOLLQ', 2, 1, '2 created a poll question', '2018-06-01 09:37:03'),
(225, 'ANSPOLL', 20180000, 3, '20180000, answered a poll (id=14)', '2018-06-01 09:37:17'),
(226, 'CREATEANN', 2, 1, '2 created an announcement (dfsdfdssdfsds)', '2018-06-01 09:38:19'),
(227, 'DELETEUSER', 2, 1, '2, deleted a user id:', '2018-06-01 09:39:08'),
(228, 'CREATESTUDENT', 2, 1, '2 created a user: (hbeyza.sava@gmail.com)', '2018-06-01 09:39:57'),
(229, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 09:40:20'),
(230, 'LOGIN', 20180008, 3, '20180008 logged in.', '2018-06-01 09:41:11'),
(231, 'LECTUREREQ', 20180008, 3, '20180008, enroll, IC100', '2018-06-01 09:41:49'),
(232, 'LOGOUT', 20180008, 3, '20180008 logged out.', '2018-06-01 09:41:51'),
(233, 'LOGIN', 10, 2, '10 logged in.', '2018-06-01 09:42:04'),
(234, 'ENROLL', 20180008, 3, '20180008, enrolled IC100', '2018-06-01 09:42:17'),
(235, 'INFO', 2, 1, '2 sent an email to administrator.', '2018-06-01 09:43:52'),
(236, 'LOGOUT', 2, 1, '2 logged out.', '2018-06-01 09:44:34'),
(237, 'LOGIN', 3, 4, '3 logged in.', '2018-06-01 09:44:43'),
(238, 'LOGOUT', 3, 4, '3 logged out.', '2018-06-01 09:48:38'),
(239, 'LOGIN', 10, 2, '10 logged in.', '2018-06-01 09:48:49'),
(240, 'LOGOUT', 10, 2, '10 logged out.', '2018-06-01 09:57:33'),
(241, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 09:57:45'),
(242, 'LOGOUT', 10, 2, '10 logged out.', '2018-06-01 09:59:15'),
(243, 'LOGOUT', 20180000, 3, '20180000 logged out.', '2018-06-01 10:01:04'),
(244, 'LOGIN', 20180008, 3, '20180008 logged in.', '2018-06-01 10:01:13'),
(245, 'LOGIN', 20180000, 3, '20180000 logged in.', '2018-06-01 11:20:47'),
(246, 'LOGOUT', 20180008, 3, '20180008 logged out.', '2018-06-01 11:21:33'),
(247, 'LOGIN', 3, 4, '3 logged in.', '2018-06-01 11:21:45'),
(248, 'LOGOUT', 3, 4, '3 logged out.', '2018-06-01 11:33:58'),
(249, 'LOGIN', 2, 1, '2 logged in.', '2018-06-01 11:34:07'),
(250, 'DELETEUSER', 2, 1, '2, deleted a user id:', '2018-06-01 11:34:19'),
(251, 'DELETEUSER', 2, 1, '2, deleted a user id:', '2018-06-01 11:34:21'),
(252, 'LOGOUT', 2, 1, '2 logged out.', '2018-06-01 11:34:43');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `messageFrom` int(11) NOT NULL,
  `messageTo` int(11) NOT NULL,
  `content` text COLLATE utf8_turkish_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`id`, `messageFrom`, `messageTo`, `content`, `timestamp`, `status`) VALUES
(1, 20180000, 20180001, 'Hi John!', '2018-03-20 22:01:11', 1),
(2, 20180001, 20180000, 'Hi buddy!', '2018-03-20 22:02:06', 1),
(3, 20180001, 20180000, 'How was your day?', '2018-03-20 22:06:33', 1),
(4, 20180000, 20180001, 'it was good m8, how was yours?', '2018-03-20 22:14:16', 1),
(8, 20180000, 20180001, 'bu bir deneme mesajidir', '2018-04-23 21:02:52', 1),
(9, 20180000, 20180002, 'hello', '2018-05-30 14:30:22', 0),
(10, 20180000, 20180001, 'naptın gardaş', '2018-06-01 08:12:33', 1),
(11, 20180001, 20180000, 'iyi gardaş sen naptın', '2018-06-01 08:13:10', 1),
(12, 20180000, 20180008, 'nasılsın', '2018-06-01 09:59:02', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `title` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `pollTo` varchar(11) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `polls`
--

INSERT INTO `polls` (`id`, `title`, `pollTo`) VALUES
(2, 'deneme anket', 'ALL'),
(4, 'dsfsadf', 'ALL'),
(5, 'dsfasf', 'ALL'),
(6, 'hello', 'ALL'),
(8, 'computer science', 'CS'),
(9, 'CS222 final anketi', 'CS222'),
(10, '519', 'CS519'),
(11, 'a', 'ENSCI2'),
(12, 'naptın ', 'ENSCI2'),
(13, 'ankara', 'HIS'),
(14, 'Ders deneyim', 'ALL');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `poll_questions`
--

CREATE TABLE `poll_questions` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_turkish_ci NOT NULL,
  `pollID` int(11) NOT NULL,
  `one` int(11) NOT NULL DEFAULT '0',
  `two` int(11) NOT NULL DEFAULT '0',
  `three` int(11) NOT NULL DEFAULT '0',
  `four` int(11) NOT NULL DEFAULT '0',
  `five` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `poll_questions`
--

INSERT INTO `poll_questions` (`id`, `title`, `pollID`, `one`, `two`, `three`, `four`, `five`) VALUES
(2, 'dersin hocasi derse hazirlikli geldi mi?', 2, 5, 1, 0, 0, 1),
(3, 'dersin size ne kadar faydasinin oldugunu dusunuyorsunuz?', 2, 3, 0, 2, 0, 2),
(4, 'Deneme kitap', 2, 0, 2, 1, 1, 2),
(5, 'title', 10, 0, 0, 0, 0, 0),
(6, 'bu bir deneme basligi', 10, 0, 0, 0, 0, 0),
(7, 'a', 4, 0, 0, 0, 0, 1),
(8, 'ajklfjdlkflkdsjdlsjfljdslkfjlkds', 11, 0, 0, 0, 0, 0),
(9, 'fsdfdfdsfddsfdsdsfd', 11, 0, 0, 0, 0, 0),
(10, '1', 14, 0, 0, 0, 0, 1),
(11, '2', 14, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `email` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `name` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `surname` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `image` varchar(256) COLLATE utf8_turkish_ci DEFAULT NULL,
  `room` varchar(10) COLLATE utf8_turkish_ci DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `staffs`
--

INSERT INTO `staffs` (`id`, `email`, `password`, `name`, `surname`, `image`, `room`, `type`) VALUES
(1, 'ebulbul@uzemplus.com', 'e10adc3949ba59abbe56e057f20f883e', 'Emrecan', 'Bulbul', NULL, 'A411', 2),
(2, 'admin@uzemplus.com', 'e10adc3949ba59abbe56e057f20f883e', 'Naim Alper', 'Muhacir', NULL, 'B520', 1),
(3, 'bduzgun@uzemplus.com', 'e10adc3949ba59abbe56e057f20f883e', 'Betul', 'Duzgun', NULL, NULL, 4),
(4, 'calisan1@uzemplus.com', 'e10adc3949ba59abbe56e057f20f883e', 'calisan1', 'calisan1', NULL, NULL, 5),
(5, 'akkk@uzemplus.com', 'e10adc3949ba59abbe56e057f20f883e', 'Akademisyen', 'Akademisyen', NULL, 'B411', 4),
(6, 'ali@uzemplus.com', '00f11218f0cdf514d0b10569c7ee26b9', 'Ali', 'Bülbül', NULL, 'C808', 2),
(7, 'calisan2@uzemplus.com', 'e10adc3949ba59abbe56e057f20f883e', 'calisan2', 'calisan2', NULL, NULL, 5),
(8, 'a@uzemplus.com', '5ce9795102f5f08b9012c80c26e27c58', 'aaaa', 'bbbbb', NULL, 'C123', 4),
(10, 'b@uzemplus.com', 'e10adc3949ba59abbe56e057f20f883e', 'Omer', 'B', NULL, 'Z210', 2),
(11, 'beyza@uzemplus.com', 'e10adc3949ba59abbe56e057f20f883e', 'Beyza', 'Savaş', NULL, 'AZ210', 5),
(12, 'erol@uzemplus.com', 'e10adc3949ba59abbe56e057f20f883e', 'Tuğberk ', 'Erol', NULL, 'S500', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `email` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `name` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `surname` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `image` varchar(256) COLLATE utf8_turkish_ci DEFAULT NULL,
  `department` int(11) NOT NULL,
  `faculty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `students`
--

INSERT INTO `students` (`id`, `email`, `password`, `name`, `surname`, `image`, `department`, `faculty`) VALUES
(20180000, 'admin@uzemplus.com', 'e10adc3949ba59abbe56e057f20f883e', 'Emrecan', 'Bulbul', NULL, 1, 1),
(20180001, 'john@doe.org', 'e10adc3949ba59abbe56e057f20f883e', 'John', 'Doe', NULL, 2, 3),
(20180002, 'jane@doe.org', 'c967c85108e517524594080ad396ed22', 'Jane', 'Doe', NULL, 1, 1),
(20180003, 'ogrenci1@uzemplus.com', 'e10adc3949ba59abbe56e057f20f883e', 'ogrenci1', 'ogrenci1', NULL, 1, 1),
(20180008, 'hbeyza.sava@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hande', 'Savaş', NULL, 8, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stu_assignments`
--

CREATE TABLE `stu_assignments` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `assignment` int(11) NOT NULL,
  `file` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `stu_assignments`
--

INSERT INTO `stu_assignments` (`id`, `student`, `assignment`, `file`, `timestamp`, `grade`) VALUES
(1, 20180000, 3, 'FILE_12x2weAS21.pdf', '2018-05-30 11:08:25', 95),
(3, 20180000, 7, '7_20180000.pdf', '2018-05-31 21:33:15', NULL),
(4, 20180000, 8, '8_20180000.pdf', '2018-06-01 06:49:53', NULL),
(5, 20180000, 9, '9_20180000.pdf', '2018-06-01 09:34:50', 100);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `timeschedule`
--

CREATE TABLE `timeschedule` (
  `rowIndex` int(11) NOT NULL,
  `columnIndex` int(11) NOT NULL,
  `lecture` varchar(10) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `timeschedule`
--

INSERT INTO `timeschedule` (`rowIndex`, `columnIndex`, `lecture`) VALUES
(0, 0, 'ECO102'),
(1, 0, 'ECO102'),
(2, 0, 'ECO102'),
(0, 4, 'ECO101'),
(1, 4, 'ECO101'),
(2, 4, 'ECO101'),
(5, 1, 'CS410'),
(6, 1, 'CS410');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `announces`
--
ALTER TABLE `announces`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_LecCode` (`lecCode`);

--
-- Tablo için indeksler `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `book_rental`
--
ALTER TABLE `book_rental`
  ADD KEY `fk_bookID` (`bookID`);

--
-- Tablo için indeksler `class_list`
--
ALTER TABLE `class_list`
  ADD KEY `fkstu` (`stuID`),
  ADD KEY `fklec` (`lecCode`);

--
-- Tablo için indeksler `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `abbr` (`abbr`),
  ADD KEY `fkFaculty` (`faculty`),
  ADD KEY `fkChair` (`chair`);

--
-- Tablo için indeksler `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `abbr` (`abbr`),
  ADD KEY `fkDean` (`dean`);

--
-- Tablo için indeksler `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`lecCode`),
  ADD KEY `fkProfessor` (`professor`),
  ADD KEY `fkDepartment` (`department`);

--
-- Tablo için indeksler `lecture_environments`
--
ALTER TABLE `lecture_environments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkLectureCode` (`lectureCode`);

--
-- Tablo için indeksler `lec_enrollment`
--
ALTER TABLE `lec_enrollment`
  ADD KEY `fkstudent` (`stuID`),
  ADD KEY `fkleccode` (`lecCode`);

--
-- Tablo için indeksler `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logID`);

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkMessageFrom` (`messageFrom`),
  ADD KEY `fkMessageTo` (`messageTo`);

--
-- Tablo için indeksler `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `poll_questions`
--
ALTER TABLE `poll_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkPollID` (`pollID`);

--
-- Tablo için indeksler `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `stu_assignments`
--
ALTER TABLE `stu_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkSt` (`student`),
  ADD KEY `fkAssignment` (`assignment`);

--
-- Tablo için indeksler `timeschedule`
--
ALTER TABLE `timeschedule`
  ADD KEY `fkLecture` (`lecture`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `announces`
--
ALTER TABLE `announces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Tablo için AUTO_INCREMENT değeri `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Tablo için AUTO_INCREMENT değeri `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Tablo için AUTO_INCREMENT değeri `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `lecture_environments`
--
ALTER TABLE `lecture_environments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `logs`
--
ALTER TABLE `logs`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;
--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Tablo için AUTO_INCREMENT değeri `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Tablo için AUTO_INCREMENT değeri `poll_questions`
--
ALTER TABLE `poll_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Tablo için AUTO_INCREMENT değeri `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Tablo için AUTO_INCREMENT değeri `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20180009;
--
-- Tablo için AUTO_INCREMENT değeri `stu_assignments`
--
ALTER TABLE `stu_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `fk_LecCode` FOREIGN KEY (`lecCode`) REFERENCES `lectures` (`lecCode`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `book_rental`
--
ALTER TABLE `book_rental`
  ADD CONSTRAINT `fk_bookID` FOREIGN KEY (`bookID`) REFERENCES `books` (`id`);

--
-- Tablo kısıtlamaları `class_list`
--
ALTER TABLE `class_list`
  ADD CONSTRAINT `fklec` FOREIGN KEY (`lecCode`) REFERENCES `lectures` (`lecCode`),
  ADD CONSTRAINT `fkstu` FOREIGN KEY (`stuID`) REFERENCES `students` (`id`);

--
-- Tablo kısıtlamaları `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `fkChair` FOREIGN KEY (`chair`) REFERENCES `staffs` (`id`),
  ADD CONSTRAINT `fkFaculty` FOREIGN KEY (`faculty`) REFERENCES `faculties` (`id`);

--
-- Tablo kısıtlamaları `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `fkDean` FOREIGN KEY (`dean`) REFERENCES `staffs` (`id`);

--
-- Tablo kısıtlamaları `lectures`
--
ALTER TABLE `lectures`
  ADD CONSTRAINT `fkDepartment` FOREIGN KEY (`department`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `fkProfessor` FOREIGN KEY (`professor`) REFERENCES `staffs` (`id`);

--
-- Tablo kısıtlamaları `lecture_environments`
--
ALTER TABLE `lecture_environments`
  ADD CONSTRAINT `fkLectureCode` FOREIGN KEY (`lectureCode`) REFERENCES `lectures` (`lecCode`);

--
-- Tablo kısıtlamaları `lec_enrollment`
--
ALTER TABLE `lec_enrollment`
  ADD CONSTRAINT `fkleccode` FOREIGN KEY (`lecCode`) REFERENCES `lectures` (`lecCode`),
  ADD CONSTRAINT `fkstudent` FOREIGN KEY (`stuID`) REFERENCES `students` (`id`);

--
-- Tablo kısıtlamaları `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fkMessageFrom` FOREIGN KEY (`messageFrom`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkMessageTo` FOREIGN KEY (`messageTo`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `poll_questions`
--
ALTER TABLE `poll_questions`
  ADD CONSTRAINT `fkPollID` FOREIGN KEY (`pollID`) REFERENCES `polls` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `stu_assignments`
--
ALTER TABLE `stu_assignments`
  ADD CONSTRAINT `fkAssignment` FOREIGN KEY (`assignment`) REFERENCES `assignments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkSt` FOREIGN KEY (`student`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `timeschedule`
--
ALTER TABLE `timeschedule`
  ADD CONSTRAINT `fkLecture` FOREIGN KEY (`lecture`) REFERENCES `lectures` (`lecCode`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
