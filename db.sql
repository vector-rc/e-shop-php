DROP Database IF EXISTS `tienda_e5`;

CREATE DATABASE tienda_e5;
USE tienda_e5;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `enable` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;


INSERT INTO `category` VALUES (1,'Sin categoria','',1),(2,'Ropa para niños','',1),(3,'Ropa','prendas de vestir para todo tipo de personas',1),(4,'Laptops','',1),(5,'Smartphones','',1),(6,'Electrodomesticos','',1),(7,'nose','asdas',0),(8,'Componentes para PC','',1),(9,'Teclados gamer','',1),(10,'TVs','',1),(11,'parlantes','',0),(12,'Tecnologia','',1),(13,'Perifericos PC','',1);


DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `date_time` datetime NOT NULL,
  `discount` decimal(8,2) unsigned NOT NULL,
  `subtotal` decimal(8,2) unsigned NOT NULL,
  `total` decimal(8,2) unsigned NOT NULL,
  `state` enum('not_payed','paid_out','delivered') NOT NULL DEFAULT 'not_payed',
  `enable` tinyint(3) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;


INSERT INTO `order` VALUES (17,4,'2021-11-30 08:51:15',0.00,4278.00,4278.00,'paid_out',1),(18,2,'2021-11-30 11:12:50',0.00,320.00,320.00,'paid_out',1),(19,2,'2021-11-30 11:15:19',0.00,1598.00,1598.00,'paid_out',1),(20,2,'2021-12-01 12:03:46',0.00,1689.00,1689.00,'not_payed',1);


DROP TABLE IF EXISTS `ordered_product`;
CREATE TABLE `ordered_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL DEFAULT 1,
  `enable` tinyint(3) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;


INSERT INTO `ordered_product` VALUES (17,11,17,1,1),(18,9,17,1,1),(19,6,18,1,1),(20,7,18,1,1),(21,23,19,2,1),(22,21,20,2,1),(23,23,20,1,1);


DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `state` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `stock` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `enable` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;


INSERT INTO `product` VALUES (1,'Smartphone Xiaomi Redmi Note 8',756.9,'7','smartphone de gama media con 128GB de memoria y 6GB de RAM',10,1,5,'SmartphoneXiaomiRedmiNote81638313988.jpeg',1),(2,'Teclado mecanico gamer Razer A-59',156,'9','teclado gamer con luces led de diferentes colores, mecanico con capacidad de respuesta de 15ms',15,2,8,'TecladomecanicogamerRazerA-591638241820.jpeg',1),(3,'Acer Nitro 5 AN515-55-72GW Intel Core i7-10750H/16GB/512GB SSD/GTX 1650Ti/15.6',3689,'8','Procesador Intel® Core™ i7-10750H 2.6 GHz\r\nMemoria 16 GB DDR4 2933MHz Memory\r\nAlmacenamiento 512GB SSD PCIe NVMe\r\nUnidad óptica NO\r\nDisplay 15.6\" FHD Acer ComfyView IPS LED LCD FHD IPS (1920 x 1080)\r\nControlador gráfico NVIDIA® GeForce® GTX 1650Ti 4G-GDDR6(2C*256*16*4)\r\nConectividad\r\nLAN 10/100/1000\r\nWiFi 6\r\nBluetooth 5\r\nCámara de portátil Sí\r\nMicrófono Sí\r\nBatería 57Wh Ion de litio\r\nConexiones\r\n1 x HDMI\r\n1 x RJ45\r\n1x USB 2.0\r\n2 x USB 3.2 Gen 1 + 1 x USB 3.2 Gen 2 power-off charging + 1 x USB Type-C™ (USB 3.2 Gen 2)\r\n3.5mm combo audio jack\r\nSistema operativo SIN SISTEMA OPERATIVO\r\nDimensiones (Ancho x Profundidad x Altura) 363.4 (W) x 255 (D) x 25.9 (H) mm\r\nPeso 2.3 kg\r\nColor Negro',1,1,4,'15.61638314030.jpeg',1),(4,'IPhone 8 64GB - Gold - A1863',802.5,'9','Pantalla retina HD de 4.7”\r\nCámara principal 4K de 12 MP y frontal FaceTimeHD de 7 MP\r\nChip A11 Bionic de 64 bits/ Coprocesador de movimiento M11\r\nSistema operativo iOS 11\r\nTecnologías 3D Touch y sensor de huellas Touch ID\r\nResistente a salpicaduras, agua y polvo (certificación IP67)\r\nCarga inalámbrica\r\nINCLUYE CARGADOR GENERICO, USB GENERICO, NO AUDIFONOS',2,1,5,'IPhone864GB-Gold-A18631638314113.jpeg',1),(5,'Pantalón Buzo Yamp Gris para Niño',45.3,'9','Composición: 60% Algodón 40% Poliéster\r\nMarca: YAMP\r\nModelo: BSCBUZOX2O\r\nTemporada: Toda temporada\r\nHecho en: China\r\nMaterial principal: Algodón\r\nTipo: Pantalones\r\nGénero: Bebé niño',35,2,2,'PantalónBuzoYampGrisparaNiño1638287346.webp',1),(6,'Licuadora Oster Vaso de Vidrio Boroclass 1.5 Lt BLSTKAGRRD',235,'10','El poderoso motor con alta fuerza de torsión y vaso de vidrio refractario Boroclass® de la licuadora Oster® con control de velocidad tipo perilla son ideales para preparar una amplia variedad de recetas frías y calientes, jugos, batidos y mucho más.\r\nMotor cuatro veces más duradero*\r\nAcople metálico 10 más fuerte**\r\nVaso de vidrio resistente a un choque térmico de 90°C, que te permite procesar ingredientes hirviendo sin necesidad de esperar a que estos se enfríen\r\nPerilla con dos velocidades\r\nCapacidad de 1.5 litros para preparar desde sopas hasta jugos, salsas y bebidas gratinadas con hielo\r\nRevolucionaria cuchilla trituradora de hielo\r\nColor: Rojo*Comparado con el motor del modelo PU5443127-6115-AL en pruebas de carga**Con un nivel de resistencia a la tracción superior comparado con los acoples plásticos',2,4,6,'LicuadoraOsterVasodeVidrioBoroclass1.5LtBLSTKAGRRD1638303136.jpeg',1),(7,'Repetidor Ultra Wifi Movistar Doble Banda Usado',85,'8','Son equipos usados pero 100% operativo ya probados\r\nIncluye el repetidor, fuente de poder y cable amarillo\r\nEstado del producto 8/10 \r\nNo incluye caja ya que es seminuevo usado\r\n\r\nAhora podrás disfrutar de uno de los últimos\r\nestándares de tecnología WiFi y navegar con una\r\nvelocidad de hasta 1.3Gbps sobre el canal de 5GHz\r\ncompatible en 2.4 GHZ.\r\n\r\nPermite experimentar de una conexión súper rápida,\r\ncon excelente WiFi. Es ideal para aplicaciones de uso\r\nintensivo de ancho de banda tales como streaming\r\nde video HD y juegos en línea.',5,4,12,'RepetidorUltraWifiMovistarDobleBandaUsado1638290805.webp',1),(8,'HP IMPRESORA MULTIFUNCIONAL INKTANK 315',699,'6','Por la compra de esta impresora HP, obtén un kit para imprimir y colgar tus recuerdos. Regístrate en www.imprimeloqueamas.com o envía tu boleta y DNI al 933 600 113',150,4,12,'HPIMPRESORAMULTIFUNCIONALINKTANK3151638313877.jpeg',1),(9,'IMPRESORA MULTIFUNCIONAL DCPT220',779,'8','Impresora multifuncional DCPT220 de Brother. Impresión económica de documentos y fotografías. Panel de control fácil de usar. Impresión de alta calidad de hsata 6000 x 1200 dpi',963,2,12,'IMPRESORAMULTIFUNCIONALDCPT2201638287531.jpeg',1),(10,'PARLANTE BLUETOOTH SONY SRS-XB23 NEGRO',299,'10','Parlante inalámbrico con Bluetooth SRS XB23 de Sony. Disfruta de un sonido potente y profundo donde quieras con el parlante EXTRA BASS. Diseño práctico y muy portátil',852,2,13,'PARLANTEBLUETOOTHSONYSRS-XB23NEGRO1638287586.jpeg',1),(11,'TELEVISOR SAMSUNG CRYSTAL UHD 4K ULTRA HD 60',3499,'9','Televisor UN60AU7000GXPE de Samsung. Sumérgete en una experiencia 4K inteligente. Movimiento suave para una imagen clara. Más pantalla, menos bisel',20,2,10,'TELEVISORSAMSUNGCRYSTALUHD4KULTRAHD601638287716.webp',1),(12,'PC ALL IN ONE LENOVO IDEACENTRE AIO 3I INTEL CORE I5 - 10400T 4GB 1TB HDD 128GB SSD 23.8',3599,'8','Nueva Lenovo All in one IdeaCentre AIO 3i 23.8\" Full HD Intel Core i5 4GB 128GB SSD 1TB con Intel UHD Graphics (Integrada) y pantalla Full HD',12,2,12,'PCALLINONELENOVOIDEACENTREAIO3IINTELCOREI5-10400T4GB1TBHDD128GBSSD23.81638312989.jpeg',1),(13,'Camara GOPRO HERO 8 NEGRO CÁMARA DE ACCIÓN',1499,'6','Llévala, úsala, ámala. La GoPro HERO8 Black viene con el estabilizador de imagen HyperSmooth 2.0, pantalla touch y filma video en 4K.',2,2,12,'CamaraGOPROHERO8NEGROCÁMARADEACCIÓN1638313169.jpeg',1),(14,'LAPTOP GAMER ASUS TUF F15 FX506LH-HN002T INTEL CORE I5-10300H DDR4 512GB SSD 15.6\'\'',4559,'8','¡Sorpréndete con la potencia, eficiencia y elegancia de Asus FX506LH-HN002T Ci5 y toma el control! Todo lo que necesitas para disfrutar de la tecnología está a un clic de tus manos en Ripley.com',45,2,4,'LAPTOPGAMERASUSTUFF15FX506LH-HN002TINTELCOREI5-10300HDDR4512GBSSD15.6\'\'1638313272.jpeg',1),(15,'LICUADORA OSTER XPERT 2L 2HP 3 VELOCIDADES BLSTVB-G00',699,'8','Los más deliciosos jugos con Oster',2,1,6,'LICUADORAOSTERXPERT2L2HP3VELOCIDADESBLSTVB-G001638314167.jpeg',1),(16,'OLLA ARROCERA IMACO 4.2L ANTIADHERENTE RC42',256,'10','Olla arrocera de 4.2 litros',10,2,6,'OLLAARROCERAIMACO4.2LANTIADHERENTERC421638314453.jpeg',1),(17,'CAFETERA OSTER BVSTEM6603R PRIMA LATTE ESPRESSO',789,'6','Encuentra en Ripley.com lo último en tecnología al servicio del hogar de Oster. Licuadoras, ollas arroceras, cafeteras y mucho más.',66,2,6,'CAFETERAOSTERBVSTEM6603RPRIMALATTEESPRESSO1638313360.jpeg',1),(18,'IMACO FREIDORA XL AF5514 4.2 L',455,'10','Con la nueva Freidora XL AF5514 de Imaco podrás preparar esos alimentos fritos que tanto te gustan de una manera más saludable. ¡Obtenla con solo un clic!',5,1,6,'IMACOFREIDORAXLAF55144.2L1638314224.jpeg',1),(19,'Tempest Gaming PSU X 750W 80 Plus Bronce Modular',256,'','Tempest nunca deja de sorprender y es que nos trae dentro de su gama de productos la nueva fuente de alimentación Gaming PSU X 850W. Si siempre estás preocupado por los componentes de tu equipo, ahora con este revolucionario modelo podrás sentir como todos tus elementos quedan a salvo.',12,4,8,'TempestGamingPSUX750W80PlusBronceModular1638313910.jpeg',1),(20,'Microsoft Gamepad para Xbox Series Negro Carbón',246,'','Disfruta del diseño modernizado del Mando inalámbrico Xbox: negro carbón, con superficies esculpidas y una geometría refinada para una mayor comodidad durante el juego. Mantén el objetivo con un mando de dirección híbrido y agarre texturizado en los gatillos, botones y funda trasera.',81,4,13,'MicrosoftGamepadparaXboxSeriesNegroCarbón1638313795.jpeg',1),(21,'Corsair Dominator Platinum RGB DDR4 3200 SPD 2666 PC4-25600 16GB 2x8GB CL16',445,'10','La memoria DDR4 CORSAIR DOMINATOR PLATINUM RGB redefine las memorias premium DDR4, con un diseño superior en aluminio, chips de memoria de alta frecuencia estrictamente verificados y 12 LED RGB CAPELLIX de direccionamiento individual y gran intensidad.',30,1,8,'CorsairDominatorPlatinumRGBDDR43200SPD2666PC4-2560016GB2x8GBCL161638314277.jpeg',1),(22,'Zapatillas Converse All Star Usadas, Talla 37, Originales',50,'7','Originales, con señales de uso, pintura retocada especial,no sale...Disponible.. Entrega en La Estación Matellini del Metropolitano en Chorrillos.',1,2,3,'ZapatillasConverseAllStarUsadas,Talla37,Originales1638241774.webp',1),(23,'iPhone 7 32gb Gold 4g Apple Libre Usado + Cable Lightning',799,'8','*iManía*\r\n\r\niPhone 7 32gb Apple\r\n\r\nLibre para todo operador.\r\nEquipo usado en buen estado.\r\n\r\nSe entrega con cable lightning.',1,4,5,'iPhone732gbGold4gAppleLibreUsado+CableLightning1638298383.webp',1);


DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `date_expiration` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `session` VALUES ('17e126bdd1b398832c789236fc2c7bedc2438382d95d2c688aaf0905d0b3676f',5,'jose65@gmail.com','2021-12-02 00:00:00'),('2695aa91f6c8a8b7e050ae8dfee7e1602ac7aa0d4b22aa9e5609e81336321051',2,'yanpol@ymail.com','2021-12-02 00:00:00'),('746b1927176d1b2a8c43997779b6b9428897c845524663d5424b30bcf7185eb3',1,'fer@email.com','2021-12-02 00:00:00'),('aa5a635c069b81b053a975081b252fa046d40771946184916299c853bca4bc8b',4,'migue@gmail.com','2021-12-02 00:00:00'),('f80cf6f5f0187ce4fdf2b22f2e574c48d1202d5e3e90f7ddf07206b9ad341964',6,'Junior123@gmail.com','2021-12-02 00:00:00');


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `names` varchar(100) NOT NULL,
  `surnames` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT 'normal',
  `mobile` varchar(9) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `enable` tinyint(3) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `user` VALUES (1,'Fernando','Rodriguez','fer@email.com','$2y$10$BLJ7AlJlK1mr7otfbIGzi.8azA5eDHo1x/yktGCIS5G/YqHRQBAyO','admin','986458621',NULL,1),(2,'Yanpol ','Sanchez ','yanpol@ymail.com','$2y$10$BLJ7AlJlK1mr7otfbIGzi.8azA5eDHo1x/yktGCIS5G/YqHRQBAyO','Av. Alameda Sur 158','965856325','Yanpol1638247215.jpeg',1),(4,'Miguel Angel','Rufasto','migue@gmail.com','$2y$10$BLJ7AlJlK1mr7otfbIGzi.8azA5eDHo1x/yktGCIS5G/YqHRQBAyO','R. BUENAVENTURA AGUIRRE 398 ( AL FRENTE DEL IPD CDRA 6 SJM )','963258559',NULL,1),(5,'Jose','Rodriguez','jose65@gmail.com','$2y$10$BLJ7AlJlK1mr7otfbIGzi.8azA5eDHo1x/yktGCIS5G/YqHRQBAyO','AV. MIGUEL ANGEL Nº 193A URB. FIORI ( A DOS CUADRAS DE PLAZA NORTE )','965854584',NULL,1),(6,'Walter Junior','Andrade','Junior123@gmail.com','$2y$10$BLJ7AlJlK1mr7otfbIGzi.8azA5eDHo1x/yktGCIS5G/YqHRQBAyO','AV. BRASIL Nº 515 ( A MEDIA CUADRA DEL HOSPITAL DEL NIÑO )','965856328','WalterJunior1638290523.jpeg',1);

