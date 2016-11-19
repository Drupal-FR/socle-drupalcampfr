#!/bin/bash

function abspath() {
    python -c "import sys, os;sys.stdout.write(os.path.abspath(\"$@\"))"
}

FILE_PATH=$(abspath "${0}")
PROJECT_PATH=$(dirname $(dirname $FILE_PATH))

. $PROJECT_PATH/scripts/script-parameters.sh
. $PROJECT_PATH/scripts/script-parameters.local.sh

# Import content.
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
$DRUSH migrate-import drupalcampfr_store --update
$DRUSH migrate-import drupalcampfr_ticket_variation --update
$DRUSH migrate-import drupalcampfr_ticket --update
$DRUSH migrate-import drupalcampfr_menu_link --update
$DRUSH migrate-import drupalcampfr_basic_block --update
