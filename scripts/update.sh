#!/bin/bash

function abspath() {
    python -c "import sys, os;sys.stdout.write(os.path.abspath(\"$@\"))"
}

FILE_PATH=$(abspath $0)
PROJECT_PATH=$(dirname $(dirname $FILE_PATH))

. $PROJECT_PATH/scripts/script-parameters.sh

# Test that composer is installed.
if ! hash "composer" 2> /dev/null; then
    echo "ERROR: Composer needs to be installed. Aborting.";
    exit 1;
fi

# Update source.
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

# Launch updates.
$DRUSH updb -y

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

# Revert features.
$DRUSH features-import -y --bundle=drupalcampfr core
$DRUSH features-import -y --bundle=drupalcampfr site
$DRUSH features-import -y --bundle=drupalcampfr user
$DRUSH features-import -y --bundle=drupalcampfr homepage
$DRUSH features-import -y --bundle=drupalcampfr news
$DRUSH features-import -y --bundle=drupalcampfr page
$DRUSH features-import -y --bundle=drupalcampfr sponsor
$DRUSH features-import -y --bundle=drupalcampfr session
# Waiting for https://www.drupal.org/node/2672490
#$DRUSH features-import -y --bundle=drupalcampfr drupalcampfr

# Translation updates.
# TODO: Drush commands are broken. Repaired in 8.1.x
#$DRUSH locale-check
#$Drush locale-update

# Import content.
# For update.sh import only content if the environment is dev to not risk
# breaking prod.
if [ "${ENVIRONMENT_MODE}" = "dev" ]; then
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
  $DRUSH migrate-import drupalcampfr_basic_block --update
fi

# Back to the current directory.
cd $CURRENT_PATH
