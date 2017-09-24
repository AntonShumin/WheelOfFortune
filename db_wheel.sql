-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 24 sep 2017 om 22:53
-- Serverversie: 5.7.14
-- PHP-versie: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wheel`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reward`
--

CREATE TABLE `reward` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `remaining` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `reward`
--

INSERT INTO `reward` (`id`, `description`, `remaining`) VALUES
(1, '10 euro voucher', 992),
(2, '100 euro voucher', 96),
(3, '200 euro voucher', 9),
(4, 'Las Vegas reis', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `voornaam` varchar(25) NOT NULL,
  `naam` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `straat` varchar(50) NOT NULL,
  `post` varchar(50) NOT NULL,
  `gsm` varchar(10) NOT NULL,
  `pogingen` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `voornaam`, `naam`, `email`, `straat`, `post`, `gsm`, `pogingen`) VALUES
(1, 'Anton', 'Shumin', 'anton@anton.com', 'Dageraadstraat 22', '2800', '0476503147', 1),
(2, 'Boris', 'Yeltsin', 'test@test.com', 'Riekstraat 22', '3001', '0485545321', 0),
(3, 'Robert', 'Jops', 'robert@test.com', 'Nieuwstraat 126', '9000', '0487545214', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `reward`
--
ALTER TABLE `reward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
