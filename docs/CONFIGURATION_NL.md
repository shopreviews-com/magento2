# Configuratie

Complete configuratie referentie voor de [Shopreviews.com](https://www.magmodules.nl/magento2-shopreview-com.html) extensie. Alle instellingen zijn te vinden onder **Shopreviews.com** → **Config** → **Settings**.

---

## General

Basis extensie instellingen en account verbinding.

| Instelling | Beschrijving |
|------------|--------------|
| **Enabled** | Schakel de extensie in of uit |
| **Account Information** | Toont je Shopreviews.com verbindingsstatus en account details |

De account informatie sectie toont:
- Verbindingsstatus
- Gekoppelde websites
- Beschikbare review bronnen

---

## Shopreviews Overview Page

Configureer een speciale pagina om al je reviews te tonen.

### Basis Instellingen

| Instelling | Beschrijving |
|------------|--------------|
| **Enable** | Schakel de review overzichtspagina in |
| **URL Path** | URL pad voor de pagina (bijv. `reviews` maakt `jouwwinkel.nl/reviews`) |
| **Website** | Selecteer van welke Shopreviews.com website reviews te tonen |

### Filters

Schakel filteropties in voor bezoekers:

| Instelling | Beschrijving |
|------------|--------------|
| **Rating Filter** | Sta filteren op sterbeoordeling toe |
| **Years Filter** | Sta filteren op jaar toe |
| **Sources Filter** | Sta filteren op platform bron toe |

### Layout Instellingen

| Instelling | Beschrijving |
|------------|--------------|
| **Title** | Paginatitel getoond in browser en op pagina |
| **Meta Description** | SEO meta beschrijving voor de pagina |
| **Meta Keywords** | SEO meta keywords |
| **Layout** | Pagina layout template (1 kolom, 2 kolommen, etc.) |
| **Add Google Structured Data** | Voeg JSON-LD markup toe voor Google rich results |
| **Reviews per page** | Aantal reviews voor paginering |

### SEO Overwegingen

- Stel een beschrijvende **Title** in inclusief je winkelnaam
- Schrijf een overtuigende **Meta Description** (150-160 karakters)
- Schakel **Structured Data** in voor potentiële rich results in zoekresultaten
- Kies passende **Layout** voor je thema

---

## Automation

Configureer automatische review synchronisatie.

| Instelling | Beschrijving |
|------------|--------------|
| **Enable** | Schakel cron-gebaseerde automatische sync in |
| **Frequency** | Hoe vaak te synchroniseren (Every hour, Every 6 hours, etc.) |
| **Custom Frequency** | Aangepaste cron expressie (wanneer Frequency op Custom staat) |

### Frequentie Opties

- **Every hour** - Meest actueel, hogere serverbelasting
- **Every 6 hours** - Goede balans voor de meeste winkels
- **Every 12 hours** - Lagere frequentie voor minder actieve review bronnen
- **Daily** - Eenmaal per dag sync
- **Custom** - Definieer je eigen cron schema

### Aangepaste Cron Expressie

Bij gebruik van aangepaste frequentie, voer een standaard cron expressie in:
```
* * * * *
│ │ │ │ │
│ │ │ │ └── Dag van week (0-7, Zondag=0 of 7)
│ │ │ └──── Maand (1-12)
│ │ └────── Dag van maand (1-31)
│ └──────── Uur (0-23)
└────────── Minuut (0-59)
```

Voorbeelden:
- `0 */6 * * *` - Elke 6 uur
- `0 5,17 * * *` - Om 5 uur 's ochtends en 5 uur 's middags dagelijks
- `0 3 * * *` - Dagelijks om 3 uur 's nachts

---

## Debug

Ontwikkeling en probleemoplossing instellingen.

| Instelling | Beschrijving |
|------------|--------------|
| **Debug Logging** | Schakel gedetailleerde logging in voor probleemoplossing |

Schakel debug logging alleen in bij probleemoplossing. Schakel uit in productie om logbestand groei te voorkomen.

---

## Configuratie Workflow

### Initiële Setup

1. Schakel de extensie in bij **General**
2. Verifieer account verbinding
3. Schakel **Automation** in met passende frequentie
4. Wacht tot eerste sync is voltooid
5. Verifieer reviews in admin grid

### Review Pagina Toevoegen

1. Schakel in bij **Shopreviews Overview Page**
2. Stel URL pad in
3. Configureer filters waar nodig
4. Stel SEO meta informatie in
5. Schakel structured data in
6. Wis cache
7. Test de pagina

### Optimalisatie

Na initiële setup:
- Pas sync frequentie aan op basis van review volume
- Verfijn filters op basis van klantgebruik
- Monitor structured data in Google Search Console

---

## Best Practices

### Sync Frequentie

- **Hoog review volume**: Elk uur of 6 uur
- **Gemiddeld volume**: Elke 12 uur
- **Laag volume**: Dagelijks

### Review Pagina

- Schakel alle filters in voor betere gebruikerservaring
- Gebruik beschrijvende meta informatie voor SEO
- Houd reviews per pagina op 10-20 voor prestaties
- Schakel structured data in voor zoekzichtbaarheid

### Prestaties

- Synchroniseer niet vaker dan nodig
- Schakel debug logging uit in productie
- Gebruik passende reviews per pagina instelling

---

## Meer Hulp Nodig?

**Documentatie:**
- [Alle Help Artikelen](https://www.magmodules.nl/help/magento2-shopreview-com.html) - Compleet documentatie overzicht

**Support:**
- [Contact Opnemen](https://www.magmodules.nl/contact.html) - Hulp van ons team
