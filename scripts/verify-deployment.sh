#!/bin/bash
# =============================================================================
# Deployment Verification Script for School Management System
# =============================================================================
# This script verifies that all deployment requirements are met
# Run this before pushing to Render: ./scripts/verify-deployment.sh

set -e

echo "=========================================="
echo "Deployment Verification Script"
echo "=========================================="
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Track failures
FAILURES=0

check_file() {
    if [ -f "$1" ]; then
        echo -e "${GREEN}✓${NC} $1 exists"
    else
        echo -e "${RED}✗${NC} $1 missing"
        FAILURES=$((FAILURES + 1))
    fi
}

check_directory() {
    if [ -d "$1" ]; then
        echo -e "${GREEN}✓${NC} Directory $1 exists"
    else
        echo -e "${RED}✗${NC} Directory $1 missing"
        FAILURES=$((FAILURES + 1))
    fi
}

check_env() {
    if grep -q "$1" ".env.example"; then
        echo -e "${GREEN}✓${NC} Environment variable $1 documented"
    else
        echo -e "${YELLOW}⚠${NC} Environment variable $1 not found in .env.example"
    fi
}

echo "Checking Docker files..."
check_file "Dockerfile"
check_file ".dockerignore"
check_file "docker/nginx.conf"
check_file "docker/site.conf"
check_file "docker/php-fpm.conf"
check_file "docker/php.ini"
check_file "docker/supervisord.conf"

echo ""
echo "Checking Render configuration..."
check_file "render.yaml"

echo ""
echo "Checking Laravel configuration files..."
check_file "composer.json"
check_file "package.json"
check_file ".env.example"
check_file "app/Providers/AppServiceProvider.php"

echo ""
echo "Checking application structure..."
check_directory "app"
check_directory "bootstrap"
check_directory "config"
check_directory "database"
check_directory "resources"
check_directory "routes"
check_directory "storage"
check_directory "public"

echo ""
echo "Checking environment variables..."
check_env "APP_NAME"
check_env "APP_ENV"
check_env "APP_KEY"
check_env "DB_CONNECTION"
check_env "QUEUE_CONNECTION"
check_env "CACHE_STORE"

echo ""
echo "Checking PHP dependencies..."
if grep -q '"laravel/framework"' composer.json; then
    echo -e "${GREEN}✓${NC} Laravel dependency found"
else
    echo -e "${RED}✗${NC} Laravel dependency missing"
    FAILURES=$((FAILURES + 1))
fi

if grep -q '"laravel/tinker"' composer.json; then
    echo -e "${GREEN}✓${NC} Tinker dependency found"
else
    echo -e "${RED}✗${NC} Tinker dependency missing"
    FAILURES=$((FAILURES + 1))
fi

echo ""
echo "Checking Node.js dependencies..."
if grep -q '"vite"' package.json; then
    echo -e "${GREEN}✓${NC} Vite found in package.json"
else
    echo -e "${RED}✗${NC} Vite missing from package.json"
    FAILURES=$((FAILURES + 1))
fi

if grep -q '"laravel-vite-plugin"' package.json; then
    echo -e "${GREEN}✓${NC} Laravel Vite Plugin found"
else
    echo -e "${RED}✗${NC} Laravel Vite Plugin missing"
    FAILURES=$((FAILURES + 1))
fi

echo ""
echo "Checking .gitignore configuration..."
if grep -q "^\\.env$" .gitignore; then
    echo -e "${GREEN}✓${NC} .env is ignored"
else
    echo -e "${YELLOW}⚠${NC} .env not found in .gitignore"
fi

if grep -q "^vendor/" .gitignore; then
    echo -e "${GREEN}✓${NC} vendor/ is ignored"
else
    echo -e "${YELLOW}⚠${NC} vendor/ not found in .gitignore"
fi

if grep -q "^node_modules/" .gitignore; then
    echo -e "${GREEN}✓${NC} node_modules/ is ignored"
else
    echo -e "${YELLOW}⚠${NC} node_modules/ not found in .gitignore"
fi

echo ""
echo "=========================================="
if [ $FAILURES -eq 0 ]; then
    echo -e "${GREEN}All checks passed! ✓${NC}"
    echo "Your project is ready for deployment to Render."
    echo ""
    echo "Next steps:"
    echo "1. Verify all code is committed: git status"
    echo "2. Push to your repository: git push origin main"
    echo "3. Create a new Web Service on Render"
    echo "4. Set required environment variables (APP_KEY, APP_URL)"
    echo "5. Deploy!"
    exit 0
else
    echo -e "${RED}$FAILURES check(s) failed!${NC}"
    echo "Please fix the issues above before deploying."
    exit 1
fi
