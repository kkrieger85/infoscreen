--
-- Tabellenstruktur für Tabelle `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8_bin,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `board` int(3) NOT NULL,
  `infotype` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `published` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=0 ;
