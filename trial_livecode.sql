CREATE DATABASE `trial_livecode` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
-- trial_livecode.tugas definition

CREATE TABLE `tugas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` enum('Sedang Dikerjakan','Belum Selesai','Selesai','Cancelled') DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;