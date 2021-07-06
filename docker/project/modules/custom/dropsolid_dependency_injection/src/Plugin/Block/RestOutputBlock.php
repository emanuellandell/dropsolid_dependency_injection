<?php

namespace Drupal\dropsolid_dependency_injection\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\dropsolid_dependency_injection\RestConnectionInterface;
//use Drupal\dropsolid_dependency_injection\Service;

/**
 * Provides a 'RestOutputBlock' block.
 *
 * @Block(
 *  id = "rest_output_block",
 *  admin_label = @Translation("Rest output block"),
 * )
 */
class RestOutputBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $build = [
      '#cache' => [
        'max-age' => 60,
        'contexts' => ['url']
      ]
    ];

    $albumId = random_int(1, 20);
    $decoded = \Drupal::service('dropsolid_dependency_injection.rest_services')->getData($albumId);

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
