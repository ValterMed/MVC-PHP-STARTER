-- Crear schema si no existe
CREATE SCHEMA IF NOT EXISTS `ejemplo-mvc-php`;

-- Usar la base de datos
USE `ejemplo-mvc-php`;

-- Crear tabla posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `body` LONGTEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos de ejemplo
INSERT INTO `posts` (`title`, `body`) VALUES ('Titulo 1', 'Este es el cuerpo del primer post con más contenido para que sea más realista y se vea bien en la página.');
INSERT INTO `posts` (`title`, `body`) VALUES ('Titulo 2', 'Este es el cuerpo del segundo post con información relevante sobre el tema que queremos compartir.');
INSERT INTO `posts` (`title`, `body`) VALUES ('Titulo 3', 'Este es el cuerpo del tercer post con detalles importantes para nuestros lectores.');
INSERT INTO `posts` (`title`, `body`) VALUES ('Titulo 4', 'Este es el cuerpo del cuarto post con consejos útiles y prácticos para el día a día.');
INSERT INTO `posts` (`title`, `body`) VALUES ('Titulo 5', 'Este es el cuerpo del quinto post con conclusiones y reflexiones finales sobre el tema.');