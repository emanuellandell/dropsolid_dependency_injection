<?php

namespace Drupal\dropsolid_dependency_injection\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\dropsolid_dependency_injection\RestConnectionInterface;
//use Drupal\dropsolid_dependency_injection\Service;

/**
 * Class RestOutputController
 * @package Drupal\dropsolid_dependency_injection\Controller
 */
class RestOutputController {

  /**
   * @return array
   */
  public function showPhotos() {

    $build = [
      '#cache' => [
        'max-age' => 60,
        'contexts' => ['url']
      ]
    ];

    $decoded = \Drupal::service('dropsolid_dependency_injection.rest_services')->getData($albumId = 5);

    foreach ($decoded as $item) {
      $build['rest_output_block']['photos'][] = [
        '#theme' => 'image',
        '#uri' => $item->thumbnailUrl,
        '#alt' => $item->title,
        '#title' => $item->title
      ];
    }

    return $build;
  }

  function dropsolid_dependency_injection_mail_alter(&$message) {

    $message['to'] = 'blah@doesntexist.com';

/*
    if ($message['id'] == 'modulename_messagekey') {
      if (!example_notifications_optin($message['to'], $message['id'])) {

        // If the recipient has opted to not receive such messages, cancel
        // sending.
        $message['send'] = FALSE;
        return;
      }
      $message['body'][] = "--\nMail sent out from " . \Drupal::config('system.site')
        ->get('name');
    }
    */
  }

}
