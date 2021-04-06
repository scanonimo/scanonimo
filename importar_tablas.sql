-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: alanonsc.db
-- Generation Time: Apr 04, 2021 at 05:09 AM
-- Server version: 10.4.13-MariaDB-1:10.4.13+maria~bionic
-- PHP Version: 7.4.9-nfsn1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alanonsc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `consulta`
--

CREATE TABLE `consulta` (
  `usuario` int(11) NOT NULL,
  `ordenar` int(11) NOT NULL,
  `filtrar` int(11) NOT NULL,
  `pulso` int(11) NOT NULL,
  `fondo_total` double DEFAULT NULL,
  `eliminar_obs` int(11) NOT NULL,
  `ocultar_obs` int(11) NOT NULL,
  `fun_avan` int(11) NOT NULL,
  `ordenar_dos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consulta`
--

INSERT INTO `consulta` (`usuario`, `ordenar`, `filtrar`, `pulso`, `fondo_total`, `eliminar_obs`, `ocultar_obs`, `fun_avan`, `ordenar_dos`) VALUES
(1, 1, 0, 0, 11992, 0, 0, 0, 0),
(12, 1, 1, 0, NULL, 0, 0, 1, 0),
(13, 1, 1, 0, 2110, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_sin_enviar`
--

CREATE TABLE `email_sin_enviar` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `libro` int(11) NOT NULL,
  `piezas` int(11) NOT NULL,
  `obsequiados` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventario`
--

INSERT INTO `inventario` (`id`, `libro`, `piezas`, `obsequiados`, `usuario`) VALUES
(467, 3, 1, 0, 12),
(468, 4, 1, 0, 12),
(469, 6, 1, 0, 12),
(470, 15, 1, 0, 12),
(471, 9, 1, 0, 12),
(472, 18, 1, 0, 12),
(473, 10, 1, 0, 12),
(474, 196, 1, 0, 12),
(475, 83, 1, 0, 12),
(476, 165, 1, 0, 12),
(477, 25, 1, 0, 12),
(478, 193, 1, 0, 12),
(479, 208, 1, 0, 12),
(480, 8, 1, 0, 12),
(481, 22, 1, 0, 12),
(482, 47, 1, 0, 12),
(483, 17, 1, 0, 12),
(484, 210, 1, 0, 12),
(485, 13, 1, 0, 12),
(486, 211, 1, 0, 12),
(487, 19, 1, 0, 12),
(488, 55, 1, 0, 12),
(489, 21, 1, 0, 12),
(490, 11, 1, 0, 12),
(491, 1, 1, 0, 12),
(492, 16, 1, 0, 12),
(493, 12, 1, 0, 12),
(494, 14, 1, 0, 12),
(495, 2, 1, 0, 12),
(496, 7, 1, 0, 12),
(497, 62, 2, 0, 12),
(498, 63, 2, 0, 12),
(499, 32, 1, 0, 12),
(500, 59, 1, 0, 12),
(501, 92, 1, 0, 12),
(502, 108, 1, 0, 12),
(503, 116, 2, 0, 12),
(504, 202, 1, 0, 12),
(505, 33, 1, 0, 12),
(506, 54, 1, 0, 12),
(507, 64, 1, 0, 12),
(508, 31, 2, 0, 12),
(509, 103, 1, 0, 12),
(510, 30, 1, 0, 12),
(511, 117, 1, 0, 12),
(512, 67, 1, 0, 12),
(513, 118, 1, 0, 12),
(514, 102, 1, 0, 12),
(515, 48, 1, 0, 12),
(516, 28, 2, 0, 12),
(517, 56, 1, 0, 12),
(518, 41, 1, 0, 12),
(519, 82, 2, 0, 12),
(520, 35, 2, 0, 12),
(521, 167, 1, 0, 12),
(522, 101, 1, 0, 12),
(523, 96, 2, 0, 12),
(524, 51, 1, 0, 12),
(525, 53, 1, 0, 12),
(526, 57, 1, 0, 12),
(527, 39, 1, 0, 12),
(528, 86, 1, 0, 12),
(529, 71, 1, 0, 12),
(530, 34, 1, 0, 12),
(531, 40, 1, 0, 12),
(532, 107, 1, 0, 12),
(533, 105, 1, 0, 12),
(534, 114, 1, 0, 12),
(535, 113, 1, 0, 12),
(536, 75, 1, 0, 12),
(537, 109, 1, 0, 12),
(538, 79, 1, 0, 12),
(539, 106, 1, 0, 12),
(540, 76, 1, 0, 12),
(541, 69, 1, 0, 12),
(542, 43, 1, 0, 12),
(543, 29, 1, 0, 12),
(544, 85, 1, 0, 12),
(545, 68, 1, 0, 12),
(546, 27, 1, 0, 12),
(547, 84, 1, 0, 12),
(548, 81, 1, 0, 12),
(549, 44, 1, 0, 12),
(550, 80, 1, 0, 12),
(551, 212, 1, 0, 12),
(552, 38, 1, 0, 12),
(553, 87, 1, 0, 12),
(554, 37, 1, 0, 12),
(555, 78, 1, 0, 12),
(556, 181, 1, 0, 12),
(557, 194, 1, 0, 12),
(558, 36, 1, 0, 12),
(559, 40, 2, 0, 13),
(561, 52, 1, 0, 13),
(562, 24, 1, 0, 13),
(563, 28, 1, 0, 13),
(564, 64, 1, 0, 13),
(565, 35, 7, 0, 13),
(566, 31, 1, 0, 13),
(567, 50, 1, 0, 13),
(568, 66, 1, 0, 13),
(569, 57, 2, 0, 13),
(571, 45, 2, 0, 13),
(572, 42, 2, 0, 13),
(573, 44, 2, 0, 13),
(574, 26, 2, 0, 13),
(575, 30, 3, 0, 13),
(576, 60, 1, 0, 13),
(577, 49, 3, 0, 13),
(579, 76, 1, 0, 13),
(580, 53, 1, 0, 13),
(581, 71, 5, 0, 13),
(582, 34, 1, 0, 13),
(583, 112, 1, 0, 13),
(584, 101, 2, 0, 13),
(591, 51, 2, 0, 13),
(593, 80, 1, 0, 13),
(595, 85, 5, 0, 13),
(596, 81, 1, 0, 13),
(597, 86, 5, 0, 13),
(598, 78, 1, 0, 13),
(599, 77, 1, 0, 13),
(600, 160, 2, 0, 13),
(601, 98, 2, 0, 13),
(602, 73, 1, 0, 13),
(604, 102, 1, 0, 13),
(605, 107, 2, 0, 13),
(606, 106, 1, 0, 13),
(607, 105, 2, 0, 13),
(608, 75, 1, 0, 13),
(609, 15, 2, 0, 13),
(610, 9, 1, 0, 13),
(611, 23, 1, 0, 12),
(612, 166, 1, 0, 12),
(613, 189, 1, 0, 12),
(614, 206, 1, 0, 12),
(616, 61, 1, 0, 12),
(617, 193, 3, 0, 13),
(618, 206, 1, 0, 13),
(619, 189, 1, 0, 13),
(620, 194, 1, 0, 13),
(621, 202, 2, 0, 13),
(649, 61, 2, 0, 13),
(650, 29, 1, 0, 13),
(651, 33, 1, 0, 13),
(652, 32, 2, 0, 13),
(653, 38, 2, 0, 13),
(654, 37, 2, 0, 13),
(655, 69, 1, 0, 13),
(656, 39, 2, 0, 13),
(657, 67, 2, 0, 13),
(659, 59, 2, 0, 13),
(660, 68, 2, 0, 13),
(661, 55, 1, 0, 13),
(662, 6, 1, 0, 13),
(663, 3, 1, 0, 13),
(664, 14, 1, 0, 13),
(670, 209, 1, 0, 13),
(672, 215, 1, 0, 13),
(673, 214, 1, 0, 13),
(674, 220, 1, 0, 13),
(681, 1, 2, 0, 1),
(682, 2, 1, 0, 1),
(683, 3, 2, 0, 1),
(684, 4, 2, 0, 1),
(685, 7, 3, 0, 1),
(686, 8, 1, 0, 1),
(687, 9, 3, 0, 1),
(688, 12, 5, 0, 1),
(689, 13, 2, 0, 1),
(690, 14, 1, 0, 1),
(691, 15, 4, 0, 1),
(692, 18, 1, 0, 1),
(693, 19, 5, 0, 1),
(694, 181, 3, 0, 1),
(695, 20, 8, 0, 1),
(696, 21, 2, 0, 1),
(697, 22, 5, 0, 1),
(698, 23, 1, 0, 1),
(699, 193, 1, 0, 1),
(700, 194, 2, 0, 1),
(701, 189, 10, 0, 1),
(702, 158, 2, 0, 1),
(703, 53, 3, 0, 1),
(704, 160, 100, 0, 1),
(705, 163, 1, 0, 1),
(706, 166, 2, 0, 1),
(707, 167, 1, 0, 1),
(708, 40, 4, 0, 1),
(709, 182, 5, 0, 1),
(710, 24, 7, 0, 1),
(711, 26, 5, 0, 1),
(712, 29, 41, 0, 1),
(713, 30, 8, 0, 1),
(714, 31, 3, 0, 1),
(715, 32, 5, 0, 1),
(716, 33, 55, 0, 1),
(717, 34, 3, 0, 1),
(718, 35, 23, 0, 1),
(719, 36, 3, 0, 1),
(720, 37, 3, 0, 1),
(721, 38, 3, 0, 1),
(722, 39, 3, 0, 1),
(723, 41, 26, 0, 1),
(724, 42, 7, 0, 1),
(725, 43, 4, 0, 1),
(726, 44, 45, 0, 1),
(727, 45, 4, 0, 1),
(728, 46, 21, 0, 1),
(729, 48, 3, 0, 1),
(730, 49, 24, 0, 1),
(731, 50, 11, 0, 1),
(732, 51, 10, 0, 1),
(733, 52, 13, 0, 1),
(734, 54, 24, 0, 1),
(735, 56, 3, 0, 1),
(736, 59, 2, 0, 1),
(737, 60, 3, 0, 1),
(738, 61, 3, 0, 1),
(739, 62, 3, 0, 1),
(740, 63, 4, 0, 1),
(741, 64, 3, 0, 1),
(742, 65, 5, 0, 1),
(743, 57, 2, 0, 1),
(744, 66, 3, 0, 1),
(745, 67, 2, 0, 1),
(746, 68, 3, 0, 1),
(747, 69, 5, 0, 1),
(748, 195, 2, 0, 1),
(749, 70, 13, 0, 1),
(750, 71, 3, 0, 1),
(751, 28, 11, 0, 1),
(752, 58, 3, 0, 1),
(753, 212, 2, 0, 1),
(754, 211, 2, 0, 1),
(755, 215, 4, 0, 1),
(756, 214, 4, 0, 1),
(757, 208, 3, 0, 1),
(758, 73, 2, 0, 1),
(759, 209, 5, 0, 1),
(760, 75, 2, 0, 1),
(761, 76, 30, 0, 1),
(762, 78, 1, 0, 1),
(763, 192, 3, 0, 1),
(764, 79, 5, 0, 1),
(765, 80, 4, 0, 1),
(766, 81, 2, 0, 1),
(767, 55, 14, 0, 1),
(768, 82, 2, 0, 1),
(769, 83, 2, 0, 1),
(770, 84, 4, 0, 1),
(771, 85, 3, 0, 1),
(772, 86, 3, 0, 1),
(773, 87, 2, 0, 1),
(774, 90, 2, 0, 1),
(775, 92, 1, 0, 1),
(776, 97, 2, 0, 1),
(777, 200, 2, 0, 1),
(778, 98, 3, 0, 1),
(779, 102, 3, 0, 1),
(780, 220, 6, 0, 1),
(781, 205, 2, 0, 1),
(782, 210, 2, 0, 1),
(783, 105, 3, 0, 1),
(784, 106, 4, 0, 1),
(785, 107, 1, 0, 1),
(786, 108, 1, 0, 1),
(787, 109, 2, 0, 1),
(788, 110, 3, 0, 1),
(789, 111, 4, 0, 1),
(790, 112, 2, 0, 1),
(791, 114, 5, 0, 1),
(792, 116, 3, 0, 1),
(793, 117, 3, 0, 1),
(794, 119, 4, 0, 1),
(795, 120, 9, 0, 1),
(796, 121, 2, 0, 1),
(797, 126, 1, 0, 1),
(798, 129, 1, 0, 1),
(799, 124, 1, 0, 1),
(800, 131, 1, 0, 1),
(801, 133, 1, 0, 1),
(802, 100, 2, 0, 1),
(803, 146, 1, 0, 1),
(804, 149, 7, 0, 1),
(805, 153, 2, 0, 1),
(806, 87, 1, 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `codigo` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(200) CHARACTER SET latin1 NOT NULL,
  `tipo` int(11) NOT NULL,
  `donativo` double NOT NULL,
  `descontinuado` int(11) NOT NULL,
  `barras` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin7;

--
-- Dumping data for table `libros`
--

INSERT INTO `libros` (`id`, `codigo`, `nombre`, `tipo`, `donativo`, `descontinuado`, `barras`) VALUES
(1, 'B-3', 'ALATEEN ESPERANZA PARA LOS HIJOS DE LOS ALCOHOLICOS', 1, 56, 0, ''),
(2, 'B-4', 'EL DILEMA DEL MATRIMONIO CON UN ALCOHÓLICO', 1, 67, 0, ''),
(3, 'B-5', 'GRUPOS DE FAMILIA AL-ANON', 1, 72, 0, ''),
(4, 'B-6', 'UN DIA A LA VEZ EN AL-ANON', 1, 90, 0, ''),
(5, 'B-14', 'UN DÍA A LA VEZ EN AL-ANON (VERSIÓN LETRA GRANDE)', 1, 140, 0, ''),
(6, 'B-16', 'VALOR PARA CAMBIAR (VERSION LETRA GRANDE)', 1, 140, 0, ''),
(7, 'SB-1', 'AL-ANON SE ENFRENTA AL ALCOHOLISMO', 1, 140, 0, '9780910034678'),
(8, 'SB-8', 'LOS DOCE PASOS Y LAS DOCE TRADICIONES DE AL-ANON', 1, 85, 0, '9780910034722'),
(9, 'SB-10', 'ALATEEN, UN DíA A LA VEZ', 1, 80, 0, ''),
(10, 'SB-15', '...EN TODAS NUESTRAS ACCIONES', 1, 140, 0, '9780910034357'),
(11, 'SB-16', 'VALOR PARA CAMBIAR', 1, 90, 0, '9780910034890'),
(12, 'SB-21', 'DE LA SUPERVIVENCIA A LA RECUPERACIÓN', 1, 140, 0, ''),
(13, 'SB-22', 'CÓMO AYUDA AL-ANON A FAM. Y AMIGOS DE ALCOHOLICOS', 1, 140, 0, '9780910034289'),
(14, 'SB-24', 'SENDEROS DE RECUPERACIÓN', 1, 140, 0, '9780910034371'),
(15, 'SB-27', 'ESPERANZA PARA HOY', 1, 140, 0, ''),
(16, 'SB-29', 'ABRAMOS EL CORAZÓN, TRANSFORMEMOS NUESTRAS', 1, 140, 0, '9780981501710'),
(17, 'SB-30', 'DESCUBRAMOS NUEVAS OPCIONES', 1, 140, 0, '978098150758'),
(18, 'SB-31', 'MUCHAS VOCES, UN MISMO VIAJE', 1, 174, 0, '978098903063'),
(19, 'SP-5', 'PLAN DETALLADO PARA PROGRESAR (4o. PASO)', 1, 62, 0, ''),
(20, 'SP-49', 'VIVIENDO CON UN ALCOHÓLICO SOBRIO (OTRO COMIENZO)', 1, 50, 0, ''),
(21, 'SP-77', 'INTIMIDAD SEXUAL', 1, 50, 0, '9780910034968'),
(22, 'SP-78', 'CUANDO ESTOY OCUPADO ME SIENTO MEJOR', 1, 50, 0, ''),
(23, 'SP-92', 'EN BUSCA DE LA LIBERTAD PERSONAL - LOS LEGADOS EN ...', 1, 73, 0, ''),
(24, 'F-45', 'AL-ANON ENTONCES Y AHORA', 2, 7, 0, ''),
(25, 'F-69', 'LA OFICINA DE SERVICIOS GENERALES', 8, 35, 0, ''),
(26, 'P-89ES', '¿DUDAS ACASO DE TU CORDURA?', 2, 7, 0, ''),
(27, 'S-21', 'SÉPTIMA TRADICION', 2, 6, 1, ''),
(28, 'SS-21', 'LA SÉPTIMA TRADICIÓN (NUEVA VERSION)', 2, 7, 0, ''),
(29, 'SP-1', 'AL-ANON ES PARA HOMBRES', 2, 7, 0, ''),
(30, 'SP-2', 'AL-ANON USTED Y EL ALCOHÓLICO', 2, 7, 0, ''),
(31, 'SP-2s', 'ALGUNAS RESPUESTAS EN AL-ANON', 2, 7, 0, ''),
(32, 'SP-3', 'ALCOHOLISMO, UN CARRUSEL LLAMADO NEGACIÓN ', 2, 13, 0, ''),
(33, 'SP-4', 'ALCOHOLISMO CONTAGIO FAMILIAR', 2, 13, 0, ''),
(34, 'SP-4s', 'PREGUNTAS QUE SE ESCUCHAN A MENUDO', 2, 7, 0, ''),
(35, 'SP-6', 'LIBRE DE DESESPERACIÓN', 2, 7, 0, ''),
(36, 'SP-7', 'UNA GUÍA PARA LA FAMILIA DEL ALCOHÓLICO', 2, 10, 0, ''),
(37, 'SP-8', 'DE REGRESO AL HOGAR', 2, 8, 0, ''),
(38, 'SP-9', '¿CÓMO PUEDO AYUDAR A MIS HIJOS?', 2, 13, 0, ''),
(39, 'SP-11', 'HISTORIA DE LOIS', 2, 8, 0, ''),
(40, 'SP-12', 'HISTORIA DE AL-ANON Y ALATEEN EN MEXICO', 8, 7, 0, ''),
(41, 'SP-13', 'PROPÓSITO Y SUGERENCIAS', 2, 7, 0, ''),
(42, 'SP-14', '¿ASÍ QUE AMAS A UN ALCOHÓLICO?', 2, 8, 0, ''),
(43, 'SP-15', 'TRES MIEMBROS DE A.A. OPINAN SOBRE AL-ANON', 2, 8, 0, ''),
(44, 'SP-16', '..A LA MADRE Y EL PADRE DE UN ALCOHÓLICO', 2, 13, 0, ''),
(45, 'SP-17', 'LOS DOCE PASOS Y TRADICIONES', 2, 13, 0, ''),
(46, 'SP-19', '¿QUÉ HACER CON RESPECTO A LA BEBIDA DEL ALCOHÓLICO?', 2, 7, 0, ''),
(47, 'SP-20', '¿QUÉ PUEDO HACER AHORA?', 2, 7, 1, ''),
(48, 'SP-31', 'TODO ACERCA DEL PADRINAZGO', 2, 10, 0, ''),
(49, 'SP-32', '¿QUÉ ES AL-ANON?', 2, 8, 0, ''),
(50, 'SP-33', '¿POR QUÉ EL ANONIMATO EN AL-ANON?', 2, 8, 0, ''),
(51, 'SP-35', 'LITERATURA APROBADA POR LA CONFERENCIA', 2, 7, 0, ''),
(52, 'SP-36', 'ARCHIVO DE HECHOS DE AL-ANON', 2, 7, 0, ''),
(53, 'ARCH-HIST', 'EL ARCHIVO HISTÓRICO', 2, 8, 0, ''),
(54, 'SP-37', 'AL-ANON INSTRUMENTO PARA EL TRATAMIENTO DE LAS...', 2, 8, 0, ''),
(55, 'SP-44', '¿QUÉ ES \"UN BORRACHO\" MAMÁ?', 1, 18, 0, ''),
(56, 'SP-45', 'EL ENFOQUE DE AL-ANON.', 2, 8, 0, ''),
(57, 'SP-60', 'LAS DOCE TRADICIONES DE AL-ANON ILUSTRADAS', 2, 22, 0, ''),
(58, 'SS-69', 'AL-ANON RECIBE CON GUSTO A LOS HIJOS ADULTOS DE', 2, 7, 0, ''),
(59, 'SP-47', 'RELATOS DE AL-ANON DE HIJOS ADULTOS DE ALCOHOLICOS', 2, 16, 0, ''),
(60, 'SP-48', 'EL ALCOHOLISMO Y COMO NOS AFECTA', 2, 8, 0, ''),
(61, 'SP-52', 'AL-ANON ES PARA HIJOS ADULTOS DE ALCOHOLICOS', 2, 17, 0, ''),
(62, 'SP-53', 'AQUI SE HABLA AL-ANON', 2, 12, 0, ''),
(63, 'SP-55', 'PLANTAR LA SEMILLA', 2, 11, 0, ''),
(64, 'SP-57', 'LOS CONCEPTOS, ¿ES EL SECRETO MEJOR GUARDADO', 2, 22, 0, ''),
(65, 'SP-58', 'PROFESIONAL AL-ANON LE HABLA', 2, 19, 0, ''),
(66, 'SP-62', '¿BEBE ELLA DEMASIADO?', 2, 10, 0, ''),
(67, 'SP-81', 'LO QUE SUCEDE LUEGO DEL TRATAMIENTO', 2, 6, 0, ''),
(68, 'SP-82', 'VIVIENDO EN UN ALBERGUE', 2, 7, 0, ''),
(69, 'SP-88', 'EL PADRINO DE SERVICIO', 2, 8, 0, ''),
(70, 'SS-4', 'INFORMACIÓN PARA EL RECIEN LLEGADO', 2, 7, 0, ''),
(71, 'SS-19', 'DESPRENDIMIENTO EMOCIONAL', 2, 5, 0, ''),
(72, 'K-GUIAS', 'CARPETA DE ALATEEN', 3, 70, 1, ''),
(73, 'SM-09', 'LO QUE DEBES Y NO DEBES HACER', 3, 5, 0, ''),
(74, 'SM-11', 'SOLO POR HOY ALATEEN', 3, 5, 0, ''),
(75, 'SP-10', 'ES UN ASUNTO DE ADOLESCENTES', 3, 6, 0, ''),
(76, 'SP-21', 'LOS ADOLESCENTES Y LOS PADRES ALCOHOLICOS', 3, 8, 0, ''),
(77, 'SP-25', 'TALLERES PARA PADRES Y PADRINOS ALATEEN', 3, 30, 0, ''),
(78, 'SP-26', 'PROCEDIMIENTO DE CERTIFICACION', 3, 30, 0, ''),
(79, 'SP-29', 'UNA GUIA PARA PADRINOS DE GRUPOS ALATEEN', 3, 8, 0, ''),
(80, 'SP-30', 'OPERACION ALATEEN', 3, 8, 0, ''),
(81, 'SP-41', 'HECHOS ACERCA DE ALATEEN', 3, 8, 0, ''),
(82, 'SP-51', 'ALATEEN DE PADRINO A PADRINO', 3, 8, 0, ''),
(83, 'SP-64', 'ALATEEN: EXAMEN DEL 4TO. PASO', 3, 50, 0, '9780981501703'),
(84, 'SP-67', 'QUERIDOS MAMÁ Y PAPA', 3, 10, 0, ''),
(85, 'SP-70', 'DESPUÉS DE ALATEEN HAY UN LUGAR PARA TI', 3, 9, 0, ''),
(86, 'SS-6', 'LISTA PARA COMPROBACION DIARIA DE MI MISMO', 3, 4, 0, ''),
(87, 'SS-20', 'ALATEEN ES PARA TI', 3, 5, 0, ''),
(88, 'BB-26', 'TARJETA DE MESA ALATEEN', 3, 5, 1, ''),
(89, 'C-72', 'AL-ANON HABLA AQUI...(TARJETA DE MESA)', 4, 5, 1, ''),
(90, 'C-73', 'A QUIEN VEAS AOUí...(TARJETA DE MESA)', 4, 6, 0, ''),
(91, 'C-74', 'AQUI SE HABLA AL-ANON...(TARJETA DE MESA)', 4, 7, 1, ''),
(92, 'C-95', 'CUATRO IDEAS PRIMORDIALES DE AL-ANON (SEPARADOR)', 4, 5, 0, ''),
(93, 'SM-7', 'TARJETA DEL PROGRAMA BÁSICO DE AL-ANON', 4, 4, 1, ''),
(94, 'SM-8', 'QUE EMPIECE POR MI', 4, 4, 1, ''),
(96, 'SM-12', 'SOLO POR HOY (SEPARADOR)', 4, 5, 0, ''),
(97, 'SM-19', 'USTED PUEDE PRESTAR UN GRAN SERVICIO', 4, 4, 0, ''),
(98, 'SM-26t', 'ORACION DE LA SERENIDAD (TARJETA)', 4, 5, 0, ''),
(99, 'SM-26I', 'ORACION DE LA SERENIDAD (MAGNETO)', 4, 12, 1, ''),
(100, 'SM-26c', 'ORACION DE LA SERENIDAD (CARTULINA)', 5, 12, 0, ''),
(101, 'SM-44', 'AL-ANON ES...(SEPARADOR)', 4, 4, 0, ''),
(102, 'SS-71', 'RESOLUCION DE CONFLICTOS TARJETA DE BOLSILLO', 4, 6, 0, ''),
(103, 'RSS-1', 'SEMINARIOS REGIONALES DE SERVICIO', 8, 5, 1, ''),
(104, 'S-38', 'CARPETA DE RELACIONES CON EL PÚBLICO', 4, 75, 1, ''),
(105, 'S-39', 'PLAN DE SERVICIO \"AÑO DE LA RENOVACIÓN DEL LIDERAZGO\"', 8, 10, 0, ''),
(106, 'S-39b', 'PLAN DE SERVICIO \"AÑO DEL INV., RENOVAR LA COMUNIC.', 8, 10, 0, ''),
(107, 'S-39c', 'EL AÑO DE LA MEJORIA DE NUESTRA SALUD FISICA Y...', 8, 11, 0, ''),
(108, 'S-40', 'ATRAYENDO Y COOPERANDO', 8, 5, 0, ''),
(109, 'S-57', 'LA ALEGRIA DE SERVIR', 8, 5, 0, ''),
(110, 'SM-1', '¿LE PREOCUPA A USTED LA BEBIDA DE OTRO?', 8, 5, 0, ''),
(111, 'SP-24/27', 'MANUAL DE SERVICIO 2014-2017', 8, 78, 0, ''),
(112, 'SS-17', '¿ES AL-ANON PARA USTED?', 8, 5, 0, ''),
(113, 'SS-22', 'REUNIONES DE GRUPOS INSTITUCIONALES', 8, 4, 1, ''),
(114, 'SS-25', '¿SE CRIO JUNTO A UN BEBEDOR CON PROBLEMAS?', 8, 5, 0, ''),
(115, 'SS-28', 'ESLABONES DE SERVICIO', 4, 5, 1, ''),
(116, 'SS-37', 'ARCHIVO DE HECHOS PARA PROFESIONALES', 8, 4, 0, ''),
(117, 'SS-64', 'INFORMACION PARA LOS EDUCADORES', 8, 8, 0, ''),
(118, 'S-65ES', 'A LOS ALCOHOLICOS, SUS FAMILIARES Y EL SISTEMA JUDICIAL', 8, 7, 1, ''),
(119, 'C-42', 'DECLARACION DE AL-ANON', 5, 11, 0, ''),
(120, 'C-48', 'CARTEL EXHIBICIÓN PARA ALATEEN', 5, 6, 0, ''),
(121, 'C-49', 'CARTEL A DONDE VA TU SÉPTIMA', 5, 10, 0, ''),
(122, 'C-50', 'LOGOTIPO C/ LETRA (40 x 52)', 5, 10, 1, ''),
(123, 'C-52', 'CARTEL DE LOS DOCE PASOS (GDE)', 5, 16, 1, ''),
(124, 'C-52ch', 'CARTEL DE LOS DOCE PASOS (CHICO)', 5, 13, 0, ''),
(125, 'C-53', 'CARTEL DE LAS DOCE TRADICIONES (GDE)', 5, 16, 1, ''),
(126, 'C-53ch', 'CARTEL DE LAS DOCE TRADICIONES (CHICO)', 5, 13, 0, ''),
(127, 'C-72c', 'CARTEL AL-ANON HABLA AOUÍ', 5, 13, 1, ''),
(128, 'C-83', 'CARTEL DE LOS DOCE CONCEPTOS (GDE)', 5, 16, 1, ''),
(129, 'C-83ch', 'CARTEL DE LOS DOCE CONCEPTOS (CHICO)', 5, 13, 0, ''),
(130, 'C-101', 'LOGOTIPO ANONIMO (40 x 52)', 5, 8, 1, ''),
(131, 'C-105', '7 PUNTOS BÁSICOS PARA EL BUEN FUNCIONAMIENTO DEL G.', 5, 9, 0, ''),
(132, 'C-107', 'GARANTÍAS GENERALES', 5, 8, 1, ''),
(133, 'C-108', 'COMO SEGUIR EL PROGRAMA', 5, 9, 0, ''),
(134, 'M-33', 'CARTEL FAMILIA (GDE)', 5, 16, 1, ''),
(135, 'M-61', 'EL ALCOHOLISMO EN UNA FAMILIA ES COMO UN TORNADO', 5, 16, 1, ''),
(136, 'M-62', '¿POR QUÉ MAMI ESTÁ GRITANDO OTRA VEZ? (GDE)', 5, 16, 1, ''),
(137, 'M-63', '¿TE SIENTES ATRAPADA? (GDE)', 5, 16, 1, ''),
(138, 'M-64', '¿TE SIENTES ATRAPADO? (GDE)', 5, 16, 1, ''),
(139, 'M-68', '¿POR QUÉ ESTAR SOLO 7 AL-ANON (GDE)', 5, 16, 1, ''),
(140, 'M-69', 'POR QUÉ ESTAR SOLO ? ALATEEN (GDE)', 5, 16, 1, ''),
(141, 'Oa', 'ORGANIGRAMA DE LA CONFERENCIA DE SERVICIO NACIONAL', 5, 11, 1, ''),
(142, 'Ob', 'ORGANIGRAMA DE ESTRUCTURA DE LOS GRUPOS', 5, 11, 1, ''),
(143, 'Oc', 'ORGANIGRAMA DE LA OSG', 5, 11, 1, ''),
(144, 'SM-22', 'CARTEL AL-ANON PARA EXHIBICIÓN (MUJER)', 5, 5, 1, ''),
(145, 'SM-23', 'CARTEL AL-ANON PARA EXHIBICION (HOMBRE)', 5, 5, 1, ''),
(146, 'SM-33', 'CARTEL FAMILIA (CHICO)', 5, 7, 0, ''),
(147, 'SM-34', 'MENSAJE DE ESPERANZA AL-ANON Y ALATEEN', 5, 9, 1, ''),
(148, 'SM-4i', '¿ES EL ALCOHOL UN PROBLEMA EN SU FAMILIA? (ALATEEN)', 5, 3, 1, ''),
(149, 'SM-41s', '¿ES EL ALCOHOL UN PROBLEMA EN SU FAMILIA? (VOLANTE)', 5, 1, 0, ''),
(150, 'SM-55', 'SELECCIONE LO QUE CORRESPONDE AL-ANON', 5, 11, 0, ''),
(151, 'SM-56', 'SELECCIONE LO QUE CORRESPONDE ALATEEN', 5, 11, 0, ''),
(152, 'SM-61', 'EL ALCOHOLISMO EN UNA FAMILIA ES COMO UN TORNADO (CHICO)', 5, 9, 0, ''),
(153, 'SM-62', '¿POR QUÉ MAMI ESTÁ GRITANDO OTRA VEZ?', 5, 9, 0, ''),
(154, 'SM-63', '¿TE SIENTES ATRAPADA?', 5, 8, 1, ''),
(155, 'SM-64', '¿TE SIENTES ATRAPADO?', 5, 8, 1, ''),
(156, 'SM-68', 'POR QUÉ ESTAR SOLO ? AL-ANON', 5, 7, 1, ''),
(157, 'SM-69', '¿POR QUÉ ESTAR SOLO 7 ALATEEN', 5, 7, 1, ''),
(158, 'AG', 'REGISTRO DE REUNIONES DE GRUPO', 6, 70, 0, ''),
(159, 'BD', 'BOLETÍN DELTA', 6, 10, 0, ''),
(160, 'BI-01', 'BOLETÍN INFORMATIVO', 6, 4, 0, ''),
(161, 'C-82', 'FOTO DE LOIS', 6, 26, 0, ''),
(162, 'C-88', 'FOTO DE ANNE', 6, 26, 0, ''),
(163, 'C-109', 'LEMAS PARA GRUPO', 8, 30, 0, ''),
(164, 'GF-T', 'GUÍA FONDO DE RESERVA (provisional)', 6, 6, 1, ''),
(165, 'MA', 'EL MENSAJE LLEGO A MÉXICO', 6, 35, 1, ''),
(166, 'MS', 'MATERIAL SUPLEMENTARIO (GUÍAS A SEGUIR)', 6, 85, 0, ''),
(167, 'Rb', 'ROTAFOLIO PEQUENO', 6, 27, 0, ''),
(168, 'S', 'SUMARIO 2013 o 2014', 6, 70, 0, ''),
(169, 'SG-34', 'GUíAS DE SEGURIDAD DE ALATEEN', 6, 10, 1, ''),
(170, 'SL-1', 'SEPARADOR LE MOLESTA LA MANERA DE BEBER...', 6, 3, 1, ''),
(171, 'SL-2', 'SEPARADOR EN AL-ANON PUEDO TRANSMITIR...', 6, 3, 1, ''),
(172, 'SL-3', 'SEPARADOR PARA PRESERVAR LO ENCONTRADO', 6, 3, 1, ''),
(173, 'SL-4', 'SEPARADOR NO IMPORTA CUALÉS SEAN TUS PROBLEMAS', 6, 3, 1, ''),
(174, 'SL-5', 'SEPARADOR ESTAMOS CONVENCIDOS DE QUE...', 6, 3, 1, ''),
(175, 'SL-6', 'SEPARADOR EN AL-ANON LOS FAMILIARES Y AMIGOS...', 6, 3, 1, ''),
(176, 'SL-7', 'SEPARADOR ME CONSUELA SABER QUE NO ESTOY SOLO', 6, 3, 1, ''),
(177, 'SL-8', 'SEPARADOR SI TIENE UN FAMILIAR Y AMIGO ALCOHOLICO', 6, 3, 1, ''),
(178, 'SL-9', 'SEPARADOR EN AL-ANON OFRECEMOS CONSUELO', 6, 3, 1, ''),
(179, 'SL-10', 'SEPARADOR EN AL-ANON NO TENEMOS OUE TEMER', 6, 3, 1, ''),
(180, 'SM-14', 'LOGOTIPO AUTOADHERIBLE (PLANILLA)', 6, 14, 1, ''),
(181, 'SP-27', 'CUADERNILLO 7 PUNTOS BASICOS A SEGUIR', 1, 45, 0, ''),
(182, 'SS-5', 'CUESTIONARIO PARA UNA REUNION SOBRE EL 4o. PASO', 6, 5, 0, ''),
(183, 'AV-1d', 'AL-ANON HABLA POR SI MISMO (SPOTS-DVD)', 7, 100, 1, ''),
(184, 'AV-2', 'SEIS REUNIONES PARA PRINCIPIANTES (CD)', 7, 85, 1, ''),
(185, 'AV-3', 'REALIDADES Y SENTIMIENTOS (SPOTS-DVD)', 7, 70, 1, ''),
(186, 'AV-5', 'ROTAFOLIO RCP (CD - DVD)', 7, 60, 1, ''),
(187, 'AV-6', 'RELACIONES CON EL PUBLICO ( SPOTS CD)', 7, 55, 1, ''),
(188, 'SA-11', '¿QUÉ ES UN BORRACHO MAMÁ? (CD)', 7, 42, 1, ''),
(189, '002', '*FINANZAS NUESTRAS FORTALEZA (ENGRAPADO)', 1, 16, 0, ''),
(190, 'SB-33', 'LA INTIMIDAD EN LAS RELACIONES ALCOHÓLICAS', 1, 85, 0, ''),
(192, 'SP-28', 'INVENTARIO PARA PADRINOS DE GRUPO ALATEEN', 1, 21, 0, ''),
(193, 'SP-93', 'CUADERNO DE EJERCICIOS SENDEROS DE RECUPERACIÓN (ESPIRA)', 1, 73, 0, '9780996306485'),
(194, 'SS-73', 'HABLEN MUTUAMENTE, RESOLUCIÓN DE CONFLICTOS (ENGRAPADO)', 1, 18, 0, ''),
(195, 'SP-94', 'ESPERANZA Y COMPRENSIÓN PARA LOS PADRES Y ABUELOS', 2, 13, 0, ''),
(196, 'GA', 'GUÍAS A SEGUIR ALATEEN', 3, 56, 0, ''),
(199, 'SS-26', 'TARJETAS DE MESA ALATEEN', 3, 5, 1, ''),
(200, 'SM-20', '*NUESTRAS HERRAMIENTAS DE FORTALECIMIENTO', 4, 6, 0, ''),
(202, 'SS-72', 'RESOLUCIÓN DE CONFLICTO UTILIZANDO NUESTRAS DOCE TRADICIONES', 4, 30, 0, ''),
(203, 'SM-41', '¿ES EL ALCOHOL UN PROBLEMA EN SU FAMILIA? ALATEEN (GDE)', 5, 3, 1, ''),
(204, 'AV-8', 'CORTOMETRAJE ALATEEN (DVD)', 7, 60, 1, ''),
(205, 'GDP', 'GUÍAS A SEGUIR DIFUSION PUBLICA', 8, 57, 0, ''),
(206, 'RJ', 'REVISTA ENFRENTANDO JUNTOS EL ALCOHOLISMO', 8, 11, 0, ''),
(208, 'RA', 'ROTAFOLIO ALATEEN', 3, 27, 0, ''),
(209, 'SM-10', 'SOLO POR HOY (DÍPTICO)', 4, 4, 0, ''),
(210, 'MSN', 'MANUAL DE SERVICIO NACIONAL', 8, 44, 0, ''),
(211, 'MF-02', 'VIVIENDO LOS CONCEPTOS EN ALATEEN', 3, 27, 0, ''),
(212, 'MF-01', 'SERVICIO ESCALONADO DE PADRINOS Y MADRINAS .', 3, 6, 0, ''),
(213, 'OBS', 'OBSEQUIO PARA RECIÉN LLEGADOS', 2, 24, 1, ''),
(214, 'MF-04', '6 EJES DE FORTALECIMIENTO (ENGRAPADO)', 6, 35, 0, ''),
(215, 'MF-03', 'EL VALOR Y LA FORTALEZA DE LA TRANSICIÓN EN ALATEEN (ENGRAPADO)', 3, 25, 0, ''),
(217, 'MT-01', 'ORADOR LAC (TARJETA)', 4, 5, 0, ''),
(218, '001', 'PLAN DE FORTALECIMIENTO A LAS ÁREAS (ENGRAPADO)', 8, 25, 0, ''),
(220, 'SM-81', 'SEPARADOR SOLO POR ESTA NOCHE', 6, 6, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `libros_per`
--

CREATE TABLE `libros_per` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `donativo` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `regalados` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `libros_per`
--

INSERT INTO `libros_per` (`id`, `usuario`, `nombre`, `donativo`, `cantidad`, `regalados`) VALUES
(79, 12, 'GUíA FONDO DE RESERVA (HOJAS ENGRAPADAS)', 0, 1, 0),
(77, 12, 'BOLETÍN DELTA ARB-JUN 2018', 0, 1, 0),
(80, 12, 'TENT CARD PARA PROMOCIONAR EL BOLETÍN DELTA (ADQUIERE UNO PARA EMPEZAR)', 0, 1, 0),
(103, 13, 'SEPAADORES VARIOS SL-10, SL-9, SL-2, SL-1 SL-3 Y SL-8', 3, 6, 0),
(82, 13, 'COMPRA DE BOLSAS Y SELLOS', 35, 0, 1),
(83, 13, '5 PAQUETES PARA RECIéN LLEGADOS', 50, 0, 1),
(90, 12, 'VALOR DE LA FORTALEZA DE LA TRANSICIÓN', 20, 1, 0),
(91, 12, 'EJES DE FORTALECIMIENTO', 35, 1, 0),
(92, 12, 'SEPARADORES POR ESTA NOCHE', 4, 1, 0),
(93, 12, 'MANUAL DE SERVICIO', 65, 1, 0),
(94, 12, 'LA INTIMIDAD EN LAS RELACIONES ALCOHÓLICA', 75, 1, 0),
(102, 13, 'GUÍA FONDO DE RESERVA (PROVISIONAL) GF-T', 6, 1, 0),
(101, 13, 'SOLO POR HOY (SEPARADOR) SM-12', 5, 1, 0),
(100, 13, '¿QUÉ PUEDO HACER AHORA? SP-20', 7, 1, 0),
(99, 1, 'EJEMLO', 10, 0, 0),
(104, 13, 'A LOS ALCOHOLICOS, SUS FAMILIARES Y EL SISTEMA JUDICIAL S-65ES', 7, 2, 0),
(105, 13, 'REUNIONES DE GRUPOS INSTITUCIONALES SS-22', 4, 2, 0),
(106, 13, 'SEMINARIOS REGIONALES DE SERVICIO RSS-1', 5, 2, 0),
(107, 12, '¿QUÉ PUEDO HACER AHORA? SP-20', 7, 1, 0),
(108, 12, 'SÉPTIMA TRADICION S-21', 6, 1, 0),
(109, 12, 'SOLO POR HOY (SEPARADOR) SM-12', 5, 1, 0),
(110, 12, 'EL MENSAJE LLEGO A MÉXICO MA', 35, 1, 0),
(111, 12, 'A LOS ALCOHOLICOS, SUS FAMILIARES Y EL SISTEMA JUDICIAL S-65ES', 7, 1, 0),
(112, 12, 'REUNIONES DE GRUPOS INSTITUCIONALES SS-22', 4, 1, 0),
(113, 12, 'SEMINARIOS REGIONALES DE SERVICIO RSS-1', 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo`
--

INSERT INTO `tipo` (`id`, `nombre`) VALUES
(1, 'LIBROS'),
(2, 'FOLLETOS'),
(3, 'ALATEEN'),
(4, 'TARJETA Y SEPARADORES'),
(5, 'CARTELES'),
(6, 'MATERIAL DE APOYO'),
(7, 'AUDIOS Y VIDEOS'),
(8, 'SERVICIO');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `grupo` varchar(200) NOT NULL,
  `creado` date DEFAULT NULL,
  `accedido` date DEFAULT NULL,
  `solo_este` int(11) NOT NULL,
  `recuperar` int(11) NOT NULL,
  `last_msg` datetime NOT NULL DEFAULT '2020-01-01 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `tipo`, `email`, `grupo`, `creado`, `accedido`, `solo_este`, `recuperar`, `last_msg`) VALUES
(12, 'uno', '$2y$10$xegCT4Tcig3Gj8XiQ9TY7uY0cK.nyDcURlCDQlaJHePtZmpwS80te', 1, '', '', NULL, '2021-01-17', 0, 0, '2020-01-01 00:00:00'),
(13, 'dos', '$2y$10$gpqi3Q1Pw2ooUbNKUwahBuWH3KCC9Z.jK/Otf4Y.mwWf13AC9PTcy', 1, '$2y$10$vtUN929Qz9Xnzn7FV3don.KiyhZbUCsU1yLiHCsiNbc/BnEIE91yW', 'CIRCULO DE AMOR HAA', '2020-12-01', '2021-04-02', 0, 0, '2021-01-18 18:29:22'),
(0, 'RESERVADO', '', 1, '', '', NULL, NULL, 0, 0, '2021-04-01 10:05:35'),
(1, 'ADRIANA', '$2y$10$UgTHBFBmUHNJYhC1DQ/StOF5VPuzmY4vo/2w5x7oVmpzrf8j4G/VG', 1, '', '', '2021-01-12', '2021-01-21', 0, 0, '2020-01-01 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`usuario`);

--
-- Indexes for table `email_sin_enviar`
--
ALTER TABLE `email_sin_enviar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `libros_per`
--
ALTER TABLE `libros_per`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_sin_enviar`
--
ALTER TABLE `email_sin_enviar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=879;

--
-- AUTO_INCREMENT for table `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `libros_per`
--
ALTER TABLE `libros_per`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10005;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
