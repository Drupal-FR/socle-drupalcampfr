#!/bin/bash

. $(dirname ${BASH_SOURCE[0]})/script-parameters.sh

# Copy example files.
rsync -avz --ignore-existing $PROJECT_PATH/example.docker-compose.yml           $PROJECT_PATH/docker-compose.yml
rsync -avz --ignore-existing $SCRIPTS_PATH/example.script-parameters.local.sh   $SCRIPTS_PATH/script-parameters.local.sh
rsync -avz --ignore-existing $WWW_PATH/sites/default/example.settings.local.php $WWW_PATH/sites/default/settings.local.php

# Create public files directory.
mkdir -p $WWW_PATH/sites/default/files

# Permissions are for dev environments. It should be less permissive.
chmod 777 $WWW_PATH/sites/default/files
