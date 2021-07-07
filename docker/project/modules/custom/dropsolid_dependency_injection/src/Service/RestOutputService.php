<?php

namespace Drupal\dropsolid_dependency_injection\Service;

use Drupal\Core\Session\AccountInterface;

/**
 * Class CustomService
 * @package Drupal\dropsolid_dependency_injection\Service
 */
class RestOutputService {

  protected $currentUser;

  /**
   * CustomService constructor.
   * @param AccountInterface $currentUser
   */
  public function __construct() {

  }

  /**
   * @return \Drupal\Component\Render\MarkupInterface|string
   */
  public function getData(int $albumId) {
    $decoded = [];

    try {
      $response = \Drupal::httpClient()->request('GET', "https://jsonplaceholder.typicode.com/albums/{$albumId}/photos");
      $data = $response->getBody()->getContents();
      $decoded = json_decode($data);
      if (!$decoded) {
        throw new \Exception('Invalid data returned from API');
      }
      return $decoded;

    } catch (\Exception $e) {
      $decoded = [];
    }

    return $decoded;
  }

}
