#!/bin/bash

. $(dirname $(dirname ${BASH_SOURCE[0]}))/script-parameters.sh
. $(dirname $(dirname ${BASH_SOURCE[0]}))/script-parameters.local.sh

if [ "${ENVIRONMENT_MODE}" = "dev" ]; then
  echo -e "${LIGHT_GREEN}Enable development modules.${NC}"
  MODULES=''
  for DEVELOPMENT_MODULE in "${DEVELOPMENT_MODULES[@]}"
  do
    MODULES="$MODULES $DEVELOPMENT_MODULE"
  done
  $DRUSH pm:enable $MODULES -y
fi
