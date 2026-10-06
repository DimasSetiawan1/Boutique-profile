-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: boutique_profile
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping routines for database 'boutique_profile'
--

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'company_name','Boutique Design Indonesia','2026-07-04 00:33:55','2026-07-04 00:33:55'),(2,'address','Jl. persatuan No.5C, RT.2RW.4, Sukabumi Sel., Kec. kebayoran Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota jakarta 11560','2026-07-04 00:33:55','2026-10-05 08:00:56'),(3,'phone','021 1234567','2026-07-04 00:33:55','2026-09-24 16:47:24'),(4,'email','boutiquedesign48@gmail.com','2026-07-04 00:33:55','2026-10-05 13:17:21'),(5,'npwp','70.007.006.3-035.000','2026-07-04 00:33:55','2026-07-04 00:33:55'),(6,'slogan_main_en','When you are thirsty for ideas, when you need something makes you fresh, Boutique Design Indonesia','2026-07-04 00:33:55','2026-10-05 11:06:44'),(7,'slogan_main_id','Ketika Anda haus akan ide, ketika Anda butuh sesuatu yang membuat Anda segar, Boutique Design Indonesia','2026-07-04 00:33:55','2026-10-05 11:06:44'),(8,'slogan_sub_en','grab even bigger ideas with us','2026-07-04 00:33:55','2026-10-05 11:07:07'),(9,'slogan_sub_id','raih ide yang lebih besar bersama kami','2026-07-04 00:33:55','2026-10-05 11:07:07'),(10,'slogan_philosophy_en','Quality is Priority','2026-07-04 00:33:55','2026-09-24 16:47:24'),(11,'slogan_philosophy_id','Kualitas adalah Prioritas','2026-07-04 00:33:55','2026-09-24 16:47:24'),(12,'contact_person_1_name','(Direktur) Enung Kosasih','2026-07-04 00:33:55','2026-09-10 21:18:59'),(13,'contact_person_1_phone','0856 9317 4242','2026-07-04 00:33:55','2026-07-04 00:33:55'),(14,'contact_person_2_name','(Direktur Kreatif) Oleh Wijayana','2026-07-04 00:33:55','2026-09-10 21:18:59'),(15,'contact_person_2_phone','0858 9111 8571','2026-07-04 00:33:55','2026-07-04 00:33:55'),(16,'contact_person_3_name','','2026-07-04 00:33:55','2026-10-05 08:01:05'),(17,'contact_person_3_phone','','2026-07-04 00:33:55','2026-10-05 08:01:05'),(18,'contact_person_4_name','','2026-07-04 00:33:55','2026-09-24 17:07:09'),(19,'contact_person_4_phone','','2026-07-04 00:33:55','2026-09-24 17:07:09'),(20,'instagram_url','https://www.instagram.com/boutiquedesign_indonesia?stkn=a2RnMG51Z2FjZDg0','2026-09-22 11:13:53','2026-09-22 11:13:53'),(21,'philosophy_image','','2026-09-24 10:16:12','2026-09-24 10:16:42'),(22,'philosophy_desc_en','We look at designs not as static layouts, but as complex cognitive connections. Our design philosophy bridges human neurons, emotional body responses, and social problem-solving into a cohesive structural campaign.','2026-09-24 10:16:52','2026-09-24 10:16:52'),(23,'philosophy_desc_id','Kami memandang desain bukan sekadar tata letak statis, melainkan hubungan kognitif yang kompleks. Filosofi desain kami menjembatani neuron manusia, respons emosional tubuh, dan pemecahan masalah sosial ke dalam kampanye struktural yang kohesif.','2026-09-24 10:16:52','2026-09-24 10:16:52'),(24,'direct_contacts','[{\"name\":\"(Direktur) Enung Kosasih\",\"phone\":\"0856 9317 4242\"},{\"name\":\"(Direktur Kreatif) Oleh Wijayana\",\"phone\":\"0858 9111 8571\"}]','2026-09-24 16:47:24','2026-10-05 08:01:05'),(25,'contact_person_5_name','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(26,'contact_person_5_phone','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(27,'contact_person_6_name','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(28,'contact_person_6_phone','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(29,'contact_person_7_name','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(30,'contact_person_7_phone','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(31,'contact_person_8_name','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(32,'contact_person_8_phone','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(33,'contact_person_9_name','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(34,'contact_person_9_phone','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(35,'contact_person_10_name','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(36,'contact_person_10_phone','','2026-09-24 17:07:09','2026-09-24 17:07:09'),(37,'hero_bg_video_url','','2026-10-05 12:15:15','2026-10-05 12:15:15'),(38,'hero_overlay_opacity','34','2026-10-05 12:15:15','2026-10-05 12:37:53'),(39,'hero_overlay_color','light','2026-10-05 12:15:15','2026-10-05 12:15:15'),(40,'hero_bg_type','image','2026-10-05 12:15:15','2026-10-05 12:15:15'),(41,'services_bg_video_url','','2026-10-05 12:15:53','2026-10-05 12:15:53'),(42,'services_overlay_opacity','53','2026-10-05 12:15:53','2026-10-05 12:15:53'),(43,'services_overlay_color','light','2026-10-05 12:15:53','2026-10-05 12:15:53'),(44,'services_bg_type','image','2026-10-05 12:15:53','2026-10-05 12:15:53'),(45,'about_bg_type','image','2026-10-05 12:21:01','2026-10-05 12:21:01'),(46,'about_bg_image','uploads/about-bg.jpg','2026-10-05 12:21:01','2026-10-05 12:21:01'),(47,'about_overlay_opacity','37','2026-10-05 12:21:01','2026-10-05 12:30:47'),(48,'about_overlay_color','light','2026-10-05 12:21:01','2026-10-05 12:21:01'),(49,'about_bg_video_url','','2026-10-05 12:30:47','2026-10-05 12:30:47'),(50,'company_emails','[\"boutiquedesign48@gmail.com\",\"boutique.design@yahoo.co.id\"]','2026-10-05 13:08:00','2026-10-05 13:18:33');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `philosophies`
--

DROP TABLE IF EXISTS `philosophies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `philosophies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `subtitle_en` varchar(255) DEFAULT NULL,
  `subtitle_id` varchar(255) DEFAULT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'bi-lightbulb-fill',
  `image_path` varchar(255) DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `description_id` text DEFAULT NULL,
  `is_highlighted` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `philosophies_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `philosophies`
--

LOCK TABLES `philosophies` WRITE;
/*!40000 ALTER TABLE `philosophies` DISABLE KEYS */;
INSERT INTO `philosophies` VALUES (1,'philosophy','PHILOSOPHY','FILOSOFI','Creative Foundation','Fondasi Pemikiran Kreatif','bi-lightbulb-fill','uploads/philosophy/1789103131_6aa38c1b36bb6.jpg','Our philosophy views design not just as static aesthetics, but as a deep cognitive bridge connecting brand messaging with audience perception.','Filosofi kami memandang desain bukan sekadar estetika visual statis, melainkan jembatan kognitif mendalam yang menyatukan pesan brand dengan persepsi audiens.',0,1,'2026-09-10 21:55:46','2026-09-10 22:05:31'),(2,'collective','Collective','Kolektif','Synergy of Team & Clients','Kekuatan Sinergi Tim & Klien','bi-people-fill','uploads/philosophy/1791206503_6ac3a4679996a.webp','Great ideas are born from collective collaboration. We bring diverse perspectives together to create powerful, market-relevant strategies.','Ide-ide besar lahir dari kolaborasi kolektif. Kami menyatukan perspektif beragam untuk menghasilkan strategi yang kuat dan relevan bagi pasar.',0,2,'2026-09-10 21:55:46','2026-10-05 13:21:43'),(3,'mental','Mental','Mental','Mindset & Creative Agility','Kesiapan & Ketahanan Pola Pikir','bi-heart-pulse-fill','uploads/philosophy/1791262101_6ac47d952c1ff.jpg','Building mental agility to stay receptive to new challenges, future creative trends, and out-of-the-box solutions.','Membangun ketajaman mental untuk selalu terbuka terhadap tantangan baru, tren kreatif masa depan, dan solusi out-of-the-box.',0,3,'2026-09-10 21:55:46','2026-10-06 04:48:21'),(4,'think','Think','Pikir','Analytical & Strategic Thinking','Proses Analitis & Strategis','bi-gear-wide-connected','uploads/philosophy/1791262071_6ac47d7749aaa.jpg','Before executing visuals, we think deeply about business goals, audience personas, and brand differentiation.','Sebelum mengeksekusi visual, kami berpikir secara mendalam mengenai tujuan bisnis, persona target audiens, dan diferensiasi brand Anda.',0,4,'2026-09-10 21:55:46','2026-10-06 04:47:51'),(5,'cognitive','Cognitive','Kognitif','Perception & Memory Response','Respons Persepsi & Memori','bi-cpu-fill','uploads/philosophy/1791262017_6ac47d418e200.jpg','Understanding how audiences capture, process, and retain your message through structured visual hierarchy and brand narrative.','Memahami bagaimana audiens menangkap, memproses, dan mengingat pesan Anda melalui hierarki visual dan narasi brand yang terarah.',0,5,'2026-09-10 21:55:46','2026-10-06 04:46:57'),(6,'mind','MIND','PIKIRAN','Limitless Exploration','Ruang Eksplorasi Tanpa Batas','bi-stars','uploads/philosophy/1791261988_6ac47d244347d.jpg','The mind is the laboratory where wild imagination is distilled into high-impact commercial concepts with real results.','Pikiran adalah laboratorium tempat imajinasi liar diramu menjadi konsep komersial yang berdaya tarik tinggi dan menghasilkan dampak nyata.',1,6,'2026-09-10 21:55:46','2026-10-06 04:46:28'),(7,'problem','Problem','Masalah','Catalyst for Innovation','Peluang untuk Inovasi','bi-patch-question-fill','uploads/philosophy/1791261966_6ac47d0eab50d.jpg','We do not avoid market problems; we dissect them to find the best creative angles that solve your brand barriers.','Kami tidak menghindari masalah pasar; kami membedahnya untuk menemukan sudut pandang kreatif terbaik yang memecahkan hambatan brand Anda.',0,7,'2026-09-10 21:55:46','2026-10-06 04:46:06'),(8,'psychology','Psychology','Psikologi','Consumer Emotional Touch','Sentuhan Emosional Konsumen','bi-person-heart','uploads/philosophy/1791261514_6ac47b4a213b1.jpg','Analyzing consumer behavior, emotion, and psychological motivation to create campaigns that resonate deeply and trigger action.','Menganalisis perilaku, emosi, dan motivasi psikologis konsumen untuk menciptakan kampanye yang menyentuh hati dan menggerakkan tindakan.',0,8,'2026-09-10 21:55:46','2026-10-06 04:38:34'),(9,'human','Human','Manusia','Human-Centric Approach','Pendekatan Human-Centric','bi-person-badge','uploads/philosophy/1791261937_6ac47cf1cdb0a.jpg','The best designs are human-centric. We craft work that is intuitive, empathetic, and meaningful in everyday life.','Desain terbaik berpusat pada manusia. Kami menciptakan karya yang ramah, berempati, dan bermakna bagi kehidupan sehari-hari.',0,9,'2026-09-10 21:55:46','2026-10-06 04:45:37'),(10,'brain','BRAIN','OTAK','Logic & Creative Artistry','Integrasi Logika & Seni Kreatif','bi-diagram-3-fill','uploads/philosophy/1791262679_6ac47fd73fd50.jpg','Harmoniously balancing left-brain logic (data analysis, business calculation) with right-brain artistry (art aesthetics, visual emotion).','Menyeimbangkan fungsi otak kiri (analisis data, kalkulasi bisnis) dan otak kanan (estetika seni, emosi visual) secara harmonis.',1,10,'2026-09-10 21:55:46','2026-10-06 04:57:59'),(11,'neurons','Neurons','Neuron','Spark of Idea Connections','Percikan Koneksi Ide','bi-lightning-charge-fill','uploads/philosophy/1791262382_6ac47eae24032.webp','Each neuron represents a synapse of creative ideas interconnecting to form a comprehensive campaign ecosystem (ATL, BTL & Digital).','Setiap neuron merepresentasikan sinapsis ide kreatif yang saling terhubung membentuk kesatuan kampanye komprehensif (ATL, BTL & Digital).',0,11,'2026-09-10 21:55:46','2026-10-06 04:53:02'),(12,'body','Body','Tubuh','Physical Execution & Touchpoint','Realisasi & Eksekusi Nyata','bi-activity','uploads/philosophy/1791261486_6ac47b2ede5c1.jpg','Great concepts demand solid real-world execution—from premium print materials to physical field activations.','Konsep hebat memerlukan eksekusi nyata yang solid—mulai dari materi cetak berkualitas premium hingga aktivasi fisik di lapangan.',0,12,'2026-09-10 21:55:46','2026-10-06 04:38:06'),(13,'ego','Ego','Ego','Unique Brand Character','Karakter & Diferensiasi Brand','bi-shield-shaded','uploads/philosophy/1791261462_6ac47b16aa0a5.webp','Building a bold and distinctive brand character that stands out with confidence and strong differentiation in competitive markets.','Membangun karakter dan ciri khas brand yang berani tampil beda, percaya diri, dan memiliki diferensiasi kuat di pasar kompetitif.',0,13,'2026-09-10 21:55:46','2026-10-06 04:37:42'),(14,'individual','Individual','Individu','Tailored Bespoke Solutions','Sentuhan Personal & Kustom','bi-person-check-fill','uploads/philosophy/1791261909_6ac47cd5e9190.jpg','Every brand and client is unique. We provide tailored approaches crafted specifically to your unique requirements.','Setiap brand dan klien memiliki keunikan tersendiri. Kami menyediakan pendekatan yang dipersonalisasi sesuai kebutuhan spesifik Anda.',0,14,'2026-09-10 21:55:46','2026-10-06 04:45:09'),(15,'see','See','Lihat','Vision & Fresh Perspectives','Visi & Perspektif Masa Depan','bi-eye-fill','uploads/philosophy/1791259901_6ac474fdefbf4.jpg','Looking beyond standard industry boundaries—discovering fresh perspectives that keep your brand ahead of the curve.','Melihat melampaui batas standar industri—menemukan sudut pandang baru yang membuat brand Anda selalu relevan dan terdepan.',0,15,'2026-09-10 21:55:46','2026-10-06 04:11:41');
/*!40000 ALTER TABLE `philosophies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description_en` text DEFAULT NULL,
  `description_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'ATL & BTL Campaign Services','Jasa Kampanye ATL & BTL','ATL & BTL','Our services are specialized for both Above The Line (ATL) and Below The Line (BTL) marketing and advertising solutions, offering integrated and comprehensive coverage to reach target audiences effectively.','Layanan kami berspesialisasi dalam solusi pemasaran dan periklanan baik Above The Line (ATL) maupun Below The Line (BTL), menawarkan cakupan yang terintegrasi dan komprehensif untuk menjangkau audiens target secara efektif.','2026-07-04 00:33:55','2026-07-04 00:33:55'),(2,'Creative & Media Concept','Konsep Kreatif & Media','Concept','Development campaign of TVC (Television Commercial), print advertisements, POS (Point of Sale) materials, radio ads, and corporate/video profiles.','Pengembangan kampanye TVC (Iklan Televisi), iklan cetak, materi POS (Point of Sale), iklan radio, dan video profil perusahaan.','2026-07-04 00:33:55','2026-07-04 00:33:55'),(3,'Graphic Design Concept','Konsep Desain Grafis','Graphic Design Concept','Full graphic design development including logo & icon device campaign creation, storyboards development, and simple yet impactful packaging design.','Pengembangan desain grafis lengkap termasuk pembuatan logo & ikon kampanye, pengembangan storyboard, dan desain kemasan yang simpel namun berdampak kuat.','2026-07-04 00:33:55','2026-07-04 00:33:55');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) NOT NULL,
  `title_id` varchar(255) NOT NULL,
  `category_en` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `description_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (1,'Brochure','Brosur','Brochure','Brosur','uploads/portfolio/1791212981_6ac3bdb5c64c0.jpg','Printed using a tri-fold brochure format with a neat multi-column layout, harmoniously combining elements of solid text information, scientific graphics, and product photos','Dicetak menggunakan format brosur lipat tiga  dengan tata letak multi-kolom yang rapi, memadukan elemen informasi teks padat, grafik ilmiah, serta foto produk secara harmonis','2026-10-05 15:09:41','2026-10-05 15:09:41'),(2,'Pouch','Kantong','Pouch','Kantong','uploads/portfolio/1791213518_6ac3bfcedb673.jpg','Enhance your brand identity and appreciation for your clients through our exclusive Custom Pouch collection from our printing service. Designed with a modern aesthetic and practical functionality in mind, these pouches are an ideal medium for souvenirs or corporate merchandise for a variety of promotional needs.','Tingkatkan citra merek (brand identity) dan apresiasi kepada klien Anda melalui koleksi Custom Pouch eksklusif dari layanan percetakan kami. Dirancang dengan memadukan estetika modern dan fungsi praktis, pouch ini adalah media suvenir atau merchandise korporat yang sangat ideal untuk berbagai kebutuhan promosi.','2026-10-05 15:18:38','2026-10-05 15:18:38'),(3,'Brochure','Brosur','Brochure','Brosur','uploads/portfolio/1791213639_6ac3c04749781.jpg','Ideal for the promotional needs of beauty clinics, pharmaceutical products, fashion, and large corporations that demand aesthetic standards and uncompromising print quality.','Sangat ideal untuk kebutuhan promosi klinik kecantikan, produk farmasi, fashion, maupun korporat besar yang menuntut standar estetika dan kualitas cetak tanpa kompromi.','2026-10-05 15:20:39','2026-10-05 15:20:39'),(4,'Mockup dummy giant product','Mockup dummy giant product','Mockup dummy giant product','Mockup dummy giant product','uploads/portfolio/1791213737_6ac3c0a99cf70.jpg','Promotional display media with attractive and professional designs, made to support the needs of branding, product promotion, events, and marketing activities. With its print quality and neat finish, the standee provides a strong visual appearance while strengthening the brand identity in the promotional area.','Media display promosi dengan desain yang menarik dan profesional, dibuat untuk mendukung kebutuhan branding, promosi produk, event, dan aktivitas marketing. Dengan kualitas cetak dan finishing yang rapi, standee memberikan tampilan visual yang kuat sekaligus memperkuat identitas brand di area promosi.','2026-10-05 15:22:17','2026-10-05 15:22:17'),(5,'Mockup dummy giant product','Mockup dummy giant product','Mockup dummy giant product','Mockup dummy giant product','uploads/portfolio/1791213781_6ac3c0d53c157.jpg','Custom product displays with designs resembling product packaging, equipped with tiered shelves to display and organize products neatly. The combination of premium materials, colors, and finishes provides an elegant look while strengthening product branding in promotional, retail, clinic, and event areas.','Display produk custom dengan desain menyerupai kemasan produk, dilengkapi rak bertingkat untuk menampilkan dan menata produk secara rapi. Perpaduan material, warna, dan finishing premium memberikan tampilan elegan sekaligus memperkuat branding produk di area promosi, retail, klinik, maupun event.','2026-10-05 15:23:01','2026-10-05 15:23:01'),(6,'Ritrama Sticker Cut Out Mockup','Mockup Sticker Cut Out berbahan Ritrama','Ritrama Sticker Cut Out Mockup','Mockup Sticker Cut Out berbahan Ritrama','uploads/portfolio/1791214710_6ac3c4769d108.jpg','High-quality Ritrama cut out stickers are an elegant, durable, and professional vehicle aesthetic and promotional media solution. Specially designed for installation on windshields or rear windshields of vehicles (such as SUVs, commercial cars, or company operations), these stickers provide a sharp and classy branding look.','Sticker cut out berbahan Ritrama berkualitas tinggi merupakan solusi media promosi dan estetika kendaraan yang elegan, tahan lama, dan profesional. Dirancang khusus untuk pemasangan pada kaca depan maupun kaca belakang kendaraan (seperti mobil SUV, komersial, atau operasional perusahaan), stiker ini memberikan tampilan branding yang tajam dan berkelas.','2026-10-05 15:38:30','2026-10-05 15:38:30'),(7,'Ritrama Sticker Cut Out Mockup','Mockup Sticker Cut Out berbahan Ritrama','Ritrama Sticker Cut Out Mockup','Mockup Sticker Cut Out berbahan Ritrama','uploads/portfolio/1791217069_6ac3cdad2f7b1.jpg','Ritrama\'s Sticker Cut Out design mockup and manufacturing services for full-body side wrapping/decals deliver dynamic, strong character and professional mobile branding, campaign or visual identity solutions.','Layanan pembuatan dan mockup desain Sticker Cut Out Ritrama untuk bodi samping kendaraan (full-body side wrapping/decals) menghadirkan solusi mobile branding, kampanye, atau identitas visual yang dinamis, berkarakter kuat, dan profesional.','2026-10-05 15:49:10','2026-10-05 16:39:12'),(8,'event desk portable table','meja portabel event desk','event desk portable table','meja portabel event desk','uploads/portfolio/1791227217_6ac3f55161a77.jpg','Event Desk is a portable promotional media that is ideal and efficient for exhibition purposes, bazaars, product sampling, brand promotion, to indoor and outdoor event activities.','Event Desk adalah media promosi portabel yang sangat ideal dan efisien untuk keperluan pameran, bazaar, sampling produk, promosi brand, hingga kegiatan event indoor maupun outdoor.','2026-10-05 19:06:57','2026-10-05 19:06:57'),(9,'puppet gimmick','gimik boneka','puppet gimmick','gimik boneka','uploads/portfolio/1791227359_6ac3f5df34cd6.jpg','Present a visual representation of your brand in its most adorable and unforgettable form. Our corporate doll gimmick making service is the perfect solution to create a deeper emotional connection with clients, business partners and employees. Not just dolls, these are small ambassadors of your company printed with high precision.','Hadirkan representasi visual brand Anda dalam wujud yang paling menggemaskan dan tak terlupakan. Layanan pembuatan gimmick boneka korporat kami adalah solusi sempurna untuk menciptakan hubungan emosional yang lebih dalam dengan klien, mitra bisnis, dan karyawan. Bukan sekadar boneka, ini adalah duta kecil perusahaan Anda yang dicetak dengan presisi tinggi.','2026-10-05 19:09:19','2026-10-05 19:09:19'),(10,'Highway Billboards','Baliho Jalan Tol Raya','Highway Billboards','Baliho Jalan Tol Raya','uploads/portfolio/1791227450_6ac3f63a261e9.jpg','Installation of large-scale steel-structured toll road billboards. Print high-quality wide-format solvents that are resistant to sunlight and rain.','Instalasi baliho jalan tol berstruktur baja skala besar. Cetak solvent format lebar berkualitas tinggi yang tahan terhadap sinar matahari dan hujan.','2026-10-05 19:10:50','2026-10-05 19:10:50'),(11,'Zippered canvas tote bag','tote bag berbahan canvas beritsleting','Zippered canvas tote bag','tote bag berbahan canvas beritsleting','uploads/portfolio/1791227577_6ac3f6b931bca.jpg','Enhance the prestige and visibility of your client\'s brand through a collection of high-quality Custom Tote Bags from our printing production line. Designed to combine function, durability and modern aesthetics, this bag is an ideal souvenir or corporate merchandise for various professional events, seminars and product launches.','Tingkatkan prestise dan visibilitas merek klien Anda melalui koleksi Custom Tote Bag berkualitas tinggi dari lini produksi percetakan kami. Dirancang dengan memadukan fungsi, ketahanan, dan estetika modern, tas ini merupakan media suvenir atau merchandise korporat yang sangat ideal untuk berbagai acara profesional, seminar, maupun peluncuran produk.','2026-10-05 19:12:57','2026-10-05 19:12:57'),(12,'acrylic plaque','plakat akrilik','acrylic plaque','plakat akrilik','uploads/portfolio/1791227659_6ac3f70b339df.jpg','The best choice for corporations, institutions and event organizers who want to provide highly memorable souvenirs for their best partners, clients or employees.','Pilihan terbaik bagi korporasi, institusi, maupun penyelenggara acara yang ingin memberikan cinderamata berkesan tinggi untuk mitra, klien, atau karyawan terbaik mereka.','2026-10-05 19:14:19','2026-10-05 19:14:19'),(13,'display box/stand','kotak/ stand pajangan','display box/stand','kotak/ stand pajangan','uploads/portfolio/1791228119_6ac3f8d74d275.jpg','Skincare industry, cosmetics, snacks, medicines, supplements, souvenir products and accessories.','Industri skincare, kosmetik, makanan ringan, obat-obatan, suplemen, hingga produk suvenir dan aksesoris.','2026-10-05 19:21:59','2026-10-05 19:21:59'),(14,'Mockup dummy giant product','Mockup dummy giant product','Mockup dummy giant product','Mockup dummy giant product','uploads/portfolio/1791228285_6ac3f97d232dd.jpg','product branding mockup, PVC material','mockup branding produk, bahan PVC','2026-10-05 19:24:45','2026-10-05 19:24:45'),(15,'Mockup dummy giant product','Mockup dummy giant product','Mockup dummy giant product','Mockup dummy giant product','uploads/portfolio/1791228328_6ac3f9a840ae3.jpg','MockUp Giant Product Vial Bottle','MockUp Giant Product Botol Vial','2026-10-05 19:25:28','2026-10-05 19:25:28'),(16,'Brochure','Brosur','Brochure','Brosur','uploads/portfolio/1791228460_6ac3fa2c3640b.jpg','Very suitable for the pharmaceutical industry, beauty clinics, personal care products, and MSMEs who want to raise the level of their product class on the market.','Sangat cocok untuk industri farmasi, klinik kecantikan, produk personal care, hingga UMKM yang ingin menaikkan level kelas produknya di pasaran.','2026-10-05 19:27:40','2026-10-05 19:27:40'),(17,'Brochure','Brosur','Brochure','Brosur','uploads/portfolio/1791228502_6ac3fa563454d.jpg','It is ideal for promotional needs for aesthetic clinics, exhibitions, indoor/outdoor advertising, as well as national scale product campaigns that demand uncompromising visual quality standards.','Sangat ideal digunakan untuk kebutuhan promosi klinik estetika, pameran, indoor/outdoor advertising, maupun kampanye produk berskala nasional yang menuntut standar kualitas visual tanpa kompromi.','2026-10-05 19:28:22','2026-10-05 19:28:22'),(18,'Brochure','Brosur','Brochure','Brosur','uploads/portfolio/1791228546_6ac3fa82400f4.jpg','Ideal Solution for Beauty Clinics & Corporate Exhibitions: Very suitable for promotional needs for medical devices, modern aesthetic clinics, new product launches, and exhibition booth wall decorations that demand world-class visual standards.','Solusi Ideal untuk Klinik Kecantikan & Pameran Korporat: Sangat cocok digunakan untuk kebutuhan promosi perangkat medis, klinik estetika modern, peluncuran produk baru, hingga dekorasi dinding pameran (exhibition booth) yang menuntut standar visual kelas dunia.','2026-10-05 19:29:06','2026-10-05 19:29:06');
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_images`
--

DROP TABLE IF EXISTS `portfolio_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolio_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `portfolio_id` bigint(20) unsigned NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portfolio_images_portfolio_id_foreign` (`portfolio_id`),
  CONSTRAINT `portfolio_images_portfolio_id_foreign` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_images`
--

LOCK TABLES `portfolio_images` WRITE;
/*!40000 ALTER TABLE `portfolio_images` DISABLE KEYS */;
INSERT INTO `portfolio_images` VALUES (8,7,'uploads/portfolio/1791217069_6ac3cdad2f7b1.jpg','2026-10-05 16:17:49','2026-10-05 16:17:49'),(9,7,'uploads/portfolio/1791222650_6ac3e37ae3f09.jpg','2026-10-05 17:50:50','2026-10-05 17:50:50'),(10,7,'uploads/portfolio/1791222669_6ac3e38d08073.jpg','2026-10-05 17:51:09','2026-10-05 17:51:09'),(11,7,'uploads/portfolio/1791222684_6ac3e39c7a555.jpg','2026-10-05 17:51:24','2026-10-05 17:51:24'),(12,8,'uploads/portfolio/1791227217_6ac3f55161a77.jpg','2026-10-05 19:06:57','2026-10-05 19:06:57'),(13,9,'uploads/portfolio/1791227359_6ac3f5df34cd6.jpg','2026-10-05 19:09:19','2026-10-05 19:09:19'),(14,10,'uploads/portfolio/1791227450_6ac3f63a261e9.jpg','2026-10-05 19:10:50','2026-10-05 19:10:50'),(15,11,'uploads/portfolio/1791227577_6ac3f6b931bca.jpg','2026-10-05 19:12:57','2026-10-05 19:12:57'),(16,12,'uploads/portfolio/1791227659_6ac3f70b339df.jpg','2026-10-05 19:14:19','2026-10-05 19:14:19'),(17,13,'uploads/portfolio/1791228119_6ac3f8d74d275.jpg','2026-10-05 19:21:59','2026-10-05 19:21:59'),(18,14,'uploads/portfolio/1791228285_6ac3f97d232dd.jpg','2026-10-05 19:24:45','2026-10-05 19:24:45'),(19,15,'uploads/portfolio/1791228328_6ac3f9a840ae3.jpg','2026-10-05 19:25:28','2026-10-05 19:25:28'),(20,16,'uploads/portfolio/1791228460_6ac3fa2c3640b.jpg','2026-10-05 19:27:40','2026-10-05 19:27:40'),(21,17,'uploads/portfolio/1791228502_6ac3fa563454d.jpg','2026-10-05 19:28:22','2026-10-05 19:28:22'),(22,18,'uploads/portfolio/1791228546_6ac3fa82400f4.jpg','2026-10-05 19:29:06','2026-10-05 19:29:06');
/*!40000 ALTER TABLE `portfolio_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role_en` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `quote_en` text DEFAULT NULL,
  `quote_id` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `description_id` text DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
INSERT INTO `team_members` VALUES (1,'Enung Kosasih','Director','Direktur','0856 9317 4242','Brave to tell myself I\'m creative, when I\'m making a creation.','Berani mengatakan pada diri sendiri bahwa saya kreatif, ketika saya membuat sebuah karya.','Starting his career on advertising in (1990) at POWER BRAND COMMUNICATION as Art Director and ADVISINDO as Senior Art Director. With decades of creative leadership, he guides the agency\'s strategic vision.','Memulai karirnya di bidang periklanan pada tahun (1990) di POWER BRAND COMMUNICATION sebagai Art Director dan ADVISINDO sebagai Senior Art Director. Dengan kepemimpinan kreatif selama beberapa dekade, beliau mengarahkan visi strategis agensi.','uploads/team/enung.jpg',1,'2026-07-04 00:33:55','2026-07-04 00:48:15'),(2,'Oleh Wijayana','Creative Director','Direktur Kreatif','0858 9111 8571','Idea are everywhere, I\'m just transferring it.','Ide ada di mana-mana, saya hanya menyalurkannya saja.','Newly enter advertising for 20 years. Becoming a Graphic Designer is his pride. Was in POWER BRAND COM handling major accounts like Aquaproof, Indofarma, and Giant Hypermarket.','Baru memasuki dunia periklanan selama 20 tahun. Menjadi Desainer Grafis adalah kebanggaannya. Pernah di POWER BRAND COM menangani akun-akun besar seperti Aquaproof, Indofarma, dan Giant Hypermarket.','uploads/team/oleh.jpg',2,'2026-07-04 00:33:55','2026-07-04 00:48:15'),(3,'Jajat Sujana','Art Director','Art Director','+62 858-8289-1454','Visualizing concepts into breathing masterpieces.','Memvisualisasikan konsep menjadi mahakarya yang hidup.','Dedicated Art Director overseeing layout execution and graphic integrity across advertising campaigns.','Art Director yang berdedikasi mengawasi eksekusi tata letak dan integritas grafis di seluruh kampanye periklanan.','uploads/team/jajat.jpg',3,'2026-07-04 00:33:55','2026-07-04 00:54:43'),(4,'Lomri Amiruddin','Art Director','Art Director','+62 812-8825-524','Art is the bridge between market demand and pure imagination.','Seni adalah jembatan antara permintaan pasar dan imajinasi murni.','Co-directs the visual identity and structural designs for print media and branding items.','Mengarahkan bersama identitas visual dan desain struktural untuk media cetak dan produk branding.','uploads/team/lomri.jpg',4,'2026-07-04 00:33:55','2026-07-04 00:48:15'),(5,'Asep Saepudin','Production Manager','Manajer Produksi','+62 813-8034-1092','Bridging the creative spark with technical production precision.','Menghubungkan percikan kreatif dengan presisi produksi teknis.','Manages the production floor, print manufacturing, machinery schedule, and delivery logistics.','Mengelola lantai produksi, manufaktur cetak, jadwal mesin, dan logistik pengiriman.','uploads/team/asep.jpg',5,'2026-07-04 00:33:55','2026-07-04 00:48:15'),(6,'Andi Supriadi','Graphic Designer','Desainer Grafis','+62 877-7408-7727','Designing details that make products stand out.','Mendesain detail-detail yang membuat produk menonjol.','Focuses on campaign layout, vector design, device mockup, and promotional material illustration.','Berfokus pada tata letak kampanye, desain vektor, mockup perangkat, dan ilustrasi materi promosi.','uploads/team/andi.jpg',6,'2026-07-04 00:33:55','2026-07-04 00:48:15'),(7,'Iwan Setiawan','Purchasing Manager','Manajer Pembelian','+62 856-9292-1200','Sourcing quality materials to bring designs to life.','Mencari bahan berkualitas untuk menghidupkan desain.','Responsible for procurement of raw materials, print components, neon box materials, and supplier management.','Bertanggung jawab atas pengadaan bahan baku, komponen cetak, bahan neon box, dan manajemen pemasok.','uploads/team/iwan.jpg',7,'2026-07-04 00:33:55','2026-07-04 00:48:15'),(9,'Putri W Ramadhania','Finance & Accounting','Keuangan & Akuntansi','+62 857-7968-3340','Balancing creativity with financial soundness and efficiency.','Menyeimbangkan kreativitas dengan kesehatan finansial dan efisiensi.','Handles account billing, vendor invoices, tax compliance (NPWP), and financial reporting.','Menangani penagihan akun, faktur vendor, kepatuhan pajak (NPWP), dan pelaporan keuangan.','uploads/team/putri.jpg',9,'2026-07-04 00:33:55','2026-07-04 00:48:15'),(10,'Zida Urwa','web developer','web developer','08984215781','Developing rapidly with an integrated system','Berkembang pesat dengan adanya sistem yang sudah terintegrasi','Starting development in 2026','Memulai develop pada tahun 2026','uploads/team/1790181495_6ab40077003f6.jpg',10,'2026-09-23 16:38:15','2026-10-05 12:40:40');
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `products` text DEFAULT NULL,
  `logo_width` int(10) unsigned DEFAULT 80 COMMENT 'Custom width for client logo in px',
  `logo_height` int(10) unsigned DEFAULT 80 COMMENT 'Custom height for client logo in px',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'PT. Galderma','uploads/clients/1789978084_Logo Galderma.png','2026-09-21 00:43:15','2026-09-24 17:34:22',NULL,230,49),(3,'Merz Aesthetics','uploads/clients/1789978756_Merz Aesthetics.png','2026-09-21 01:19:16','2026-09-21 02:38:51',NULL,200,200),(4,'Naos','uploads/clients/1789979135_Logo Naos.png','2026-09-21 01:25:35','2026-09-21 02:39:20',NULL,200,200),(5,'Novell Phamaceutical Laboratories','uploads/clients/1789979302_logo Novell.png','2026-09-21 01:28:22','2026-09-21 02:37:51',NULL,200,200),(6,'DiscountMAX','uploads/clients/1789979687_Logo DIscountMAX.png','2026-09-21 01:34:47','2026-09-24 17:53:54',NULL,125,66),(7,'MEdmix','uploads/clients/1789979936_Logo MEdmix.png','2026-09-21 01:38:56','2026-09-21 01:38:56',NULL,80,80),(8,'PARVUS','uploads/clients/1789980025_Logo Parvus.png','2026-09-21 01:40:25','2026-09-21 01:40:25',NULL,80,80),(9,'PROMED','uploads/clients/1789980141_logo Promed.png','2026-09-21 01:42:21','2026-09-21 01:42:21',NULL,80,80),(10,'PYRIDAM FARMA','uploads/clients/1789980219_Logo Pyridam.png','2026-09-21 01:43:39','2026-09-21 01:43:39',NULL,80,80),(11,'REGENESIS','uploads/clients/1789980284_logo Regenesis.png','2026-09-21 01:44:44','2026-09-21 01:44:44',NULL,80,80),(12,'Viva COSMETICS','uploads/clients/1789980354_Logo Viva Cosmetics.png','2026-09-21 01:45:54','2026-09-21 01:45:54',NULL,80,80),(13,'YUA CLINIC','uploads/clients/1789980437_Logo YUA Clinic.png','2026-09-21 01:47:17','2026-09-21 01:47:17',NULL,80,80);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_products`
--

DROP TABLE IF EXISTS `client_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `width` int(10) unsigned DEFAULT 120 COMMENT 'Custom width for product image in px',
  `height` int(10) unsigned DEFAULT 100 COMMENT 'Custom height for product image in px',
  PRIMARY KEY (`id`),
  KEY `client_products_client_id_foreign` (`client_id`),
  CONSTRAINT `client_products_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_products`
--

LOCK TABLES `client_products` WRITE;
/*!40000 ALTER TABLE `client_products` DISABLE KEYS */;
INSERT INTO `client_products` VALUES (1,1,'uploads/clients/products/1789977553_6ab0e3d10a541_Logo Cetaphil.png','2026-09-21 00:59:13','2026-09-24 17:35:35',120,33),(3,1,'uploads/clients/products/1789978240_6ab0e6809d6da_Logo Sculptra-01-01.png','2026-09-21 01:10:40','2026-09-21 01:10:40',120,100),(6,3,'uploads/clients/products/1789978792_6ab0e8a8803e1_Logo Ultherapy Prime.ai.png','2026-09-21 01:19:52','2026-09-21 01:19:52',120,100),(7,3,'uploads/clients/products/1789978820_6ab0e8c43d041_Radiesse-01.png','2026-09-21 01:20:20','2026-09-21 01:20:20',120,100),(8,4,'uploads/clients/products/1789979135_6ab0e9ffababa_Logo Bioderma.png','2026-09-21 01:25:35','2026-09-21 01:25:35',120,100);
/*!40000 ALTER TABLE `client_products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-06 19:34:40
