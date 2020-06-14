-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 15 Ιουν 2020 στις 00:58:34
-- Έκδοση διακομιστή: 10.4.11-MariaDB
-- Έκδοση PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `cloup`
--
CREATE DATABASE IF NOT EXISTS `cloup` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cloup`;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `address_ergazomenou`
--

CREATE TABLE `address_ergazomenou` (
  `odos` varchar(45) DEFAULT NULL,
  `arithmos` varchar(5) DEFAULT NULL,
  `polh` varchar(45) DEFAULT NULL,
  `zip_code` int(10) DEFAULT NULL,
  `kwd_ergazomenou_adr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `address_ergazomenou`
--

INSERT INTO `address_ergazomenou` (`odos`, `arithmos`, `polh`, `zip_code`, `kwd_ergazomenou_adr`) VALUES
('kanari', '15', 'athina', 13254, 1),
('mini', '12', 'paro', 12340, 2),
('mitsiou', '32', 'tirana', 18742, 3),
('pasbadis', '32', 'tirana', 82391, 4),
('konrdi', '11', 'mikonos', 12942, 5),
('karais', '6', 'thesaloniki', 21875, 6),
('mitrio', '9', 'larisa', 53753, 7),
('rodou', '48', 'petralona', 89237, 8),
('profiti', '14', 'athina', 14736, 9),
('thodou', '26', 'tirana', 12984, 10),
('staurou', '66', 'rodos', 23215, 11),
('minou', '9', 'rethimno', 12386, 12),
('stauropoulou', '99', 'ioaninna', 12353, 13),
('Sonos', '216', 'athina', 17477, 50);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `credentials`
--

CREATE TABLE `credentials` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kwd_ergazom_cred` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `credentials`
--

INSERT INTO `credentials` (`username`, `password`, `kwd_ergazom_cred`) VALUES
('giannis', 'karaiskos', 1),
('andreas', 'geldis', 2),
('harris', 'vassilakopoulos', 3),
('oresths', 'papaemmanouhl', 4),
('manan', 'abdul', 5),
('ioannis', 'morakos', 6),
('grigoris', 'mastoras', 7),
('giannhs', 'sfendylakis', 8),
('alexandros', 'kalogiannakis', 9),
('mixalhs', 'viskadourakhs', 10),
('tasos', 'skordilakis', 11),
('konstantinos', 'lolos', 12),
('antonis', 'thodos', 13),
('basilhs', 'papadas', 50),
('0', '0', 68);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `ekpaideysh`
--

CREATE TABLE `ekpaideysh` (
  `kwd_ptyxio` int(11) NOT NULL,
  `per_ptyxiou` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `ekpaideysh`
--

INSERT INTO `ekpaideysh` (`kwd_ptyxio`, `per_ptyxiou`) VALUES
(1, 'ECPE English'),
(2, 'GERX GERXEDU'),
(3, 'TTRI Ttriedu'),
(4, 'MLTR mltrspanish '),
(5, 'ERT erttv'),
(6, 'NOCA nocacaffee'),
(7, 'CPIR cpirrr'),
(8, 'PEPA pepathepig'),
(9, 'PPP peepeeepeeee'),
(10, 'SXET sxetikaakuro');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `eksartomenos`
--

CREATE TABLE `eksartomenos` (
  `AMKA_eksart` int(11) NOT NULL,
  `Onoma_eksart` varchar(45) DEFAULT NULL,
  `Eponymo_eksart` varchar(45) DEFAULT NULL,
  `DOB_eksart` date DEFAULT NULL,
  `Fylo_eksart` varchar(1) DEFAULT NULL,
  `kod_prostati` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `eksartomenos`
--

INSERT INTO `eksartomenos` (`AMKA_eksart`, `Onoma_eksart`, `Eponymo_eksart`, `DOB_eksart`, `Fylo_eksart`, `kod_prostati`) VALUES
(123, 'a', 'a', '0001-01-01', 'F', 68),
(124532, 'Alikh', 'Papada', '2020-06-08', 'F', 50),
(1111789, 'Anastasios', 'Papadas', '2020-06-30', 'M', 50),
(1182940209, 'makakis', 'piou', '2019-08-05', 'F', 11),
(1234567891, 'dimitris', 'dimitriou', '2018-02-05', 'M', 1),
(1242497697, 'takis', 'papakis', '2019-12-17', 'M', 9),
(1249023918, 'athonis', 'thodos', '2020-01-12', 'F', 10),
(1254121239, 'viki', 'nomikou', '2019-08-05', 'M', 8),
(1254125234, 'maria', 'kalou', '2020-01-12', 'M', 13),
(1258241241, 'makis', 'karaiskou', '2019-08-12', 'F', 7),
(1284723242, 'marios', 'mariou', '2019-08-12', 'F', 3),
(1421243216, 'dimitgis', 'katsa', '2019-10-14', 'F', 6),
(1423321211, 'giorgos', 'pasvantis', '2019-08-05', 'F', 2),
(1521322112, 'nikos', 'calathis', '2019-12-08', 'F', 12),
(1824912336, 'anastasia', 'pasvanti', '2019-06-17', 'M', 5),
(1984726321, 'giannis', 'giannou', '2019-07-21', 'M', 4);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `epimorfosh`
--

CREATE TABLE `epimorfosh` (
  `ekpaideyomenos` int(11) DEFAULT NULL,
  `eidikeysh` int(11) DEFAULT NULL,
  `date_apokthshs` date DEFAULT NULL,
  `vathmos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `epimorfosh`
--

INSERT INTO `epimorfosh` (`ekpaideyomenos`, `eidikeysh`, `date_apokthshs`, `vathmos`) VALUES
(5, 7, '2020-06-02', 10),
(5, 5, '2020-06-23', 9),
(9, 3, '2020-06-15', 7),
(1, 2, '2020-06-30', 10),
(1, 8, '2020-06-18', 8),
(12, 6, '2020-06-05', 9),
(7, 3, '2020-06-16', 10),
(6, 4, '2020-06-14', 8),
(4, 6, '2020-06-13', 7),
(8, 9, '2020-06-25', 9),
(11, 2, '2020-06-14', 6),
(13, 4, '2020-06-05', 10),
(13, 7, '2020-06-11', 10),
(13, 10, '2020-06-17', 9),
(3, 7, '2020-06-16', 9),
(10, 1, '2020-06-17', 9),
(50, 1, '2020-06-16', 10),
(50, 6, '2020-06-29', 10);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `ergazomenoi_se_erga`
--

CREATE TABLE `ergazomenoi_se_erga` (
  `kwd_ergou` int(11) DEFAULT NULL,
  `kwd_ergazom_ergo` int(11) DEFAULT NULL,
  `assigned_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `ergazomenoi_se_erga`
--

INSERT INTO `ergazomenoi_se_erga` (`kwd_ergou`, `kwd_ergazom_ergo`, `assigned_id`) VALUES
(1, 2, 2),
(18, 6, 3),
(19, 9, 4),
(13, 11, 5),
(11, 7, 6),
(12, 11, 7),
(1, 1, 8),
(15, 5, 9),
(19, 6, 10),
(7, 13, 11),
(20, 13, 12),
(11, 7, 13),
(13, 50, 15),
(1, 5, 16);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `ergazomenos`
--

CREATE TABLE `ergazomenos` (
  `kwd_ergazomenou` int(11) NOT NULL,
  `Eponymo_ergazom` varchar(45) DEFAULT NULL,
  `Onoma_Ergazom` varchar(45) DEFAULT NULL,
  `Patronymo_Ergazom` varchar(45) DEFAULT NULL,
  `Fyllo_Ergaz` varchar(1) DEFAULT NULL,
  `AFM_Ergaz` int(10) DEFAULT NULL,
  `DOB_Ergazom` date DEFAULT NULL,
  `Tel_Ergaz` int(15) DEFAULT NULL,
  `Salary_Ergazom` double DEFAULT NULL,
  `Kod_tm_ergazom` int(11) DEFAULT NULL,
  `user_type_ergazom` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `ergazomenos`
--

INSERT INTO `ergazomenos` (`kwd_ergazomenou`, `Eponymo_ergazom`, `Onoma_Ergazom`, `Patronymo_Ergazom`, `Fyllo_Ergaz`, `AFM_Ergaz`, `DOB_Ergazom`, `Tel_Ergaz`, `Salary_Ergazom`, `Kod_tm_ergazom`, `user_type_ergazom`) VALUES
(1, 'KARAISKOS', 'GIANNIS', 'KARAISKOS', 'A', 111111111, '2020-05-08', 691111111, 1200, 1, 1),
(2, 'GELDIS', 'ANDREAS', 'GELDIS', 'M', 111111112, '2010-06-14', 691111112, 900, 2, 2),
(3, 'VASSILAKOPOULOS', 'HARRIS', 'VASSILAKOPOULOS', 'M', 111111113, '2015-06-27', 691111113, 200, 3, 2),
(4, 'PAPAEMMANOUHL', 'ORESTHS', 'PAPAEMMANOUHL', 'M', 111111114, '2000-06-26', 691111114, 800, 4, 2),
(5, 'ABDUL', 'MANAN', 'ABDUL', 'M', 111111115, '1980-06-26', 691111115, 850, 5, 2),
(6, 'MORAKOS', 'IOANNIS', 'MORAKOS', 'M', 111111116, '2015-06-25', 691111116, 750, 6, 2),
(7, 'MASTORAS', 'GRIGORIS', 'MASTORAS', 'M', 111111117, '1992-06-24', 691111117, 600, 7, 2),
(8, 'SFENDYLAKIS', 'GIANNIS', 'SFENDYLAKIS', 'M', 111111118, '2000-06-23', 691111118, 1650, 8, 2),
(9, 'KALOGIANNAKIS', 'ALEXANDROS', 'KALOGIANNAKIS', 'M', 111111119, '2000-06-16', 691111119, 1000, 9, 2),
(10, 'VISKADOURAKHS', 'MIXALIS', 'VISKADOURAKHS', 'M', 111111120, '2020-06-01', 691111120, 360, 10, 2),
(11, 'SKORDILAKIS', 'TASOS', 'SKORDILAKIS', 'M', 111111124, '2019-11-13', 691111124, 1500, 11, 2),
(12, 'LOLOS', 'KONSTANTINOS', 'LOLOS', 'M', 111111123, '2001-09-10', 691111123, 740, 12, 1),
(13, 'THODOS', 'ANTONIS', 'THODOS', 'M', 111111130, '1999-03-19', 691111129, 2150, 13, 1),
(50, 'Papadas', 'Vasileios', 'Anastasios', 'M', 12129898, '2020-06-02', 7809654, 1500, 9, 1),
(68, 'Garage', 'Car', 'a', 'M', 0, '0001-01-01', 0, 0, 13, 2);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `ergo`
--

CREATE TABLE `ergo` (
  `kwd_ergou` int(11) NOT NULL,
  `perigrafh_ergou` varchar(255) DEFAULT NULL,
  `finish_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `ergo`
--

INSERT INTO `ergo` (`kwd_ergou`, `perigrafh_ergou`, `finish_date`, `start_date`) VALUES
(1, 'Eshop Zaxaroplasteioy', '2020-07-11', '2019-12-03'),
(2, 'εξοπλισμός ιδιωτικού σχολείου Ψυχικού  με ηλεκτρονικούς υπολογιστές', '2020-05-14', '2020-06-03'),
(3, 'ανάπτυξη εφαρμογής για το δικηγορικό γραφείο του Καιμακάμη', NULL, '2020-05-27'),
(4, 'διαφήμιση για το νέο μοντέλο κινητού AL2020', '2020-06-01', '2020-06-10'),
(5, 'επίλυση του προβλήματος σύνδεσης στο δίκτυο των ορόφων 4 και 5', NULL, '2020-06-18'),
(6, 'παρουσίαση των νέων υπηρεσιών σε παλιούς πελάτες', '2020-07-01', '2020-07-22'),
(7, 'κατωχήρωση νέων εμπορικών σημάτων ', '2020-06-12', '2020-06-25'),
(8, 'κάστινκ μοντέλων για διαφημιστικό ', '2020-07-02', '2020-07-23'),
(9, 'διαγωνισμός για εφαρμογή του υπουργείου παιδείας ', '2020-08-06', '2020-08-19'),
(10, 'εξοπλισμός διαδραστικής τάξης για φροντιστήρια αγγλικών ', '2020-09-02', '2020-09-23'),
(11, 'Εγκατάσταση δικτύου Περισσός', '0000-00-00', '2017-02-09'),
(12, 'Ανάπτυξη εφαρμογών ιατρικής', '0000-00-00', '2018-11-11'),
(13, 'Σχεδίαση ΒΔ εμπορικού κέντρου', '0000-00-00', '2019-01-13'),
(14, 'Διαδραστικά παιχνίδια για παιδιά', '0000-00-00', '2013-08-16'),
(15, 'Αναζήτηση νέων προγραμματιστών', '0000-00-00', '2014-08-12'),
(16, 'Αναζήτηση νέων προγραμματιστών', '0000-00-00', '2013-06-19'),
(17, 'Αναζήτηση νέων προγραμματιστών', '0000-00-00', '2012-03-10'),
(18, 'Αναζήτηση νέων προγραμματιστών', '0000-00-00', '2020-02-24'),
(19, 'Σεμινάριο JavaScript προγραμματιστών', '0000-00-00', '2009-05-13'),
(20, 'Εκπαίδευση Αστροναυτών', '0000-00-00', '2020-05-13'),
(21, 'Αναζήτηση νέων ηλεκτρολόγων', '0000-00-00', '2020-05-13');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `oxhma`
--

CREATE TABLE `oxhma` (
  `ar_kykloforias` varchar(10) NOT NULL,
  `xroma_oxhm` varchar(45) DEFAULT NULL,
  `montelo_oxhm` varchar(45) DEFAULT NULL,
  `marka_oxhm` varchar(45) DEFAULT NULL,
  `odhgos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `oxhma`
--

INSERT INTO `oxhma` (`ar_kykloforias`, `xroma_oxhm`, `montelo_oxhm`, `marka_oxhm`, `odhgos`) VALUES
('aaa1111', '1b', '1b', '1a', 68),
('DFP7428 ', 'Red ', 'C1', 'Citroen ', 11),
('DME1002 ', 'White ', 'TurboIQLXT', 'Polaris ', 12),
('EBF9239 ', 'Silver ', '3EX', 'Mazda ', 13),
('FJJ6997 ', 'White ', 'ETV1000', 'APRILIA ', 10),
('FTF8713 ', 'Silver ', 'Yaris', 'Toyota ', 9),
('HIT9200 ', 'Black ', 'Cayenne', 'Porsche ', 8),
('HIU4501 ', 'White ', 'i8', 'BMW ', 7),
('HZJ3939 ', 'White ', 'X4', 'BMW ', 6),
('ION3455 ', 'Black ', 'Civic', 'Honda ', 5),
('IQI3497 ', 'Black ', 'YFM350', 'Yamaha ', 4),
('MHT1234 ', 'Black ', 'Polo', 'Volkswagen ', 3),
('OMN3476 ', 'Black ', 'Multipla', 'Fiat ', 2),
('PAP1363 ', 'Green ', 'Focus', 'Ford ', 1),
('yzm5005', 'cC', 'Bravo', 'Fiat', 50);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `syzygos`
--

CREATE TABLE `syzygos` (
  `AMKA_syzygou` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `syzygos`
--

INSERT INTO `syzygos` (`AMKA_syzygou`) VALUES
(123),
(1242497697),
(1254121239),
(1254125234),
(1423321211),
(1824912336);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tekno`
--

CREATE TABLE `tekno` (
  `AMKA_teknou` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `tekno`
--

INSERT INTO `tekno` (`AMKA_teknou`) VALUES
(124532),
(1111789),
(1234567891),
(1249023918),
(1284723242),
(1421243216),
(1521322112),
(1824912336),
(1984726321);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tmhma`
--

CREATE TABLE `tmhma` (
  `kwd_tmhmatos` int(11) NOT NULL,
  `onoma_tmhmatos` varchar(45) DEFAULT NULL,
  `kwd_proistamenou` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `tmhma`
--

INSERT INTO `tmhma` (`kwd_tmhmatos`, `onoma_tmhmatos`, `kwd_proistamenou`) VALUES
(1, 'IT', 1),
(2, 'Anaptykshs_Logismikoy', 2),
(3, 'MARKETING', 3),
(4, 'LOGISTIRIO', 4),
(5, 'PARAGGELIVN', 5),
(6, 'EFODIASMOU', 6),
(7, 'THL_KENTRO', 7),
(8, 'HR', 13),
(9, 'PWLHSEWN', 13),
(10, 'OIKONOMIKO', 9),
(11, 'NOMIKO', 10),
(12, 'KATHARIOTHTAS', 12),
(13, 'Grammateia', 13);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tmhmata_se_erga`
--

CREATE TABLE `tmhmata_se_erga` (
  `kwd_tmhmatos_ergou` int(11) DEFAULT NULL,
  `kwd_ergou_tmhma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `tmhmata_se_erga`
--

INSERT INTO `tmhmata_se_erga` (`kwd_tmhmatos_ergou`, `kwd_ergou_tmhma`) VALUES
(1, 13),
(1, 18),
(2, 12),
(3, 4),
(3, 8),
(4, 11),
(4, 14),
(5, 5),
(5, 19),
(6, 1),
(7, 2),
(7, 6),
(8, 15),
(8, 16),
(8, 17),
(8, 21),
(10, 3),
(10, 7),
(11, 9),
(11, 10),
(12, 20);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(5) NOT NULL,
  `user_type_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`) VALUES
(1, 'Administrator'),
(2, 'Simple User');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `address_ergazomenou`
--
ALTER TABLE `address_ergazomenou`
  ADD KEY `kwd_ergazomenou_adr` (`kwd_ergazomenou_adr`);

--
-- Ευρετήρια για πίνακα `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`kwd_ergazom_cred`),
  ADD KEY `kwd_ergazom_cred` (`kwd_ergazom_cred`);

--
-- Ευρετήρια για πίνακα `ekpaideysh`
--
ALTER TABLE `ekpaideysh`
  ADD PRIMARY KEY (`kwd_ptyxio`);

--
-- Ευρετήρια για πίνακα `eksartomenos`
--
ALTER TABLE `eksartomenos`
  ADD PRIMARY KEY (`AMKA_eksart`),
  ADD KEY `kod_prostati` (`kod_prostati`);

--
-- Ευρετήρια για πίνακα `epimorfosh`
--
ALTER TABLE `epimorfosh`
  ADD KEY `epimorfosh_ibfk_1` (`ekpaideyomenos`),
  ADD KEY `epimorfosh_ibfk_2` (`eidikeysh`);

--
-- Ευρετήρια για πίνακα `ergazomenoi_se_erga`
--
ALTER TABLE `ergazomenoi_se_erga`
  ADD PRIMARY KEY (`assigned_id`),
  ADD KEY `kwd_ergou` (`kwd_ergou`),
  ADD KEY `kwd_ergazom_ergo` (`kwd_ergazom_ergo`);

--
-- Ευρετήρια για πίνακα `ergazomenos`
--
ALTER TABLE `ergazomenos`
  ADD PRIMARY KEY (`kwd_ergazomenou`),
  ADD KEY `ergazomenos_ibfk_2` (`user_type_ergazom`),
  ADD KEY `ergazomenos_ibfk_3` (`Kod_tm_ergazom`);

--
-- Ευρετήρια για πίνακα `ergo`
--
ALTER TABLE `ergo`
  ADD PRIMARY KEY (`kwd_ergou`);

--
-- Ευρετήρια για πίνακα `oxhma`
--
ALTER TABLE `oxhma`
  ADD PRIMARY KEY (`ar_kykloforias`),
  ADD KEY `odhgos` (`odhgos`);

--
-- Ευρετήρια για πίνακα `syzygos`
--
ALTER TABLE `syzygos`
  ADD PRIMARY KEY (`AMKA_syzygou`);

--
-- Ευρετήρια για πίνακα `tekno`
--
ALTER TABLE `tekno`
  ADD PRIMARY KEY (`AMKA_teknou`);

--
-- Ευρετήρια για πίνακα `tmhma`
--
ALTER TABLE `tmhma`
  ADD PRIMARY KEY (`kwd_tmhmatos`),
  ADD KEY `kwd_proistamenou` (`kwd_proistamenou`);

--
-- Ευρετήρια για πίνακα `tmhmata_se_erga`
--
ALTER TABLE `tmhmata_se_erga`
  ADD PRIMARY KEY (`kwd_ergou_tmhma`),
  ADD KEY `kwd_tmhmatos_ergou` (`kwd_tmhmatos_ergou`),
  ADD KEY `kwd_ergou_tmhma` (`kwd_ergou_tmhma`);

--
-- Ευρετήρια για πίνακα `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `ekpaideysh`
--
ALTER TABLE `ekpaideysh`
  MODIFY `kwd_ptyxio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT για πίνακα `eksartomenos`
--
ALTER TABLE `eksartomenos`
  MODIFY `AMKA_eksart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1984726322;

--
-- AUTO_INCREMENT για πίνακα `ergazomenoi_se_erga`
--
ALTER TABLE `ergazomenoi_se_erga`
  MODIFY `assigned_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT για πίνακα `ergazomenos`
--
ALTER TABLE `ergazomenos`
  MODIFY `kwd_ergazomenou` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT για πίνακα `ergo`
--
ALTER TABLE `ergo`
  MODIFY `kwd_ergou` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT για πίνακα `tmhma`
--
ALTER TABLE `tmhma`
  MODIFY `kwd_tmhmatos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `address_ergazomenou`
--
ALTER TABLE `address_ergazomenou`
  ADD CONSTRAINT `address_ergazomenou_ibfk_1` FOREIGN KEY (`kwd_ergazomenou_adr`) REFERENCES `ergazomenos` (`kwd_ergazomenou`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `credentials`
--
ALTER TABLE `credentials`
  ADD CONSTRAINT `credentials_ibfk_1` FOREIGN KEY (`kwd_ergazom_cred`) REFERENCES `ergazomenos` (`kwd_ergazomenou`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `eksartomenos`
--
ALTER TABLE `eksartomenos`
  ADD CONSTRAINT `eksartomenos_ibfk_1` FOREIGN KEY (`kod_prostati`) REFERENCES `ergazomenos` (`kwd_ergazomenou`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `epimorfosh`
--
ALTER TABLE `epimorfosh`
  ADD CONSTRAINT `epimorfosh_ibfk_1` FOREIGN KEY (`ekpaideyomenos`) REFERENCES `ergazomenos` (`kwd_ergazomenou`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `epimorfosh_ibfk_2` FOREIGN KEY (`eidikeysh`) REFERENCES `ekpaideysh` (`kwd_ptyxio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `ergazomenoi_se_erga`
--
ALTER TABLE `ergazomenoi_se_erga`
  ADD CONSTRAINT `ergazomenoi_se_erga_ibfk_1` FOREIGN KEY (`kwd_ergou`) REFERENCES `ergo` (`kwd_ergou`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ergazomenoi_se_erga_ibfk_2` FOREIGN KEY (`kwd_ergazom_ergo`) REFERENCES `ergazomenos` (`kwd_ergazomenou`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `ergazomenos`
--
ALTER TABLE `ergazomenos`
  ADD CONSTRAINT `ergazomenos_ibfk_3` FOREIGN KEY (`Kod_tm_ergazom`) REFERENCES `tmhma` (`kwd_tmhmatos`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ergazomenos_ibfk_4` FOREIGN KEY (`user_type_ergazom`) REFERENCES `user_type` (`user_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `oxhma`
--
ALTER TABLE `oxhma`
  ADD CONSTRAINT `oxhma_ibfk_1` FOREIGN KEY (`odhgos`) REFERENCES `ergazomenos` (`kwd_ergazomenou`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `syzygos`
--
ALTER TABLE `syzygos`
  ADD CONSTRAINT `syzygos_ibfk_1` FOREIGN KEY (`AMKA_syzygou`) REFERENCES `eksartomenos` (`AMKA_eksart`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `tekno`
--
ALTER TABLE `tekno`
  ADD CONSTRAINT `tekno_ibfk_1` FOREIGN KEY (`AMKA_teknou`) REFERENCES `eksartomenos` (`AMKA_eksart`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `tmhma`
--
ALTER TABLE `tmhma`
  ADD CONSTRAINT `tmhma_ibfk_1` FOREIGN KEY (`kwd_proistamenou`) REFERENCES `ergazomenos` (`kwd_ergazomenou`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `tmhmata_se_erga`
--
ALTER TABLE `tmhmata_se_erga`
  ADD CONSTRAINT `tmhmata_se_erga_ibfk_1` FOREIGN KEY (`kwd_tmhmatos_ergou`) REFERENCES `tmhma` (`kwd_tmhmatos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tmhmata_se_erga_ibfk_2` FOREIGN KEY (`kwd_ergou_tmhma`) REFERENCES `ergo` (`kwd_ergou`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
