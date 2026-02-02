-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2026 a las 05:18:19
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
(1, 'Tvyife hi tekmre', 'erermr', 1, 1, '2026-01-23 19:11:33', NULL, 4, 1, '{\"11\":\"Ã¡\"}', '{\"1\":\"Ã±\",\"3\":\"Ã±\"}'),
(2, 'Mtqf Fqfs', 'xfqzitx ufwf fqfs', 2, 1, '2026-01-23 19:33:58', NULL, 5, 1, '{}', '{}'),
(3, 'Ipmb uijbhp', 'ipmb', 1, 2, '2026-01-23 19:36:36', NULL, 1, 1, '{}', '{}'),
(4, '11', '21234', 2, 2, '2026-01-23 19:41:40', NULL, 2, 1, '{}', '{}'),
(5, '67', '6', 2, 1, '2026-01-23 19:42:34', NULL, 6, 1, '{}', '{}'),
(6, 'pwti rcivi', 'kwuw mabia', 3, 3, '2026-01-25 01:52:46', NULL, 8, 1, '{}', '{}'),
(7, 'rtqdcpfq213430', 'jqnc eqoq guvcp', 3, 3, '2026-01-25 01:55:13', NULL, 2, 1, '{}', '{\"6\":\"Ã³\",\"13\":\"Ã¡\"}'),
(8, 'rtqdcpfq', 'rtqdcpfq', 3, 3, '2026-01-25 03:07:13', NULL, 2, 1, '{}', '{}'),
(9, 'Qspcboep mfduvsb1', 'bdb qspcboep tj gvodjpob fm mfjep', 3, 3, '2026-01-25 03:45:44', NULL, 1, 1, '{}', '{}'),
(10, 'qspcboep nfotbkf qbs', 'ipmb', 3, 1, '2026-01-25 03:48:48', NULL, 1, 1, '{}', '{}'),
(11, 'Ovsh Hshu', 'wyvihukv xbl ls slpkv zl thyxbl iplu', 3, 1, '2026-01-25 04:26:20', NULL, 7, 1, '{}', '{}'),
(12, 'Odwlrxwjjj!!', 'Rmnwcrorlja vnwbjsnb unrmxb h wx unrmxb odwlrxwj lxaanlcjvnwcn', 2, 3, '2026-01-25 04:45:17', NULL, 9, 1, '{}', '{\"23\":\"Ã­\",\"35\":\"Ã­\"}'),
(13, 'Suredqgr froruhv', 'dfd', 3, 1, '2026-01-25 04:54:26', NULL, 3, 1, '{}', '{}'),
(14, 'QSVFCB', 'B', 1, 1, '2026-01-25 05:28:29', NULL, 1, 1, '{}', '{}'),
(15, 'uwtgsfit', 'fff', 1, 1, '2026-01-25 16:11:50', NULL, 5, 1, '{}', '{}'),
(16, 'fffff', 'gggggg', 1, 1, '2026-01-25 16:15:25', NULL, 5, 1, '{}', '{}'),
(17, 'vmujnp', 'btbt', 1, 1, '2026-01-25 16:16:02', NULL, 1, 1, '{}', '{}'),
(18, 'tvsferhs', '5678', 1, 1, '2026-01-25 16:27:27', NULL, 4, 1, '{}', '{}'),
(19, 'rtqdcpfq ccc', 'ccc', 3, 1, '2026-01-26 02:16:49', NULL, 2, 1, '{}', '{}'),
(20, 'bcd', 'cdb', 3, 3, '2026-01-26 02:17:07', NULL, 1, 1, '{}', '{}'),
(21, 'wyvihukv', 'vsh', 1, 2, '2026-01-26 02:31:04', NULL, 7, 1, '{}', '{}'),
(29, 'QSVFCB', 'Suredqgr uhvsrqghuuu', 1, 1, '2026-01-26 04:58:51', NULL, 3, 1, '{}', '{}'),
(30, 'Ovsh Hshu', 'ho ohlgr vh pdufr fruuhfwdphqwh, ghflph vl od uhvsxhvwd ixqflrqd fruuhfwdphqwh', 1, 3, '2026-01-26 05:02:19', NULL, 3, 1, '{}', '{\"5\":\"Ã­\",\"16\":\"Ã³\"}'),
(31, 'Ovsh Hshu', 'eper, elsve zew e ziv xy viwtyiwxe e \"ip pimhs wi qevgs gsvvigxeqirxi\"..\"', 3, 1, '2026-01-26 20:19:11', NULL, 4, 1, '{}', '{\"54\":\"Ã³\"}'),
(32, 'pwti rcivi', 'rcivi am zmaxwvlm iaq uqaui', 3, 3, '2026-01-28 05:04:55', NULL, 8, 1, '{}', '{}'),
(33, 'jqnc', 'eqoq cpfc ok jgtocpq', 1, 1, '2026-02-01 02:31:59', NULL, 2, 1, '{}', '{}'),
(34, 'krod', 'od vdoob pdvfdslwd', 1, 1, '2026-02-01 02:32:48', NULL, 3, 1, '{}', '{}'),
(35, 'krod', 'Uhvsxhvwd d od vdoob', 1, 1, '2026-02-01 02:35:29', NULL, 3, 1, '{}', '{}'),
(36, 'rtqdcpfq hgejc wnvkc', 'rtqdcpfq swg nc hgejc fg wnvkoc xgb hwpekqpg eqttgevcogpvg, ukp swg ug guvtqrgg pk nc swgta hcnng.', 2, 1, '2026-02-01 03:58:51', NULL, 2, 1, '{}', '{}'),
(37, 'tvsferhs tvsfers', 'spe', 1, 2, '2026-02-01 04:02:46', NULL, 4, 1, '{}', '{}'),
(38, 'tvsferhs xlmeks', 'tvsfersh', 1, 2, '2026-02-01 04:10:17', NULL, 4, 1, '{}', '{}'),
(39, 'tvsferhs tvsfers', 'elsve xiriw 5 qirweni ryizs epergmxs', 2, 1, '2026-02-01 04:12:31', NULL, 4, 1, '{}', '{}'),
(40, 'ovsh qbhuh', 'wyvihukv', 1, 3, '2026-02-01 04:37:15', NULL, 7, 1, '{}', '{}'),
(41, 'vxuhtju wak tu ygrzk', 'vxuhgtju wak rg hoktbktojg latioutk hokt', 3, 1, '2026-02-02 00:43:19', NULL, 6, 0, '{}', '{}');

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
(6, 32),
(11, 30),
(30, 31),
(34, 35),
(37, 39);

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
  `ultima_fecha_hora_acceso` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `correo`, `nombre_usuario`, `contrasenia`, `ultima_fecha_hora_acceso`) VALUES
(1, 'alan', 'viera', 'a2342@gmail.com', 'alan_viera', '2342', '2026-02-02 00:38:58'),
(2, 'thiago', 'viera', 'thiago@gmail.com', 'charrner', '3977', '2026-02-02 00:41:59'),
(3, 'juana', 'viera', 'juana09@gmail.com', 'juana0912', '091218', '2026-02-02 00:53:42');

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
  MODIFY `id_mensaje` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
