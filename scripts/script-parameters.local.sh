#!/bin/bash

function abspath() {
    python -c "import sys, os;sys.stdout.write(os.path.abspath(\"$@\"))"
}

FILE_PATH=$(abspath "${0}")
PROJECT_PATH=$(dirname $(dirname $FILE_PATH))

# Used to know if we want to download and enable development modules.
ENVIRONMENT_MODE="dev"

# For Drush site-install.
PROFILE=drupalcampfr
ACCOUNT_MAIL=florent.torregrosa@centrale-marseille.fr
ACCOUNT_NAME=admin
ACCOUNT_PASS=admin
SITE_MAIL=florent.torregrosa@centrale-marseille.fr
SITE_NAME="Socle Drupalcampfr"
