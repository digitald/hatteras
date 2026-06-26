import sharp from 'sharp';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const mapPath = path.join(root, 'assets', 'images', 'map-watermark.webp');
const outPath = path.join(root, 'screenshot.png');
const width = 1200;
const height = 900;
const background = '#F4EDE0';

const map = await sharp(mapPath)
	.resize(Math.round(width * 0.88), null, { fit: 'inside', withoutEnlargement: true })
	.ensureAlpha()
	.toBuffer();

await sharp({
	create: {
		width,
		height,
		channels: 3,
		background,
	},
})
	.composite([{ input: map, gravity: 'center' }])
	.png()
	.toFile(outPath);

console.log(`Screenshot saved to ${outPath}`);
