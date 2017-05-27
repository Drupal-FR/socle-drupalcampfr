#!/bin/bash

function abspath() {
    python -c "import sys, os;sys.stdout.write(os.path.abspath(\"$@\"))"
}

PROJECT_PATH=$(abspath $(dirname $(dirname ${BASH_SOURCE[0]})))

CURRENT_PATH=$(pwd)

SCRIPTS_PATH=$PROJECT_PATH/scripts
WWW_PATH=$PROJECT_PATH/www

DRUSH=$PROJECT_PATH/vendor/bin/drush

CURRENT_DATE=$(date "+%Y-%m-%d-%Hh%Mm%Ss")

PROFILE="drupalcampfr"
DEFAULT_LANGUAGE="fr"
DEVELOPMENT_MODULES=(
  config_inspector
  dblog
  devel
#  devel_a11y
  features_ui
  field_ui
#  kint
  purge_ui
#  renderviz
#  search_kint
  views_ui
  webprofiler
)
