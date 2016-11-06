# socle-drupalcampfr

Technical base for french Drupalcamps.

# Requirements

* Composer

# Installation

* Execute: **scripts/init.sh**
* Adapt the following files to your configuration:
  * scripts/script-parameters.local.sh
  * www/sites/default/settings.local.php
* In the **www** directory, execute: **composer install** to get the project's Drush.
* Execute **scripts/install.sh**

## Additional steps to install with Docker compose

* Do not execute scripts/install.sh from your computer.
* Adapt the following files to your configuration:
  * docker-compose.yml
* Execute: **docker-compose up**
* In another tab, get a command-line in the container: **docker exec -it container_name_php_1 /bin/bash**
* Execute scripts/install.sh
