#!/bin/bash

function abspath() {
    python -c "import sys, os;sys.stdout.write(os.path.abspath(\"$@\"))"
}

FILE_PATH=$(abspath "${0}")
PROJECT_PATH=$(dirname $(dirname $FILE_PATH))

. $PROJECT_PATH/scripts/script-parameters.sh
. $PROJECT_PATH/scripts/script-parameters.local.sh

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

# Disable external cache.
rm -f $WWW_PATH/sites/default/.cache_activated

# Install Drupal.
$DRUSH site-install $PROFILE \
  --account-mail=$ACCOUNT_MAIL \
  --account-name=$ACCOUNT_NAME \
  --account-pass=$ACCOUNT_PASS \
  --site-mail=$SITE_MAIL \
  --site-name=$SITE_NAME \
  --locale=fr \
  -y

# Launch updates. Ensure that the database schema is up-to-date.
$DRUSH updb --entity-updates -y

# Enable development modules.
if [ "${ENVIRONMENT_MODE}" = "dev" ]; then
  $DRUSH en \
    config_inspector \
    dblog \
    devel \
    devel_a11y \
    features_ui \
    field_ui \
    kint \
    views_ui \
    webprofiler \
    -y
fi

# Import content.
$DRUSH en drupalcampfr_migrate -y
$DRUSH migrate-import drupalcampfr_file --update
$DRUSH migrate-import drupalcampfr_user --update
$DRUSH migrate-import drupalcampfr_page --update
$DRUSH migrate-import drupalcampfr_news --update
$DRUSH migrate-import drupalcampfr_sponsor_level --update
$DRUSH migrate-import drupalcampfr_sponsor --update
$DRUSH migrate-import drupalcampfr_session_level --update
$DRUSH migrate-import drupalcampfr_session_track --update
$DRUSH migrate-import drupalcampfr_session_length --update
$DRUSH migrate-import drupalcampfr_session_room --update
$DRUSH migrate-import drupalcampfr_session --update
$DRUSH migrate-import drupalcampfr_store --update
$DRUSH migrate-import drupalcampfr_ticket_variation --update
$DRUSH migrate-import drupalcampfr_ticket --update
$DRUSH migrate-import drupalcampfr_menu_link --update
$DRUSH migrate-import drupalcampfr_basic_block --update

# Translation updates.
$DRUSH locale-check
$DRUSH locale-update

# Enable external cache.
touch $WWW_PATH/sites/default/.cache_activated
$DRUSH cr

# Back to the current directory.
cd $CURRENT_PATH
