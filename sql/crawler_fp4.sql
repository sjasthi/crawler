-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2020 at 12:57 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crawler`
--

-- --------------------------------------------------------

--
-- Table structure for table `crawlurl`
--

CREATE TABLE `crawlurl` (
  `id` int(11) NOT NULL,
  `crawledurl` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insert_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `crawlurl`
--

INSERT INTO `crawlurl` (`id`, `crawledurl`, `insert_date`) VALUES
(1, 'www.metrostate.edu', '08/10/2017'),
(2, 'www.metrostate.edu/#mainContent', '08/10/2017'),
(3, 'www.metrostate.edu/#', '08/10/2017'),
(4, 'www.metrostate.edu/', '08/10/2017'),
(5, 'www.metrostate.edu/student', '08/10/2017'),
(6, 'www.metrostate.edu/why-metro/metropolitan-state-foundation/giving', '08/10/2017'),
(7, 'www.metrostate.edu/news', '08/10/2017'),
(8, 'www.metrostate.edu/locations', '08/10/2017'),
(9, 'www.metrostate.edu/#', '08/10/2017'),
(10, 'http://www.metrostate.edu/', '08/10/2017'),
(11, 'www.metrostate.edu/#', '08/10/2017'),
(12, 'www.metrostate.edu/why-metro', '08/10/2017'),
(13, 'www.metrostate.edu/academic-programs', '08/10/2017'),
(14, 'www.metrostate.edu/cost-and-aid', '08/10/2017'),
(15, 'www.metrostate.edu/admissions', '08/10/2017'),
(16, 'www.metrostate.edu/community-engagement', '08/10/2017'),
(17, 'www.metrostate.edu/admissions/enrollment-and-registration/enrollment-registration', '08/10/2017'),
(18, 'www.metrostate.edu/student/student-services-support/student-services', '08/10/2017'),
(19, 'www.metrostate.edu/why-metro/spotlight-stories/meet-ploua', '08/10/2017'),
(20, 'www.metrostate.edu/admissions/undergraduate/transfer-resources', '08/10/2017'),
(21, 'www.metrostate.edu/student/mymetronet/mymetronet', '08/10/2017'),
(22, 'www.metrostate.edu/news/nine-named-as-spring-2017-outstanding-students-5-8-17', '08/10/2017'),
(23, 'www.metrostate.edu/news/nine-named-as-spring-2017-outstanding-students-5-8-17', '08/10/2017'),
(25, 'www.metrostate.edu/news?categoryFilter=Accolades', '08/10/2017'),
(26, 'www.metrostate.edu/news?categoryFilter=Academic', '08/10/2017'),
(28, 'www.metrostate.edu/news?categoryFilter=Community', '08/10/2017'),
(30, 'www.metrostate.edu/news?categoryFilter=Community', '08/10/2017'),
(31, 'www.metrostate.edu/news?categoryFilter=Academic', '08/10/2017'),
(32, 'www.metrostate.edu/news', '08/10/2017'),
(33, 'www.metrostate.edu/events/english-conversation-circle-8-10', '08/10/2017'),
(34, 'www.metrostate.edu/events?categoryFilter=Academic Events', '08/10/2017'),
(35, 'www.metrostate.edu/events?categoryFilter=Community', '08/10/2017'),
(36, 'www.metrostate.edu/events/mba-graduate-student-orientation-session-8-12-2017', '08/10/2017'),
(37, 'www.metrostate.edu/events?categoryFilter=Administration Events', '08/10/2017'),
(38, 'www.metrostate.edu/events?categoryFilter=Academic Events', '08/10/2017'),
(39, 'www.metrostate.edu/events/mmis-graduate-certificate-student-orientation-session-8-12-2017', '08/10/2017'),
(40, 'www.metrostate.edu/events?categoryFilter=Administration Events', '08/10/2017'),
(41, 'www.metrostate.edu/events?categoryFilter=Academic Events', '08/10/2017'),
(42, 'www.metrostate.edu/events', '08/10/2017'),
(43, 'www.metrostate.edu/contact/request-for-graduate-and-undergraduate-admissions-information', '08/10/2017'),
(44, 'www.metrostate.edu/contact/speak-with-an-admissions-counselor/contact-us', '08/10/2017'),
(45, 'www.metrostate.edu/contact/request-for-graduate-and-undergraduate-admissions-visit', '08/10/2017'),
(46, 'www.metrostate.edu/admissions/apply-online/undergraduate-and-graduate-online-applications', '08/10/2017'),
(47, 'www.metrostate.edu/#', '08/10/2017'),
(48, 'www.metrostate.edu/why-metro', '08/10/2017'),
(49, 'www.metrostate.edu/admissions', '08/10/2017'),
(50, 'www.metrostate.edu/cost-and-aid', '08/10/2017'),
(51, 'www.metrostate.edu/academic-programs', '08/10/2017'),
(52, 'www.metrostate.edu/community-engagement', '08/10/2017'),
(53, 'www.metrostate.edu/student/university-info/university-info/safety-and-security/ru-ready', '08/10/2017'),
(54, 'https://www.facebook.com/ChooseMetroState', '08/10/2017'),
(55, 'https://twitter.com/choose_metro', '08/10/2017'),
(56, 'https://www.linkedin.com/edu/school?id=18661&trk=vsrp_universities_res_pri_act_view&trkInfo=VSRPsearchId%3A113309891441154525969%2CVSRPtargetId%3A18661%2CVSRPcmpt%3Aprimary', '08/10/2017'),
(57, 'www.metrostate.edu/student', '08/10/2017'),
(58, 'www.metrostate.edu/student/student-services-support/student-services/gateway', '08/10/2017'),
(59, 'www.metrostate.edu/locations', '08/10/2017'),
(60, 'www.metrostate.edu/events', '08/10/2017'),
(61, 'www.metrostate.edu/student/university-info/university-info/human-resources/employment-opportunities', '08/10/2017'),
(62, 'www.metrostate.edu/student/university-info/university-info/university-directory', '08/10/2017'),
(63, 'www.metrostate.edu/student/learning-resources/learning-resources/library-and-information-services', '08/10/2017'),
(64, 'https://metrostate.ims.mnscu.edu', '08/10/2017'),
(65, 'www.metrostate.edu/student/course-info/course-info/course-catalogs', '08/10/2017'),
(66, 'https://webproc.mnscu.edu/esession/authentication.do?campusId=076&amp;postAuthUrl=http%3A%2F%2Fwebproc.mnscu.edu%2Fregistration%2Fsecure%2Fsearch%2Fbasic.html%3Fcampusid%3D076', '08/10/2017'),
(67, 'https://metronet.metrostate.edu/portal/default.aspx', '08/10/2017'),
(68, 'www.metrostate.edu/site-information/terms-and-conditions', '08/10/2017'),
(69, 'http://www.mnscu.edu/', '08/10/2017'),
(70, 'www.google.com', '07/19/2018'),
(71, 'www.facebook.com', '07/19/2018'),
(72, 'www.google.com/news', '07/19/2018'),
(73, 'www.myspace.com', '07/19/2018'),
(74, 'google.com', '07/19/2018'),
(75, 'www.msn.com', '08/09/2018'),
(76, 'www.hotmail.com', '08/09/2018'),
(77, 'https://te.wikipedia.org/wiki/à°®à±‚à°¸:à°šà°°à°¿à°¤à±à°°à°²à±‹_à°ˆ_à°°à±‹à°œà±1', '08/09/2018'),
(78, 'https://te.wikipedia.org/w/index.php?title=à°®à±Šà°¦à°Ÿà°¿_à°ªà±‡à°œà±€&action=info', '08/09/2018'),
(79, 'https://te.wikipedia.org/wiki/à°®à±Šà°¦à°Ÿà°¿_à°ªà±‡à°œà±€', '08/09/2018'),
(80, 'https://te.wikipedia.org/wiki/à°µà°¿à°•à±€à°ªà±€à°¡à°¿à°¯à°¾:à°¸à°¹à°¾à°¯_à°•à±‡à°‚à°¦à±à°°à°‚', '08/14/2018'),
(81, 'https://te.wikipedia.org/wiki/à°µà°¿à°•à±€à°ªà±€à°¡à°¿à°¯à°¾:à°¸à°¹à°¾à°¯_à°•à±‡à°‚à°¦à±à°°à°‚#à°µà°¿à°¸à±à°¤à°°à°¾à°•à±à°²_à°—à±à°°à°¿à°‚à°šà°¿_à°¸à°‚à°¦à±‡à°¹à°‚', '08/14/2018'),
(82, 'https://te.wikipedia.org/wiki/à°µà°¾à°¡à±à°•à°°à°¿:Arjunaraoc', '08/14/2018'),
(83, 'https://en.wikipedia.org/wiki/Canadaâ€“Saudi_Arabia_relations#August_2018_diplomatic_dispute', '08/14/2018'),
(84, 'https://en.wikipedia.org/wiki/Help:Contents', '08/14/2018'),
(85, 'https://en.wikipedia.org/wiki/Wikipedia:Community_portal', '08/14/2018'),
(86, 'https://te.wikipedia.org/wiki/à°¸à°‚à°ªà±à°°à°¦à°¿à°‚à°ªà±_à°ªà±‡à°œà°¿', '08/14/2018'),
(87, 'https://en.wikipedia.org/wiki/Tomorrow_Never_Dies', '08/17/2018'),
(88, 'https://en.wikipedia.org/wiki/Pirates_of_the_Caribbean_(film_series)', '08/17/2018'),
(89, '', '02/12/2020'),
(90, 'www.apple.com\r\n', '02/13/2020'),
(91, 'www.microsoft.com', '02/13/2020'),
(92, 'www.Tesla.com\r\n', '02/16/2020'),
(93, 'https://www.php.net/manual/en/function.require.php', '02/16/2020'),
(94, 'http://vantagesoftwarellc.com/', '02/16/2020'),
(95, 'https://www.foxnews.com/health/coronavirus-diamond-princess-state-department-planes-evacuate-us-citizens-japan', '02/16/2020'),
(96, 'https://www.google.com/search?q=google+news&oq=google+news&aqs=chrome.0.35i39j0l4j69i60l3.2220j0j7&sourceid=chrome&ie=UTF-8', '02/16/2020'),
(97, 'www.mcdonalds.com\r\n', '02/16/2020'),
(98, 'www.burgerking.com', '02/16/2020'),
(99, 'https://nypost.com/2020/02/15/bernie-sanders-isnt-a-brawler-and-thats-why-he-cant-beat-trump/', '02/16/2020'),
(100, 'https://www.reuters.com/article/us-usa-election-sanders/sanders-says-presidential-rival-bloomberg-will-not-excite-voters-idUSKBN20A05X', '02/16/2020'),
(101, 'https://te.wikipedia.org/wiki/%E0%B0%B5%E0%B0%B0%E0%B1%8D%E0%B0%97%E0%B0%82:%E0%B0%AD%E0%B0%BE%E0%B0%B0%E0%B0%A4_%E0%B0%A6%E0%B1%87%E0%B0%B6%E0%B0%AE%E0%B1%81', '02/16/2020'),
(102, 'https://eservices.minnstate.edu/esession/authentication.do?campusId=076&postAuthUrl=http%3A%2F%2Feservices.minnstate.edu%2Fregistration%2Fsecure%2Fsearch%2Fbasic.html%3Fcampusid%3D076', '02/16/2020'),
(103, 'https://te.wikipedia.org/wiki/%E0%B0%AB%E0%B0%BF%E0%B0%AC%E0%B1%8D%E0%B0%B0%E0%B0%B5%E0%B0%B0%E0%B0%BF_16', '02/16/2020'),
(104, 'https://en.wikipedia.org/wiki/2020_Irish_general_election', '02/16/2020'),
(105, 'https://te.wikipedia.org/wiki/%E0%B0%AE%E0%B1%8A%E0%B0%A6%E0%B0%9F%E0%B0%BF_%E0%B0%AA%E0%B1%87%E0%B0%9C%E0%B1%80', '02/19/2020');

-- --------------------------------------------------------

--
-- Table structure for table `english`
--

CREATE TABLE `english` (
  `en_id` int(11) NOT NULL,
  `word` varchar(200) DEFAULT NULL,
  `char_len` int(100) DEFAULT NULL,
  `strength` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `english`
--

INSERT INTO `english` (`en_id`, `word`, `char_len`, `strength`, `weight`) VALUES
(10654, 'Tester', 6, 6, 6),
(10655, 'Road', 4, 4, 4),
(10656, 'Dirt', 4, 4, 4),
(10657, 'Goat', 4, 1, 4),
(10658, '??????????', 30, 2, 10),
(10659, '??????????', 30, 2, 10),
(10660, '?????', 15, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `suggesturl`
--

CREATE TABLE `suggesturl` (
  `id` int(11) NOT NULL,
  `suggestedurl` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insert_date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suggesturl`
--

INSERT INTO `suggesturl` (`id`, `suggestedurl`, `insert_date`) VALUES
(93, 'www.apple.com', '08/17/2018'),
(94, '', '08/17/2018');

-- --------------------------------------------------------

--
-- Table structure for table `telugu`
--

CREATE TABLE `telugu` (
  `tel_id` int(11) NOT NULL,
  `word` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `char_len` int(15) DEFAULT NULL,
  `strength` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `counted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `telugu`
--

INSERT INTO `telugu` (`tel_id`, `word`, `char_len`, `strength`, `weight`, `counted`) VALUES
(4085, 'పాత', 9, 2, 3, 1),
(4086, 'రాతియుగం', 24, 2, 8, 1),
(4087, 'మలి', 9, 2, 3, 1),
(4088, 'దశ', 6, 1, 2, 1),
(4089, 'నుండి', 15, 3, 5, 1),
(4090, 'మధ్య', 12, 3, 4, 1),
(4091, 'తొలి', 12, 2, 4, 1),
(4092, 'నాళ్ళ', 15, 3, 5, 1),
(4093, 'వరకూ', 12, 2, 4, 1),
(4094, 'అంటే', 12, 2, 4, 1),
(4095, 'సుమారు', 18, 2, 6, 1),
(4096, 'లక్షల', 15, 3, 5, 1),
(4097, 'ఏళ్ళ', 12, 3, 4, 1),
(4098, 'క్రితానికి', 30, 4, 10, 1),
(4099, 'క్రితానికీ', 30, 4, 10, 1),
(4100, 'మధ్యన', 15, 3, 5, 1),
(4101, 'ఆఫ్రికా', 21, 4, 7, 1),
(4102, 'యురేషియా', 24, 2, 8, 1),
(4103, 'అంతటా', 15, 2, 5, 1),
(4104, 'పురాతన', 18, 2, 6, 1),
(4105, 'మానవుల', 18, 2, 6, 1),
(4106, 'హోమో', 12, 2, 4, 1),
(4107, 'జాతి', 12, 2, 4, 1),
(4108, 'విస్తరణలు', 27, 3, 9, 1),
(4109, 'జరిగాయి', 21, 2, 7, 1),
(4110, 'విస్తరణ', 21, 3, 7, 1),
(4111, 'లన్నింటినీ', 30, 5, 10, 1),
(4112, 'కలిపి', 15, 2, 5, 1),
(4113, 'ఆప్రికా', 21, 4, 7, 1),
(4114, 'బయటకు', 15, 2, 5, 1),
(4115, 'అవుట్', 15, 2, 5, 1),
(4116, 'ఆఫ్', 9, 2, 3, 1),
(4117, 'అని', 9, 2, 3, 1),
(4118, 'పిలుస్తారు', 30, 4, 10, 1),
(4119, 'సేపియన్స్', 27, 4, 9, 1),
(4120, 'శరీర', 12, 2, 4, 1),
(4121, 'నిర్మాణపరంగా', 36, 4, 12, 1),
(4122, 'ఆధునిక', 18, 2, 6, 1),
(4123, 'మానవులు', 21, 2, 7, 1),
(4124, 'యురేషియాలోకి', 36, 2, 12, 1),
(4125, 'విస్తరించిన', 33, 3, 11, 1),
(4126, 'ఘటన', 9, 1, 3, 1),
(4127, 'ఇదీ', 9, 2, 3, 1),
(4128, 'వేరువేరు', 24, 2, 8, 1),
(4129, 'సేపియన్ల', 24, 3, 8, 1),
(4130, 'సంవత్సరాల', 27, 3, 9, 1),
(4131, 'క్రితం', 18, 4, 6, 1),
(4132, 'ప్రారంభమై', 27, 4, 9, 1),
(4133, 'ఉండవచ్చు', 24, 4, 8, 1),
(4134, 'దాన్ని', 18, 4, 6, 1),
(4135, 'II', 2, 1, 2, 1),
(4136, 'వెలుపల', 18, 2, 6, 1),
(4137, 'తొట్టతొలి', 27, 3, 9, 1),
(4138, 'ఉనికి', 15, 2, 5, 1),
(4139, 'నాడు', 12, 2, 4, 1),
(4140, 'జరిగింది', 24, 3, 8, 1),
(4141, 'చైనాలోని', 24, 2, 8, 1),
(4142, 'షాంగ్‌చెన్', 30, 3, 10, 1),
(4143, 'వద్ద', 12, 3, 4, 1),
(4144, 'నాడే', 12, 2, 4, 1),
(4145, 'మానవ', 12, 2, 4, 1),
(4146, 'ఉన్నట్లుగా', 30, 4, 10, 1),
(4147, 'చేసిన', 15, 2, 5, 1),
(4148, 'రాతి', 12, 2, 4, 1),
(4149, 'పనిముట్ల', 24, 3, 8, 1),
(4150, 'అధ్యయనం', 21, 3, 7, 1),
(4151, 'ద్వారా', 18, 4, 6, 1),
(4152, 'కనుగొన్నామని', 36, 4, 12, 1),
(4153, 'చెప్పుకొన్నారు', 42, 4, 14, 1),
(4154, 'బయట', 9, 1, 3, 1),
(4155, 'లభించిన', 21, 3, 7, 1),
(4156, 'అత్యంత', 18, 4, 6, 1),
(4157, 'అస్థిపంజర', 27, 4, 9, 1),
(4158, 'అవశేషాలు', 24, 2, 8, 1),
(4159, 'జార్జియా', 24, 4, 8, 1),
(4160, 'లోని', 12, 2, 4, 1),
(4161, 'ద్మానిసి', 24, 4, 8, 1),
(4162, 'పుర్రె', 18, 4, 6, 1),
(4163, 'లభించాయి', 24, 3, 8, 1),
(4164, 'ఇవి', 9, 2, 3, 1),
(4165, 'నాటివి', 18, 2, 6, 1),
(4166, 'అవశేషాలను', 27, 2, 9, 1),
(4167, 'ఎరెక్టస్', 24, 3, 8, 1),
(4168, 'జార్జికస్', 27, 4, 9, 1),
(4169, 'వర్గీకరించారు', 39, 4, 13, 1),
(4170, 'వికీపీడియా', 30, 2, 10, 1),
(4171, 'ఎవరైనా', 18, 2, 6, 1),
(4172, 'రాయదగిన', 21, 2, 7, 1),
(4173, 'స్వేచ్ఛా', 24, 4, 8, 1),
(4174, 'విజ్ఞాన', 21, 4, 7, 1),
(4175, 'సర్వస్వము', 27, 3, 9, 1),
(4176, 'ఇక్కడ', 15, 3, 5, 1),
(4177, 'సమాచారాన్ని', 33, 4, 11, 1),
(4178, 'వాడుకోవటమే', 30, 2, 10, 1),
(4179, 'కాదు', 12, 2, 4, 1),
(4180, 'ఉన్న', 12, 3, 4, 1),
(4181, 'సమాచారంలో', 27, 2, 9, 1),
(4182, 'అవసరమైన', 21, 2, 7, 1),
(4183, 'మార్పుచేర్పులు', 42, 4, 14, 1),
(4184, 'చెయ్యవచ్చు', 30, 4, 10, 1),
(4185, 'కొత్త', 15, 3, 5, 1),
(4186, 'చేర్చవచ్చు', 30, 4, 10, 1),
(4187, 'ప్రస్తుతం', 27, 4, 9, 1),
(4188, 'తెలుగు', 18, 2, 6, 1),
(4189, 'వికీపీడియాలో', 36, 2, 12, 1),
(4190, 'వ్యాసాలున్నాయి', 42, 4, 14, 1),
(4191, 'పూర్తి', 18, 4, 6, 1),
(4192, 'గణాంకాలు', 24, 3, 8, 1),
(4193, 'చూడండి', 18, 2, 6, 1),
(4194, 'ఉండేవారని', 27, 2, 9, 1),
(4195, 'చెప్పేందుకు', 33, 5, 11, 1),
(4196, 'దమానిసి', 21, 2, 7, 1),
(4197, 'దొరికిన', 21, 2, 7, 1),
(4198, 'ఒక', 6, 1, 2, 1),
(4199, 'ఆధారంగా', 21, 2, 7, 1),
(4200, 'ఉంది', 12, 2, 4, 1),
(4201, 'పెద్ద', 15, 3, 5, 1),
(4202, 'వయస్సున్న', 27, 4, 9, 1),
(4203, 'వ్యక్తిది', 27, 4, 9, 1),
(4204, 'చనిపోవడానికి', 36, 2, 12, 1),
(4205, 'కొన్ని', 18, 4, 6, 1),
(4206, 'ముందే', 15, 3, 5, 1),
(4207, 'ఒక్కటి', 18, 3, 6, 1),
(4208, 'తప్ప', 12, 3, 4, 1),
(4209, 'పళ్ళన్నీ', 24, 4, 8, 1),
(4210, 'ఊడిపోయాయి', 27, 2, 9, 1),
(4211, 'స్థితిలో', 24, 4, 8, 1),
(4212, 'తోటివారు', 24, 2, 8, 1),
(4213, 'ఎవరూ', 12, 2, 4, 1),
(4214, 'ఆదుకోకపోతే', 30, 2, 10, 1),
(4215, 'జీవి', 12, 2, 4, 1),
(4216, 'తరబడి', 15, 2, 5, 1),
(4217, 'మనగలిగి', 21, 2, 7, 1),
(4218, 'ఉండేది', 18, 2, 6, 1),
(4219, 'అయితే', 15, 2, 5, 1),
(4220, 'తోటి', 12, 2, 4, 1),
(4221, 'వారి', 12, 2, 4, 1),
(4222, 'పట్ల', 12, 3, 4, 1),
(4223, 'ఆదరణ', 12, 1, 4, 1),
(4224, 'కలిగి', 15, 2, 5, 1),
(4225, 'ఉండేవారనేందుకు', 42, 3, 14, 1),
(4226, 'ఒక్క', 12, 3, 4, 1),
(4227, 'ఆధారం', 15, 2, 5, 1),
(4228, 'సరిపోదు', 21, 2, 7, 1),
(4229, 'గొంబే', 15, 3, 5, 1),
(4230, 'రిజర్వ్', 21, 4, 7, 1),
(4231, 'పక్షపాతం', 24, 3, 8, 1),
(4232, 'బారిన', 15, 2, 5, 1),
(4233, 'పడ్డ', 12, 3, 4, 1),
(4234, 'చింపాంజీ', 24, 3, 8, 1),
(4235, 'సహాయమూ', 18, 2, 6, 1),
(4236, 'లేకుండా', 21, 3, 7, 1),
(4237, 'పాటు', 12, 2, 4, 1),
(4238, 'జీవించిన', 24, 3, 8, 1),
(4239, 'ఉదంతం', 15, 2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `telugucount`
--

CREATE TABLE `telugucount` (
  `ch` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ch_count` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `telugucount`
--

INSERT INTO `telugucount` (`ch`, `ch_count`) VALUES
('పా', 3),
('త', 10),
('రా', 7),
('తి', 4),
('యు', 3),
('గం', 5),
('మ', 5),
('లి', 5),
('ద', 6),
('శ', 2),
('నుం', 3),
('డి', 6),
('ధ్య', 3),
('ౚ', 7),
('నా', 5),
('ళ్ళ', 3),
('వ', 15),
('ర', 15),
('కూ', 1),
('సు', 1),
('మా', 8),
('రు', 6),
('ల', 8),
('క్ష', 2),
('ఏ', 1),
('క్రి', 3),
('తా', 2),
('ని', 14),
('కి', 5),
('కీ', 3),
('న', 16),
('ఆ', 8),
('ఫ్రి', 1),
('కా', 4),
('రే', 2),
('షి', 2),
('యా', 6),
('పు', 2),
('వు', 2),
('హో', 1),
('మో', 1),
('జా', 3),
('వి', 9),
('స్త', 3),
('ణ', 4),
('లు', 9),
('జ', 4),
('రి', 9),
('గా', 3),
('యి', 5),
('క', 11),
('పి', 4),
('ప్రి', 1),
('ఫ్', 1),
('అ', 8),
('స్తా', 1),
('సే', 2),
('య', 6),
('న్స్', 1),
('రీ', 1),
('ర్మా', 1),
('ప', 6),
('ధు', 1),
('లో', 6),
('చి', 4),
('ఇ', 3),
('దీ', 1),
('వే', 2),
('న్ల', 1),
('సం', 7),
('త్స', 1),
('ప్రా', 1),
('భ', 1),
('మై', 2),
('ఉం', 8),
('డ', 3),
('చ్చు', 3),
('దా', 1),
('న్ని', 3),
('i', 2),
('వె', 1),
('డు', 1),
('గిం', 4),
('ది', 4),
('చై', 1),
('షాం', 3),
('గ్', 1),
('u', 1),
('2', 1),
('0', 1),
('1', 1),
('c', 1),
('చె', 4),
('న్', 1),
('ద్ద', 2),
('డే', 4),
('చే', 3),
('సి', 3),
('ద్వా', 1),
('న్నా', 3),
('ప్పు', 1),
('భిం', 2),
('త్యం', 1),
('స్థి', 2),
('శే', 2),
('ర్జి', 2),
('ద్మా', 1),
('ర్రె', 1),
('చా', 4),
('స్', 1),
('ర్గీ', 1),
('పీ', 2),
('ఞ', 2),
('రై', 1),
('స్వే', 1),
('చ్ఛా', 1),
('జ్ఞా', 1),
('ర్వ', 1),
('స్వ', 1),
('ము', 2),
('క్క', 2),
('దు', 5),
('న్న', 2),
('ర్పు', 2),
('య్య', 1),
('త్త', 1),
('ర్చ', 1),
('ప్ర', 1),
('స్తు', 1),
('తె', 1),
('గు', 1),
('వ్యా', 1),
('సా', 1),
('పూ', 1),
('ర్తి', 1),
('ణాం', 1),
('చూ', 1),
('వా', 3),
('ప్పేం', 1),
('కు', 3),
('ఒ', 2),
('ధా', 2),
('పె', 1),
('స్సు', 1),
('వ్య', 1),
('క్తి', 1),
('చ', 2),
('పో', 4),
('డా', 2),
('దే', 1),
('ప్ప', 1),
('న్నీ', 1),
('రూ', 1),
('కో', 1),
('తే', 2),
('జీ', 3),
('బ', 1),
('నేం', 1),
('బే', 1),
('ర్వ్', 1),
('బా', 1),
('డ్డ', 1),
('హా', 1),
('మూ', 1),
('లే', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pass` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `privilege` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_log_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `email`, `pass`, `privilege`, `last_log_in`, `token`, `active`, `notes`) VALUES
('SILC', 'admin', 'admin@silcmn.com', 'a045b7efa463c6ed195c644163f4168952fbd34a', 'admin', '2020-02-08 15:13:14', '000000a', 'yes', 'This is Default Admin; password 99999'),
('SILC', 'user2', 'user2@silcmn.com', 'a045b7efa463c6ed195c644163f4168952fbd34a', 'user', '2020-02-08 15:13:14', '000000a', 'yes', 'This is user2; password 99999'),
('SILC', 'user1', 'user1@silcmn.com', 'a045b7efa463c6ed195c644163f4168952fbd34a', 'user', '2020-02-08 19:51:39', '000000a', 'yes', 'This is user1; password 99999');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crawlurl`
--
ALTER TABLE `crawlurl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `english`
--
ALTER TABLE `english`
  ADD PRIMARY KEY (`en_id`);

--
-- Indexes for table `suggesturl`
--
ALTER TABLE `suggesturl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telugu`
--
ALTER TABLE `telugu`
  ADD PRIMARY KEY (`tel_id`);

--
-- Indexes for table `telugucount`
--
ALTER TABLE `telugucount`
  ADD PRIMARY KEY (`ch`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crawlurl`
--
ALTER TABLE `crawlurl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `english`
--
ALTER TABLE `english`
  MODIFY `en_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10661;

--
-- AUTO_INCREMENT for table `suggesturl`
--
ALTER TABLE `suggesturl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `telugu`
--
ALTER TABLE `telugu`
  MODIFY `tel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4240;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
