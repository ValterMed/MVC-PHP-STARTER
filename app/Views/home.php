<?php
/**
 * Vista home.php
 * Muestra la lista de todos los posts
 * 
 * Variables disponibles:
 * @var array $posts Lista de posts
 */

// Función para formatear la fecha en español (sin intl)
function formatearFechaEspanol($fecha) {
    $meses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];
    
    $timestamp = strtotime($fecha);
    $dia = (int) date('d', $timestamp);
    $mes = (int) date('m', $timestamp);
    $año = date('Y', $timestamp);
    
    return "$dia / " . $meses[$mes] . " / $año";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - MVC PHP Starter</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📝 Mi Blog</h1>
            <p class="subtitle">Bienvenido a mi blog personal</p>
        </header>

        <nav class="navbar">
            <a href="/" class="active">Inicio</a>
            <a href="/posts/create" class="btn-create">+ Crear Post</a>
        </nav>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo htmlentities($_SESSION['success'], ENT_QUOTES, 'UTF-8'); ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php echo htmlentities($_SESSION['error'], ENT_QUOTES, 'UTF-8'); ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <main class="posts-container">
            <?php if (empty($posts)): ?>
                <div class="no-posts">
                    <p>No hay posts disponibles</p>
                    <a href="/posts/create" class="btn btn-primary">Crear el primer post</a>
                </div>
            <?php else: ?>
                <div class="posts-grid">
                    <?php foreach ($posts as $post): ?>
                        <article class="post-card">
                            <div class="post-header">
                                <h2 class="post-title">
                                    <?php echo htmlentities($post['title'], ENT_QUOTES, 'UTF-8'); ?>
                                </h2>
                                <small class="post-date">
                                    <?php echo formatearFechaEspanol($post['created_at']); ?>
                                </small>
                            </div>
                            <p class="post-excerpt">
                                <?php
                                $excerpt = substr($post['body'], 0, 150);
                                echo htmlentities($excerpt, ENT_QUOTES, 'UTF-8');
                                if (strlen($post['body']) > 150) {
                                    echo '...';
                                }
                                ?>
                            </p>
                            <div class="post-actions">
                                <a href="/posts/show?id=<?php echo $post['id']; ?>" class="btn btn-primary">
                                    Leer más
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>

        <footer>
            <p>&copy; 2024 MVC PHP Starter. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>