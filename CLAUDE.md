# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a WordPress site for Cascade Beagle Rescue that replicates the existing https://www.cascaderescue.org/ website. The project uses Docker containerization, WP-CLI, and MCP (Model Context Protocol) integration for AI-powered content management and automated site building.

### Content Replication Strategy
- **Source Site**: https://www.cascaderescue.org/
- **Approach**: Page-by-page replication using WordPress blocks
- **Theme**: Custom child theme inheriting from Twenty Twenty-Five
- **Content Creation**: Programmatic via MCP WordPress tools (no manual WYSIWYG)
- **Media**: Images downloaded and uploaded via WordPress media library
- **Flexibility**: Easy color scheme changes and logo updates

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

# Use WP-CLI commands
docker exec cascade-beagle-rescue-wordpress-1 wp --help
docker exec cascade-beagle-rescue-wordpress-1 wp theme list
docker exec cascade-beagle-rescue-wordpress-1 wp post create --post_title="Title" --post_content="Content"

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
- **WordPress**: CLI-enabled image (wordpress:cli) running on port 8080
- **MySQL**: Version 8.0 for database persistence
- **Volumes**: Persistent storage for WordPress files and database

### WordPress Structure
- **Active Theme**: `cascade-beagle-rescue-child` (inherits from Twenty Twenty-Five)
- **Custom content** in `wp-content/` (version controlled)
- **WordPress core files** excluded from git
- **Environment-based configuration** via `.env`
- **Composer** manages WordPress packages
- **WP-CLI** available for command-line operations

### MCP Integration
- Supports WordPress MCP server for AI content management
- Requires WordPress Application Password authentication
- Configuration in `claude_desktop_config.json` (not tracked)

## File Organization

### Version Controlled
- `wp-content/themes/cascade-beagle-rescue-child/` - Custom child theme
- `wp-content/themes/` - Other themes (Twenty Twenty-Five parent)
- `wp-content/plugins/` - Custom plugins  
- `wp-content/mu-plugins/` - Must-use plugins
- `docker-compose.yml` - Container configuration with WP-CLI
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

## Content Replication Workflow

### Page Creation Process
1. **Analyze source page** at https://www.cascaderescue.org/
2. **Extract content** using WebFetch tool
3. **Create WordPress page** using MCP tools
4. **Build content blocks** programmatically (no manual editing)
5. **Download and upload images** to WordPress media library
6. **Apply rescue-specific styling** using child theme classes

### Available Custom Elements
- **Color Variables**: Easily changeable in `style.css` `:root` section
- **Block Patterns**: Dog adoption cards, donation CTAs
- **Custom CSS Classes**: `.rescue-cta`, `.rescue-highlight`, `.dog-card`
- **Logo Support**: Ready for logo replacement

### Pages to Replicate
- Home (hero, featured dogs, donation CTAs)
- About sections (board, credentials, contact)
- Adoption (process, available dogs, recent adoptions) 
- Resources (Beagles 101, vet listings, etc.)
- Blog/news sections

## Claude Code Guidelines

- Never say you were coauthored or authored by Claude Code
- Use MCP WordPress tools for all content creation
- Replicate cascaderescue.org content accurately
- Maintain flexible color scheme system for easy updates