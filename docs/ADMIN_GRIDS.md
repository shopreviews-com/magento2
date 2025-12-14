# Admin Grids

Manage your synced review data with the [Shopreviews.com](https://www.magmodules.eu/magento2-shopreview-com.html) admin grids. Four grids provide visibility into your reviews, sources, platforms, and websites.

---

## Accessing the Grids

Navigate to **Shopreviews.com** → **Data** to access:
- Reviews
- Sources
- Platforms
- Websites

---

## Reviews Grid

View all reviews synced from your connected platforms.

**Location:** Shopreviews.com → Data → Reviews

### Grid Columns

| Column | Description |
|--------|-------------|
| **Entity ID** | Internal Magento ID |
| **Review UUID** | Unique review identifier from Shopreviews.com |
| **Name** | Reviewer name |
| **Email** | Reviewer email (if available) |
| **Description** | Review content/text |
| **Rating** | Star rating given |
| **Locale Code** | Language/region of review |
| **Review Date** | When review was originally posted |
| **Fetched At** | When review was synced to Magento |
| **Source** | Platform the review came from |
| **Platform** | Review platform identifier |

### Filtering Reviews

Filter reviews by:
- Rating (find low/high ratings)
- Source (specific platform)
- Date range (recent reviews)
- Locale (language)

### Use Cases

- Monitor overall review sentiment
- Find recent reviews
- Identify reviews needing attention
- Track review volume over time

---

## Sources Grid

View all review sources connected to your Shopreviews.com account.

**Location:** Shopreviews.com → Data → Sources

### Grid Columns

| Column | Description |
|--------|-------------|
| **Entity ID** | Internal Magento ID |
| **Source UUID** | Unique source identifier |
| **Name** | Source/platform name |
| **Logo URL** | Platform logo image |
| **URL** | Source website URL |
| **Review Link** | Direct link to reviews |
| **Review Count** | Number of reviews from this source |
| **Average Rating** | Average rating from this source |
| **Last Sync At** | When source was last synchronized |
| **Next Sync At** | Scheduled next sync time |

### Understanding Sources

A source represents a specific connection to a review platform:
- Google Business listing
- Trustpilot company profile
- Facebook Business page
- Kiyoh account
- etc.

### Monitoring Sources

Check sources regularly for:
- Last sync time (ensure syncing)
- Review count (track growth)
- Average rating (monitor satisfaction)

---

## Platforms Grid

View all available review platforms in the Shopreviews.com ecosystem.

**Location:** Shopreviews.com → Data → Platforms

### Grid Columns

| Column | Description |
|--------|-------------|
| **Entity ID** | Internal Magento ID |
| **Platform UUID** | Unique platform identifier |
| **Name** | Platform name (Google, Trustpilot, etc.) |
| **Logo** | Platform logo |
| **Logo Icon** | Small platform icon |
| **Is Active** | Whether platform is active |
| **Created At** | When platform was added |
| **Updated At** | Last platform update |

### Available Platforms

The grid shows all platforms Shopreviews.com supports:
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
- And more

### Platform Status

**Is Active** indicates whether:
- Platform is available for connections
- Your account has access to this platform
- Reviews can be synced from this platform

---

## Websites Grid

View your Shopreviews.com websites and their aggregated statistics.

**Location:** Shopreviews.com → Data → Websites

### Grid Columns

| Column | Description |
|--------|-------------|
| **Entity ID** | Internal Magento ID |
| **Website UUID** | Unique website identifier |
| **Name** | Website name in Shopreviews.com |
| **Logo URL** | Website logo |
| **Details** | Additional website information |
| **Review Count** | Total reviews across all sources |
| **Average Rating** | Overall average rating |
| **Source Count** | Number of connected sources |
| **Best Rating** | Maximum rating scale (usually 5) |
| **Worst Rating** | Minimum rating scale (usually 0 or 1) |
| **Is Active** | Website active status |
| **Score Summary** | Aggregated score breakdown |

### Website Statistics

The websites grid provides valuable aggregate data:
- **Review Count** - Total reviews from all platforms
- **Average Rating** - Combined average across sources
- **Source Count** - How many platforms are connected

### Multiple Websites

If you have multiple Shopreviews.com websites:
- Each appears as separate row
- Use different websites for different Magento stores
- Select website in widgets/configuration

---

## Grid Features

### Standard Magento Grid Functions

All grids support:
- **Column sorting** - Click headers to sort
- **Filtering** - Use filter inputs above columns
- **Pagination** - Navigate through large datasets
- **Column visibility** - Show/hide columns
- **Export** - Export data to CSV/Excel

### Best Practices

**Regular Monitoring:**
- Check Reviews grid weekly for new reviews
- Monitor Sources for sync issues
- Verify Website statistics match expectations

**Troubleshooting:**
- Use Fetched At to identify sync issues
- Check Last Sync At on sources
- Compare Review Count across grids

---

## Data Relationships

Understanding how data connects:

```
Website
  └── Sources (multiple)
        └── Reviews (many)
              └── Platform (one)
```

- **Websites** contain multiple **Sources**
- **Sources** have many **Reviews**
- Each **Review** comes from one **Platform** via one **Source**

---

## Common Tasks

### Find Recent Reviews

1. Go to Reviews grid
2. Filter by Fetched At: Last 7 days
3. Sort by Review Date descending

### Check Sync Status

1. Go to Sources grid
2. Check Last Sync At column
3. Verify times are recent
4. If outdated, check automation settings

### View Platform Coverage

1. Go to Platforms grid
2. Filter Is Active: Yes
3. Compare to your Shopreviews.com dashboard

### Verify Aggregate Statistics

1. Go to Websites grid
2. Check Review Count and Average Rating
3. Compare to Shopreviews.com dashboard

---

## Need More Help?

**Documentation:**
- [All Help Articles](https://www.magmodules.eu/help/magento2-shopreview-com.html) - Complete documentation overview

**Support:**
- [Contact Support](https://www.magmodules.eu/contact.html) - Get help from our team
