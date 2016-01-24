#!/bin/bash

FILE_PATH=$(realpath $0)
PROJECT_PATH=$(dirname $(dirname $FILE_PATH))

. $PROJECT_PATH/scripts/script-parameters.sh

# Test that composer is installed.
if ! hash "composer" 2> /dev/null; then
    echo "ERROR: Composer needs to be installed. Aborting.";
    exit 1;
fi

# Update source.
composer install --working-dir=$WWW_PATH

# Without drush alias, change temporarily directory to www.
cd $WWW_PATH

# Launch updates.
$DRUSH updb -y

# Revert features.



# Back to the current directory.
cd $CURRENT_PATH
