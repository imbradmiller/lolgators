# Land O' Lakes Gators

A full-site-editing (block) **child theme of [Twenty Twenty-Five](https://wordpress.org/themes/twentytwentyfive/)** for the Land O' Lakes Gators little league football team.

## Features

- **Official Florida Gators palette** — Blue `#0021A5`, Orange `#FA4616` — set in `theme.json`, overriding the parent's color slugs so the whole site re-skins from one place.
- **"Team Home" page template** (`templates/team-home.html`) — a full-width content wrapper (registered in `theme.json` → `customTemplates`) used for the static homepage. The homepage design itself (full-bleed gradient hero plus Sponsors, Players, and Coaching Staff sections) is built with blocks in the **Home page's content**, so it's edited in the Page editor.
- **FSE templates** for three custom post types — single + archive views for Players, Coaching Staff, and Sponsors.
- Custom field values render through the **Block Bindings API** (`core/post-meta`).

## Requirements

- WordPress 6.7+
- Parent theme: **Twenty Twenty-Five**
- **Secure Custom Fields** (or Advanced Custom Fields) active, providing the `player`, `staff`, and `sponsor` post types.

## Custom fields

Field groups are defined in code in [`inc/fields.php`](inc/fields.php) via `acf_add_local_field_group()`. Their meta keys are registered for block bindings in [`functions.php`](functions.php):

| Post type | Meta keys |
|-----------|-----------|
| `player`  | `jersey_number`, `position`, `grade` |
| `staff`   | `role`, `email` |
| `sponsor` | `website`, `sponsorship_level` |

> A block binding only resolves on the front end when its meta key is registered with `register_post_meta()` (`show_in_rest => true`) — handled in `functions.php`.

## Install

Clone into your site's themes directory and activate:

```sh
git clone git@github.com:imbradmiller/lolgators.git wp-content/themes/lol-gators
```
