// Convierte una imagen a WebP redimensionado.
// Uso: npm run imagenes -- <origen> <destino.webp> [ancho=960]
import sharp from 'sharp';
import { statSync } from 'node:fs';

const [origen, destino, ancho = '960'] = process.argv.slice(2);

if (!origen || !destino) {
    console.error('Uso: npm run imagenes -- <origen> <destino.webp> [ancho]');
    process.exit(1);
}

await sharp(origen).resize({ width: Number(ancho), withoutEnlargement: true }).webp({ quality: 78 }).toFile(destino);
console.log(`${origen} ${(statSync(origen).size / 1024).toFixed(0)} KB -> ${destino} ${(statSync(destino).size / 1024).toFixed(0)} KB`);
