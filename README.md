# Drupal 8 docker package

### Install on Windows

Install [Docker](https://store.docker.com/editions/community/docker-ce-desktop-windows).

Restart the machine when prompted to activate Hyper-V (Windows 10 Pro - 64bit required. Virtualbox or similar may be required on other systems).

### Install on other systems

Find the [relevant Docker installer](https://www.docker.com).

### Run

Run ```docker-compose up``` in the repo root.

Visit the site on ```localhost:8090```.

Visit phpmyadmin on ```localhost:8080```.

Log in as the super user with user name ```admin``` and password ```123``` if you are not logged in as default.

### Shut down

Shut down the docker network with ```docker-compose down```.

### Environment variables

All vars is moved to `./docker/project/environment.env` to try to streamline the setup.
You might want to change some of these. For example, all passwords are set to 123 and development options are on (no or limited caching).

### Drush and Drupal Console

Drush and Drupal Console are included in the image.

To use them, exec into the running container with  `docker exec -ti dropsolid_project_1 /bin/bash`.

### About
