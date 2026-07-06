# Homeland Infinia — WordPress Theme

Converted from the original PHP-core site (`public_html__4_.zip`).

## What's included

| Original file | WordPress equivalent |
|---|---|
| `index.html` | `front-page.php` |
| `contact.php` + `db.php` inquiries insert | `page-templates/template-contact.php` + AJAX handler in `functions.php` |
| `blogs.php` / `oldPages/blogs.php` + `blogs` / `blog_categories` DB tables | `page-templates/template-blogs.php` — uses **native WordPress Posts + Categories** |
| `view_blog.php` | `single.php` |
| `admin/*` (custom blog CMS, login, categories) | Replaced by the native WordPress admin (Posts, Categories, Media) |
| `admin/inquiries.php` | New "Inquiries" menu item in wp-admin |
| `tour.html` (360° video tour) | `page-templates/template-tour.php` |
| *(no chatbot existed in this site)* | **New**: AJAX chatbot ported from the Ranjit Avenue build, same keyword-matching logic, seeded with Homeland Infinia-specific Q&A, **plus a new enable/disable switch** |
| *(no About page existed in this site)* | **New**: `page-templates/template-about.php` — a fresh layout (hero + numbered pillars + split story + milestone strip), matching the gold/"Aboreto" brand style but not copy-pasted from the Ranjit Avenue About design |
| `responsive.css` | **Removed as a separate file** — all of its media queries were merged directly into `style.css`, as requested |

## ⚠️ Important: large video files were NOT bundled in the download

Three video files were too large to include in this deliverable:

| File | Size | Used on |
|---|---|---|
| `360video.mp4` | ~311 MB | Virtual Tour page |
| `homeland_bg_video.mp4` | ~8 MB | ✅ **included** — Home, Contact, About, Blogs background |
| `bg2.mp4` | ~9 MB | Not referenced anywhere in the live pages — safe to skip |

**You need to manually copy `360video.mp4`** from your original `public_html` folder into:
```
wp-content/themes/homeland-infinia/assets/video/360video.mp4
```
Until you do, the Virtual Tour page will show a blank video area.

## Chatbot enable/disable

Two ways to toggle the chatbot on/off site-wide:
1. **wp-admin sidebar → "Chatbot"** (new menu item, checkbox + Save)
2. **Appearance → Customize → Chatbot Settings → Enable Chatbot Widget**

When disabled, the widget markup, its CSS/JS, and the AJAX endpoint all stop loading — not just visually hidden.

## Install

1. **Appearance → Themes → Add New → Upload Theme** → upload the zip → **Activate**.
   This auto-creates `wp_hi_inquiries` and `wp_hi_chatbot_qa` tables and seeds the chatbot.

2. **Create your Pages** (Pages → Add New), matching these exact slugs (templates reference them):
   - **About Us** → slug `about` → Template: **About Us**
   - **Contact** → slug `contact` → Template: **Contact Us**
   - **Blogs** → slug `blogs` → Template: **Blogs**
   - **Virtual Tour** → slug `tour` → Template: **Virtual Tour**

3. **Homepage**: Settings → Reading → "A static page" → select any placeholder page as Homepage (the theme's `front-page.php` overrides it automatically, WordPress just requires one to be set).

4. **Blog posts**: Posts → Add New, using Categories + Featured Image as before.

5. **Permalinks**: Settings → Permalinks → "Post name".

## Notes

- The theme fetches Google Fonts (Plus Jakarta Sans, Aboreto, Khand) from `fonts.googleapis.com` — same as the original site.
- All contact-page phone/WhatsApp/email links are clickable (`tel:` / `mailto:` / `wa.me`).
- `responsive.css` no longer exists as a file in this theme — everything from it now lives inside `style.css`, in a clearly marked "Responsive rules" section near the bottom.
