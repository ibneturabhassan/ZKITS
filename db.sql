--
-- Base de données: `wcd_yt`
--

-- --------------------------------------------------------

--
-- Structure de la table `wcd_yt_rate`
--

CREATE TABLE IF NOT EXISTS `wcd_yt_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `rate` int(1) NOT NULL,
  `dt_rated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)