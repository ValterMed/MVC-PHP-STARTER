-- Establecer el charset de la conexión a UTF-8
SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Configurar la base de datos con charset utf8mb4
ALTER DATABASE `mvc-example` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Crear tabla posts con charset utf8mb4
CREATE TABLE IF NOT EXISTS `posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos de ejemplo con acentos
INSERT INTO `posts` (`title`, `body`) VALUES 
('Título 1', 'Este es el cuerpo del primer post con más contenido para que sea más realista y se vea bien en la página.'),
('Título 2', 'Este es el cuerpo del segundo post con información relevante sobre el tema que queremos compartir.'),
('Título 3', 'Este es el cuerpo del tercer post con detalles importantes para nuestros lectores.'),
('Título 4', 'Este es el cuerpo del cuarto post con consejos útiles y prácticos para el día a día.'),
('Título 5', 'Este es el cuerpo del quinto post con conclusiones y reflexiones finales sobre el tema.');