# Widgets

Toon je geaggregeerde reviews door je hele site met de [Shopreviews.com](https://www.magmodules.nl/magento2-shopreview-com.html) widgets. Drie widget types zijn beschikbaar voor verschillende weergave behoeften.

---

## Beschikbare Widgets

| Widget | Beste Voor |
|--------|------------|
| **Textual Box** | Simpele tekst weergave met optionele sterren |
| **Carousel** | Roterende review slider |
| **Badge** | Compacte score weergave |

---

## Een Widget Aanmaken

1. Ga naar **Content** → **Widgets**
2. Klik **Add Widget**
3. Selecteer widget type (zie hieronder)
4. Selecteer je **Design Theme**
5. Klik **Continue**
6. Configureer **Storefront Properties**
7. Voeg **Layout Updates** toe voor plaatsing
8. Configureer **Widget Options**
9. Klik **Save**

---

## Textual Box Widget

Simpele tekst-gebaseerde weergave met review samenvatting en optionele sterren.

### Widget Opties

| Optie | Beschrijving |
|-------|--------------|
| **Website(s)** | Selecteer welke Shopreviews.com website te tonen |
| **Show Stars** | Toon sterbeoordeling visueel |
| **Enable Modal Link** | Maak widget klikbaar om review modal te openen |
| **Modal Type** | Type modal om te tonen wanneer geklikt |
| **Maximum Number of Reviews** | Reviews getoond in modal (indien ingeschakeld) |

### Use Cases

- Footer vertrouwensindicator
- Sidebar samenvatting
- Header vertrouwensbadge
- Productpagina social proof

### Aanbevolen Instellingen

**Footer Plaatsing:**
- Show Stars: Yes
- Enable Modal Link: Yes
- Max Reviews: 10

---

## Carousel Widget

Roterende slider die individuele reviews toont met auto-scroll mogelijkheid.

### Widget Opties

| Optie | Beschrijving |
|-------|--------------|
| **Website(s)** | Selecteer welke Shopreviews.com website te tonen |
| **Show Review Summary** | Toon algemene beoordeling samenvatting |
| **Show Sources** | Toon platform bron iconen |
| **Full Width** | Vergroot carousel naar volledige container breedte |
| **Autoplay** | Automatisch door reviews roteren |
| **Show Arrows** | Toon navigatie pijlen |
| **Show Dots** | Toon paginering stippen |
| **Total Number of Review Slides** | Hoeveel reviews op te nemen |
| **Review Text Length** | Knip review tekst af (Short/Medium/Full) |
| **Sort By** | Sorteer reviews (Newest/Highest Rated/etc.) |

### Use Cases

- Homepage uitgelichte reviews sectie
- Landing pagina testimonials
- Categorie pagina vertrouwensbouwer
- Over Ons pagina social proof

### Aanbevolen Instellingen

**Homepage Feature:**
- Show Review Summary: Yes
- Show Sources: Yes
- Autoplay: Yes
- Show Arrows: Yes
- Show Dots: Yes
- Total Slides: 10
- Text Length: Medium
- Sort By: Newest

**Sidebar Carousel:**
- Full Width: No
- Show Review Summary: No
- Total Slides: 5
- Text Length: Short

---

## Badge Widget

Compacte badge die algemene score toont, ideaal voor permanente weergave.

### Widget Opties

| Optie | Beschrijving |
|-------|--------------|
| **Website(s)** | Selecteer welke Shopreviews.com website te tonen |
| **Badge Location** | Positie stijl van de badge |
| **Show Score** | Hoe de score te tonen (numeriek, sterren, etc.) |
| **Enable Modal Link** | Maak badge klikbaar om review modal te openen |
| **Modal Type** | Type modal om te tonen wanneer geklikt |
| **Maximum Number of Reviews in Modal** | Reviews getoond wanneer modal opent |

### Use Cases

- Zwevende hoek badge
- Header vertrouwensindicator
- Footer permanente badge
- Checkout pagina vertrouwenssignaal

### Aanbevolen Instellingen

**Zwevende Badge:**
- Badge Location: Bottom Right
- Show Score: Numeric with Stars
- Enable Modal Link: Yes
- Max Reviews in Modal: 15

---

## Layout Plaatsing

### Veelvoorkomende Plaatsingen

| Locatie | Widget Type |
|---------|-------------|
| Homepage | Carousel (main), Badge (zwevend) |
| Product Pagina's | Textual Box (sidebar), Badge |
| Categorie Pagina's | Carousel (onder producten) |
| Footer | Textual Box, Badge |
| Checkout | Badge (vertrouwenssignaal) |

### Layout Update Voorbeelden

**Alle Pagina's - Footer:**
- Display on: All Pages
- Container: Footer

**Alleen Homepage:**
- Display on: Specified Page → CMS Home Page
- Container: Main Content Area

**Product Pagina's:**
- Display on: Anchor Categories
- Container: Sidebar Additional

---

## Modal Functionaliteit

Wanneer **Enable Modal Link** is ingeschakeld:
- Widget wordt klikbaar
- Opent overlay met review details
- Toont gespecificeerd aantal reviews
- Staat scrollen door meer reviews toe

### Modal Types

Verschillende modal presentaties beschikbaar:
- Lijst weergave
- Kaart weergave
- Compacte weergave

Kies op basis van je thema en weergave behoeften.

---

## Website Selectie

De **Website(s)** optie bepaalt welke Shopreviews.com website's reviews te tonen:
- Selecteer enkele website voor gefocuste weergave
- Alle reviews van geselecteerde website worden geaggregeerd
- Verschillende widgets kunnen verschillende websites tonen

---

## Styling Overwegingen

### Thema Compatibiliteit

Widgets erven basis thema styling maar bevatten eigen CSS:
- Ster kleuren kunnen thema aanpassing nodig hebben
- Modal styling komt overeen met Magento default
- Carousel gebruikt standaard slider gedrag

### Responsive Design

Alle widgets zijn responsive:
- Carousel vermindert slides op mobiel
- Badge herpositioneert passend
- Textual box stapelt op kleine schermen

### Aangepaste Styling

Om widget uiterlijk aan te passen:
1. Override CSS in je thema
2. Gebruik widget-specifieke CSS classes
3. Pas aan via thema LESS/SCSS bestanden

---

## Prestaties

### Caching

Widget content wordt gecached:
- Updates verschijnen na cache refresh
- Overweeg cache lifetime voor verse reviews
- Gebruik Varnish/FPC voor beste prestaties

### Laden

- Widgets laden met pagina content
- Modal content laadt bij klikken
- Carousel preloadt aangrenzende slides

---

## Meerdere Widgets

Je kunt meerdere widgets op dezelfde pagina gebruiken:
- Verschillende types voor verschillende gebieden
- Zelfde type met verschillende configuraties
- Verschillende websites per widget

Voorbeeld setup:
- Badge: Zwevend op alle pagina's
- Carousel: Homepage main content
- Textual Box: Product pagina sidebar

---

## Widget Probleemoplossing

### Widget Wordt Niet Getoond

1. Verifieer dat widget is opgeslagen
2. Controleer Layout Updates configuratie
3. Zorg dat reviews zijn gesynchroniseerd
4. Wis cache
5. Controleer thema compatibiliteit

### Modal Opent Niet

1. Controleer JavaScript console op fouten
2. Verifieer dat Enable Modal Link op Yes staat
3. Wis browser cache
4. Test in incognito modus

### Verkeerde Reviews Worden Getoond

1. Verifieer dat correcte Website is geselecteerd
2. Controleer review sync status
3. Bevestig Sort By instelling

---

## Meer Hulp Nodig?

**Documentatie:**
- [Alle Help Artikelen](https://www.magmodules.nl/help/magento2-shopreview-com.html) - Compleet documentatie overzicht

**Support:**
- [Contact Opnemen](https://www.magmodules.nl/contact.html) - Hulp van ons team
