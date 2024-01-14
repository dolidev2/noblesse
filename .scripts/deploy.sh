#!/bin/bash
set -e

echo "Deployment started ..."

# Pull the latest version of the app
cd /var/www/html/noblesse
git pull
# allow composer for root
export COMPOSER_ALLOW_SUPERUSER=1;

# Install composer dependencies
composer install --no-dev --optimize-autoloader --no-interaction
# composer update --lock

# Install npm dependencies
npm install

echo "New changes copied to server !"

echo "Deployment Finished!"