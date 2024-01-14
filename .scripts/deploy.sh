#!/bin/bash
set -e

echo "Deployment started ..."

# Pull the latest version of the app
cd /var/www/html/noblesse
git pull

echo "New changes copied to server !"

echo "Deployment Finished!"