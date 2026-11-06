// Genera favicon.ico y apple-touch-icon.png desde public/favicon.svg (la «L» del encabezado).
import sharp from 'sharp';
import fs from 'node:fs';

const svg = fs.readFileSync('public/favicon.svg');
const png = (size) => sharp(svg, { density: 384 }).resize(size, size).png().toBuffer();

const sizes = [16, 32, 48];
const images = await Promise.all(sizes.map(png));

// ICO con PNG incrustados
const header = Buffer.alloc(6);
header.writeUInt16LE(1, 2);
header.writeUInt16LE(sizes.length, 4);
let offset = 6 + 16 * sizes.length;
const entries = images.map((data, i) => {
    const e = Buffer.alloc(16);
    e.writeUInt8(sizes[i], 0);
    e.writeUInt8(sizes[i], 1);
    e.writeUInt16LE(1, 4);
    e.writeUInt16LE(32, 6);
    e.writeUInt32LE(data.length, 8);
    e.writeUInt32LE(offset, 12);
    offset += data.length;
    return e;
});
fs.writeFileSync('public/favicon.ico', Buffer.concat([header, ...entries, ...images]));
fs.writeFileSync('public/apple-touch-icon.png', await png(180));
console.log('favicon.ico + apple-touch-icon.png listos');
