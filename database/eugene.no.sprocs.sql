-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: eugene
-- ------------------------------------------------------
-- Server version	5.7.16-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `provinces_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cities_provinces1_idx` (`provinces_id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=1637 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Bangued',1),(2,'Boliney',1),(3,'Bucay',1),(4,'Bucloc',1),(5,'Daguioman',1),(6,'Danglas',1),(7,'Dolores',1),(8,'La Paz',1),(9,'Lacub',1),(10,'Lagangilang',1),(11,'Lagayan',1),(12,'Langiden',1),(13,'Licuan-Baay',1),(14,'Luba',1),(15,'Malibcong',1),(16,'Manabo',1),(17,'Peñarrubia',1),(18,'Pidigan',1),(19,'Pilar',1),(20,'Sallapadan',1),(21,'San Isidro',1),(22,'San Juan',1),(23,'San Quintin',1),(24,'Tayum',1),(25,'Tineg',1),(26,'Tubo',1),(27,'Villaviciosa',1),(28,'Butuan City',2),(29,'Buenavista',2),(30,'Cabadbaran',2),(31,'Carmen',2),(32,'Jabonga',2),(33,'Kitcharao',2),(34,'Las Nieves',2),(35,'Magallanes',2),(36,'Nasipit',2),(37,'Remedios T. Romualdez',2),(38,'Santiago',2),(39,'Tubay',2),(40,'Bayugan',3),(41,'Bunawan',3),(42,'Esperanza',3),(43,'La Paz',3),(44,'Loreto',3),(45,'Prosperidad',3),(46,'Rosario',3),(47,'San Francisco',3),(48,'San Luis',3),(49,'Santa Josefa',3),(50,'Sibagat',3),(51,'Talacogon',3),(52,'Trento',3),(53,'Veruela',3),(54,'Altavas',4),(55,'Balete',4),(56,'Banga',4),(57,'Batan',4),(58,'Buruanga',4),(59,'Ibajay',4),(60,'Kalibo',4),(61,'Lezo',4),(62,'Libacao',4),(63,'Madalag',4),(64,'Makato',4),(65,'Malay',4),(66,'Malinao',4),(67,'Nabas',4),(68,'New Washington',4),(69,'Numancia',4),(70,'Tangalan',4),(71,'Legazpi City',5),(72,'Ligao City',5),(73,'Tabaco City',5),(74,'Bacacay',5),(75,'Camalig',5),(76,'Daraga',5),(77,'Guinobatan',5),(78,'Jovellar',5),(79,'Libon',5),(80,'Malilipot',5),(81,'Malinao',5),(82,'Manito',5),(83,'Oas',5),(84,'Pio Duran',5),(85,'Polangui',5),(86,'Rapu-Rapu',5),(87,'Santo Domingo',5),(88,'Tiwi',5),(89,'Anini-y',6),(90,'Barbaza',6),(91,'Belison',6),(92,'Bugasong',6),(93,'Caluya',6),(94,'Culasi',6),(95,'Hamtic',6),(96,'Laua-an',6),(97,'Libertad',6),(98,'Pandan',6),(99,'Patnongon',6),(100,'San Jose',6),(101,'San Remigio',6),(102,'Sebaste',6),(103,'Sibalom',6),(104,'Tibiao',6),(105,'Tobias Fornier',6),(106,'Valderrama',6),(107,'Calanasan',7),(108,'Conner',7),(109,'Flora',7),(110,'Kabugao',7),(111,'Luna',7),(112,'Pudtol',7),(113,'Santa Marcela',7),(114,'Baler',8),(115,'Casiguran',8),(116,'Dilasag',8),(117,'Dinalungan',8),(118,'Dingalan',8),(119,'Dipaculao',8),(120,'Maria Aurora',8),(121,'San Luis',8),(122,'Isabela City',9),(123,'Akbar',9),(124,'Al-Barka',9),(125,'Hadji Mohammad Ajul',9),(126,'Hadji Muhtamad',9),(127,'Lamitan',9),(128,'Lantawan',9),(129,'Maluso',9),(130,'Sumisip',9),(131,'Tabuan-Lasa',9),(132,'Tipo-Tipo',9),(133,'Tuburan',9),(134,'Ungkaya Pukan',9),(135,'Balanga City',10),(136,'Abucay',10),(137,'Bagac',10),(138,'Dinalupihan',10),(139,'Hermosa',10),(140,'Limay',10),(141,'Mariveles',10),(142,'Morong',10),(143,'Orani',10),(144,'Orion',10),(145,'Pilar',10),(146,'Samal',10),(147,'Basco',11),(148,'Itbayat',11),(149,'Ivana',11),(150,'Mahatao',11),(151,'Sabtang',11),(152,'Uyugan',11),(153,'Batangas City',12),(154,'Lipa City',12),(155,'Tanauan City',12),(156,'Agoncillo',12),(157,'Alitagtag',12),(158,'Balayan',12),(159,'Balete',12),(160,'Bauan',12),(161,'Calaca',12),(162,'Calatagan',12),(163,'Cuenca',12),(164,'Ibaan',12),(165,'Laurel',12),(166,'Lemery',12),(167,'Lian',12),(168,'Lobo',12),(169,'Mabini',12),(170,'Malvar',12),(171,'Mataas na Kahoy',12),(172,'Nasugbu',12),(173,'Padre Garcia',12),(174,'Rosario',12),(175,'San Jose',12),(176,'San Juan',12),(177,'San Luis',12),(178,'San Nicolas',12),(179,'San Pascual',12),(180,'Santa Teresita',12),(181,'Santo Tomas',12),(182,'Taal',12),(183,'Talisay',12),(184,'Taysan',12),(185,'Tingloy',12),(186,'Tuy',12),(187,'Baguio City',13),(188,'Atok',13),(189,'Bakun',13),(190,'Bokod',13),(191,'Buguias',13),(192,'Itogon',13),(193,'Kabayan',13),(194,'Kapangan',13),(195,'Kibungan',13),(196,'La Trinidad',13),(197,'Mankayan',13),(198,'Sablan',13),(199,'Tuba',13),(200,'Tublay',13),(201,'Almeria',14),(202,'Biliran',14),(203,'Cabucgayan',14),(204,'Caibiran',14),(205,'Culaba',14),(206,'Kawayan',14),(207,'Maripipi',14),(208,'Naval',14),(209,'Tagbilaran City',15),(210,'Alburquerque',15),(211,'Alicia',15),(212,'Anda',15),(213,'Antequera',15),(214,'Baclayon',15),(215,'Balilihan',15),(216,'Batuan',15),(217,'Bien Unido',15),(218,'Bilar',15),(219,'Buenavista',15),(220,'Calape',15),(221,'Candijay',15),(222,'Carmen',15),(223,'Catigbian',15),(224,'Clarin',15),(225,'Corella',15),(226,'Cortes',15),(227,'Dagohoy',15),(228,'Danao',15),(229,'Dauis',15),(230,'Dimiao',15),(231,'Duero',15),(232,'Garcia Hernandez',15),(233,'Getafe',15),(234,'Guindulman',15),(235,'Inabanga',15),(236,'Jagna',15),(237,'Lila',15),(238,'Loay',15),(239,'Loboc',15),(240,'Loon',15),(241,'Mabini',15),(242,'Maribojoc',15),(243,'Panglao',15),(244,'Pilar',15),(245,'President Carlos P. Garcia',15),(246,'Sagbayan',15),(247,'San Isidro',15),(248,'San Miguel',15),(249,'Sevilla',15),(250,'Sierra Bullones',15),(251,'Sikatuna',15),(252,'Talibon',15),(253,'Trinidad',15),(254,'Tubigon',15),(255,'Ubay',15),(256,'Valencia',15),(257,'Malaybalay City',16),(258,'Valencia City',16),(259,'Baungon',16),(260,'Cabanglasan',16),(261,'Damulog',16),(262,'Dangcagan',16),(263,'Don Carlos',16),(264,'Impasug-ong',16),(265,'Kadingilan',16),(266,'Kalilangan',16),(267,'Kibawe',16),(268,'Kitaotao',16),(269,'Lantapan',16),(270,'Libona',16),(271,'Malitbog',16),(272,'Manolo Fortich',16),(273,'Maramag',16),(274,'Pangantucan',16),(275,'Quezon',16),(276,'San Fernando',16),(277,'Sumilao',16),(278,'Talakag',16),(279,'Malolos City',17),(280,'Meycauayan City',17),(281,'San Jose del Monte City',17),(282,'Angat',17),(283,'Balagtas',17),(284,'Baliuag',17),(285,'Bocaue',17),(286,'Bulacan',17),(287,'Bustos',17),(288,'Calumpit',17),(289,'Doña Remedios Trinidad',17),(290,'Guiguinto',17),(291,'Hagonoy',17),(292,'Marilao',17),(293,'Norzagaray',17),(294,'Obando',17),(295,'Pandi',17),(296,'Paombong',17),(297,'Plaridel',17),(298,'Pulilan',17),(299,'San Ildefonso',17),(300,'San Miguel',17),(301,'San Rafael',17),(302,'Santa Maria',17),(303,'Tuguegarao City',18),(304,'Abulug',18),(305,'Alcala',18),(306,'Allacapan',18),(307,'Amulung',18),(308,'Aparri',18),(309,'Baggao',18),(310,'Ballesteros',18),(311,'Buguey',18),(312,'Calayan',18),(313,'Camalaniugan',18),(314,'Claveria',18),(315,'Enrile',18),(316,'Gattaran',18),(317,'Gonzaga',18),(318,'Iguig',18),(319,'Lal-lo',18),(320,'Lasam',18),(321,'Pamplona',18),(322,'Peñablanca',18),(323,'Piat',18),(324,'Rizal',18),(325,'Sanchez-Mira',18),(326,'Santa Ana',18),(327,'Santa Praxedes',18),(328,'Santa Teresita',18),(329,'Santo Niño',18),(330,'Solana',18),(331,'Tuao',18),(332,'Basud',19),(333,'Capalonga',19),(334,'Daet',19),(335,'Jose Panganiban',19),(336,'Labo',19),(337,'Mercedes',19),(338,'Paracale',19),(339,'San Lorenzo Ruiz',19),(340,'San Vicente',19),(341,'Santa Elena',19),(342,'Talisay',19),(343,'Vinzons',19),(344,'Iriga City',20),(345,'Naga City',20),(346,'Baao',20),(347,'Balatan',20),(348,'Bato',20),(349,'Bombon',20),(350,'Buhi',20),(351,'Bula',20),(352,'Cabusao',20),(353,'Calabanga',20),(354,'Camaligan',20),(355,'Canaman',20),(356,'Caramoan',20),(357,'Del Gallego',20),(358,'Gainza',20),(359,'Garchitorena',20),(360,'Goa',20),(361,'Lagonoy',20),(362,'Libmanan',20),(363,'Lupi',20),(364,'Magarao',20),(365,'Milaor',20),(366,'Minalabac',20),(367,'Nabua',20),(368,'Ocampo',20),(369,'Pamplona',20),(370,'Pasacao',20),(371,'Pili',20),(372,'Presentacion',20),(373,'Ragay',20),(374,'Sagñay',20),(375,'San Fernando',20),(376,'San Jose',20),(377,'Sipocot',20),(378,'Siruma',20),(379,'Tigaon',20),(380,'Tinambac',20),(381,'Catarman',21),(382,'Guinsiliban',21),(383,'Mahinog',21),(384,'Mambajao',21),(385,'Sagay',21),(386,'Roxas City',22),(387,'Cuartero',22),(388,'Dao',22),(389,'Dumalag',22),(390,'Dumarao',22),(391,'Ivisan',22),(392,'Jamindan',22),(393,'Ma-ayon',22),(394,'Mambusao',22),(395,'Panay',22),(396,'Panitan',22),(397,'Pilar',22),(398,'Pontevedra',22),(399,'President Roxas',22),(400,'Sapi-an',22),(401,'Sigma',22),(402,'Tapaz',22),(403,'Bagamanoc',23),(404,'Baras',23),(405,'Bato',23),(406,'Caramoran',23),(407,'Gigmoto',23),(408,'Pandan',23),(409,'Panganiban',23),(410,'San Andres',23),(411,'San Miguel',23),(412,'Viga',23),(413,'Virac',23),(414,'Cavite City',24),(415,'Dasmariñas City',24),(416,'Tagaytay City',24),(417,'Trece Martires City',24),(418,'Alfonso',24),(419,'Amadeo',24),(420,'Bacoor',24),(421,'Carmona',24),(422,'General Mariano Alvarez',24),(423,'General Emilio Aguinaldo',24),(424,'General Trias',24),(425,'Imus',24),(426,'Indang',24),(427,'Kawit',24),(428,'Magallanes',24),(429,'Maragondon',24),(430,'Mendez',24),(431,'Naic',24),(432,'Noveleta',24),(433,'Rosario',24),(434,'Silang',24),(435,'Tanza',24),(436,'Ternate',24),(437,'Bogo City',25),(438,'Cebu City',25),(439,'Carcar City',25),(440,'Danao City',25),(441,'Lapu-Lapu City',25),(442,'Mandaue City',25),(443,'Naga City',25),(444,'Talisay City',25),(445,'Toledo City',25),(446,'Alcantara',25),(447,'Alcoy',25),(448,'Alegria',25),(449,'Aloguinsan',25),(450,'Argao',25),(451,'Asturias',25),(452,'Badian',25),(453,'Balamban',25),(454,'Bantayan',25),(455,'Barili',25),(456,'Boljoon',25),(457,'Borbon',25),(458,'Carmen',25),(459,'Catmon',25),(460,'Compostela',25),(461,'Consolacion',25),(462,'Cordoba',25),(463,'Daanbantayan',25),(464,'Dalaguete',25),(465,'Dumanjug',25),(466,'Ginatilan',25),(467,'Liloan',25),(468,'Madridejos',25),(469,'Malabuyoc',25),(470,'Medellin',25),(471,'Minglanilla',25),(472,'Moalboal',25),(473,'Oslob',25),(474,'Pilar',25),(475,'Pinamungahan',25),(476,'Poro',25),(477,'Ronda',25),(478,'Samboan',25),(479,'San Fernando',25),(480,'San Francisco',25),(481,'San Remigio',25),(482,'Santa Fe',25),(483,'Santander',25),(484,'Sibonga',25),(485,'Sogod',25),(486,'Tabogon',25),(487,'Tabuelan',25),(488,'Tuburan',25),(489,'Tudela',25),(490,'Compostela',26),(491,'Laak',26),(492,'Mabini',26),(493,'Maco',26),(494,'Maragusan',26),(495,'Mawab',26),(496,'Monkayo',26),(497,'Montevista',26),(498,'Nabunturan',26),(499,'New Bataan',26),(500,'Pantukan',26),(501,'Kidapawan City',27),(502,'Alamada',27),(503,'Aleosan',27),(504,'Antipas',27),(505,'Arakan',27),(506,'Banisilan',27),(507,'Carmen',27),(508,'Kabacan',27),(509,'Libungan',27),(510,'M\'lang',27),(511,'Magpet',27),(512,'Makilala',27),(513,'Matalam',27),(514,'Midsayap',27),(515,'Pigkawayan',27),(516,'Pikit',27),(517,'President Roxas',27),(518,'Tulunan',27),(519,'Panabo City',28),(520,'Island Garden City of Samal',28),(521,'Tagum City',28),(522,'Asuncion',28),(523,'Braulio E. Dujali',28),(524,'Carmen',28),(525,'Kapalong',28),(526,'New Corella',28),(527,'San Isidro',28),(528,'Santo Tomas',28),(529,'Talaingod',28),(530,'Davao City',29),(531,'Digos City',29),(532,'Bansalan',29),(533,'Don Marcelino',29),(534,'Hagonoy',29),(535,'Jose Abad Santos',29),(536,'Kiblawan',29),(537,'Magsaysay',29),(538,'Malalag',29),(539,'Malita',29),(540,'Matanao',29),(541,'Padada',29),(542,'Santa Cruz',29),(543,'Santa Maria',29),(544,'Sarangani',29),(545,'Sulop',29),(546,'Mati City',30),(547,'Baganga',30),(548,'Banaybanay',30),(549,'Boston',30),(550,'Caraga',30),(551,'Cateel',30),(552,'Governor Generoso',30),(553,'Lupon',30),(554,'Manay',30),(555,'San Isidro',30),(556,'Tarragona',30),(557,'Arteche',31),(558,'Balangiga',31),(559,'Balangkayan',31),(560,'Borongan',31),(561,'Can-avid',31),(562,'Dolores',31),(563,'General MacArthur',31),(564,'Giporlos',31),(565,'Guiuan',31),(566,'Hernani',31),(567,'Jipapad',31),(568,'Lawaan',31),(569,'Llorente',31),(570,'Maslog',31),(571,'Maydolong',31),(572,'Mercedes',31),(573,'Oras',31),(574,'Quinapondan',31),(575,'Salcedo',31),(576,'San Julian',31),(577,'San Policarpo',31),(578,'Sulat',31),(579,'Taft',31),(580,'Buenavista',32),(581,'Jordan',32),(582,'Nueva Valencia',32),(583,'San Lorenzo',32),(584,'Sibunag',32),(585,'Aguinaldo',33),(586,'Alfonso Lista',33),(587,'Asipulo',33),(588,'Banaue',33),(589,'Hingyon',33),(590,'Hungduan',33),(591,'Kiangan',33),(592,'Lagawe',33),(593,'Lamut',33),(594,'Mayoyao',33),(595,'Tinoc',33),(596,'Batac City',34),(597,'Laoag City',34),(598,'Adams',34),(599,'Bacarra',34),(600,'Badoc',34),(601,'Bangui',34),(602,'Banna',34),(603,'Burgos',34),(604,'Carasi',34),(605,'Currimao',34),(606,'Dingras',34),(607,'Dumalneg',34),(608,'Marcos',34),(609,'Nueva Era',34),(610,'Pagudpud',34),(611,'Paoay',34),(612,'Pasuquin',34),(613,'Piddig',34),(614,'Pinili',34),(615,'San Nicolas',34),(616,'Sarrat',34),(617,'Solsona',34),(618,'Vintar',34),(619,'Candon City',35),(620,'Vigan City',35),(621,'Alilem',35),(622,'Banayoyo',35),(623,'Bantay',35),(624,'Burgos',35),(625,'Cabugao',35),(626,'Caoayan',35),(627,'Cervantes',35),(628,'Galimuyod',35),(629,'Gregorio Del Pilar',35),(630,'Lidlidda',35),(631,'Magsingal',35),(632,'Nagbukel',35),(633,'Narvacan',35),(634,'Quirino',35),(635,'Salcedo',35),(636,'San Emilio',35),(637,'San Esteban',35),(638,'San Ildefonso',35),(639,'San Juan',35),(640,'San Vicente',35),(641,'Santa',35),(642,'Santa Catalina',35),(643,'Santa Cruz',35),(644,'Santa Lucia',35),(645,'Santa Maria',35),(646,'Santiago',35),(647,'Santo Domingo',35),(648,'Sigay',35),(649,'Sinait',35),(650,'Sugpon',35),(651,'Suyo',35),(652,'Tagudin',35),(653,'Iloilo City',36),(654,'Passi City',36),(655,'Ajuy',36),(656,'Alimodian',36),(657,'Anilao',36),(658,'Badiangan',36),(659,'Balasan',36),(660,'Banate',36),(661,'Barotac Nuevo',36),(662,'Barotac Viejo',36),(663,'Batad',36),(664,'Bingawan',36),(665,'Cabatuan',36),(666,'Calinog',36),(667,'Carles',36),(668,'Concepcion',36),(669,'Dingle',36),(670,'Dueñas',36),(671,'Dumangas',36),(672,'Estancia',36),(673,'Guimbal',36),(674,'Igbaras',36),(675,'Janiuay',36),(676,'Lambunao',36),(677,'Leganes',36),(678,'Lemery',36),(679,'Leon',36),(680,'Maasin',36),(681,'Miagao',36),(682,'Mina',36),(683,'New Lucena',36),(684,'Oton',36),(685,'Pavia',36),(686,'Pototan',36),(687,'San Dionisio',36),(688,'San Enrique',36),(689,'San Joaquin',36),(690,'San Miguel',36),(691,'San Rafael',36),(692,'Santa Barbara',36),(693,'Sara',36),(694,'Tigbauan',36),(695,'Tubungan',36),(696,'Zarraga',36),(697,'Cauayan City',37),(698,'Santiago City',37),(699,'Alicia',37),(700,'Angadanan',37),(701,'Aurora',37),(702,'Benito Soliven',37),(703,'Burgos',37),(704,'Cabagan',37),(705,'Cabatuan',37),(706,'Cordon',37),(707,'Delfin Albano',37),(708,'Dinapigue',37),(709,'Divilacan',37),(710,'Echague',37),(711,'Gamu',37),(712,'Ilagan',37),(713,'Jones',37),(714,'Luna',37),(715,'Maconacon',37),(716,'Mallig',37),(717,'Naguilian',37),(718,'Palanan',37),(719,'Quezon',37),(720,'Quirino',37),(721,'Ramon',37),(722,'Reina Mercedes',37),(723,'Roxas',37),(724,'San Agustin',37),(725,'San Guillermo',37),(726,'San Isidro',37),(727,'San Manuel',37),(728,'San Mariano',37),(729,'San Mateo',37),(730,'San Pablo',37),(731,'Santa Maria',37),(732,'Santo Tomas',37),(733,'Tumauini',37),(734,'Tabuk',38),(735,'Balbalan',38),(736,'Lubuagan',38),(737,'Pasil',38),(738,'Pinukpuk',38),(739,'Rizal',38),(740,'Tanudan',38),(741,'Tinglayan',38),(742,'San Fernando City',39),(743,'Agoo',39),(744,'Aringay',39),(745,'Bacnotan',39),(746,'Bagulin',39),(747,'Balaoan',39),(748,'Bangar',39),(749,'Bauang',39),(750,'Burgos',39),(751,'Caba',39),(752,'Luna',39),(753,'Naguilian',39),(754,'Pugo',39),(755,'Rosario',39),(756,'San Gabriel',39),(757,'San Juan',39),(758,'Santo Tomas',39),(759,'Santol',39),(760,'Sudipen',39),(761,'Tubao',39),(762,'Biñan City',40),(763,'Calamba City',40),(764,'San Pablo City',40),(765,'Santa Rosa City',40),(766,'Alaminos',40),(767,'Bay',40),(768,'Cabuyao',40),(769,'Calauan',40),(770,'Cavinti',40),(771,'Famy',40),(772,'Kalayaan',40),(773,'Liliw',40),(774,'Los Baños',40),(775,'Luisiana',40),(776,'Lumban',40),(777,'Mabitac',40),(778,'Magdalena',40),(779,'Majayjay',40),(780,'Nagcarlan',40),(781,'Paete',40),(782,'Pagsanjan',40),(783,'Pakil',40),(784,'Pangil',40),(785,'Pila',40),(786,'Rizal',40),(787,'San Pedro',40),(788,'Santa Cruz',40),(789,'Santa Maria',40),(790,'Siniloan',40),(791,'Victoria',40),(792,'Iligan City',41),(793,'Bacolod',41),(794,'Baloi',41),(795,'Baroy',41),(796,'Kapatagan',41),(797,'Kauswagan',41),(798,'Kolambugan',41),(799,'Lala',41),(800,'Linamon',41),(801,'Magsaysay',41),(802,'Maigo',41),(803,'Matungao',41),(804,'Munai',41),(805,'Nunungan',41),(806,'Pantao Ragat',41),(807,'Pantar',41),(808,'Poona Piagapo',41),(809,'Salvador',41),(810,'Sapad',41),(811,'Sultan Naga Dimaporo',41),(812,'Tagoloan',41),(813,'Tangcal',41),(814,'Tubod',41),(815,'Marawi City',42),(816,'Bacolod-Kalawi',42),(817,'Balabagan',42),(818,'Balindong',42),(819,'Bayang',42),(820,'Binidayan',42),(821,'Buadiposo-Buntong',42),(822,'Bubong',42),(823,'Bumbaran',42),(824,'Butig',42),(825,'Calanogas',42),(826,'Ditsaan-Ramain',42),(827,'Ganassi',42),(828,'Kapai',42),(829,'Kapatagan',42),(830,'Lumba-Bayabao',42),(831,'Lumbaca-Unayan',42),(832,'Lumbatan',42),(833,'Lumbayanague',42),(834,'Madalum',42),(835,'Madamba',42),(836,'Maguing',42),(837,'Malabang',42),(838,'Marantao',42),(839,'Marogong',42),(840,'Masiu',42),(841,'Mulondo',42),(842,'Pagayawan',42),(843,'Piagapo',42),(844,'Poona Bayabao',42),(845,'Pualas',42),(846,'Saguiaran',42),(847,'Sultan Dumalondong',42),(848,'Picong',42),(849,'Tagoloan II',42),(850,'Tamparan',42),(851,'Taraka',42),(852,'Tubaran',42),(853,'Tugaya',42),(854,'Wao',42),(855,'Ormoc City',43),(856,'Tacloban City',43),(857,'Abuyog',43),(858,'Alangalang',43),(859,'Albuera',43),(860,'Babatngon',43),(861,'Barugo',43),(862,'Bato',43),(863,'Baybay',43),(864,'Burauen',43),(865,'Calubian',43),(866,'Capoocan',43),(867,'Carigara',43),(868,'Dagami',43),(869,'Dulag',43),(870,'Hilongos',43),(871,'Hindang',43),(872,'Inopacan',43),(873,'Isabel',43),(874,'Jaro',43),(875,'Javier',43),(876,'Julita',43),(877,'Kananga',43),(878,'La Paz',43),(879,'Leyte',43),(880,'Liloan',43),(881,'MacArthur',43),(882,'Mahaplag',43),(883,'Matag-ob',43),(884,'Matalom',43),(885,'Mayorga',43),(886,'Merida',43),(887,'Palo',43),(888,'Palompon',43),(889,'Pastrana',43),(890,'San Isidro',43),(891,'San Miguel',43),(892,'Santa Fe',43),(893,'Sogod',43),(894,'Tabango',43),(895,'Tabontabon',43),(896,'Tanauan',43),(897,'Tolosa',43),(898,'Tunga',43),(899,'Villaba',43),(900,'Cotabato City',44),(901,'Ampatuan',44),(902,'Barira',44),(903,'Buldon',44),(904,'Buluan',44),(905,'Datu Abdullah Sangki',44),(906,'Datu Anggal Midtimbang',44),(907,'Datu Blah T. Sinsuat',44),(908,'Datu Hoffer Ampatuan',44),(909,'Datu Montawal',44),(910,'Datu Odin Sinsuat',44),(911,'Datu Paglas',44),(912,'Datu Piang',44),(913,'Datu Salibo',44),(914,'Datu Saudi-Ampatuan',44),(915,'Datu Unsay',44),(916,'General Salipada K. Pendatun',44),(917,'Guindulungan',44),(918,'Kabuntalan',44),(919,'Mamasapano',44),(920,'Mangudadatu',44),(921,'Matanog',44),(922,'Northern Kabuntalan',44),(923,'Pagalungan',44),(924,'Paglat',44),(925,'Pandag',44),(926,'Parang',44),(927,'Rajah Buayan',44),(928,'Shariff Aguak',44),(929,'Shariff Saydona Mustapha',44),(930,'South Upi',44),(931,'Sultan Kudarat',44),(932,'Sultan Mastura',44),(933,'Sultan sa Barongis',44),(934,'Talayan',44),(935,'Talitay',44),(936,'Upi',44),(937,'Boac',45),(938,'Buenavista',45),(939,'Gasan',45),(940,'Mogpog',45),(941,'Santa Cruz',45),(942,'Torrijos',45),(943,'Masbate City',46),(944,'Aroroy',46),(945,'Baleno',46),(946,'Balud',46),(947,'Batuan',46),(948,'Cataingan',46),(949,'Cawayan',46),(950,'Claveria',46),(951,'Dimasalang',46),(952,'Esperanza',46),(953,'Mandaon',46),(954,'Milagros',46),(955,'Mobo',46),(956,'Monreal',46),(957,'Palanas',46),(958,'Pio V. Corpuz',46),(959,'Placer',46),(960,'San Fernando',46),(961,'San Jacinto',46),(962,'San Pascual',46),(963,'Uson',46),(964,'Caloocan',47),(965,'Las Piñas',47),(966,'Makati',47),(967,'Malabon',47),(968,'Mandaluyong',47),(969,'Manila',47),(970,'Marikina',47),(971,'Muntinlupa',47),(972,'Navotas',47),(973,'Parañaque',47),(974,'Pasay',47),(975,'Pasig',47),(976,'Quezon City',47),(977,'San Juan City',47),(978,'Taguig',47),(979,'Valenzuela City',47),(980,'Pateros',47),(981,'Oroquieta City',48),(982,'Ozamiz City',48),(983,'Tangub City',48),(984,'Aloran',48),(985,'Baliangao',48),(986,'Bonifacio',48),(987,'Calamba',48),(988,'Clarin',48),(989,'Concepcion',48),(990,'Don Victoriano Chiongbian',48),(991,'Jimenez',48),(992,'Lopez Jaena',48),(993,'Panaon',48),(994,'Plaridel',48),(995,'Sapang Dalaga',48),(996,'Sinacaban',48),(997,'Tudela',48),(998,'Cagayan de Oro',49),(999,'Gingoog City',49),(1000,'Alubijid',49),(1001,'Balingasag',49),(1002,'Balingoan',49),(1003,'Binuangan',49),(1004,'Claveria',49),(1005,'El Salvador',49),(1006,'Gitagum',49),(1007,'Initao',49),(1008,'Jasaan',49),(1009,'Kinoguitan',49),(1010,'Lagonglong',49),(1011,'Laguindingan',49),(1012,'Libertad',49),(1013,'Lugait',49),(1014,'Magsaysay',49),(1015,'Manticao',49),(1016,'Medina',49),(1017,'Naawan',49),(1018,'Opol',49),(1019,'Salay',49),(1020,'Sugbongcogon',49),(1021,'Tagoloan',49),(1022,'Talisayan',49),(1023,'Villanueva',49),(1024,'Barlig',50),(1025,'Bauko',50),(1026,'Besao',50),(1027,'Bontoc',50),(1028,'Natonin',50),(1029,'Paracelis',50),(1030,'Sabangan',50),(1031,'Sadanga',50),(1032,'Sagada',50),(1033,'Tadian',50),(1034,'Bacolod City',51),(1035,'Bago City',51),(1036,'Cadiz City',51),(1037,'Escalante City',51),(1038,'Himamaylan City',51),(1039,'Kabankalan City',51),(1040,'La Carlota City',51),(1041,'Sagay City',51),(1042,'San Carlos City',51),(1043,'Silay City',51),(1044,'Sipalay City',51),(1045,'Talisay City',51),(1046,'Victorias City',51),(1047,'Binalbagan',51),(1048,'Calatrava',51),(1049,'Candoni',51),(1050,'Cauayan',51),(1051,'Enrique B. Magalona',51),(1052,'Hinigaran',51),(1053,'Hinoba-an',51),(1054,'Ilog',51),(1055,'Isabela',51),(1056,'La Castellana',51),(1057,'Manapla',51),(1058,'Moises Padilla',51),(1059,'Murcia',51),(1060,'Pontevedra',51),(1061,'Pulupandan',51),(1062,'Salvador Benedicto',51),(1063,'San Enrique',51),(1064,'Toboso',51),(1065,'Valladolid',51),(1066,'Bais City',52),(1067,'Bayawan City',52),(1068,'Canlaon City',52),(1069,'Guihulngan City',52),(1070,'Dumaguete City',52),(1071,'Tanjay City',52),(1072,'Amlan',52),(1073,'Ayungon',52),(1074,'Bacong',52),(1075,'Basay',52),(1076,'Bindoy',52),(1077,'Dauin',52),(1078,'Jimalalud',52),(1079,'La Libertad',52),(1080,'Mabinay',52),(1081,'Manjuyod',52),(1082,'Pamplona',52),(1083,'San Jose',52),(1084,'Santa Catalina',52),(1085,'Siaton',52),(1086,'Sibulan',52),(1087,'Tayasan',52),(1088,'Valencia',52),(1089,'Vallehermoso',52),(1090,'Zamboanguita',52),(1091,'Allen',53),(1092,'Biri',53),(1093,'Bobon',53),(1094,'Capul',53),(1095,'Catarman',53),(1096,'Catubig',53),(1097,'Gamay',53),(1098,'Laoang',53),(1099,'Lapinig',53),(1100,'Las Navas',53),(1101,'Lavezares',53),(1102,'Lope de Vega',53),(1103,'Mapanas',53),(1104,'Mondragon',53),(1105,'Palapag',53),(1106,'Pambujan',53),(1107,'Rosario',53),(1108,'San Antonio',53),(1109,'San Isidro',53),(1110,'San Jose',53),(1111,'San Roque',53),(1112,'San Vicente',53),(1113,'Silvino Lobos',53),(1114,'Victoria',53),(1115,'Cabanatuan City',54),(1116,'Gapan City',54),(1117,'Science City of Muñoz',54),(1118,'Palayan City',54),(1119,'San Jose City',54),(1120,'Aliaga',54),(1121,'Bongabon',54),(1122,'Cabiao',54),(1123,'Carranglan',54),(1124,'Cuyapo',54),(1125,'Gabaldon',54),(1126,'General Mamerto Natividad',54),(1127,'General Tinio',54),(1128,'Guimba',54),(1129,'Jaen',54),(1130,'Laur',54),(1131,'Licab',54),(1132,'Llanera',54),(1133,'Lupao',54),(1134,'Nampicuan',54),(1135,'Pantabangan',54),(1136,'Peñaranda',54),(1137,'Quezon',54),(1138,'Rizal',54),(1139,'San Antonio',54),(1140,'San Isidro',54),(1141,'San Leonardo',54),(1142,'Santa Rosa',54),(1143,'Santo Domingo',54),(1144,'Talavera',54),(1145,'Talugtug',54),(1146,'Zaragoza',54),(1147,'Alfonso Castaneda',55),(1148,'Ambaguio',55),(1149,'Aritao',55),(1150,'Bagabag',55),(1151,'Bambang',55),(1152,'Bayombong',55),(1153,'Diadi',55),(1154,'Dupax del Norte',55),(1155,'Dupax del Sur',55),(1156,'Kasibu',55),(1157,'Kayapa',55),(1158,'Quezon',55),(1159,'Santa Fe',55),(1160,'Solano',55),(1161,'Villaverde',55),(1162,'Abra de Ilog',56),(1163,'Calintaan',56),(1164,'Looc',56),(1165,'Lubang',56),(1166,'Magsaysay',56),(1167,'Mamburao',56),(1168,'Paluan',56),(1169,'Rizal',56),(1170,'Sablayan',56),(1171,'San Jose',56),(1172,'Santa Cruz',56),(1173,'Calapan City',57),(1174,'Baco',57),(1175,'Bansud',57),(1176,'Bongabong',57),(1177,'Bulalacao',57),(1178,'Gloria',57),(1179,'Mansalay',57),(1180,'Naujan',57),(1181,'Pinamalayan',57),(1182,'Pola',57),(1183,'Puerto Galera',57),(1184,'Roxas',57),(1185,'San Teodoro',57),(1186,'Socorro',57),(1187,'Victoria',57),(1188,'Puerto Princesa City',58),(1189,'Aborlan',58),(1190,'Agutaya',58),(1191,'Araceli',58),(1192,'Balabac',58),(1193,'Bataraza',58),(1194,'Brooke\'s Point',58),(1195,'Busuanga',58),(1196,'Cagayancillo',58),(1197,'Coron',58),(1198,'Culion',58),(1199,'Cuyo',58),(1200,'Dumaran',58),(1201,'El Nido',58),(1202,'Kalayaan',58),(1203,'Linapacan',58),(1204,'Magsaysay',58),(1205,'Narra',58),(1206,'Quezon',58),(1207,'Rizal',58),(1208,'Roxas',58),(1209,'San Vicente',58),(1210,'Sofronio Española',58),(1211,'Taytay',58),(1212,'Angeles City',59),(1213,'City of San Fernando',59),(1214,'Apalit',59),(1215,'Arayat',59),(1216,'Bacolor',59),(1217,'Candaba',59),(1218,'Floridablanca',59),(1219,'Guagua',59),(1220,'Lubao',59),(1221,'Mabalacat',59),(1222,'Macabebe',59),(1223,'Magalang',59),(1224,'Masantol',59),(1225,'Mexico',59),(1226,'Minalin',59),(1227,'Porac',59),(1228,'San Luis',59),(1229,'San Simon',59),(1230,'Santa Ana',59),(1231,'Santa Rita',59),(1232,'Santo Tomas',59),(1233,'Sasmuan',59),(1234,'Alaminos City',60),(1235,'Dagupan City',60),(1236,'San Carlos City',60),(1237,'Urdaneta City',60),(1238,'Agno',60),(1239,'Aguilar',60),(1240,'Alcala',60),(1241,'Anda',60),(1242,'Asingan',60),(1243,'Balungao',60),(1244,'Bani',60),(1245,'Basista',60),(1246,'Bautista',60),(1247,'Bayambang',60),(1248,'Binalonan',60),(1249,'Binmaley',60),(1250,'Bolinao',60),(1251,'Bugallon',60),(1252,'Burgos',60),(1253,'Calasiao',60),(1254,'Dasol',60),(1255,'Infanta',60),(1256,'Labrador',60),(1257,'Laoac',60),(1258,'Lingayen',60),(1259,'Mabini',60),(1260,'Malasiqui',60),(1261,'Manaoag',60),(1262,'Mangaldan',60),(1263,'Mangatarem',60),(1264,'Mapandan',60),(1265,'Natividad',60),(1266,'Pozzorubio',60),(1267,'Rosales',60),(1268,'San Fabian',60),(1269,'San Jacinto',60),(1270,'San Manuel',60),(1271,'San Nicolas',60),(1272,'San Quintin',60),(1273,'Santa Barbara',60),(1274,'Santa Maria',60),(1275,'Santo Tomas',60),(1276,'Sison',60),(1277,'Sual',60),(1278,'Tayug',60),(1279,'Umingan',60),(1280,'Urbiztondo',60),(1281,'Villasis',60),(1282,'Lucena City',61),(1283,'Tayabas City',61),(1284,'Agdangan',61),(1285,'Alabat',61),(1286,'Atimonan',61),(1287,'Buenavista',61),(1288,'Burdeos',61),(1289,'Calauag',61),(1290,'Candelaria',61),(1291,'Catanauan',61),(1292,'Dolores',61),(1293,'General Luna',61),(1294,'General Nakar',61),(1295,'Guinayangan',61),(1296,'Gumaca',61),(1297,'Infanta',61),(1298,'Jomalig',61),(1299,'Lopez',61),(1300,'Lucban',61),(1301,'Macalelon',61),(1302,'Mauban',61),(1303,'Mulanay',61),(1304,'Padre Burgos',61),(1305,'Pagbilao',61),(1306,'Panukulan',61),(1307,'Patnanungan',61),(1308,'Perez',61),(1309,'Pitogo',61),(1310,'Plaridel',61),(1311,'Polillo',61),(1312,'Quezon',61),(1313,'Real',61),(1314,'Sampaloc',61),(1315,'San Andres',61),(1316,'San Antonio',61),(1317,'San Francisco',61),(1318,'San Narciso',61),(1319,'Sariaya',61),(1320,'Tagkawayan',61),(1321,'Tiaong',61),(1322,'Unisan',61),(1323,'Aglipay',62),(1324,'Cabarroguis',62),(1325,'Diffun',62),(1326,'Maddela',62),(1327,'Nagtipunan',62),(1328,'Saguday',62),(1329,'Antipolo City',63),(1330,'Angono',63),(1331,'Baras',63),(1332,'Binangonan',63),(1333,'Cainta',63),(1334,'Cardona',63),(1335,'Jalajala',63),(1336,'Morong',63),(1337,'Pililla',63),(1338,'Rodriguez',63),(1339,'San Mateo',63),(1340,'Tanay',63),(1341,'Taytay',63),(1342,'Teresa',63),(1343,'Alcantara',64),(1344,'Banton',64),(1345,'Cajidiocan',64),(1346,'Calatrava',64),(1347,'Concepcion',64),(1348,'Corcuera',64),(1349,'Ferrol',64),(1350,'Looc',64),(1351,'Magdiwang',64),(1352,'Odiongan',64),(1353,'Romblon',64),(1354,'San Agustin',64),(1355,'San Andres',64),(1356,'San Fernando',64),(1357,'San Jose',64),(1358,'Santa Fe',64),(1359,'Santa Maria',64),(1360,'Calbayog City',65),(1361,'Catbalogan City',65),(1362,'Almagro',65),(1363,'Basey',65),(1364,'Calbiga',65),(1365,'Daram',65),(1366,'Gandara',65),(1367,'Hinabangan',65),(1368,'Jiabong',65),(1369,'Marabut',65),(1370,'Matuguinao',65),(1371,'Motiong',65),(1372,'Pagsanghan',65),(1373,'Paranas',65),(1374,'Pinabacdao',65),(1375,'San Jorge',65),(1376,'San Jose De Buan',65),(1377,'San Sebastian',65),(1378,'Santa Margarita',65),(1379,'Santa Rita',65),(1380,'Santo Niño',65),(1381,'Tagapul-an',65),(1382,'Talalora',65),(1383,'Tarangnan',65),(1384,'Villareal',65),(1385,'Zumarraga',65),(1386,'Alabel',66),(1387,'Glan',66),(1388,'Kiamba',66),(1389,'Maasim',66),(1390,'Maitum',66),(1391,'Malapatan',66),(1392,'Malungon',66),(1393,'Enrique Villanueva',67),(1394,'Larena',67),(1395,'Lazi',67),(1396,'Maria',67),(1397,'San Juan',67),(1398,'Siquijor',67),(1399,'Sorsogon City',68),(1400,'Barcelona',68),(1401,'Bulan',68),(1402,'Bulusan',68),(1403,'Casiguran',68),(1404,'Castilla',68),(1405,'Donsol',68),(1406,'Gubat',68),(1407,'Irosin',68),(1408,'Juban',68),(1409,'Magallanes',68),(1410,'Matnog',68),(1411,'Pilar',68),(1412,'Prieto Diaz',68),(1413,'Santa Magdalena',68),(1414,'General Santos City',69),(1415,'Koronadal City',69),(1416,'Banga',69),(1417,'Lake Sebu',69),(1418,'Norala',69),(1419,'Polomolok',69),(1420,'Santo Niño',69),(1421,'Surallah',69),(1422,'T\'boli',69),(1423,'Tampakan',69),(1424,'Tantangan',69),(1425,'Tupi',69),(1426,'Maasin City',70),(1427,'Anahawan',70),(1428,'Bontoc',70),(1429,'Hinunangan',70),(1430,'Hinundayan',70),(1431,'Libagon',70),(1432,'Liloan',70),(1433,'Limasawa',70),(1434,'Macrohon',70),(1435,'Malitbog',70),(1436,'Padre Burgos',70),(1437,'Pintuyan',70),(1438,'Saint Bernard',70),(1439,'San Francisco',70),(1440,'San Juan',70),(1441,'San Ricardo',70),(1442,'Silago',70),(1443,'Sogod',70),(1444,'Tomas Oppus',70),(1445,'Tacurong City',71),(1446,'Bagumbayan',71),(1447,'Columbio',71),(1448,'Esperanza',71),(1449,'Isulan',71),(1450,'Kalamansig',71),(1451,'Lambayong',71),(1452,'Lebak',71),(1453,'Lutayan',71),(1454,'Palimbang',71),(1455,'President Quirino',71),(1456,'Senator Ninoy Aquino',71),(1457,'Banguingui',72),(1458,'Hadji Panglima Tahil',72),(1459,'Indanan',72),(1460,'Jolo',72),(1461,'Kalingalan Caluang',72),(1462,'Lugus',72),(1463,'Luuk',72),(1464,'Maimbung',72),(1465,'Old Panamao',72),(1466,'Omar',72),(1467,'Pandami',72),(1468,'Panglima Estino',72),(1469,'Pangutaran',72),(1470,'Parang',72),(1471,'Pata',72),(1472,'Patikul',72),(1473,'Siasi',72),(1474,'Talipao',72),(1475,'Tapul',72),(1476,'Surigao City',73),(1477,'Alegria',73),(1478,'Bacuag',73),(1479,'Basilisa',73),(1480,'Burgos',73),(1481,'Cagdianao',73),(1482,'Claver',73),(1483,'Dapa',73),(1484,'Del Carmen',73),(1485,'Dinagat',73),(1486,'General Luna',73),(1487,'Gigaquit',73),(1488,'Libjo',73),(1489,'Loreto',73),(1490,'Mainit',73),(1491,'Malimono',73),(1492,'Pilar',73),(1493,'Placer',73),(1494,'San Benito',73),(1495,'San Francisco',73),(1496,'San Isidro',73),(1497,'San Jose',73),(1498,'Santa Monica',73),(1499,'Sison',73),(1500,'Socorro',73),(1501,'Tagana-an',73),(1502,'Tubajon',73),(1503,'Tubod',73),(1504,'Bislig City',74),(1505,'Tandag City',74),(1506,'Barobo',74),(1507,'Bayabas',74),(1508,'Cagwait',74),(1509,'Cantilan',74),(1510,'Carmen',74),(1511,'Carrascal',74),(1512,'Cortes',74),(1513,'Hinatuan',74),(1514,'Lanuza',74),(1515,'Lianga',74),(1516,'Lingig',74),(1517,'Madrid',74),(1518,'Marihatag',74),(1519,'San Agustin',74),(1520,'San Miguel',74),(1521,'Tagbina',74),(1522,'Tago',74),(1523,'Tarlac City',75),(1524,'Anao',75),(1525,'Bamban',75),(1526,'Camiling',75),(1527,'Capas',75),(1528,'Concepcion',75),(1529,'Gerona',75),(1530,'La Paz',75),(1531,'Mayantoc',75),(1532,'Moncada',75),(1533,'Paniqui',75),(1534,'Pura',75),(1535,'Ramos',75),(1536,'San Clemente',75),(1537,'San Jose',75),(1538,'San Manuel',75),(1539,'Santa Ignacia',75),(1540,'Victoria',75),(1541,'Bongao',76),(1542,'Languyan',76),(1543,'Mapun',76),(1544,'Panglima Sugala',76),(1545,'Sapa-Sapa',76),(1546,'Sibutu',76),(1547,'Simunul',76),(1548,'Sitangkai',76),(1549,'South Ubian',76),(1550,'Tandubas',76),(1551,'Turtle Islands',76),(1552,'Olongapo City',77),(1553,'Botolan',77),(1554,'Cabangan',77),(1555,'Candelaria',77),(1556,'Castillejos',77),(1557,'Iba',77),(1558,'Masinloc',77),(1559,'Palauig',77),(1560,'San Antonio',77),(1561,'San Felipe',77),(1562,'San Marcelino',77),(1563,'San Narciso',77),(1564,'Santa Cruz',77),(1565,'Subic',77),(1566,'Dapitan City',78),(1567,'Dipolog City',78),(1568,'Bacungan',78),(1569,'Baliguian',78),(1570,'Godod',78),(1571,'Gutalac',78),(1572,'Jose Dalman',78),(1573,'Kalawit',78),(1574,'Katipunan',78),(1575,'La Libertad',78),(1576,'Labason',78),(1577,'Liloy',78),(1578,'Manukan',78),(1579,'Mutia',78),(1580,'Piñan',78),(1581,'Polanco',78),(1582,'President Manuel A. Roxas',78),(1583,'Rizal',78),(1584,'Salug',78),(1585,'Sergio Osmeña Sr.',78),(1586,'Siayan',78),(1587,'Sibuco',78),(1588,'Sibutad',78),(1589,'Sindangan',78),(1590,'Siocon',78),(1591,'Sirawai',78),(1592,'Tampilisan',78),(1593,'Pagadian City',79),(1594,'Zamboanga City',79),(1595,'Aurora',79),(1596,'Bayog',79),(1597,'Dimataling',79),(1598,'Dinas',79),(1599,'Dumalinao',79),(1600,'Dumingag',79),(1601,'Guipos',79),(1602,'Josefina',79),(1603,'Kumalarang',79),(1604,'Labangan',79),(1605,'Lakewood',79),(1606,'Lapuyan',79),(1607,'Mahayag',79),(1608,'Margosatubig',79),(1609,'Midsalip',79),(1610,'Molave',79),(1611,'Pitogo',79),(1612,'Ramon Magsaysay',79),(1613,'San Miguel',79),(1614,'San Pablo',79),(1615,'Sominot',79),(1616,'Tabina',79),(1617,'Tambulig',79),(1618,'Tigbao',79),(1619,'Tukuran',79),(1620,'Vincenzo A. Sagun',79),(1621,'Alicia',80),(1622,'Buug',80),(1623,'Diplahan',80),(1624,'Imelda',80),(1625,'Ipil',80),(1626,'Kabasalan',80),(1627,'Mabuhay',80),(1628,'Malangas',80),(1629,'Naga',80),(1630,'Olutanga',80),(1631,'Payao',80),(1632,'Roseller Lim',80),(1633,'Siay',80),(1634,'Talusan',80),(1635,'Titay',80),(1636,'Tungawan',80);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `job_categories_id` int(11) DEFAULT NULL,
  `cities_id` int(11) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_companies_users1_idx` (`users_id`),
  KEY `fk_companies_cities1_idx` (`cities_id`),
  KEY `fk_companies_job_categories1_idx` (`job_categories_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,1,'photo_up','editing studio',2,100,'AC cortes Ave.','123789'),(2,2,'photo_up','editing studio',2,100,'AC cortes Ave.','123789'),(3,3,'photo_up','editing studio',3,50,'AC cortes Ave.','123789'),(4,4,'photo_up','editing studio',NULL,NULL,'AC cortes Ave.','123789'),(5,8,'Bohol Tropics','he',5,224,'asdf','asdfa');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `education_types`
--

DROP TABLE IF EXISTS `education_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `education_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education_types`
--

LOCK TABLES `education_types` WRITE;
/*!40000 ALTER TABLE `education_types` DISABLE KEYS */;
INSERT INTO `education_types` VALUES (1,'Pre'),(2,'Primary'),(3,'Secondary'),(4,'College'),(5,'Vocational');
/*!40000 ALTER TABLE `education_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `educations`
--

DROP TABLE IF EXISTS `educations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `education_types_id` int(11) DEFAULT NULL,
  `course` varchar(250) DEFAULT NULL,
  `school` varchar(250) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `cities_id` int(11) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `achievements` text,
  PRIMARY KEY (`id`),
  KEY `fk_educations_users1_idx` (`users_id`),
  KEY `fk_educations_education_types1_idx` (`education_types_id`),
  KEY `fk_educations_cities1_idx` (`cities_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `educations`
--

LOCK TABLES `educations` WRITE;
/*!40000 ALTER TABLE `educations` DISABLE KEYS */;
INSERT INTO `educations` VALUES (1,3,2,'Nut','Malayan','1998-01-01','2000-01-01',50,'Talisay Tabunok','achievements pagka gagmay ug grado'),(2,1,1,'N/A','UCLM','1990-12-01','1995-12-01',100,'Talisay City','Aw naa diay'),(3,1,2,'Nut','Malayan','1998-01-01','2000-01-01',50,'Talisay Tabunok','achievements');
/*!40000 ALTER TABLE `educations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` text,
  `name` varchar(250) DEFAULT NULL,
  `size` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (1,'location','ramon','5000','kita','2016-10-19 01:40:15'),(2,'japan','files_name_5806d5c679d69','591','mo ako','2016-10-19 02:09:10'),(3,'japan','files_name_5806d5c8cd0de','591','mo ako','2016-10-19 02:09:12'),(4,'japan','files_name_5806d5eb0ee69','591','mo ako','2016-10-19 02:09:47'),(5,'japan','files_name_5806d678a8d0f','591','mo ako','2016-10-19 02:12:08'),(6,'japan','files_name_580892510dcd5','591','mo ako','2016-10-20 09:45:53'),(7,'japan','files_name_58089254b3826','591','mo ako','2016-10-20 09:45:56'),(8,'japan','files_name_5808926b0c317','591','mo ako','2016-10-20 09:46:19'),(9,'14/files/580893b60c4d3.jpg','Senator-De-Lima.jpg','139242','image/jpeg','2016-10-20 09:51:50'),(10,'14/files/580893e60ab23.jpg','Senator-De-Lima.jpg','139242','image/jpeg','2016-10-20 09:52:38'),(11,'14/files/580893f3a31e0.jpg','Crying.jpg','123897','image/jpeg','2016-10-20 09:52:51'),(12,'14/files/5809794c94c12.jpg','maxresdefault.jpg','105216','image/jpeg','2016-10-21 02:11:24'),(13,'14/files/58097b6ee7289.jpg','Crying.jpg','123897','image/jpeg','2016-10-21 02:20:30'),(14,'14/files/580994bc04544.jpg','maxresdefault.jpg','105216','image/jpeg','2016-10-21 04:08:28'),(15,'14/files/5811617f02751.jpg','Dou.jpg','66499','image/jpeg','2016-10-27 02:07:59'),(16,'14/files/5811622978469.jpg','14137945_1097051703713484_1173357076_n.jpg','96680','image/jpeg','2016-10-27 02:10:49'),(17,'8/files/58116fe6597bc.jpg','Crying.jpg','123897','image/jpeg','2016-10-27 03:09:26'),(18,'14/files/58117494ac167.jpg','15b080ac1a87c2d5cdd12559dad5f39d.jpg','14377','image/jpeg','2016-10-27 03:29:24'),(19,'14/files/5813102f0241d.jpg','Dou.jpg','66499','image/jpeg','2016-10-28 08:45:35'),(20,'14/files/5813121944f50.jpg','maxresdefault.jpg','105216','image/jpeg','2016-10-28 08:53:45'),(21,'8/files/581800d7decea.jpg','Senator-De-Lima.jpg','139242','image/jpeg','2016-11-01 02:41:27');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_categories`
--

DROP TABLE IF EXISTS `job_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `job_industries_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_job_categories_job_industries1_idx` (`job_industries_id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_categories`
--

LOCK TABLES `job_categories` WRITE;
/*!40000 ALTER TABLE `job_categories` DISABLE KEYS */;
INSERT INTO `job_categories` VALUES (1,'Account Manager',2),(2,'Banking And Finace',2),(3,'Software Engineers',1),(4,'Software Tester',1),(5,'Quality Assurance Engineers',1),(6,'System Administrator',1),(7,'Programmers',1),(8,'Nursing Aid',4),(9,'Driver',5);
/*!40000 ALTER TABLE `job_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_industries`
--

DROP TABLE IF EXISTS `job_industries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_industries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_industries`
--

LOCK TABLES `job_industries` WRITE;
/*!40000 ALTER TABLE `job_industries` DISABLE KEYS */;
INSERT INTO `job_industries` VALUES (1,'Information Technology'),(2,'Commerce'),(3,'Maritime Engineering'),(4,'Medicine'),(5,'Utility');
/*!40000 ALTER TABLE `job_industries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provinces`
--

LOCK TABLES `provinces` WRITE;
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
INSERT INTO `provinces` VALUES (1,'Abra'),(2,'Agusan del Norte'),(3,'Agusan del Sur'),(4,'Aklan'),(5,'Albay'),(6,'Antique'),(7,'Apayao'),(8,'Aurora'),(9,'Basilan'),(10,'Bataan'),(11,'Batanes'),(12,'Batangas'),(13,'Benguet'),(14,'Biliran'),(15,'Bohol'),(16,'Bukidnon'),(17,'Bulacan'),(18,'Cagayan'),(19,'Camarines Norte'),(20,'Camarines Sur'),(21,'Camiguin'),(22,'Capiz'),(23,'Catanduanes'),(24,'Cavite'),(25,'Cebu'),(26,'Compostela Valley'),(27,'Cotabato'),(28,'Davao del Norte'),(29,'Davao del Sur'),(30,'Davao Oriental'),(31,'Eastern Samar'),(32,'Guimaras'),(33,'Ifugao'),(34,'Ilocos Norte'),(35,'Ilocos Sur'),(36,'Iloilo'),(37,'Isabela'),(38,'Kalinga'),(39,'La Union'),(40,'Laguna'),(41,'Lanao del Norte'),(42,'Lanao del Sur'),(43,'Leyte'),(44,'Maguindanao'),(45,'Marinduque'),(46,'Masbate'),(47,'Metro Manila'),(48,'Misamis Occidental'),(49,'Misamis Oriental'),(50,'Mountain Province'),(51,'Negros Occidental'),(52,'Negros Oriental'),(53,'Northern Samar'),(54,'Nueva Ecija'),(55,'Nueva Vizcaya'),(56,'Occidental Mindoro'),(57,'Oriental Mindoro'),(58,'Palawan'),(59,'Pampanga'),(60,'Pangasinan'),(61,'Quezon'),(62,'Quirino'),(63,'Rizal'),(64,'Romblon'),(65,'Samar'),(66,'Sarangani'),(67,'Siquijor'),(68,'Sorsogon'),(69,'South Cotabato'),(70,'Southern Leyte'),(71,'Sultan Kudarat'),(72,'Sulu'),(73,'Surigao del Norte'),(74,'Surigao del Sur'),(75,'Tarlac'),(76,'Tawi-Tawi'),(77,'Zambales'),(78,'Zamboanga del Norte'),(79,'Zamboanga del Sur'),(80,'Zamboanga Sibugay');
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_page_permissions`
--

DROP TABLE IF EXISTS `role_page_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_page_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roles_id` int(11) NOT NULL,
  `pages_id` int(11) NOT NULL,
  `permissions_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_table1_pages1_idx` (`pages_id`),
  KEY `fk_table1_permissions1_idx` (`permissions_id`),
  KEY `fk_table1_roles1_idx` (`roles_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_page_permissions`
--

LOCK TABLES `role_page_permissions` WRITE;
/*!40000 ALTER TABLE `role_page_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_page_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin'),(2,'Moderator'),(3,'Employer'),(4,'Job Seeker');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_file_states`
--

DROP TABLE IF EXISTS `user_file_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_file_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_file_states`
--

LOCK TABLES `user_file_states` WRITE;
/*!40000 ALTER TABLE `user_file_states` DISABLE KEYS */;
INSERT INTO `user_file_states` VALUES (1,'Active'),(2,'Archive');
/*!40000 ALTER TABLE `user_file_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_file_types`
--

DROP TABLE IF EXISTS `user_file_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_file_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_file_types`
--

LOCK TABLES `user_file_types` WRITE;
/*!40000 ALTER TABLE `user_file_types` DISABLE KEYS */;
INSERT INTO `user_file_types` VALUES (1,'Resume'),(2,'Profile Photo'),(3,'Company Logo');
/*!40000 ALTER TABLE `user_file_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_files`
--

DROP TABLE IF EXISTS `user_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `user_file_types_id` int(11) NOT NULL,
  `user_file_states_id` int(11) NOT NULL,
  `files_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_files_users1_idx` (`users_id`),
  KEY `fk_user_files_user_file_types1_idx` (`user_file_types_id`),
  KEY `fk_user_files_user_file_states1_idx` (`user_file_states_id`),
  KEY `fk_user_files_files1_idx` (`files_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_files`
--

LOCK TABLES `user_files` WRITE;
/*!40000 ALTER TABLE `user_files` DISABLE KEYS */;
INSERT INTO `user_files` VALUES (1,1,1,1,1),(2,3,2,2,4),(3,3,3,2,5),(4,3,3,2,6),(5,3,3,2,7),(6,3,3,2,8),(7,14,1,1,9),(8,14,1,1,11),(9,14,1,1,12),(10,14,1,1,13),(11,14,1,1,14),(12,14,1,1,15),(13,14,1,1,16),(14,8,2,1,17),(15,14,2,1,18),(16,14,2,1,19),(17,14,2,1,20),(18,8,2,1,21);
/*!40000 ALTER TABLE `user_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `cities_id` int(11) DEFAULT NULL,
  `address` text,
  `birth_date` date DEFAULT NULL,
  `achievements` text,
  PRIMARY KEY (`id`,`users_id`),
  KEY `fk_user_profiles_users1_idx` (`users_id`),
  KEY `fk_user_profiles_cities1_idx` (`cities_id`),
  FULLTEXT KEY `first_name` (`first_name`),
  FULLTEXT KEY `last_name` (`last_name`),
  FULLTEXT KEY `address` (`address`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
INSERT INTO `user_profiles` VALUES (1,1,'ramon','abar',NULL,NULL,NULL,NULL),(2,2,'ramon','abar',NULL,NULL,NULL,NULL),(3,3,'Ramonito','Abarquez',NULL,NULL,NULL,NULL),(4,4,'Eugene','Abao',NULL,NULL,NULL,NULL),(5,5,'Ramonito','Abarquez',NULL,NULL,NULL,NULL),(6,6,'Christine','Ecote',NULL,NULL,NULL,NULL),(7,7,'Dione','Abarquez',NULL,NULL,NULL,NULL),(8,8,'Gleigh','Abarquez',NULL,NULL,'1992-08-21','House wife'),(9,10,'Jones','Law',NULL,NULL,NULL,NULL),(10,11,'Rob','Clasby',NULL,NULL,NULL,NULL),(11,12,'Eugene-4','Abaao',NULL,NULL,NULL,NULL),(12,13,'jon','jones',NULL,NULL,'1970-01-01',NULL),(13,14,'jonny','Knoks',NULL,NULL,'1970-01-01','mask raider'),(14,15,'wala lang','lang',NULL,NULL,'1970-01-01',NULL),(15,16,'eugene','abao',NULL,NULL,NULL,NULL),(16,17,'ramon-te','ramon-test',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_roles_users1_idx` (`users_id`),
  KEY `fk_user_roles_roles1_idx` (`roles_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,1,1),(2,2,3),(3,3,4),(4,4,3),(5,5,4),(6,6,4),(7,7,2),(8,8,3),(9,10,3),(10,11,2),(11,12,3),(12,13,3),(13,14,4),(14,15,4),(15,16,4),(16,17,3);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_states`
--

DROP TABLE IF EXISTS `user_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_states`
--

LOCK TABLES `user_states` WRITE;
/*!40000 ALTER TABLE `user_states` DISABLE KEYS */;
INSERT INTO `user_states` VALUES (1,'Active'),(2,'Inactive'),(3,'Suspended'),(4,'Deleted'),(5,'Pending Activation');
/*!40000 ALTER TABLE `user_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_work_experieces`
--

DROP TABLE IF EXISTS `user_work_experieces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_work_experieces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `position` varchar(250) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `is_present` int(11) DEFAULT '2',
  `is_primary` int(11) DEFAULT '2',
  `monthly_salary` float DEFAULT NULL,
  `company` varchar(250) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `fk_user_work_experieces_users1_idx` (`users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_work_experieces`
--

LOCK TABLES `user_work_experieces` WRITE;
/*!40000 ALTER TABLE `user_work_experieces` DISABLE KEYS */;
INSERT INTO `user_work_experieces` VALUES (2,2,'Standing',NULL,NULL,2,NULL,20000,'BTP','0'),(18,3,'position_5806e4f4a5b9e',NULL,NULL,2,NULL,20000,'BTP','Bridge Technology Partners'),(4,3,'position_5806e4f4a5b9e',NULL,NULL,2,NULL,20000,'BTP','Bridge Technology Partners'),(5,3,'position_5806e4f4a5b9e',NULL,NULL,2,NULL,20000,'BTP','Bridge Technology Partners'),(6,3,'position_5806e52e28db5',NULL,NULL,2,NULL,20000,'BTP','Bridge Technology Partners'),(7,3,'position_5806e531447bc',NULL,NULL,2,NULL,20000,'BTP','Bridge Technology Partners'),(8,3,'position_5806e5641e135',NULL,NULL,2,NULL,20000,'BTP','Bridge Technology Partners'),(9,3,'position_5806e56562b9b',NULL,NULL,2,NULL,20000,'BTP','Bridge Technology Partners'),(10,3,'position_5806e56599e44',NULL,NULL,2,NULL,20000,'BTP','Bridge Technology Partners'),(11,3,'position_5806e5b1c2e1c',NULL,NULL,2,NULL,0,'BTP','Bridge Technology Partners'),(12,3,'position_5806e5b2dd89a',NULL,NULL,2,NULL,0,'BTP','Bridge Technology Partners'),(13,3,'position_5806e5b30f72c',NULL,NULL,2,NULL,0,'BTP','Bridge Technology Partners'),(14,3,'position_5806e5cf4e826',NULL,NULL,2,NULL,0,'BTP','Bridge Technology Partners'),(15,3,'position_5806e5e7378d3',NULL,NULL,2,NULL,0,'BTP','Bridge Technology Partners'),(16,3,'position_5806e789c5c5f',NULL,NULL,2,NULL,0,'BTP','Bridge Technology Partners'),(19,14,'position_5808297fe2902','2000-01-01','2015-01-01',0,2,0,'BTP','Bridge Technology Partners'),(22,14,'Runner','2003-05-01','2004-03-01',1,1,0,'photo up','ha\r\nha\r\nha'),(23,14,'Lead Developer','2009-09-01','2011-03-01',0,2,0,'Nettrac','lingkod2x'),(24,14,'Plumber','1995-01-01',NULL,1,2,0,'My Papa','');
/*!40000 ALTER TABLE `user_work_experieces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_states_id` int(11) NOT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_users_user_states_idx` (`user_states_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ram@yahoo.com','202cb962ac59075b964b07152d234b70',1,NULL),(2,'ram@gmail.com','202cb962ac59075b964b07152d234b70',1,NULL),(3,'alex.titilah.tayo@bridgetechnologypartners.com','202cb962ac59075b964b07152d234b70',1,NULL),(4,'gleigh1@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',1,NULL),(5,'alex.titilah1@bridgetechnologypartners.com','81dc9bdb52d04dc20036dbd8313ed055',1,NULL),(6,'christine.ecot@gmail.com','81dc9bdb52d04dc20036dbd8313ed055',1,NULL),(7,'dione37@gmail.com','202cb962ac59075b964b07152d234b70',1,NULL),(8,'gleigh3@gmail.com','202cb962ac59075b964b07152d234b70',5,'2015-07-15 05:22:09'),(9,'engineering_test_1@bridgetechnologypartners.c','202cb962ac59075b964b07152d234b70',5,'2015-07-17 01:49:34'),(10,'test_8@bridgetechnologypartners.com','202cb962ac59075b964b07152d234b70',5,'2015-07-17 01:52:24'),(11,'test_3@bridgetechnologypartners.com','81dc9bdb52d04dc20036dbd8313ed055',5,'2015-07-17 01:56:58'),(12,'euabs@gmail.com','c01abe74c44be79ce0bec6f042353064',3,'2015-07-17 02:47:32'),(13,'jon@gmail.com','202cb962ac59075b964b07152d234b70',5,'2016-10-17 02:51:09'),(14,'jon1@gmail.com','202cb962ac59075b964b07152d234b70',1,'2016-10-17 02:54:47'),(15,'eeee@gmail.com','202cb962ac59075b964b07152d234b70',1,'2016-10-18 07:57:21'),(16,'eugene@photoup.net','202cb962ac59075b964b07152d234b70',5,'2016-10-27 08:37:00'),(17,'email','202cb962ac59075b964b07152d234b70',1,'2016-10-28 01:52:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacancies`
--

DROP TABLE IF EXISTS `vacancies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vacancies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `vacancy_states_id` int(11) NOT NULL,
  `job_categories_id` int(11) NOT NULL,
  `cities_id` int(11) NOT NULL,
  `address` text,
  `company` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `salary` varchar(45) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_vacancies_users1_idx` (`users_id`),
  KEY `fk_vacancies_job_categories1_idx` (`job_categories_id`),
  KEY `fk_vacancies_vacancy_states1_idx` (`vacancy_states_id`),
  KEY `fk_vacancies_cities1_idx` (`cities_id`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `description` (`description`),
  FULLTEXT KEY `company` (`company`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacancies`
--

LOCK TABLES `vacancies` WRITE;
/*!40000 ALTER TABLE `vacancies` DISABLE KEYS */;
INSERT INTO `vacancies` VALUES (1,8,1,4,175,'',NULL,'CPA Accounts Manager','Manahi','1000','2015-07-16 03:05:55'),(2,8,1,1,444,'San Roque',NULL,'PHP Developer','Tig hugas plato','10','2015-07-16 04:11:39'),(3,8,1,2,452,'Matotinao',NULL,'Quality Assurance Eng.','Tig testing','1','2015-07-16 04:17:03'),(4,8,1,1,2,'',NULL,'JAVA programer time','Java','10000','2015-07-16 04:35:50'),(5,8,1,1,28,'',NULL,'C# Developmers','C# Developmers','100000','2015-07-16 04:36:22'),(6,8,1,4,107,'',NULL,'Banking And Finance','Time as he grows old teaches many lessons           | 1.3253291845322 |\n| Mr. Watson, come here. I want you!                  |               0 |\n| It is hard for an empty bag to stand upright        |               0 |\n| Little strokes fell great oaks                      |               0 |\n| Remember that time is money                         | 1.3400621414185 |\n| Bell, book, and candle                              |               0 |\n| A soft answer turneth away wrath                    |               0 |\n| Speak softly and carry a big stick                  |               0 |\n| But, soft! what light through yonder window breaks? |               0 |\n| I light my candle from their torches.','10','2015-07-16 05:38:14'),(7,8,1,4,3,'','Clone','CPA','OPlive','45713','2015-07-16 06:04:00'),(8,8,1,1,149,'','Nah','SAP','SAP deleveper','50','2015-07-16 07:01:33'),(9,7,1,3,3,'4',NULL,'Bankcrupt','tie a','8','2015-07-16 07:02:24'),(10,7,1,1,1,'','C Programmer','Prog','fasd','58','2015-07-16 07:13:55'),(11,8,1,3,28,'47','Zylun','Clerk','Wala','58','2015-07-16 07:14:42'),(12,7,1,4,17,'kalonasan','BTP','Sharon','Greater control over multiple-word matching can be obtained by using boolean mode FULLTEXT searches. This type of search is performed by adding IN BOOLEAN MODE after the search string in the','36','2015-07-16 08:47:39'),(13,7,1,1,42,'47','Cali Programmer','Baso nga cali','the dest','41','2015-07-17 00:44:23'),(14,8,1,1,54,'the man the word','USJR','VB6.0','embaded lang','15','2015-07-17 00:48:56'),(15,7,1,1,137,'talisay city','DioneGliegh','Jr. Sonf Eng.','hal na','157','2015-07-17 01:21:17'),(16,7,1,5,457,'Pocb','XYZ','Ding','Tralala','10','2016-10-18 03:31:59'),(17,12,1,5,965,'Makati','Toy','Ragnarok','fasdf','600','2016-10-18 03:33:05'),(18,7,1,8,438,'Mabolo','Cebu Doc','Katabang','Katabang sa Doctor','0','2016-10-18 07:59:58'),(19,8,1,4,224,'asdf','Wew','pital boys','wala lang','200','2016-11-01 02:57:34');
/*!40000 ALTER TABLE `vacancies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacancy_applicant_states`
--

DROP TABLE IF EXISTS `vacancy_applicant_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vacancy_applicant_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacancy_applicant_states`
--

LOCK TABLES `vacancy_applicant_states` WRITE;
/*!40000 ALTER TABLE `vacancy_applicant_states` DISABLE KEYS */;
INSERT INTO `vacancy_applicant_states` VALUES (1,'pending'),(2,'hired'),(3,'rejected'),(4,'in progress');
/*!40000 ALTER TABLE `vacancy_applicant_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacancy_applicants`
--

DROP TABLE IF EXISTS `vacancy_applicants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vacancy_applicants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `vacancies_id` int(11) NOT NULL,
  `vacancy_applicant_states_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vacancy_applicants_users1_idx` (`users_id`),
  KEY `fk_vacancy_applicants_vacancies1_idx` (`vacancies_id`),
  KEY `fk_vacancy_applicants_vacancy_applicant_states1_idx` (`vacancy_applicant_states_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacancy_applicants`
--

LOCK TABLES `vacancy_applicants` WRITE;
/*!40000 ALTER TABLE `vacancy_applicants` DISABLE KEYS */;
INSERT INTO `vacancy_applicants` VALUES (1,14,1,1),(2,14,2,4),(3,3,1,4),(4,14,15,1),(5,14,18,4),(6,14,11,1),(7,14,13,1);
/*!40000 ALTER TABLE `vacancy_applicants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacancy_states`
--

DROP TABLE IF EXISTS `vacancy_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vacancy_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacancy_states`
--

LOCK TABLES `vacancy_states` WRITE;
/*!40000 ALTER TABLE `vacancy_states` DISABLE KEYS */;
INSERT INTO `vacancy_states` VALUES (1,'Pending Approval'),(2,'Approved'),(3,'Expired');
/*!40000 ALTER TABLE `vacancy_states` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-14 16:54:13
