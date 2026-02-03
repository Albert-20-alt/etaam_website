-- MySQL dump 10.13  Distrib 5.7.44, for osx10.15 (x86_64)
--
-- Host: localhost    Database: etaam_db
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `about_page_data`
--

DROP TABLE IF EXISTS `about_page_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about_page_data` (
  `section` varchar(100) NOT NULL,
  `content` longtext,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_page_data`
--

LOCK TABLES `about_page_data` WRITE;
/*!40000 ALTER TABLE `about_page_data` DISABLE KEYS */;
INSERT INTO `about_page_data` VALUES ('business_from','{\"subtitle\":\"De grandes idées vers la réalité\",\"title\":\"Lancez votre projet \\n au Sénégal\",\"button_text\":\"GET IN TOUCH\",\"button_url\":\"contact.php\"}','2026-02-01 22:48:00'),('delivering_service','{\"item_1\":{\"title\":\"Expertise locale basée à Ziguinchor\",\"image\":\"assets\\/images\\/resources\\/senegal-tech-team-1.png\"},\"item_2\":{\"title\":\"Innovation Technologique et Agricole\",\"image\":\"assets\\/images\\/resources\\/senegal-agritech-field.png\"},\"item_3\":{\"title\":\"Infrastructures aux standards mondiaux\",\"image\":\"assets\\/images\\/resources\\/why-choose-us-senegal.png\"}}','2026-02-01 22:48:00'),('page_header','{\"title\":\"\\u00c0 Propos de Nous\",\"background_image\":\"assets\\/images\\/backgrounds\\/about-header-bg-senegal.png\"}','2026-02-02 21:01:53'),('team_section','{\"tagline\":\"Rencontrez l\'équipe\",\"title\":\"Leadership\"}','2026-02-01 22:48:00'),('why_choose_us','{\"tagline\":\"Restez protégés\",\"title\":\"Pourquoi choisir ETAAM ?\",\"main_text\":\"Nous comprenons les défis uniques de la région de Casamance. Nos solutions sont conçues pour être robustes, durables et adaptées aux réalités locales tout en respectant les standards internationaux.\",\"points\":[{\"title\":\"Innovation Locale\",\"text\":\"Des solutions technologiques nées et développées à Ziguinchor.\",\"icon\":\"icon-technology\"},{\"title\":\"Solutions Business\",\"text\":\"Accompagnement stratégique pour la digitalisation de votre entreprise au Sénégal.\",\"icon\":\"icon-stock-market\"}],\"image\":\"assets\\/images\\/resources\\/why-choose-us-senegal.png\"}','2026-02-02 10:32:46');
/*!40000 ALTER TABLE `about_page_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `excerpt` text,
  `content` longtext,
  `author` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('published','draft') DEFAULT 'published',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `tags` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (1,'innovation-numerique-casamance','L\'innovation numérique en Casamance','Découvrez comment les nouvelles technologies transforment le paysage entrepreneurial au sud du Sénégal. De l\'agriculture intelligente à l\'éducation, le numérique ouvre de nouvelles opportunités pour la jeunesse.','L\'Afrique est en pleine effervescence technologique, et le Sénégal se positionne comme un hub incontournable en Afrique de l\'Ouest. En Casamance, l\'innovation numérique ne se limite plus à la simple digitalisation des processus existants, mais redéfinit fondamentalement la manière dont les entreprises opèrent et interagissent avec leurs clients.\n\nDes startups locales aux grandes entreprises, l\'intégration de solutions sur mesure permet de répondre à des défis spécifiques tels que l\'inclusion financière, l\'accès aux soins de santé et l\'optimisation agricole.\n\nChez ETAAM, nous croyons fermement que le développement de logiciels adaptés est la clé pour libérer le potentiel économique de la région. En utilisant des technologies modernes comme l\'intelligence artificielle et le cloud computing, nous aidons nos partenaires à gagner en efficacité et à créer de la valeur ajoutée.','ETAAM','Innovation','assets/images/blog/blog_post_innovation_africa.png','published','2026-01-16 20:26:00','Technologie,Innovation,Casamance'),(2,'ia-agriculture-revolution-verte','IA et Agriculture : Une révolution verte','L\'usage de l\'intelligence artificielle permet d\'optimiser les rendements agricoles. Analyse des sols, prévisions météo et gestion des ressources sont désormais accessibles aux agriculteurs locaux.','L\'agriculture est le pilier de l\'économie sénégalaise. Cependant, elle fait face à de nombreux défis : changement climatique, gestion de l\'eau, et accès aux marchés. L\'Intelligence Artificielle apporte aujourd\'hui des réponses concrètes.\n\nGrâce à des capteurs IoT et à l\'analyse de données satellite, nous pouvons désormais prédire les rendements, détecter les maladies des plantes avant qu\'elles ne se propagent, et optimiser l\'irrigation pour économiser l\'eau.\n\nLes solutions développées par ETAAM permettent aux agriculteurs de Ziguinchor et de toute la région de prendre des décisions éclairées, augmentant ainsi leur productivité tout en préservant l\'environnement.','Albert','AgriTech','assets/images/blog/blog_post_it_challenges.png','published','2026-01-12 20:26:00','AgriTech,IA,Agriculture'),(3,'cybersecurite-pme-senegalaises','La Cybersécurité pour les PME Sénégalaises','À l\'ère du tout numérique, la protection des données est cruciale. Voici les bonnes pratiques pour sécuriser votre entreprise contre les cybermenaces grandissantes.','Avec la digitalisation croissante des entreprises sénégalaises, les risques de cyberattaques augmentent exponentiellement. Ransomwares, phishing, et vols de données ne concernent pas que les multinationales.\n\nPour une PME, une attaque peut être fatale. Il est donc essentiel de mettre en place une stratégie de défense robuste. Cela passe par la formation des employés, la mise à jour régulière des systèmes, et l\'utilisation de solutions de sécurité adaptées.\n\nNos experts en cybersécurité accompagnent les PME locales pour auditer leurs systèmes et renforcer leur résilience face aux menaces numériques.','Oumar Fall','Cybersécurité','assets/images/blog/blog-post-change.png','published','2026-01-05 20:26:00','Sécurité,PME,Data');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_campaigns`
--

DROP TABLE IF EXISTS `email_campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_campaigns` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recipient_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_campaigns`
--

LOCK TABLES `email_campaigns` WRITE;
/*!40000 ALTER TABLE `email_campaigns` DISABLE KEYS */;
INSERT INTO `email_campaigns` VALUES (1,'Offre Sp','Bonjour, profitez de nos offres exceptionnelles ce mois-ci !','2026-02-03 00:04:53',1);
/*!40000 ALTER TABLE `email_campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_replies`
--

DROP TABLE IF EXISTS `forum_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_replies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `topic_id` int NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `is_admin_reply` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `forum_replies_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `forum_topics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_replies`
--

LOCK TABLES `forum_replies` WRITE;
/*!40000 ALTER TABLE `forum_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_topics`
--

DROP TABLE IF EXISTS `forum_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_topics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT 'General',
  `status` enum('active','closed') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_topics`
--

LOCK TABLES `forum_topics` WRITE;
/*!40000 ALTER TABLE `forum_topics` DISABLE KEYS */;
INSERT INTO `forum_topics` VALUES (1,'Question Test','Ceci est une question de test.\n','Test User','Marketing','active','2026-02-01 13:42:55'),(2,'Test from Agent','Is this working?','Agent','Tech','active','2026-02-01 15:16:25');
/*!40000 ALTER TABLE `forum_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `home_page_data`
--

DROP TABLE IF EXISTS `home_page_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_page_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section` varchar(100) NOT NULL,
  `content` longtext,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `section` (`section`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_page_data`
--

LOCK TABLES `home_page_data` WRITE;
/*!40000 ALTER TABLE `home_page_data` DISABLE KEYS */;
INSERT INTO `home_page_data` VALUES (1,'hero_slider','{\"slide_1\":{\"image\":\"assets\\/images\\/resources\\/hero-slide-1.png\",\"title\":\"Transformez votre <span>entreprise<\\/span> avec le digital\",\"text\":\"ETAAM vous accompagne dans votre transformation num\\u00e9rique au S\\u00e9n\\u00e9gal et en Afrique de l\'Ouest.\"},\"slide_2\":{\"image\":\"assets\\/images\\/resources\\/hero-slide-2.png\",\"title\":\"Solutions <span>digitales<\\/span> innovantes\",\"text\":\"D\\u00e9veloppement web, applications mobiles, et infrastructure cloud pour votre business.\"},\"slide_3\":{\"image\":\"assets\\/images\\/resources\\/hero-slide-3.png\",\"title\":\"Expertise <span>locale<\\/span> vision globale\",\"text\":\"Une \\u00e9quipe s\\u00e9n\\u00e9galaise exp\\u00e9riment\\u00e9e au service de votre r\\u00e9ussite num\\u00e9rique.\"}}','2026-01-30 05:02:31'),(2,'projects','{\"project_1\":{\"title\":\"Architecture Cloud\",\"subtitle\":\"Infrastructure\",\"image\":\"assets\\/images\\/project\\/etaam-project-1.png\",\"link\":\"project-details.php?id=architecture-cloud\"},\"project_2\":{\"title\":\"Audit & Conseil\",\"subtitle\":\"S\\u00e9curit\\u00e9\",\"image\":\"assets\\/images\\/project\\/etaam-project-2.png\",\"link\":\"project-details.php?id=audit-conseil\"},\"project_3\":{\"title\":\"App AgriTech\",\"subtitle\":\"Mobile\",\"image\":\"assets\\/images\\/project\\/etaam-project-3.png\",\"link\":\"project-details.php?id=agritech-sud\"},\"project_4\":{\"title\":\"Bootcamp Casamance\",\"subtitle\":\"Formation\",\"image\":\"assets\\/images\\/project\\/etaam-project-4.png\",\"link\":\"project-details.php?id=bootcamp-casamance\"}}','2026-01-30 05:02:31'),(3,'welcome','{\"tagline\":\"QUI SOMMES-NOUS ? \",\"title\":\"ETAAM cr\\u00e9e des solutions technologiques sur mesure\",\"text_1\":\"Bas\\u00e9e \\u00e0 Ziguinchor, ETAAM est votre partenaire technologique pour la transformation digitale. Nous offrons des solutions innovantes adapt\\u00e9es aux besoins des entreprises africaines.\",\"text_2\":\"Notre mission est d\'acc\\u00e9l\\u00e9rer l\'innovation en Afrique de l\'Ouest. Que ce soit pour la digitalisation de processus, l\'analyse de donn\\u00e9es agricoles ou la formation technique, nous nous engageons \\u00e0 d\\u00e9livrer l\'excellence gr\\u00e2ce \\u00e0 notre expertise locale.\",\"image\":\"assets\\/images\\/home\\/team-group-senegal-v7.jpg\"}','2026-01-30 05:02:31'),(4,'consult','{\"tagline\":\"NOTRE EXPERTISE\",\"title\":\"Conseil et Solutions Technologiques Sur Mesure\",\"text\":\"Nous accompagnons votre transformation num\\u00e9rique avec une approche personnalis\\u00e9e. De l\'audit de vos syst\\u00e8mes \\u00e0 l\'int\\u00e9gration de solutions complexes, notre \\u00e9quipe d\'experts est \\u00e0 vos c\\u00f4t\\u00e9s.\",\"image\":\"assets\\/images\\/resources\\/consult-1.png\"}','2026-01-30 05:02:31'),(5,'business_from','{\"subtitle\":\"De l\'id\\u00e9e \\u00e0 la r\\u00e9alit\\u00e9\",\"title\":\"Lancez votre Projet Tech avec ETAAM\",\"button_text\":\"Contactez-nous\",\"button_url\":\"contact.php\"}','2026-01-30 05:02:31'),(6,'notech_more','{\"tagline\":\"POURQUOI NOUS CHOISIR\",\"title\":\"ETAAM : Bien plus que de la Tech\",\"text\":\"Nous transformons vos d\\u00e9fis en opportunit\\u00e9s gr\\u00e2ce \\u00e0 notre expertise locale et nos standards internationaux. Votre r\\u00e9ussite est notre mission.\",\"image\":\"assets\\/images\\/resources\\/etaam-collaboration.jpg\"}','2026-01-30 05:02:31'),(13,'hero','{\"title\":\"Expertise <span class=\\\"highlight-teal\\\">Locale<\\/span>,<br>Vision Globale\",\"subtitle\":\"Acc\\u00e9l\\u00e9rez votre croissance avec des solutions technologiques sur mesure, con\\u00e7ues au S\\u00e9n\\u00e9gal pour le monde.\",\"image\":\"assets\\/images\\/resources\\/hero-hand-generated.png\"}','2026-01-31 09:25:47');
/*!40000 ALTER TABLE `home_page_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marketing_page_data`
--

DROP TABLE IF EXISTS `marketing_page_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marketing_page_data` (
  `section` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` json NOT NULL,
  PRIMARY KEY (`section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marketing_page_data`
--

LOCK TABLES `marketing_page_data` WRITE;
/*!40000 ALTER TABLE `marketing_page_data` DISABLE KEYS */;
INSERT INTO `marketing_page_data` VALUES ('cta','{\"title\": \"Prêt à faire décoller votre business ?\", \"button1_url\": \"contact.php\", \"button2_url\": \"#services\", \"description\": \"Ne laissez pas vos concurrents prendre l\'avantage. Contactez-nous dès aujourd\'hui pour une stratégie sur mesure.\", \"button1_text\": \"Demander un Devis\", \"button2_text\": \"Découvrir nos offres\"}'),('hero','{\"title\": \"Marketing Digital<br><span style=\\\"background: linear-gradient(135deg, #00d2d3 0%, #6A4C93 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;\\\">Qui Convertit</span>\", \"cta1_url\": \"#contact\", \"cta2_url\": \"#services\", \"subtitle\": \"Propulsez votre marque avec des stratégies data-driven et une créativité sans limite. Nous transformons vos visiteurs en clients fidèles.\", \"cta1_text\": \"Lancer mon projet\", \"cta2_text\": \"Nos Services\"}'),('process','{\"step1_color\": \"linear-gradient(135deg, #ff9f43 0%, #ff6b6b 100%)\", \"step1_title\": \"Audit & Stratégie\", \"step2_color\": \"linear-gradient(135deg, #54a0ff 0%, #00d2d3 100%)\", \"step2_title\": \"Mise en Place\", \"step3_color\": \"linear-gradient(135deg, #5f27cd 0%, #341f97 100%)\", \"step3_title\": \"Optimisation\", \"step4_color\": \"linear-gradient(135deg, #1dd1a1 0%, #10ac84 100%)\", \"step4_title\": \"Croissance\", \"step1_description\": \"Analyse approfondie de votre marché et définition des KPIs.\", \"step2_description\": \"Déploiement des campagnes sur les canaux pertinents.\", \"step3_description\": \"Ajustements en temps réel basés sur la data.\", \"step4_description\": \"Scaling des campagnes performantes pour maximiser le ROI.\"}'),('services','{\"service1\": {\"icon\": \"fas fa-bullseye\", \"color\": \"#ff6b6b\", \"title\": \"Stratégie Digitale\", \"feature1\": \"Audit de marché\", \"feature2\": \"Plan d\'action sur mesure\", \"feature3\": \"Définition des KPIs\", \"description\": \"Une feuille de route claire pour atteindre vos objectifs commerciaux.\"}, \"service2\": {\"icon\": \"fas fa-search-dollar\", \"color\": \"#54a0ff\", \"title\": \"SEO & SEA\", \"feature1\": \"Optimisation On-page\", \"feature2\": \"Campagnes Google Ads\", \"feature3\": \"Rapport de positionnement\", \"description\": \"Soyez visible là où vos clients vous cherchent.\"}, \"service3\": {\"icon\": \"fas fa-hashtag\", \"color\": \"#feca57\", \"title\": \"Social Media\", \"feature1\": \"Création de contenu\", \"feature2\": \"Gestion de communauté\", \"feature3\": \"Campagnes Facebook/Insta\", \"description\": \"Engagez votre audience et construisez une communauté fidèle.\"}, \"service4\": {\"icon\": \"fas fa-pen-nib\", \"color\": \"#ff9ff3\", \"title\": \"Content Marketing\", \"feature1\": \"Articles de blog\", \"feature2\": \"Vidéo marketing\", \"feature3\": \"Newsletters\", \"description\": \"Des contenus captivants qui racontent votre histoire.\"}, \"service5\": {\"icon\": \"fas fa-envelope-open-text\", \"color\": \"#48dbfb\", \"title\": \"Emailing\", \"feature1\": \"Automation\", \"feature2\": \"Segmentation\", \"feature3\": \"A/B Testing\", \"description\": \"Fidélisez vos clients avec des campagnes personnalisées.\"}, \"service6\": {\"icon\": \"fas fa-chart-line\", \"color\": \"#1dd1a1\", \"title\": \"Analytics & Data\", \"feature1\": \"Tableaux de bord\", \"feature2\": \"Tracking avancé\", \"feature3\": \"Analyse du ROI\", \"description\": \"Des décisions basées sur des données fiables.\"}}'),('stats','{\"stat1_color\": \"#00d2d3\", \"stat1_label\": \"Projets Livrés\", \"stat1_value\": \"150+\", \"stat2_color\": \"#5f27cd\", \"stat2_label\": \"Clients Satisfaits\", \"stat2_value\": \"98%\", \"stat3_color\": \"#ff9f43\", \"stat3_label\": \"Années d\'Expérience\", \"stat3_value\": \"10+\", \"stat4_color\": \"#ff6b6b\", \"stat4_label\": \"Experts\", \"stat4_value\": \"12\"}'),('testimonials','{\"testimonial1\": {\"name\": \"Sophie D.\", \"role\": \"CEO\", \"color\": \"linear-gradient(135deg, #ff9f43 0%, #ff6b6b 100%)\", \"quote\": \"Une équipe proactive qui a su comprendre nos enjeux. Notre trafic a doublé en 6 mois !\", \"rating\": 5, \"company\": \"TechStart\"}, \"testimonial2\": {\"name\": \"Marc L.\", \"role\": \"Directeur Marketing\", \"color\": \"linear-gradient(135deg, #54a0ff 0%, #00d2d3 100%)\", \"quote\": \"Les résultats sont au rendez-vous. Le ROI de nos campagnes est excellent.\", \"rating\": 5, \"company\": \"EcoGroup\"}, \"testimonial3\": {\"name\": \"Julie M.\", \"role\": \"Fondatrice\", \"color\": \"linear-gradient(135deg, #5f27cd 0%, #341f97 100%)\", \"quote\": \"Un accompagnement sur mesure et des conseils pertinents. Je recommande vivement.\", \"rating\": 5, \"company\": \"Artisanat & Co\"}}');
/*!40000 ALTER TABLE `marketing_page_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text,
  `type` varchar(50) DEFAULT NULL,
  `domain` varchar(50) DEFAULT NULL,
  `budget` varchar(50) DEFAULT NULL,
  `urgency` varchar(50) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `is_archived` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'Albert','albert20malang@gmail.com','773698430',NULL,'','Hello',NULL,NULL,NULL,NULL,NULL,NULL,1,0,'2026-01-26 18:00:09'),(2,'Test User','test@example.com',NULL,NULL,'Test Subject','This is a test message to verify admin panel.',NULL,NULL,NULL,NULL,NULL,NULL,0,0,'2026-02-01 00:14:14'),(3,'test1234','aldjjvdj@gmail.com','123445678987654',NULL,'','ZEZRDFGHHHJGHFGDFSDDDSF BVB','nouveau-projet','ia','500k-2m','court-terme','2026-02-13','15:00:00',1,0,'2026-02-01 00:18:14');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_subscribers`
--

DROP TABLE IF EXISTS `newsletter_subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_subscribers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','unsubscribed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_subscribers`
--

LOCK TABLES `newsletter_subscribers` WRITE;
/*!40000 ALTER TABLE `newsletter_subscribers` DISABLE KEYS */;
INSERT INTO `newsletter_subscribers` VALUES (1,'test1234@example.com','active','2026-02-03 00:04:05');
/*!40000 ALTER TABLE `newsletter_subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `client` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `process_image` varchar(255) DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description_title` varchar(255) DEFAULT NULL,
  `description` text,
  `challenge` text,
  `deliverables` json DEFAULT NULL,
  `results` json DEFAULT NULL,
  `impact` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES ('agritech-sud','App AgriTech ','Projet','Développement Mobile','Coopérative Agricole','Ziguinchor, Sénégal','4 mois','assets/images/project/agritech-sud-natural.png','','assets/images/project/agritech-sud-natural.png','project-details.php?id=agritech-sud','Digitalisation de l\'Agriculture','\n            <p style=\"color: rgba(255,255,255,0.75); line-height: 1.9; font-size: 17px; margin-bottom: 20px;\">\n                Une application mobile intuitive conçue pour aider les agriculteurs locaux à gérer leurs cultures, \n                suivre les prix du marché et accéder à des conseils météorologiques en temps réel.\n            </p>','Créer une interface utilisateur accessible pour des utilisateurs peu familiers avec la technologie, fonctionnant parfaitement dans des zones à faible connectivité internet.\n','[{\"icon\": \"fas fa-mobile\", \"text\": \"Mode hors-ligne complet\", \"title\": \"App Android\"}, {\"icon\": \"fas fa-database\", \"text\": \"Suivi des récoltes\", \"title\": \"Data\"}, {\"icon\": \"fas fa-cloud-sun\", \"text\": \"Alertes temps réel\", \"title\": \"Météo\"}, {\"icon\": \"fas fa-chart-line\", \"text\": \"Prix des denrées\", \"title\": \"Marché\"}]','[{\"label\": \"Agriculteurs Actifs\", \"value\": \"500+\"}, {\"label\": \"Revenus Moyens\", \"value\": \"+25%\"}, {\"label\": \"Note Play Store\", \"value\": \"4.8/5\"}]','[\"Réduction des pertes post-récolte\", \"Meilleure négociation des prix\", \"Accès simplifié au financement\"]','2026-01-30 04:20:27'),('architecture-cloud','Architecture Cloud','Infrastructure','Infrastructure Cloud','Banque Panafricaine','Dakar, Sénégal','6 mois','assets/images/project/architecture-cloud-natural.png',NULL,'assets/images/project/architecture-cloud-natural.png','project-details.php?id=architecture-cloud','Transformation Numérique Sécurisée','\n            <p style=\"color: rgba(255,255,255,0.75); line-height: 1.9; font-size: 17px; margin-bottom: 20px;\">\n                Nous avons conçu et déployé une infrastructure cloud hybride résiliente pour une institution financière majeure. \n                Ce projet visait à garantir une haute disponibilité des services bancaires critiques tout en assurant une conformité stricte aux normes de sécurité internationales (PCI-DSS).\n            </p>\n            <p style=\"color: rgba(255,255,255,0.75); line-height: 1.9; font-size: 17px;\">\n                La solution a permis de réduire les coûts opérationnels de 30% et d\'améliorer la vitesse de déploiement des nouvelles applications.\n            </p>','Le défi principal résidait dans la migration sans interruption de service d\'un système bancaire actif 24/7, tout en intégrant des protocoles de sécurité avancés pour protéger les données sensibles des clients.','[{\"icon\": \"fas fa-cloud\", \"text\": \"Architecture AWS + On-Premise\", \"title\": \"Cloud Hybride\"}, {\"icon\": \"fas fa-shield-alt\", \"text\": \"Chiffrement de bout en bout\", \"title\": \"Sécurité Avancée\"}, {\"icon\": \"fas fa-server\", \"text\": \"Redondance multi-zone\", \"title\": \"Haute Disponibilité\"}, {\"icon\": \"fas fa-rocket\", \"text\": \"Pipelines CI/CD automatisés\", \"title\": \"DevOps\"}]','[{\"label\": \"Uptime\", \"value\": \"99.99%\"}, {\"label\": \"Coûts Opérationnels\", \"value\": \"-30%\"}, {\"label\": \"Performance\", \"value\": \"2X\"}]','[\"Sécurité des transactions renforcée\", \"Expérience client fluide et rapide\", \"Scalabilité pour les pics de charge\"]','2026-01-30 04:20:27'),('audit-conseil','Audit & Conseil','Projet','Cybersécurité','Opérateur Télécom','Abidjan, Côte d\'Ivoire','3 mois','assets/images/project/audit-conseil-natural.png','','assets/images/project/audit-conseil-natural.png','project-details.php?id=audit-conseil','Renforcement de la Posture de Sécurité','\n            <p style=\"color: rgba(255,255,255,0.75); line-height: 1.9; font-size: 17px; margin-bottom: 20px;\">\n                ETAAM a mené un audit exhaustif des systèmes d\'information d\'un grand opérateur. \n                Notre intervention a couvert les tests d\'intrusion, l\'analyse de code et la revue des politiques de sécurité.</p>','Identifier les vulnérabilités critiques dans un environnement complexe et hétérogène sans impacter les opérations commerciales en cours.','[{\"icon\": \"fas fa-search\", \"text\": \"Tests d\'intrusion avancés\", \"title\": \"Pentesting\"}, {\"icon\": \"fas fa-file-contract\", \"text\": \"Alignement ISO 27001\", \"title\": \"Mise en Conformité\"}, {\"icon\": \"fas fa-user-shield\", \"text\": \"Sensibilisation des équipes\", \"title\": \"Formation\"}, {\"icon\": \"fas fa-lock\", \"text\": \"Durcissement des configurations\", \"title\": \"Hardening\"}]','[{\"label\": \"Failles Corrigées\", \"value\": \"45+\"}, {\"label\": \"Incident Majeur\", \"value\": \"0\"}, {\"label\": \"Conformité\", \"value\": \"100%\"}]','[\"Protection des données abonnés\", \"Confiance des partenaires restaurée\", \"Culture de sécurité renforcée\"]','2026-01-30 04:20:27'),('bootcamp-casamance','Bootcamp Casamance','Formation','Bootcamp Tech','Jeunesse de Casamance','Ziguinchor, Sénégal','3 mois intensif','assets/images/project/bootcamp-casamance-natural.png',NULL,'assets/images/project/bootcamp-casamance-natural.png','project-details.php?id=bootcamp-casamance','Former les talents de demain','\n            <p style=\"color: rgba(255,255,255,0.75); line-height: 1.9; font-size: 17px; margin-bottom: 20px;\">\n                ETAAM a lancé le premier bootcamp technologique intensif en Casamance pour former la\n                jeunesse locale aux métiers du numérique. Ce programme de 3 mois a réuni <strong\n                    style=\"color: #8B5CF6;\">25 jeunes passionnés</strong> de Ziguinchor, Kolda et\n                Sédhiou pour une formation intensive en développement web, mobile et design UI/UX.\n            </p>\n            <p style=\"color: rgba(255,255,255,0.75); line-height: 1.9; font-size: 17px;\">\n                Notre objectif était de créer un vivier de talents tech local, capable de répondre aux\n                besoins des entreprises de la région et de lancer leurs propres projets\n                entrepreneuriaux. Le bootcamp combinait théorie et pratique avec des projets réels pour\n                des clients locaux.\n            </p>','Le principal défi était de proposer une formation de qualité internationale dans un contexte de ressources limitées. Nous devions adapter notre pédagogie aux réalités locales : connexion internet parfois instable, diversité des niveaux de départ des participants, et nécessité de rendre la formation accessible financièrement.','[{\"icon\": \"fas fa-code\", \"text\": \"HTML, CSS, JS, React\", \"title\": \"Développement Web\"}, {\"icon\": \"fas fa-mobile-alt\", \"text\": \"Apps cross-platform\", \"title\": \"Mobile avec Flutter\"}, {\"icon\": \"fas fa-project-diagram\", \"text\": \"Pour entreprises locales\", \"title\": \"Projets Réels\"}, {\"icon\": \"fas fa-user-tie\", \"text\": \"Insertion pro\", \"title\": \"Mentorat\"}]','[{\"label\": \"Développeurs formés\", \"value\": \"25\"}, {\"label\": \"Taux d\'insertion\", \"value\": \"72%\"}, {\"label\": \"Startups créées\", \"value\": \"3\"}]','[\"App gestion agricole utilisée par 200+ exploitants\", \"2ème cohorte lancée\", \"Extension à Kolda et Sédhiou\"]','2026-01-30 04:20:27');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `description` text,
  `link` varchar(255) DEFAULT NULL,
  `delay_anim` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `full_content` longtext,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Développement Web & Mobile','icon-coding','Sites vitrines, e-commerce, applications mobiles Android & iOS sur mesure.','product-development.php','100ms','2026-01-30 04:20:27',NULL,NULL),(2,'Infrastructure & Cloud','icon-cloud-storage','Installation réseaux, serveurs, virtualisation et migration vers le cloud sécurisé.','ui-ux-designing.php','200ms','2026-01-30 04:20:27',NULL,NULL),(3,'Audit & Cybersécurité','icon-cyber','Tests d\'intrusion, mise en conformité et sécurisation de vos données critiques.','digital-marketing.php','300ms','2026-01-30 04:20:27',NULL,NULL),(4,'Formation & Conseil','icon-education','Montée en compétence de vos équipes et accompagnement stratégique digital.','data-analysis.php','400ms','2026-01-30 04:20:27',NULL,NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text,
  PRIMARY KEY (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES ('address','Ziguinchor, Sénégal\nKénia - Université Assane Seck'),('email','contact@etaam.sn'),('facebook','https://facebook.com/etaam'),('linkedin','https://linkedin.com/company/etaam'),('logo',''),('phone','+221 77 000 00 00'),('site_name','ETAAM 2026'),('tagline','Innovation technologique au service de l\'Afrique'),('twitter','https://twitter.com/etaam');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_members` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `bio` text,
  `quote` text,
  `bio_1` text,
  `bio_2` text,
  `social_linkedin` varchar(255) DEFAULT NULL,
  `social_twitter` varchar(255) DEFAULT NULL,
  `social_facebook` varchar(255) DEFAULT NULL,
  `skills` text,
  `education` text,
  `history` text,
  `display_order` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
INSERT INTO `team_members` VALUES (1,'Albert Malang Diatta','Architecture et stratégie des systèmes d’information','assets/images/team/team-albert.jpg',NULL,'L\'innovation technologique n\'a de sens que si elle résout des problèmes concrets pour notre communauté.','Co-fondateur d\'ETAAM, Albert incarne la vision technique et stratégique de l\'entreprise. Fort d\'une expertise reconnue, il pilote l\'innovation technologique pour répondre aux défis locaux.','Son engagement pour le développement technologique en fait un pilier central de l\'écosystème numérique sénégalais.','#',NULL,NULL,'[{\"name\":\"Architecture Syst\\u00e8me\",\"percent\":\"95%\"},{\"name\":\"Leadership Technique\",\"percent\":\"90%\"},{\"name\":\"Cloud Computing\",\"percent\":\"85%\"}]','[{\"school\":\"Universit\\u00e9 Cheikh Anta Diop\",\"years\":\"2012 - 2014\",\"degree\":\"Master en Informatique, Syst\\u00e8mes Distribu\\u00e9s\"},{\"school\":\"\\u00c9cole Sup\\u00e9rieure Polytechnique (ESP)\",\"years\":\"2009 - 2012\",\"degree\":\"Licence en G\\u00e9nie Logiciel\"}]','[{\"year\":\"2024\",\"text\":\"Lancement ETAAM Innovation Hub\"},{\"year\":\"2022\",\"text\":\"Prix de l\'Innovation Num\\u00e9rique Casamance\"},{\"year\":\"2018\",\"text\":\"Lead Tech sur le projet AgriS\\u00e9n\\u00e9gal\"}]',0,'2026-01-30 04:54:41'),(2,'Hadja Ouleymatou Ndoye','Communication & Digital Marketing Strategy','assets/images/team/team-hadja.jpg',NULL,'Une communication stratégique est le pont entre l\'innovation technologique et son adoption par le public.','Hadja pilote la stratégie de communication et le marketing digital d\'ETAAM. Elle veille à ce que la vision et les innovations de l\'entreprise soient clairement transmises à nos partenaires et bénéficiaires.','Son expertise permet de valoriser l\'impact des solutions numériques développées par ETAAM.','#',NULL,NULL,'[{\"name\":\"Digital Marketing\",\"percent\":\"98%\"},{\"name\":\"Communication Strat\\u00e9gique\",\"percent\":\"95%\"},{\"name\":\"Branding\",\"percent\":\"90%\"}]','[{\"school\":\"ISM Dakar\",\"years\":\"2015 - 2017\",\"degree\":\"Master en Communication & Marketing Digital\"}]','[{\"year\":\"2024\",\"text\":\"Lancement Campagne Digitale AgriTech\"},{\"year\":\"2021\",\"text\":\"Responsable Com\' Startup Week\"}]',0,'2026-01-30 04:54:41'),(3,'Vincent Mendy','Planification stratégique et évaluation des programmes agricoles','assets/images/team/team-vincent.jpg',NULL,'Une planification rigoureuse et une évaluation continue sont les clés d\'un développement agricole durable et impactant.','Vincent est un expert en planification stratégique agricole. Il conçoit et évalue les programmes d\'ETAAM pour s\'assurer qu\'ils répondent efficacement aux besoins des agriculteurs et des communautés locales.','Son approche axée sur les résultats garantit la pérennité et l\'évolutivité des initiatives agricoles.','#',NULL,NULL,'[{\"name\":\"Planification Strat\\u00e9gique\",\"percent\":\"96%\"},{\"name\":\"\\u00c9valuation de Projet\",\"percent\":\"94%\"},{\"name\":\"D\\u00e9veloppement Agricole\",\"percent\":\"92%\"}]','[{\"school\":\"ENSA Thi\\u00e8s\",\"years\":\"2011 - 2014\",\"degree\":\"Ing\\u00e9nieur Agronome\"}]','[{\"year\":\"2023\",\"text\":\"Directeur Programme Agri-Innovation\"},{\"year\":\"2019\",\"text\":\"Consultant FAO S\\u00e9n\\u00e9gal\"}]',0,'2026-01-30 04:54:41'),(4,'Antoine Calilou Fall','Évaluation de la performance des programmes et gestion des données','assets/images/team/team-antoine.png',NULL,'Les données sont le carburant de l\'efficacité. Une analyse fine de la performance guide l\'amélioration continue de nos actions.','Antoine est responsable de l\'évaluation de la performance. Il collecte et analyse les données des programmes d\'ETAAM pour mesurer leur impact réel et orienter les prises de décision stratégiques.','Sa rigueur analytique permet à ETAAM d\'optimiser ses ressources et de maximiser son impact social.','#',NULL,NULL,'[{\"name\":\"Data Analysis\",\"percent\":\"95%\"},{\"name\":\"Suivi & \\u00c9valuation\",\"percent\":\"97%\"},{\"name\":\"Gestion de Donn\\u00e9es\",\"percent\":\"93%\"}]','[{\"school\":\"UGB Saint-Louis\",\"years\":\"2012 - 2015\",\"degree\":\"Master en Statistique et Informatique D\\u00e9cisionnelle\"}]','[{\"year\":\"2023\",\"text\":\"Certification Data Analyst\"},{\"year\":\"2020\",\"text\":\"Responsable Suivi-\\u00c9val. ONG\"}]',0,'2026-01-30 04:54:41'),(5,'Charles Auguste Diatta','Analyse des données, suivi-évaluation & aide à la décision','assets/images/team/team-charles.jpg',NULL,'L\'analyse de données ne consiste pas seulement à lire des chiffres, mais à entendre l\'histoire qu\'ils racontent pour mieux agir.','Charles Auguste est notre expert en analyse de données et aide à la décision. Il transforme les données complexes en insights exploitables pour optimiser l\'impact des projets d\'ETAAM.','Son travail est essentiel pour garantir que chaque décision prise est fondée sur des preuves tangibles et alignée sur les objectifs de durabilité.','#',NULL,NULL,'[{\"name\":\"Data Science\",\"percent\":\"96%\"},{\"name\":\"Aide \\u00e0 la D\\u00e9cision\",\"percent\":\"94%\"},{\"name\":\"Suivi-\\u00c9valuation\",\"percent\":\"95%\"}]','[{\"school\":\"UCAD Dakar\",\"years\":\"2013 - 2016\",\"degree\":\"Master en Math\\u00e9matiques Appliqu\\u00e9es\"}]','[{\"year\":\"2024\",\"text\":\"Publication : \'Big Data & Agriculture\'\"},{\"year\":\"2021\",\"text\":\"Chef de Projet Data Gouv\"}]',0,'2026-01-30 04:54:41'),(6,'Aissatou Diallo','Ingénieur Réseaux','assets/images/team/team-aissatou.png',NULL,'La connectivité est le socle sur lequel repose l\'économie numérique.','Aissatou conçoit et déploie les infrastructures réseaux robustes qui soutiennent les opérations d\'ETAAM et de ses clients. Elle est experte en solutions Cisco et en virtualisation.','Elle est également passionnée par l\'IoT et le déploiement de réseaux en zones rurales.','#',NULL,NULL,'[{\"name\":\"Cisco Networking\",\"percent\":\"95%\"},{\"name\":\"Virtualisation (VMware)\",\"percent\":\"92%\"},{\"name\":\"Cloud Infrastructure\",\"percent\":\"88%\"}]','[{\"school\":\"ESP Dakar\",\"years\":\"2013 - 2015\",\"degree\":\"DUT G\\u00e9nie T\\u00e9l\\u00e9com\"}]','[{\"year\":\"2024\",\"text\":\"Cisco CCNP Enterprise\"},{\"year\":\"2021\",\"text\":\"D\\u00e9ploiement r\\u00e9seau Campus Ziguinchor\"}]',0,'2026-01-30 04:54:41');
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `permissions` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ETAAM2026','$2y$10$ZoGQGKvZFR/DD0XMCt7O.eGe40vWrFTBTqxwUfxiJw2LUGTlrs/jW','admin','2026-01-31 09:04:07',NULL),(2,'Vincent Mendy','$2y$10$7fQp0AVmBhOhskL.1MCYieSnfKaLrEggKxjPQ69ua1HNUiLNor7y6','editor','2026-02-01 01:32:05','[]'),(3,'testuser','$2y$10$YfT/lVLUmofD4XO/JaiEIe.CqucZHGZ8BHjt4GQvDhHpWD9hWFxE.','editor','2026-02-01 01:41:06','[\"blog\",\"projects\"]');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-03  2:55:55
