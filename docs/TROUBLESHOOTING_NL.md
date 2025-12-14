# Probleemoplossing

Oplossingen voor veelvoorkomende problemen met de [Shopreviews.com](https://www.magmodules.nl/magento2-shopreview-com.html) extensie.

---

## Veelvoorkomende Problemen

### Reviews Synchroniseren Niet

**Symptomen:**
- Reviews grid is leeg
- Geen nieuwe reviews verschijnen
- Laatste sync datum wordt niet bijgewerkt

**Oplossingen:**
1. Verifieer dat extensie is ingeschakeld in configuratie
2. Controleer account verbindingsstatus in **General** instellingen
3. Zorg dat **Automation** is ingeschakeld met geldige frequentie
4. Verifieer dat Magento cron draait:
   ```bash
   bin/magento cron:run
   ```
5. Controleer of reviews bestaan in je Shopreviews.com dashboard
6. Bekijk logs voor sync fouten

---

### Account Niet Verbonden

**Symptomen:**
- Account Information toont niet verbonden status
- Geen websites beschikbaar in dropdown
- Lege bronnen lijst

**Oplossingen:**
1. Verifieer dat je Shopreviews.com account actief is
2. Controleer of API credentials correct zijn geconfigureerd
3. Zorg dat je server Shopreviews.com API kan bereiken
4. Wis Magento cache en herlaad configuratie
5. Neem contact op met Shopreviews.com support als verbinding aanhoudt

---

### Review Pagina Niet Toegankelijk

**Symptomen:**
- 404 fout op review pagina URL
- Lege pagina bij bezoeken reviews

**Oplossingen:**
1. Verifieer dat **Shopreviews Overview Page** is ingeschakeld
2. Controleer of URL pad correct is ingesteld
3. Wis cache: `bin/magento cache:flush`
4. Controleer URL rewrites:
   ```bash
   bin/magento indexer:reindex
   ```
5. Verifieer dat website is geselecteerd in configuratie

---

### Widget Wordt Niet Getoond

**Symptomen:**
- Widget geconfigureerd maar niet zichtbaar
- Leeg widget gebied
- Widget toont laden maar geen content

**Oplossingen:**
1. Verifieer dat widget is opgeslagen en toegewezen aan layout
2. Controleer **Layout Updates** configuratie
3. Zorg dat reviews bestaan in het systeem
4. Verifieer dat correcte website is geselecteerd in widget
5. Wis cache: `bin/magento cache:flush`
6. Controleer browser console op JavaScript fouten

---

### Ontbrekende Reviews van Specifiek Platform

**Symptomen:**
- Reviews van één platform verschijnen niet
- Sommige bronnen tonen 0 reviews

**Oplossingen:**
1. Controleer bron status in **Shopreviews.com** → **Data** → **Sources**
2. Verifieer dat bron is verbonden in je Shopreviews.com dashboard
3. Controleer laatste sync datum voor de bron
4. Forceer een handmatige sync via Shopreviews.com dashboard
5. Wacht op volgende cron cyclus

---

### Structured Data Verschijnt Niet

**Symptomen:**
- Geen JSON-LD in paginabron
- Google Rich Results Test toont geen data

**Oplossingen:**
1. Verifieer dat **Add Google Structured Data** is ingeschakeld
2. Wis full page cache
3. Controleer paginabron op `application/ld+json` script
4. Zorg dat reviews bestaan voor de pagina
5. Test met Google Rich Results Test tool

---

### Cron Draait Niet

**Symptomen:**
- Reviews worden nooit automatisch bijgewerkt
- Sync werkt alleen handmatig

**Oplossingen:**
1. Verifieer dat Magento cron is geconfigureerd:
   ```bash
   crontab -l
   ```
2. Controleer of cron draait:
   ```bash
   bin/magento cron:run --group=default
   ```
3. Verifieer dat **Automation** is ingeschakeld in configuratie
4. Controleer cron frequentie instelling
5. Bekijk `var/log/cron.log` voor fouten

---

### Langzaam Laden van Pagina

**Symptomen:**
- Review pagina laadt langzaam
- Widgets veroorzaken pagina vertraging

**Oplossingen:**
1. Verlaag **Reviews per page** instelling
2. Schakel Magento full page cache in
3. Controleer server resources
4. Optimaliseer widget plaatsing
5. Bekijk database query prestaties

---

## Sync Problemen

### Handmatige Sync

Als automatische sync niet werkt, kun je sync triggeren via:
1. Shopreviews.com dashboard
2. Wacht op volgende cron cyclus na het oplossen van problemen

### Sync Frequentie

Als reviews vertraagd zijn:
- Verhoog sync frequentie in **Automation** instellingen
- Controleer of cron draait op verwachte intervallen
- Verifieer dat server timezone overeenkomt met verwachtingen

---

## Debug Modus

Schakel gedetailleerde logging in voor probleemoplossing:

1. Ga naar **Shopreviews.com** → **Config** → **Settings**
2. In **Debug** sectie, schakel logging in
3. Reproduceer het probleem
4. Controleer logs in `var/log/` directory
5. **Schakel debug logging uit** na probleemoplossing

---

## Cache Beheer

Na configuratie wijzigingen, wis altijd cache:

```bash
bin/magento cache:flush
bin/magento cache:clean
```

Specifieke situaties:
- **config** - Na elke configuratie wijziging
- **full_page** - Na widget of layout wijzigingen
- **layout** - Na thema aanpassingen

---

## Log Bestanden om te Controleren

| Log Bestand | Bevat |
|-------------|-------|
| `var/log/exception.log` | PHP exceptions en fouten |
| `var/log/system.log` | Algemene Magento systeem logs |
| `var/log/cron.log` | Cron uitvoering logs |
| `var/log/debug.log` | Debug informatie (indien ingeschakeld) |

---

## Connectiviteit Problemen

### API Verbinding

Als de extensie geen verbinding kan maken met Shopreviews.com:
1. Controleer of server firewall uitgaande HTTPS toestaat
2. Verifieer dat SSL certificaten up-to-date zijn
3. Test API endpoint toegankelijkheid
4. Controleer op proxy configuratie vereisten

### CSP (Content Security Policy)

De extensie bevat CSP whitelist. Als je CSP fouten ziet:
1. Controleer browser console op geblokkeerde resources
2. Verifieer CSP configuratie in Magento
3. Voeg vereiste domeinen toe aan CSP whitelist indien nodig

---

## Nog Steeds Problemen?

Als bovenstaande oplossingen je probleem niet oplossen:

1. Schakel debug logging in
2. Controleer alle log bestanden op fouten
3. Test met standaard Magento thema
4. Schakel andere extensies uit om conflicten te identificeren
5. Verifieer dat Shopreviews.com dashboard verwachte data toont

**Documentatie:**
- [Alle Help Artikelen](https://www.magmodules.nl/help/magento2-shopreview-com.html) - Compleet documentatie overzicht

**Support:**
- [Contact Opnemen](https://www.magmodules.nl/contact.html) - Hulp van ons team

Bij contact met support, inclusief:
- Relevante log entries
- Magento en PHP versie
- Shopreviews.com account details
- Stappen om probleem te reproduceren
