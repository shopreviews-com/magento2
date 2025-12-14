# Quick Start Guide

Get your [Shopreviews.com](https://www.magmodules.eu/magento2-shopreview-com.html) integration up and running quickly. This guide covers connecting your Shopreviews.com account and displaying reviews in your Magento store.

---

## Prerequisites

Before you begin, ensure you have:
- Magento 2.4.4 or higher
- PHP 7.4 or higher
- Admin access to your Magento store
- Active Shopreviews.com account with connected review sources

---

## Step 1: Enable the Extension

1. Go to **Shopreviews.com** → **Config** → **Settings**
2. In the **General** section, set **Enabled** to **Yes**
3. Click **Save Config**
4. Clear cache: **System** → **Cache Management** → **Flush Magento Cache**

---

## Step 2: Connect Your Account

The extension automatically connects to your Shopreviews.com account. After enabling:

1. The **Account Information** section displays your connection status
2. Your websites configured in Shopreviews.com will be available
3. Review sources linked to your account will sync automatically

---

## Step 3: Enable Automatic Sync

1. Go to **Shopreviews.com** → **Config** → **Settings**
2. In the **Automation** section:
   - Set **Enable** to **Yes**
   - Select **Frequency** (e.g., Every 6 hours)
3. Click **Save Config**

The cron job will automatically pull new reviews from all connected platforms.

---

## Step 4: Configure Review Page (Optional)

Create a dedicated reviews page:

1. In the **Shopreviews Overview Page** section:
   - Set **Enable** to **Yes**
   - Enter **URL Path** (e.g., `reviews`)
   - Select **Website** to display
2. Configure filters:
   - **Rating Filter** - Filter by star rating
   - **Years Filter** - Filter by date
   - **Sources Filter** - Filter by platform
3. Set layout options:
   - **Title** - Page title
   - **Meta Description** - SEO description
   - **Reviews per page** - Pagination
4. Click **Save Config**

Your review page will be available at: `yourstore.com/reviews`

---

## Step 5: Add Widget (Optional)

1. Go to **Content** → **Widgets** → **Add Widget**
2. Select widget type:
   - **Shopreviews-com Textual Box Widget** - Simple text display
   - **Shopreviews-com Carousel Widget** - Rotating reviews
   - **Shopreviews-com Badge Widget** - Compact score badge
3. Configure widget options
4. Set placement in **Layout Updates**
5. Click **Save**

---

## Step 6: Verify Setup

1. Check synced data in **Shopreviews.com** → **Data**:
   - **Reviews** - All synced reviews
   - **Sources** - Connected review platforms
   - **Platforms** - Available platforms
   - **Websites** - Your Shopreviews.com websites
2. Visit your review page (if enabled)
3. Verify widgets display correctly

---

## Verification Checklist

After setup, verify:
- Extension is enabled
- Account is connected (shown in General settings)
- Cron sync is enabled
- Reviews appear in the Reviews grid
- Review page is accessible (if enabled)
- Widgets display correctly (if configured)

---

## What's Next?

- [Configuration](https://www.magmodules.eu/help/magento2-shopreview-com.html) - Explore all settings
- [Widgets](https://www.magmodules.eu/help/magento2-shopreview-com.html) - Widget customization options
- [Admin Grids](https://www.magmodules.eu/help/magento2-shopreview-com.html) - Managing synced data

---

## Need More Help?

**Documentation:**
- [All Help Articles](https://www.magmodules.eu/help/magento2-shopreview-com.html) - Complete documentation overview

**Support:**
- [Contact Support](https://www.magmodules.eu/contact.html) - Get help from our team
