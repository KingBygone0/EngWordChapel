# Engrafted Chapel

A modern, responsive WordPress theme for **Engrafted Word Chapel International**.

Engrafted Chapel is a fully responsive theme designed for churches and ministries, featuring a dark "sanctuary" palette, full Customizer integration, custom post types, and a one-page homepage built from modular sections.

- **Version:** 2.4.6
- **Requires WordPress:** 5.0+
- **Requires PHP:** 7.4+
- **License:** GPLv2 or later

## Features

- Fully responsive design (mobile, tablet, desktop)
- Deep Customizer integration for editing content without code
- Custom post types: Sermons, Events, Testimonies, Ministries, Albums
- Modular homepage sections: Hero, Welcome, Services, Sermons, Ministries, Testimonies, Giving, Contact, and more
- Multiple page templates (About, Sermons, Events, Ministries, Gallery, Outreach, Contact, Visit)
- Modern typography (Inter + Montserrat) and Font Awesome icons
- Smooth animations and scroll effects
- SEO-friendly structure and performance helpers
- Works on standard shared hosting (e.g. Hostinger) without extra configuration

## Installation

1. Copy this theme folder into `wp-content/themes/` (or upload it as a `.zip` via **Appearance > Themes > Add New**).
2. Activate **Engrafted Chapel** in **Appearance > Themes**.
3. Configure settings in **Appearance > Customize > Theme Settings**.
4. Set a static homepage under **Settings > Reading** (the theme uses `front-page.php` automatically).
5. Create a Page for each template and assign it under **Page > Page Attributes > Template**. Use these slugs so the menu/footer links resolve: `about`, `ministries`, `bible-college`, `outreach`, `events`, `contact`.

## Page Templates

| Template | Purpose |
| --- | --- |
| Default | Standard page |
| About | Church story, beliefs, mission, vision, pastor profile |
| Sermons | Archive of sermons with video/audio support |
| Events | Upcoming events with date, time, and venue |
| Ministries | Ministry listings with slogans and leaders |
| Gallery | Photo albums |
| Outreach | Evangelism and follow-up/visitation ministries |
| Contact | Contact info, weekly services, map, and contact form |
| Visit | Plan-a-visit information |

## Customizer

Most front-facing content is editable under **Appearance > Customize > Theme Settings**, including church name and tagline, hero section, welcome section, service times, and the Sermons / Ministries / Testimonies / Giving sections.

## Project Structure

```
engrafted-chapel-theme/
├── assets/             # CSS, JS, images
├── inc/                # Customizer, SEO, performance, template helpers
├── page-templates/     # Selectable page templates
├── template-parts/     # Reusable partials (home sections, content cards)
├── functions.php       # Theme setup, enqueues, post types
├── front-page.php      # Homepage
└── style.css           # Theme header + styles
```

## License

Distributed under the [GNU General Public License v2 or later](https://www.gnu.org/licenses/gpl-2.0.html).
