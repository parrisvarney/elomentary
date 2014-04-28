<?php

/**
 * @file
 * Contains \Eloqua\Api\Assets\Email.
 */

namespace Eloqua\Api\Assets;

use Eloqua\Api\AbstractApi;
use Eloqua\Api\Assets\Email\Group;
use Eloqua\Api\SearchableInterface;

/**
 * Eloqua Email.
 */
class Email extends AbstractApi implements SearchableInterface {

  /**
   * {@inheritdoc}
   */
  public function search($search, array $options = array()) {
    return $this->get('assets/emails', array_merge(array(
      'search' => $search,
    ), $options));
  }

  /**
   * Returns an e-mail group client.
   *
   * @return \Eloqua\Api\Assets\Email\Group
   *   An e-mail group client.
   */
  public function groups() {
    return new Group($this->client);
  }

  /**
   * Return extended information about an email by its ID.
   *
   * @param int $id
   *   The ID associated with the desired email.
   *
   * @return array
   *   The desired email record represented as an associative array.
   */
  public function show($id) {
    return $this->get('assets/email/' . rawurlencode($id));
  }

  /**
   * Create an email.
   *
   * @param string $name
   *   The desired name of the email.
   *
   * @param array $options
   *   An optional array of additional query parameters to be passed.
   *
   * @return array
   *   The created email record represented as an associative array.
   */
  public function create($name, array $options = array()) {
    return $this->post('assets/email', array_merge(array(
      'name' => $name,
    ), $options));
  }

}
