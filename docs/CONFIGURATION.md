# Configuration

Complete configuration reference for the [Shopreviews.com](https://www.magmodules.eu/magento2-shopreview-com.html) extension. All settings are found under **Shopreviews.com** → **Config** → **Settings**.

---

## General

Basic extension settings and account connection.

| Setting | Description |
|---------|-------------|
| **Enabled** | Enable or disable the extension |
| **Account Information** | Displays your Shopreviews.com connection status and account details |

The account information section shows:
- Connection status
- Linked websites
- Available review sources

---

## Shopreviews Overview Page

Configure a dedicated page to display all your reviews.

### Basic Settings

| Setting | Description |
|---------|-------------|
| **Enable** | Enable the review overview page |
| **URL Path** | URL path for the page (e.g., `reviews` creates `yourstore.com/reviews`) |
| **Website** | Select which Shopreviews.com website to display reviews from |

### Filters

Enable filtering options for visitors:

| Setting | Description |
|---------|-------------|
| **Rating Filter** | Allow filtering reviews by star rating |
| **Years Filter** | Allow filtering reviews by year |
| **Sources Filter** | Allow filtering reviews by platform source |

### Layout Settings

| Setting | Description |
|---------|-------------|
| **Title** | Page title displayed in browser and on page |
| **Meta Description** | SEO meta description for the page |
| **Meta Keywords** | SEO meta keywords |
| **Layout** | Page layout template (1 column, 2 columns, etc.) |
| **Add Google Structured Data** | Add JSON-LD markup for Google rich results |
| **Reviews per page** | Number of reviews before pagination |

### SEO Considerations

- Set a descriptive **Title** including your store name
- Write a compelling **Meta Description** (150-160 characters)
- Enable **Structured Data** for potential rich results in search
- Choose appropriate **Layout** for your theme

---

## Automation

Configure automatic review synchronization.

| Setting | Description |
|---------|-------------|
| **Enable** | Enable cron-based automatic sync |
| **Frequency** | How often to sync (Every hour, Every 6 hours, etc.) |
| **Custom Frequency** | Custom cron expression (when Frequency is set to Custom) |

### Frequency Options

- **Every hour** - Most up-to-date, higher server load
- **Every 6 hours** - Good balance for most stores
- **Every 12 hours** - Lower frequency for less active review sources
- **Daily** - Once per day sync
- **Custom** - Define your own cron schedule

### Custom Cron Expression

When using custom frequency, enter a standard cron expression:
```
* * * * *
│ │ │ │ │
│ │ │ │ └── Day of week (0-7, Sunday=0 or 7)
│ │ │ └──── Month (1-12)
│ │ └────── Day of month (1-31)
│ └──────── Hour (0-23)
└────────── Minute (0-59)
```

Examples:
- `0 */6 * * *` - Every 6 hours
- `0 5,17 * * *` - At 5 AM and 5 PM daily
- `0 3 * * *` - Daily at 3 AM

---

## Debug

Development and troubleshooting settings.

| Setting | Description |
|---------|-------------|
| **Debug Logging** | Enable detailed logging for troubleshooting |

Enable debug logging only when troubleshooting issues. Disable in production to prevent log file growth.

---

## Configuration Workflow

### Initial Setup

1. Enable the extension in **General**
2. Verify account connection
3. Enable **Automation** with appropriate frequency
4. Wait for first sync to complete
5. Verify reviews in admin grid

### Adding Review Page

1. Enable in **Shopreviews Overview Page**
2. Set URL path
3. Configure filters as needed
4. Set SEO meta information
5. Enable structured data
6. Clear cache
7. Test the page

### Optimization

After initial setup:
- Adjust sync frequency based on review volume
- Fine-tune filters based on customer usage
- Monitor structured data in Google Search Console

---

## Best Practices

### Sync Frequency

- **High review volume**: Every hour or 6 hours
- **Moderate volume**: Every 12 hours
- **Low volume**: Daily

### Review Page

- Enable all filters for better user experience
- Use descriptive meta information for SEO
- Keep reviews per page at 10-20 for performance
- Enable structured data for search visibility

### Performance

- Don't sync more frequently than needed
- Disable debug logging in production
- Use appropriate reviews per page setting

---

## Need More Help?

**Documentation:**
- [All Help Articles](https://www.magmodules.eu/help/magento2-shopreview-com.html) - Complete documentation overview

**Support:**
- [Contact Support](https://www.magmodules.eu/contact.html) - Get help from our team
