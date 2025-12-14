# Troubleshooting

Solutions for common issues with the [Shopreviews.com](https://www.magmodules.eu/magento2-shopreview-com.html) extension.

---

## Common Issues

### Reviews Not Syncing

**Symptoms:**
- Reviews grid is empty
- No new reviews appearing
- Last sync date not updating

**Solutions:**
1. Verify extension is enabled in configuration
2. Check account connection status in **General** settings
3. Ensure **Automation** is enabled with valid frequency
4. Verify Magento cron is running:
   ```bash
   bin/magento cron:run
   ```
5. Check if reviews exist in your Shopreviews.com dashboard
6. Review logs for sync errors

---

### Account Not Connected

**Symptoms:**
- Account Information shows disconnected status
- No websites available in dropdown
- Empty sources list

**Solutions:**
1. Verify your Shopreviews.com account is active
2. Check API credentials are correctly configured
3. Ensure your server can reach Shopreviews.com API
4. Clear Magento cache and reload configuration
5. Contact Shopreviews.com support if connection persists

---

### Review Page Not Accessible

**Symptoms:**
- 404 error on review page URL
- Blank page when accessing reviews

**Solutions:**
1. Verify **Shopreviews Overview Page** is enabled
2. Check URL path is correctly set
3. Clear cache: `bin/magento cache:flush`
4. Check URL rewrites:
   ```bash
   bin/magento indexer:reindex
   ```
5. Verify website is selected in configuration

---

### Widget Not Displaying

**Symptoms:**
- Widget configured but not visible
- Empty widget area
- Widget shows loading but no content

**Solutions:**
1. Verify widget is saved and assigned to layout
2. Check **Layout Updates** configuration
3. Ensure reviews exist in the system
4. Verify correct website is selected in widget
5. Clear cache: `bin/magento cache:flush`
6. Check browser console for JavaScript errors

---

### Missing Reviews from Specific Platform

**Symptoms:**
- Reviews from one platform not appearing
- Some sources showing 0 reviews

**Solutions:**
1. Check source status in **Shopreviews.com** → **Data** → **Sources**
2. Verify the source is connected in your Shopreviews.com dashboard
3. Check last sync date for the source
4. Force a manual sync through Shopreviews.com dashboard
5. Wait for next cron cycle

---

### Structured Data Not Appearing

**Symptoms:**
- No JSON-LD in page source
- Google Rich Results Test shows no data

**Solutions:**
1. Verify **Add Google Structured Data** is enabled
2. Clear full page cache
3. Check page source for `application/ld+json` script
4. Ensure reviews exist for the page
5. Test with Google Rich Results Test tool

---

### Cron Not Running

**Symptoms:**
- Reviews never update automatically
- Sync only works manually

**Solutions:**
1. Verify Magento cron is configured:
   ```bash
   crontab -l
   ```
2. Check cron is running:
   ```bash
   bin/magento cron:run --group=default
   ```
3. Verify **Automation** is enabled in configuration
4. Check cron frequency setting
5. Review `var/log/cron.log` for errors

---

### Slow Page Loading

**Symptoms:**
- Review page loads slowly
- Widgets cause page delay

**Solutions:**
1. Reduce **Reviews per page** setting
2. Enable Magento full page cache
3. Check server resources
4. Optimize widget placement
5. Review database query performance

---

## Sync Issues

### Manual Sync

If automatic sync isn't working, you can trigger sync through:
1. Shopreviews.com dashboard
2. Wait for next cron cycle after fixing issues

### Sync Frequency

If reviews are delayed:
- Increase sync frequency in **Automation** settings
- Check cron is running at expected intervals
- Verify server timezone matches expectations

---

## Debug Mode

Enable detailed logging for troubleshooting:

1. Go to **Shopreviews.com** → **Config** → **Settings**
2. In **Debug** section, enable logging
3. Reproduce the issue
4. Check logs in `var/log/` directory
5. **Disable debug logging** after troubleshooting

---

## Cache Management

After configuration changes, always clear cache:

```bash
bin/magento cache:flush
bin/magento cache:clean
```

Specific situations:
- **config** - After any configuration change
- **full_page** - After widget or layout changes
- **layout** - After theme modifications

---

## Log Files to Check

| Log File | Contains |
|----------|----------|
| `var/log/exception.log` | PHP exceptions and errors |
| `var/log/system.log` | General Magento system logs |
| `var/log/cron.log` | Cron execution logs |
| `var/log/debug.log` | Debug information (when enabled) |

---

## Connectivity Issues

### API Connection

If the extension can't connect to Shopreviews.com:
1. Check server firewall allows outgoing HTTPS
2. Verify SSL certificates are up to date
3. Test API endpoint accessibility
4. Check for proxy configuration requirements

### CSP (Content Security Policy)

The extension includes CSP whitelist. If you see CSP errors:
1. Check browser console for blocked resources
2. Verify CSP configuration in Magento
3. Add required domains to CSP whitelist if needed

---

## Still Having Issues?

If the above solutions don't resolve your issue:

1. Enable debug logging
2. Check all log files for errors
3. Test with default Magento theme
4. Disable other extensions to identify conflicts
5. Verify Shopreviews.com dashboard shows expected data

**Documentation:**
- [All Help Articles](https://www.magmodules.eu/help/magento2-shopreview-com.html) - Complete documentation overview

**Support:**
- [Contact Support](https://www.magmodules.eu/contact.html) - Get help from our team

When contacting support, include:
- Relevant log entries
- Magento and PHP version
- Shopreviews.com account details
- Steps to reproduce the issue
