<?php
/**
 * Vista create.php
 * Muestra el formulario para crear un nuevo post
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear nuevo post - Blog</title>
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
            <a href="/posts/create" class="active">+ Crear Post</a>
        </nav>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php echo htmlentities($_SESSION['error'], ENT_QUOTES, 'UTF-8'); ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <main class="form-container">
            <div class="form-card">
                <h2>Crear nuevo post</h2>

                <form method="POST" action="/posts/store" class="form">
                    <div class="form-group">
                        <label for="title">Título *</label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            class="form-input"
                            placeholder="Ingresa el título del post"
                            required
                            maxlength="255"
                        >
                        <small class="form-help">Máximo 255 caracteres</small>
                    </div>

                    <div class="form-group">
                        <label for="body">Contenido *</label>
                        <textarea 
                            id="body" 
                            name="body" 
                            class="form-textarea"
                            placeholder="Escribe el contenido del post aquí..."
                            required
                            rows="10"
                        ></textarea>
                        <small class="form-help">Escribe el contenido completo del post</small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Guardar Post</button>
                        <a href="/" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>

        <footer>
            <p>&copy; 2024 MVC PHP Starter. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>