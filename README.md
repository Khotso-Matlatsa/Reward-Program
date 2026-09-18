# Quicks Reward Program

Quicks is a PHP/MySQL web platform that combines digital marketing content, user engagement tracking, referrals, rewards, business listings, and administration tools.

## Features

- Public marketing pages, announcements, galleries, products, businesses, and software downloads
- User registration and login with referral-code support
- User dashboard with activity, contribution points, rewards, surveys, quotations, and claims
- Activity tracking for views, scrolling, likes, comments, surveys, app installs, and referrals
- Admin dashboard for managing users, content, announcements, media, jobs, surveys, products, quotations, and reward claims
- Responsive pages using the CSS and assets included in the repository

## Technology

- PHP 8+
- MySQL or MariaDB
- MySQLi and PHP sessions
- HTML, CSS, and JavaScript
- Tailwind CSS and Font Awesome loaded from CDNs on selected pages

## Requirements

- PHP 8.0 or newer with the `mysqli` extension enabled
- MySQL or MariaDB running locally
- A web server such as Apache, Nginx, XAMPP, or Laragon

## Local Setup

1. Clone or copy the project into the web server document root.
2. Create a database named `ecommerce`.
3. Import [`ecommerce (4).sql`](ecommerce%20%284%29.sql) into that database. This is the newer dump and includes the user and activity tables used by the current application.
4. Review the database settings in [`config.php`](config.php):

   ```php
   $host = "localhost";
   $user = "root";
   $pass = "";
   $db   = "ecommerce";
   $port = 3308;
   ```

5. Update the credentials, database name, and port for your environment.
6. Open the project through the web server, for example:

   ```text
   http://localhost/quicks/
   ```

## Main Pages

| Page | Purpose |
| --- | --- |
| `index.php` | Public homepage and marketing content |
| `register.php` | Create a user account and optional referral relationship |
| `logins.php` | Authenticate users and administrators |
| `dashboarduser.php` | User dashboard |
| `dashboard2.php` | Admin dashboard |
| `products.php` | Browse products and businesses |
| `rewards.php` | View available rewards |
| `surveys.php` | Browse available surveys |

## Database Notes

- The application currently expects the database name `ecommerce`.
- Most authenticated pages load shared connection and authorization helpers from [`config.php`](config.php).
- [`db.php`](db.php) contains a second legacy connection helper used by older pages.
- The SQL files contain development/sample data. Do not use included sample credentials or data in production; create new administrator credentials and remove sensitive records before deployment.

## Project Structure

- Root PHP files: public pages, authentication, user workflows, and shared endpoints
- `admin/`: supporting administrative endpoints
- `dashboard/`: admin dashboard pages and management actions
- `assets/`: stylesheets, scripts, fonts, images, and page assets
- `images/`, `img/`, `products/`, `slide/`, `uploads/`: uploaded and site media

## Development

There is no package manager or automated test suite configured in this repository. Use a local PHP web server and browser testing for development, and inspect PHP/server logs when diagnosing database or session issues.

## Security

Before deploying publicly:

- Move database credentials out of committed source files.
- Disable PHP error display and enable server-side error logging.
- Replace development/sample administrator data.
- Validate upload types and storage permissions.
- Review all legacy pages for authorization and input-validation consistency.