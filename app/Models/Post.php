<?php

namespace App\Models;

use App\Core\DB;
use PDO;

/**
 * Clase Post
 * Encapsula la lógica de acceso a datos para la tabla posts
 */
class Post
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    /**
     * Obtiene todos los posts de la base de datos
     * 
     * @return array Array de posts
     */
    public function all(): array
    {
        $query = $this->db->prepare('SELECT * FROM posts ORDER BY created_at DESC');
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Obtiene un post específico por su ID
     * 
     * @param int $id ID del post a obtener
     * @return array|false Array con los datos del post o false si no existe
     */
    public function getById(int $id): array|false
    {
        $query = $this->db->prepare('SELECT * FROM posts WHERE id = :id');
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    /**
     * Crea un nuevo post en la base de datos
     * 
     * @param string $title Título del post
     * @param string $body Cuerpo del post
     * @return bool True si se creó exitosamente
     */
    public function create(string $title, string $body): bool
    {
        $query = $this->db->prepare('INSERT INTO posts (title, body) VALUES (:title, :body)');
        return $query->execute([
            'title' => $title,
            'body' => $body
        ]);
    }

    /**
     * Actualiza un post existente
     * 
     * @param int $id ID del post a actualizar
     * @param string $title Nuevo título
     * @param string $body Nuevo cuerpo
     * @return bool True si se actualizó exitosamente
     */
    public function update(int $id, string $title, string $body): bool
    {
        $query = $this->db->prepare('UPDATE posts SET title = :title, body = :body WHERE id = :id');
        return $query->execute([
            'id' => $id,
            'title' => $title,
            'body' => $body
        ]);
    }

    /**
     * Elimina un post
     * 
     * @param int $id ID del post a eliminar
     * @return bool True si se eliminó exitosamente
     */
    public function delete(int $id): bool
    {
        $query = $this->db->prepare('DELETE FROM posts WHERE id = :id');
        return $query->execute(['id' => $id]);
    }
}