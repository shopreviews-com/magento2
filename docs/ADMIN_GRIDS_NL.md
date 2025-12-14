# Admin Grids

Beheer je gesynchroniseerde review data met de [Shopreviews.com](https://www.magmodules.nl/magento2-shopreview-com.html) admin grids. Vier grids bieden zicht op je reviews, bronnen, platformen en websites.

---

## Toegang tot de Grids

Navigeer naar **Shopreviews.com** → **Data** voor toegang tot:
- Reviews
- Sources
- Platforms
- Websites

---

## Reviews Grid

Bekijk alle reviews gesynchroniseerd van je verbonden platformen.

**Locatie:** Shopreviews.com → Data → Reviews

### Grid Kolommen

| Kolom | Beschrijving |
|-------|--------------|
| **Entity ID** | Interne Magento ID |
| **Review UUID** | Unieke review identifier van Shopreviews.com |
| **Name** | Reviewer naam |
| **Email** | Reviewer email (indien beschikbaar) |
| **Description** | Review inhoud/tekst |
| **Rating** | Gegeven sterbeoordeling |
| **Locale Code** | Taal/regio van review |
| **Review Date** | Wanneer review oorspronkelijk is geplaatst |
| **Fetched At** | Wanneer review is gesynchroniseerd naar Magento |
| **Source** | Platform waar review vandaan komt |
| **Platform** | Review platform identifier |

### Reviews Filteren

Filter reviews op:
- Rating (vind lage/hoge beoordelingen)
- Source (specifiek platform)
- Datumbereik (recente reviews)
- Locale (taal)

### Use Cases

- Monitor algemeen review sentiment
- Vind recente reviews
- Identificeer reviews die aandacht nodig hebben
- Track review volume over tijd

---

## Sources Grid

Bekijk alle review bronnen verbonden aan je Shopreviews.com account.

**Locatie:** Shopreviews.com → Data → Sources

### Grid Kolommen

| Kolom | Beschrijving |
|-------|--------------|
| **Entity ID** | Interne Magento ID |
| **Source UUID** | Unieke bron identifier |
| **Name** | Bron/platform naam |
| **Logo URL** | Platform logo afbeelding |
| **URL** | Bron website URL |
| **Review Link** | Directe link naar reviews |
| **Review Count** | Aantal reviews van deze bron |
| **Average Rating** | Gemiddelde beoordeling van deze bron |
| **Last Sync At** | Wanneer bron laatst is gesynchroniseerd |
| **Next Sync At** | Geplande volgende sync tijd |

### Bronnen Begrijpen

Een bron vertegenwoordigt een specifieke verbinding met een review platform:
- Google Business vermelding
- Trustpilot bedrijfsprofiel
- Facebook Business pagina
- Kiyoh account
- etc.

### Bronnen Monitoren

Controleer bronnen regelmatig op:
- Laatste sync tijd (zorg dat synchronisatie werkt)
- Review count (track groei)
- Gemiddelde beoordeling (monitor tevredenheid)

---

## Platforms Grid

Bekijk alle beschikbare review platformen in het Shopreviews.com ecosysteem.

**Locatie:** Shopreviews.com → Data → Platforms

### Grid Kolommen

| Kolom | Beschrijving |
|-------|--------------|
| **Entity ID** | Interne Magento ID |
| **Platform UUID** | Unieke platform identifier |
| **Name** | Platform naam (Google, Trustpilot, etc.) |
| **Logo** | Platform logo |
| **Logo Icon** | Klein platform icoon |
| **Is Active** | Of platform actief is |
| **Created At** | Wanneer platform is toegevoegd |
| **Updated At** | Laatste platform update |

### Beschikbare Platformen

Het grid toont alle platformen die Shopreviews.com ondersteunt:
- Google Business Reviews
- Trustpilot
- Facebook Business
- WebwinkelKeur
- Kiyoh
- TrustedShops
- The FeedbackCompany
- Ekomi
- YellowPages
- Etsy Marketplace
- eBay Marketplace
- Stamped
- En meer

### Platform Status

**Is Active** geeft aan of:
- Platform beschikbaar is voor verbindingen
- Je account toegang heeft tot dit platform
- Reviews kunnen worden gesynchroniseerd van dit platform

---

## Websites Grid

Bekijk je Shopreviews.com websites en hun geaggregeerde statistieken.

**Locatie:** Shopreviews.com → Data → Websites

### Grid Kolommen

| Kolom | Beschrijving |
|-------|--------------|
| **Entity ID** | Interne Magento ID |
| **Website UUID** | Unieke website identifier |
| **Name** | Website naam in Shopreviews.com |
| **Logo URL** | Website logo |
| **Details** | Extra website informatie |
| **Review Count** | Totaal reviews over alle bronnen |
| **Average Rating** | Algemene gemiddelde beoordeling |
| **Source Count** | Aantal verbonden bronnen |
| **Best Rating** | Maximum beoordelingsschaal (meestal 5) |
| **Worst Rating** | Minimum beoordelingsschaal (meestal 0 of 1) |
| **Is Active** | Website actieve status |
| **Score Summary** | Geaggregeerde score uitsplitsing |

### Website Statistieken

Het websites grid biedt waardevolle geaggregeerde data:
- **Review Count** - Totaal reviews van alle platformen
- **Average Rating** - Gecombineerd gemiddelde over bronnen
- **Source Count** - Hoeveel platformen zijn verbonden

### Meerdere Websites

Als je meerdere Shopreviews.com websites hebt:
- Elk verschijnt als aparte rij
- Gebruik verschillende websites voor verschillende Magento winkels
- Selecteer website in widgets/configuratie

---

## Grid Functies

### Standaard Magento Grid Functies

Alle grids ondersteunen:
- **Kolom sorteren** - Klik headers om te sorteren
- **Filteren** - Gebruik filter inputs boven kolommen
- **Paginering** - Navigeer door grote datasets
- **Kolom zichtbaarheid** - Toon/verberg kolommen
- **Export** - Exporteer data naar CSV/Excel

### Best Practices

**Regelmatige Monitoring:**
- Controleer Reviews grid wekelijks voor nieuwe reviews
- Monitor Sources voor sync problemen
- Verifieer Website statistieken komen overeen met verwachtingen

**Probleemoplossing:**
- Gebruik Fetched At om sync problemen te identificeren
- Controleer Last Sync At op bronnen
- Vergelijk Review Count over grids

---

## Data Relaties

Begrijpen hoe data verbindt:

```
Website
  └── Sources (meerdere)
        └── Reviews (veel)
              └── Platform (één)
```

- **Websites** bevatten meerdere **Sources**
- **Sources** hebben veel **Reviews**
- Elke **Review** komt van één **Platform** via één **Source**

---

## Veelvoorkomende Taken

### Vind Recente Reviews

1. Ga naar Reviews grid
2. Filter op Fetched At: Laatste 7 dagen
3. Sorteer op Review Date aflopend

### Controleer Sync Status

1. Ga naar Sources grid
2. Controleer Last Sync At kolom
3. Verifieer dat tijden recent zijn
4. Indien verouderd, controleer automatisering instellingen

### Bekijk Platform Dekking

1. Ga naar Platforms grid
2. Filter Is Active: Yes
3. Vergelijk met je Shopreviews.com dashboard

### Verifieer Geaggregeerde Statistieken

1. Ga naar Websites grid
2. Controleer Review Count en Average Rating
3. Vergelijk met Shopreviews.com dashboard

---

## Meer Hulp Nodig?

**Documentatie:**
- [Alle Help Artikelen](https://www.magmodules.nl/help/magento2-shopreview-com.html) - Compleet documentatie overzicht

**Support:**
- [Contact Opnemen](https://www.magmodules.nl/contact.html) - Hulp van ons team
