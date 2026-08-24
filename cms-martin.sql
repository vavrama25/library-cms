-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 24. srp 2026, 10:25
-- Verze serveru: 10.4.24-MariaDB
-- Verze PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `cms-martin`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `cms-content`
--

CREATE TABLE `cms-content` (
  `ID_cms-content` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `form` set('beletrie','naucna') NOT NULL,
  `imgLink` varchar(150) DEFAULT NULL,
  `description` varchar(1000) NOT NULL,
  `availability` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `price` int(11) NOT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `cms-content`
--

INSERT INTO `cms-content` (`ID_cms-content`, `title`, `autor`, `genre`, `form`, `imgLink`, `description`, `availability`, `price`, `timestamp`) VALUES
(4, 'Mein kampf', 'Adolf Hitler', 'autobiografie', 'naucna', 'https://web2.mlp.cz/koweb/00/03/44/02/Small.43.jpg', 'Kniha francouzského novináře a dokumentaristy Antoina Vitkina Mein Kampf se snaží popsat vznik a následnou recepci Hitlerova spisu. Vitkine svou knihu rozdělil do dvou částí. V první – Před válkou: „Nacistická bible“ – líčí okolnosti vzniku Mein Kampfu, shrnuje jeho základní teze a popisuje, jaký význam tato kniha získala za Třetí říše. V druhé části knihy – Po válce: Historie bez konce – Vitkine popisuje jednak to, jak se s dědictvím Mého boje vyrovnávali jednotlivé generace v poválečném Německu, jednak jeho další osudy ve světě (do kolika jazyků byl přeložen, v jakých nákladech atd.). Vitkine se zvlášť zaměřuje na arabský svět, v němž se Mému boji po založení státu Izrael dostalo velkého ohlasu. Monografie končí výčtem sedmi ponaučení pro současnost, jaké bychom si z této nebezpečné knihy měli stále brát. Nakladatelská anotace.', 1, 555, '2026-07-11 10:39:50'),
(5, 'Bejcek', 'Matej Dufek', 'SCIFI', 'beletrie', 'https://cdn.pixabay.com/photo/2023/10/18/10/31/bull-8323682_960_720.jpg 1x, https://cdn.pixabay.com/photo/2023/10/18/10/31/bull-8323682_1280.jpg ', 'BEJK', 1, 500, '2026-08-18 15:37:50'),
(6, 'Hitlerova nenávist k Židům', 'Reuth, Ralf Georg', '-', 'beletrie', 'https://web2.mlp.cz/koweb/00/03/56/68/Small.44.jpg', 'Německý historik se ve své práci snaží zpochybnit historiky (Kershaw, Fest, Bullock atd.) zastávaný názor, že počátky Hitlerovy nenávisti vůči Židům spadají do doby jeho pobytu ve Vídni před první světovou válkou. Na základě pramenů a literatury se autor snaží dokázat, že Hitlerův antisemitismus se zrodil až během událostí roku 1919; v tomto roce čelí Německo spartakovskému povstání, v Mnichově je vyhlášena Bavorská republika rad (trvala od dubna do května 1919) a Němci jsou nuceni přijmout tvrdé podmínky versailleské mírové smlouvy. Hitler podle Reutha vidí úzkou spojitost mezi Židy a bolševiky, k nimž cítí bytostný odpor. Kniha mapuje vývoj Hitlerova postoje k Židům od jeho pobytu ve Vídni až do jeho rozhodnutí k provedení genocidy evropských Židů roku 1941.', 1, 500, '2026-08-18 15:52:09'),
(7, 'HOVNO', 'HOnza studnicka', 'Fantasyaaaa', 'beletrie', 'https://web2.mlp.cz/koweb/00/05/27/10/Small.61.jpg', 'Kniha o hovne', 1, 900, '2026-08-20 06:44:54'),
(8, 'Všechno při starém', ' Claire Lombardo', 'Beletrie pro dospělé čtenáře a mládež v češtině.', 'beletrie', 'https://web2.mlp.cz/koweb/00/05/27/10/Small.57.jpg', 'Julia Amesová má konečně pocit, že svůj život drží pevně v rukou. Po mládí plném otřesů a citových zmatků dospěla do zdánlivě klidné fáze – do bezpečného, usazeného středu života. V sedmapadesáti letech věří, že to nejhorší má za sebou. Jenže pak se jí v životě začnou objevovat věci, které nečekala: Překvapivé oznámení syna. Odloučení svéhlavé dospívající dcery. A především návrat minulosti, který je stejně svůdný jako nebezpečný. Stačí málo a Julia se může znovu ocitnout na hraně, kde už jednou byla. Všechno při starém je pronikavým a citlivým portrétem života v celé jeho neuhlazenosti. S mimořádnou přesností zachycuje mateřství bez příkras, křehkost mezigeneračních vztahů i nepředvídatelné řetězce příčin a následků, jež formují naše osudy. Je to příběh o tom, jak se proměňujeme – a jak nás minulost nikdy úplně nepustí. Nakladatelská anotace.', 1, 399, '2026-08-22 09:13:58');

-- --------------------------------------------------------

--
-- Struktura tabulky `cms-login`
--

CREATE TABLE `cms-login` (
  `ID_login` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(123) COLLATE utf8_czech_ci NOT NULL,
  `deleted` int(1) NOT NULL,
  `role` set('user','user++','worker','admin') COLLATE utf8_czech_ci NOT NULL DEFAULT 'user',
  `credits` int(100) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `cms-login`
--

INSERT INTO `cms-login` (`ID_login`, `email`, `password`, `deleted`, `role`, `credits`) VALUES
(3, 'del_2026-08-20_del_2026-08-20_del_2026-08-20_a@AS.c', '581e2c1f7e57fd0604c61d8728abe171b0c3ecce14c481a4a06d223cf473bf8715f122bb4823b5a6d4cb74fd1f818b19fee4169b171ea316bcce73912f4', 1, 'admin', 200),
(4, 'a@AS.cz', 'a743631d4e742d5defee93ae22586c176c827f2480458306db42d95798e714ff09d85f693e3844d9d5848009ab81eaaf6f403e53983fae25b98c1c2b763', 0, 'user', 0),
(5, 'abc@abc.abc', '374375decc8f937d91cbd364911bf2f30bbe9d858226c1e844f7c1838f4237922602780a2670e3d9b1d327c438340f74f127f1464d98a88d86e33dde90c', 0, 'user', 0),
(7, 'localhost@ahs.sas', 'c4a83517c4bc095c0ef4c015055843b84f6ffd6dee91f0f7f5e822d94be4aa4d89422233c3a7091816bc41547b466cdaa4de03887abceaa8f0743c63575', 0, 'user', 0),
(8, 'localhost@ahs.sasa', '0337ba054cb9d3a7c7e8fc356afa991119d5f1784a4d8dfd3471e07924a7e7e6bfdd3bb426beb699ad1b4a1083b43ae3856f78e16ae0131badd27cdc6a2', 0, 'user', 0),
(9, 'localhost@ahs.sasas', 'ca8fabeab9a212030ba759d44af30e9ec46191b5c8be2966b2716e529f8d0cb5296ed8a157b4bcec41f2569baaf77f3618a78f284ece77c5ba28b01a7ce', 0, 'user', 0),
(10, 'localhost@ahs.cz', '5ec78bf47a886a42a9acbbd61785b41eb07da51df163f7f7b405740155e5c7512c5532b5611346e68d8fbd8230c2086e2ba3a4d37c60d843341b0e73200', 0, 'user', 0),
(14, '1111@gmail.com', '1dfd7913e43e846b43da9ac80fb32fb2dcb33f34c059f4a6fafa75ebde545d8d36a18757abd9a502297ccae43977903535a4a0ce2af0f7e1550426c5976', 0, 'user', 0),
(16, 'del_1781111274_vavrama25@sps-prosek.cz', 'ca82da7073d99f9d00b40c29a6e1efc5fc007f0aa01b85b77adcb6d359bceb034e3ebf69602e15720b3cdc433aaa4da632782c1fb0c903642e31cefa892', 1, 'user', 0),
(17, 'del_2026-06-10T17:11:31+00:00_vavrama25@sps-prosek.cz', 'e901c5a7ea5dc7f8dd391ef1ae6ca877197f5291016b886299cd0313df618f3963d1b5c58e7a4b1f9597c64c505b4de4be51cc32536cda219149a045858', 1, 'user', 0),
(18, 'del_2026-06-10_vavrama25@sps-prosek.cz', 'ef7fe00e267045c6ab61ca4050ccd4cfdffa2f88547dcb9078959f525fe4719b5839dab2b5fc6e63d91ce554166d3a352057cc024390cdd8db44f7b0f80', 1, 'user', 0),
(19, 'vavrama25@sps-prosek.cz', '562295e360186dd00b6c474975a3c6735f64eddaa36b2449405eb4c4b94c5a31ac391a5c7f818ef40d14b2b0603155c0d90ccdeef87824e2f2383ce487e', 0, 'admin', 445),
(20, 'vavrama25@sps-prosek.czff', 'e02dd6c42ddbe8b63f8320746b76a5717e3d0d892c66799f0bc5edc295d052861182787479718ee4a0ee3e7afa093033dcfcea3e1c7fa6e98a5b67d2002', 0, 'user', 0),
(21, 'b@b.b', '0da2a8e7e47cff715e97641e8a05b619a0c13e95832665adeaab5c7e671e7dc646491f2f4b447e08e5467a02e2f1ab51fda11e207bcf35c9611ebef60f0', 0, 'user', 0),
(22, 'a@a.a', 'f905e8f3092680fecfc1d3970a0fbfaea1af1f11aeb85dfaec1e3db892a1ea9c5a59ab04ebeab966a074cf455c3cb67a55e826952115fe76e329ddd85dc', 0, 'user', 0),
(23, 'del_2026-07-10_martinvavra2010@gmail.com', '5adb6f6027d0afc86d06b077a1f3d88d8638a7f9742f77f393520a094823d6b7ba004f9d4ddda05a5c22db3ecce24de7a8cec41cd6367ac254719cbac43', 1, 'user', 0),
(24, 'negr@negr.negr', '01d97a589d7d2a800591c0de6139e897feaee2f61e3f3b269d9b4931d15382418d51ea7618cf34a820bc2fe47d37b545271575ff49f1808f4900a6b0029', 0, 'user', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `cms-reset_pass`
--

CREATE TABLE `cms-reset_pass` (
  `ID_reset_pass` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `cms-reset_pass`
--

INSERT INTO `cms-reset_pass` (`ID_reset_pass`, `email`, `token`, `date`) VALUES
(99, 'martinvavra2010@gmail.com', 'd2575e107dff27a0eddadbcd67ae192c29e31810d9f78da7d578c064f00add51fbfcdc9663d42ad166bdf4b6ae2fbc20', '2026-07-10 09:12:18');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `cms-content`
--
ALTER TABLE `cms-content`
  ADD PRIMARY KEY (`ID_cms-content`);

--
-- Indexy pro tabulku `cms-login`
--
ALTER TABLE `cms-login`
  ADD PRIMARY KEY (`ID_login`);

--
-- Indexy pro tabulku `cms-reset_pass`
--
ALTER TABLE `cms-reset_pass`
  ADD PRIMARY KEY (`ID_reset_pass`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `cms-content`
--
ALTER TABLE `cms-content`
  MODIFY `ID_cms-content` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pro tabulku `cms-login`
--
ALTER TABLE `cms-login`
  MODIFY `ID_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pro tabulku `cms-reset_pass`
--
ALTER TABLE `cms-reset_pass`
  MODIFY `ID_reset_pass` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
