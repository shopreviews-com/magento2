# Snelstartgids

Krijg je [Shopreviews.com](https://www.magmodules.nl/magento2-shopreview-com.html) integratie snel werkend. Deze gids behandelt het verbinden van je Shopreviews.com account en het tonen van reviews in je Magento winkel.

---

## Vereisten

Zorg voordat je begint dat je hebt:
- Magento 2.4.4 of hoger
- PHP 7.4 of hoger
- Admin toegang tot je Magento winkel
- Actief Shopreviews.com account met verbonden review bronnen

---

## Stap 1: Schakel de Extensie In

1. Ga naar **Shopreviews.com** → **Config** → **Settings**
2. In de **General** sectie, zet **Enabled** op **Yes**
3. Klik **Save Config**
4. Wis cache: **System** → **Cache Management** → **Flush Magento Cache**

---

## Stap 2: Verbind Je Account

De extensie verbindt automatisch met je Shopreviews.com account. Na inschakelen:

1. De **Account Information** sectie toont je verbindingsstatus
2. Je websites geconfigureerd in Shopreviews.com zijn beschikbaar
3. Review bronnen gekoppeld aan je account worden automatisch gesynchroniseerd

---

## Stap 3: Schakel Automatische Sync In

1. Ga naar **Shopreviews.com** → **Config** → **Settings**
2. In de **Automation** sectie:
   - Zet **Enable** op **Yes**
   - Selecteer **Frequency** (bijv. Every 6 hours)
3. Klik **Save Config**

De cron job haalt automatisch nieuwe reviews op van alle verbonden platformen.

---

## Stap 4: Configureer Review Pagina (Optioneel)

Maak een speciale reviews pagina:

1. In de **Shopreviews Overview Page** sectie:
   - Zet **Enable** op **Yes**
   - Voer **URL Path** in (bijv. `reviews`)
   - Selecteer **Website** om te tonen
2. Configureer filters:
   - **Rating Filter** - Filter op sterbeoordeling
   - **Years Filter** - Filter op datum
   - **Sources Filter** - Filter op platform
3. Stel layout opties in:
   - **Title** - Pagina titel
   - **Meta Description** - SEO beschrijving
   - **Reviews per page** - Paginering
4. Klik **Save Config**

Je review pagina is beschikbaar op: `jouwwinkel.nl/reviews`

---

## Stap 5: Voeg Widget Toe (Optioneel)

1. Ga naar **Content** → **Widgets** → **Add Widget**
2. Selecteer widget type:
   - **Shopreviews-com Textual Box Widget** - Simpele tekst weergave
   - **Shopreviews-com Carousel Widget** - Roterende reviews
   - **Shopreviews-com Badge Widget** - Compacte score badge
3. Configureer widget opties
4. Stel plaatsing in bij **Layout Updates**
5. Klik **Save**

---

## Stap 6: Verifieer Setup

1. Controleer gesynchroniseerde data in **Shopreviews.com** → **Data**:
   - **Reviews** - Alle gesynchroniseerde reviews
   - **Sources** - Verbonden review platformen
   - **Platforms** - Beschikbare platformen
   - **Websites** - Je Shopreviews.com websites
2. Bezoek je review pagina (indien ingeschakeld)
3. Verifieer dat widgets correct worden getoond

---

## Verificatie Checklist

Na setup, verifieer:
- Extensie is ingeschakeld
- Account is verbonden (getoond in General settings)
- Cron sync is ingeschakeld
- Reviews verschijnen in het Reviews grid
- Review pagina is toegankelijk (indien ingeschakeld)
- Widgets worden correct getoond (indien geconfigureerd)

---

## Wat Nu?

- [Configuratie](https://www.magmodules.nl/help/magento2-shopreview-com.html) - Ontdek alle instellingen
- [Widgets](https://www.magmodules.nl/help/magento2-shopreview-com.html) - Widget aanpassingsopties
- [Admin Grids](https://www.magmodules.nl/help/magento2-shopreview-com.html) - Gesynchroniseerde data beheren

---

## Meer Hulp Nodig?

**Documentatie:**
- [Alle Help Artikelen](https://www.magmodules.nl/help/magento2-shopreview-com.html) - Compleet documentatie overzicht

**Support:**
- [Contact Opnemen](https://www.magmodules.nl/contact.html) - Hulp van ons team
