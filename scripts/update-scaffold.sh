#!/bin/bash -e

SCRIPTS_RELATIVE_PATH=$(dirname $0)
WWW_PATH=$SCRIPTS_RELATIVE_PATH/../www

DRUSH=$WWW_PATH/vendor/bin/drush
DRUPAL_VERSION=${1:-drupal-8}
DRUPAL_TEMP=$(mktemp -d)

# Download Drupal in temp directory.
$DRUSH dl "$DRUPAL_VERSION" --destination=$DRUPAL_TEMP --drupal-project-rename=drupal-8 --quiet -y

# Update specific files.
rsync -avz $DRUPAL_TEMP/drupal-8/autoload.php                       $WWW_PATH/autoload.php
rsync -avz $DRUPAL_TEMP/drupal-8/index.php                          $WWW_PATH/index.php
rsync -avz $DRUPAL_TEMP/drupal-8/update.php                         $WWW_PATH/update.php

rsync -avz $DRUPAL_TEMP/drupal-8/.htaccess                          $WWW_PATH/.htaccess
# Do not erase existing robots.txt file.
rsync -avz --ignore-existing $DRUPAL_TEMP/drupal-8/robots.txt       $WWW_PATH/robots.txt

rsync -avz $DRUPAL_TEMP/drupal-8/sites/default/default.services.yml $WWW_PATH/sites/default/default.services.yml
rsync -avz $DRUPAL_TEMP/drupal-8/sites/default/default.settings.php $WWW_PATH/sites/default/default.settings.php
rsync -avz $DRUPAL_TEMP/drupal-8/sites/example.sites.php            $WWW_PATH/sites/example.sites.php

# Development files.
rsync -avz $DRUPAL_TEMP/drupal-8/.csslintrc                         $WWW_PATH/.csslintrc
rsync -avz $DRUPAL_TEMP/drupal-8/.editorconfig                      $WWW_PATH/.editorconfig
rsync -avz $DRUPAL_TEMP/drupal-8/.eslintignore                      $WWW_PATH/.eslintignore
rsync -avz $DRUPAL_TEMP/drupal-8/.eslintrc                          $WWW_PATH/.eslintrc
rsync -avz $DRUPAL_TEMP/drupal-8/.gitattributes                     $WWW_PATH/.gitattributes

rm -rf $DRUPAL_TEMP/drupal-8
