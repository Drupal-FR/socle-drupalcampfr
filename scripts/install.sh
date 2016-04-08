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
if [ "${ENVIRONMENT_MODE}" = "dev" ]; then
    composer install --working-dir=$WWW_PATH
else
    composer install --working-dir=$WWW_PATH --no-dev
fi
composer dump-autoload --working-dir=$WWW_PATH --optimize

# Without drush alias, change temporarily directory to www.
cd $WWW_PATH

# Database backup.
$DRUSH sql-dump --result-file="${PROJECT_PATH}/backups/${CURRENT_DATE}.sql" --gzip

# Install Drupal.
$DRUSH site-install $PROFILE \
  --account-mail=$ACCOUNT_MAIL \
  --account-name=$ACCOUNT_NAME \
  --account-pass=$ACCOUNT_PASS \
  --site-mail=$SITE_MAIL \
  --site-name=$SITE_NAME \
  --locale=fr \
  -y

# Enable development modules.
if [ "${ENVIRONMENT_MODE}" = "dev" ]; then
  $DRUSH en \
    config_inspector \
    dblog \
    devel \
    features_ui \
    field_ui \
    views_ui \
    webprofiler \
    -y
fi

# Translation updates.
# TODO: Drush commands are broken. Repaired in 8.1.x
#$DRUSH locale-check
#$Drush locale-update

# Import content.
$DRUSH en drupalcampfr_migrate -y
$DRUSH migrate-import drupalcampfr_page --update
$DRUSH migrate-import drupalcampfr_news --update
$DRUSH migrate-import drupalcampfr_sponsor_level --update
$DRUSH migrate-import drupalcampfr_sponsor --update
$DRUSH migrate-import drupalcampfr_session_level --update
$DRUSH migrate-import drupalcampfr_session_track --update
$DRUSH migrate-import drupalcampfr_session_length --update
$DRUSH migrate-import drupalcampfr_session_room --update
$DRUSH migrate-import drupalcampfr_session --update
$DRUSH migrate-import drupalcampfr_menu_link --update

# Back to the current directory.
cd $CURRENT_PATH
