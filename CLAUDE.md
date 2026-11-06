# LizanDev

@~/documentacion/convenciones.md

Portafolio personal de Lizandro Britto: una sola página (landing) en Laravel + Livewire,
bilingüe es/en, con un mini panel para leer las solicitudes de contacto. **No es un
proyecto de cliente ni pertenece a ninguna familia de la agencia**: no hay motor, ni medios
de pago, ni el panel de Porta (el panel de acá es propio y mínimo, ver «Panel»).

## Base

- Laravel 12 / PHP 8.2 (`^8.2`), Livewire 3.6, Tailwind 4 vía `@tailwindcss/vite`, Vite 7.
- Base de datos sqlite. Tablas propias: `mensajes_contacto` (modelo `MensajeContacto`,
  dominio en español). `User` es el administrador del panel.
- Herramientas: scripts de `composer.json` del esqueleto (`composer dev` levanta server +
  queue + pail + vite). `laravel/pint` instalado sin configuración propia.
- **PHP en esta máquina:** el `php` del PATH es 7.4 y no arranca el proyecto. Usar el de
  Laragon, `C:\laragon\bin\php\php-8.3.26-Win32-vs16-x64\php.exe`.
- **La home es la raíz `/`** (ruta `inicio`). El prefijo `/LizanDev` ya no existe.

## Reglas de las vistas

Las vistas Blade **no llevan PHP, `<style>`, `<script>` ni `onclick`**; lo verifica
`tests/Feature/ExampleTest.php` (excepto `welcome.blade.php`, que es del esqueleto).

- **Los datos viven en `config/portfolio.php`** (proyectos, tecnologías, navegación,
  redes, contacto, bio) como claves de traducción en inglés. Se traducen al renderizar,
  nunca al cargar la config: ahí todavía no hay idioma resuelto.
- **Cada componente arma sus datos en `render()` y los pasa con `compact()`.** Los
  componentes Livewire no tienen propiedades públicas de contenido (salvo los campos del
  formulario), así que nada de eso viaja en el snapshot. `ProjectCatalog` prepara la
  baraja y `TechCatalog` las tecnologías del robot (en `app/Support/Portfolio/`).
- `Navigation` y `Footer` son componentes de clase (`app/View/Components/`).
- Componentes Blade: `<x-icon name="…">` (un archivo por ícono en `components/icon/`),
  `three/` (`carnet`, `robot`, `caja` de seis caras) y `portfolio/robot` (el robot 2D de
  Sobre mí).
- **Agregar un proyecto = agregar una entrada en `projects`**, más la traducción de sus
  textos en `es.json`. **Agregar una tecnología al anillo = una entrada en `technologies`**;
  el «dónde la usé» sale solo de las etiquetas de los proyectos (`match`), sin inventar uso.
- **Proyectos con captura en celular**: si la entrada de `projects` trae `mobile`, la card muestra un notebook 3D y un selector notebook/celular (`features/device.js` gira el objeto con `is-phone`); sin `mobile` solo se ve la captura plana. Capturas de escritorio 960 px y de celular 390 px.
- Imágenes en WebP. Para convertir una nueva: `npm run imagenes -- <origen> <destino.webp> [ancho]`.

## CSS y JS

- `resources/css/app.css` solo importa. **Todos los colores viven en `theme.css`** y el
  resto los lee con `var()` / clases de token (`bg-deep`, `text-muted`…); un test falla si
  aparece un hex, `rgb()` o `[#…]` fuera de `theme.css`. Un archivo por componente en
  `css/components/`.
- **Paleta del mockup «carnet y robot»**: `paper`/`card`/`line`/`ink`/`muted` (claros),
  `deep*`/`mint*` (verde profundo), `brand-300…800` (acento), `amber*` (solo para destacar).
  **Texto de acento sobre claro usa `brand-700`**: `brand-600` da 3,5:1 y no llega a AA.
  Títulos en Familjen Grotesk, texto en Figtree, mono en JetBrains Mono (bunny.net).
- **El diseño es sobrio y plano, a propósito** (decisión del 2026-10-22: el efecto "liquid
  glass" se leía como diseñado con IA). Nada de `backdrop-blur`, transparencias en
  superficies, degradados (ni `conic`), `box-shadow`, brillos en hover, `animate-ping/pulse/
  bounce` ni elevación o zoom al pasar el mouse. **Un test falla si vuelve alguno.** El
  resaltado del nombre es un subrayado grueso (`.hero-mark`), no un degradado.
- 3D con CSS puro: `@property --spin` para el anillo, `cos()` para opacidad/escala,
  `--rx/--ry` para la inclinación (los escribe `features/tilt.js`). El robot es decorativo
  (`aria-hidden`); cada tecnología del anillo es un `<button>` real.
- `resources/js/app.js` es la única entrada. Navegación e idioma se cargan directo; el
  resto (`tilt`, `carnet`, `deck`, `tech-robot`, `about-robot`, `recaptcha`, `confirm`) con
  `import()` solo si existe su marcado, y Vite los separa en chunks.
- **Los comportamientos se enganchan por atributos `data-*`.** Los estados visuales son
  clases (`is-flipped`, `is-holding`, `is-taken`, `active`), no estilos inline (salvo
  variables CSS dinámicas como `--o` o `--i`).
- Se respeta `prefers-reduced-motion` (regla global en `base.css`; la baraja no autoavanza).
- `::class` de Alpine no sirve en `<x-…>`: pisa el `class` del llamador. Usar variantes
  de Tailwind (`group-aria-expanded:`).

## Idiomas (i18n)

- Traducciones en `resources/lang/es.json` y `en.json`, **con la clave en inglés**: es la
  excepción a la regla de idioma de `convenciones.md`. `IdiomasTest` exige las mismas
  claves en ambos y una traducción para cada texto de `config/portfolio.php`.
- `SetLocale` toma el idioma de la sesión o, en la primera visita, de `Accept-Language`
  (con o sin región); **si ninguno coincide cae en `en`** (antes caía en `es`: Symfony
  devuelve el primer idioma disponible).
- `LanguageSwitcher` vive dentro de la barra, guarda el idioma en sesión y recarga la página.
- Todo el sitio y el panel usan `__()`; el panel no tiene selector propio, sigue la sesión.
- `INTERNATIONALIZATION.md` está desactualizado: usarlo solo como guía de uso.

## Contacto y panel

- `Contact` (Livewire) valida, aplica **honeypot** (`sitioWeb`), **límite de 5 envíos por
  hora por IP** y **reCAPTCHA v3**, y guarda en `mensajes_contacto`. No envía correo.
- reCAPTCHA: claves en `RECAPTCHA_SITE_KEY` / `RECAPTCHA_SECRET_KEY` (puntaje mínimo
  `RECAPTCHA_MINIMUM_SCORE`, 0,5). `features/recaptcha.js` carga `api.js` al enfocar el
  formulario, pide el token (acción `contacto`) y lo pone en `recaptchaToken` antes del
  submit. **Sin claves solo se puede enviar en `local`/`testing`; en producción falla
  cerrado.** Hay que cargar las claves antes de publicar.
- **Login en `/login`** (`/admin/ingresar` redirige ahí) con límite de 5 intentos por minuto
  por cuenta+IP (`RateLimiter::for('login')` en `AppServiceProvider`). **Solo login: no hay
  registro ni recuperación de contraseña.** Los usuarios se crean con
  `php artisan panel:usuario "Nombre" correo@dominio.com` (contraseña aleatoria, se imprime una
  sola vez; `--actualizar` la rota). El seeder `AdministradorSeeder` (`ADMIN_*` del `.env`)
  sigue existiendo pero ya no es el camino normal.
- **Panel** en `/admin` (Resumen) y `/admin/mensajes`: lista, filtra sin leer, marca
  leído/no leído y elimina (con confirmación `data-confirm`). Lleva `noindex`. No sigue la
  identidad del panel de Porta a propósito: es un proyecto personal.
- **Visitas e interacciones** (tablas `visitas` e `interacciones`, sin IP ni cookies; el
  visitante es un hash de IP+navegador+día): `RegistrarVisita` cuenta una visita por
  visitante cada 30 min solo en `/`; `features/tracking.js` manda por `sendBeacon` a
  `POST /seguimiento` el proyecto visto, el cambio notebook/celular, el clic en la demo y la
  tecnología tocada. Se ignoran robots, `DNT`/`Sec-GPC` y al administrador con sesión. **Cada
  proyecto necesita un `slug` único en `config/portfolio.php`**: el servidor valida los eventos
  contra esa lista.
- **Casos de uso y checklist de producción:** `docs/casos-de-uso-panel.md` (cada caso apunta a
  su test; los marcados «Manual» se repiten tras cada despliegue).

## Despliegue

- `Procfile` (`php artisan serve` sobre `$PORT`) está versionado.
- `fly.toml` (app `lizandev-portfolio`) y `railway.md` están en `.gitignore`: **solo
  existen en esta máquina**. No está verificado cuál plataforma es la vigente.
- Al desplegar: `php artisan migrate`, el seeder del administrador y `npm run build`.
  `SESSION_DRIVER=database` necesita la tabla `sessions` migrada.

## Tests

`phpunit.xml` fuerza `sqlite` en `:memory:` y no hay `bootstrap/cache/config.php`: la
suite no toca la base de desarrollo (verificarlo antes de correrla, ver `convenciones.md`).
Cubre rutas, secciones, i18n, el flujo del contacto (reCAPTCHA, honeypot, límite), el panel
y las reglas de diseño (vistas sin PHP/CSS/JS, plano, colores solo desde tokens).

## Trampas conocidas

- **Contacto real** en `config/portfolio.php`: email, Paraguay, GitHub (`LizandroGBritto`) y
  LinkedIn (`lizandro-britto`, sin parámetros `utm_*`). Aparecen en el pie y en las tarjetas del formulario.
- La foto es `public/assets/about/lizandro.webp` (carnet y Sobre mí); si no existe se
  muestra un avatar genérico.
- No hay `og:image`. El favicon es la «L» del encabezado (`public/favicon.svg`; `node scripts/favicon.mjs` regenera el `.ico` y el `apple-touch-icon`).
- `welcome.blade.php` no tiene ruta: resto del esqueleto. `axios` sigue en `package.json`
  pero ya nadie lo importa.
- La baraja de proyectos muestra una sola captura por proyecto; las galerías anteriores
  (carrusel + visor) se quitaron y quedan en el historial de git.
- Las fuentes vienen de bunny.net, no están autohospedadas: sin red cae a la del sistema.
- La verificación visual con Edge headless no baja de ~500 px de ventana: para medir
  mobile usar un iframe de 390 px.
