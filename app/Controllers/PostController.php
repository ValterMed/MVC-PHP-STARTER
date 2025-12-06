<?php

namespace App\Controllers;

use App\Models\Post;

/**
 * Clase PostController
 * Controla las acciones relacionadas con los posts
 */
class PostController
{
    private Post $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    /**
     * Acción index: muestra todos los posts
     * Ruta: GET /
     */
    public function index(): void
    {
        $posts = $this->post->all();
        $this->render('home', ['posts' => $posts]);
    }

    /**
     * Acción show: muestra un post específico
     * Ruta: GET /posts/show?id=5
     */
    public function show(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            http_response_code(404);
            $this->render('404', ['message' => 'Post no encontrado']);
            return;
        }

        $post = $this->post->getById((int)$id);

        if (!$post) {
            http_response_code(404);
            $this->render('404', ['message' => 'Post no encontrado']);
            return;
        }

        $this->render('show', ['post' => $post]);
    }

    /**
     * Acción create: muestra el formulario para crear un post
     * Ruta: GET /posts/create
     */
    public function create(): void
    {
        $this->render('create');
    }

    /**
     * Acción store: guarda un nuevo post en la base de datos
     * Ruta: POST /posts/store
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            return;
        }

        $title = $_POST['title'] ?? '';
        $body = $_POST['body'] ?? '';

        // Validación simple
        if (empty($title) || empty($body)) {
            $_SESSION['error'] = 'El título y el cuerpo son requeridos';
            header('Location: /posts/create');
            return;
        }

        // Sanitización básica
        $title = htmlspecialchars(trim($title));
        $body = htmlspecialchars(trim($body));

        if ($this->post->create($title, $body)) {
            $_SESSION['success'] = 'Post creado exitosamente';
            header('Location: /');
            exit();
        } else {
            $_SESSION['error'] = 'Error al crear el post';
            header('Location: /posts/create');
            exit();
        }
    }

    /**
     * Renderiza una vista con datos
     * 
     * @param string $view Nombre de la vista a renderizar
     * @param array $data Datos a pasar a la vista
     */
    private function render(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . "/../Views/{$view}.php";
    }
}