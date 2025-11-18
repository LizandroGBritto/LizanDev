# LizanDev Portfolio 🚀

Portfolio personal desarrollado con Laravel 12, Livewire 3 y Tailwind CSS.

## 🛠️ Stack Tecnológico

-   **Backend**: Laravel 12 + PHP 8.2
-   **Frontend**: Livewire 3 + Alpine.js
-   **Estilos**: Tailwind CSS v4
-   **Build Tool**: Vite

## 📋 Requisitos

-   PHP 8.2+
-   Composer
-   Node.js 18+
-   NPM

## 🚀 Instalación

```bash
# Clonar el repositorio
git clone https://github.com/tu-usuario/lizandev.git
cd lizandev

# Instalar dependencias de PHP
composer install

# Instalar dependencias de Node
npm install

# Copiar archivo de entorno
cp .env.example .env

# Generar key de aplicación
php artisan key:generate

# Ejecutar migraciones (si las hay)
php artisan migrate

# Compilar assets
npm run build
```

## 💻 Desarrollo

```bash
# Servidor de desarrollo Laravel
php artisan serve

# Compilación en tiempo real de assets
npm run dev
```

Accede a: `http://localhost:8000/LizanDev`

## 🎨 Componentes Livewire

El proyecto está estructurado de forma modular:

-   `Hero`: Sección principal con presentación
-   `About`: Información personal y experiencia
-   `Skills`: Habilidades técnicas con barras de progreso
-   `Projects`: Portafolio de proyectos destacados
-   `Contact`: Formulario de contacto con validación

## 📦 Deployment

### Railway (Recomendado - Gratis)

1. Crear cuenta en [Railway.app](https://railway.app)
2. Conectar tu repositorio de GitHub
3. Railway detectará automáticamente Laravel
4. Configurar variables de entorno
5. Deploy automático

### Fly.io (Alternativa)

```bash
# Instalar Fly CLI
curl -L https://fly.io/install.sh | sh

# Iniciar sesión
fly auth login

# Lanzar aplicación
fly launch

# Deploy
fly deploy
```

## 🔧 Personalización

### Datos Personales

Edita los componentes en `app/Livewire/Portfolio/`:

-   `Hero.php`: Nombre, rol, descripción
-   `About.php`: Biografía y experiencia
-   `Skills.php`: Tecnologías y niveles
-   `Projects.php`: Proyectos destacados
-   `Contact.php`: Email y ubicación

### Estilos

Los colores principales están en Tailwind:

-   Primary: `purple-500` → `purple-600`
-   Accent: `pink-500` → `pink-600`

## 📄 Licencia

MIT License - siéntete libre de usar este código para tu propio portfolio.

## 👨‍💻 Autor

**Tu Nombre**

-   GitHub: [@tuusuario](https://github.com/tuusuario)
-   LinkedIn: [Tu Perfil](https://linkedin.com/in/tuperfil)
-   Email: tu@email.com

---

⭐ Si te gusta este proyecto, no olvides darle una estrella en GitHub

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
