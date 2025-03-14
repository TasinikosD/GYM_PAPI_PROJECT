-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 22 Φεβ 2025 στις 20:32:13
-- Έκδοση διακομιστή: 10.4.32-MariaDB
-- Έκδοση PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `gym_papei_ds`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `αιτημα_εγγραφησ`
--

CREATE TABLE `αιτημα_εγγραφησ` (
  `ID_ΑΙΤΗΜΑΤΟΣ` int(11) NOT NULL,
  `ΚΑΤΑΣΤΑΣΗ` varchar(30) DEFAULT NULL,
  `ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `αιτημα_εγγραφησ`
--

INSERT INTO `αιτημα_εγγραφησ` (`ID_ΑΙΤΗΜΑΤΟΣ`, `ΚΑΤΑΣΤΑΣΗ`, `ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ`) VALUES
(1, 'ΑΠΟΔΟΧΗ', 1),
(6, 'ΑΠΟΔΟΧΗ', 6),
(7, 'ΑΠΟΔΟΧΗ', 7);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `ανακοινωσεισ`
--

CREATE TABLE `ανακοινωσεισ` (
  `ID_ΑΝΑΚΟΙΝΩΣΗΣ` int(11) NOT NULL,
  `ΤΙΤΛΟΣ` varchar(30) DEFAULT NULL,
  `ΠΕΡΙΕΧΟΜΕΝΟ` varchar(500) DEFAULT NULL,
  `ΗΜΕΡΟΜΗΝΙΑ` datetime DEFAULT NULL,
  `ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `ανακοινωσεισ`
--

INSERT INTO `ανακοινωσεισ` (`ID_ΑΝΑΚΟΙΝΩΣΗΣ`, `ΤΙΤΛΟΣ`, `ΠΕΡΙΕΧΟΜΕΝΟ`, `ΗΜΕΡΟΜΗΝΙΑ`, `ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ`) VALUES
(17, 'ΠΡΟΣΦΟΡΑ', 'ΤΩΡΑ ΕΤΗΣΙΑ ΣΥΝΔΡΟΜΗ ΜΟΝΟ ΜΕ 149€!', '2025-02-16 10:53:57', 1),
(18, 'ΒΛΑΒΗ PECTORAL DECK', 'ΤΟ ΜΗΧΑΝΗΜΑ ΕΚΓΥΜΝΑΣΗΣ ΣΤΗΘΟΥΣ PECTORAL DECK ΔΕ ΘΑ ΕΙΝΑΙ ΔΙΑΘΕΣΙΜΟ ΤΙΣ ΕΠΟΜΕΝΕΣ 3 ΜΕΡΕΣ ΕΩΣ ΟΤΟΥ ΝΑ ΕΠΙΣΚΕΥΑΣΤΕΙ.', '2025-02-16 10:55:36', 1),
(20, 'ΕΥΧΕΣ ΝΕΟΥ ΕΤΟΥΣ', 'ΣΑΣ ΕΥΧΟΜΑΣΤΕ ΕΝΑ ΧΑΡΟΥΜΕΝΟ , ΔΗΜΙΟΥΡΓΙΚΟ ΚΑΙ ΓΕΜΑΤΟ ΤΥΧΗ ΝΕΟ ΕΤΟΣ !', '2025-02-21 20:34:45', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `γυμναστησ`
--

CREATE TABLE `γυμναστησ` (
  `ID_ΓΥΜΝΑΣΤΗ` int(11) NOT NULL,
  `ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ` int(11) DEFAULT NULL,
  `ΕΙΔΙΚΟΤΗΤΑ` varchar(30) DEFAULT NULL,
  `ΟΝΟΜΑ` varchar(30) DEFAULT NULL,
  `ΕΠΩΝΥΜΟ` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `γυμναστησ`
--

INSERT INTO `γυμναστησ` (`ID_ΓΥΜΝΑΣΤΗ`, `ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ`, `ΕΙΔΙΚΟΤΗΤΑ`, `ΟΝΟΜΑ`, `ΕΠΩΝΥΜΟ`) VALUES
(1, NULL, 'ΒΑΡΗ', 'ΔΗΜΗΤΡΗΣ', 'ΤΑΣΗΝΙΚΟΣ'),
(2, NULL, 'ΑΕΡΟΒΙΟ', 'ΜΙΧΑΛΗΣ', 'ΜΙΤΡΟΦΑΝ'),
(3, NULL, 'ΕΝΔΥΝΑΜΩΣΗ', 'ΘΑΝΟΣ', 'ΧΑΡΑΛΑΜΠΟΥΣ'),
(4, NULL, 'ΠΙΛΑΤΕΣ', 'ΑΛΕΞΑΝΔΡΟΣ', 'ΡΩΣΗ');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `προγραμμα`
--

CREATE TABLE `προγραμμα` (
  `ID_ΠΡΟΓΡΑΜΜΑΤΟΣ` int(11) NOT NULL,
  `ΗΜΕΡΟΜΗΝΙΑ` text DEFAULT NULL,
  `ΩΡΑ` time DEFAULT NULL,
  `ΜΕΓΙΣΤΟΣ_ΑΡΙΘΜΟΣ_ΟΜΑΔΑΣ` int(11) DEFAULT NULL,
  `ΕΙΔΟΣ` varchar(30) DEFAULT NULL,
  `ΠΡΟΓΡΑΜΜΑTA_ID_ΠΡΟΓΡΑΜΜΑTA` int(11) DEFAULT NULL,
  `ΓΥΜΝΑΣΤΗΣ_ID_ΓΥΜΝΑΣΤΗ` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `προγραμμα`
--

INSERT INTO `προγραμμα` (`ID_ΠΡΟΓΡΑΜΜΑΤΟΣ`, `ΗΜΕΡΟΜΗΝΙΑ`, `ΩΡΑ`, `ΜΕΓΙΣΤΟΣ_ΑΡΙΘΜΟΣ_ΟΜΑΔΑΣ`, `ΕΙΔΟΣ`, `ΠΡΟΓΡΑΜΜΑTA_ID_ΠΡΟΓΡΑΜΜΑTA`, `ΓΥΜΝΑΣΤΗΣ_ID_ΓΥΜΝΑΣΤΗ`) VALUES
(38, 'ΔΕΥΤΕΡΑ', '10:30:00', 0, 'ΒΑΡΗ', NULL, 1),
(39, 'ΔΕΥΤΕΡΑ', '13:30:00', 0, 'ΕΝΔΥΝΑΜΩΣΗ', NULL, 3),
(40, 'ΔΕΥΤΕΡΑ', '15:30:00', 15, 'TRX(ΟΜΑΔΙΚΑ)', NULL, 2),
(41, 'ΤΡΙΤΗ', '11:30:00', 15, 'ΠΙΛΑΤΕΣ(ΟΜΑΔΙΚΑ)', NULL, 4),
(42, 'ΤΡΙΤΗ', '15:30:00', 0, 'ΒΑΡΗ', NULL, 1),
(43, 'ΤΡΙΤΗ', '17:30:00', 0, 'ΕΝΔΥΝΑΜΩΣΗ', NULL, 3),
(44, 'ΤΕΤΑΡΤΗ', '11:30:00', 15, 'TRX(ΟΜΑΔΙΚΑ)', NULL, 2),
(45, 'ΤΕΤΑΡΤΗ', '14:30:00', 10, 'TRX(ΟΜΑΔΙΚΑ)', NULL, 2),
(46, 'ΤΕΤΑΡΤΗ', '16:30:00', 0, 'ΒΑΡΗ', NULL, 1),
(47, 'ΠΕΜΠΤΗ', '11:30:00', 0, 'ΒΑΡΗ', NULL, 1),
(48, 'ΠΕΜΠΤΗ', '14:30:00', 15, 'TRX(ΟΜΑΔΙΚΑ)', NULL, 2),
(49, 'ΠΕΜΠΤΗ', '17:30:00', 15, 'ΠΙΛΑΤΕΣ(ΟΜΑΔΙΚΑ)', NULL, 4),
(50, 'ΠΑΡΑΣΚΕΥΗ', '11:30:00', 10, 'TRX(ΟΜΑΔΙΚΑ)', NULL, 2),
(51, 'ΠΑΡΑΣΚΕΥΗ', '15:30:00', 0, 'ΕΝΔΥΝΑΜΩΣΗ', NULL, 3),
(52, 'ΠΑΡΑΣΚΕΥΗ', '19:30:00', 15, 'ΠΙΛΑΤΕΣ(ΟΜΑΔΙΚΑ)', NULL, 4);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `προγραμμαta`
--

CREATE TABLE `προγραμμαta` (
  `ID_ΠΡΟΓΡΑΜΜΑTA` int(11) NOT NULL,
  `ΟΝΟΜΑ` varchar(30) DEFAULT NULL,
  `ΠΕΡΙΓΡΑΦΗ` varchar(500) DEFAULT NULL,
  `ΔΙΑΡΚΕΙΑ` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `προγραμμαta`
--

INSERT INTO `προγραμμαta` (`ID_ΠΡΟΓΡΑΜΜΑTA`, `ΟΝΟΜΑ`, `ΠΕΡΙΓΡΑΦΗ`, `ΔΙΑΡΚΕΙΑ`) VALUES
(6, 'ΒΑΡΗ', 'Το τμήμa βαρών στο γυμναστήριο διαθέτει αλτήρες, μπάρες και μηχανήματα για προπόνηση δύναμης και μυϊκής ανάπτυξης.', '01:30:00'),
(7, 'TRX(ΟΜΑΔΙΚΑ)', 'Το τμήμα TRX προσφέρει προπόνηση με ιμάντες αιώρησης, ενισχύοντας τη δύναμη, την ισορροπία και τον συντονισμό με το βάρος του σώματος.', '02:00:00'),
(8, 'ΕΝΔΥΝΑΜΩΣΗ', 'Το τμήμα ενδυνάμωσης επικεντρώνεται σε ασκήσεις που αυξάνουν τη μυϊκή δύναμη και αντοχή, χρησιμοποιώντας βάρη, μηχανήματα ή το βάρος του σώματος.', '01:00:00'),
(9, 'ΠΙΛΑΤΕΣ(ΟΜΑΔΙΚΑ)', 'Το τμήμα Πιλάτες επικεντρώνεται σε ασκήσεις που βελτιώνουν τη δύναμη, την ευλυγισία και τη στάση του σώματος, με έμφαση στον κορμό και την αναπνοή.', '01:30:00');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `ρολοσ`
--

CREATE TABLE `ρολοσ` (
  `ID_ΡΟΛΟΣ` int(11) NOT NULL,
  `ΡΟΛΟΣ` varchar(30) DEFAULT NULL,
  `ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `ρολοσ`
--

INSERT INTO `ρολοσ` (`ID_ΡΟΛΟΣ`, `ΡΟΛΟΣ`, `ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ`) VALUES
(1, 'ΔΙΑΧΕΙΡΙΣΤΗΣ', 1),
(3, 'ΧΡΗΣΤΗΣ', 6),
(4, 'ΔΙΑΧΕΙΡΙΣΤΗΣ', 7);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `συμμετοχη`
--

CREATE TABLE `συμμετοχη` (
  `ID_ΣΥΜΜΕΤΟΧΗΣ` int(11) NOT NULL,
  `ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ` int(11) DEFAULT NULL,
  `ΠΡΟΓΡΑΜΜΑ_ID_ΠΡΟΓΡΑΜΜΑΤΟΣ` int(11) DEFAULT NULL,
  `ΗΜΕΡΑ` date NOT NULL DEFAULT current_timestamp(),
  `ΑΚΥΡΩΜΕΝΟ` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `συμμετοχη`
--

INSERT INTO `συμμετοχη` (`ID_ΣΥΜΜΕΤΟΧΗΣ`, `ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ`, `ΠΡΟΓΡΑΜΜΑ_ID_ΠΡΟΓΡΑΜΜΑΤΟΣ`, `ΗΜΕΡΑ`, `ΑΚΥΡΩΜΕΝΟ`) VALUES
(36, 6, 38, '2025-02-24', 'ΝΑΙ');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `χρηστησ`
--

CREATE TABLE `χρηστησ` (
  `ID_ΧΡΗΣΤΗ` int(11) NOT NULL,
  `ΟΝΟΜΑ` varchar(30) DEFAULT NULL,
  `ΕΠΩΝΥΜΟ` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `ΤΗΛΕΦΩΝΟ` varchar(15) DEFAULT NULL,
  `ΔΙΕΥΘΥΝΣΗ` varchar(50) DEFAULT NULL,
  `ΠΟΛΗ` varchar(30) DEFAULT NULL,
  `ΧΩΡΑ` varchar(30) DEFAULT NULL,
  `ΟΝΟΜΑ_ΧΡΗΣΤΗ` varchar(30) DEFAULT NULL,
  `ΚΩΔΙΚΟΣ_ΠΡΟΣΒΑΣΗΣ` varchar(30) DEFAULT NULL,
  `ΑΙΤΗΜΑ_ΕΓΓΡΑΦΗΣ_ID_ΑΙΤΗΜΑΤΟΣ` int(11) DEFAULT NULL,
  `ΓΥΜΝΑΣΤΗΣ_ID_ΓΥΜΝΑΣΤΗ` int(11) DEFAULT NULL,
  `ΡΟΛΟΣ_ID_ΡΟΛΟΣ` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `χρηστησ`
--

INSERT INTO `χρηστησ` (`ID_ΧΡΗΣΤΗ`, `ΟΝΟΜΑ`, `ΕΠΩΝΥΜΟ`, `EMAIL`, `ΤΗΛΕΦΩΝΟ`, `ΔΙΕΥΘΥΝΣΗ`, `ΠΟΛΗ`, `ΧΩΡΑ`, `ΟΝΟΜΑ_ΧΡΗΣΤΗ`, `ΚΩΔΙΚΟΣ_ΠΡΟΣΒΑΣΗΣ`, `ΑΙΤΗΜΑ_ΕΓΓΡΑΦΗΣ_ID_ΑΙΤΗΜΑΤΟΣ`, `ΓΥΜΝΑΣΤΗΣ_ID_ΓΥΜΝΑΣΤΗ`, `ΡΟΛΟΣ_ID_ΡΟΛΟΣ`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '2102102100', 'admin', 'admin', 'admin', 'admin', 'admin', NULL, NULL, NULL),
(6, 'ΜΙΧΑΛΗΣ', 'ΜΙΤΡΟΦΑΝ', 'MIKEM@gmail.com', '6987913704', '25ΗΣ ΜΑΡΤΙΟΥ 38', 'Shklow', 'Belarus', 'MIKEM', '1234', NULL, NULL, NULL),
(7, 'ΘΑΝΟΣ', 'ΧΑΡΑΛΑΜΠΟΥΣ', 'THA@gmail.com', '6987913709', '25ΗΣ ΜΑΡΤΙΟΥ 39', 'Feni', 'Bangladesh', 'THA', '1234', NULL, NULL, NULL);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `αιτημα_εγγραφησ`
--
ALTER TABLE `αιτημα_εγγραφησ`
  ADD PRIMARY KEY (`ID_ΑΙΤΗΜΑΤΟΣ`),
  ADD UNIQUE KEY `ΑΙΤΗΜΑ_ΕΓΓΡΑΦΗΣ__IDX` (`ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ`);

--
-- Ευρετήρια για πίνακα `ανακοινωσεισ`
--
ALTER TABLE `ανακοινωσεισ`
  ADD PRIMARY KEY (`ID_ΑΝΑΚΟΙΝΩΣΗΣ`);

--
-- Ευρετήρια για πίνακα `γυμναστησ`
--
ALTER TABLE `γυμναστησ`
  ADD PRIMARY KEY (`ID_ΓΥΜΝΑΣΤΗ`),
  ADD UNIQUE KEY `ΓΥΜΝΑΣΤΗΣ__IDX` (`ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ`);

--
-- Ευρετήρια για πίνακα `προγραμμα`
--
ALTER TABLE `προγραμμα`
  ADD PRIMARY KEY (`ID_ΠΡΟΓΡΑΜΜΑΤΟΣ`);

--
-- Ευρετήρια για πίνακα `προγραμμαta`
--
ALTER TABLE `προγραμμαta`
  ADD PRIMARY KEY (`ID_ΠΡΟΓΡΑΜΜΑTA`);

--
-- Ευρετήρια για πίνακα `ρολοσ`
--
ALTER TABLE `ρολοσ`
  ADD PRIMARY KEY (`ID_ΡΟΛΟΣ`),
  ADD UNIQUE KEY `ΡΟΛΟΣ__IDX` (`ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ`);

--
-- Ευρετήρια για πίνακα `συμμετοχη`
--
ALTER TABLE `συμμετοχη`
  ADD PRIMARY KEY (`ID_ΣΥΜΜΕΤΟΧΗΣ`);

--
-- Ευρετήρια για πίνακα `χρηστησ`
--
ALTER TABLE `χρηστησ`
  ADD PRIMARY KEY (`ID_ΧΡΗΣΤΗ`),
  ADD UNIQUE KEY `ΧΡΗΣΤΗΣ__IDX` (`ΡΟΛΟΣ_ID_ΡΟΛΟΣ`),
  ADD UNIQUE KEY `ΧΡΗΣΤΗΣ__IDXv1` (`ΑΙΤΗΜΑ_ΕΓΓΡΑΦΗΣ_ID_ΑΙΤΗΜΑΤΟΣ`),
  ADD UNIQUE KEY `ΧΡΗΣΤΗΣ__IDXv2` (`ΓΥΜΝΑΣΤΗΣ_ID_ΓΥΜΝΑΣΤΗ`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `αιτημα_εγγραφησ`
--
ALTER TABLE `αιτημα_εγγραφησ`
  MODIFY `ID_ΑΙΤΗΜΑΤΟΣ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT για πίνακα `ανακοινωσεισ`
--
ALTER TABLE `ανακοινωσεισ`
  MODIFY `ID_ΑΝΑΚΟΙΝΩΣΗΣ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT για πίνακα `γυμναστησ`
--
ALTER TABLE `γυμναστησ`
  MODIFY `ID_ΓΥΜΝΑΣΤΗ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT για πίνακα `προγραμμα`
--
ALTER TABLE `προγραμμα`
  MODIFY `ID_ΠΡΟΓΡΑΜΜΑΤΟΣ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT για πίνακα `προγραμμαta`
--
ALTER TABLE `προγραμμαta`
  MODIFY `ID_ΠΡΟΓΡΑΜΜΑTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT για πίνακα `ρολοσ`
--
ALTER TABLE `ρολοσ`
  MODIFY `ID_ΡΟΛΟΣ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `συμμετοχη`
--
ALTER TABLE `συμμετοχη`
  MODIFY `ID_ΣΥΜΜΕΤΟΧΗΣ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT για πίνακα `χρηστησ`
--
ALTER TABLE `χρηστησ`
  MODIFY `ID_ΧΡΗΣΤΗ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
