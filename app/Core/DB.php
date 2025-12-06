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
                self::$instance = new PDO(
                    'mysql:host=mysql;dbname=ejemplo-mvc-php;charset=utf8mb4',
                    'mvc_user',
                    'mvc_password',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (\PDOException $e) {
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