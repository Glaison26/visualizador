-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para visualizador
CREATE DATABASE IF NOT EXISTS `visualizador` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `visualizador`;

-- Copiando estrutura para tabela visualizador.prescricoes
CREATE TABLE IF NOT EXISTS `prescricoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_setor` int DEFAULT NULL,
  `descritivo` varchar(180) DEFAULT NULL,
  `caminho` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_prescricoes_setores` (`id_setor`),
  CONSTRAINT `FK_prescricoes_setores` FOREIGN KEY (`id_setor`) REFERENCES `setores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela visualizador.prescricoes: ~1 rows (aproximadamente)
INSERT INTO `prescricoes` (`id`, `data`, `hora`, `id_setor`, `descritivo`, `caminho`) VALUES
	(1, '2026-03-11', '15:47:00', 3, 'teste', '../uploads/LOGO SÁ CHICA.pdf');

-- Copiando estrutura para tabela visualizador.setores
CREATE TABLE IF NOT EXISTS `setores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela visualizador.setores: ~0 rows (aproximadamente)
INSERT INTO `setores` (`id`, `descricao`) VALUES
	(1, 'Administração'),
	(2, 'Controle'),
	(3, 'Planejamento'),
	(4, 'Fazenda');

-- Copiando estrutura para tabela visualizador.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `login` varchar(40) DEFAULT NULL,
  `id_setor` int DEFAULT NULL,
  `tipo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  `senha` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usuario_setores` (`id_setor`),
  CONSTRAINT `FK_usuario_setores` FOREIGN KEY (`id_setor`) REFERENCES `setores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela visualizador.usuario: ~0 rows (aproximadamente)
INSERT INTO `usuario` (`id`, `nome`, `login`, `id_setor`, `tipo`, `ativo`, `senha`) VALUES
	(1, 'Jose Maria', 'Jose.Maria', 3, 'Administrador', 'S', 'U2FiYXJhQDIwMjY='),
	(2, 'teste', 'teste', 2, 'Visualizador', 'S', 'U2FiYXJhQDIwMjY='),
	(3, 'Glaison Queiroz', 'Glaison', 3, 'Administrador', 'S', 'U2FiYXJhQDIwMjY=');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
