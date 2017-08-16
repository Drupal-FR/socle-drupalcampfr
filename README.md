# socle-drupalcampfr

Technical base for french Drupalcamps.

# Requirements

* Composer

# Installation

* Execute: `scripts/init.sh`  (do not if using docker)
* Adapt the following files to your configuration:
  * scripts/script-parameters.local.sh
  * www/sites/default/settings.local.php
* Execute `scripts/install.sh`

## Additional steps to install with Docker compose

* **Do not execute scripts/install.sh from your computer.**
* Adapt the following files to your configuration:
  * docker-compose.yml
* Execute: `docker-compose up`
* In another tab, get a command-line in the container:
`docker exec -it container_name_web_1 /bin/bash`
 (*container_name* should be remplaced by the name of the **web** container)
* Execute `scripts/install.sh`

The website should be located at this address : http://127.0.0.1:8091/*

### Q&A
#### How to find out the container names ?
You can use the command `docker ps` which list all the running docker containers.

![docker PS](http://i.imgur.com/SDgHsqs.png)

#### How to use drush within docker ?
You can use docker within the web container by using the alias `@dev.default` :

```
drush @dev.default status
```
