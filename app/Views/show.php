<?php
/**
 * Vista show.php
 * Muestra los detalles completos de un post individual
 * 
 * Variables disponibles:
 * @var array $post Datos del post
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - Blog</title>
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

        <main class="post-detail">
            <article class="post-full">
                <div class="post-header-detail">
                    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
                    <small class="post-date">
                        Publicado el <?php echo date('d de F de Y \a \l\a\s H:i', strtotime($post['created_at'])); ?>
                    </small>
                </div>

                <div class="post-body">
                    <?php echo nl2br(htmlspecialchars($post['body'])); ?>
                </div>

                <div class="post-meta">
                    <p><strong>ID del post:</strong> #<?php echo $post['id']; ?></p>
                    <?php if ($post['created_at'] !== $post['updated_at']): ?>
                        <p><strong>Última actualización:</strong> <?php echo date('d/m/Y H:i', strtotime($post['updated_at'])); ?></p>
                    <?php endif; ?>
                </div>

                <div class="post-actions-detail">
                    <a href="/" class="btn btn-secondary">← Volver al inicio</a>
                </div>
            </article>
        </main>

        <footer>
            <p>&copy; 2024 MVC PHP Starter. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>