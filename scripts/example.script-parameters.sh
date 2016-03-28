#!/bin/bash

FILE_PATH=$(realpath $0)
PROJECT_PATH=$(dirname $(dirname $FILE_PATH))

CURRENT_PATH=$(pwd)

SCRIPTS_PATH=$PROJECT_PATH/scripts
WWW_PATH=$PROJECT_PATH/www

DRUSH=$WWW_PATH/vendor/bin/drush

# Used to know if we want to download and enable development modules.
ENVIRONMENT_MODE="dev"
# Only "dev" is searched. So any other string can prevent development modules.
ENVIRONMENT_MODE="prod"

CURRENT_DATE=$(date "+%Y-%m-%d-%Hh%Mm%Ss")

# For Drush site-install.
PROFILE=drupalcampfr
ACCOUNT_MAIL=admin@example.com
ACCOUNT_NAME=admin
ACCOUNT_PASS=admin
SITE_MAIL=admin@example.com
SITE_NAME="Socle Drupalcampfr"
