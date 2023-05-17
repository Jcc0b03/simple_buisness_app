-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Lut 2022, 00:20
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt_praktyki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `ID_klienta` int(11) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `imie` varchar(20) NOT NULL,
  `miejscowosc` varchar(30) NOT NULL,
  `kod_pocztowy` char(6) NOT NULL,
  `ulica` varchar(30) NOT NULL,
  `nr_domu` varchar(9) NOT NULL,
  `nr_telefonu` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`ID_klienta`, `nazwisko`, `imie`, `miejscowosc`, `kod_pocztowy`, `ulica`, `nr_domu`, `nr_telefonu`) VALUES
(1, 'Błaszczyk', 'Marek', 'Świdnik', '47-587', 'Brunatna', '48', '125897456'),
(2, 'Piotrowski', 'Bartłomiej', 'Bełżyce', '23-587', 'Lubelska', '12b', '514236985'),
(3, 'Kowalczyk', 'Adam', 'Gdańsk', '69-896', 'Bulwarowa', '36/8', '523698547');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `ID_pracownika` int(11) NOT NULL,
  `ID_zespolu` int(11) DEFAULT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `imie` varchar(20) NOT NULL,
  `PESEL` char(11) NOT NULL,
  `miejscowosc` varchar(30) NOT NULL,
  `kod_pocztowy` char(6) NOT NULL,
  `ulica` varchar(30) NOT NULL,
  `nr_domu` varchar(9) NOT NULL,
  `nr_telefonu` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`ID_pracownika`, `ID_zespolu`, `nazwisko`, `imie`, `PESEL`, `miejscowosc`, `kod_pocztowy`, `ulica`, `nr_domu`, `nr_telefonu`) VALUES
(1, 0, 'Kowalski', 'Jan', '19875478544', 'Lublin', '21-200', 'Długa', '55/5', '665899887'),
(2, 0, 'Kucharski', 'Marcel', '01421456987', 'Warszawa', '05-200', 'Wyścigowa', '78/2', '448796587'),
(3, 10, 'Pawlak', 'Mariusz', '25897456325', 'Lublin', '21-100', 'Szewska', '24/2', '447896582'),
(4, 10, 'Szewczyk', 'Daniel', '54789658214', 'Lublin', '21-254', 'Lipowa', '72/5', '547896521');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekty`
--

CREATE TABLE `projekty` (
  `ID_projektu` int(11) NOT NULL,
  `ID_zespolu` int(11) NOT NULL,
  `ID_klienta` int(11) NOT NULL,
  `nazwa_projektu` varchar(50) NOT NULL,
  `graficzny` tinyint(1) NOT NULL,
  `ilosc_podstron` int(11) NOT NULL,
  `CMS` tinyint(1) NOT NULL,
  `ekspres` tinyint(1) NOT NULL,
  `opt_SEO` tinyint(1) NOT NULL,
  `termin` date NOT NULL,
  `zakonczony` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `projekty`
--

INSERT INTO `projekty` (`ID_projektu`, `ID_zespolu`, `ID_klienta`, `nazwa_projektu`, `graficzny`, `ilosc_podstron`, `CMS`, `ekspres`, `opt_SEO`, `termin`, `zakonczony`) VALUES
(1, 10, 2, 'Strona internetowa o kotach', 1, 5, 1, 0, 1, '2022-05-25', 0),
(2, 0, 1, 'Aplikacja internetowa do zarządzania sklepem', 1, 15, 1, 1, 1, '2022-03-15', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `spotkania`
--

CREATE TABLE `spotkania` (
  `ID_spotkania` int(11) NOT NULL,
  `ID_klienta` int(11) NOT NULL,
  `ID_pracownika` int(11) NOT NULL,
  `data_godzina` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `spotkania`
--

INSERT INTO `spotkania` (`ID_spotkania`, `ID_klienta`, `ID_pracownika`, `data_godzina`) VALUES
(1, 2, 3, '2022-02-24 14:30:00'),
(2, 1, 4, '2022-02-25 17:30:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID_uzytkownika` int(11) NOT NULL,
  `ID_pracownika` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `uprawnienia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID_uzytkownika`, `ID_pracownika`, `login`, `haslo`, `uprawnienia`) VALUES
(1, 1, 'admin', '21bd12dc183f740ee76f27b78eb39c8ad972a757', 1),
(2, 2, 'kucharski2', '21bd12dc183f740ee76f27b78eb39c8ad972a757', 2),
(3, 3, 'pawlak3', '21bd12dc183f740ee76f27b78eb39c8ad972a757', 2),
(4, 4, 'szewczyk4', '21bd12dc183f740ee76f27b78eb39c8ad972a757', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zespoly`
--

CREATE TABLE `zespoly` (
  `ID_zespolu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zespoly`
--

INSERT INTO `zespoly` (`ID_zespolu`) VALUES
(0),
(10);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`ID_klienta`);

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`ID_pracownika`),
  ADD KEY `ID_zespolu` (`ID_zespolu`);

--
-- Indeksy dla tabeli `projekty`
--
ALTER TABLE `projekty`
  ADD PRIMARY KEY (`ID_projektu`),
  ADD KEY `ID_zespolu` (`ID_zespolu`),
  ADD KEY `ID_klienta` (`ID_klienta`);

--
-- Indeksy dla tabeli `spotkania`
--
ALTER TABLE `spotkania`
  ADD PRIMARY KEY (`ID_spotkania`),
  ADD KEY `ID_klienta` (`ID_klienta`),
  ADD KEY `ID_pracownika` (`ID_pracownika`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID_uzytkownika`),
  ADD KEY `ID_pracownika` (`ID_pracownika`);

--
-- Indeksy dla tabeli `zespoly`
--
ALTER TABLE `zespoly`
  ADD PRIMARY KEY (`ID_zespolu`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `ID_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `ID_pracownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `projekty`
--
ALTER TABLE `projekty`
  MODIFY `ID_projektu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `spotkania`
--
ALTER TABLE `spotkania`
  MODIFY `ID_spotkania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID_uzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD CONSTRAINT `pracownicy_ibfk_1` FOREIGN KEY (`ID_zespolu`) REFERENCES `zespoly` (`ID_zespolu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `projekty`
--
ALTER TABLE `projekty`
  ADD CONSTRAINT `projekty_ibfk_1` FOREIGN KEY (`ID_klienta`) REFERENCES `klienci` (`ID_klienta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projekty_ibfk_2` FOREIGN KEY (`ID_zespolu`) REFERENCES `zespoly` (`ID_zespolu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `spotkania`
--
ALTER TABLE `spotkania`
  ADD CONSTRAINT `spotkania_ibfk_1` FOREIGN KEY (`ID_pracownika`) REFERENCES `pracownicy` (`ID_pracownika`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spotkania_ibfk_2` FOREIGN KEY (`ID_klienta`) REFERENCES `klienci` (`ID_klienta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`ID_pracownika`) REFERENCES `pracownicy` (`ID_pracownika`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
