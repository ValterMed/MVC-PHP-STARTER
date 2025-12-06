<?php

namespace App\Core;

use PDO;

/**
 * Clase DB
 * Gestiona la conexión a la base de datos usando el patrón Singleton
 */
class DB
{
    private static ?PDO $instance = null;

    /**
     * Obtiene la instancia única de conexión a la base de datos
     * 
     * @return PDO Instancia de conexión PDO
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            try {
                // Obtener variables de entorno del contenedor
                $host = getenv('DB_HOST') ?: 'mysql';
                $dbname = getenv('DB_NAME') ?: 'mvc-example';
                $user = getenv('DB_USER') ?: 'john_doe';
                $password = getenv('DB_PASSWORD') ?: 'securepassword';

                error_log("Conectando a BD: host=$host, db=$dbname, user=$user");

                self::$instance = new PDO(
                    "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
                    $user,
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
                    ]
                );

                error_log("Conexión a BD exitosa");
            } catch (\PDOException $e) {
                error_log("Error de BD: " . $e->getMessage());
                die('Error de conexión a la base de datos: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }

    /**
     * Previene la instanciación directa
     */
    private function __construct()
    {
    }

    /**
     * Previene la clonación de la instancia
     */
    private function __clone()
    {
    }

    /**
     * Previene la deserialización de la instancia
     */
    public function __wakeup()
    {
        throw new \Exception("No se puede deserializar una instancia de DB");
    }
}
