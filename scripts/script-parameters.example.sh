#!/bin/bash

FILE_PATH=$(realpath $0)
PROJECT_PATH=$(dirname $(dirname $FILE_PATH))

CURRENT_PATH=$(pwd)

SCRIPTS_PATH=$PROJECT_PATH/scripts
WWW_PATH=$PROJECT_PATH/www

DRUSH=$WWW_PATH/vendor/bin/drush

# For Drush site-install.
ACCOUNT_MAIL=admin@example.com
ACCOUNT_NAME=admin
ACCOUNT_PASS=admin
SITE_MAIL=admin@example.com
SITE_NAME="Socle Drupalcampfr"
