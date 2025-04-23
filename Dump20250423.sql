CREATE DATABASE  IF NOT EXISTS `ocorrencias_eeep` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ocorrencias_eeep`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ocorrencias_eeep
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alunos`
--

DROP TABLE IF EXISTS `alunos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alunos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `curso_id` bigint(20) unsigned NOT NULL,
  `turma_id` bigint(20) unsigned NOT NULL,
  `senha` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alunos_email_unique` (`email`),
  KEY `alunos_curso_id_foreign` (`curso_id`),
  KEY `alunos_turma_id_foreign` (`turma_id`),
  CONSTRAINT `alunos_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `alunos_turma_id_foreign` FOREIGN KEY (`turma_id`) REFERENCES `turmas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alunos`
--

LOCK TABLES `alunos` WRITE;
/*!40000 ALTER TABLE `alunos` DISABLE KEYS */;
INSERT INTO `alunos` VALUES (3,'ana mariia','ana@gmail.com','88997981269',1,16,'$2y$10$lfstyaUoN5H4LN.eIUd0JO3MtSBEhuVGeeb1r12kfm/b47CUpQezK','2025-04-13 16:55:43','2025-04-13 16:55:43'),(4,'carlos','carlos@gmail.com','88997981269',2,19,'$2y$10$hqgEB4UkExrU6X/hQZHK1.4NQf6E7wTYOhAmqZKbyGGr//pYRh7aC','2025-04-13 16:56:20','2025-04-13 16:56:20'),(5,'isaac','isaac.peixoto@aluno.ce.gov.br','88997981269',3,22,'$2y$10$d2wfopSPrHjqxboDRFZhMunJrk4OBa4J7R6NiUdq.DSZGV3pDMgkK','2025-04-13 16:56:42','2025-04-13 16:56:42'),(6,'sara','samaria@gmail.com','88997981269',4,25,'$2y$10$F/V4AO/IUPwIwaOCRJb65uyjNH9cA3R081L8HpMa9EextDv6EG.zS','2025-04-13 16:57:03','2025-04-13 16:57:03'),(7,'maria luiza','maria@gmail.com','88997981269',1,16,'$2y$10$4hg2gJpvgNrQH9umiB388O6cUEWDJtM8g9FQtAm5pCMFkbL43aNUS','2025-04-19 12:03:40','2025-04-19 12:03:40'),(8,'sara','sara@gmail.com','88997981269',1,16,'$2y$10$PKkrsePdhueZVlF2CMv5ieLe5vNUa6hCMM/qRVsfUSFE4ry5tB2Pq','2025-04-19 12:03:56','2025-04-19 12:03:56'),(9,'sergio','serg@gmail.com','88997981269',1,16,'$2y$10$egPo9UctXZHBED5nv1TaeOQnvelsCnFVEidi2xZgA0h4czdtldIVm','2025-04-19 12:04:15','2025-04-19 12:04:15');
/*!40000 ALTER TABLE `alunos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cursos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (1,'ADMINISTRAÇÃO','2025-04-12 22:17:32','2025-04-12 22:17:32'),(2,'ENFERMAGEM','2025-04-12 22:17:41','2025-04-12 22:17:41'),(3,'INFORMÁTICA','2025-04-12 22:17:48','2025-04-12 22:17:48'),(4,'NUTRIÇÃO','2025-04-12 22:17:55','2025-04-12 22:17:55');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_04_12_100009_create_usuarios_table',1),(6,'2025_04_12_182014_create_cursos_table',1),(7,'2025_04_12_185150_create_turmas_table',1),(8,'2025_04_12_200051_create_alunos_table',2),(9,'2025_04_15_092218_create_motivos_ocorrencias_table',3),(10,'2025_04_15_092604_create_ocorrencias_table',3),(11,'2025_04_18_191701_add_hora_to_ocorrencias_table',4),(12,'2025_04_18_195332_add_gravidade_to_motivos_ocorrencias_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motivos_ocorrencias`
--

DROP TABLE IF EXISTS `motivos_ocorrencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `motivos_ocorrencias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gravidade` enum('leve','média','grave') NOT NULL DEFAULT 'leve',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motivos_ocorrencias`
--

LOCK TABLES `motivos_ocorrencias` WRITE;
/*!40000 ALTER TABLE `motivos_ocorrencias` DISABLE KEYS */;
INSERT INTO `motivos_ocorrencias` VALUES (1,'Atraso','2025-04-18 23:14:51','2025-04-18 23:14:51','leve'),(2,'celular','2025-04-19 00:20:40','2025-04-19 00:20:40','grave'),(3,'não fez a atividade','2025-04-19 14:03:46','2025-04-19 14:03:46','média');
/*!40000 ALTER TABLE `motivos_ocorrencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocorrencias`
--

DROP TABLE IF EXISTS `ocorrencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ocorrencias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `aluno_id` bigint(20) unsigned NOT NULL,
  `motivo_id` bigint(20) unsigned NOT NULL,
  `descricao` text DEFAULT NULL,
  `data` date NOT NULL,
  `tipo` varchar(255) NOT NULL DEFAULT 'leve',
  `status` varchar(255) NOT NULL DEFAULT 'pendente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ocorrencias_aluno_id_foreign` (`aluno_id`),
  KEY `ocorrencias_motivo_id_foreign` (`motivo_id`),
  CONSTRAINT `ocorrencias_aluno_id_foreign` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ocorrencias_motivo_id_foreign` FOREIGN KEY (`motivo_id`) REFERENCES `motivos_ocorrencias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocorrencias`
--

LOCK TABLES `ocorrencias` WRITE;
/*!40000 ALTER TABLE `ocorrencias` DISABLE KEYS */;
INSERT INTO `ocorrencias` VALUES (4,5,2,'DDD','2025-04-21','grave','pendente','2025-04-20 07:08:51','2025-04-23 12:22:19',NULL),(5,3,1,'DDD','2025-04-21','leve','pendente','2025-04-20 07:09:12','2025-04-20 07:09:12',NULL),(6,3,1,'ASSDDDD','2025-04-23','leve','pendente','2025-04-20 07:09:34','2025-04-20 07:09:34',NULL),(7,3,3,'dddd','2025-04-20','média','pendente','2025-04-21 02:28:47','2025-04-21 02:28:47',NULL),(8,9,1,'asd','2025-04-23','leve','pendente','2025-04-23 12:02:08','2025-04-23 12:02:08',NULL);
/*!40000 ALTER TABLE `ocorrencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turmas`
--

DROP TABLE IF EXISTS `turmas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turmas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `curso_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `turmas_curso_id_foreign` (`curso_id`),
  CONSTRAINT `turmas_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turmas`
--

LOCK TABLES `turmas` WRITE;
/*!40000 ALTER TABLE `turmas` DISABLE KEYS */;
INSERT INTO `turmas` VALUES (16,'1º ANO',1,'2025-04-13 16:53:12','2025-04-13 16:53:12'),(17,'2º ANO',1,'2025-04-13 16:53:20','2025-04-13 16:53:20'),(18,'3º ANO',1,'2025-04-13 16:53:33','2025-04-13 16:53:33'),(19,'1º ANO',2,'2025-04-13 16:53:42','2025-04-13 16:53:42'),(20,'2º ANO',2,'2025-04-13 16:54:10','2025-04-13 16:54:10'),(21,'3º ANO',2,'2025-04-13 16:54:19','2025-04-13 16:54:19'),(22,'1º ANO',3,'2025-04-13 16:54:27','2025-04-13 16:54:27'),(23,'2º ANO',3,'2025-04-13 16:54:34','2025-04-13 16:54:34'),(24,'3º ANO',3,'2025-04-13 16:54:41','2025-04-13 16:54:41'),(25,'1º ANO',4,'2025-04-13 16:54:50','2025-04-13 16:54:50'),(26,'2º ANO',4,'2025-04-13 16:54:58','2025-04-13 16:54:58'),(27,'3º ANO',4,'2025-04-13 16:55:06','2025-04-13 16:55:06');
/*!40000 ALTER TABLE `turmas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `tipo` enum('administrador','diretor','coordenador','professor','professor_diretor_turma','aluno') NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,'Administrador','sergio@gmail.com','$2y$10$brbCBBen1CN0ycRCaJOEseoT0qpU86rGcDLqDoXbJ6Oml/epmWwu.','88997981269','administrador','fotos/i6xtDeu5Q6pK73qSS42b3vdSgnidsHgJEHbfQIZM.jpg','2025-04-13 13:57:35','2025-04-13 14:00:37'),(3,'Plácido Bezeera','placido@gmail.com','$2y$10$Ihc3yKkG42vewiAyiEhp/OMQHikWJjVgzJstXYelMH3B6TunlcHxu','88997981269','diretor','fotos/vIVaB2AtkUKdLRxflYcPf3Cr7Jk7oyTEdslvtWGK.jpg','2025-04-13 13:59:31','2025-04-19 14:23:35');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-23  6:34:13
