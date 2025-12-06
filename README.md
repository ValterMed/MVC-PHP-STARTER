# MVC-PHP-STARTER

Una aplicación de blog simple construida con patrón MVC en PHP puro sin framework. Perfecta para aprender los conceptos fundamentales de arquitectura MVC.

## 🎯 Características

- ✅ Patrón MVC implementado desde cero
- ✅ Sin dependencias de framework PHP (solo Composer para autoloading)
- ✅ Docker para aislamiento completo (PHP, Nginx, MySQL)
- ✅ Sistema de rutas personalizado
- ✅ CRUD básico de posts
- ✅ Inyección de dependencias
- ✅ Diseño responsive con CSS moderno
- ✅ Validación y sanitización de datos
- ✅ Soporte completo UTF-8 para caracteres especiales y acentos

## 📋 Requisitos

- Docker
- Docker Compose

No necesitas instalar PHP, Nginx o MySQL en tu máquina.

## 🚀 Instalación

1. **Clonar o descargar el proyecto**

```bash
git clone <url-del-repositorio>
cd MVC-PHP-STARTER
```

2. **Iniciar los contenedores**

```bash
docker-compose up -d
```

Esto iniciará 3 contenedores:
- **PHP-FPM**: Motor de PHP
- **Nginx**: Servidor web
- **MySQL**: Base de datos

3. **Instalar dependencias de Composer**

```bash
docker-compose exec php composer install
```

4. **Acceder a la aplicación**

Abre tu navegador en: http://localhost:8080

## 📁 Estructura del Proyecto

```
MVC-PHP-STARTER/
├── app/
│   ├── Controllers/
│   │   └── PostController.php      # Controlador de posts
│   ├── Core/
│   │   └── DB.php                  # Conexión a BD (Singleton)
│   ├── Models/
│   │   └── Post.php                # Modelo de posts
│   └── Views/
│       ├── home.php                # Lista de posts
│       ├── show.php                # Detalle de post
│       ├── create.php              # Formulario de creación
│       └── 404.php                 # Página de error
├── public/
│   ├── index.php                   # Punto de entrada (router)
│   ├── css/
│   │   └── style.css               # Estilos de la app
│   └── js/
├── composer.json                   # Configuración de Composer
├── docker-compose.yml              # Configuración Docker
├── Dockerfile.php                  # Imagen Docker de PHP
├── nginx.conf                      # Configuración Nginx
├── php.ini                         # Configuración PHP (charset UTF-8)
├── mysql-custom.cnf                # Configuración MySQL (UTF-8)
├── init.sql                        # Script de inicialización BD
└── README.md                       # Este archivo
```

## 🛣️ Rutas de la Aplicación

| Método | Ruta | Acción | Descripción |
|--------|------|--------|-------------|
| GET | `/` | `index()` | Ver todos los posts |
| GET | `/posts/create` | `create()` | Mostrar formulario de creación |
| POST | `/posts/store` | `store()` | Guardar nuevo post |
| GET | `/posts/show?id=5` | `show()` | Ver detalle de un post |

## 💡 Flujo de la Aplicación

### Mostrar todos los posts (GET /)

1. Se hace petición a `/`
2. **index.php** (router) identifica la ruta
3. Se instancia `PostController`
4. Se llama método `index()`
5. El controlador instancia `Post` (modelo)
6. Llama `Post::all()` para obtener posts de BD
7. Carga vista `home.php` pasando los posts
8. La vista renderiza el HTML y lo envía al navegador

### Crear un nuevo post

1. GET `/posts/create` → muestra formulario en `create.php`
2. POST `/posts/store` → procesa el formulario
3. Validación y sanitización de datos
4. Se llama `Post::create()` para guardar en BD
5. Redirección a `/` con mensaje de éxito

### Ver detalle de un post (GET /posts/show?id=5)

1. Se hace petición con parámetro `id`
2. Controlador valida que el ID sea numérico
3. Llama `Post::getById(5)`
4. Renderiza `show.php` con los datos del post

## 🗄️ Base de Datos

### Credenciales

- **Host**: mysql (desde contenedores) / localhost (desde tu máquina)
- **Puerto**: 3306
- **Base de datos**: ejemplo-mvc-php
- **Usuario**: mvc_user
- **Contraseña**: mvc_password
- **Root password**: rootpassword

### Tabla posts

```sql
CREATE TABLE posts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  body LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

**Nota**: La base de datos está configurada con `utf8mb4` para soportar correctamente acentos, emojis y caracteres especiales.

## 🐳 Comandos Docker Útiles

```bash
# Ver logs
docker-compose logs -f php
docker-compose logs -f nginx
docker-compose logs -f mysql

# Acceder a PHP CLI
docker-compose exec php bash

# Acceder a MySQL CLI
docker-compose exec mysql mysql -u mvc_user -pmvc_password -D ejemplo-mvc-php

# Detener contenedores
docker-compose down

# Eliminar todo (incluyendo BD)
docker-compose down -v

# Reconstruir contenedores
docker-compose build --no-cache
docker-compose up -d
```

## 📚 Conceptos MVC Aplicados

### Model (Modelo)
El archivo `app/Models/Post.php` encapsula la lógica de acceso a datos:
- `all()` - Obtiene todos los registros
- `getById()` - Obtiene un registro específico
- `create()` - Inserta nuevo registro
- `update()` - Actualiza un registro
- `delete()` - Elimina un registro

### View (Vista)
Archivos HTML en `app/Views/`:
- `home.php` - Lista de posts
- `show.php` - Detalle de post
- `create.php` - Formulario
- `404.php` - Error

### Controller (Controlador)
`app/Controllers/PostController.php` coordina:
- Recepciona las peticiones HTTP
- Llama al modelo para obtener datos
- Carga la vista correspondiente
- Valida y sanitiza datos

## 🔐 Buenas Prácticas Implementadas

✅ **Inyección de Dependencias**: Los controladores no crean directamente sus dependencias
✅ **Separación de responsabilidades**: Cada capa tiene su función
✅ **Autoloading PSR-4**: Composer carga automáticamente las clases
✅ **Patrón Singleton**: Una única conexión a BD
✅ **Sanitización XSS**: `htmlentities()` con UTF-8 previene XSS
✅ **Consultas preparadas**: PDO prepared statements contra SQL injection
✅ **Validación**: Datos validados antes de ser procesados
✅ **Enrutamiento**: Sistema de rutas simple y escalable
✅ **Codificación UTF-8**: Configuración completa en PHP, MySQL y vistas para caracteres especiales  

## 📝 Próximas Mejoras Posibles

- Agregar más modelos
- Implementar autenticación
- Agregar paginación
- Validación más robusta con clases
- Sistema de middlewares
- API REST
- Tests unitarios con PHPUnit

## 📄 Licencia

Libre para usar como base para aprendizaje

## 👨‍💻 Contribuciones

Este es un proyecto educativo. ¡Siéntete libre de adaptarlo a tus necesidades!

---

**Creado con ❤️ para aprender MVC en PHP**