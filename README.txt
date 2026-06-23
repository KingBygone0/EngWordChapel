=== Engrafted Chapel ===
Contributors: Engrafted Word Chapel International
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A modern, responsive WordPress theme for Engrafted Word Chapel International.

== Description ==

Engrafted Chapel is a fully responsive, modern WordPress theme designed specifically for churches and ministries. Inspired by leading church websites like Hillsong, Elevation Church, Transformation Church, and Life.Church, this theme provides a clean, contemporary design with powerful customization options.

**Features:**
- Fully responsive design (mobile, tablet, desktop)
- Customizer integration for easy editing
- Custom post types: Sermons, Events, Testimonies, Ministries
- Homepage sections: Hero, Welcome, Services, Sermons, Ministries, Testimonies, Giving, Contact
- Multiple page templates: About, Sermons, Events, Ministries, Contact
- Font Awesome icons
- Smooth animations and scroll effects
- Modern typography (Inter + Montserrat)
- SEO-friendly structure
- Works on Hostinger without additional configuration

== Installation ==

1. Upload the theme folder to `/wp-content/themes/`
2. Activate the theme in WordPress Admin > Appearance > Themes
3. Configure theme settings in Appearance > Customize > Theme Settings
4. Create pages and assign the appropriate templates

== Page Templates ==

- **Default** - Standard page template
- **About** - Displays church story, beliefs, mission, vision, and pastor profile
- **Sermons** - Archive of sermon posts with video/audio support
- **Events** - Upcoming events with date, time, and venue details
- **Ministries** - Detailed ministry listings with slogans and leaders
- **Bible College** - Mission Die Theological Seminary: programs, eligibility, enrollment
- **Outreach** - Evangelism and Follow-up/Visitation ministries
- **Contact** - Contact info, weekly services, map, and contact form

IMPORTANT — After activating the theme, create a WordPress Page for each template and
assign it (Page > Page Attributes > Template). Use these slugs so the menu/footer links work:
about, ministries, bible-college, outreach, events, contact. Set a static homepage under
Settings > Reading (the theme uses front-page.php automatically).

== Customizer Options ==

Go to **Appearance > Customize > Theme Settings** to edit:
- Church name and tagline
- Hero section (background image, title, tagline, buttons)
- Welcome section (image, text, quote, pastor info)
- Service times (3 customizable services)
- Sermons section (title, description, count)
- Ministries section (title, description)
- Testimonies section (title, description, count)
- Giving section (title, text, verse, button)
- Contact info (address, email, phone, map)
- Social media links (Facebook, Twitter, Instagram, YouTube)
- Section visibility (show/hide any homepage section)

== Custom Post Types ==

The theme creates these custom post types automatically:
- **Sermons** (ec_sermon) - Add video URL, audio URL, speaker, scripture
- **Events** (ec_event) - Add date, time, venue
- **Testimonies** (ec_testimony) - Share testimonies
- **Ministries** (ec_ministry) - Add slogan, leader, contact email

== Custom Taxonomies ==

- **Sermon Series** (ec_sermon_series) - Organize sermons by series
- **Speakers** (ec_sermon_speaker) - Tag sermons by speaker

== Menu Setup ==

1. Go to Appearance > Menus
2. Create a new menu and assign it to "Primary Menu" location
3. Add your pages and links

== Widget Areas ==

- Footer Widget 1, 2, 3

== Credits ==

- Fonts: Google Fonts (Inter, Montserrat)
- Icons: Font Awesome 6
- Theme design inspired by Hillsong, Elevation Church, Life.Church

== Changelog ==

= 2.0.0 =
* Full visual redesign inspired by "The Haven" — a dark, cinematic "sanctuary" theme
* Near-black palette (#0b0b0d) with warm ember-orange accents (#d9531f) and cream text
* Cormorant Garamond serif display type throughout; Inter for labels/body
* Italic parenthetical pill buttons, e.g. (Plan a Visit); ember-washed page headers and CTAs
* All sections, cards, forms and inner pages converted to the dark theme; content stays fully editable

= 1.4.0 =
* Distinctive visual identity (applying frontend-design principles): Fraunces serif display type, warm parchment + ink + gold palette
* Signature device: scripture-reference eyebrows above every page title, and a gold leaf "graft" mark on section headings (tying to the church's "engrafted Word" identity)
* Larger, more refined page-header titles; warmer card and section backgrounds throughout

= 1.3.1 =
* Editorial redesign of the inner pages: gold "eyebrow" section headings, lead paragraphs, card-style check lists, premium pull-quotes, and rounded/shadowed images — all while content stays editable
* Added a stats band + call-to-action to About, and a call-to-action to Ministries
* Ministry slogans styled automatically; mobile refinements

= 1.3.0 =
* About, Ministries, Bible College, Outreach and Contact pages are now fully editable in the WordPress block editor
* Page bodies are pre-filled with the real content as editor blocks (headings, lists, quotes) so they can be edited and have images inserted normally; existing edits are never overwritten
* Page header photos are controlled per page via the Featured Image

= 1.2.0 =
* Auto-installer: on activation (or first admin load) the theme creates the About, Ministries, Bible College, Outreach, Events, Sermons and Contact pages, assigns each its template, builds a Primary Menu, and flushes permalinks — no manual page setup required
* Added two new page templates: "Bible College" (Mission Die Theological Seminary) and "Outreach", with content from the live site
* Populated About, Ministries and Contact pages with real church content; added a Weekly Services block to Contact
* Bundled worship/gospel background images for the hero and page headers
* Removed the Giving section/page (homepage section, nav item, Customizer section); the header "I'm New" button now has its own General settings
* Updated navigation and footer links; default Facebook/Twitter links; Sunday service time corrected to 7:30 AM – 11:30 AM

= 1.1.0 =
* Added bundled church logo (header + footer), with Custom Logo override support
* Redesigned homepage hero: script/block headline, gold rule, orange CTA, and a four-up feature highlights bar (all Customizer-editable)
* Added Dancing Script font and applied Montserrat to headings
* Gave each page template a unique design (per-page header colour mood, icon, and content accents) via a shared ec_page_header() helper
* Working contact + newsletter forms (admin-post handlers, nonce, honeypot, wp_mail) with a reusable form partial
* Upcoming events now sorted by event date; fatal apostrophe parse errors fixed; added missing contact/grid CSS
* Accessibility (aria-expanded menu) and security (rel="noopener") improvements

= 1.0.0 =
* Initial release
* Complete theme with all homepage sections
* Custom post types and taxonomies
* Customizer integration
* Responsive design
* 5 custom page templates
