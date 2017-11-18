#!/bin/bash

. $(dirname ${BASH_SOURCE[0]})/script-parameters.sh
. $(dirname ${BASH_SOURCE[0]})/script-parameters.local.sh

# Install sources.
. $SCRIPTS_PATH/tasks/composer_install.sh

# Without drush alias, change temporarily directory to www.
cd $WWW_PATH

# Clear Drush cache in case of update.
$DRUSH cache:clear drush

# Database backup.
$DRUSH sql:dump --result-file="${PROJECT_PATH}/backups/${CURRENT_DATE}.sql" --gzip --structure-tables-key="common"

# Clear Redis cache because otherwise it is no emptied on site-install and it
# provokes errors.
$REDIS_FLUSH_COMMAND

# Install Drupal.
$DRUSH site:install $PROFILE \
  --account-mail=$ACCOUNT_MAIL \
  --account-name=$ACCOUNT_NAME \
  --account-pass=$ACCOUNT_PASS \
  --site-mail=$SITE_MAIL \
  --site-name=$SITE_NAME \
  --locale=$DEFAULT_LANGUAGE \
  -y

# TODO: workaround since https://www.drupal.org/node/2916090 is not fixed.
$DRUSH user:password $ACCOUNT_NAME $ACCOUNT_PASS
$DRUSH config:set system.site mail $SITE_MAIL -y

# Launch updates. Ensure that the database schema is up-to-date.
$DRUSH updatedb --entity-updates -y

. $SCRIPTS_PATH/tasks/development_modules.sh
. $SCRIPTS_PATH/tasks/migrate_imports.sh
. $SCRIPTS_PATH/tasks/update_translations.sh

# Run CRON.
$DRUSH core:cron

# Flush caches to be clean.
$DRUSH cache:rebuild

# Back to the current directory.
cd $CURRENT_PATH
