-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 24. Jun 2022 um 20:22
-- Server-Version: 8.0.29
-- PHP-Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hypaxnat_stmeisterei`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `applySystem`
--

CREATE TABLE `applySystem` (
  `id` int NOT NULL,
  `steamid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `applytext` text NOT NULL,
  `astatus` varchar(255) NOT NULL,
  `acomment` text,
  `auser` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `editedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `applySystem`
--

INSERT INTO `applySystem` (`id`, `steamid`, `name`, `age`, `applytext`, `astatus`, `acomment`, `auser`, `deleted`, `createdAt`, `editedAt`) VALUES
(2, '76561198039487781', 'Hans Carius', '090 5716727', 'Hans Carius\r\nSteile Gasse 38\r\n72424 Kessstein (Wiesberg)\r\nTel. 090 5716727\r\n\r\nKessstein, 10.06.2022\r\n\r\nAusbildung zum Strassenwärter bei der Strassenmeisterei Neuberg\r\n\r\n\r\nSehr geehrter Herr Castello,\r\n\r\nmein Name ist Hans Carius, ich bin am 18.05.1978 in Kessstein auf Wiesberg geboren und bin durch Ihren Firmenaushang im offiziellen Staatsforum auf die Straßenwacht Neuberg aufmerksam geworden.\r\n\r\nIch habe eine Ausbildung als Landschaftsgärtner gemacht und würde mich selbst als kleinen Tausendsassa bezeichnen. In den letzten sieben Jahren war ich in Schleswig-Holstein,sprich in Deutschland als Gärtner und auch als Hausmeister für ein Sanatorium mit mehreren Standorten tätig.\r\n\r\nIch bin erst seit knapp einer Woche wieder aus familiären Gründen aus dem Ausland zurück und würde mich freuen, wenn ich bei Ihnen zeitnah eine Ausbildung zum Straßenwärter beginnen kann.\r\n\r\nAktuell bin ich bei den Verkehrsbetrieben als Busfahrer auf der Linie 1 tätig, allerdings ist das für mich eher nur eine Übergangslösung, da mir diese Tätigkeit alleine als Fahrer zu eintönig und einsam ist.\r\n\r\nFür ein persönliches Gespräch stehe ich Ihnen jederzeit gerne zur Verfügung.\r\n\r\nMit freundlichen Grüßen,\r\nHans Carius', 'Angenommen', '', 'James van Price', NULL, '2022-06-09 22:07:58', NULL),
(4, '76561198161037729', 'John Payne', 'https://forum.realliferpg.de/user/9433-john-payne', 'Sehr geehrte Damen und Herren,\r\n\r\nHiermit bewerbe ich mich um eine Stelle bei der Straßenmeisterei Neuberg.\r\n\r\nMein Name ist John Payne und ich bin derzeit 22 Jahre alt und ich komme aus Großfelden. ich habe eine KFZ Mechaniker Ausbildung beim RAC absolviert und bin nun auf einer Jobsuche da ich Geld benötige um meine Fixkosten decken zu können. In meiner Freizeit aktuell verbringe ich gerne Zeit mit Freunden oder ich baue an meinem eigenen Haus weiter.  Zu meinen Stärken gehören die Teamfähigkeit sowie die Flexibilität. Ich würde mich gern über ein Gespräch freuen.\r\n\r\nMit freundlichen Grüßen\r\n\r\nJohn Payne', 'Angenommen', '', 'James van Price', NULL, '2022-06-11 02:06:11', NULL),
(5, '76561198357076709', 'Patrick Herrmann', 'Forum: https://forum.realliferpg.de/user/10466-paul-herrmann/     Ingame Tel: 0905064526', 'Moin, ich möchte gern bei euch anfangen', 'Angenommen', 'Ist nen Knecht ', 'Emilio Castellano', NULL, '2022-06-11 14:18:27', NULL),
(8, '76561198331699330', 'Lukas Brotz', 'https://forum.realliferpg.de/user/29443-lukas-brotz/ & 060 5194321', 'Sehr geehrte Damen und Herren,\r\n\r\nhiermit möchte ich mich als Mitarbeiter der Straßenmeisterei bewerben.\r\n\r\nAls erstes möchte ich mich vorstellen - mein Name ist Lukas Brotz, ich bin 19 Jahre alt und ich arbeite als Gärtner, werde aber ab 11.06.22 wieder verfügbar sein.\r\n\r\nIch möchte zur Straßenmeisterei um weiterhin meinen Arbeitsweg zu gehen, was gleichzeitig auch ein Hobby von mir ist.\r\n\r\nMeine Stärken sind meine Motivation und Qualifikation.\r\nAls Schwäche würde ich bezeichnen das ich sehr hartnäckig bin und nicht schnell aufgebe.\r\n\r\nZu einer Einladung zum Bewerbungsgespräch würde ich mich freuen.\r\n\r\nMit freundlichen Grüßen\r\nLukas Brotz', 'Abgelehnt', 'Guten Tag Herr Brotz,\r\nleider konnte Ihre Bewerbung uns nicht überzeugen. Gerne können Sie sich nach Ablauf von 14 Tagen erneut um eine Einstellung bemühen.\r\n\r\nSollten Sie noch weitere Fragen haben kommen Sie gerne persönlich auf mich/uns zu.', 'James van Price', NULL, '2022-06-11 18:37:36', NULL),
(9, '76561198331699330', 'Lukas Brotz', 'https://forum.realliferpg.de/user/29443-lukas-brotz/ & 060 5194321', 'Sehr geehrte Damen und Herren,\r\n\r\nhiermit möchte ich mich als Mitarbeiter der Straßenmeisterei bewerben.\r\n\r\nAls erstes möchte ich mich vorstellen - mein Name ist Lukas Brotz, ich bin 19 Jahre alt und ich arbeite als Gärtner, werde aber ab 11.06.22 wieder verfügbar sein.\r\n\r\nIch möchte zur Straßenmeisterei um weiterhin meinen Arbeitsweg zu gehen, was gleichzeitig auch ein Hobby von mir ist.\r\n\r\nMeine Stärken sind meine Motivation und Qualifikation.\r\nAls Schwäche würde ich bezeichnen das ich sehr hartnäckig bin und nicht schnell aufgebe.\r\n\r\nZu einer Einladung zum Bewerbungsgespräch würde ich mich freuen.\r\n\r\nMit freundlichen Grüßen\r\nLukas Brotz', 'Abgelehnt', 'Guten Tag Herr Brotz,\r\nleider konnte Ihre Bewerbung uns nicht überzeugen. Gerne können Sie sich nach Ablauf von 14 Tagen erneut um eine Einstellung bemühen.\r\n\r\nSollten Sie noch weitere Fragen haben kommen Sie gerne persönlich auf mich/uns zu.', 'James van Price', NULL, '2022-06-11 20:26:02', NULL),
(10, '76561198381274059', 'Friedrich Jäger ', 'Telefon: 060 6001435  Foren-Profiel: https://forum.realliferpg.de/user/30682-oebbkundenservice/', 'Sehr geehrte/r Leserin/Leser,  \r\n25.08.1998\r\nDas erste mal, als ich mit der Straßenmeisterei in Verbindung kam war an jenem Tag als ich eine ziemlich ramponierten Mann gesehen habe der eine umgefallenen Mauer, in nu Komma nix wieder aufgestellt hatte sowie sämtliche Straßenschilder und Laterne dazu.  Das erste was mir dabei in den Sinn gekommen war, war das ich das auch machen will. Warum ich dass, machen will ist einfach erklärt. Ich war schon immer sehr Öffentlich engagiert, neben dem ganzen Fähren und Taxi fahren kam auch das Busfahren dazu das ich oft und gerne getan habe. Aber das reicht mir nicht ich wollte schon immer eine Feste Anstellung die genau und diesen Bereichen der Öffentlichkeit was gutes tut, und dabei bin ich auf ihre Firma gestoßen und möchte mich bewerben. \r\n\r\nZu meinen Stärken zählt: \r\nEhrlichkeit,   \r\nbin nicht arbeitsfaul, wenn es etwas zu erledigen gibt wird es erledigt, \r\nEhrgeizig, \r\nkann gut mit Menschen und bin ein Teamplayer, \r\nVerlässlich, \r\n\r\nZu meinen Schwächen zählt:\r\nleicht reizbar wenn etwas nicht so läuft wies laufen soll, \r\nmache ungern etwas falsch und frage dann mehrere Male nach, \r\n\r\n\r\nLebenslauf:\r\n\r\n\r\nPersönliche Daten:\r\n\r\nName: Friedrich Jäger\r\nGeburtsdaten: 25.08.1998\r\nAdresse: Schulstraße 25a Großfelden\r\nTelefon: 060 6001435\r\nE-Mail: FriedrichJäger@wiesberg.com\r\n\r\nBerufserfahrung:\r\n2019-heute tätig als Busfahrer, Taxifahrer, Fährenfahrer und Bauprüfer\r\nals Bauprüfer mehrere Häuser überprüft ob die Qualität dieser gut ist und neue Pläne erstellt falls nötig war.\r\n\r\nAusbildung:\r\n2005-2008 Grundschule Kavala in Altis \r\n2008-2012 Mittelschule Athira in Altis\r\n2013 umzug nach Österreich 2013-2018 Absolvierung einer Höher Technische Bundes Versuchs und Lehranstalt für Bautechnik und Infrastruktur in Wien mit Abitur.   \r\n\r\nKenntnisse: \r\nFremdsprachen: Deutsch (Muttersprache), Englisch (größtenteils fließend), Griechisch (sehr eingerostet)\r\nIT-Kenntnisse: Microsoft-Office (sehr gut), Archicut (gut) \r\n\r\n\r\n\r\n\r\n\r\n', 'Angenommen', '', 'James van Price', NULL, '2022-06-11 21:14:10', NULL),
(13, '76561198354854604', 'Brigitte Nielsen', 'https://imgflip.com/i/6k3fj9', 'Ich bin Brigitte und ich bin auch dabei! (serious) Danke, vielen Dank, Danke!', 'Abgelehnt', '', 'Emilio Castellano', 1, '2022-06-18 14:35:57', NULL),
(17, '76561198275496175', 'Harald Richter JR', 'Forum https://forum.realliferpg.de/user/30470-harald-richter-jr/', 'Ich bin Harald Richter JR bin 26 Jahre jung und gerne als Arbeiter tätig ich möchte das die Stadt immer im schönsten Licht steht ohne umgefahrene Schilder Uvm. Bewerbung beim RAC ist in bearbeitung und bin bei BROT MfG. Richter JR', 'Bearbeitung', '', 'Emilio Castellano', NULL, '2022-06-21 12:14:29', NULL),
(18, '76561198283237346', 'Bombur de Moog', 'https://forum.realliferpg.de/user/3763-marcel-anderson/', 'Mein Name ist Bombur de Moog, ich komme aus Wiesberg und bin ein junger bestrebter Junge. Ich bin ein Arbeitstier - so sagen das gerne meine Freunde. Ich bin höflich, nett und bestrebt, meine Aufgaben gewissenhaft zu erfüllen. Ich freue mich auf ein cooles, spaßiges Team.  Mich bewegt es, unsere Straße sicherer zu machen. Das heißt, ich möchte der Gemeinde Wiesberg etwas bieten und zurückgeben. ', 'Angenommen', '', 'Emilio Castellano', NULL, '2022-06-22 16:07:17', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `BewerbungsLog`
--

CREATE TABLE `BewerbungsLog` (
  `id` int NOT NULL,
  `bewerbungsid` int NOT NULL,
  `action` text NOT NULL,
  `actionAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `BewerbungsLog`
--

INSERT INTO `BewerbungsLog` (`id`, `bewerbungsid`, `action`, `actionAt`) VALUES
(1, 1, 'Status geändert von <strong>Abgelehnt</strong> zu <strong>Bearbeitung</strong>.', '2022-06-09 16:53:54'),
(2, 1, 'Status geändert von <strong>Bearbeitung</strong> zu <strong>Abgelehnt</strong>.', '2022-06-09 17:00:49'),
(3, 1, 'Die Bemerkung wurde zu <strong>Goodby</strong> geändert.', '2022-06-09 17:00:49'),
(4, 1, 'Bearbeiter geändert von <strong>Emilio Castellano</strong> zu <strong>James van Price</strong>.', '2022-06-09 17:00:49'),
(5, 1, 'Die Bemerkung wurde zu <strong>Goodby\r\ndu kek</strong> geändert.', '2022-06-09 22:22:25'),
(6, 2, 'Status geändert von <strong>Abgelehnt</strong> zu <strong>Ungesehen</strong>.', '2022-06-09 22:22:46'),
(7, 2, 'Die Bemerkung wurde zu <strong></strong> geändert.', '2022-06-09 22:22:46'),
(8, 2, 'Bearbeiter geändert von <strong>James van Price</strong> zu <strong>-</strong>.', '2022-06-09 22:22:46'),
(9, 2, 'Status geändert von <strong>Bearbeitung</strong> zu <strong>Ungesehen</strong>.', '2022-06-09 22:25:20'),
(10, 2, 'Die Bemerkung wurde zu <strong></strong> geändert.', '2022-06-09 22:25:20'),
(11, 2, 'Bearbeiter geändert von <strong>test</strong> zu <strong>-</strong>.', '2022-06-09 22:25:20'),
(12, 2, 'Status geändert von <strong>Ungesehen</strong> zu <strong>Bearbeitung</strong>.', '2022-06-09 22:56:52'),
(13, 2, 'Die Bemerkung wurde zu <strong>Guten Tag Herr Carius,\r\nich bin zwar nicht Herr Castello, aber ich werde mich zeitnah um ihre Bewerbung kümmern.</strong> geändert.', '2022-06-09 22:56:52'),
(14, 2, 'Bearbeiter geändert von <strong>-</strong> zu <strong>James van Price</strong>.', '2022-06-09 22:56:52'),
(15, 1, 'Status geändert von <strong>Bearbeitung</strong> zu <strong>Ungesehen</strong>.', '2022-06-09 22:58:56'),
(16, 2, 'Status geändert von <strong>Bearbeitung</strong> zu <strong>Einladung</strong>.', '2022-06-09 23:03:06'),
(17, 1, 'Status geändert von <strong>Ungesehen</strong> zu <strong>Einladung</strong>.', '2022-06-09 23:04:33'),
(18, 3, 'Status geändert von <strong>Ungesehen</strong> zu <strong>Abgelehnt</strong>.', '2022-06-10 15:07:28'),
(19, 3, 'Die Bemerkung wurde zu <strong>Kek</strong> geändert.', '2022-06-10 15:07:28'),
(20, 3, 'Bearbeiter geändert von <strong></strong> zu <strong>Emilio Castellano</strong>.', '2022-06-10 15:07:28'),
(21, 1, 'Die Bemerkung wurde zu <strong>Test</strong> geändert.', '2022-06-10 15:24:08'),
(22, 1, 'Bearbeiter geändert von <strong>James van Price</strong> zu <strong>Test</strong>.', '2022-06-10 15:24:08'),
(23, 4, 'Status geändert von <strong>Ungesehen</strong> zu <strong>Bearbeitung</strong>.', '2022-06-11 12:26:02'),
(24, 4, 'Bearbeiter geändert von <strong></strong> zu <strong>Emilio Castellano</strong>.', '2022-06-11 12:26:02'),
(25, 5, 'Status geändert von <strong>Ungesehen</strong> zu <strong>Bearbeitung</strong>.', '2022-06-11 14:18:55'),
(26, 5, 'Der Bearbeiter wurde zu <strong>Emilio Castellano</strong> geändert.', '2022-06-11 14:18:55'),
(27, 5, 'Status geändert von <strong>Bearbeitung</strong> zu <strong>Angenommen</strong>.', '2022-06-11 14:34:49'),
(28, 5, 'Die Bemerkung wurde zu <strong>Ist nen Knecht </strong> geändert.', '2022-06-11 14:35:09'),
(29, 2, 'Status geändert von <strong>Einladung</strong> zu <strong>Angenommen</strong>.', '2022-06-11 17:23:34'),
(30, 2, 'Die Bemerkung wurde zu <strong></strong> geändert.', '2022-06-11 17:23:34'),
(31, 8, 'Status geändert von <strong>Ungesehen</strong> zu <strong>Bearbeitung</strong>.', '2022-06-11 18:42:32'),
(32, 8, 'Die Bemerkung wurde zu <strong>Wir sichten Ihre Bewerbung und melden uns zeitnah zurück.</strong> geändert.', '2022-06-11 18:42:32'),
(33, 8, 'Der Bearbeiter wurde zu <strong>James van Price</strong> geändert.', '2022-06-11 18:42:32'),
(34, 9, 'Status geändert von <strong>Ungesehen</strong> zu <strong>Bearbeitung</strong>.', '2022-06-11 21:59:15'),
(35, 9, 'Die Bemerkung wurde zu <strong>Wir sichten Ihre Bewerbung und melden uns zeitnah zurück.</strong> geändert.', '2022-06-11 21:59:15'),
(36, 9, 'Der Bearbeiter wurde zu <strong>James van Price</strong> geändert.', '2022-06-11 21:59:15'),
(37, 10, 'Status geändert von <strong>Ungesehen</strong> zu <strong>Bearbeitung</strong>.', '2022-06-11 21:59:50'),
(38, 10, 'Die Bemerkung wurde zu <strong>Wir sichten Ihre Bewerbung und melden uns zeitnah zurück.</strong> geändert.', '2022-06-11 21:59:50'),
(39, 10, 'Der Bearbeiter wurde zu <strong>James van Price</strong> geändert.', '2022-06-11 21:59:50'),
(40, 9, 'Status geändert von <strong>Bearbeitung</strong> zu <strong>Abgelehnt</strong>.', '2022-06-11 22:02:46'),
(41, 8, 'Status geändert von <strong>Bearbeitung</strong> zu <strong>Abgelehnt</strong>.', '2022-06-11 22:04:18'),
(42, 4, 'Status geändert von <strong>Bearbeitung</strong> zu <strong>Einladung</strong>.', '2022-06-12 10:35:02'),
(43, 4, 'Die Bemerkung wurde zu <strong>Guten Morgen, Mittag, Abend\r\n\r\nHiermit lade ich Sie herzlich zu einem kleinen Gespräch auf der Insel ein. Dazu müssen Sie einfach die 140 anrufen. Das Gespräch können Sie bei James Van Price oder Emilio Castellano machen.  </strong> geändert.', '2022-06-12 10:35:02'),
(44, 10, 'Status geändert von <strong>Bearbeitung</strong> zu <strong>Einladung</strong>.', '2022-06-12 10:35:23'),
(45, 10, 'Die Bemerkung wurde zu <strong>Guten Morgen, Mittag, Abend\r\n\r\nHiermit lade ich Sie herzlich zu einem kleinen Gespräch auf der Insel ein. Dazu müssen Sie einfach die 140 anrufen. Das Gespräch können Sie bei James Van Price oder Emilio Castellano machen.  </strong> geändert.', '2022-06-12 10:35:23'),
(46, 10, 'Der Bearbeiter wurde zu <strong>Emilio Castellano</strong> geändert.', '2022-06-12 10:35:23'),
(47, 10, 'Status geändert von <strong>Einladung</strong> zu <strong>Angenommen</strong>.', '2022-06-12 14:12:54'),
(48, 10, 'Die Bemerkung wurde zu <strong></strong> geändert.', '2022-06-12 14:12:54'),
(49, 4, 'Status geändert von <strong>Einladung</strong> zu <strong>Angenommen</strong>.', '2022-06-12 14:15:43'),
(50, 4, 'Die Bemerkung wurde zu <strong></strong> geändert.', '2022-06-12 14:15:43'),
(51, 4, 'Der Bearbeiter wurde zu <strong>James van Price</strong> geändert.', '2022-06-12 14:15:43'),
(52, 10, 'Der Bearbeiter wurde zu <strong>James van Price</strong> geändert.', '2022-06-12 14:15:55'),
(53, 11, 'Die Bemerkung wurde zu <strong>Henlo</strong> geändert.', '2022-06-16 22:08:41'),
(54, 11, 'Der Bearbeiter wurde zu <strong>James v. Price</strong> geändert.', '2022-06-16 22:08:41'),
(55, 11, 'Die Bemerkung wurde zu <strong>Sehr geehrter Herr Test,\r\n\r\nvielen Dank für Ihre Bewerbung.\r\n\r\n\r\nMit freundlichen Grüßen\r\n\r\n<strong>James van Price</strong>\r\nGeschäftsführung\r\nStraßenmeisterei Neuberg\r\n\r\n<img src=\"https://img.hypax.wtf/EmailSignatur_-_Kopie.jpg\" alt=\"Straßenmeisterei\">\r\n\r\n<strong>STRAßENMEISTEREI NEUBERG</strong>\r\nPersonal & Verwaltung\r\nAn der Bundesstraße 1\r\nNeuberg\r\n\r\nTel. 140\r\n\r\nDie Straßenmeisterei Neuberg ist ein Eigenbetrieb des Staates Wiesberg.</strong> geändert.', '2022-06-16 22:14:32'),
(56, 11, 'Die Bemerkung wurde zu <strong>Sehr geehrter Herr Test,\r\n\r\nvielen Dank für Ihre Bewerbung.\r\nWir werden uns zeitnah um diese kümmern.\r\n\r\n\r\nMit freundlichen Grüßen\r\n\r\n<strong>James van Price</strong>\r\nGeschäftsführung\r\nStraßenmeisterei Neuberg\r\n\r\n<img src=\"https://img.hypax.wtf/EmailSignatur_-_Kopie.jpg\" alt=\"Straßenmeisterei\">\r\n\r\n<strong>STRAßENMEISTEREI NEUBERG</strong>\r\nPersonal & Verwaltung\r\nAn der Bundesstraße 1\r\nNeuberg\r\n\r\nTel. 140\r\n\r\nDie Straßenmeisterei Neuberg ist ein Eigenbetrieb des Staates Wiesberg.</strong> geändert.', '2022-06-16 22:17:16'),
(57, 13, 'Status geändert von <strong>Ungesehen</strong> zu <strong>Bearbeitung</strong>.', '2022-06-18 16:35:28'),
(58, 13, 'Der Bearbeiter wurde zu <strong>Emilio Castellano</strong> geändert.', '2022-06-18 16:35:28'),
(59, 13, 'Status geändert von <strong>Bearbeitung</strong> zu <strong>Abgelehnt</strong>.', '2022-06-18 18:50:44'),
(60, 15, 'Status geändert von <strong>Ungesehen</strong> zu <strong>Bearbeitung</strong>.', '2022-06-20 01:35:14'),
(61, 15, 'Die Bemerkung wurde zu <strong>Klaro</strong> geändert.', '2022-06-20 01:35:14'),
(62, 15, 'Der Bearbeiter wurde zu <strong>James van Price</strong> geändert.', '2022-06-20 01:35:14'),
(63, 8, 'Der Status wurde durch James van Price von <strong>Abgelehnt</strong> zu <strong>Bearbeitung</strong> geändert.', '2022-06-21 20:06:40'),
(64, 8, 'Der Status wurde durch James van Price von <strong>Bearbeitung</strong> zu <strong>Abgelehnt</strong> geändert.', '2022-06-21 20:06:45'),
(65, 17, 'Der Status wurde durch Emilio Castellano von <strong>Ungesehen</strong> zu <strong>Bearbeitung</strong> geändert.', '2022-06-22 15:24:39'),
(66, 17, 'Der Bearbeiter wurde von  zu <strong>Emilio Castellano</strong> geändert.', '2022-06-22 15:24:39'),
(67, 18, 'Der Status wurde durch Emilio Castellano von <strong>Ungesehen</strong> zu <strong>Bearbeitung</strong> geändert.', '2022-06-22 16:08:17'),
(68, 18, 'Der Bearbeiter wurde von  zu <strong>Emilio Castellano</strong> geändert.', '2022-06-22 16:08:17'),
(69, 18, 'Der Status wurde durch Emilio Castellano von <strong>Bearbeitung</strong> zu <strong>Abgelehnt</strong> geändert.', '2022-06-22 16:15:21'),
(70, 18, 'Der Status wurde durch Emilio Castellano von <strong>Abgelehnt</strong> zu <strong>Angenommen</strong> geändert.', '2022-06-22 16:15:29'),
(71, 18, 'Der Status wurde durch Emilio Castellano von <strong>Angenommen</strong> zu <strong>Ungesehen</strong> geändert.', '2022-06-22 16:15:41'),
(72, 18, 'Der Status wurde durch Emilio Castellano von <strong>Ungesehen</strong> zu <strong>Angenommen</strong> geändert.', '2022-06-22 16:15:46');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `memberComments`
--

CREATE TABLE `memberComments` (
  `id` int NOT NULL,
  `mitarbeiterid` int NOT NULL,
  `kommentartext` text NOT NULL,
  `kommentarart` varchar(255) NOT NULL,
  `commentAt` datetime NOT NULL,
  `commentUser` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `memberComments`
--

INSERT INTO `memberComments` (`id`, `mitarbeiterid`, `kommentartext`, `kommentarart`, `commentAt`, `commentUser`) VALUES
(5, 12, 'Polizei', 'Allgemein', '2022-06-11 12:13:42', NULL),
(6, 14, 'Rettungsdienst', 'Allgemein', '2022-06-11 12:13:59', NULL),
(7, 3, '191.740 $ an Gehalt durch Emilio Castellano ausgezahlt.', 'Gehalt', '2022-06-11 12:35:06', NULL),
(8, 19, '42.960 $ an Gehalt durch Emilio Castellano ausgezahlt.', 'Gehalt', '2022-06-11 12:35:54', NULL),
(9, 20, '159.848 $ an Gehalt durch Emilio Castellano ausgezahlt.', 'Gehalt', '2022-06-11 12:36:30', NULL),
(10, 17, '192.152 $ an Gehalt durch Emilio Castellano ausgezahlt.', 'Gehalt', '2022-06-11 12:36:49', NULL),
(12, 8, '65.000 $ an Gehalt durch Emilio Castellano ausgezahlt.', 'Allgemein', '2022-06-11 12:38:13', NULL),
(15, 28, 'Ehemaliger Mitarbeiter der Straßenmeisterei Fisk.', 'Allgemein', '2022-06-11 18:04:55', NULL),
(16, 29, 'Ehemaliger Mitarbeiter der Straßenmeisterei Fisk.', 'Allgemein', '2022-06-11 18:05:38', NULL),
(17, 28, 'Rettungsdienst', 'Allgemein', '2022-06-11 18:15:02', NULL),
(18, 29, 'Rettungsdienst', 'Allgemein', '2022-06-11 18:15:13', NULL),
(20, 20, 'Mitglied der Ausbildungsabteilung.', 'Allgemein', '2022-06-12 14:17:41', NULL),
(22, 28, 'Geier nach 1 Matrix direkt!', 'Gehalt', '2022-06-12 21:56:12', NULL),
(23, 20, 'Rettungsdienst', 'Allgemein', '2022-06-14 12:31:10', NULL),
(24, 25, 'Justiz', 'Allgemein', '2022-06-14 20:41:15', NULL),
(29, 23, 'Iban!', 'Allgemein', '2022-06-18 03:58:33', NULL),
(30, 25, 'Iban', 'Allgemein', '2022-06-18 03:59:55', NULL),
(31, 26, 'Iban', 'Allgemein', '2022-06-18 04:00:42', NULL),
(32, 27, 'Iban', 'Allgemein', '2022-06-18 04:01:24', NULL),
(33, 32, 'Iban', 'Allgemein', '2022-06-18 04:02:41', NULL),
(34, 13, 'Iban', 'Allgemein', '2022-06-18 04:03:27', NULL),
(35, 14, 'Iban', 'Allgemein', '2022-06-18 04:04:39', NULL),
(36, 29, 'Iban', 'Allgemein', '2022-06-18 04:05:39', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `memberManagement`
--

CREATE TABLE `memberManagement` (
  `id` int NOT NULL,
  `spitzname` varchar(255) NOT NULL,
  `icname` varchar(255) NOT NULL,
  `dienstgrad` varchar(255) NOT NULL,
  `beitritt` date NOT NULL,
  `telnr` varchar(255) DEFAULT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `laufstieg` datetime DEFAULT NULL,
  `gehalt` varchar(255) DEFAULT NULL,
  `notiz` text,
  `deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `memberManagement`
--

INSERT INTO `memberManagement` (`id`, `spitzname`, `icname`, `dienstgrad`, `beitritt`, `telnr`, `iban`, `laufstieg`, `gehalt`, `notiz`, `deleted`) VALUES
(3, 'Hypax', 'James van Price', 'Geschäftsführer', '2022-05-28', '020 5635793', 'NH167145', '0000-00-00 00:00:00', '', 'test 123', NULL),
(8, 'Marco', 'Emilio Castellano', 'Geschäftsführer', '2021-10-27', '040 3088239', 'NH333037', '0000-00-00 00:00:00', '', '', NULL),
(9, 'Hulk', 'Costa Prado', 'Geschäftsführer', '2022-01-01', '', '', '0000-00-00 00:00:00', '', '', NULL),
(10, 'Simone/Shellby', 'Simon Schmidt', 'Vorstand', '2022-01-01', '', '', '0000-00-00 00:00:00', '', '', NULL),
(11, '-', 'Nicole Wolf', 'Vorstand', '2022-01-01', '', '', '0000-00-00 00:00:00', '', '', NULL),
(12, 'Pinsel', 'Mikey Wells', 'Straßenmeister', '2022-05-31', '', 'NH734831', '0000-00-00 00:00:00', '', 'Polizei', NULL),
(13, 'Seeber', 'Dr. Julius Seeber', 'Kolonnenführer', '2022-05-30', '', 'NH555820', '0000-00-00 00:00:00', '', 'Iban', NULL),
(14, 'Richter', 'Niklas Richter', 'Straßenwärter', '2022-05-30', '', 'NH024573', '0000-00-00 00:00:00', '', 'Iban', NULL),
(15, 'Depri Petri', 'Philip Payton', 'Straßenwärter', '2022-06-01', '', '', '0000-00-00 00:00:00', '', '', NULL),
(16, 'Hain Brenner', 'Samuel Brenner', 'Straßenwärter', '2022-05-30', '060 4876405', '', '0000-00-00 00:00:00', '', '', NULL),
(17, '.', 'Jonathan Görke', 'Straßenwärter', '2022-06-06', '', 'NH053681', '0000-00-00 00:00:00', '', '', NULL),
(19, '.', 'Alexander Jacobs', 'Straßenwärter', '2022-06-06', '', 'NH378536', '0000-00-00 00:00:00', '', '', NULL),
(20, 'DeadEvl', 'Nico Johnson', 'Straßenwärter', '2022-06-06', '040 6407029', 'NH210838', '0000-00-00 00:00:00', '', 'Rettungsdienst', NULL),
(22, '-', 'Karl May', 'Praktikant', '2022-06-08', '', '', '0000-00-00 00:00:00', '', '', 1),
(23, '-', 'Rafael Rotermund', 'Auszubildender', '2022-06-10', '', 'NH949932', '0000-00-00 00:00:00', '', 'Iban!', NULL),
(24, '-', 'Test', 'Straßenmeister', '2012-01-01', '', '', '0000-00-00 00:00:00', '', 'TschüssHallod', 1),
(25, '-', 'Patrick Herrmann', 'Auszubildender', '2022-06-11', '090 5064526', 'NH439287', '0000-00-00 00:00:00', '', 'Iban', NULL),
(26, '-', 'Hans Carius', 'Auszubildender', '2022-06-11', '090 5716727', 'NH957496', '0000-00-00 00:00:00', '', 'Iban', NULL),
(27, '-', 'Thomas Sindera', 'Straßenwärter', '2022-06-11', '', 'NH275791', '0000-00-00 00:00:00', '', 'test 1234', NULL),
(28, '-', 'Fabian Theiss', 'Straßenmeister', '2022-06-11', '', 'NH331218', '0000-00-00 00:00:00', '', '', NULL),
(29, '-', 'Niclas Jackson', 'Straßenmeister', '2022-06-11', '', 'NH504931', '0000-00-00 00:00:00', '', 'Iban', NULL),
(30, '-', 'Hans Günter', 'Auszubildender', '2022-06-06', '', '', '0000-00-00 00:00:00', '', '', NULL),
(31, '-', 'Friedrich Jäger', 'Auszubildender', '2022-06-12', '060 6001435', 'NH483117', '0000-00-00 00:00:00', '', '', NULL),
(32, '-', 'John Payne', 'Auszubildender', '2022-06-12', '', 'NH186635', '0000-00-00 00:00:00', '', 'Iban', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `OldPlaytimes`
--

CREATE TABLE `OldPlaytimes` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `playtime` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `panelUsers`
--

CREATE TABLE `panelUsers` (
  `id` int NOT NULL,
  `steamid` varchar(255) NOT NULL,
  `rpname` varchar(255) DEFAULT NULL,
  `regAt` datetime NOT NULL,
  `permLevel` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `panelUsers`
--

INSERT INTO `panelUsers` (`id`, `steamid`, `rpname`, `regAt`, `permLevel`) VALUES
(1, '76561198177423823', 'James van Price', '2022-06-20 00:06:50', 4),
(2, '76561198110429932', 'Testi Test', '2022-06-20 01:32:47', 0),
(4, '76561198301210949', 'Emilio Castellano', '2022-06-20 21:53:00', 4),
(6, '76561198275496175', 'Harald Richter JR', '2022-06-21 12:11:30', 0),
(7, '76561198217620717', NULL, '2022-06-21 13:51:14', 0),
(8, '76561198047268102', NULL, '2022-06-21 15:06:33', 0),
(9, '76561198135723637', 'Roman Private', '2022-06-21 20:55:10', 0),
(10, '76561198229493460', NULL, '2022-06-21 22:21:02', 0),
(11, '76561198271296975', 'Joachim Günther', '2022-06-22 13:15:11', 0),
(12, '76561198073236987', NULL, '2022-06-22 13:16:58', 0),
(13, '76561198091182707', NULL, '2022-06-22 13:17:22', 0),
(14, '76561198283237346', 'Bombur de Moog', '2022-06-22 15:57:33', 0),
(15, '76561198094663051', 'Robert Jäger', '2022-06-22 16:02:13', 0),
(18, '76561198052325334', 'Gerd Knattermann', '2022-06-24 06:30:47', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rankLog`
--

CREATE TABLE `rankLog` (
  `id` int NOT NULL,
  `mitarbeiterid` int NOT NULL,
  `newRank` varchar(255) NOT NULL,
  `rankAt` datetime NOT NULL,
  `changedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `rankLog`
--

INSERT INTO `rankLog` (`id`, `mitarbeiterid`, `newRank`, `rankAt`, `changedBy`) VALUES
(1, 24, 'Straßenmeister', '2022-06-11 12:01:50', NULL),
(2, 28, 'Straßenmeister', '2022-06-11 18:08:37', NULL),
(3, 29, 'Straßenmeister', '2022-06-11 18:08:46', NULL),
(4, 17, 'Straßenwärter', '2022-06-12 14:14:12', NULL),
(5, 8, 'Praktikant', '2022-06-17 22:27:10', NULL),
(6, 8, 'Geschäftsführer', '2022-06-17 22:27:18', NULL),
(7, 27, 'Straßenwärter', '2022-06-19 18:24:01', NULL),
(8, 3, 'Vorstand', '2022-06-21 20:05:13', 'James van Price'),
(9, 3, 'Geschäftsführer', '2022-06-21 20:05:20', 'James van Price');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `UserPlaytimes`
--

CREATE TABLE `UserPlaytimes` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `playtime` bigint NOT NULL,
  `online` tinyint(1) NOT NULL,
  `server` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Daten für Tabelle `UserPlaytimes`
--

INSERT INTO `UserPlaytimes` (`id`, `name`, `playtime`, `online`, `server`, `createdAt`, `updatedAt`) VALUES
(1, '[ST] James van Price', 494, 0, NULL, '2022-05-31 12:10:00', '2022-06-24 18:06:00'),
(2, '[ST] Samuel Brenner', 0, 0, NULL, '2022-06-04 14:40:00', '2022-06-04 15:11:00'),
(3, '[ST] Test', 0, 0, NULL, '2022-06-06 02:32:15', '2022-06-06 02:32:15'),
(5, '[ST] Alexander Jacobs', 365, 0, NULL, '2022-06-06 13:52:00', '2022-06-23 18:07:00'),
(6, '[ST] Hans Günter', 0, 0, NULL, '2022-06-06 13:54:00', '2022-06-08 14:54:00'),
(8, '[ST] Nico Johnson', 34, 1, 'RealLifeRPG 9.0 Server 1', '2022-06-06 15:44:00', '2022-06-23 21:17:00'),
(9, '[ST]Jonathan Görke', 0, 0, NULL, '2022-06-06 16:11:00', '2022-06-09 21:53:00'),
(10, '[ST] Mikey Wells', 0, 0, NULL, '2022-06-09 01:13:00', '2022-06-16 01:49:00'),
(11, '[ST] Emilio Castellano', 0, 0, NULL, '2022-06-09 20:08:00', '2022-06-16 15:58:00'),
(12, '[ST] Rafael Rotermund', 297, 0, NULL, '2022-06-11 11:30:00', '2022-06-22 21:54:00'),
(13, '[ST] Patrick Herrmann', 0, 0, NULL, '2022-06-11 16:14:00', '2022-06-17 13:12:00'),
(14, '[ST] Hans Carius', 269, 0, NULL, '2022-06-11 18:13:00', '2022-06-22 20:58:00'),
(15, '[ST] Thomas Sindera', 332, 0, NULL, '2022-06-11 18:19:00', '2022-06-22 19:07:00'),
(16, '[ST] Fabian Theiss', 0, 0, NULL, '2022-06-16 01:06:00', '2022-06-16 03:21:00'),
(17, '[ST] Friedrich Jäger', 0, 0, NULL, '2022-06-16 18:57:00', '2022-06-16 21:06:00'),
(18, '[ST] Costa Prado', 0, 0, NULL, '2022-06-17 08:35:00', '2022-06-20 17:57:00');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `applySystem`
--
ALTER TABLE `applySystem`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `BewerbungsLog`
--
ALTER TABLE `BewerbungsLog`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `memberComments`
--
ALTER TABLE `memberComments`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `memberManagement`
--
ALTER TABLE `memberManagement`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `OldPlaytimes`
--
ALTER TABLE `OldPlaytimes`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `panelUsers`
--
ALTER TABLE `panelUsers`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `rankLog`
--
ALTER TABLE `rankLog`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `UserPlaytimes`
--
ALTER TABLE `UserPlaytimes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `applySystem`
--
ALTER TABLE `applySystem`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `BewerbungsLog`
--
ALTER TABLE `BewerbungsLog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT für Tabelle `memberComments`
--
ALTER TABLE `memberComments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT für Tabelle `memberManagement`
--
ALTER TABLE `memberManagement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT für Tabelle `OldPlaytimes`
--
ALTER TABLE `OldPlaytimes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `panelUsers`
--
ALTER TABLE `panelUsers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `rankLog`
--
ALTER TABLE `rankLog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `UserPlaytimes`
--
ALTER TABLE `UserPlaytimes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
