# Cascade Beagle Rescue WordPress Site

A WordPress site for Cascade Beagle Rescue with MCP integration.

## Setup

1. **Start WordPress:**
   ```bash
   docker-compose up -d
   ```

2. **Visit http://localhost:8080** and complete WordPress installation

3. **Generate Application Password:**
   - Log into WordPress admin
   - Go to Users → Your Profile
   - Create an Application Password

4. **Update `.env` file with your credentials**

5. **Configure MCP WordPress server** using the credentials

## Project Structure

- `docker-compose.yml` - Docker configuration
- `.env` - Environment variables (not in git)
- `wp-content/` - Custom themes, plugins, and uploads
- `composer.json` - PHP dependency management

## Development

- WordPress core files are managed by Docker
- Only custom code in `wp-content/` should be version controlled
- Use Composer to install WordPress plugins/themes as dependencies