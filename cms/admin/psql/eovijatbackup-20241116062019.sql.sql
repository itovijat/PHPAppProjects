DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `in_quantity` float DEFAULT NULL,
  `out_quantity` float DEFAULT NULL,
  `value` float DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `person_name` varchar(50) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `company` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `inventory` VALUES("1", "Demo Product", "1", "0", "1", "2024-11-16", "Demo Person", "2024-11-16", "Demo Remark", "None");
INSERT INTO `inventory` VALUES("2", "Demo Product1", "1", "0", "1", "2024-11-16", "Demo Person1", "2024-11-16", "Demo Remark1", "None");
INSERT INTO `inventory` VALUES("3", "Demo Product2", "1", "0", "1", "2024-11-16", "Demo Person2", "2024-11-16", "Demo Remark2", "None");
INSERT INTO `inventory` VALUES("4", "Demo Product3", "1", "0", "1", "2024-11-16", "Demo Person3", "2024-11-16", "Demo Remark3", "None");
INSERT INTO `inventory` VALUES("5", "Demo Product4", "1", "0", "1", "2024-11-16", "Demo Person4", "2024-11-16", "Demo Remark4", "None");
INSERT INTO `inventory` VALUES("6", "Demo Product5", "1", "0", "1", "2024-11-16", "Demo Person5", "2024-11-16", "Demo Remark5", "None");
INSERT INTO `inventory` VALUES("7", "Demo Product6", "1", "0", "1", "2024-11-16", "Demo Person6", "2024-11-16", "Demo Remark6", "None");
INSERT INTO `inventory` VALUES("8", "Demo Product7", "1", "0", "1", "2024-11-16", "Demo Person7", "2024-11-16", "Demo Remark7", "None");
INSERT INTO `inventory` VALUES("9", "Demo Product8", "1", "0", "1", "2024-11-16", "Demo Person8", "2024-11-16", "Demo Remark8", "None");
INSERT INTO `inventory` VALUES("10", "Demo Product9", "1", "0", "1", "2024-11-16", "Demo Person9", "2024-11-16", "Demo Remark9", "None");
INSERT INTO `inventory` VALUES("11", "Demo Product10", "1", "0", "1", "2024-11-16", "Demo Person10", "2024-11-16", "Demo Remark10", "None");
INSERT INTO `inventory` VALUES("12", "Demo Product11", "1", "0", "1", "2024-11-16", "Demo Person11", "2024-11-16", "Demo Remark11", "None");
INSERT INTO `inventory` VALUES("13", "Demo Product12", "1", "0", "1", "2024-11-16", "Demo Person12", "2024-11-16", "Demo Remark12", "None");
INSERT INTO `inventory` VALUES("14", "Demo Product13", "1", "0", "1", "2024-11-16", "Demo Person13", "2024-11-16", "Demo Remark13", "None");
INSERT INTO `inventory` VALUES("15", "Demo Product14", "1", "0", "1", "2024-11-16", "Demo Person14", "2024-11-16", "Demo Remark14", "None");
INSERT INTO `inventory` VALUES("16", "Demo Product15", "1", "0", "1", "2024-11-16", "Demo Person15", "2024-11-16", "Demo Remark15", "None");
INSERT INTO `inventory` VALUES("17", "Demo Product16", "1", "0", "1", "2024-11-16", "Demo Person16", "2024-11-16", "Demo Remark16", "None");
INSERT INTO `inventory` VALUES("18", "Demo Product17", "1", "0", "1", "2024-11-16", "Demo Person17", "2024-11-16", "Demo Remark17", "None");
INSERT INTO `inventory` VALUES("19", "Demo Product18", "1", "0", "1", "2024-11-16", "Demo Person18", "2024-11-16", "Demo Remark18", "None");
INSERT INTO `inventory` VALUES("20", "Demo Product19", "1", "0", "1", "2024-11-16", "Demo Person19", "2024-11-16", "Demo Remark19", "None");
INSERT INTO `inventory` VALUES("21", "Demo Product20", "1", "0", "1", "2024-11-16", "Demo Person20", "2024-11-16", "Demo Remark20", "None");
INSERT INTO `inventory` VALUES("22", "Demo Product21", "1", "0", "1", "2024-11-16", "Demo Person21", "2024-11-16", "Demo Remark21", "None");
INSERT INTO `inventory` VALUES("23", "Demo Product22", "1", "0", "1", "2024-11-16", "Demo Person22", "2024-11-16", "Demo Remark22", "None");
INSERT INTO `inventory` VALUES("24", "Demo Product23", "1", "0", "1", "2024-11-16", "Demo Person23", "2024-11-16", "Demo Remark23", "None");
INSERT INTO `inventory` VALUES("25", "Demo Product24", "1", "0", "1", "2024-11-16", "Demo Person24", "2024-11-16", "Demo Remark24", "None");
INSERT INTO `inventory` VALUES("26", "Demo Product25", "1", "0", "1", "2024-11-16", "Demo Person25", "2024-11-16", "Demo Remark25", "None");
INSERT INTO `inventory` VALUES("27", "Demo Product26", "1", "0", "1", "2024-11-16", "Demo Person26", "2024-11-16", "Demo Remark26", "None");
INSERT INTO `inventory` VALUES("28", "Demo Product27", "1", "0", "1", "2024-11-16", "Demo Person27", "2024-11-16", "Demo Remark27", "None");
INSERT INTO `inventory` VALUES("29", "Demo Product28", "1", "0", "1", "2024-11-16", "Demo Person28", "2024-11-16", "Demo Remark28", "None");
INSERT INTO `inventory` VALUES("30", "Demo Product29", "1", "0", "1", "2024-11-16", "Demo Person29", "2024-11-16", "Demo Remark29", "None");
INSERT INTO `inventory` VALUES("31", "Demo Product30", "1", "0", "1", "2024-11-16", "Demo Person30", "2024-11-16", "Demo Remark30", "None");
INSERT INTO `inventory` VALUES("32", "Demo Product31", "1", "0", "1", "2024-11-16", "Demo Person31", "2024-11-16", "Demo Remark31", "None");
INSERT INTO `inventory` VALUES("33", "Demo Product32", "1", "0", "1", "2024-11-16", "Demo Person32", "2024-11-16", "Demo Remark32", "None");
INSERT INTO `inventory` VALUES("34", "Demo Product33", "1", "0", "1", "2024-11-16", "Demo Person33", "2024-11-16", "Demo Remark33", "None");
INSERT INTO `inventory` VALUES("35", "Demo Product34", "1", "0", "1", "2024-11-16", "Demo Person34", "2024-11-16", "Demo Remark34", "None");
INSERT INTO `inventory` VALUES("36", "Demo Product35", "1", "0", "1", "2024-11-16", "Demo Person35", "2024-11-16", "Demo Remark35", "None");
INSERT INTO `inventory` VALUES("37", "Demo Product36", "1", "0", "1", "2024-11-16", "Demo Person36", "2024-11-16", "Demo Remark36", "None");
INSERT INTO `inventory` VALUES("38", "Demo Product37", "1", "0", "1", "2024-11-16", "Demo Person37", "2024-11-16", "Demo Remark37", "None");
INSERT INTO `inventory` VALUES("39", "Demo Product38", "1", "0", "1", "2024-11-16", "Demo Person38", "2024-11-16", "Demo Remark38", "None");
INSERT INTO `inventory` VALUES("40", "Demo Product39", "1", "0", "1", "2024-11-16", "Demo Person39", "2024-11-16", "Demo Remark39", "None");
INSERT INTO `inventory` VALUES("41", "Demo Product40", "1", "0", "1", "2024-11-16", "Demo Person40", "2024-11-16", "Demo Remark40", "None");


DROP TABLE IF EXISTS `kpl`;
CREATE TABLE `kpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_name` varchar(50) NOT NULL,
  `driver_name` varchar(50) NOT NULL,
  `entry_date` date NOT NULL,
  `oil_quantity` float NOT NULL,
  `oil_price` float NOT NULL,
  `distance` float NOT NULL,
  `km` float NOT NULL,
  `remark` varchar(20) DEFAULT NULL,
  `company` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `kpl` VALUES("1", "Demo Vehicle", "Demo Driver", "2024-11-16", "1", "1", "1", "1", "Demo Remark", "None");
INSERT INTO `kpl` VALUES("2", "Demo Vehicle1", "Demo Driver1", "2024-11-16", "1", "1", "1", "1", "Demo Remark1", "None");
INSERT INTO `kpl` VALUES("3", "Demo Vehicle2", "Demo Driver2", "2024-11-16", "1", "1", "1", "1", "Demo Remark2", "None");
INSERT INTO `kpl` VALUES("4", "Demo Vehicle3", "Demo Driver3", "2024-11-16", "1", "1", "1", "1", "Demo Remark3", "None");
INSERT INTO `kpl` VALUES("5", "Demo Vehicle4", "Demo Driver4", "2024-11-16", "1", "1", "1", "1", "Demo Remark4", "None");
INSERT INTO `kpl` VALUES("6", "Demo Vehicle5", "Demo Driver5", "2024-11-16", "1", "1", "1", "1", "Demo Remark5", "None");
INSERT INTO `kpl` VALUES("7", "Demo Vehicle6", "Demo Driver6", "2024-11-16", "1", "1", "1", "1", "Demo Remark6", "None");
INSERT INTO `kpl` VALUES("8", "Demo Vehicle7", "Demo Driver7", "2024-11-16", "1", "1", "1", "1", "Demo Remark7", "None");
INSERT INTO `kpl` VALUES("9", "Demo Vehicle8", "Demo Driver8", "2024-11-16", "1", "1", "1", "1", "Demo Remark8", "None");
INSERT INTO `kpl` VALUES("10", "Demo Vehicle9", "Demo Driver9", "2024-11-16", "1", "1", "1", "1", "Demo Remark9", "None");
INSERT INTO `kpl` VALUES("11", "Demo Vehicle10", "Demo Driver10", "2024-11-16", "1", "1", "1", "1", "Demo Remark10", "None");
INSERT INTO `kpl` VALUES("12", "Demo Vehicle11", "Demo Driver11", "2024-11-16", "1", "1", "1", "1", "Demo Remark11", "None");
INSERT INTO `kpl` VALUES("13", "Demo Vehicle12", "Demo Driver12", "2024-11-16", "1", "1", "1", "1", "Demo Remark12", "None");
INSERT INTO `kpl` VALUES("14", "Demo Vehicle13", "Demo Driver13", "2024-11-16", "1", "1", "1", "1", "Demo Remark13", "None");
INSERT INTO `kpl` VALUES("15", "Demo Vehicle14", "Demo Driver14", "2024-11-16", "1", "1", "1", "1", "Demo Remark14", "None");
INSERT INTO `kpl` VALUES("16", "Demo Vehicle15", "Demo Driver15", "2024-11-16", "1", "1", "1", "1", "Demo Remark15", "None");
INSERT INTO `kpl` VALUES("17", "Demo Vehicle16", "Demo Driver16", "2024-11-16", "1", "1", "1", "1", "Demo Remark16", "None");
INSERT INTO `kpl` VALUES("18", "Demo Vehicle17", "Demo Driver17", "2024-11-16", "1", "1", "1", "1", "Demo Remark17", "None");
INSERT INTO `kpl` VALUES("19", "Demo Vehicle18", "Demo Driver18", "2024-11-16", "1", "1", "1", "1", "Demo Remark18", "None");
INSERT INTO `kpl` VALUES("20", "Demo Vehicle19", "Demo Driver19", "2024-11-16", "1", "1", "1", "1", "Demo Remark19", "None");
INSERT INTO `kpl` VALUES("21", "Demo Vehicle20", "Demo Driver20", "2024-11-16", "1", "1", "1", "1", "Demo Remark20", "None");
INSERT INTO `kpl` VALUES("22", "Demo Vehicle21", "Demo Driver21", "2024-11-16", "1", "1", "1", "1", "Demo Remark21", "None");
INSERT INTO `kpl` VALUES("23", "Demo Vehicle22", "Demo Driver22", "2024-11-16", "1", "1", "1", "1", "Demo Remark22", "None");
INSERT INTO `kpl` VALUES("24", "Demo Vehicle23", "Demo Driver23", "2024-11-16", "1", "1", "1", "1", "Demo Remark23", "None");
INSERT INTO `kpl` VALUES("25", "Demo Vehicle24", "Demo Driver24", "2024-11-16", "1", "1", "1", "1", "Demo Remark24", "None");
INSERT INTO `kpl` VALUES("26", "Demo Vehicle25", "Demo Driver25", "2024-11-16", "1", "1", "1", "1", "Demo Remark25", "None");
INSERT INTO `kpl` VALUES("27", "Demo Vehicle26", "Demo Driver26", "2024-11-16", "1", "1", "1", "1", "Demo Remark26", "None");
INSERT INTO `kpl` VALUES("28", "Demo Vehicle27", "Demo Driver27", "2024-11-16", "1", "1", "1", "1", "Demo Remark27", "None");
INSERT INTO `kpl` VALUES("29", "Demo Vehicle28", "Demo Driver28", "2024-11-16", "1", "1", "1", "1", "Demo Remark28", "None");
INSERT INTO `kpl` VALUES("30", "Demo Vehicle29", "Demo Driver29", "2024-11-16", "1", "1", "1", "1", "Demo Remark29", "None");
INSERT INTO `kpl` VALUES("31", "Demo Vehicle30", "Demo Driver30", "2024-11-16", "1", "1", "1", "1", "Demo Remark30", "None");
INSERT INTO `kpl` VALUES("32", "Demo Vehicle31", "Demo Driver31", "2024-11-16", "1", "1", "1", "1", "Demo Remark31", "None");
INSERT INTO `kpl` VALUES("33", "Demo Vehicle32", "Demo Driver32", "2024-11-16", "1", "1", "1", "1", "Demo Remark32", "None");
INSERT INTO `kpl` VALUES("34", "Demo Vehicle33", "Demo Driver33", "2024-11-16", "1", "1", "1", "1", "Demo Remark33", "None");
INSERT INTO `kpl` VALUES("35", "Demo Vehicle34", "Demo Driver34", "2024-11-16", "1", "1", "1", "1", "Demo Remark34", "None");
INSERT INTO `kpl` VALUES("36", "Demo Vehicle35", "Demo Driver35", "2024-11-16", "1", "1", "1", "1", "Demo Remark35", "None");
INSERT INTO `kpl` VALUES("37", "Demo Vehicle36", "Demo Driver36", "2024-11-16", "1", "1", "1", "1", "Demo Remark36", "None");
INSERT INTO `kpl` VALUES("38", "Demo Vehicle37", "Demo Driver37", "2024-11-16", "1", "1", "1", "1", "Demo Remark37", "None");
INSERT INTO `kpl` VALUES("39", "Demo Vehicle38", "Demo Driver38", "2024-11-16", "1", "1", "1", "1", "Demo Remark38", "None");
INSERT INTO `kpl` VALUES("40", "Demo Vehicle39", "Demo Driver39", "2024-11-16", "1", "1", "1", "1", "Demo Remark39", "None");
INSERT INTO `kpl` VALUES("41", "Demo Vehicle40", "Demo Driver40", "2024-11-16", "1", "1", "1", "1", "Demo Remark40", "None");


DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idvisit` int(11) DEFAULT NULL,
  `pn` varchar(30) DEFAULT NULL,
  `unit` float DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `orders` VALUES("1", "1", "Demo PN", "1", "1", "1");
INSERT INTO `orders` VALUES("2", "2", "Demo PN1", "1", "1", "1");
INSERT INTO `orders` VALUES("3", "3", "Demo PN2", "1", "1", "1");
INSERT INTO `orders` VALUES("4", "4", "Demo PN3", "1", "1", "1");
INSERT INTO `orders` VALUES("5", "5", "Demo PN4", "1", "1", "1");
INSERT INTO `orders` VALUES("6", "6", "Demo PN5", "1", "1", "1");
INSERT INTO `orders` VALUES("7", "7", "Demo PN6", "1", "1", "1");
INSERT INTO `orders` VALUES("8", "8", "Demo PN7", "1", "1", "1");
INSERT INTO `orders` VALUES("9", "9", "Demo PN8", "1", "1", "1");
INSERT INTO `orders` VALUES("10", "10", "Demo PN9", "1", "1", "1");
INSERT INTO `orders` VALUES("11", "11", "Demo PN10", "1", "1", "1");
INSERT INTO `orders` VALUES("12", "12", "Demo PN11", "1", "1", "1");
INSERT INTO `orders` VALUES("13", "13", "Demo PN12", "1", "1", "1");
INSERT INTO `orders` VALUES("14", "14", "Demo PN13", "1", "1", "1");
INSERT INTO `orders` VALUES("15", "15", "Demo PN14", "1", "1", "1");
INSERT INTO `orders` VALUES("16", "16", "Demo PN15", "1", "1", "1");
INSERT INTO `orders` VALUES("17", "17", "Demo PN16", "1", "1", "1");
INSERT INTO `orders` VALUES("18", "18", "Demo PN17", "1", "1", "1");
INSERT INTO `orders` VALUES("19", "19", "Demo PN18", "1", "1", "1");
INSERT INTO `orders` VALUES("20", "20", "Demo PN19", "1", "1", "1");
INSERT INTO `orders` VALUES("21", "21", "Demo PN20", "1", "1", "1");
INSERT INTO `orders` VALUES("22", "22", "Demo PN21", "1", "1", "1");
INSERT INTO `orders` VALUES("23", "23", "Demo PN22", "1", "1", "1");
INSERT INTO `orders` VALUES("24", "24", "Demo PN23", "1", "1", "1");
INSERT INTO `orders` VALUES("25", "25", "Demo PN24", "1", "1", "1");
INSERT INTO `orders` VALUES("26", "26", "Demo PN25", "1", "1", "1");
INSERT INTO `orders` VALUES("27", "27", "Demo PN26", "1", "1", "1");
INSERT INTO `orders` VALUES("28", "28", "Demo PN27", "1", "1", "1");
INSERT INTO `orders` VALUES("29", "29", "Demo PN28", "1", "1", "1");
INSERT INTO `orders` VALUES("30", "30", "Demo PN29", "1", "1", "1");
INSERT INTO `orders` VALUES("31", "31", "Demo PN30", "1", "1", "1");
INSERT INTO `orders` VALUES("32", "32", "Demo PN31", "1", "1", "1");
INSERT INTO `orders` VALUES("33", "33", "Demo PN32", "1", "1", "1");
INSERT INTO `orders` VALUES("34", "34", "Demo PN33", "1", "1", "1");
INSERT INTO `orders` VALUES("35", "35", "Demo PN34", "1", "1", "1");
INSERT INTO `orders` VALUES("36", "36", "Demo PN35", "1", "1", "1");
INSERT INTO `orders` VALUES("37", "37", "Demo PN36", "1", "1", "1");
INSERT INTO `orders` VALUES("38", "38", "Demo PN37", "1", "1", "1");
INSERT INTO `orders` VALUES("39", "39", "Demo PN38", "1", "1", "1");
INSERT INTO `orders` VALUES("40", "40", "Demo PN39", "1", "1", "1");
INSERT INTO `orders` VALUES("41", "41", "Demo PN40", "1", "1", "1");


DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `company` varchar(10) NOT NULL,
  `photo` varchar(20) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `pid` varchar(5) NOT NULL,
  `bloodgroup` varchar(2) NOT NULL,
  `issuedate` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `post` varchar(30) NOT NULL,
  `dept` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `persons`;
CREATE TABLE `persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `company` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `phone`;
CREATE TABLE `phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `company` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `phone` VALUES("1", "Demo Phone", "None");
INSERT INTO `phone` VALUES("2", "Demo Phone1", "None");
INSERT INTO `phone` VALUES("3", "Demo Phone2", "None");
INSERT INTO `phone` VALUES("4", "Demo Phone3", "None");
INSERT INTO `phone` VALUES("5", "Demo Phone4", "None");
INSERT INTO `phone` VALUES("6", "Demo Phone5", "None");
INSERT INTO `phone` VALUES("7", "Demo Phone6", "None");
INSERT INTO `phone` VALUES("8", "Demo Phone7", "None");
INSERT INTO `phone` VALUES("9", "Demo Phone8", "None");
INSERT INTO `phone` VALUES("10", "Demo Phone9", "None");
INSERT INTO `phone` VALUES("11", "Demo Phone10", "None");
INSERT INTO `phone` VALUES("12", "Demo Phone11", "None");
INSERT INTO `phone` VALUES("13", "Demo Phone12", "None");
INSERT INTO `phone` VALUES("14", "Demo Phone13", "None");
INSERT INTO `phone` VALUES("15", "Demo Phone14", "None");
INSERT INTO `phone` VALUES("16", "Demo Phone15", "None");
INSERT INTO `phone` VALUES("17", "Demo Phone16", "None");
INSERT INTO `phone` VALUES("18", "Demo Phone17", "None");
INSERT INTO `phone` VALUES("19", "Demo Phone18", "None");
INSERT INTO `phone` VALUES("20", "Demo Phone19", "None");
INSERT INTO `phone` VALUES("21", "Demo Phone20", "None");
INSERT INTO `phone` VALUES("22", "Demo Phone21", "None");
INSERT INTO `phone` VALUES("23", "Demo Phone22", "None");
INSERT INTO `phone` VALUES("24", "Demo Phone23", "None");
INSERT INTO `phone` VALUES("25", "Demo Phone24", "None");
INSERT INTO `phone` VALUES("26", "Demo Phone25", "None");
INSERT INTO `phone` VALUES("27", "Demo Phone26", "None");
INSERT INTO `phone` VALUES("28", "Demo Phone27", "None");
INSERT INTO `phone` VALUES("29", "Demo Phone28", "None");
INSERT INTO `phone` VALUES("30", "Demo Phone29", "None");
INSERT INTO `phone` VALUES("31", "Demo Phone30", "None");
INSERT INTO `phone` VALUES("32", "Demo Phone31", "None");
INSERT INTO `phone` VALUES("33", "Demo Phone32", "None");
INSERT INTO `phone` VALUES("34", "Demo Phone33", "None");
INSERT INTO `phone` VALUES("35", "Demo Phone34", "None");
INSERT INTO `phone` VALUES("36", "Demo Phone35", "None");
INSERT INTO `phone` VALUES("37", "Demo Phone36", "None");
INSERT INTO `phone` VALUES("38", "Demo Phone37", "None");
INSERT INTO `phone` VALUES("39", "Demo Phone38", "None");
INSERT INTO `phone` VALUES("40", "Demo Phone39", "None");
INSERT INTO `phone` VALUES("41", "Demo Phone40", "None");


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `company` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `route`;
CREATE TABLE `route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `company` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `route` VALUES("1", "Demo Route", "None");
INSERT INTO `route` VALUES("2", "Demo Route1", "None");
INSERT INTO `route` VALUES("3", "Demo Route2", "None");
INSERT INTO `route` VALUES("4", "Demo Route3", "None");
INSERT INTO `route` VALUES("5", "Demo Route4", "None");
INSERT INTO `route` VALUES("6", "Demo Route5", "None");
INSERT INTO `route` VALUES("7", "Demo Route6", "None");
INSERT INTO `route` VALUES("8", "Demo Route7", "None");
INSERT INTO `route` VALUES("9", "Demo Route8", "None");
INSERT INTO `route` VALUES("10", "Demo Route9", "None");
INSERT INTO `route` VALUES("11", "Demo Route10", "None");
INSERT INTO `route` VALUES("12", "Demo Route11", "None");
INSERT INTO `route` VALUES("13", "Demo Route12", "None");
INSERT INTO `route` VALUES("14", "Demo Route13", "None");
INSERT INTO `route` VALUES("15", "Demo Route14", "None");
INSERT INTO `route` VALUES("16", "Demo Route15", "None");
INSERT INTO `route` VALUES("17", "Demo Route16", "None");
INSERT INTO `route` VALUES("18", "Demo Route17", "None");
INSERT INTO `route` VALUES("19", "Demo Route18", "None");
INSERT INTO `route` VALUES("20", "Demo Route19", "None");
INSERT INTO `route` VALUES("21", "Demo Route20", "None");
INSERT INTO `route` VALUES("22", "Demo Route21", "None");
INSERT INTO `route` VALUES("23", "Demo Route22", "None");
INSERT INTO `route` VALUES("24", "Demo Route23", "None");
INSERT INTO `route` VALUES("25", "Demo Route24", "None");
INSERT INTO `route` VALUES("26", "Demo Route25", "None");
INSERT INTO `route` VALUES("27", "Demo Route26", "None");
INSERT INTO `route` VALUES("28", "Demo Route27", "None");
INSERT INTO `route` VALUES("29", "Demo Route28", "None");
INSERT INTO `route` VALUES("30", "Demo Route29", "None");
INSERT INTO `route` VALUES("31", "Demo Route30", "None");
INSERT INTO `route` VALUES("32", "Demo Route31", "None");
INSERT INTO `route` VALUES("33", "Demo Route32", "None");
INSERT INTO `route` VALUES("34", "Demo Route33", "None");
INSERT INTO `route` VALUES("35", "Demo Route34", "None");
INSERT INTO `route` VALUES("36", "Demo Route35", "None");
INSERT INTO `route` VALUES("37", "Demo Route36", "None");
INSERT INTO `route` VALUES("38", "Demo Route37", "None");
INSERT INTO `route` VALUES("39", "Demo Route38", "None");
INSERT INTO `route` VALUES("40", "Demo Route39", "None");
INSERT INTO `route` VALUES("41", "Demo Route40", "None");


DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `company` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `email` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` varchar(10) NOT NULL,
  `company` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` VALUES("demo", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo1", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo10", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo11", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo12", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo13", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo14", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo15", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo16", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo17", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo18", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo19", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo2", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo20", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo21", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo22", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo23", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo24", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo25", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo26", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo27", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo28", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo29", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo3", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo30", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo31", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo32", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo33", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo34", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo35", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo36", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo37", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo38", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo39", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo4", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo40", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo5", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo6", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo7", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo8", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("demo9", "fe01ce2a7fbac8fafaed7c982a04e229", "admin", "None", "0", "2024-11-16 06:19:22");
INSERT INTO `user` VALUES("itovijat", "3949ac2de491f1ba2f4b76c85a6b7df6", "admin", "None", "0", "2024-11-16 06:19:22");


DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `company` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `vehicles` VALUES("1", "Demo Vehicle", "None");
INSERT INTO `vehicles` VALUES("2", "Demo Vehicle1", "None");
INSERT INTO `vehicles` VALUES("3", "Demo Vehicle2", "None");
INSERT INTO `vehicles` VALUES("4", "Demo Vehicle3", "None");
INSERT INTO `vehicles` VALUES("5", "Demo Vehicle4", "None");
INSERT INTO `vehicles` VALUES("6", "Demo Vehicle5", "None");
INSERT INTO `vehicles` VALUES("7", "Demo Vehicle6", "None");
INSERT INTO `vehicles` VALUES("8", "Demo Vehicle7", "None");
INSERT INTO `vehicles` VALUES("9", "Demo Vehicle8", "None");
INSERT INTO `vehicles` VALUES("10", "Demo Vehicle9", "None");
INSERT INTO `vehicles` VALUES("11", "Demo Vehicle10", "None");
INSERT INTO `vehicles` VALUES("12", "Demo Vehicle11", "None");
INSERT INTO `vehicles` VALUES("13", "Demo Vehicle12", "None");
INSERT INTO `vehicles` VALUES("14", "Demo Vehicle13", "None");
INSERT INTO `vehicles` VALUES("15", "Demo Vehicle14", "None");
INSERT INTO `vehicles` VALUES("16", "Demo Vehicle15", "None");
INSERT INTO `vehicles` VALUES("17", "Demo Vehicle16", "None");
INSERT INTO `vehicles` VALUES("18", "Demo Vehicle17", "None");
INSERT INTO `vehicles` VALUES("19", "Demo Vehicle18", "None");
INSERT INTO `vehicles` VALUES("20", "Demo Vehicle19", "None");
INSERT INTO `vehicles` VALUES("21", "Demo Vehicle20", "None");
INSERT INTO `vehicles` VALUES("22", "Demo Vehicle21", "None");
INSERT INTO `vehicles` VALUES("23", "Demo Vehicle22", "None");
INSERT INTO `vehicles` VALUES("24", "Demo Vehicle23", "None");
INSERT INTO `vehicles` VALUES("25", "Demo Vehicle24", "None");
INSERT INTO `vehicles` VALUES("26", "Demo Vehicle25", "None");
INSERT INTO `vehicles` VALUES("27", "Demo Vehicle26", "None");
INSERT INTO `vehicles` VALUES("28", "Demo Vehicle27", "None");
INSERT INTO `vehicles` VALUES("29", "Demo Vehicle28", "None");
INSERT INTO `vehicles` VALUES("30", "Demo Vehicle29", "None");
INSERT INTO `vehicles` VALUES("31", "Demo Vehicle30", "None");
INSERT INTO `vehicles` VALUES("32", "Demo Vehicle31", "None");
INSERT INTO `vehicles` VALUES("33", "Demo Vehicle32", "None");
INSERT INTO `vehicles` VALUES("34", "Demo Vehicle33", "None");
INSERT INTO `vehicles` VALUES("35", "Demo Vehicle34", "None");
INSERT INTO `vehicles` VALUES("36", "Demo Vehicle35", "None");
INSERT INTO `vehicles` VALUES("37", "Demo Vehicle36", "None");
INSERT INTO `vehicles` VALUES("38", "Demo Vehicle37", "None");
INSERT INTO `vehicles` VALUES("39", "Demo Vehicle38", "None");
INSERT INTO `vehicles` VALUES("40", "Demo Vehicle39", "None");
INSERT INTO `vehicles` VALUES("41", "Demo Vehicle40", "None");


DROP TABLE IF EXISTS `visit`;
CREATE TABLE `visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mo` varchar(20) DEFAULT NULL,
  `route` varchar(20) DEFAULT NULL,
  `shop` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `reason` varchar(5) DEFAULT NULL,
  `memo` bigint(20) DEFAULT NULL,
  `company` varchar(10) DEFAULT NULL,
  `odate` date DEFAULT NULL,
  `ddate` date DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL,
  `serial` int(11) DEFAULT 0,
  `status` smallint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `visit` VALUES("1", "2024-11-16 06:19:22", "Demo MO", "Demo Route", "Demo Shop", "Demo Phone", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment", "0", "0");
INSERT INTO `visit` VALUES("2", "2024-11-16 06:19:22", "Demo MO1", "Demo Route1", "Demo Shop1", "Demo Phone1", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment1", "0", "0");
INSERT INTO `visit` VALUES("3", "2024-11-16 06:19:22", "Demo MO2", "Demo Route2", "Demo Shop2", "Demo Phone2", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment2", "0", "0");
INSERT INTO `visit` VALUES("4", "2024-11-16 06:19:22", "Demo MO3", "Demo Route3", "Demo Shop3", "Demo Phone3", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment3", "0", "0");
INSERT INTO `visit` VALUES("5", "2024-11-16 06:19:22", "Demo MO4", "Demo Route4", "Demo Shop4", "Demo Phone4", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment4", "0", "0");
INSERT INTO `visit` VALUES("6", "2024-11-16 06:19:22", "Demo MO5", "Demo Route5", "Demo Shop5", "Demo Phone5", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment5", "0", "0");
INSERT INTO `visit` VALUES("7", "2024-11-16 06:19:22", "Demo MO6", "Demo Route6", "Demo Shop6", "Demo Phone6", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment6", "0", "0");
INSERT INTO `visit` VALUES("8", "2024-11-16 06:19:22", "Demo MO7", "Demo Route7", "Demo Shop7", "Demo Phone7", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment7", "0", "0");
INSERT INTO `visit` VALUES("9", "2024-11-16 06:19:22", "Demo MO8", "Demo Route8", "Demo Shop8", "Demo Phone8", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment8", "0", "0");
INSERT INTO `visit` VALUES("10", "2024-11-16 06:19:22", "Demo MO9", "Demo Route9", "Demo Shop9", "Demo Phone9", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment9", "0", "0");
INSERT INTO `visit` VALUES("11", "2024-11-16 06:19:22", "Demo MO10", "Demo Route10", "Demo Shop10", "Demo Phone10", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment10", "0", "0");
INSERT INTO `visit` VALUES("12", "2024-11-16 06:19:22", "Demo MO11", "Demo Route11", "Demo Shop11", "Demo Phone11", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment11", "0", "0");
INSERT INTO `visit` VALUES("13", "2024-11-16 06:19:22", "Demo MO12", "Demo Route12", "Demo Shop12", "Demo Phone12", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment12", "0", "0");
INSERT INTO `visit` VALUES("14", "2024-11-16 06:19:22", "Demo MO13", "Demo Route13", "Demo Shop13", "Demo Phone13", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment13", "0", "0");
INSERT INTO `visit` VALUES("15", "2024-11-16 06:19:22", "Demo MO14", "Demo Route14", "Demo Shop14", "Demo Phone14", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment14", "0", "0");
INSERT INTO `visit` VALUES("16", "2024-11-16 06:19:22", "Demo MO15", "Demo Route15", "Demo Shop15", "Demo Phone15", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment15", "0", "0");
INSERT INTO `visit` VALUES("17", "2024-11-16 06:19:22", "Demo MO16", "Demo Route16", "Demo Shop16", "Demo Phone16", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment16", "0", "0");
INSERT INTO `visit` VALUES("18", "2024-11-16 06:19:22", "Demo MO17", "Demo Route17", "Demo Shop17", "Demo Phone17", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment17", "0", "0");
INSERT INTO `visit` VALUES("19", "2024-11-16 06:19:22", "Demo MO18", "Demo Route18", "Demo Shop18", "Demo Phone18", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment18", "0", "0");
INSERT INTO `visit` VALUES("20", "2024-11-16 06:19:22", "Demo MO19", "Demo Route19", "Demo Shop19", "Demo Phone19", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment19", "0", "0");
INSERT INTO `visit` VALUES("21", "2024-11-16 06:19:22", "Demo MO20", "Demo Route20", "Demo Shop20", "Demo Phone20", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment20", "0", "0");
INSERT INTO `visit` VALUES("22", "2024-11-16 06:19:22", "Demo MO21", "Demo Route21", "Demo Shop21", "Demo Phone21", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment21", "0", "0");
INSERT INTO `visit` VALUES("23", "2024-11-16 06:19:22", "Demo MO22", "Demo Route22", "Demo Shop22", "Demo Phone22", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment22", "0", "0");
INSERT INTO `visit` VALUES("24", "2024-11-16 06:19:22", "Demo MO23", "Demo Route23", "Demo Shop23", "Demo Phone23", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment23", "0", "0");
INSERT INTO `visit` VALUES("25", "2024-11-16 06:19:22", "Demo MO24", "Demo Route24", "Demo Shop24", "Demo Phone24", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment24", "0", "0");
INSERT INTO `visit` VALUES("26", "2024-11-16 06:19:22", "Demo MO25", "Demo Route25", "Demo Shop25", "Demo Phone25", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment25", "0", "0");
INSERT INTO `visit` VALUES("27", "2024-11-16 06:19:22", "Demo MO26", "Demo Route26", "Demo Shop26", "Demo Phone26", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment26", "0", "0");
INSERT INTO `visit` VALUES("28", "2024-11-16 06:19:22", "Demo MO27", "Demo Route27", "Demo Shop27", "Demo Phone27", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment27", "0", "0");
INSERT INTO `visit` VALUES("29", "2024-11-16 06:19:22", "Demo MO28", "Demo Route28", "Demo Shop28", "Demo Phone28", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment28", "0", "0");
INSERT INTO `visit` VALUES("30", "2024-11-16 06:19:22", "Demo MO29", "Demo Route29", "Demo Shop29", "Demo Phone29", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment29", "0", "0");
INSERT INTO `visit` VALUES("31", "2024-11-16 06:19:22", "Demo MO30", "Demo Route30", "Demo Shop30", "Demo Phone30", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment30", "0", "0");
INSERT INTO `visit` VALUES("32", "2024-11-16 06:19:22", "Demo MO31", "Demo Route31", "Demo Shop31", "Demo Phone31", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment31", "0", "0");
INSERT INTO `visit` VALUES("33", "2024-11-16 06:19:22", "Demo MO32", "Demo Route32", "Demo Shop32", "Demo Phone32", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment32", "0", "0");
INSERT INTO `visit` VALUES("34", "2024-11-16 06:19:22", "Demo MO33", "Demo Route33", "Demo Shop33", "Demo Phone33", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment33", "0", "0");
INSERT INTO `visit` VALUES("35", "2024-11-16 06:19:22", "Demo MO34", "Demo Route34", "Demo Shop34", "Demo Phone34", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment34", "0", "0");
INSERT INTO `visit` VALUES("36", "2024-11-16 06:19:22", "Demo MO35", "Demo Route35", "Demo Shop35", "Demo Phone35", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment35", "0", "0");
INSERT INTO `visit` VALUES("37", "2024-11-16 06:19:22", "Demo MO36", "Demo Route36", "Demo Shop36", "Demo Phone36", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment36", "0", "0");
INSERT INTO `visit` VALUES("38", "2024-11-16 06:19:22", "Demo MO37", "Demo Route37", "Demo Shop37", "Demo Phone37", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment37", "0", "0");
INSERT INTO `visit` VALUES("39", "2024-11-16 06:19:22", "Demo MO38", "Demo Route38", "Demo Shop38", "Demo Phone38", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment38", "0", "0");
INSERT INTO `visit` VALUES("40", "2024-11-16 06:19:22", "Demo MO39", "Demo Route39", "Demo Shop39", "Demo Phone39", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment39", "0", "0");
INSERT INTO `visit` VALUES("41", "2024-11-16 06:19:22", "Demo MO40", "Demo Route40", "Demo Shop40", "Demo Phone40", "0.00000000", "0.00000000", "demo", "0", "None", "2024-11-16", "2024-11-16", "Demo comment40", "0", "0");


