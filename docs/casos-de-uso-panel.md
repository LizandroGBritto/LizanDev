# Casos de uso: panel, visitas e interacciones

Objetivo: tener a mano cada situación (común, de error, de validación y de seguridad) del
panel y del registro de visitas, **verificada antes de llevarla a producción**. Cada caso
tiene un identificador; los marcados con `Test` están cubiertos por la suite
(`php artisan test`), y los marcados con `Manual` hay que repetirlos a mano en producción
(sección 9).

Actores: **Administrador** (usuario del panel), **Visitante** (cualquiera que abre el sitio),
**Robot** (buscadores, previews, scripts) y **Operador** (quien despliega y crea usuarios).

Convenciones: rutas en español salvo `/login` y `/logout`; tablas `mensajes_contacto`,
`visitas`, `interacciones` y `users`.

---

## 1. Autenticación (`/login`) — `LoginTest`

Solo existe el login. **No hay registro, ni recuperación de contraseña, ni verificación de
correo**: los usuarios los crea el Operador con el comando de la sección 2.

| ID | Caso | Resultado esperado | |
|---|---|---|---|
| AU-01 | Administrador ingresa con correo y contraseña válidos | Redirige a `/admin` (Resumen) y queda autenticado | Test |
| AU-02 | Contraseña incorrecta | Vuelve a `/login` con «Las credenciales no coinciden con nuestros registros.»; no hay sesión | Test |
| AU-03 | Correo que no existe | **El mismo mensaje exacto** que AU-02 (no revela qué cuentas existen) | Test |
| AU-04 | Campos vacíos, correo mal formado, correo/contraseña como arreglo (`email[]=x`), contraseña de más de 255 caracteres | Errores de validación; nunca un error 500 | Test |
| AU-05 | Más de 5 intentos en un minuto con la misma cuenta desde la misma IP | HTTP 429; otra cuenta desde la misma IP no queda bloqueada | Test |
| AU-06 | Alguien abre `/register`, `/forgot-password`, `/reset-password`, `/password/reset`, `/email/verify` (GET o POST) | 404; no se crea ningún usuario | Test |
| AU-07 | Invitado abre `/admin`, `/admin/mensajes`… | Redirige a `/login`; tras ingresar vuelve a la página que pidió | Test |
| AU-08 | Usuario con sesión abre `/login` | Redirige a `/admin` | Test |
| AU-09 | Administrador toca «Salir» | `POST /logout` cierra la sesión y vuelve a `/login`; `/admin` ya no abre. `GET /logout` da 405; `POST /logout` sin sesión redirige a `/login` | Test |
| AU-10 | Enlace viejo `/admin/ingresar` | Redirección permanente (301) a `/login` | Test |
| AU-11 | Buscadores | `/login` lleva `noindex` y `robots.txt` lo bloquea junto con `/admin` y `/seguimiento` | Test |
| AU-12 | El id de sesión cambia al ingresar (evita fijación de sesión) | Id distinto antes y después | Test |
| AU-13 | Tras un error, el correo escrito se conserva y la contraseña **no** | Campo de correo rellenado; sin contraseña en la sesión | Test |
| AU-14 | «Recordarme» marcado | Cookie de recuerdo de larga duración; desmarcado, la sesión termina con el navegador | Manual |
| AU-15 | Sesión vencida (más de `SESSION_LIFETIME`) y se envía un formulario | Página 419 «expirada»: hay que volver a ingresar | Manual |

## 2. Alta de usuarios (comando) — `UsuarioPanelTest`

```bash
php artisan panel:usuario "Nombre Apellido" correo@dominio.com
php artisan panel:usuario "Nombre Apellido" correo@dominio.com --actualizar
```

| ID | Caso | Resultado esperado | |
|---|---|---|---|
| US-01 | Crear un usuario nuevo | Se crea con ese nombre y el correo en minúsculas; imprime una contraseña aleatoria de 20 caracteres | Test |
| US-02 | La contraseña impresa sirve para ingresar | Login correcto con esa contraseña | Test |
| US-03 | El correo ya existe y no se pasó `--actualizar` | Falla con «Ya existe…»; la contraseña vieja sigue valiendo | Test |
| US-04 | Con `--actualizar` | Cambia nombre y contraseña; la vieja deja de servir; sigue habiendo un solo usuario | Test |
| US-05 | Nombre vacío o correo inválido | Falla (código 1) y no crea nada | Test |
| US-06 | La contraseña | Se guarda con hash, se imprime **una sola vez** y no se escribe en ningún archivo ni log | Test |

Quien recibe la contraseña debe cambiarla o guardarla en un gestor: no hay pantalla para
cambiarla (queda fuera de alcance; se rota con `--actualizar`).

## 3. Mensajes de contacto (`/admin/mensajes`) — `AdminTest`, `ContactoTest`

| ID | Caso | Resultado esperado | |
|---|---|---|---|
| ME-01 | Un visitante envía el formulario con datos válidos | Se guarda en `mensajes_contacto` (nombre, correo, mensaje, idioma, IP, agente, puntaje reCAPTCHA) y se muestra «Mensaje enviado» | Test |
| ME-02 | Campos vacíos, correo inválido, mensaje demasiado corto/largo | Errores junto a cada campo (nombre 3–120 caracteres, correo válido de hasta 190, mensaje 10–3000); no se guarda | Test |
| ME-03 | Robot que completa el campo trampa `sitioWeb` | Se descarta sin guardar | Test |
| ME-04 | Más de 5 envíos por hora desde la misma IP | Mensaje «Demasiados mensajes…»; no se guarda el sexto | Test |
| ME-05 | reCAPTCHA con puntaje bajo, token ausente o falla de Google | No se guarda; «No pudimos verificar que eres humano» | Test |
| ME-06 | En producción sin claves de reCAPTCHA | **Falla cerrado**: no se puede enviar | Test |
| ME-07 | El Administrador abre la lista | Ve los mensajes del más nuevo al más viejo, con paginación de 15 y el contador de «sin leer» | Test |
| ME-08 | Filtro «Sin leer» | Solo los no leídos | Test |
| ME-09 | Marcar leído / no leído | Alterna `leido_en`; vuelve a la misma página | Test |
| ME-10 | Eliminar (pide confirmación en el navegador) | El mensaje se borra y aparece «Mensaje eliminado» | Test |
| ME-11 | Contenido hostil en un mensaje (`<script>…`) | Se muestra como texto escapado, nunca se ejecuta | Test |
| ME-12 | Marcar/eliminar un mensaje que no existe o ya se borró | 404, sin romper el panel | Test |
| ME-13 | Sin sesión, `PATCH`/`DELETE` sobre mensajes | Redirige a `/login` | Test |

## 4. Registro de visitas — `VisitasTest`

Se registra **una visita por visitante cada 30 minutos**, solo al abrir la home (`/`).

| ID | Caso | Resultado esperado | |
|---|---|---|---|
| VI-01 | Un visitante abre la home | Una fila en `visitas`: ruta, dispositivo (escritorio/móvil/tablet), navegador, idioma y referente | Test |
| VI-02 | Recarga la página dentro de los 30 minutos | No se duplica | Test |
| VI-03 | Vuelve pasados 30 minutos | Cuenta otra visita | Test |
| VI-04 | Robots (Googlebot, curl, python, headless, vistas previas de redes) o petición sin User-Agent | No se registra; la página responde normal | Test |
| VI-05 | Navegador con «No rastrear» (`DNT: 1`) o `Sec-GPC: 1` | No se registra | Test |
| VI-06 | El Administrador con sesión abre el sitio | No se cuenta (no ensucia las métricas) | Test |
| VI-07 | **Privacidad**: la IP no se guarda | No hay columna de IP; `visitante` es un hash de IP + navegador + **día**, que no permite volver a la IP ni seguir a alguien de un día al siguiente | Test |
| VI-08 | Referente | Se guarda solo el dominio y solo si es externo (Google, Instagram…); el propio sitio queda como «Directo» | Test |
| VI-09 | Falla la base al guardar la visita | La página igual responde 200; el error queda en el log | Test |
| VI-10 | Dos días distintos | El mismo visitante tiene hash distinto cada día | Test |
| VI-11 | `/login`, `/admin` y páginas 404 | No se registran | Test |

## 5. Registro de interacciones (`POST /seguimiento`) — `InteraccionesTest`

El navegador envía el evento con `sendBeacon` (sin cookies); el servidor **valida cada evento
contra la lista real de proyectos y tecnologías**.

| ID | Caso | Resultado esperado | |
|---|---|---|---|
| IN-01 | Un proyecto queda al frente y a la vista ~1,5 s | Se guarda `proyecto_visto` con el *slug* del proyecto, una vez por carga de página y por proyecto | Test (servidor) / Manual (navegador) |
| IN-02 | El visitante alterna notebook/celular en una card | `vista_dispositivo` con `laptop` o `phone`; sin detalle o con otro valor → 422 | Test |
| IN-03 | Evento inventado: tipo desconocido, proyecto inexistente, texto de 500 caracteres, arreglo, `<script>` | 422 y no se guarda nada | Test |
| IN-04 | Toca una tecnología del anillo | `tecnologia` con el nombre; una tecnología inexistente, o un proyecto enviado como tecnología (y al revés) → 422 | Test |
| IN-05 | Clic en «Ver Proyecto» | `demo_clic` con el proyecto | Test |
| IN-06 | Robots y «No rastrear» | Responden **204 igual** (no revelan que se les ignora) pero no se guarda nada | Test |
| IN-07 | Administrador con sesión | No se guarda | Test |
| IN-08 | Solo `POST`; más de 120 por minuto desde una IP | `GET` da 405; el exceso da 429 | Test |
| IN-09 | Cada proyecto tiene `slug` único y la página lo expone en `data-project` | Sin slugs repetidos ni vacíos | Test |
| IN-10 | Sin token CSRF | 419 y no se guarda | Manual |
| IN-11 | El visitante bloquea JavaScript o el navegador no tiene `sendBeacon` | Se usa `fetch` con `keepalive`; si falla, se ignora y la página sigue | Manual |
| IN-12 | El visitante sale de la página justo al pulsar | `sendBeacon` lo envía igual | Manual |

## 6. Resumen del panel (`/admin`) — `ResumenTest`

| ID | Caso | Resultado esperado | |
|---|---|---|---|
| RE-01 | Sin sesión | Redirige a `/login` | Test |
| RE-02 | Tarjetas | Visitas, Visitantes (hashes distintos), Hoy y Mensajes sin leer | Test |
| RE-03 | Período inválido (`?dias=abc`, `9999`, `-5`, `0`, `dias[]=7`, texto con SQL) | Cae en 30 días; nunca llega a la consulta | Test |
| RE-04 | Períodos 7 / 30 / 90 días | Filtran las visitas por fecha | Test |
| RE-05 | Tabla «Proyectos vistos» | Lista **todos** los proyectos, también los que tienen 0 | Test |
| RE-06 | Orden y columnas | Más vistos primero; columnas Vistas, Visitantes, En celular y Clics en la demo | Test |
| RE-07 | Interacciones fuera del período | No cuentan | Test |
| RE-08 | Sin datos todavía | Muestra «Todavía no hay datos.» y ceros, sin errores | Test |
| RE-09 | Tecnologías, procedencia, dispositivos e idiomas | Resumidos en listas cortas | Test |
| RE-10 | Gráfico | Una barra por día del período | Test |
| RE-11 | Dato hostil guardado en las tablas (un referente con HTML) | Se muestra escapado | Test |
| RE-12 | Pantalla de 390 px | Sin scroll horizontal; la tabla se desplaza dentro de su tarjeta | Manual (verificado) |

## 7. Idiomas y accesibilidad

| ID | Caso | Resultado esperado | |
|---|---|---|---|
| ID-01 | Panel y login siguen el idioma de la sesión (es/en) | Todas las etiquetas traducidas; `IdiomasTest` exige las mismas claves en ambos idiomas | Test |
| AC-01 | Navegación con teclado en el login y el panel | Foco visible; los botones son `<button>`; el gráfico lleva `role="img"` con etiqueta | Manual |

## 8. Seguridad y privacidad (resumen)

- Contraseñas con hash (bcrypt); 5 intentos por minuto por cuenta+IP; sesión regenerada al ingresar.
- Sin registro ni recuperación: la única forma de crear acceso es el comando del servidor.
- Las tablas de visitas e interacciones **no guardan IP**, no usan cookies propias y respetan
  «No rastrear». Los datos son agregados por día y de proyectos del portafolio.
- `/login`, `/admin` y `/seguimiento` fuera de los buscadores (`noindex` + `robots.txt`).
- Todo lo que se muestra se escapa; los valores del servidor se validan contra listas cerradas.
- La suite de seguridad (`SeguridadTest`) sigue exigiendo que `public/` no sirva archivos sensibles.

## 9. Lista de verificación manual en producción

Repetirla después de cada despliegue:

1. `https://dev.lizan.site/login` abre; `/register` y `/forgot-password` dan 404; `/admin` sin sesión redirige a `/login`.
2. Ingresar con el usuario creado → aparece **Resumen**. Contraseña equivocada → mensaje genérico.
3. Abrir el sitio **en una ventana privada** (sin sesión de admin), mirar 2-3 proyectos, cambiar uno a celular, tocar «Ver Proyecto» y una tecnología. Volver al panel: las cifras de **Visitas** y **Proyectos vistos** subieron (la tabla `interacciones` no guarda IP: confirmarlo con `describe interacciones`).
4. Cerrar sesión con «Salir» y comprobar que `/admin` vuelve a pedir login.
5. Enviar el formulario de contacto (con las claves de reCAPTCHA cargadas): el mensaje aparece en **Mensajes**; marcarlo leído y eliminarlo.
6. En consola del navegador, `fetch('/seguimiento', {method:'POST'})` sin token → 419 (IN-10).
7. `php artisan migrate --force` ya corrió (tablas `visitas` e `interacciones` existen) y `storage/logs` no muestra errores nuevos.

## 10. Fuera de alcance (a propósito)

Cambio de contraseña desde el panel, varios roles, exportar a CSV, correo de aviso por mensaje
nuevo, geolocalización por país y rastreo entre días (contradice la política de privacidad).
