> Test/Process

# 1 Understand the objectives
Identify Drupal version the test was made for (8.5)

# 2 Setup development environment
Docker w/ Drupal 8.5 running on apache, Drush and phpmyadmin seems
Instead of installing with drush it makes sense to continue on the Docker approach

# 3 Clear cache & Run update to make sure there’s no cache heating issues
3.1. Run into first issue
The website encountered an unexpected error. Please try again later.</br></br><em class="placeholder">Drupal\Core\Database\DatabaseExceptionWrapper</em>: SQLSTATE[42S22]: Column not found: 1054 Unknown column &#039;revision.revision_default&#039; in &#039;field list&#039;: SELECT revision.revision_id AS revision_id, revision.langcode AS langcode, revision.revision_user AS revision_user, revision.revision_created AS revision_created, revision.revision_log AS revision_log, revision.revision_default AS revision_default, base.id AS id, base.type AS type, base.uuid AS uuid, CASE base.revision_id WHEN revision.revision_id THEN 1 ELSE 0 END AS isDefaultRevision
FROM

3.2 Added 2-patch.sql (1-init.sql will exec first)

3.3 Git commit

# 4 Enable dropsolid module in admin interface
4.1. Downgraded Drupal to 8.4.4 (the task is not about getting it to work on a specific version, keeping to the objective!)

# 5 Go to Routes & Check how to access the module
| 5.1 dropsolid_dependency_injection.rest_output_controller_showPhotos | /| dropsolid/example/photos

# 6 Challenges
## Challenge 1
### Reflected on if the service should be within the same module but decided that without more information, it would take less performance to add the service to the existing module instead of adding a new module.
### When reviewing the code in git I noticed that the $albumId was random in one case and hardcoded in the other, which resulted in a parameter for albumid
## Challenge 2
### Solved using module_mail_alter(&$message) and modifying $message[‘to’].
### Use the following code to try it out
``php
private function sendEmail(string $to) {
    $params = [];
    $params['message'] = 'Mail Body';
    $params['subject'] = 'Sample Subject';

    //Calling drupal Mail service
    $mailManager = \Drupal::service('plugin.manager.mail');
    //Module Name
    $module = 'custom_mail_sending';
    //Static Mail Key
    $key = 'custom_mail_sending_key';
    //Email Language
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = true;

    $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
    if ($result['result'] != true) {
      $message = t('There was a problem sending your email notification to @email.', array('@email' => $result["to"]));
      drupal_set_message($message, 'error');
      \Drupal::logger('custom_mail_sending_log')->notice($message);
    } else {
      $message = t('An email notification has been sent to @email ', array('@email' => $to));
      drupal_set_message($message,'status');
      \Drupal::logger('custom_mail_sending_log')->error($message);
    }
  }
  ``
## Challenge 3
## Solved using hook_system_breadcrumb_alter
## Challenge 4
## Solved using Dependency Injection Container


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
