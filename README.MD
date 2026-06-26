# Hatteras

Tema blog [WordPress](https://wordpress.org) ispirato alle edizioni illustrate Hetzel de *Le avventure del capitano Hatteras* di Jules Verne. Costruito su [TailPress](https://tailpress.io) con [Tailwind CSS 4](https://tailwindcss.com) e [Vite](https://vitejs.dev).

**Autore:** [digitald](https://github.com/digitald)  
**Repository:** [github.com/digitald/hatteras](https://github.com/digitald/hatteras)

## Estetica

Il design traduce in digitale l'atmosfera editoriale ottocentesca Hetzel, con misura:

- palette pergamena / inchiostro / oro sobrio
- tipografia serif editoriale (Cormorant Garamond, Source Serif 4)
- card articoli stile vignette incisa
- mappa polare circumpolare come watermark di sfondo
- layout orientato alla lettura (colonna stretta, drop cap, navigazione tra capitoli)

La mappa deriva dall'incisione originale *Carte des régions circumpolares* (1860–61). Le versioni ottimizzate sono in `assets/images/`.

## Requisiti

- WordPress 6.x
- PHP 8.0+
- [Node.js](https://nodejs.org) 18+ (per compilare gli asset)
- [Composer](https://getcomposer.org) (dipendenze PHP TailPress)

## Installazione

1. Clona il repository nella cartella temi di WordPress:

   ```bash
   git clone https://github.com/digitald/hatteras.git wp-content/themes/hatteras
   ```

2. Installa le dipendenze PHP:

   ```bash
   cd wp-content/themes/hatteras
   composer install
   ```

3. Compila gli asset frontend:

   ```bash
   npm install
   npm run build
   ```

4. Attiva il tema da **Aspetto → Temi** in WordPress.

5. In **Impostazioni → Lettura**, imposta la homepage su **I tuoi ultimi articoli** per usare il layout blog.

> La cartella del tema deve chiamarsi `hatteras`: il build Vite genera gli URL in `/wp-content/themes/hatteras/dist/`.

## Sviluppo

Avvia il dev server con hot reload:

```bash
npm run dev
```

Ricompila per la produzione:

```bash
npm run build
```

Rigenera le immagini WebP della mappa dal file sorgente in `_referenze_legacy/`:

```bash
npm run optimize-map
```

Il file sorgente atteso è:

`_referenze_legacy/Map_from_Journeys_and_Adventures_of_Captain_Hatteras_by_Jules_Verne.jpg`

## Struttura principale

| Percorso | Descrizione |
|---|---|
| `style.css` | Identità e metadati del tema |
| `theme.json` | Palette, tipografia e token WordPress |
| `functions.php` | Setup tema, font, watermark mappa |
| `resources/css/custom.css` | Stili editoriali Hatteras |
| `assets/images/` | Mappa ottimizzata (WebP) |
| `template-parts/content.php` | Card articolo in elenco |
| `template-parts/content-single.php` | Layout lettura singolo post |
| `scripts/optimize-map.mjs` | Pipeline ottimizzazione mappa |

## Crediti

- Basato su [TailPress](https://github.com/tailpress/tailpress) di Jeffrey van Rossum
- Ispirazione visiva: edizioni illustrate Hetzel e incisioni di Édouard Riou / Henri de Montaut per il *Capitano Hatteras*
- Mappa: *Journeys and Adventures of Captain Hatteras* (Jules Verne, 1860–61)

## Licenza

MIT. Vedi [LICENSE](LICENSE).
