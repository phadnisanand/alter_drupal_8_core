<?php

namespace Drupal\servidedemooverride;
use Drupal\servicedemo\ApiDemo;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;

class ApiDemoOverride extends ApiDemo {
	protected $apiDemo;

	public function __construct(EntityTypeManagerInterface $entity_type_manager, Connection $connection,LanguageManagerInterface $language_manager, AccountProxyInterface $currentUser, ApiDemo $apiDemo) {
       $this->entityTypeManager = $entity_type_manager;
       $this->connection = $connection;
       $this->languageManager = $language_manager;
       $this->currentUser = $currentUser;
       $this->apiDemo = $apiDemo;
    }

	public function getApiDataFromService() {
	  return 'Service Override';
	}

  public function getApiDataFromServiceInPlugin() {
  
    return 'plugin data override';
  }
}

