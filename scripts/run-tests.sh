#!/bin/bash

. $(dirname ${BASH_SOURCE[0]})/script-parameters.sh
. $(dirname ${BASH_SOURCE[0]})/script-parameters.local.sh

# Run behat tests.
$PROJECT_PATH/bin/behat --config=$SCRIPTS_PATH/tests/behat/behat.yml
