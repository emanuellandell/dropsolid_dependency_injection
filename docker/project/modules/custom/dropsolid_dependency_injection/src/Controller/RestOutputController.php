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

}
