-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Feb 19. 16:08
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `webshop`
--
CREATE DATABASE IF NOT EXISTS `webshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `webshop`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `alaplap`
--

CREATE TABLE `alaplap` (
  `id` int(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `marka` varchar(50) NOT NULL,
  `tipus` varchar(255) NOT NULL,
  `cpu_foglalat` varchar(255) NOT NULL,
  `chipset` varchar(255) NOT NULL,
  `processzor_gyarto` varchar(255) NOT NULL,
  `memoria` varchar(10) NOT NULL,
  `leiras` text NOT NULL,
  `ar` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `alaplap`
--

INSERT INTO `alaplap` (`id`, `foto`, `marka`, `tipus`, `cpu_foglalat`, `chipset`, `processzor_gyarto`, `memoria`, `leiras`, `ar`) VALUES
(1, 'alaplap.jpg', 'ASUS', 'TUF GAMING B550M-PLUS', 'Socket AM4', 'AMD B550', 'AMD', 'DDR4', 'Chipset típus:B550,\r\nCrossfire támogatás:Igen,\r\nD-Sub kimenet:Nem,\r\nDisplayPort kimenet:1,\r\nDVI-D kimenet:Nem,\r\nDVI-I kimenet:Nem,\r\neSATA kimenet:0,\r\nFormátum:Micro-ATX,\r\nHálózati csatlakozás:1 x 100/1000/2500 Mb/s,\r\nHDMI kimenet:1,\r\nM. 2 csatlakozó:2,\r\nMaximum memória (GB):128,\r\nMemória foglalat:DDR4,\r\nMemória foglalatok száma:4,\r\nMemória sebesség (Mhz):4800,\r\nMini PCI-E:Nem,\r\nmSATA csatlakozó:Nem,\r\nPCI csatlakozó:0,\r\nProcesszor foglalat:AMD AM4,\r\nPS/2 csatlakozó:2,\r\nRaid:0,1, 10,\r\nS/PDIF optikai kimenet:Nem,\r\nSATA 2 csatlakozó:0,\r\nSATA 3 csatlakozó:4,\r\nSLI támogatás:Nem,\r\nTáp csatlakozó (pin):24+8,\r\nUSB 2.0 kimenet:2,\r\nUSB 3.0 kimenet:4,\r\nUSB 3.1 kimenet:1,\r\nVezeték nélküli hálózat:Nem,\r\nUSB Type-C:1,\r\nPCI-e verzió:3.0, 4.0,\r\nPCI-e x1 csatlakozó:1,\r\nPCI-e x4 csatlakozó:0,\r\nPCI-e x16 csatlakozó:2,', 52490),
(2, 'alaplap.jpg', 'ASUS', 'ROG STRIX B550-F GAMING', 'Socket AM4', 'AMD B550', 'AMD', 'DDR4', 'Chipset típus:B550,\r\nCrossfire támogatás:Igen,\r\nD-Sub kimenet:Nem,\r\nDisplayPort kimenet:1,\r\nDVI-D kimenet:Nem,\r\nDVI-I kimenet:Nem,\r\neSATA kimenet:0,\r\nFormátum:ATX,\r\nHálózati csatlakozás:1 x 100/1000/2500 Mb/s,\r\nHDMI kimenet:1,\r\nm. 2 csatlakozó:2,\r\nMaximum memória (GB):128,\r\nMemória foglalat:DDR4,\r\nMemória foglalatok száma:4,\r\nMemória sebesség (Mhz):5100,\r\nMini PCI-E:Nem,\r\nmSATA csatlakozó:Nem,\r\nPCI csatlakozó:0,\r\nPCI-e verzió:3.0, 4.0,\r\nPCI-E x1 csatlakozó:3,\r\nPCI-e x16 csatlakozó:2,\r\nPCI-e x4 csatlakozó:0,\r\nProcesszor foglalat:AMD AM4,\r\nPS/2 csatlakozó:0,\r\nRaid:0,1, 10,\r\nS/PDIF optikai kimenet:Nem,\r\nSATA 2 csatlakozó:0,\r\nSATA 3 csatlakozó:6,\r\nSLI támogatás:Nem,\r\nTáp csatlakozó (pin):24+8+4,\r\nUSB 2.0 kimenet:2,\r\nUSB 3.0 kimenet:4,\r\nUSB 3.1 kimenet:2,\r\nUSB Type-C:0,\r\nVezeték nélküli hálózat:Nem', 71990),
(3, 'alaplap.jpg', 'ASUS', 'TUF GAMING B660M-PLUS D4', 'Socket 1700', 'Intel B660', 'Intel', 'DDR4', 'Foglalat és lapkakészlet\r\nFoglalat: Intel LGA1700\r\nLapkakészlet: Intel B660\r\n\r\nFormátum & funkciók\r\nAlaplap formátum: mATX (Micro ATX)\r\nAlapvető funkciók: Integrált hálózati kártya, Integrált hangkártya, M.2 , PCI Express 5.0, CPU hely integrált GPU-val, Serial ATA III\r\n\r\nRendszermemória\r\nKivitelezés: DIMM\r\nMemória típusa: DDR4\r\nRAM slotok száma: 4 ×\r\nCsatlakozás mód: Dual-channel\r\nMax. frekvencia (OC): 5 333 MHz\r\n\r\nFejlett paraméterek\r\nFejlett funkciók: Aura Sync, UEFI BIOS\r\nHangkártya típusa: Realtek 7.1\r\nHangkártya-csatornák száma: 8\r\n\r\nSorozat\r\nSorozat: Asus TUF Gaming\r\nCsatlakozók\r\n\r\nKülső: DisplayPort, HDMI, Jack, RJ-45 (LAN) 2.5Gbps, S/PDIF , USB 2.0, USB 3.2 Gen 1 (USB 3.0), USB 3.2 Gen 2, USB 3.2 Gen 2x2, USB-C\r\nBelső: ARGB LED Header, COM header, M2 foglalat, RGB LED Header, Serial-ATA-III, Thunderbolt header, USB 2.0 header, USB 3.2 Gen 1 bracket, USB-C 3.2 Gen 1 header\r\nPCI Express x16: 2×\r\nPCI express x1: 1×\r\nM.2 slotok: 2×\r\nUSB 2.0: 2×\r\nUSB 3.2 Gen 1 (USB 3.0): 1×\r\nUSB 3.1 (3.1 gen2): 4×\r\nUSB 3.2 Gen 2x2: 1×\r\nSerial ATA III: 4×', 58740),
(4, 'alaplap.jpg', 'ASUS', 'PRIME Z690-P', 'Socket 1700', 'Intel Z690', 'Intel', 'DDR5', 'Intel Z690 LGA 1700 ATX alaplap, PCIe 5.0, DDR5, 3 db M. 2, 14+1 DrMOS, 2.5G Ethernet, USB 3.2 Gen 2x2 Type-C, Thunderbolt 4 támogatás, AuraSync RGB\r\n\r\nAz ASUS Prime sorozatú alaplapokat szakértő módon úgy tervezték, hogy a 12. generációs Intel® processzorok teljes potenciálját kiaknázzák. A robusztus teljesítménykialakítással, átfogó hűtési megoldásokkal és intelligens hangolási lehetőségekkel büszkélkedő Prime Z690-P a felhasználók és a PC-barkácsok számára számos teljesítményhangolási lehetőséget kínál az intuitív szoftver- és firmware-funkciók segítségével.\r\n\r\nIntel LGA 1700 foglalat: készen áll a 12. generációs Intel processzorok fogadására\r\nFejlett tápellátás: 14+1 DrMOS tápfázis, 8+4 tűs ProCool tápcsatlakozó, ötvözet fojtótekercsek és tartós kondenzátorok a stabil tápellátásért\r\nÁtfogó hűtés: nagy VRM hűtőbordák, M. 2 hűtőborda, PCH hűtőborda, hibrid ventilátorcsatlakozók és Fan Xpert 4 szolgáltatás\r\nAsus Optimem II: precíz vonalvezetés és földréteg optimalizálás a jelintegritás megőrzéséért, a jobb memória túlhajtásért\r\nKövetkező generációs csatlakozók: DDR5, PCIe 5.0, 2.5G Ethernet, USB 3.2 Gen 2x2 Type-C, előlapi USB 3.2 Gen 1 Type-C, Thunderbolt 4 támogatás', 84590);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gephaz`
--

CREATE TABLE `gephaz` (
  `id` int(255) NOT NULL,
  `marka` varchar(25) NOT NULL,
  `modell` varchar(75) NOT NULL,
  `szelesseg` int(15) NOT NULL,
  `melyseg` int(15) NOT NULL,
  `alaplap_atx` tinyint(1) NOT NULL,
  `alaplap_micro_atx` tinyint(1) NOT NULL,
  `alaplap_extended_atx` tinyint(1) NOT NULL,
  `alaplap_mini_itx` tinyint(1) NOT NULL,
  `audio` tinyint(1) NOT NULL,
  `firewire` tinyint(1) NOT NULL,
  `esata` tinyint(1) NOT NULL,
  `leiras` text NOT NULL,
  `ar` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `gephaz`
--

INSERT INTO `gephaz` (`id`, `marka`, `modell`, `szelesseg`, `melyseg`, `alaplap_atx`, `alaplap_micro_atx`, `alaplap_extended_atx`, `alaplap_mini_itx`, `audio`, `firewire`, `esata`, `leiras`, `ar`) VALUES
(1, 'NZXT', 'H510 Flow (CA-H52FB/W)', 210, 428, 1, 1, 0, 1, 1, 0, 0, 'Ez a kompakt miditorony ideális a nagy teljesítményű rendszerekhez, és perforált előlappal rendelkezik a maximális légáramlás érdekében. A H510 könnyen beépíthető, és rugalmasságot kínál a különböző ATX alkatrészekhez.\r\n\r\nAz optimalizált perforált első panel fokozott légáramlást biztosít a rendszer számára a jobb hőmérséklet érdekében.\r\nIkonikus NZXT kábelkezelő sáv és teljes edzett üveg oldallap\r\nKábelvezető készlet előre telepített csatornákkal és pántokkal\r\nKét Aer F120 mm-es ventilátor és kivehető szűrők minden szellőzőnyíláson\r\nLegfeljebb 280 mm-es radiátorokhoz tervezett levehető konzol', 38990),
(2, 'Deepcool', 'CC560 (R-CC560-WHGAA4-G-1/BKGAA4-G-1)', 210, 417, 1, 1, 0, 1, 1, 0, 0, 'A DeepCool CC560 WH Mid-Tower Case fehér színben kiemelkedő értéket kínál tágas alkatrész-kompatibilitással, teljes méretű edzett üvegablakkal és összesen négy előre telepített LED-es ventilátorral, amelyekkel minden építés jól indul.\r\n\r\nLégáramlási teljesítmény\r\n\r\nA CC560 WH jól szellőzik az egész házban, a CC560 WH egy légáramoltató előlappal és egy nagyméretű hálós felső panellel rendelkezik, hogy biztosítsa a friss levegő keringését.\r\n\r\nAlapozott és kész\r\n\r\nAz összesen 4 előre beszerelt LED-es ventilátor nagy légáramlási teljesítményt nyújt, biztosítva, hogy bármilyen rendszer felépítése csúcsminőségű hűtési teljesítményt kapjon.\r\n\r\nSzéles hűtési támogatás\r\n\r\nElegendő hely a nagy teljesítményű AIO folyadékhűtők támogatásához 360 mm-es radiátorok számára elöl vagy 240 mm-es radiátorok számára felül. Akár 6x 120mm-es vagy 4x 140mm-es hűtőventilátor támogatása.\r\n\r\nTárolási megoldások\r\n\r\nTelepítsen akár 2x 2,5\" SSD-t közvetlenül a hátlapra és 2x 3,5\" HDD-t a burkolat alá a kivehető meghajtóketrecbe az állítási lehetőség érdekében.', 15349);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `processzor`
--

CREATE TABLE `processzor` (
  `id` int(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `marka` varchar(40) NOT NULL,
  `tipus` varchar(200) NOT NULL,
  `magok` int(3) NOT NULL,
  `szalak` int(11) NOT NULL,
  `processzor_foglalat` varchar(200) NOT NULL,
  `processzor_orajel` int(10) NOT NULL,
  `processzor_turbo_orajel` int(10) NOT NULL,
  `integralt_grafikai_processzor` varchar(200) DEFAULT NULL,
  `leiras` text NOT NULL,
  `ar` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `processzor`
--

INSERT INTO `processzor` (`id`, `foto`, `marka`, `tipus`, `magok`, `szalak`, `processzor_foglalat`, `processzor_orajel`, `processzor_turbo_orajel`, `integralt_grafikai_processzor`, `leiras`, `ar`) VALUES
(1, 'processzorok-1920x960.jpg', 'AMD', 'Ryzen 5 5600X', 6, 12, 'AMD Socket AM4', 3700, 4600, NULL, '<table class=\'tulajdonsagok\'>\n        <tr>\n        <th colspan=\"2\"><img src=\"notes.png\" alt=\"\">Tulajdonságok</th>\n               </tr>        <tr>        <td>Processzor sorozat: <b> AMD Ryzen 5</b></td>\n        <td> Foglalat: <b> AMD AM4</b></td>\n                </tr>        <tr>        <td>Mikroarchitektúra: <b> Zen 3 </b> </td>\n        <td>Processzor kódnév:  <b> Vermeer</b></td>\       \n        </tr>\n        <tr>        <td>Hűtés típusa: <b> Wraith Stealth</b></td>\n        <td>Processzormagok száma: <b> 6 ×</b></td>\n        \n        </tr>\n        <tr>        <td>Szálak száma: <b> 12 ×</b></td>\n        <td>Processzor frekvencia: <b> 3,7 GHz (3,7 GHz)</b></td>\n        \n        </tr>\n        <tr>\n            <td>Támogatott memóriatípus: <b> DDR4</b></td>\n            <td>Integrált videókártya típusa: <b> Beépített grafikus chip nélkül</b></td>\n        </tr>\n      </table>', 71999),
(2, 'processzorok-1920x960.jpg', 'AMD', 'Ryzen 5 5600', 6, 12, 'AMD Socket AM4', 3500, 4400, NULL, 'AMD Ryzen 5 asztali processzor\r\n6 mag 12 szál\r\n3.5 GHz alap órajel\r\n4.4 GHz Max Boost órajel\r\n32 MB L3 Cache\r\nTúlhajtható\r\nTSMC 7nm FinFET gyártástechnológia\r\nAM4 tokozás\r\nPCIe 4.0 támogatás\r\n65W alap TDP\r\nMax 95°C hőmérséklet\r\nDDR4 3200 MHz memória támogatás\r\nAMD Zen 3 mag architektúra\r\nAMD StoreMI technológia\r\nAMD Ryzen Master szolgáltatás\r\nAMD Ryzen VR-Ready Premium\r\nFoglalat: Socket AM4\r\nProcesszor órajel: 3.5 GHz\r\nTurbo órajel (max): 4.4 GHz\r\nMagok száma: 6 db\r\nFeldolgozó szálak száma: 12 db\r\nCsomagolás: Dobozos (hűtővel)\r\nProcesszorhűtő típusa, ha van: AMD Wraith Stealth\r\nCache memória: 32 MB\r\nUtasításkészlet: 64-bit\r\nTechnológia: 7 nm\r\nTDP-érték: 65 W\r\nFelhasználási terület: Asztali PC', 57999),
(3, 'processzorok-1920x960.jpg', 'AMD', 'Ryzen 7 5700X', 8, 16, 'AMD Socket AM4', 3400, 4600, NULL, 'Cache memória: 36 MB\r\nCPU foglalat: AM4\r\nProcesszor frekvencia (MHz): 3.4 GHz\r\nTurbo Boost akár: 4.6 GHz\r\nÜzemmód (bit): 64\r\nMagok száma: 8\r\nSzálak száma: 16\r\nGyártási technológia (nanométer): TSMC 7nm FinFET\r\nHőenergia (W): 65\r\nEgyéb: PCIe 4.0\r\nCsomag tartalma: 1 x processzor', 83500),
(4, 'processzorok-1920x960.jpg', 'AMD', 'Ryzen 7 5800X3D', 8, 16, 'AMD Socket AM4', 3400, 4500, NULL, '', 147100),
(5, 'processzorok-1920x960.jpg', 'AMD', 'Ryzen 5 7600X', 6, 12, 'AMD Socket AM5', 4700, 5300, 'AMD Radeon Graphics', '', 107810),
(6, 'processzorok-1920x960.jpg', 'Intel', 'Core i5-12400F', 6, 12, 'Intel Socket 1700', 2500, 4400, NULL, 'Processzor sorozat: Intel Core i5\r\nFoglalat: Intel LGA1700\r\nModellmegjelölés: Intel Core i5-12400F\r\nMikroarchitektúra: Golden Cove, Gracemont\r\nProcesszor kódnév: Alder Lake-S\r\nHűtés típusa: RM1\r\nProcesszormagok száma: 6 ×\r\nSzálak száma: 12 ×\r\nProcesszor frekvencia: 2,5 GHz (2,5 GHz)\r\nMax. frekvencia (OC): 4,4 GHz (4 400 MHz)\r\nTámogatott memóriatípus: DDR4/DDR5\r\nMax. csatornaszám: 2 ×\r\nCPU Passmark: 17 437\r\nJellemzők: Automatikus túlpörgetés, Virtualizáció, Multi-Threading, Hűtés\r\nTDP fogyasztás: 117 W\r\nL2 cache: 7,5 MB\r\nL3 cache: 18 MB', 68040);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `processzor_huto`
--

CREATE TABLE `processzor_huto` (
  `id` int(255) NOT NULL,
  `marka` varchar(50) NOT NULL,
  `modell` varchar(100) NOT NULL,
  `tipus` varchar(50) NOT NULL,
  `v_atmeroje` int(15) NOT NULL,
  `v_fordulatszama` int(15) NOT NULL,
  `leiras` text NOT NULL,
  `ar` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `processzor_huto`
--

INSERT INTO `processzor_huto` (`id`, `marka`, `modell`, `tipus`, `v_atmeroje`, `v_fordulatszama`, `leiras`, `ar`) VALUES
(1, 'ARCTIC', 'Freezer 34 eSports DUO black/white (ACFRE00061A)', 'Aktív hűtő', 120, 2100, 'Az egyes komponensek folyamatos fejlesztése és optimalizálása révén az új Freezer 34 sorozat optimális hűtési megoldást kínál a modern és hatékony CPU-k számára.\r\n\r\nAz új, nyomás-optimalizált P-ventilátorokkal és egy frissített 54-fin-hűtőbordával a Freezer 34 sok teljesítményt kínál áráért. A nagy teljesítményű MX-4 hűtőpaszta minden darabhoz jár, és biztosítja a legjobb hűtési eredményeket.\r\n\r\nA Freezer 34 rügzítési rendszere kompatibilis az Intel és az AMD aljzatokkal. Kompakt méretei optimális RAM kompatibilitást biztosítanak még a nagyobb hűtőbordákkal rendelkező RAM modulok esetén is.\r\n\r\nTulajdonságok:\r\nTDP (W) - Teljesítmény: 210W\r\nVentilátor mérete: 120mm\r\nCsatlakozó: 4pin (PWM) - szabályozható\r\nMagasság: 157mm\r\nLed világítás: Nincs LED\r\nExtra tulajdonság: Dupla ventilátor\r\nMax. ventilátor fordulat: 2100 rpm\r\nHűtő tömege (teljes): 764gramm', 20890),
(2, 'be quiet!', 'DARK ROCK PRO 4 (BK022)', 'Aktív hűtő', 135, 1500, 'A Dark Rock Pro 4 lenyűgöző 250W TDP hűtési teljesítményt nyújt, és gyakorlatilag hallhatatlanul működik. Kiváló túlhajtott rendszerekhez és igényes munkaállomásokhoz.\r\n\r\nTulajdonságok:\r\nKét gyakorlatilag hallhatatlan Silent Wings PWM ventilátor\r\nElülső ventilátor tölcsér alakú kerettel a magas légnyomásért\r\nMindössze 24.3dB(A) zajszint maximális sebességnél\r\nHét nagy teljesítményű réz hőcső\r\nLégáramláshoz optimalizált hűtőlamellák; kivágások a fokozott RAM kompatibilitásért\r\nKönnyen telepíthető telepítőkészlet, amely felülről rögzíthető\r\nCsiszolt alumínium tetőlemez gyémántvágású borítással\r\nNémet termékkoncepció, dizájn, és minőségellenőrzés', 35890);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ram`
--

CREATE TABLE `ram` (
  `id` int(255) NOT NULL,
  `marka` varchar(50) NOT NULL,
  `tipus` varchar(50) NOT NULL,
  `kapacitas` int(5) NOT NULL,
  `kiszereles` varchar(10) NOT NULL,
  `memoria_tipus` varchar(5) NOT NULL,
  `leiras` text NOT NULL,
  `ar` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `ram`
--

INSERT INTO `ram` (`id`, `marka`, `tipus`, `kapacitas`, `kiszereles`, `memoria_tipus`, `leiras`, `ar`) VALUES
(1, 'Kingston', 'FURY Renegade 32GB (2x16GB) DDR4', 32, '2x16', 'DDR4', 'Leírás:\r\n\r\nAdj egy löketet AMD vagy Intel alapú rendszered teljesítményének, hogy a tápláléklánc csúcsán maradhass az ultra-gyors Kingston Fury Renegade DDR4 memóriával. Emeld feljebb képkockaszámaid, közvetíts egyenletesen és vágj videókat problémamentesen. Elérhető modulonként 8 - 32 GB méretben illetve 2-es és 4-es csomagokban összesen 16 - 256 GB méretben. A Renegade DDR4 Intel XMP tanúsítvánnyal rendelkezik a legújabb Intel alaplapokhoz, nincs más dolgod, csak kiválasztani a profilt a BIOS-ban. 100%-ban gyárilag sebességtesztelt, így megadja az extrém teljesítményt és a megbízhatóság általi nyugalmat.\r\n\r\nMűszaki adatok:\r\n\r\nTípus: PC memória\r\nKapacitás: 32 GB\r\nKiszerelés: 2x16GB\r\nMemória típusa: DDR4\r\nSebesség: 3600 MHz\r\nMemóriakésleltetés: CL 16\r\nHűtőborda: Van\r\nFeszültség: 1.35 V', 41070),
(2, 'Kingston', 'FURY Renegade 32GB (2x16GB) DDR5', 32, '2x16', 'DDR5', 'Leírás:\r\n\r\nA Kingston FURY Renegade DDR5 memóriával, amelyet a következő generációs DDR5 platformok extrém teljesítményére terveztek, soha nem látott határokat feszegethet. Fokozza rendszerét a szükséges lökést, hogy a csúcson maradjon az ultragyors, akár 6400MT/s sebességű memóriával. A Kingston FURY Renegade DDR5 elegáns, újonnan tervezett fekete és ezüst színű alumínium hőelosztóval rendelkezik, amely kiegészíti a rendszerépítők és a DIY PC-rajongók legújabb PC-építéseinek megjelenését. Kapható egymodulos 16 GB-os kapacitással és kétcsatornás, 2 darab 32 GB-os kapacitású készletekben.\r\n\r\nAkár tartalmakat készít, akár többfeladatos munkát végez, akár a végletekig feszegeti a határokat a véres játékcímeihez, a Kingston FURY Renegade DDR5 memória ideális választás játékosok, rajongók, tartalomkészítők és extrém túlhajtók számára.\r\nA Kingston FURY veled van, közvetlenül a lehetséges határainál.\r\n\r\nA teljesítmény maximalizálására tervezve\r\nExtrém túlhajtási potenciál\r\nIntel XMP 3.0 tanúsítvány\r\nA világ vezető alaplapgyártói által minősítve\r\nAgresszív alumínium hűtőborda', 75599);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendszer_huto`
--

CREATE TABLE `rendszer_huto` (
  `id` int(255) NOT NULL,
  `marka` varchar(50) NOT NULL,
  `modell` varchar(100) NOT NULL,
  `tipus` varchar(50) NOT NULL,
  `v_atmeroje` int(15) NOT NULL,
  `v_fordulatszama` int(15) NOT NULL,
  `leiras` text NOT NULL,
  `ar` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `rendszer_huto`
--

INSERT INTO `rendszer_huto` (`id`, `marka`, `modell`, `tipus`, `v_atmeroje`, `v_fordulatszama`, `leiras`, `ar`) VALUES
(1, 'ARCTIC', 'P12 PWM PST 120x120x25mm (ACFAN00120A)', 'Aktív hűtő', 120, 1800, 'Anyag: Műanyag\r\nCsapágy típus: FDB\r\nCsatlakozó: 4 pin + 4 pines foglalat\r\nFordulatszám (rpm): 200-1800\r\nLED világítás: Nem\r\nLégszállítás (CFM): 56\r\nMéret (mm): 120\r\nZajszint (dB): 22', 2080);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ssd`
--

CREATE TABLE `ssd` (
  `id` int(255) NOT NULL,
  `marka` varchar(50) NOT NULL,
  `tipus` varchar(100) NOT NULL,
  `kapacitas` int(10) NOT NULL,
  `max_olvas` int(15) NOT NULL,
  `max_iras` int(15) NOT NULL,
  `csatlakozo` varchar(8) NOT NULL,
  `leiras` text NOT NULL,
  `ar` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `ssd`
--

INSERT INTO `ssd` (`id`, `marka`, `tipus`, `kapacitas`, `max_olvas`, `max_iras`, `csatlakozo`, `leiras`, `ar`) VALUES
(1, 'Kingston', 'A400 2.5 480GB SA400S37/480G', 480, 500, 450, 'SATA3', 'SSD meghajtó kapacitás: 480 GB\r\nSSD meghajtó csatlakozók: Serial ATA III\r\nOlvasási sebesség: 500 MB/s\r\nÍrási sebesség: 450 MB/s\r\nComponent for: PC/notebook\r\nNVM Express (NVMe) supported: Nem\r\nAdatátviteli sebesség: 6 Gbit/s\r\nMemóriatípus: TLC\r\nVezérlőtípus: 2Ch\r\nTBW rating: 160\r\nSSD form factor: 2.5\"\r\nTanúsítványok: CE, FCC\r\nÁramfogyasztás (olvasás): 0,642 W\r\nÁramfogyasztás (írás): 1,535 W\r\nÁramfogyasztás (üresjáratban): 0,195 W\r\nPower consumption (average): 0,279 W\r\nÜzemi hőmérséklettartomány (T-T): 0 - 70 °C\r\nTárolási hőmérséklettartomány (T-T): -40 - 85 °C\r\nÜzemi rezgés: 2,17 g\r\nNem üzemi rezgés: 20 g\r\nWindows operating systems supported: Igen\r\nMac operating systems supported: Igen\r\nLinux operating systems supported: Igen\r\nSzélesség: 100 mm\r\nMélység: 69,9 mm\r\nMagasság: 7 mm\r\nSúly: 41 g', 11290);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tapegyseg`
--

CREATE TABLE `tapegyseg` (
  `id` int(255) NOT NULL,
  `marka` varchar(25) NOT NULL,
  `modell` varchar(75) NOT NULL,
  `tipus` varchar(50) NOT NULL,
  `teljesitmeny` int(8) NOT NULL,
  `hatasfok` varchar(50) NOT NULL,
  `pfc` varchar(15) NOT NULL,
  `leiras` text NOT NULL,
  `ar` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tapegyseg`
--

INSERT INTO `tapegyseg` (`id`, `marka`, `modell`, `tipus`, `teljesitmeny`, `hatasfok`, `pfc`, `leiras`, `ar`) VALUES
(1, 'Corsair', 'CX750M 750W (CP-9020061-EU)', 'Fél moduláris tápegység', 750, '80+ Bronze', 'Aktív', 'Termékosztály: Számítógépház tápegység\r\nTápegység fajtája: Moduláris (külön csatlakoztatható kábelekkel)\r\nTápegységek összteljesítménye: 750 Watt\r\nFormátum: ATX; Tápegység szabványa (ATX): 2;3\r\nPFC típus (Power Factor Correction): Aktív\r\nMeghibásodások közti átlagos idő (MTBF): 100000 h\r\n4-pin (HDD/ODD) elektromos csatlakozók száma: 5 db\r\n4-pin (FDD) elektromos csatlakozók száma: 1 db\r\nSerial ATA elektromos csatlakozók száma: 8 db\r\n6+2-pin (PCI-E) elektromos csatlakozók száma: 2 db\r\n+12V elektromos csatlakozó típusa: EPS12V P4 (4-pin)\r\n+12V 4+4-pin (EPS12V) elektromos csatlakozók száma: 1 db\r\nATX tápegység csatlakozó típusa: 20-pin + 4-pin\r\nATX tápegység (20-pin - 24-pin): Nem\r\nVentilátorok száma: 1 db\r\nVentilátor méret osztálya: 120 mm\r\nVentilátor fordulatszám szabályzó: Thermistor\r\nTápegység terhelésének kijelzése: Nem\r\nTanúsítványok: 80 PLUS Bronze; ErP Lot 6\r\nSzélesség: 150 mm\r\nMélység: 160 mm\r\nMagasság: 86 mm\r\nSzín: Fekete\r\n\r\nVédelmek\r\n\r\nOVP (túlfeszültség elleni védelem)\r\nOPP (túlterhelés elleni védelem)\r\nUVP (alacsony feszültség elleni védelem)\r\nSCP (zárlat elleni védelem)', 29900);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `code` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `code`, `status`) VALUES
(8, 'asd', 'seresszabolcs01@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin', 0, ''),
(9, 'asd2', 'asd2@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 0, ''),
(10, 'asd3', 'asd3@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', 0, ''),
(11, 'asdasdas', 'eve.holt@reqres.in', '202cb962ac59075b964b07152d234b70', 'user', 0, ''),
(12, 'Sas', 'sas@gmail.com', 'sas01', 'user', 0, '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `videokartya`
--

CREATE TABLE `videokartya` (
  `id` int(255) NOT NULL,
  `marka` varchar(25) NOT NULL,
  `modell` varchar(75) NOT NULL,
  `csatolofelulet` varchar(100) NOT NULL,
  `video_chipset` varchar(100) NOT NULL,
  `video_chipset_termekcsalad` varchar(100) NOT NULL,
  `hutes_tipusa` varchar(100) NOT NULL,
  `ventilatorok` int(2) NOT NULL,
  `grafikus_chipset_sebessege` int(10) NOT NULL,
  `grafikus_memoria_sebessege` int(10) NOT NULL,
  `memoria` int(5) NOT NULL,
  `memoria_tipusa` varchar(10) NOT NULL,
  `memoria_savszelessege` int(10) NOT NULL,
  `max_felbontas` varchar(100) NOT NULL,
  `led` tinyint(1) NOT NULL,
  `tapcsatlakozo` int(75) NOT NULL,
  `fogyasztas` int(10) NOT NULL,
  `ajanlott_tapegyseg` int(10) NOT NULL,
  `szelesseg` int(100) NOT NULL,
  `hosszusag` int(100) NOT NULL,
  `vastagsag` int(100) NOT NULL,
  `leiras` text NOT NULL,
  `ar` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `videokartya`
--

INSERT INTO `videokartya` (`id`, `marka`, `modell`, `csatolofelulet`, `video_chipset`, `video_chipset_termekcsalad`, `hutes_tipusa`, `ventilatorok`, `grafikus_chipset_sebessege`, `grafikus_memoria_sebessege`, `memoria`, `memoria_tipusa`, `memoria_savszelessege`, `max_felbontas`, `led`, `tapcsatlakozo`, `fogyasztas`, `ajanlott_tapegyseg`, `szelesseg`, `hosszusag`, `vastagsag`, `leiras`, `ar`) VALUES
(1, 'ASRock', 'Intel Arc A770 Phantom Gaming D 8GB OC (A770 PGD 8GO)', 'PCI-Express', 'Intel Arc', 'A770', 'Aktív hűtés', 3, 2200, 16000, 8, 'GDDR6', 256, '7680 x 4320', 1, 0, 0, 0, 131, 305, 56, 'Graphics Engine\r\n\r\n- Intel® Arc™ A770 Graphics\r\n\r\nBus Standard\r\n\r\n- PCI® Express 4.0 x16\r\n\r\nDirectX\r\n\r\n- 12 Ultimate\r\n\r\nOpenGL\r\n\r\n- 4.6\r\n\r\nMemory\r\n\r\n- 8GB GDDR6\r\n\r\nEngine Clock\r\n\r\n- 2200 MHz\r\n\r\nIntel® XMX Engines\r\n\r\n- 512\r\n\r\nMemory Clock\r\n\r\n- 16 Gbps\r\n\r\nMemory Interface\r\n\r\n- 256-bit\r\n\r\nResolution\r\n\r\n- Digital Max Resolution: 7680x4320\r\n\r\nInterface\r\n\r\n- 3 x DisplayPort™ 2.0 up to UHBR 10*\r\n- 1 x HDMI™ 2.1\r\n\r\n\r\n*Designed for DP 2.0, certification pending VESA CTS Release.\r\n\r\nHDCP\r\n\r\n- Yes\r\n\r\nMulti-view\r\n\r\n- 4\r\n\r\nRecommended PSU\r\n\r\n- 700W\r\n\r\nPower Connector\r\n\r\n- 2 x 8-pin\r\n\r\nAccessories\r\n\r\n- 1 x Quick Installation Guide\r\n\r\nDimensions\r\n\r\n- 305 x 131 x 56 mm, 2.8-slot\r\n\r\nNet Weight\r\n\r\n- 1146 g', 165190);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `alaplap`
--
ALTER TABLE `alaplap`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `gephaz`
--
ALTER TABLE `gephaz`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `processzor`
--
ALTER TABLE `processzor`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `processzor_huto`
--
ALTER TABLE `processzor_huto`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `rendszer_huto`
--
ALTER TABLE `rendszer_huto`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `ssd`
--
ALTER TABLE `ssd`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tapegyseg`
--
ALTER TABLE `tapegyseg`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `videokartya`
--
ALTER TABLE `videokartya`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `alaplap`
--
ALTER TABLE `alaplap`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `gephaz`
--
ALTER TABLE `gephaz`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `processzor`
--
ALTER TABLE `processzor`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `processzor_huto`
--
ALTER TABLE `processzor_huto`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `ram`
--
ALTER TABLE `ram`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `rendszer_huto`
--
ALTER TABLE `rendszer_huto`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `ssd`
--
ALTER TABLE `ssd`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `tapegyseg`
--
ALTER TABLE `tapegyseg`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `videokartya`
--
ALTER TABLE `videokartya`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
