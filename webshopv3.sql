-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Már 26. 15:59
-- Kiszolgáló verziója: 10.4.25-MariaDB
-- PHP verzió: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `webshopv3`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gyarto`
--

CREATE TABLE `gyarto` (
  `gyartoId` int(255) NOT NULL,
  `gyartoNev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `gyarto`
--

INSERT INTO `gyarto` (`gyartoId`, `gyartoNev`) VALUES
(1, 'AMD'),
(2, 'INTEL'),
(3, 'ASUS'),
(4, 'Deepcool'),
(5, 'NZXT'),
(6, 'Gigabyte'),
(7, 'Msi'),
(8, 'Arctic'),
(9, 'be quiet!'),
(10, 'Kingston'),
(11, 'Corsair'),
(12, 'ASRock'),
(13, 'SAPPHIRE'),
(14, 'PowerColor'),
(15, 'Gainward'),
(16, 'ZOTAC'),
(17, 'Samsung'),
(18, 'Seasonic'),
(19, 'FSP'),
(20, 'Noctua'),
(21, 'Cooler Master'),
(22, 'SilentiumPC');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gyartokategoria`
--

CREATE TABLE `gyartokategoria` (
  `gyartoKategoriaId` int(255) NOT NULL,
  `kategoriaID` int(255) NOT NULL,
  `gyartoId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `gyartokategoria`
--

INSERT INTO `gyartokategoria` (`gyartoKategoriaId`, `kategoriaID`, `gyartoId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 3, 4),
(5, 3, 5),
(6, 4, 6),
(7, 4, 7),
(8, 4, 3),
(9, 5, 8),
(10, 5, 9),
(11, 6, 10),
(12, 7, 10),
(13, 8, 11),
(14, 9, 8),
(15, 2, 6),
(16, 2, 12),
(17, 2, 7),
(18, 4, 13),
(19, 4, 14),
(20, 4, 15),
(21, 4, 16),
(22, 4, 2),
(23, 4, 12),
(24, 7, 17),
(25, 8, 18),
(26, 8, 19),
(27, 8, 3),
(28, 8, 9),
(29, 5, 20),
(30, 5, 21),
(31, 5, 3),
(32, 9, 9),
(33, 9, 22);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoria`
--

CREATE TABLE `kategoria` (
  `kategoriaID` int(255) NOT NULL,
  `kategoriaNev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kategoria`
--

INSERT INTO `kategoria` (`kategoriaID`, `kategoriaNev`) VALUES
(1, 'processzor'),
(2, 'alaplap'),
(3, 'gépház'),
(4, 'videókártya'),
(5, 'processzor hűtő'),
(6, 'ram'),
(7, 'ssd'),
(8, 'tápegység'),
(9, 'rendszerhűtő');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kedvenctermekek`
--

CREATE TABLE `kedvenctermekek` (
  `id` int(255) NOT NULL,
  `termekId` int(255) NOT NULL,
  `usersId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `megrendeles`
--

CREATE TABLE `megrendeles` (
  `id` int(255) NOT NULL,
  `usersId` int(255) NOT NULL,
  `termekId` int(255) NOT NULL,
  `raktaron` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `megrendeles`
--

INSERT INTO `megrendeles` (`id`, `usersId`, `termekId`, `raktaron`) VALUES
(1, 1, 2, 1),
(17, 1, 16, 1),
(18, 1, 6, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termek`
--

CREATE TABLE `termek` (
  `id` int(255) NOT NULL,
  `gyartoKategoriaId` int(255) NOT NULL,
  `termekNev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `leiras` text COLLATE utf8_hungarian_ci NOT NULL,
  `darab` int(11) NOT NULL,
  `ar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `termek`
--

INSERT INTO `termek` (`id`, `gyartoKategoriaId`, `termekNev`, `foto`, `leiras`, `darab`, `ar`) VALUES
(1, 1, 'Ryzen 5 5600X', '744222552.amd-ryzen-5-5600x-6-core-3-7ghz-am4-box-with-fan-and-heatsink.jpg', 'a', 70, 71990),
(2, 1, 'Ryzen 5 5600', '955227552.amd-ryzen-5-5600-6-core-3-5ghz-am4-box.jpg', 'a', 40, 57990),
(3, 1, 'Ryzen 7 5800X3D', '965421375.amd-ryzen-7-5800x3d-8-core-3-4ghz-1p-box-without-fan-and-heatsink.jpg', 'a', 40, 147100),
(4, 1, 'Ryzen 5 7600X', '1038359685.amd-ryzen-5-7600x-4-7ghz-6-core-am5-box.jpg', 'a', 40, 107810),
(5, 2, 'Core i5-12400F', '915286329.intel-i5-12400f-6-core-2-50ghz-lga1700-box.jpg', 'a', 40, 68040),
(6, 2, 'Core i5-10400F', '1676806737.jpg', 'a', 40, 42250),
(7, 2, 'Core i9-13900K', '1676969510.jpg', 'a', 40, 244890),
(8, 3, 'TUF GAMING B550M-PLUS', '695341464.asus-tuf-gaming-b550m-plus.jpg', 'a', 40, 52490),
(9, 3, 'ROG STRIX B550-F GAMING', '698708712.asus-rog-strix-b550-f-gaming.jpg', 'a', 40, 71990),
(10, 3, 'TUF GAMING B660M-PLUS D4', '915660159.asus-tuf-gaming-b660m-plus-d4.jpg', 'a', 40, 58740),
(11, 3, 'PRIME Z690-P', '891175479.asus-prime-z690-p.jpg', 'a', 40, 84590),
(12, 4, 'CC560', '967321644.deepcool-cc560-r-cc560-whgaa4-g-1-bkgaa4-g-1.jpg', 'a', 40, 15349),
(13, 5, 'H7 Flow CM-H71FG', '1676979586.jpg', 'a', 40, 53490),
(14, 6, 'RTX 4090', '1069127082.asrock-intel-arc-a770-phantom-gaming-d-8gb-oc-a770-pgd-8go.jpg', 'a', 40, 600000),
(15, 7, 'GeForce RTX 3060 Ti', 'rtx3060ti.png', 'a', 40, 195790),
(16, 8, 'ROG-STRIX-RTX4090', 'asusrogstrixrtx4090.png', 'a', 40, 970490),
(17, 9, 'Freezer 34 eSports DUO', '550155075.arctic-freezer-34-esports-duo-black-white-acfre00061a.jpg', 'a', 40, 20890),
(18, 10, 'DARK ROCK PRO 4', '493171767.be-quiet-dark-rock-pro-4-bk022.jpg', 'a', 40, 35890),
(19, 11, 'FURY Renegade 32GB DDR4', '841698945.kingston-fury-renegade-32gb-2x16gb-ddr4-3600mhz-kf436c16rb1k2-32.jpg', 'a', 40, 41070),
(20, 11, 'FURY Renegade 32GB DDR5', '1005314217.kingston-fury-renegade-32gb-2x16gb-ddr5-6000mhz-kf560c32rsk2-32.jpg', 'a', 40, 75599),
(21, 12, 'A400 2.5 480GB SA400S37/480G', '436646953.kingston-a400-2-5-480gb-sata3-sa400s37-480g.jpg', 'a', 40, 11290),
(22, 13, 'CX750M 750W', '161954174.corsair-cx-series-cx750m-750w-bronze-cp-9020061.jpg', 'a', 40, 29900),
(23, 13, 'RM1000x 1000W', '161954174.corsair-cx-series-cx750m-750w-bronze-cp-9020061.jpg', 'a', 40, 93585),
(24, 14, 'P12 PWM PST 120x120x25mm', '531470055.arctic-p12-pwm-pst-120x120x25mm-acfan00120a.jpg', 'a', 40, 2080),
(25, 14, 'Liquid Freezer 280', '625841214.arctic-liquid-freezer-280-ii-aio-acfre00066a.jpg', 'a', 40, 46590),
(26, 2, 'Core i9-12900K', 'i9-12900k.png', 'a', 40, 199780),
(27, 1, 'Ryzen 7 2700X', 'amd ryzen 7 2700X.png', 'a', 40, 53263),
(28, 1, 'Ryzen 9 7950X3D', 'Ryzen 9 7950X3D.png', 'a', 40, 325090),
(29, 2, 'Core i9-11900K', 'intel9-11900k.png', 'a', 40, 196690),
(30, 1, 'Ryzen PRO 3995WX', 'amd ryzen pro 3995WX.png', 'a', 40, 2552870),
(31, 2, 'Core i9-13900F', 'i9-13900F.png', 'a', 40, 224270),
(32, 1, 'EPYC 7513', 'epyc7513.png', 'a', 40, 1009904),
(33, 2, 'i3-10100F', 'i3-10100F.png', 'a', 40, 24490),
(34, 2, 'i3-12100', 'i3-12100.png', 'a', 40, 48393),
(35, 3, 'PRIME B450M-K II', 'prime b450m k2.png', 'a', 40, 21799),
(36, 3, 'TUF GAMING B560M-PLUS WIFI', 'asustufgaming b560m pluswifi.png', 'a', 40, 51190),
(37, 15, 'H410M-H V2', 'h410m-hv2.png', 'a', 40, 23950),
(38, 16, 'B550M Phantom Gaming 4', 'asrockb550mphantom.png', 'a', 40, 37210),
(39, 3, 'ROG STRIX Z790-F GAMING WIFI', 'asusrogstrixz790-f.png', 'a', 40, 185000),
(40, 17, 'MAG B650 Tomahawk WIFI', 'msimagb650 tomahwak.png', 'a', 40, 102290),
(41, 15, 'B550 AORUS ELITE AX v2', 'adrusb550eliteaxv2.png', 'a', 40, 65120),
(42, 15, 'ROG STRIX X670E-F GAMING WIFI', 'asusrogstrix x670e-f.png', 'a', 40, 180440),
(43, 3, 'Prime B650-Plus', 'asusprimeb650.png', 'a', 40, 75900),
(44, 16, 'B450 Steel Legend', 'asrock b450 steellegend.png', 'a', 40, 42050),
(45, 3, 'PRIME B650M-A II', 'asusprime b650.png', 'a', 40, 67990),
(46, 15, 'Z690 GAMING X DDR4', 'gigabyte z690 gaming x ddr4.png', 'a', 40, 87050),
(47, 18, 'Radeon RX 6700 10G OC DDR6', 'sapphire radon rx 6700.png', 'a', 40, 151575),
(48, 18, 'Radeon RX 6800 XT 16GB NITRO SE 16GB GDDR6', 'sapphire radeon rx 6800 xt 16gb.png', 'a', 40, 269900),
(49, 18, 'Radeon RX 7900 XT 20G', 'sapphire raden rx 7900 xt.png', 'a', 40, 375200),
(50, 19, 'Radeon RX 6800 Fighter 16GB', 'radeon rx 6800 fighter.png', 'a', 40, 217700),
(51, 6, 'GeForce RTX 4070 Ti AORUS ELITE 12GB', 'gefore rtx 4070ti.png', 'a', 40, 424540),
(52, 20, 'GeForce Phoenix RTX 3070 Ti 8GB', 'gefore rtx 3070 ti 8 gb.png', 'a', 40, 242990),
(53, 8, ' GeForce RTX 3060 12GB', 'asus geforce rtx 3060 12 gb.png', 'a', 40, 183630),
(54, 6, 'RTX 3060 WINDFORCE OC 12G', 'gigabyte rtx 3060 windforce.png', 'a', 40, 144680),
(55, 21, 'GeForce RTX 4080 Trinity 16GB', 'zotac geforce rtx 4080 trinity.png', 'a', 40, 519990),
(56, 7, 'GeForce RTX 4080 SUPRIM X', 'rtx 4080 supreme x.png', 'a', 40, 500000),
(57, 22, 'ARC A770 16GB DDR6', 'arc a770 16 gb.png', 'a', 40, 155750),
(58, 23, 'Intel Arc A380 Challenger ITX 6GB', 'asrock intel arc a380 challanger.png', 'a', 40, 65100),
(59, 5, 'H1 Mini-ITX 650W', 'H1_Mini-ITX_650W.png', 'a', 40, 57990),
(60, 4, 'Matrexx 30', 'Matrexx_30.png', 'a', 40, 13890),
(61, 5, 'H210', 'H210.png', 'a', 40, 24240),
(62, 5, 'H7 Elite', 'H7_Elite.png', 'a', 40, 96360),
(63, 5, 'H700 Matte', 'H700_Matte.png', 'a', 40, 51999),
(64, 4, 'CK560', 'CK560.png', 'a', 40, 40390),
(65, 4, 'Wave V2', 'Wave_V2.png', 'a', 40, 10630),
(66, 4, 'Smarter', 'Smarter.png', 'a', 40, 14799),
(67, 4, 'CG540', 'CG540.png', 'a', 10, 34290),
(68, 4, 'QUADSTELLER INFINITY', 'QUADSTELLER_INFINITY.png', 'a', 5, 127940),
(69, 5, 'H5 Flow', 'H5_Flow.png', 'a', 20, 47380),
(70, 4, 'MATREXX 40 3FS', 'MATREXX_40_3FS.png', 'a', 20, 20430),
(71, 24, '2.5 870 EVO 500GB SATA3', 'Samsung_SSD.png', 'a', 50, 18500),
(72, 24, '2.5 870 EVO 1TB SATA3', 'Samsung_SSD.png', 'a', 50, 34580),
(73, 24, '870 QVO 2.5 1TB SATA3', 'Samsung_SSD2.png', 'a', 50, 28200),
(74, 24, '870 QVO Slim 2.5 2TB SATA3', 'Samsung_SSD2.png', 'a', 30, 49500),
(75, 24, '2.5 870 EVO 250GB SATA3', 'Samsung_SSD.png', 'a', 50, 12080),
(76, 24, '870 QVO 2.5 4TB', 'Samsung_SSD2.png', 'a', 10, 98640),
(77, 25, 'G12 GC-750W Gold', 'G12_GC-750W_Gold.png', 'a', 30, 34590),
(78, 26, 'HYDRO PRO 800W 80 Plus Bronze', 'HYDRO_PRO_800W_80_Plus_Bronze.png', 'a', 30, 28580),
(79, 27, 'ROG STRIX 850W GOLD', 'ROG_STRIX_850W_GOLD.png', 'a', 20, 61690),
(80, 27, 'ROG Strix 1000W 80+ Gold', 'ROG_Strix_1000W_80+_Gold.png', 'a', 20, 76990),
(81, 26, 'Hyper 80+ Pro 650w', 'Hyper_80+_Pro_650w.png', 'a', 50, 26490),
(82, 26, 'Hydro M PRO 600W', 'Hydro_M_PRO_600W.png', 'a', 50, 30070),
(83, 26, 'Hydro GSM Lite Pro 750W 80 Plus Gold', 'Hydro_GSM_Lite_Pro.png', 'a', 40, 36060),
(84, 28, 'Straight Power 11 850W Gold', 'Straight_Power_11_850W_Gold.png', 'a', 30, 63020),
(86, 11, 'FURY Beast 16GB (2x8GB) DDR4', 'ram1.png', 'a', 40, 17000),
(87, 11, 'FURY Renegade 32GB (2x16GB) DDR4', 'ram2.png', 'a', 40, 38510),
(88, 11, 'FURY Renegade 32GB (2x16GB) DDR5', 'ram3.png', 'a', 40, 62199),
(89, 11, 'FURY Beast 32GB (2x16GB) DDR4', 'ram4.png', 'a', 40, 32600),
(90, 11, 'FURY Beast RGB 16GB (2x8GB) DDR4', 'ram5.png', 'a', 40, 20800),
(91, 11, 'FURY Beast 32GB (2x16GB) DDR5', 'ram6.png', 'a', 30, 55920),
(92, 11, 'FURY Renegade 16GB (2x8GB) DDR4', 'ram7.png', 'a', 40, 21280),
(93, 11, 'FURY Impact 32GB (2x16GB) DDR4', 'ram8.png', 'a', 40, 21750),
(94, 11, 'FURY Beast RGB 16GB DDR4', 'ram9.png', 'a', 30, 21750),
(95, 11, 'FURY Renegade RGB 32GB (2x16GB) DDR5', 'ram10.png', 'a', 30, 65120),
(96, 11, ' FURY Beast RGB 32GB (2x16GB) DDR5', 'ram11.png', 'a', 40, 62900),
(97, 11, 'FURY Beast 128GB (4x32GB) DDR4', 'ram12.png', 'a', 10, 161110),
(98, 10, 'Pure Rock 2 (BK007)', 'procHuto1.png', 'a', 30, 16170),
(99, 29, 'Chromax NH-D15', 'procHuto2.png', 'a', 30, 52360),
(100, 30, 'MasterLiquid ML120L RGB V2', 'procHuto3.png', 'a', 50, 13860),
(101, 10, 'Pure Rock 2 FX 120mm ARGB', 'procHuto4.png', 'a', 40, 18450),
(102, 29, 'NH-D15', 'procHuto5.png', 'a', 20, 48100),
(103, 9, 'Liquid Freezer II 240', 'procHuto6.png', 'a', 30, 38350),
(104, 31, 'ROG STRIX LC 360 RGB', 'procHuto7.png', 'a', 15, 92499),
(105, 32, 'Pure Wings 2 140mm PWM High-Speed', 'rendszerhuto1.png', 'a', 30, 4690),
(106, 32, 'Pure Wings 2 120mm', 'rendszerhuto2.png', 'a', 60, 1520),
(107, 14, 'P12 PWM', 'rendszerhuto3.png', 'a', 50, 5150),
(108, 14, 'F9 Silent', 'rendszerhuto4.png', 'a', 50, 1520),
(109, 14, 'F9', 'rendszerhuto5.png', 'a', 50, 1600),
(110, 33, 'Zephyr', 'rendszerhuto6.png', 'a', 40, 2100);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'user',
  `keresztNev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `vezetekNev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `kartyaszam` int(255) NOT NULL,
  `kartyaKod` int(255) NOT NULL,
  `telefonszam` int(255) NOT NULL,
  `kiszallitasiCim` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `varos` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `megye` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `keresztNev`, `vezetekNev`, `kartyaszam`, `kartyaKod`, `telefonszam`, `kiszallitasiCim`, `varos`, `megye`) VALUES
(1, 'DrSeres', 'drseres@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin', 'Seres', 'Seres', 2660, 452, 2147483647, 'drhdhbd', 'dfhdhdf', 'gdrghdgdr'),
(4, 'user', 'user@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user', '', '', 0, 0, 0, '', '', '');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `gyarto`
--
ALTER TABLE `gyarto`
  ADD PRIMARY KEY (`gyartoId`);

--
-- A tábla indexei `gyartokategoria`
--
ALTER TABLE `gyartokategoria`
  ADD PRIMARY KEY (`gyartoKategoriaId`),
  ADD KEY `kategoriaID` (`kategoriaID`),
  ADD KEY `gyartoId` (`gyartoId`);

--
-- A tábla indexei `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`kategoriaID`);

--
-- A tábla indexei `kedvenctermekek`
--
ALTER TABLE `kedvenctermekek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `termekId` (`termekId`),
  ADD KEY `usersId` (`usersId`);

--
-- A tábla indexei `megrendeles`
--
ALTER TABLE `megrendeles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `termekId` (`termekId`),
  ADD KEY `usersId` (`usersId`);

--
-- A tábla indexei `termek`
--
ALTER TABLE `termek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gyartoKategoriaId` (`gyartoKategoriaId`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `gyarto`
--
ALTER TABLE `gyarto`
  MODIFY `gyartoId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT a táblához `gyartokategoria`
--
ALTER TABLE `gyartokategoria`
  MODIFY `gyartoKategoriaId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT a táblához `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `kategoriaID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `kedvenctermekek`
--
ALTER TABLE `kedvenctermekek`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `megrendeles`
--
ALTER TABLE `megrendeles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `termek`
--
ALTER TABLE `termek`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `gyartokategoria`
--
ALTER TABLE `gyartokategoria`
  ADD CONSTRAINT `gyartokategoria_ibfk_1` FOREIGN KEY (`kategoriaID`) REFERENCES `kategoria` (`kategoriaID`),
  ADD CONSTRAINT `gyartokategoria_ibfk_2` FOREIGN KEY (`gyartoId`) REFERENCES `gyarto` (`gyartoId`);

--
-- Megkötések a táblához `kedvenctermekek`
--
ALTER TABLE `kedvenctermekek`
  ADD CONSTRAINT `kedvenctermekek_ibfk_1` FOREIGN KEY (`termekId`) REFERENCES `termek` (`id`),
  ADD CONSTRAINT `kedvenctermekek_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `megrendeles`
--
ALTER TABLE `megrendeles`
  ADD CONSTRAINT `megrendeles_ibfk_1` FOREIGN KEY (`termekId`) REFERENCES `termek` (`id`);

--
-- Megkötések a táblához `termek`
--
ALTER TABLE `termek`
  ADD CONSTRAINT `termek_ibfk_1` FOREIGN KEY (`gyartoKategoriaId`) REFERENCES `gyartokategoria` (`gyartoKategoriaId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
