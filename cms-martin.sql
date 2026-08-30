-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Ned 30. srp 2026, 19:06
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
  `imgLink` varchar(2048) DEFAULT NULL,
  `description` varchar(1000) NOT NULL,
  `availability` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `price` int(11) NOT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `cms-content`
--

INSERT INTO `cms-content` (`ID_cms-content`, `title`, `autor`, `genre`, `form`, `imgLink`, `description`, `availability`, `price`, `timestamp`, `deleted`) VALUES
(28, 'Duna', 'Frank Herbert', 'Sci-fi', 'beletrie', 'https://covers.openlibrary.org/b/id/10210554-L.jpg', 'Mocenské boje o nejdůležitější surovinu ve vesmíru na nehostinné pouštní planetě Arrakis.', 5, 299, '2026-08-29 12:25:05', 0),
(29, 'Nadace', 'Isaac Asimov', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/23_/231916/nadace-231916.webp?v=1417720226', 'Pád galaktického impéria a snaha o záchranu lidského vědění prostřednictvím psychohistorie.', 5, 299, '2026-08-29 12:25:05', 0),
(30, 'Problém tří těles', 'Liou Cch\'-sin', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/33_/334860/problem-tri-teles-jPU-334860.webp?v=1496177237', 'První kontakt lidstva s mimozemskou civilizací na pozadí čínské kulturní revoluce.', 5, 299, '2026-08-29 12:25:05', 0),
(31, 'Marťan', 'Andy Weir', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/22_/225946/martan-3Bs-225946.webp?v=1421148026', 'Boj o přežití astronauta Marka Watneyho, který zůstal omylem opuštěn na Marsu.', 5, 299, '2026-08-29 12:25:05', 0),
(32, 'Spasitel', 'Andy Weir', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/47_/476966/spasitel-TPX-476966.webp?v=1626431998', 'Osamělý astronaut se probouzí s amnézií a musí zachránit Zemi před vyhynutím.', 5, 299, '2026-08-29 12:25:05', 0),
(33, 'Neuromancer', 'William Gibson', 'Sci-fi', 'beletrie', 'https://covers.openlibrary.org/b/id/283860-L.jpg', 'Kyberpunková klasika o zkrachovalém hackerovi najatém na zdánlivě nemožnou misi.', 5, 299, '2026-08-29 12:25:05', 0),
(34, 'Sní androidi o elektrických ovečkách?', 'Philip K. Dick', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/35_/352336/blade-runner-gFV-352336.webp?v=1505803880', 'Lov zběhlých androidů v postapokalyptickém světě, který posloužil jako předloha pro film Blade Runner.', 5, 299, '2026-08-29 12:25:05', 0),
(35, 'Konec dětství', 'Arthur C. Clarke', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/50_/506303/konec-detstvi-yNC-506303.webp?v=1669210538', 'Mimozemšťané přinesou Zemi utopii, ale za cenu ztráty lidské identity a budoucnosti.', 5, 299, '2026-08-29 12:25:05', 0),
(36, 'Setkání s Rámou', 'Arthur C. Clarke', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/49_/498805/setkani-s-ramou-uCy-498805.webp?v=1659143464', 'Průzkum obřího mimozemského artefaktu, který nečekaně vstoupí do sluneční soustavy.', 5, 299, '2026-08-29 12:25:05', 0),
(37, 'Válka světů', 'H. G. Wells', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/17_/1778/valka-svetu-UhN-1778.webp?v=1519733634', 'Klasický příběh o nemilosrdné invazi technologicky vyspělých Marťanů na Zemi.', 5, 299, '2026-08-29 12:25:05', 0),
(38, 'Stroj času', 'H. G. Wells', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/82_/8216/stroj-casu-X20-8216.webp?v=1519066775', 'Cesta do daleké budoucnosti, kde se lidstvo evolučně rozdělilo na dva odlišné druhy.', 5, 299, '2026-08-29 12:25:05', 0),
(39, 'Den trifidů', 'John Wyndham', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/19_/197/den-trifidu-65e21a7d53c5a.webp?v=1709316733', 'Většina lidstva oslepne a hrstka vidoucích musí čelit smrtícím, masožravým rostlinám.', 5, 299, '2026-08-29 12:25:05', 0),
(40, 'Levá ruka tmy', 'Ursula K. Le Guin', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/42_/42513/leva-ruka-tmy-vNQ-42513.webp?v=1605532863', 'Průzkumník se snaží pochopit společnost na ledové planetě, kde obyvatelé nemají stálé pohlaví.', 5, 299, '2026-08-29 12:25:05', 0),
(41, 'Hyperion', 'Dan Simmons', 'Sci-fi', 'beletrie', 'https://covers.openlibrary.org/b/id/380332-L.jpg', 'Poutníci sdílejí své příběhy na cestě k tajemným Hrobkám času, zatímco hrozí intergalaktická válka.', 5, 299, '2026-08-29 12:25:05', 0),
(42, 'Stopařův průvodce Galaxií', 'Douglas Adams', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/39_/3996/stoparuv-pruvodce-galaxii-qT0-3996.webp?v=1639230769', 'Humoristická cesta vesmírem poté, co je Země zničena kvůli stavbě hyperprostorové dálnice.', 5, 299, '2026-08-29 12:25:05', 0),
(43, 'Enderova hra', 'Orson Scott Card', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/32_/322490/enderova-hra-Agm-322490.webp?v=1480405353', 'Nadaný chlapec je cvičen v orbitální vojenské akademii k odvrácení hrozící mimozemské invaze.', 5, 299, '2026-08-29 12:25:05', 0),
(44, 'Hvězdná pěchota', 'Robert A. Heinlein', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/12_/12846/hvezdna-pechota-DFI-12846.webp?v=1592668834', 'Vojenská sci-fi sledující drsný výcvik a boj elitních jednotek proti mimozemským broukům.', 5, 299, '2026-08-29 12:25:05', 0),
(45, 'Fahrenheit 451', 'Ray Bradbury', 'Sci-fi', 'beletrie', 'https://covers.openlibrary.org/b/id/12993656-L.jpg', 'Dystopická vize společnosti, kde hasiči požáry nehasí, ale naopak pálí zakázané knihy.', 5, 299, '2026-08-29 12:25:05', 0),
(46, 'Solaris', 'Stanisław Lem', 'Sci-fi', 'beletrie', 'https://covers.openlibrary.org/b/id/12313764-L.jpg', 'Psychologický střet lidských vědců s nepochopitelným, myslícím oceánem na cizí planetě.', 5, 299, '2026-08-29 12:25:05', 0),
(47, 'Piknik u cesty', 'Arkadij a Boris Strugačtí', 'Sci-fi', 'beletrie', 'https://www.databazeknih.cz/img/books/46_/468037/piknik-u-cesty-boH-468037.webp?v=1615456153', 'Stalker proniká do smrtelně nebezpečného Pásma, aby získal podivné artefakty po mimozemské návštěvě.', 5, 299, '2026-08-29 12:25:05', 0),
(48, 'Bohatý táta, chudý táta', 'Robert T. Kiyosaki', 'Osobní rozvoj', 'naucna', 'https://www.databazeknih.cz/img/books/42_/425338/bohaty-tata-chudy-tata-dj0-425338.webp?v=1582110048', 'Základy finanční gramotnosti a rozdíly v myšlení chudých a bohatých lidí.', 6, 350, '2026-08-29 12:44:28', 0),
(49, 'Atomové návyky', 'James Clear', 'Osobní rozvoj', 'naucna', 'https://www.databazeknih.cz/img/books/43_/431187/atomove-navyky-yA1-431187.webp?v=1655487611', 'Praktický a vědecky podložený průvodce budováním dobrých zvyků.', 10, 400, '2026-08-29 12:44:28', 0),
(50, 'Černá labuť', 'Nassim Nicholas Taleb', 'Ekonomie', 'naucna', 'https://www.databazeknih.cz/img/books/94_/94648/cerna-labut.webp?v=1743145165', 'Vliv vysoce nepravděpodobných událostí na náš život a globální ekonomiku.', 3, 499, '2026-08-29 12:44:28', 0),
(51, 'Krátká historie téměř všeho', 'Bill Bryson', 'Věda', 'naucna', 'https://www.databazeknih.cz/img/books/41_/4160/kratka-historie-mytu-R8U-4160.webp?v=1587141211', 'Srozumitelně a vtipně podaný přehled o vzniku vesmíru, Země a života na ní.', 5, 450, '2026-08-29 12:44:28', 0),
(52, 'Sobecký gen', 'Richard Dawkins', 'Biologie', 'naucna', 'https://www.databazeknih.cz/img/books/60_/607278/sobecky-gen.webp?v=1787161005', 'Revoluční pohled na evoluci z perspektivy genetiky a přirozeného výběru.', 2, 380, '2026-08-29 12:44:28', 0),
(53, 'Proč spíme', 'Matthew Walker', 'Zdraví', 'naucna', 'https://www.databazeknih.cz/img/books/38_/383745/proc-spime-0GD-383745.webp?v=1530181072', 'Odhalení klíčového vlivu spánku na naše zdraví, imunitu a kognitivní schopnosti.', 8, 399, '2026-08-29 12:44:28', 0),
(54, 'Jak získávat přátele a působit na lidi', 'Dale Carnegie', 'Psychologie', 'naucna', 'https://www.databazeknih.cz/img/books/28_/283302/jak-ziskavat-pratele-a-pusobit-na-l-nHL-283302.webp?v=1454778535', 'Klasická příručka pro zlepšení komunikačních a mezilidských dovedností.', 15, 290, '2026-08-29 12:44:28', 0),
(55, 'Tělo sčítá rány', 'Bessel van der Kolk', 'Psychiatrie', 'naucna', 'https://www.databazeknih.cz/img/books/47_/471711/telo-scita-rany-9f7-471711.webp?v=1633258918', 'Studie o tom, jak trauma fyzicky i psychicky mění lidský mozek a tělo.', 4, 450, '2026-08-29 12:44:28', 0),
(56, 'Ticho', 'Susan Cain', 'Psychologie', 'naucna', 'https://www.databazeknih.cz/img/books/14_/141794/ticho-sila-introvertu-ve-svete-kter-8KJ-141794.webp?v=1486594669', 'Síla introvertů ve světě, který nikdy nepřestává mluvit.', 7, 350, '2026-08-29 12:44:28', 0),
(57, 'Vladař', 'Niccolò Machiavelli', 'Politologie', 'naucna', 'https://www.databazeknih.cz/img/books/29_/2946/vladar-9fR-2946.webp?v=1566996870', 'Historický traktát o politické moci, pragmatismu a vládnutí.', 4, 200, '2026-08-29 12:44:28', 0),
(58, 'Umění války', 'Sun-c\'', 'Historie', 'naucna', 'https://www.databazeknih.cz/img/books/24_/249268/umeni-valky-249268.webp?v=1431528848', 'Starověký čínský manuál vojenské strategie a taktiky.', 12, 199, '2026-08-29 12:44:28', 0),
(59, 'Guns, Germs, and Steel', 'Jared Diamond', 'Antropologie', 'naucna', 'https://covers.openlibrary.org/b/id/7884018-L.jpg', 'Evoluční a geografické vysvětlení vývoje lidských civilizací.', 3, 550, '2026-08-29 12:44:28', 0),
(60, 'Slepá skvrna', 'Daniel Prokop', 'Sociologie', 'naucna', 'https://www.databazeknih.cz/img/books/41_/410685/slepe-skvrny-o-chudobe-vzdelavani-p-b1w-410685.webp?v=1571178631', 'Analýza české společnosti, chudoby a vzdělávání.', 9, 350, '2026-08-29 12:44:28', 0),
(61, 'Životice: Obraz (po)zapomenuté tragédie', 'Karin Lednická', 'Historie', 'naucna', 'https://www.databazeknih.cz/img/books/48_/487282/zivotice-obraz-po-zapomenute-traged-cRu-487282.webp?v=1641049120', 'Rekonstrukce historických událostí v těšínské vesnici.', 6, 390, '2026-08-29 12:44:28', 0),
(62, 'Krev, pot a pixely', 'Jason Schreier', 'IT', 'naucna', 'https://www.databazeknih.cz/img/books/40_/403587/krev-pot-a-pixely-pribehy-vitezstvi-dKa-403587.webp?v=1550573650', 'Pohled za oponu vývoje nejznámějších videoher.', 5, 349, '2026-08-29 12:44:28', 0);

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
(19, 'vavrama25@sps-prosek.cz', '562295e360186dd00b6c474975a3c6735f64eddaa36b2449405eb4c4b94c5a31ac391a5c7f818ef40d14b2b0603155c0d90ccdeef87824e2f2383ce487e', 0, 'admin', 5000),
(25, 'user@t.t', '9caa559834bceab5c03f1af79b2e1bb128e5d28f282bfea7aefacd70e012cf169f6b772b2641a8df844b3e8e160547714c6c7f9e30df82ab68ef1ac320a', 0, 'user', 5000),
(26, 'worker@t.t', '976af98194918ef28f6d0cfc4d2acd952d10a86130846312d306edbd77e652708109f7d859be3743a8375f47470b5751b3b08145a1b6ac1ebb90a7e7954', 0, 'worker', 5000),
(27, 'admin@t.t', '86ffbd5b4a674488cb9db4888ee24c324d425d6ca309ff65e9c4c8f10b5160f7dd1f538f4d12725ae091850608b2d7cfa131c52e482934129aa10eeea14', 0, 'user', 0);

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
  MODIFY `ID_cms-content` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pro tabulku `cms-login`
--
ALTER TABLE `cms-login`
  MODIFY `ID_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pro tabulku `cms-reset_pass`
--
ALTER TABLE `cms-reset_pass`
  MODIFY `ID_reset_pass` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
