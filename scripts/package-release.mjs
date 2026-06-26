import { cpSync, existsSync, mkdirSync, readdirSync, rmSync, readFileSync, statSync } from 'node:fs';
import { execSync } from 'node:child_process';
import { basename, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = join(fileURLToPath(new URL('.', import.meta.url)), '..');
const dest = join(root, 'release', 'hatteras');
const zipPath = join(root, 'release', 'hatteras.zip');

const pruneDirNames = new Set(['Tests', 'tests', '.git', '.github']);
const pruneFileNames = new Set([
	'phpunit.xml.dist',
	'phpunit.xml',
	'.gitattributes',
	'.gitignore',
	'README.md',
	'README.MD',
	'CHANGELOG.md',
	'composer.lock',
]);

function loadDistignore() {
	const lines = readFileSync(join(root, '.distignore'), 'utf8')
		.split(/\r?\n/)
		.map((line) => line.trim())
		.filter(Boolean);

	const dirs = new Set();
	const files = new Set();

	for (const line of lines) {
		const value = line.replace(/^\/+/, '');
		if (!value) {
			continue;
		}

		if (line.startsWith('/')) {
			dirs.add(value);
		} else {
			files.add(value);
		}
	}

	return { dirs, files };
}

function copyTheme(sourceRoot, targetRoot) {
	const { dirs: excludeDirs, files: excludeFiles } = loadDistignore();

	for (const entry of readdirSync(sourceRoot, { withFileTypes: true })) {
		if (excludeDirs.has(entry.name) || excludeFiles.has(entry.name)) {
			continue;
		}

		const from = join(sourceRoot, entry.name);
		const to = join(targetRoot, entry.name);
		cpSync(from, to, { recursive: true, force: true });
	}
}

function pruneVendor(dir) {
	if (!existsSync(dir)) {
		return;
	}

	for (const entry of readdirSync(dir, { withFileTypes: true })) {
		const fullPath = join(dir, entry.name);

		if (entry.isDirectory()) {
			if (pruneDirNames.has(entry.name)) {
				rmSync(fullPath, { recursive: true, force: true });
				continue;
			}

			pruneVendor(fullPath);
			continue;
		}

		if (pruneFileNames.has(entry.name)) {
			rmSync(fullPath, { force: true });
		}
	}
}

function countFiles(dir) {
	let count = 0;
	let bytes = 0;

	for (const entry of readdirSync(dir, { withFileTypes: true })) {
		const fullPath = join(dir, entry.name);

		if (entry.isDirectory()) {
			const nested = countFiles(fullPath);
			count += nested.count;
			bytes += nested.bytes;
			continue;
		}

		count += 1;
		bytes += statSync(fullPath).size;
	}

	return { count, bytes };
}

if (existsSync(dest)) {
	rmSync(dest, { recursive: true, force: true });
}

mkdirSync(join(root, 'release'), { recursive: true });
mkdirSync(dest, { recursive: true });

copyTheme(root, dest);
pruneVendor(join(dest, 'vendor'));

if (existsSync(zipPath)) {
	rmSync(zipPath, { force: true });
}

execSync(`powershell -NoProfile -Command "Compress-Archive -Path '${dest}' -DestinationPath '${zipPath}' -Force"`, {
	stdio: 'inherit',
});

const stats = countFiles(dest);
const zipSize = statSync(zipPath).size;

console.log('');
console.log(`Release: ${dest}`);
console.log(`Zip:     ${zipPath}`);
console.log(`Files:   ${stats.count}`);
console.log(`Size:    ${(stats.bytes / 1024 / 1024).toFixed(2)} MB (folder), ${(zipSize / 1024 / 1024).toFixed(2)} MB (zip)`);
