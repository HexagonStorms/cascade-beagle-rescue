# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a WordPress site for Cascade Beagle Rescue with Docker containerization and MCP (Model Context Protocol) integration for AI-powered content management. The project uses a modern development setup with Docker, Composer, and environment-based configuration.

## Development Commands

### Docker Operations
```bash
# Start the development site
docker-compose up -d

# Stop containers
docker-compose down

# View WordPress logs
docker-compose logs -f wordpress

# Access WordPress container shell
docker exec -it cascade-beagle-rescue-wordpress-1 bash

# Access MySQL database
docker exec -it cascade-beagle-rescue-db-1 mysql -u wordpress -p

# Reset database (WARNING: deletes all data)
docker-compose down -v
```

### Package Management
```bash
# Install WordPress plugins/themes via Composer
composer require wpackagist-plugin/plugin-name
composer require wpackagist-theme/theme-name

# Install PHP dependencies
composer install
```

### Development Workflow
- Site runs on http://localhost:8080
- WordPress admin at http://localhost:8080/wp-admin
- Configuration via `.env` file (not tracked in git)
- Custom themes/plugins in `wp-content/` directory

## Architecture

### Docker Services
- **WordPress**: Latest version running on port 8080
- **MySQL**: Version 8.0 for database persistence
- **Volumes**: Persistent storage for WordPress files and database

### WordPress Structure
- Custom content in `wp-content/` (version controlled)
- WordPress core files excluded from git
- Environment-based configuration via `.env`
- Composer manages WordPress packages

### MCP Integration
- Supports WordPress MCP server for AI content management
- Requires WordPress Application Password authentication
- Configuration in `claude_desktop_config.json` (not tracked)

## File Organization

### Version Controlled
- `wp-content/themes/` - Custom themes
- `wp-content/plugins/` - Custom plugins  
- `wp-content/mu-plugins/` - Must-use plugins
- `docker-compose.yml` - Container configuration
- `composer.json` - PHP dependencies

### Not Version Controlled
- `.env` - Environment variables and secrets
- `claude_desktop_config.json` - MCP configuration
- WordPress core files and uploads
- Default themes and plugins

## Environment Setup

Required `.env` variables:
- Database credentials (MYSQL_*)
- WordPress database configuration (WORDPRESS_DB_*)
- MCP settings (WORDPRESS_SITE_URL, WORDPRESS_USERNAME, WORDPRESS_APP_PASSWORD)

## Common Issues

### Permission Problems
```bash
docker exec cascade-beagle-rescue-wordpress-1 chown -R www-data:www-data /var/www/html/wp-content
```

### Port Conflicts
Update port mapping in `docker-compose.yml` if 8080 is unavailable.

### Platform Warnings
MySQL platform warnings on Apple Silicon are expected and harmless.

## Claude Code Guidelines

- Never say you were coauthored or authored by Claude Code