a-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: forcegym
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.10-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `cduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `nome` text NOT NULL,
  `email` text NOT NULL,
  `senha` text NOT NULL,
  PRIMARY KEY (`cduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_form`
--

DROP TABLE IF EXISTS `user_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_form` (
  `cd_userform` int(11) NOT NULL AUTO_INCREMENT,
  `cduser` int(11) NOT NULL,
  `SN_saude_preexistente` int(1) NOT NULL,
  `SN_lesao_cirurgia` int(1) NOT NULL,
  `SN_restricao_medica` int(1) NOT NULL,
  `SN_uso_medicacao` int(1) NOT NULL,
  `SN_alergia_medicamento` int(1) NOT NULL,
  `SN_episodios_exercicios` int(1) NOT NULL,
  `SN_autorizacao_medica_fisica` int(1) NOT NULL,
  `DS_objetivo` text NOT NULL,
  `DS_saude_preexistente` text DEFAULT NULL,
  `DS_lesao_cirurgia` text DEFAULT NULL,
  `DS_restricao_medica` text DEFAULT NULL,
  `DS_uso_medicacao` text DEFAULT NULL,
  `DS_alergia_medicamento` text DEFAULT NULL,
  `DS_episodios_exercicios` text DEFAULT NULL,
  `DS_autorizacao_medica_fisica` text DEFAULT NULL,
  `nome` text NOT NULL,
  `sobrenome` text NOT NULL,
  `dt_nascimento` date NOT NULL,
  `cpf` text NOT NULL,
  `telefone` text NOT NULL,
  `telefone2` text NOT NULL,
  `endereco` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`cd_userform`),
  KEY `user_form_user_FK` (`cduser`),
  CONSTRAINT `user_form_user_FK` FOREIGN KEY (`cduser`) REFERENCES `user` (`cduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_form`
--

LOCK TABLES `user_form` WRITE;
/*!40000 ALTER TABLE `user_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_mensalidade`
--

DROP TABLE IF EXISTS `user_mensalidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_mensalidade` (
  `cd_usermensalidade` int(11) NOT NULL AUTO_INCREMENT,
  `cduser` int(11) NOT NULL,
  `dt_competencia` date NOT NULL,
  `vl_mensalidade` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cd_usermensalidade`),
  KEY `user_form_user_FK` (`cduser`) USING BTREE,
  CONSTRAINT `user_form_user_FK_copy` FOREIGN KEY (`cduser`) REFERENCES `user` (`cduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_mensalidade`
--

LOCK TABLES `user_mensalidade` WRITE;
/*!40000 ALTER TABLE `user_mensalidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_mensalidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'forcegym'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-15 16:41:49
