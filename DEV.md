# Development Guide

## Docker Setup (DDEV)

### Initial Configuration
```bash
# Configure Laravel project
ddev config --project-type=laravel --docroot=public 
ddev config --php-version=8.3
ddev config --database=mysql:8.0
ddev config --nodejs-version=22

# Add phpMyAdmin
ddev add-on get ddev/ddev-phpmyadmin

# Start DDEV
ddev start
```

### SSL Certificate Setup (Required for Vite, First Time Only)
**Important:** This step is required for Vite dev server to work properly with HTTPS.

```bash
# Install mkcert and restart DDEV to enable HTTPS
mkcert -install && ddev poweroff && ddev start
```

### Expose Vite Port
Add this to `.ddev/config.yaml` to access Vite dev server:
```yaml
web_extra_exposed_ports:
  - name: vite
    container_port: 5173
    http_port: 5172
    https_port: 5173
```
Then restart: `ddev restart`

### Common Commands
```bash
# Restart containers
ddev restart

# Show project info (URLs, ports, services)
ddev describe

# Install dependencies
ddev composer install

# Open in browser
ddev launch
```

### Reconfigure (if needed)
```bash
# Remove old container and reconfigure
ddev delete --omit-snapshot
ddev config --php-version=8.3 --database=mysql:8.0
```

---

## Project Setup

### 1. Clone & Install Dependencies
```bash
git clone <repository-url>
composer install
npm install
```

### 2. Environment Configuration
```bash
# Copy and edit environment file
cp .env.example .env
# Edit .env with your database credentials and other settings

# Generate application key
php artisan key:generate

# Create storage symlink
php artisan storage:link
```

### 3. Database Setup
```bash
# Run migrations and seeders
php artisan migrate --seed

# Generate shield permissions
php artisan shield:generate --all
```

### 4. Build Assets
```bash
# Build frontend assets
npm run build

# Optimize Filament assets
php artisan filament:assets
```

### 5. Final Steps
```bash
# Regenerate autoload files
composer dump-autoload
```

---

## Development Commands

### Clear Cache (Development)
```bash
php artisan icons:clear
php artisan filament:optimize-clear
php artisan optimize:clear
```

### Optimize (Production)
```bash
php artisan icons:cache
php artisan filament:optimize
php artisan optimize
```

---

## Resources

- [Organic Theme Reference](https://jthemes.net/themes/html/organic/index.html)
- [Jenka Design Reference](https://jenka.info/)
