# Cascade Beagle Rescue WordPress Site

A WordPress site for Cascade Beagle Rescue with MCP (Model Context Protocol) integration for AI-powered content management.

## Prerequisites

- Docker and Docker Compose
- PHP 7.4+ (for Composer)
- Git

## Setup

### 1. Clone and Configure Environment

```bash
git clone git@github.com:HexagonStorms/cascade-beagle-rescue.git
cd cascade-beagle-rescue
```

Create a `.env` file from the example:
```bash
# Copy these contents to .env and update with your values
MYSQL_ROOT_PASSWORD=root_password
MYSQL_DATABASE=wordpress
MYSQL_USER=wordpress
MYSQL_PASSWORD=wordpress_password
WORDPRESS_DB_HOST=db:3306
WORDPRESS_DB_NAME=wordpress
WORDPRESS_DB_USER=wordpress
WORDPRESS_DB_PASSWORD=wordpress_password

# MCP Configuration (update after WordPress setup)
WORDPRESS_SITE_URL=http://localhost:8080
WORDPRESS_USERNAME=your_admin_username
WORDPRESS_APP_PASSWORD=xxxx xxxx xxxx xxxx xxxx xxxx
```

### 2. Start WordPress

```bash
docker-compose up -d
```

Note: On Apple Silicon Macs, you may see a platform warning about MySQL. This is normal and the site will work correctly.

### 3. Complete WordPress Installation

1. Visit http://localhost:8080
2. Choose your language
3. Create your admin account (save these credentials!)
4. Complete the installation wizard

### 4. Generate Application Password

1. Log into WordPress admin at http://localhost:8080/wp-admin
2. Navigate to Users → Your Profile
3. Scroll down to "Application Passwords"
4. Enter a name (e.g., "MCP Server")
5. Click "Add New Application Password"
6. Copy the generated password (including spaces)

### 5. Update Environment Variables

Update your `.env` file with:
- `WORDPRESS_USERNAME`: Your admin username
- `WORDPRESS_APP_PASSWORD`: The generated application password

### 6. Configure MCP WordPress Server (Optional)

If using Claude Desktop or another MCP client, create `claude_desktop_config.json`:

```json
{
  "mcpServers": {
    "mcp-wordpress": {
      "command": "npx",
      "args": ["-y", "mcp-wordpress"],
      "env": {
        "WORDPRESS_SITE_URL": "http://localhost:8080",
        "WORDPRESS_USERNAME": "your_username",
        "WORDPRESS_APP_PASSWORD": "your_app_password"
      }
    }
  }
}
```

## Project Structure

```
cascade-beagle-rescue/
├── docker-compose.yml      # Docker configuration
├── .env                    # Environment variables (not in git)
├── composer.json           # PHP dependency management
├── wp-content/             # Custom WordPress content
│   ├── themes/            # Custom themes (version controlled)
│   ├── plugins/           # Custom plugins (version controlled)
│   └── mu-plugins/        # Must-use plugins
└── README.md              # This file
```

## Development Guidelines

### Version Control

- **DO track**: Custom themes, plugins, and configuration files
- **DON'T track**: WordPress core files, default themes/plugins, uploads, `.env`, or `claude_desktop_config.json`
- The `.gitignore` is configured to handle this automatically

### Adding Custom Themes/Plugins

1. **Via Composer** (recommended for public packages):
   ```bash
   composer require wpackagist-plugin/plugin-name
   composer require wpackagist-theme/theme-name
   ```

2. **Manual Installation**:
   - Add to `wp-content/themes/` or `wp-content/plugins/`
   - Commit to version control

### Database Management

- Database runs in Docker container
- Data persists in Docker volumes
- To reset: `docker-compose down -v` (WARNING: Deletes all data)

## Common Commands

```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# View logs
docker-compose logs -f wordpress

# Access WordPress container
docker exec -it cascade-beagle-rescue-wordpress-1 bash

# Access MySQL
docker exec -it cascade-beagle-rescue-db-1 mysql -u wordpress -p
```

## Troubleshooting

### Port Conflicts
If port 8080 is in use, update the port mapping in `docker-compose.yml`:
```yaml
ports:
  - "8081:80"  # Change 8080 to another port
```

### Permission Issues
If you encounter permission issues with `wp-content`:
```bash
docker exec cascade-beagle-rescue-wordpress-1 chown -R www-data:www-data /var/www/html/wp-content
```

### Platform Warnings (Apple Silicon)
The MySQL platform warning on ARM64 Macs is expected. The site will work normally through emulation.

## Contributing

1. Create a feature branch
2. Make your changes in `wp-content/`
3. Test locally
4. Submit a pull request

## Security Notes

- Never commit `.env` or `claude_desktop_config.json`
- Keep WordPress and plugins updated
- Use strong passwords for all accounts
- Regularly backup your database