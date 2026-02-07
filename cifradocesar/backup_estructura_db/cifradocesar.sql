-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-02-2026 a las 13:46:38
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cifradocesar`
--
CREATE DATABASE IF NOT EXISTS `cifradocesar` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `cifradocesar`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` bigint(20) NOT NULL,
  `asunto` varchar(20) NOT NULL,
  `contenido` varchar(400) NOT NULL,
  `remitente` bigint(20) NOT NULL,
  `destinatario` bigint(20) NOT NULL,
  `fecha_envio` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_recepcion` datetime DEFAULT NULL,
  `desplazamiento` bigint(20) NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `reemplazo_asunto` varchar(100) DEFAULT NULL,
  `reemplazo_mensaje` varchar(800) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `asunto`, `contenido`, `remitente`, `destinatario`, `fecha_envio`, `fecha_recepcion`, `desplazamiento`, `leido`, `reemplazo_asunto`, `reemplazo_mensaje`) VALUES
(47, 'Cpssbeps', 'Qspcboep', 25, 25, '2026-02-03 19:04:56', '2026-02-03 19:06:56', 1, 1, '{}', '{}'),
(48, 'Cpssbeps', 'sftqvftub b qspcboep', 25, 25, '2026-02-03 19:35:59', '2026-02-03 19:37:59', 1, 1, '{}', '{}'),
(49, 'Mtqf gzjstx infx', 'Htrt qj af xjstw Fqfs, rj inwnlt f zxyji ufwf uwjlzsyfwqj xtgwj jq knsfq vzj af f wjsinw js jxytx infx. Fyjsyfrjsyj Ufshwfhnt.', 26, 25, '2026-02-06 22:57:48', '2026-02-06 22:58:48', 5, 1, '{\"13\":\"Ã­\"}', '{\"1\":\"Ã³\",\"13\":\"Ã±\",\"99\":\"Ã­\"}'),
(50, 'Mtqf gzjstx infx', 'uwtgfsit rtinknhfhntsjx', 25, 26, '2026-02-07 01:19:12', '2026-02-07 01:20:12', 5, 1, '{\"13\":\"Ã­\"}', '{}'),
(51, 'Mtqf gzjstx infx', 'qf kzshnts wjxutsijw fsif htwwjhyfrjsyj, xjlznwjrtx uwtgfsit ufwf ajw xn qfx rtinknhfhntsjx xj lzfwifs htwwjhyfrjsyj!!', 26, 25, '2026-02-07 01:37:20', '2026-02-07 01:40:20', 5, 1, '{\"13\":\"Ã­\"}', '{\"8\":\"Ã³\"}'),
(54, 'Mtqf gzjstx infx', 'fmtwf kzshntsf gnjs? fanxfrj utw kfatw', 25, 26, '2026-02-07 02:10:27', '2026-02-07 02:13:27', 5, 1, '{\"13\":\"Ã­\"}', '{}'),
(55, 'Mtqf gzjstx infx', 'xn kzshntsf, ij 65', 26, 25, '2026-02-07 03:51:29', '2026-02-07 03:53:29', 5, 1, '{\"13\":\"Ã­\"}', '{}'),
(56, 'Cpssbeps', 'qspcboep mb sftqvftub b qspcboepppp', 25, 25, '2026-02-07 03:56:02', '2026-02-07 03:58:02', 1, 1, '{}', '{}'),
(57, 'uwtgfsit kzshntsfrnj', 'uwtgfsit', 25, 25, '2026-02-07 05:39:19', '2026-02-07 05:41:19', 5, 1, '{}', '{}'),
(58, 'Tsv jmr uyihs pmrhs', 'Hiwtyiw hi qygls xmiqts ip vihegxev uyihs mqtigefpi', 25, 26, '2026-02-07 06:36:05', '2026-02-07 06:37:05', 4, 1, '{\"12\":\"Ã³\"}', '{\"40\":\"Ã³\"}'),
(59, 'Tsv jmr uyihs pmrhs', 'qi epikvs tsv zsw!! lec uyi wikymv ezerderhs', 26, 25, '2026-02-07 06:41:03', '2026-02-07 06:43:03', 4, 1, '{\"12\":\"Ã³\"}', '{}'),
(60, 'Dwgpqu fkcu!!', 'Dwgpqu fkcu Cncp, eqoq vg guvc agpfq!', 25, 25, '2026-02-07 06:43:18', '2026-02-07 06:44:18', 2, 1, '{}', '{\"19\":\"Ã³\",\"29\":\"Ã¡\"}'),
(61, 'Ovsh nlual', 'Ibluhz, tl wylzluav, tl sshtv wlwl. Alunv chyphz kbkhz zviyl jvtv bapspghy lzah whnpuh, hzp xbl zp tl hfbkhu slz hnyhkljlyph bu tvuavu, sv xbl whzh lz xbl lzabcl vjbwhkv jvu ls ayhihqv f wvy lzv lz xbl hukv tbf wlykpkv. Lzwlyv sv avtlu h jvuzpklyhjpvu f tl wblkhu hfbkhy h wvulytl hs kph jvu ls bzv kl sh whnpuh, wvy ls tvtluav pualuahyl lucphy lzal tluzhql whyh cly zp hwylukv hsnv ublcv. Zhsbkvz!!!', 30, 29, '2026-02-07 07:30:29', '2026-02-07 07:31:29', 7, 1, '{}', '{\"81\":\"Ã¡\",\"132\":\"Ã³\",\"249\":\"Ã³\",\"285\":\"Ã­\",\"306\":\"Ã¡\",\"336\":\"Ã©\"}'),
(62, 'Ovsh nlual', 'Ovsh wlwl, fv hukv lu shz tpzthz xbl cvz, hjh hwylukplukv h bapspghy ls zpzalth, yljplu lz tp wyptlyh czpah f tl lzavf hjvzabtiyhukv h sv dli, whzh xbl zpltwyl bzv ls jlsb v sh ahisla wvy jvtvkpkhk, xbpghz sl alulz xbl wlkpy hfbkh h vayh wlyzvuh. Zblyal!!', 29, 30, '2026-02-07 07:36:29', '2026-02-07 07:37:29', 7, 1, '{}', '{\"85\":\"Ã©\",\"212\":\"Ã©\"}'),
(63, 'Ovsh nlual', 'Vooo, xbl shzapth Hshu, luavujlz xblkhtvz h thuv. Zp hwylukv hsnv ublcv al thualunv hs ahuav, hzp uv chtvz wlykpkvz svz kvz f uvz wvultvz hs kph, xbl alultvz tbjov xbl ohjly jvu sv xbl uvz hzpnuhyvu hjh, tlqvy wylclupy xbl jbyhy. Zhsbkvz!! Uvz cltvz hs yhav.', 30, 29, '2026-02-07 07:39:07', '2026-02-07 07:41:07', 7, 1, '{}', '{\"11\":\"Ã¡\",\"143\":\"Ã¡\",\"201\":\"Ã¡\"}'),
(64, 'Ovsh nlual', 'Zp zp, jvu shzapth al hfbkv zp wyljpzhz hsnv.', 29, 30, '2026-02-07 07:54:30', '2026-02-07 07:55:30', 7, 0, '{}', '{}'),
(65, 'Ovsh ibluhzzz', 'Xblyph wylnbuahy zviyl ls mpuhs kl shivyhavypv kl wyvnyhthjpvu f slunbhqlz, fh xbl uv lujbluayv shz mljohz kl lehtlu f alunv altvy h uv wvkly huvahytl h sh tlzh kl lzal tlz, wvy sv ahuav, ibzjv hfbkh hzp tl lcpav lzl wyvislth. Zp cvz zhilz hsnv hcpzhtl, v zp jvuvjlz h hsnbplu xbl zlwh, uv alunv kyhth lu wylnbuahysl h vayh wlyzvuh jbhsxbply jvzh. Nyhjphzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 29, 26, '2026-02-07 08:34:15', '2026-02-07 08:36:15', 7, 0, '{}', '{}'),
(66, 'Krod urehuwlwr', 'Kroddd, frÂ´pr wh yd? dfd dqgr suredqgr vl wh oohjd ho phqvdmh', 25, 26, '2026-02-07 08:40:51', '2026-02-07 08:41:51', 3, 0, '{}', '{}'),
(67, 'nurggg grgtiozu', 'Iusk bg?', 25, 29, '2026-02-07 08:41:17', '2026-02-07 08:43:17', 6, 0, '{}', '{\"1\":\"Ã³\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id_mensaje_original` bigint(20) NOT NULL,
  `id_mensaje_respuesta` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id_mensaje_original`, `id_mensaje_respuesta`) VALUES
(47, 48),
(48, 56),
(49, 50),
(50, 51),
(51, 54),
(54, 55),
(58, 59),
(61, 62),
(62, 63),
(63, 64);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` bigint(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `nombre_usuario` varchar(40) NOT NULL,
  `contrasenia` varchar(30) NOT NULL,
  `ultima_fecha_hora_acceso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `correo`, `nombre_usuario`, `contrasenia`, `ultima_fecha_hora_acceso`) VALUES
(25, 'alan', 'viera', 'alan@gmail.com', 'alan', '23422', '2026-02-07 08:41:45'),
(26, 'Roberto', 'Pancracio', 'robertopancracio12@gmail.com', 'robertoP', 'roberto2', '2026-02-07 08:39:55'),
(29, 'alan', 'viera', 'pepe@outlook.com', 'alan_viera', '39777', '2026-02-07 08:39:28'),
(30, 'alan', 'fernandez', 'alberto_uni@gmail.com', 'pepe', '12345', '2026-02-07 08:39:04'),
(31, 'anahie', 'greenhills', 'anabella@gmail.com', 'anahi', '123456', NULL),
(33, 'leo', 'rey', 'a@edu.co', 'reylo', '23421', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id_mensaje_original`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `index_nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
