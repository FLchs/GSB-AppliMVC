-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 03, 2018 at 02:50 PM
-- Server version: 5.5.52-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cned_gsb`
--
CREATE DATABASE IF NOT EXISTS `gsb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gsb`;

-- --------------------------------------------------------

--
-- Table structure for table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id` char(2) NOT NULL,
  `libelle` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
('CL', 'Saisie clôturée'),
('CR', 'Fiche créée, saisie en cours'),
('RB', 'Remboursée'),
('VA', 'Validée'),
('MP', 'Mise en paiement');

-- --------------------------------------------------------

--
-- Table structure for table `fichefrais`
--

DROP TABLE IF EXISTS `fichefrais`;
CREATE TABLE IF NOT EXISTS `fichefrais` (
  `idvisiteur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `nbjustificatifs` int(11) DEFAULT NULL,
  `montantvalide` decimal(10,2) DEFAULT NULL,
  `datemodif` date DEFAULT NULL,
  `idetat` char(2) DEFAULT 'CR',
  PRIMARY KEY (`idvisiteur`,`mois`),
  KEY `idetat` (`idetat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fichefrais`
--

INSERT INTO `fichefrais` (`idvisiteur`, `mois`, `nbjustificatifs`, `montantvalide`, `datemodif`, `idetat`) VALUES
('a17', '201801', 0, '0.00', '2018-01-12', 'CR'),
('a17', '201803', 0, '0.00', '2018-03-03', 'CR'),
('a17', '201804', 0, '0.00', '2018-04-01', 'CR'),
('a17', '201805', NULL, NULL, NULL, 'CR'),
('a17', '201904', NULL, NULL, NULL, 'CR'),
('a17', '201905', NULL, NULL, NULL, 'CR');

-- --------------------------------------------------------

--
-- Table structure for table `fraisforfait`
--

DROP TABLE IF EXISTS `fraisforfait`;
CREATE TABLE IF NOT EXISTS `fraisforfait` (
  `id` char(3) NOT NULL,
  `libelle` char(20) DEFAULT NULL,
  `montant` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fraisforfait`
--

INSERT INTO `fraisforfait` (`id`, `libelle`, `montant`) VALUES
('ETP', 'Forfait Etape', '110.00'),
('KM', 'Frais Kilométrique', '0.62'),
('NUI', 'Nuitée Hôtel', '80.00'),
('REP', 'Repas Restaurant', '25.00');

-- --------------------------------------------------------

--
-- Table structure for table `lignefraisforfait`
--

DROP TABLE IF EXISTS `lignefraisforfait`;
CREATE TABLE IF NOT EXISTS `lignefraisforfait` (
  `idvisiteur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `idfraisforfait` char(3) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  PRIMARY KEY (`idvisiteur`,`mois`,`idfraisforfait`),
  KEY `idfraisforfait` (`idfraisforfait`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lignefraisforfait`
--

INSERT INTO `lignefraisforfait` (`idvisiteur`, `mois`, `idfraisforfait`, `quantite`) VALUES
('a17', '201801', 'ETP', 2),
('a17', '201801', 'KM', 25),
('a17', '201801', 'NUI', 1),
('a17', '201801', 'REP', 2),
('a17', '201803', 'ETP', 21),
('a17', '201803', 'KM', 10),
('a17', '201803', 'NUI', 1),
('a17', '201803', 'REP', 5),
('a17', '201804', 'ETP', 10),
('a17', '201804', 'KM', 0),
('a17', '201804', 'NUI', 0),
('a17', '201804', 'REP', 0),
('a17', '201805', 'ETP', 4),
('a17', '201904', 'ETP', 6);

-- --------------------------------------------------------

--
-- Table structure for table `lignefraishorsforfait`
--

DROP TABLE IF EXISTS `lignefraishorsforfait`;
CREATE TABLE IF NOT EXISTS `lignefraishorsforfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idvisiteur` char(4) NOT NULL,
  `mois` char(6) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idvisiteur` (`idvisiteur`,`mois`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lignefraishorsforfait`
--

INSERT INTO `lignefraishorsforfait` (`id`, `idvisiteur`, `mois`, `libelle`, `date`, `montant`) VALUES
(96, 'a17', '201804', 'kfc', '2018-04-01', '12.00');

-- --------------------------------------------------------

--
-- Table structure for table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `immatriculation` varchar(20) NOT NULL,
  `idvisiteur` char(4) NOT NULL,
  `idpuissance` char(4) NOT NULL,
  PRIMARY KEY (`immatriculation`),
  KEY `idvisiteur` (`idvisiteur`,`immatriculation`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicule`
--

INSERT INTO `vehicule` (`immatriculation`, `idvisiteur`, `idpuissance`) VALUES
('AA-123-AA', 'a17', '5D');
-- --------------------------------------------------------

--
-- Table structure for table `puissancevehicule`
--

DROP TABLE IF EXISTS `puissancevehicule`;
CREATE TABLE IF NOT EXISTS `puissancevehicule` (
  `id` char(3) NOT NULL,
  `puissance` varchar(20) DEFAULT NULL,
  `bareme` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fraisforfait`
--

INSERT INTO `puissancevehicule` (`id`, `puissance`, `bareme`) VALUES
('4D', '4CV Diesel', '0.52'),
('5D', '5/6CV Diesel', '0.58'),
('4E', '4CV Essence', '0.62'),
('5E', '5/6CV Essence', '0.67'),
('GPL', 'GPL', '0.49');


-- --------------------------------------------------------

--
-- Table structure for table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE IF NOT EXISTS `visiteur` (
  `id` char(4) NOT NULL,
  `nom` char(30) DEFAULT NULL,
  `prenom` char(30) DEFAULT NULL,
  `login` char(20) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `adresse` char(30) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `ville` char(30) DEFAULT NULL,
  `dateembauche` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visiteur`
--

INSERT INTO `visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateembauche`) VALUES
('a131',	'Villechalane',	'Louis',	'lvillachane',	'$2y$10$paAj.kMCT7HYGrdxVzcGgez1Snr5LTP5xdqLP6Ug1SYqBF.dWCByC',	'8 rue des Charmes',	'46000',	'Cahors',	'2005-12-21'),
('a17',	'Andre',	'David',	'dandre',	'$2y$10$.r.AT.wXAD4.nDtiyI0Bj.Ek.Sc8w.w19PMSF68eF0QHylDsuUmRy',	'1 rue Petit',	'46200',	'Lalbenque',	'1998-11-23'),
('a55',	'Bedos',	'Christian',	'cbedos',	'$2y$10$9H/iuf/U1TxpZxy/vK5JDulaUvxar8cK1/smWcK/uIu6XzkXBMTu2',	'1 rue Peranud',	'46250',	'Montcuq',	'1995-01-12'),
('a93',	'Tusseau',	'Louis',	'ltusseau',	'$2y$10$9FWK1Wef/40mGD7lYmPDsuBzNi8QJQ/NoJBwAvrW9WRuz/1r4yXI2',	'22 rue des Ternes',	'46123',	'Gramat',	'2000-05-01'),
('b13',	'Bentot',	'Pascal',	'pbentot',	'$2y$10$UG5kPyub8at0xxFeRHeLbubMIHqFlsbiB9ojsCOvFrG28CJOvg0ba',	'11 allée des Cerises',	'46512',	'Bessines',	'1992-07-09'),
('b16',	'Bioret',	'Luc',	'lbioret',	'$2y$10$gK.JNQagBjerZLuASkSxbOq2TApaf8tmX5Nlsrj9aU9ewl32Lg..m',	'1 Avenue gambetta',	'46000',	'Cahors',	'1998-05-11'),
('b19',	'Bunisset',	'Francis',	'fbunisset',	'$2y$10$vePEXAr0IyCpXuVBq9c3VeBt62HktUIa8rquvTtf908JMSxVeuOc2',	'10 rue des Perles',	'93100',	'Montreuil',	'1987-10-21'),
('b25',	'Bunisset',	'Denise',	'dbunisset',	'$2y$10$H7uIvTCNITIY3EkLm5vseO/Sv4Me9fZ6jWo4W6QqgzpjPfyudeSJ6',	'23 rue Manin',	'75019',	'paris',	'2010-12-05'),
('b28',	'Cacheux',	'Bernard',	'bcacheux',	'$2y$10$ZBSv4q0iKYi045uvxKulJeFQJzfCZ8xGpEJNs19sBchzGi45mBDRi',	'114 rue Blanche',	'75017',	'Paris',	'2009-11-12'),
('b34',	'Cadic',	'Eric',	'ecadic',	'$2y$10$r4ApLNnfBLCeviFjFTFPoOwRLd6HIpMyPGpDpw0DgxPj.FzN6u34S',	'123 avenue de la République',	'75011',	'Paris',	'2008-09-23'),
('b4',	'Charoze',	'Catherine',	'ccharoze',	'$2y$10$Ctve82yWhcQ9m/7OQMtlceIVCcQx2lwWAPDaVe8ouoIg9NYw2gThK',	'100 rue Petit',	'75019',	'Paris',	'2005-11-12'),
('b50',	'Clepkens',	'Christophe',	'cclepkens',	'$2y$10$wTaNIDc99ussjsFlndryrOZt5cJs/cv2I2IuW2QZuxctIZ2w9hpuC',	'12 allée des Anges',	'93230',	'Romainville',	'2003-08-11'),
('b59',	'Cottin',	'Vincenne',	'vcottin',	'$2y$10$Kh8B2poU5n4zJ8YM0QUjl.89uyKvc372aD75r1QQjzwXxqbJCwpry',	'36 rue Des Roches',	'93100',	'Monteuil',	'2001-11-18'),
('c14',	'Daburon',	'François',	'fdaburon',	'$2y$10$iNz.cZRdlP6yuGZR75EGaep/YHepffwy24pHJ2aetVvgg3K3tGuDS',	'13 rue de Chanzy',	'94000',	'Créteil',	'2002-02-11'),
('c3',	'De',	'Philippe',	'pde',	'$2y$10$F.4VgYw.n5CWj/NWzvZpqeJ6M3UjOqpKezs3gHkXfFP693bKp7iGa',	'13 rue Barthes',	'94000',	'Créteil',	'2010-12-14'),
('c54',	'Debelle',	'Michel',	'mdebelle',	'$2y$10$WMlAITr/Cu2SIJoqydZrie2fdzbLpngkL0CAUio1PtOXJxU6dcqV2',	'181 avenue Barbusse',	'93210',	'Rosny',	'2006-11-23'),
('d13',	'Debelle',	'Jeanne',	'jdebelle',	'$2y$10$8UaheH6zZOrJNKBeQnkWWOUtOMNIhDwL9pJmg/TF89Q5eBnS4L1Wm',	'134 allée des Joncs',	'44000',	'Nantes',	'2000-05-11'),
('d51',	'Debroise',	'Michel',	'mdebroise',	'$2y$10$Bb1tbgtbAANaWT5QyQvP5OtDT5C8EfodcWeNOxiYDITElrdoZiL2S',	'2 Bld Jourdain',	'44000',	'Nantes',	'2001-04-17'),
('e22',	'Desmarquest',	'Nathalie',	'ndesmarquest',	'$2y$10$KsdPxiytFpehHETOLgLnSu/K3/b5AdGych.2mUTwtQ4/tT2amLhP.',	'14 Place d Arc',	'45000',	'Orléans',	'2005-11-12'),
('e24',	'Desnost',	'Pierre',	'pdesnost',	'$2y$10$vEVoGWqZSiAGPs6w/.LymeHmxxyaUgKhb4WudKRqJNZ0OakY0X8OG',	'16 avenue des Cèdres',	'23200',	'Guéret',	'2001-02-05'),
('e39',	'Dudouit',	'Frédéric',	'fdudouit',	'$2y$10$58RxUbH5XFvNdUxSVeSTD.pfaBMx7K7BxQsNelFWRCH6D/EqW.NUS',	'18 rue de l église',	'23120',	'GrandBourg',	'2000-08-01'),
('e49',	'Duncombe',	'Claude',	'cduncombe',	'$2y$10$9pXwp21Y/A68WpGLJnitjuivgsXA0XJNhdrBQMfpELgqFiKCkM/ES',	'19 rue de la tour',	'23100',	'La souteraine',	'1987-10-10'),
('e5',	'Enault-Pascreau',	'Céline',	'cenault',	'$2y$10$wc9wgD.eAbHbJofy3MHSK.LngpAaBwIf0eQ3UBm9X.22fanc5wCIG',	'25 place de la gare',	'23200',	'Gueret',	'1995-09-01'),
('e52',	'Eynde',	'Valérie',	'veynde',	'$2y$10$8zNdsiW0/1ZS04Yno9mvne4casZh3ykU/hhPHUl7OCjrR.LfhalT2',	'3 Grand Place',	'13015',	'Marseille',	'1999-11-01'),
('f21',	'Finck',	'Jacques',	'jfinck',	'$2y$10$zg5I8MCX/.QTXBCRKr3kjuFxkkrY7jGJgq5oUWgBaMoUA37.m7Wqu',	'10 avenue du Prado',	'13002',	'Marseille',	'2001-11-10'),
('f39',	'Frémont',	'Fernande',	'ffremont',	'$2y$10$l7NjuAz/negOQV7P0mpd6.Kc3LXEu.A9M94dn48K/P9bNjcdCRTFC',	'4 route de la mer',	'13012',	'Allauh',	'1998-10-01'),
('f4',	'Gest',	'Alain',	'agest',	'$2y$10$eRKsNCde1CfLl3mMK5lr9e2slSmF0/XbVqVNloVYZuDK0RJI1cpyG',	'30 avenue de la mer',	'13025',	'Berre',	'1985-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `comptable`
--

DROP TABLE IF EXISTS `comptable`;
CREATE TABLE IF NOT EXISTS `comptable` (
  `id` char(4) NOT NULL,
  `nom` char(30) DEFAULT NULL,
  `prenom` char(30) DEFAULT NULL,
  `login` char(20) DEFAULT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `adresse` char(30) DEFAULT NULL,
  `cp` char(5) DEFAULT NULL,
  `ville` char(30) DEFAULT NULL,
  `dateembauche` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comptable` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateembauche`) VALUES
('a131',	'',	'',	'admin',	'$2y$10$tAwGV5BFUxWD7.CjVw6zw.iJpJw6EtHl5RH8DVIeYihq62ryeG.je',	'',	'',	'',	'0000-00-00');
--
-- Constraints for dumped tables
--

--
-- Constraints for table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `vehicule_ibfk_1` FOREIGN KEY (`idvisiteur`) REFERENCES `visiteur` (`id`),
  ADD CONSTRAINT `vehicule_ibfk_2` FOREIGN KEY (`idpuissance`) REFERENCES `puissancevehicule` (`id`);

--
-- Constraints for table `fichefrais`
--
ALTER TABLE `fichefrais`
  ADD CONSTRAINT `fichefrais_ibfk_1` FOREIGN KEY (`idetat`) REFERENCES `etat` (`id`),
  ADD CONSTRAINT `fichefrais_ibfk_2` FOREIGN KEY (`idvisiteur`) REFERENCES `visiteur` (`id`);

--
-- Constraints for table `lignefraisforfait`
--
ALTER TABLE `lignefraisforfait`
  ADD CONSTRAINT `lignefraisforfait_ibfk_1` FOREIGN KEY (`idvisiteur`,`mois`) REFERENCES `fichefrais` (`idvisiteur`, `mois`),
  ADD CONSTRAINT `lignefraisforfait_ibfk_2` FOREIGN KEY (`idfraisforfait`) REFERENCES `fraisforfait` (`id`);

--
-- Constraints for table `lignefraishorsforfait`
--
ALTER TABLE `lignefraishorsforfait`
  ADD CONSTRAINT `lignefraishorsforfait_ibfk_1` FOREIGN KEY (`idvisiteur`,`mois`) REFERENCES `fichefrais` (`idvisiteur`, `mois`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
