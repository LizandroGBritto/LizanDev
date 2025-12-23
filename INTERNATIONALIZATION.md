# Sistema de Internacionalización (i18n) - Portafolio

## ✅ Implementación Completada

### 1. **Archivos de Traducción Creados**

-   `resources/lang/es.json` - Traducciones en español
-   `resources/lang/en.json` - Traducciones en inglés

### 2. **Middleware de Localización**

-   `app/Http/Middleware/SetLocale.php` - Detecta idioma del navegador automáticamente
-   Registrado en `bootstrap/app.php`

### 3. **Componente Livewire de Selector de Idioma**

-   `app/Livewire/LanguageSwitcher.php` - Lógica del componente
-   `resources/views/livewire/language-switcher.blade.php` - Vista del selector

### 4. **Configuración**

-   `config/app.php` actualizado con locales disponibles: `['es', 'en']`
-   Locale por defecto: español (`es`)

### 5. **Integración en Layout**

-   `resources/views/layouts/portfolio.blade.php` actualizado con el selector

---

## 🎯 Funcionalidades

### **Selector de Idioma**

-   ✅ Botón flotante en esquina superior derecha
-   ✅ Desaparece al hacer scroll (después de 100px)
-   ✅ Reaparece al mover mouse cerca de la esquina
-   ✅ Dropdown con banderas de España 🇪🇸 y UK 🇬🇧
-   ✅ Indica idioma activo con checkmark
-   ✅ Fondo semi-transparente con backdrop blur
-   ✅ Animaciones suaves

### **Detección Automática**

-   ✅ Detecta idioma del navegador al cargar
-   ✅ Prioriza idiomas soportados (es, en)
-   ✅ Guarda preferencia en sesión
-   ✅ Mantiene idioma seleccionado entre páginas

---

## 📝 Cómo Usar las Traducciones

### En Blade Templates:

```blade
<!-- Sintaxis simple -->
{{ __('Home') }}
{{ __('Projects') }}

<!-- Con variables -->
{{ __('Welcome, :name', ['name' => $userName]) }}
```

### Agregar Nuevas Traducciones:

1. **Editar `resources/lang/es.json`:**

```json
{
    "New Key": "Nueva Traducción"
}
```

2. **Editar `resources/lang/en.json`:**

```json
{
    "New Key": "New Translation"
}
```

---

## 🔄 Archivos que Necesitan Traducción

### **Pendientes de actualizar:**

1. **Hero Section** (`resources/views/livewire/portfolio/hero.blade.php`)

    - Títulos
    - Subtítulos
    - Botones CTA

2. **About Section** (`resources/views/livewire/portfolio/about.blade.php`)

    - Descripción personal
    - Títulos de secciones

3. **Skills Section** (`resources/views/livewire/portfolio/skills.blade.php`)

    - Categorías (Frontend, Backend, Tools)
    - Textos descriptivos

4. **Contact Section** (`resources/views/livewire/portfolio/contact.blade.php`)
    - Labels de formulario
    - Placeholders
    - Mensajes de validación

### **Ya traducidos:**

✅ Projects Section

-   Títulos
-   Botones (Code, Demo)
-   Call to Action
-   Leyendas

---

## 🎨 Personalización del Selector

### Cambiar Posición:

En `resources/views/livewire/language-switcher.blade.php`:

```blade
<!-- Cambiar de top-6 right-6 a otra posición -->
<div class="fixed top-6 left-6 z-50">
```

### Modificar Comportamiento de Scroll:

En el `<script>` del componente:

```javascript
// Cambiar 100px a otro valor
if (scrollTop > 200) {
    // Desaparece después de 200px
    //...
}
```

### Agregar Más Idiomas:

1. **Crear archivo de traducción:**

```bash
resources/lang/fr.json
```

2. **Actualizar config/app.php:**

```php
'available_locales' => ['es', 'en', 'fr'],
```

3. **Agregar opción en el selector** (`language-switcher.blade.php`)

---

## 🚀 Testing

### Probar Detección Automática:

1. Cambiar idioma del navegador
2. Limpiar cookies/sesión
3. Recargar la página
4. Debe detectar el nuevo idioma

### Probar Selector:

1. Click en el botón de idioma
2. Seleccionar otro idioma
3. La página debe recargar con nuevo idioma
4. Navegar entre secciones (mantiene idioma)

---

## 💡 Notas Importantes

-   Las traducciones se cachean en producción (ejecutar `php artisan config:clear` si hay cambios)
-   El idioma se guarda en sesión (no en cookies)
-   La detección solo ocurre en la primera visita
-   Todos los textos deben usar `__()` para soporte multi-idioma

---

## 📦 Próximos Pasos

1. **Traducir componentes restantes** (Hero, About, Skills, Contact)
2. **Personalizar banderas** (puedes usar imágenes SVG reales)
3. **Agregar más idiomas** si es necesario
4. **Probar en diferentes navegadores** y dispositivos
5. **Considerar agregar animación** al cambiar idioma

---

## 🐛 Troubleshooting

### El idioma no cambia:

-   Verificar que el middleware está registrado
-   Limpiar caché: `php artisan config:clear`
-   Revisar sesiones activas

### El selector no aparece:

-   Verificar que Livewire está cargado (`@livewireScripts`)
-   Comprobar que Alpine.js está disponible
-   Revisar consola del navegador por errores

### Traducciones no funcionan:

-   Verificar que los archivos JSON existen
-   Comprobar sintaxis JSON (sin comas finales)
-   Asegurar que las claves coinciden exactamente
