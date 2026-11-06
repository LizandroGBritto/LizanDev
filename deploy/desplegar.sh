#!/usr/bin/env bash
# Despliegue de dev.lizan.site. Se corre EN EL SERVIDOR como root, desde
# /var/www/dev.lizan.site, después de subir el código (git pull o rsync).
# Uso: bash deploy/desplegar.sh
set -euo pipefail

APP=/var/www/dev.lizan.site
USUARIO=lizandev
PHP=php8.3

cd "$APP"

[ -f .env ] || { echo "Falta $APP/.env (partí de deploy/env.produccion.example)"; exit 1; }
grep -q '^APP_DEBUG=false' .env || { echo "APP_DEBUG debe ser false en producción"; exit 1; }
grep -q '^APP_ENV=production' .env || { echo "APP_ENV debe ser production"; exit 1; }

# Los assets (public/build) se compilan en local con `npm run build` y se suben con el código:
# el servidor no tiene Node.
[ -f public/build/manifest.json ] || { echo "Falta public/build: corré npm run build antes de subir"; exit 1; }

sudo -u "$USUARIO" env COMPOSER_HOME=/var/lib/lizandev-composer composer install --no-dev --optimize-autoloader --no-interaction
sudo -u "$USUARIO" -H $PHP artisan migrate --force
sudo -u "$USUARIO" -H $PHP artisan db:seed --class=AdministradorSeeder --force

# Permisos: el código es de root (solo lectura para el sitio); el usuario del
# pool escribe únicamente en storage/, bootstrap/cache/ y la base.
chown -R root:"$USUARIO" "$APP"
find "$APP" -type d -exec chmod 750 {} +
find "$APP" -type f -exec chmod 640 {} +
chown -R "$USUARIO":"$USUARIO" storage bootstrap/cache
chmod -R u+rwX,g-w storage bootstrap/cache
chmod 600 .env
chown "$USUARIO":"$USUARIO" .env
chmod 750 artisan

# Cachés de producción (después de fijar permisos y variables).
sudo -u "$USUARIO" -H $PHP artisan config:cache
sudo -u "$USUARIO" -H $PHP artisan route:cache
sudo -u "$USUARIO" -H $PHP artisan view:cache

systemctl reload php8.3-fpm
nginx -t && systemctl reload nginx
echo "Listo: https://dev.lizan.site"
