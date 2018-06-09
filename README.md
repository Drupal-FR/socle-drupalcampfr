# socle-drupalcampfr

Technical base for french Drupalcamps.

## Requirements

* Composer

## Installation

* Execute: `scripts/init.sh`
* Adapt the following files to your configuration:
  * scripts/script-parameters.local.sh
  * www/sites/default/settings.local.php
* Execute `scripts/install.sh` (do not if using docker, see below)

### Additional steps to install with Docker compose

* **Do not execute scripts/install.sh from your computer.**.
* Adapt the following files to your configuration:
  * docker-compose.yml
* Execute: `docker-compose up`
* In another tab, get a command-line in the container:
`docker exec -it container_name_web_1 /bin/bash` (*container_name* should be remplaced by the name of the **web** container)
* Execute:
  * `cd /project (if necessary)`
  * `./scripts/install.sh`

The website **should** be located at this address: `http://127.0.0.1:8091/*`

### Q/A
#### How to find out the container names?
You can use the command `docker ps` which list all the running docker containers.

![docker PS](http://i.imgur.com/SDgHsqs.png)

#### How to use drush within docker?
You can use docker within the web container by using the alias `@docker.default.local`:

```
drush @docker.default.local status
```

Note: you have to "be" in the docroot folder (eg: `/project/www`)

#### How to import a custom dump?

Put the dump in the `backups` folder and then in the **web** container you can use the following commands:

#### Gziped dump
```
zcat /project/backups/DUMP_NAME.sql.gz | mysql -u drupal -pdrupal -h mysql drupal
```

#### « regular » dump (without compression)
```
cat /project/backups/DUMP_NAME.sql.gz | mysql -u drupal -pdrupal -h mysql drupal
```
