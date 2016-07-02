# socle-drupalcampfr

Technical base for french Drupalcamps.

# Requirements

* Composer

# Installation

* Copy/paste **scripts/example.script-parameters.sh** into **scripts/script-parameters.sh and adapt it to your configuration.**
* Copy/paste **www/sites/default/example.settings/local.php** into **www/sites/default/settings.local.php and adapt it to your configuration.**
* Create **www/sites/default/files** folder.
* Execute **scripts/install.sh**

## Additional steps to install with Docker compose

* Do not execute scripts/install.sh from your computer.
* Copy/paste the example.docker-compose.yml into docker-compose.yml and adapt it to your configuration to use the docker image you want.
* Execute: **docker-compose up**
* In another tab, get a command-line in the container: **docker exec -it container_name_web_1 /bin/bash**
* Execute scripts/install.sh
