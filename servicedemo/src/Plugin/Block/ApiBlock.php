<?php

namespace Drupal\servicedemo\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\servicedemo\ApiDemoInterface;

/**
 * Provides a 'Api' Block.
 *
 * @Block(
 *   id = "api_block",
 *   admin_label = @Translation("Api Block"),
 *   category = @Translation("Api Block"),
 * )
 */
class ApiBlock extends BlockBase implements ContainerFactoryPluginInterface {


  /**
   * @var $account \Drupal\Core\Session\AccountProxyInterface
   */
  protected $account;

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   *
   * @return static
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user'),
      $container->get('servicedemo.api_demo')
    );
  }

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Session\AccountProxyInterface $account
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, 
  	AccountProxyInterface $account, ApiDemoInterface $api_obj) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->account = $account;
    $this->api_obj = $api_obj;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

  	$currentUserEmail = $this->account->getEmail();


  	$apiData =  $this->api_obj->getApiDataFromServiceInPlugin();

    // Static call to service 
  	$serviceObj = \Drupal::service('servicedemo.api_demo');
  	
  	$serviceData = $serviceObj->getApiDataFromServiceInBlock();

    return [
      '#markup' => $apiData,
    ];
  }

}