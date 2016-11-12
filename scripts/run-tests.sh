#!/bin/bash

function abspath() {
    python -c "import sys, os;sys.stdout.write(os.path.abspath(\"$@\"))"
}

FILE_PATH=$(abspath "${0}")
PROJECT_PATH=$(dirname $(dirname $FILE_PATH))

. $PROJECT_PATH/scripts/script-parameters.sh

# Run behat tests.
$WWW_PATH/vendor/bin/behat --config=$SCRIPTS_PATH/tests/behat/behat.yml
