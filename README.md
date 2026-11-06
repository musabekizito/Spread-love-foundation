# Spread Love Foundation — Website

Visitor-facing website for **Spread Love Foundation** (Gashora, Bugesera District, Rwanda).
Built with plain PHP 8+, MySQL (PDO), vanilla CSS, and vanilla JavaScript.

## Requirements
- PHP 8.0+
- MySQL 5.7+ / MariaDB 10.3+
- Apache (or Nginx) — recommended XAMPP for local dev

## Installation

1. Copy the project folder into your web root:

2. Add these image files inside `assets/images/`:
- `logo.png`
- `hero.jpg` (wide banner photo)
- `973792.jpg`, `973795.jpg`, `973797.jpg`, `973798.jpg`,
  `973803.jpg`, `973804.jpg`, `973824.jpg`, `906151.jpg`

3. (Optional, for the admin later) Import `database/schema.sql` into MySQL.

4. Edit `config/database.php` with your DB credentials if you plan to save form data.

5. Edit `config/config.php` → set `BASE_URL` to match your folder/domain.

6. Visit `http://localhost/spread-love-foundation/`.

## Folder guide

| Path | Purpose |
|------|---------|
| `config/`       | Global config + DB connection |
| `includes/`     | Header, footer, navbar, helper functions |
| `forms/`        | POST handlers (contact, volunteer) |
| `assets/`       | CSS, JS, images |
| `admin/`        | Admin panel (to be built next) |
| `database/`     | SQL schema |

## Status
- ✅ Visitor site complete (Home, About, Programs, Daily Care, ABANA, Gallery, Get Involved, Contact)
- ⏳ Admin panel — next phase