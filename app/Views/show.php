<?php
/**
 * Vista show.php
 * Muestra los detalles completos de un post individual
 * 
 * Variables disponibles:
 * @var array $post Datos del post
 */

// Función para formatear la fecha en español (sin intl)
function formatearFechaEspanol($fecha, $conHora = false) {
    $meses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];
    
    $timestamp = strtotime($fecha);
    $dia = (int) date('d', $timestamp);
    $mes = (int) date('m', $timestamp);
    $año = date('Y', $timestamp);
    $hora = date('H:i', $timestamp);
    
    if ($conHora) {
        return "Publicado el $dia / " . $meses[$mes] . " / $año a las $hora";
    }
    return "$dia / " . $meses[$mes] . " / $año";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlentities($post['title'], ENT_QUOTES, 'UTF-8'); ?> - Blog</title>
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
                    <h1><?php echo htmlentities($post['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
                    <small class="post-date">
                        <?php echo formatearFechaEspanol($post['created_at'], true); ?>
                    </small>
                </div>

                <div class="post-body">
                    <?php echo nl2br(htmlentities($post['body'], ENT_QUOTES, 'UTF-8')); ?>
                </div>

                <div class="post-meta">
                    <p><strong>ID del post:</strong> #<?php echo $post['id']; ?></p>
                    <?php if ($post['created_at'] !== $post['updated_at']): ?>
                        <p><strong>Última actualización:</strong> <?php echo formatearFechaEspanol($post['updated_at'], true); ?></p>
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