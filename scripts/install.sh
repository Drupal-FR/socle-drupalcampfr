#!/bin/bash

FILE_PATH=$(realpath $0)
PROJECT_PATH=$(dirname $(dirname $FILE_PATH))

. $PROJECT_PATH/scripts/script-parameters.sh

# Test that composer is installed.
if ! hash "composer" 2> /dev/null; then
    echo "ERROR: Composer needs to be installed. Aborting.";
    exit 1;
fi

# Installation.
composer install --working-dir=$WWW_PATH

# Install Drupal.
# Without drush alias, change temporarily directory to www.
cd $WWW_PATH
$DRUSH site-install standard \
  --account-mail=$ACCOUNT_MAIL \
  --account-name=$ACCOUNT_NAME \
  --account-pass=$ACCOUNT_PASS \
  --site-mail=$SITE_MAIL \
  --site-name=$SITE_NAME \
  --locale=fr \
  --keep-config=TRUE

cd $CURRENT_PATH
