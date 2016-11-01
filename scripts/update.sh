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

# Revert features.
$DRUSH features-import -y $PROFILE

# Import content.
# For update.sh import only content if the environment is dev to not risk
# breaking prod.
if [ "${ENVIRONMENT_MODE}" = "dev" ]; then
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
  $DRUSH migrate-import drupalcampfr_menu_link --update
  $DRUSH migrate-import drupalcampfr_basic_block --update
fi

# Translation updates.
$DRUSH locale-check
$DRUSH locale-update

# Back to the current directory.
cd $CURRENT_PATH
