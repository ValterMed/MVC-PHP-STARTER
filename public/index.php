<?php
/**
 * public/index.php
 * Punto de entrada principal de la aplicación
 * Gestiona el enrutamiento de URLs hacia los controladores
 */

// Establecer charset a UTF-8 antes de enviar cualquier contenido
header('Content-Type: text/html; charset=utf-8');

// Iniciar sesión
session_start();

// Autoloading de clases con Composer
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\PostController;

// Obtener la ruta solicitada
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Remover barra inicial si existe
$path = ltrim($path, '/');

// Separar la ruta en segmentos
$segments = explode('/', $path);

// Router simple
$controller = new PostController();

try {
    if (empty($path) || $path === '') {
        // Ruta: GET /
        // Acción: Ver todos los posts
        $controller->index();
    } elseif ($segments[0] === 'posts') {
        if ($segments[1] === 'create' && $method === 'GET') {
            // Ruta: GET /posts/create
            // Acción: Mostrar formulario de creación
            $controller->create();
        } elseif ($segments[1] === 'show' && isset($_GET['id'])) {
            // Ruta: GET /posts/show?id=5
            // Acción: Ver un post específico
            $controller->show();
        } elseif ($segments[1] === 'store' && $method === 'POST') {
            // Ruta: POST /posts/store
            // Acción: Guardar nuevo post
            $controller->store();
        } else {
            // Ruta no encontrada
            http_response_code(404);
            $message = 'La ruta solicitada no existe';
            include __DIR__ . '/../app/Views/404.php';
        }
    } else {
        // Ruta no encontrada
        http_response_code(404);
        $message = 'La ruta solicitada no existe';
        include __DIR__ . '/../app/Views/404.php';
    }
} catch (Exception $e) {
    http_response_code(500);
    echo '<h1>Error interno del servidor</h1>';
    echo '<p>' . htmlentities($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
    if (ini_get('display_errors')) {
        echo '<pre>' . htmlentities($e->getTraceAsString(), ENT_QUOTES, 'UTF-8') . '</pre>';
    }
}