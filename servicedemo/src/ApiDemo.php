<?php

namespace Drupal\servicedemo;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Session\AccountProxyInterface;

class ApiDemo implements ApiDemoInterface {

	public function __construct(EntityTypeManagerInterface $entity_type_manager, Connection $connection,LanguageManagerInterface $language_manager, AccountProxyInterface $currentUser) {
       $this->entityTypeManager = $entity_type_manager;
       $this->connection = $connection;
       $this->languageManager = $language_manager;
       $this->currentUser = $currentUser;
    }


	public function getApiDataFromService() {
	  $currentUserId = $this->currentUser->id();
	  return 'API data from service ' . $currentUserId;
	}

	public function getApiDataFromServiceInBlock() {
	   $nid = 1;
	   $node_storage = $this->entityTypeManager->getStorage('node');
       $node = $node_storage->load($nid);
	   return 'Node title ' . $node->get('title')->value;
	}

	public function getApiDataFromServiceInPlugin() {
	  $currentUserId = $this->currentUser->id();
	  return 'API data from service in plugin ' .  $currentUserId;
	}
}