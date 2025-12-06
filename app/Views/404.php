<?php
/**
 * Vista 404.php
 * Muestra un mensaje cuando una página no se encuentra
 * 
 * Variables disponibles:
 * @var string $message Mensaje de error
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📝 Mi Blog</h1>
            <p class="subtitle">Bienvenido a mi blog personal</p>
        </header>

        <nav class="navbar">
            <a href="/">Inicio</a>
            <a href="/posts/create" class="btn-create">+ Crear Post</a>
        </nav>

        <main class="error-container">
            <div class="error-card">
                <h1 class="error-code">404</h1>
                <h2 class="error-title">Página no encontrada</h2>
                <p class="error-message">
                    <?php echo htmlentities($message ?? 'La página que buscas no existe o fue movida', ENT_QUOTES, 'UTF-8'); ?>
                </p>
                <a href="/" class="btn btn-primary">Volver al inicio</a>
            </div>
        </main>

        <footer>
            <p>&copy; 2024 MVC PHP Starter. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>