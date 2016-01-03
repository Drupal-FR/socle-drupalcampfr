#!/bin/bash

SCRIPTS_RELATIVE_PATH=$(dirname $0)
WWW_PATH=$SCRIPTS_RELATIVE_PATH/../www

DRUSH=$WWW_PATH/vendor/bin/drush

# Test that composer is installed.
if ! hash "composer" 2> /dev/null; then
    echo "ERROR: Composer needs to be installed. Aborting.";
    exit 1;
fi

# Installation.
composer install --working-dir=$WWW_PATH
