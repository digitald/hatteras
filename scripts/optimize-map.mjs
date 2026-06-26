import sharp from 'sharp';
import { mkdir } from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, '..');
const source = path.join(
    root,
    '_referenze_legacy',
    'Map_from_Journeys_and_Adventures_of_Captain_Hatteras_by_Jules_Verne.jpg',
);
const outDir = path.join(root, 'assets', 'images');

await mkdir(outDir, { recursive: true });

const image = sharp(source);
const meta = await image.metadata();

const watermark = await sharp(source)
    .resize(1600, null, { withoutEnlargement: true })
    .grayscale()
    .modulate({ brightness: 1.05 })
    .webp({ quality: 78 })
    .toBuffer();

await sharp(watermark).toFile(path.join(outDir, 'map-watermark.webp'));

const poleHeight = Math.round(meta.height * 0.45);
await sharp(source)
    .extract({ left: 0, top: 0, width: meta.width, height: poleHeight })
    .resize(1200, null, { withoutEnlargement: true })
    .grayscale()
    .webp({ quality: 80 })
    .toFile(path.join(outDir, 'map-pole-crop.webp'));

await sharp(source)
    .resize(1920, null, { withoutEnlargement: true })
    .grayscale()
    .webp({ quality: 82 })
    .toFile(path.join(outDir, 'map-full.webp'));

console.log('Map assets written to assets/images/');
