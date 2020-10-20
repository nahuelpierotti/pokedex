CREATE DATABASE  IF NOT EXISTS `pokedex-pierotti-nahuel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pokedex-pierotti-nahuel`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pokedex-pierotti-nahuel
-- ------------------------------------------------------
-- Server version	8.0.20

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
-- Table structure for table `pkx_pokemones`
--

DROP TABLE IF EXISTS `pkx_pokemones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pkx_pokemones` (
  `numero` int NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` text,
  `tipo` int DEFAULT NULL,
  `imagen` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pkx_pokemones`
--

LOCK TABLES `pkx_pokemones` WRITE;
/*!40000 ALTER TABLE `pkx_pokemones` DISABLE KEYS */;
INSERT INTO `pkx_pokemones` VALUES (1,'Bulbasaur','Bulbasaur es un Pokémon de tipo planta/veneno introducido en la primera generación. Es uno de los Pokémon iniciales que pueden elegir los entrenadores que empiezan su aventura en la región Kanto, junto a Squirtle y Charmander (excepto en Pokémon Amarillo). Destaca por ser el primer Pokémon de la Pokédex Nacional.                             ',12,'Bulbasaur.png'),(4,'Charmander','Charmander es un Pokémon de tipo fuego introducido en la primera generación. Es uno de los Pokémon iniciales que pueden elegir los entrenadores que empiezan su aventura en la región Kanto, junto a Bulbasaur y Squirtle, excepto en Pokémon Amarillo y Pokémon: Let\'s Go, Pikachu! y Pokémon: Let\'s Go, Eevee!',7,'Charmander.png'),(9,'Blastoise','Blastoise es un Pokémon de tipo agua introducido en la primera generación. Es la evolución de Wartortle y, a partir de la sexta generación, puede megaevolucionar en Mega-Blastoise.',2,'Blastoise.png'),(10,'Caterpie','Caterpie es un Pokémon de tipo bicho introducido en la primera generación. Es la contraparte de Weedle.',3,'Caterpie.png'),(19,'Ratatta','Rattata es un Pokémon de tipo normal introducido en la primera generación. Es la forma habitual del Rattata de Alola.',11,'Rattata.png'),(24,'Arbok','Arbok es un Pokémon de tipo veneno introducido en la primera generación. Es la forma evolucionada de Ekans.',17,'Arbok.png');
/*!40000 ALTER TABLE `pkx_pokemones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pkx_tipos_pokemones`
--

DROP TABLE IF EXISTS `pkx_tipos_pokemones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pkx_tipos_pokemones` (
  `id_tipo` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pkx_tipos_pokemones`
--

LOCK TABLES `pkx_tipos_pokemones` WRITE;
/*!40000 ALTER TABLE `pkx_tipos_pokemones` DISABLE KEYS */;
INSERT INTO `pkx_tipos_pokemones` VALUES (1,'acero'),(2,'agua'),(3,'bicho'),(4,'dragon'),(5,'electrico'),(6,'fantasma'),(7,'fuego'),(8,'hada'),(9,'hielo'),(10,'lucha'),(11,'normal'),(12,'planta'),(13,'psiquico'),(14,'roca'),(15,'siniestro'),(16,'tierra'),(17,'veneno'),(18,'volador');
/*!40000 ALTER TABLE `pkx_tipos_pokemones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pkx_usuario`
--

DROP TABLE IF EXISTS `pkx_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pkx_usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(250) DEFAULT NULL,
  `perfil` int DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pkx_usuario`
--

LOCK TABLES `pkx_usuario` WRITE;
/*!40000 ALTER TABLE `pkx_usuario` DISABLE KEYS */;
INSERT INTO `pkx_usuario` VALUES (1,'npie','84109e98c1294406c993c27af1eb4ba7',1,'Nahuel'),(2,'facu','84109e98c1294406c993c27af1eb4ba7',1,'Facundo'),(3,'ale','84109e98c1294406c993c27af1eb4ba7',1,'Alejandro');
/*!40000 ALTER TABLE `pkx_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'pokedex-pierotti-nahuel'
--

--
-- Dumping routines for database 'pokedex-pierotti-nahuel'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-20 19:59:40
