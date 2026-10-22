# LizanDev

@~/documentacion/convenciones.md

Portafolio personal de Lizandro Britto: una sola página (landing) en Laravel + Livewire,
bilingüe es/en. **No es un proyecto de cliente ni pertenece a ninguna familia de la agencia**:
no hay motor, ni panel, ni base de datos propia, ni medios de pago.

## Base

- Laravel 12 / PHP 8.2 (`^8.2`), Livewire 3.6, Tailwind 4 vía `@tailwindcss/vite`, Vite 7.
- Modelos en `app/Models/` — solo el `User.php` del esqueleto, sin uso. No hay migraciones
  propias: las tres de `database/migrations/` son las de Laravel (users, cache, jobs).
- Medios de pago: ninguno. Nutrición: no existe. Panel: no existe (H-071 no aplica).
- Herramientas: scripts de `composer.json` del esqueleto (`composer dev` levanta server +
  queue + pail + vite). `laravel/pint` instalado sin configuración propia.
- **PHP en esta máquina:** el `php` del PATH es 7.4 y no arranca el proyecto. Usar el de
  Laragon, `C:\laragon\bin\php\php-8.3.26-Win32-vs16-x64\php.exe`.

## Reglas de las vistas

Las vistas Blade **no llevan PHP, `<style>`, `<script>` ni `onclick`**; lo verifica
`tests/Feature/ExampleTest.php` (excepto `welcome.blade.php`, que es del esqueleto).

- **Los datos viven en `config/portfolio.php`** (proyectos, habilidades, navegación,
  redes, contacto, bio) como claves de traducción en inglés. Se traducen al renderizar,
  nunca al cargar la config: ahí todavía no hay idioma resuelto.
- **Cada componente arma sus datos en `render()` y los pasa con `compact()`.** Los
  componentes Livewire no tienen propiedades públicas de contenido, así que nada de eso
  viaja en el snapshot de Livewire. Los proyectos los prepara
  `app/Support/Portfolio/ProjectCatalog.php` (traduce y resuelve rutas con `asset()`).
- `Navigation` y `Footer` son componentes de clase (`app/View/Components/`), usados como
  `<x-navigation />` y `<x-footer />` en el layout.
- Componentes Blade en `resources/views/components/`: `<x-icon name="…">` (un archivo por
  ícono en `components/icon/`; para uno nuevo, copiar uno existente) y `portfolio/`
  (`project-card`, `carousel`, `robot`, `icon-badge`).
- **Agregar un proyecto = agregar una entrada en `project_groups`**, más la traducción de
  sus textos en `resources/lang/es.json`. No se toca ninguna vista.

## CSS y JS

- `resources/css/app.css` solo importa. Tokens de marca y animaciones en `theme.css`
  (`--color-brand-*`, `animate-blob`); un archivo por componente en `css/components/`.
  Los componentes leen los tokens con `var()`, sin hexadecimales repetidos.
- **La marca es esmeralda.** No hay violeta ni rosa en ninguna vista. Quedan en
  `welcome.blade.php`, que no tiene ruta.
- **El diseño es sobrio y plano, a propósito** (decisión del 2026-10-22: el efecto "liquid
  glass" se leía como diseñado con IA). Nada de `backdrop-blur`, transparencias en
  superficies, manchas desenfocadas, degradados (de texto, botones ni fondos), brillos en
  hover, `animate-ping/pulse/bounce` ni elevación o zoom al pasar el mouse. Superficies
  sólidas con borde de 1 px, un solo acento y hover que cambia color o borde. **Un test
  falla si vuelve alguno** (`test_design_stays_flat_...`). La única pieza con movimiento
  propio es el robot, que es la firma del sitio.
- Tokens en `theme.css`: `ink`/`ink-raised` (oscuros), `paper`/`line` (claros),
  `brand-400…700`. **Botones con texto blanco sobre claro usan `brand-700`**: `brand-600`
  no llega a 4,5:1. Títulos en Bricolage Grotesque y texto en Figtree (bunny.net).
- Los controles del carrusel quedan siempre visibles en táctil (`@media (hover: none)`).
- `resources/js/app.js` es la única entrada. `lib/` tiene utilidades y `features/` un
  módulo por comportamiento. Navegación, modal e idioma se cargan directo; robots y
  carruseles con `import()` solo si existe su marcado (`data-robot`, `data-about-robot`,
  `data-carousel`), y Vite los separa en chunks.
- **Los comportamientos se enganchan por atributos `data-*`, con delegación de eventos**
  (`data-scroll-to`, `data-modal-src`, `data-carousel-next`…). No usar `onclick` ni ids.
- Los estados visuales son clases (`is-visible`, `is-hidden`, `active`), no estilos inline.
- Se respeta `prefers-reduced-motion` (sin autoplay en carruseles ni animaciones).
- `::class` de Alpine no sirve en `<x-…>`: pisa el `class` del llamador. Usar variantes
  de Tailwind (`group-aria-expanded:`) o poner el atributo en un elemento HTML.

## Idiomas (i18n)

- Traducciones en `resources/lang/es.json` y `en.json`, **con la clave en inglés**: es la
  excepción a la regla de idioma de `convenciones.md`.
- `App\Http\Middleware\SetLocale` toma el idioma de la sesión o, en la primera visita, de
  `Accept-Language`; **si no reconoce el idioma cae en `en`**.
- `App\Livewire\LanguageSwitcher` guarda el idioma en sesión y dispara `locale-changed`,
  que recarga la página (`features/language-switcher.js`).
- **About, Contact y el footer siguen con texto fijo en español**, sin `__()`.
- `INTERNATIONALIZATION.md` está desactualizado: dice que el default es español (el
  middleware y `.env.example` usan `en`). Usarlo como guía de uso, no como estado.

## Despliegue

- `Procfile` (`php artisan serve` sobre `$PORT`) está versionado.
- `fly.toml` (app `lizandev-portfolio`) y `railway.md` están en `.gitignore`: **solo
  existen en esta máquina**. No está verificado cuál plataforma es la vigente.
- `.env.example` usa `SESSION_DRIVER=database`: sin la tabla `sessions` migrada, el
  selector de idioma no funciona.

## Tests

`phpunit.xml` fuerza `sqlite` en `:memory:` y no hay `bootstrap/cache/config.php`: la
suite no toca la base de desarrollo. Cubre la redirección de `/`, que se rendericen las
cinco secciones y la regla de vistas sin PHP/CSS/JS inline.

## Trampas conocidas

- **El formulario de contacto no envía nada.** `Contact::submit()` valida y muestra
  "¡Mensaje enviado exitosamente!", pero el `Mail::to(...)` está comentado.
- **Datos de contacto de plantilla** en `config/portfolio.php`: `tu@email.com`,
  `Tu Ciudad, País`, `@tuusuario`, y GitHub/LinkedIn apuntan a las portadas genéricas.
- La foto de Sobre mí es `public/assets/about/lizandro.jpg`; si el archivo no existe se
  muestra un avatar genérico.
- `og:image` apunta a `public/images/social-preview.png`, que no existe. Los favicons
  propios están comentados en `partials/head.blade.php`.
- `FrontController.php` está vacío y `welcome.blade.php` no tiene ruta: restos del
  esqueleto. `axios` sigue en `package.json` pero ya nadie lo importa.
- Las fuentes vienen de bunny.net (`head.blade.php`), no están autohospedadas: sin red,
  cae a la tipografía del sistema.
