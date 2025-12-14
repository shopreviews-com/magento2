# Widgets

Display your aggregated reviews throughout your site with the [Shopreviews.com](https://www.magmodules.eu/magento2-shopreview-com.html) widgets. Three widget types are available for different display needs.

---

## Available Widgets

| Widget | Best For |
|--------|----------|
| **Textual Box** | Simple text display with optional stars |
| **Carousel** | Rotating review slider |
| **Badge** | Compact score display |

---

## Creating a Widget

1. Go to **Content** → **Widgets**
2. Click **Add Widget**
3. Select widget type (see below)
4. Select your **Design Theme**
5. Click **Continue**
6. Configure **Storefront Properties**
7. Add **Layout Updates** for placement
8. Configure **Widget Options**
9. Click **Save**

---

## Textual Box Widget

Simple text-based display showing review summary and optional stars.

### Widget Options

| Option | Description |
|--------|-------------|
| **Website(s)** | Select which Shopreviews.com website to display |
| **Show Stars** | Display star rating visual |
| **Enable Modal Link** | Make widget clickable to open review modal |
| **Modal Type** | Type of modal to display when clicked |
| **Maximum Number of Reviews** | Reviews shown in modal (when enabled) |

### Use Cases

- Footer trust indicator
- Sidebar summary
- Header trust badge
- Product page social proof

### Recommended Settings

**Footer Placement:**
- Show Stars: Yes
- Enable Modal Link: Yes
- Max Reviews: 10

---

## Carousel Widget

Rotating slider showing individual reviews with auto-scroll capability.

### Widget Options

| Option | Description |
|--------|-------------|
| **Website(s)** | Select which Shopreviews.com website to display |
| **Show Review Summary** | Display overall rating summary |
| **Show Sources** | Display platform source icons |
| **Full Width** | Expand carousel to full container width |
| **Autoplay** | Automatically rotate through reviews |
| **Show Arrows** | Display navigation arrows |
| **Show Dots** | Display pagination dots |
| **Total Number of Review Slides** | How many reviews to include |
| **Review Text Length** | Truncate review text (Short/Medium/Full) |
| **Sort By** | Order reviews (Newest/Highest Rated/etc.) |

### Use Cases

- Homepage featured reviews section
- Landing page testimonials
- Category page trust builder
- About Us page social proof

### Recommended Settings

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

Compact badge showing overall score, ideal for persistent display.

### Widget Options

| Option | Description |
|--------|-------------|
| **Website(s)** | Select which Shopreviews.com website to display |
| **Badge Location** | Position style of the badge |
| **Show Score** | How to display the score (numeric, stars, etc.) |
| **Enable Modal Link** | Make badge clickable to open review modal |
| **Modal Type** | Type of modal to display when clicked |
| **Maximum Number of Reviews in Modal** | Reviews shown when modal opens |

### Use Cases

- Floating corner badge
- Header trust indicator
- Footer persistent badge
- Checkout page trust signal

### Recommended Settings

**Floating Badge:**
- Badge Location: Bottom Right
- Show Score: Numeric with Stars
- Enable Modal Link: Yes
- Max Reviews in Modal: 15

---

## Layout Placement

### Common Placements

| Location | Widget Type |
|----------|-------------|
| Homepage | Carousel (main), Badge (floating) |
| Product Pages | Textual Box (sidebar), Badge |
| Category Pages | Carousel (below products) |
| Footer | Textual Box, Badge |
| Checkout | Badge (trust signal) |

### Layout Update Examples

**All Pages - Footer:**
- Display on: All Pages
- Container: Footer

**Homepage Only:**
- Display on: Specified Page → CMS Home Page
- Container: Main Content Area

**Product Pages:**
- Display on: Anchor Categories
- Container: Sidebar Additional

---

## Modal Functionality

When **Enable Modal Link** is enabled:
- Widget becomes clickable
- Opens overlay with review details
- Shows specified number of reviews
- Allows scrolling through more reviews

### Modal Types

Different modal presentations available:
- List view
- Card view
- Compact view

Choose based on your theme and display needs.

---

## Website Selection

The **Website(s)** option determines which Shopreviews.com website's reviews to display:
- Select single website for focused display
- All reviews from selected website are aggregated
- Different widgets can show different websites

---

## Styling Considerations

### Theme Compatibility

Widgets inherit basic theme styling but include their own CSS:
- Star colors may need theme adjustment
- Modal styling matches Magento default
- Carousel uses standard slider behavior

### Responsive Design

All widgets are responsive:
- Carousel reduces slides on mobile
- Badge repositions appropriately
- Textual box stacks on small screens

### Custom Styling

To customize widget appearance:
1. Override CSS in your theme
2. Use widget-specific CSS classes
3. Adjust via theme LESS/SCSS files

---

## Performance

### Caching

Widget content is cached:
- Updates appear after cache refresh
- Consider cache lifetime for fresh reviews
- Use Varnish/FPC for best performance

### Loading

- Widgets load with page content
- Modal content loads on click
- Carousel preloads adjacent slides

---

## Multiple Widgets

You can use multiple widgets on the same page:
- Different types for different areas
- Same type with different configurations
- Different websites per widget

Example setup:
- Badge: Floating on all pages
- Carousel: Homepage main content
- Textual Box: Product page sidebar

---

## Troubleshooting Widgets

### Widget Not Showing

1. Verify widget is saved
2. Check Layout Updates configuration
3. Ensure reviews are synced
4. Clear cache
5. Check theme compatibility

### Modal Not Opening

1. Check JavaScript console for errors
2. Verify Enable Modal Link is Yes
3. Clear browser cache
4. Test in incognito mode

### Wrong Reviews Showing

1. Verify correct Website selected
2. Check review sync status
3. Confirm Sort By setting

---

## Need More Help?

**Documentation:**
- [All Help Articles](https://www.magmodules.eu/help/magento2-shopreview-com.html) - Complete documentation overview

**Support:**
- [Contact Support](https://www.magmodules.eu/contact.html) - Get help from our team
