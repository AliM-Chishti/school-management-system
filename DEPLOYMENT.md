# Deployment Guide: School Management System on Render

This guide provides complete instructions for deploying the Laravel School Management System to Render using Docker.

## Table of Contents
1. [Prerequisites](#prerequisites)
2. [Pre-Deployment Setup](#pre-deployment-setup)
3. [Creating a Render Account and Repository](#creating-a-render-account-and-repository)
4. [Deployment Steps](#deployment-steps)
5. [Post-Deployment Configuration](#post-deployment-configuration)
6. [Environment Variables](#environment-variables)
7. [Monitoring and Troubleshooting](#monitoring-and-troubleshooting)
8. [Database Migrations](#database-migrations)
9. [Updating Your Application](#updating-your-application)

---

## Prerequisites

Before deploying to Render, ensure you have:

1. **A GitHub, GitLab, or Bitbucket account** with your repository pushed
2. **A Render account** (sign up at https://render.com)
3. **Git installed** on your local machine
4. **Docker** (optional, for local testing)
5. **PHP 8.2+** for local development/testing

---

## Pre-Deployment Setup

### Step 1: Generate Application Key

Generate a unique Laravel application key (if not already done):

```bash
php artisan key:generate --show
```

Copy the output (should look like `base64:xxxxxxxxxxxxxxxxxxxxx`). You'll need this for the `APP_KEY` environment variable.

### Step 2: Prepare Your Repository

Ensure your repository is clean and ready:

```bash
# Verify .env and .env.* files are NOT committed
cat .gitignore  # Should include: .env, .env.*.php

# Ensure all files are committed
git add .
git commit -m "Prepare for production deployment"
git push origin main  # or your main branch
```

### Step 3: Verify Docker Configuration Files

Ensure these files exist in your repository root:
- `Dockerfile` - Multi-stage Docker build
- `.dockerignore` - Files to exclude from Docker image
- `render.yaml` - Render deployment configuration
- `docker/` directory with:
  - `nginx.conf` - Nginx web server config
  - `site.conf` - Laravel site configuration
  - `php-fpm.conf` - PHP-FPM process manager
  - `supervisord.conf` - Process supervisor
  - `php.ini` - PHP runtime settings

All these files are already included in this repository.

---

## Creating a Render Account and Repository

### Step 1: Sign Up on Render

1. Go to https://render.com
2. Click "Sign up"
3. Choose your sign-up method (GitHub, GitLab, Bitbucket, or Email)
4. Complete the registration

### Step 2: Connect Your Repository

1. In Render dashboard, click **"New +"** button
2. Select **"Web Service"**
3. Choose **"Build and deploy from a Git repository"**
4. Connect your Git provider (GitHub, GitLab, or Bitbucket)
5. Select your repository
6. Click **"Connect"**

---

## Deployment Steps

### Step 1: Configure the Web Service

In Render's service creation form, fill in:

**Basic Information:**
- **Name:** `sms-laravel-app` (or your preferred name)
- **Root Directory:** Leave empty (or enter `.` for root)
- **Environment:** `Docker`
- **Region:** Choose your preferred region (e.g., Oregon, Ohio, Singapore)
- **Branch:** `main` (or your deployment branch)

**Build Configuration:**
- **Docker Filename:** `Dockerfile`
- **Build Context:** Leave empty

**Plan:**
- **Free Plan:** Good for testing (with limitations)
- **Starter:** $7/month (recommended for production)

### Step 2: Set Environment Variables

Click on the **"Environment"** tab and add the following variables:

#### Critical Variables (Must set):

```
APP_KEY=base64:YOUR_KEY_FROM_STEP_1_HERE
APP_URL=https://your-app-name.onrender.com
```

#### Important Variables:

```
APP_ENV=production
APP_DEBUG=false
LOG_CHANNEL=single
LOG_LEVEL=warning
DB_CONNECTION=sqlite
QUEUE_CONNECTION=database
CACHE_STORE=database
SESSION_DRIVER=database
FILESYSTEM_DISK=local
MAIL_MAILER=log
VITE_APP_NAME=School Management System
```

#### Optional Variables:

```
TRUSTED_PROXIES=*
BCRYPT_ROUNDS=12
FORCE_HTTPS=true
RATE_LIMIT=60
```

**Note:** For sensitive data, use Render's **"Secrets"** feature instead of regular environment variables.

### Step 3: Deploy

1. Click **"Create Web Service"**
2. Render will:
   - Clone your repository
   - Build the Docker image using your Dockerfile
   - Start the container
   - Run migrations automatically
   - Create storage symlink
   - Cache configuration and routes
   - Start the application

**Expected Build Time:** 8-15 minutes for first deployment

Monitor the deployment logs in the **"Logs"** tab.

---

## Post-Deployment Configuration

### Step 1: Verify Deployment Success

Once deployment completes:

1. Visit your application URL: `https://your-app-name.onrender.com`
2. You should see the login page
3. Check the health endpoint: `https://your-app-name.onrender.com/health.php` (should return "OK")

### Step 2: Review Application Logs

In Render dashboard:
1. Go to your service
2. Click **"Logs"** tab
3. Verify no errors during startup
4. Look for "Server running on..." message

### Step 3: Create Admin User (if needed)

You can create users through the registration page, or use Artisan:

```bash
# This requires SSH access to the container
# Use Render's built-in terminal or create a custom command
```

### Step 4: Set Up Custom Domain (Optional)

1. In Render service settings, go to **"Custom Domains"**
2. Add your domain (e.g., `sms.yourdomain.com`)
3. Update your domain's DNS records pointing to Render
4. Render will provision a free SSL certificate

---

## Environment Variables

### APP_KEY

**Importance:** CRITICAL - Encryption key for your application

Generate locally:
```bash
php artisan key:generate --show
```

Copy the entire `base64:...` value to Render's `APP_KEY` environment variable.

### APP_URL

**Importance:** CRITICAL - Used for URL generation

Set to your Render deployment URL:
- Example: `https://sms-app.onrender.com`
- Or your custom domain: `https://sms.yourdomain.com`

**Must include https:// for production**

### Database Variables

**DB_CONNECTION=sqlite** (Recommended for this deployment)
- No external database needed
- Data persists in `database/database.sqlite`
- File-based, no setup required

**Alternative: MySQL/PostgreSQL**

If you need an external database:

1. Provision database on Render (Create New > PostgreSQL/MySQL)
2. Get connection details
3. Set environment variables:
   ```
   DB_CONNECTION=mysql
   DB_HOST=your-db-host
   DB_PORT=3306
   DB_DATABASE=sms_db
   DB_USERNAME=your_user
   DB_PASSWORD=your_password
   ```

### Queue Configuration

**QUEUE_CONNECTION=database** (Recommended)
- Uses SQLite database for job queue
- No setup needed
- Supervisor automatically manages queue worker

### Cache Configuration

**CACHE_STORE=database** (Recommended)
- Uses SQLite database for caching
- Automatically cleared via artisan commands

### Mail Configuration

**MAIL_MAILER=log** (Default)
- Emails logged to `storage/logs/laravel.log`
- Perfect for testing

For production email:
```
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME=School Management System
```

---

## Monitoring and Troubleshooting

### Check Application Logs

In Render dashboard:
1. Go to your service
2. Click **"Logs"** tab
3. View real-time application logs

### Common Deployment Issues

**Issue: Application starts but shows error**
- Check logs for specific error message
- Verify all environment variables are set
- Ensure APP_KEY and APP_URL are correct

**Issue: Database file not found**
- Check `/app/database/database.sqlite` in container
- Verify file permissions in `docker/php.ini`
- Run migrations manually if needed

**Issue: Static assets not loading (CSS/JS)**
- Verify Vite assets were built (check logs for "npm run build")
- Clear browser cache and do hard refresh (Ctrl+Shift+R)
- Check `public/build/manifest.json` exists

**Issue: Upload files not persisting**
- Files should go to `storage/app/public`
- Ensure storage symlink was created (check logs)
- Use `Storage::disk('public')` in code

**Issue: Application very slow**
- Check Render plan (Free plan has CPU limitations)
- Upgrade to Starter plan or higher
- Monitor logs for long-running queries

### SSH Access (Advanced)

To access your container via SSH:

1. In Render service settings, scroll to **"Shell"** section
2. Click **"Connect"** to open terminal
3. Run Artisan commands directly:

```bash
# Run migrations
php artisan migrate

# Cache configuration
php artisan config:cache

# View logs
tail -f storage/logs/laravel.log

# Create test user
php artisan tinker
>>> \App\Models\User::factory()->create(['email' => 'admin@example.com'])
```

---

## Database Migrations

### Automatic Migrations

Migrations run automatically during deployment via the `entrypoint.sh` script.

### Manual Database Operations

If needed, use Render's **Shell** to run commands:

```bash
# Check migration status
php artisan migrate:status

# Roll back last migration
php artisan migrate:rollback

# Reset entire database
php artisan migrate:reset

# Seed database with test data
php artisan db:seed
```

### Database Backups

For SQLite deployments:
- Download the database file via SFTP (if enabled)
- Or commit database snapshots to Git (not recommended for production)
- Consider migrating to PostgreSQL for production with backups

For PostgreSQL/MySQL:
- Configure automated backups in Render's database settings
- Use `pg_dump` or `mysqldump` for manual backups

---

## Updating Your Application

### Deploy Updates

To deploy code changes:

1. Push code to your repository:
```bash
git add .
git commit -m "Your changes"
git push origin main
```

2. Render automatically detects changes and redeploys
   - Monitor **"Deployments"** tab
   - Check **"Logs"** tab during deployment

3. Wait for deployment to complete
   - Database migrations run automatically
   - Configuration cache is regenerated
   - No downtime with Render's rolling deployments

### Redeploy without Code Changes

To force a redeploy:

1. In Render dashboard, click your service
2. Click **"Manual Deploy"** button
3. Select branch and click **"Deploy"**

### Database Migrations on Update

If your update includes migrations:

1. Push code changes
2. Render detects and builds new image
3. During startup, migrations run automatically
4. If migration fails, deployment fails (safer than broken production)

---

## Scaling and Performance

### Vertical Scaling

Upgrade Render plan for more CPU/RAM:
- Free: Limited (1 CPU, 512MB RAM)
- Starter: $7/month (0.5 CPU, 512MB RAM)
- Standard: $12/month (1 CPU, 1GB RAM)
- Pro: $29/month (2 CPU, 2GB RAM)

### Horizontal Scaling

Render supports multiple instances:
1. In service settings, enable auto-scaling
2. Set min/max instances
3. Render automatically distributes traffic

### Performance Tips

1. **Use OPcache**: Enabled in `docker/php.ini`
2. **Enable View Caching**: `php artisan view:cache`
3. **Database Indexing**: Add indexes to frequently queried columns
4. **Lazy Loading**: Use `->load()` for relationships
5. **Database Connections**: Use connection pooling if using PostgreSQL

---

## Security Best Practices

1. ✅ **Enable HTTPS**: Set to your domain with SSL certificate
2. ✅ **Force HTTPS**: Set `FORCE_HTTPS=true` in production
3. ✅ **Secure APP_KEY**: Use strong, unique key
4. ✅ **Minimal Logging**: Set `LOG_LEVEL=warning` in production
5. ✅ **Database Security**: Don't expose credentials in code
6. ✅ **File Permissions**: Properly configured in Dockerfile
7. ✅ **Regular Updates**: Keep Laravel and dependencies updated
8. ✅ **API Rate Limiting**: Configured via `RATE_LIMIT` variable

---

## Rollback Strategy

If deployment causes issues:

1. In Render **"Deployments"** tab, find previous working deployment
2. Click **"Redeploy"** on that version
3. Application reverts to previous version immediately
4. Check logs to diagnose the issue with your code update

---

## Support and Additional Resources

- **Render Docs**: https://render.com/docs
- **Laravel Docs**: https://laravel.com/docs
- **Docker Docs**: https://docs.docker.com
- **Nginx Docs**: https://nginx.org/en/docs/

---

## Deployment Checklist

Before deploying, verify:

- [ ] Repository is on GitHub/GitLab/Bitbucket
- [ ] All code is committed and pushed
- [ ] `.env.example` is updated with all required variables
- [ ] `.env` is in `.gitignore` (never commit production secrets)
- [ ] Docker files exist: `Dockerfile`, `.dockerignore`, `docker/*`
- [ ] `render.yaml` is configured correctly
- [ ] `APP_KEY` has been generated
- [ ] Application runs locally without errors
- [ ] Vite assets build successfully: `npm run build`
- [ ] Tests pass locally: `php artisan test` (if applicable)
- [ ] Database migrations are up to date
- [ ] No deprecated Laravel features are used

---

**Deployment completed successfully! Your School Management System is now live on Render.**

For questions or issues, refer to the [Troubleshooting](#monitoring-and-troubleshooting) section or check Render's documentation.
