<?php

namespace Drupal\servicedemo\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ServiceDemoController extends ControllerBase { 
  
  private $my_service;
 
  public static function create(ContainerInterface $container) {
    $my_service = $container->get('servicedemo.api_demo');
    return new static($my_service);
  }

  public function __construct($my_service) { 
  	$this->my_service = $my_service;
  }
	
	public function outputTree() {

		  $serviceData = $this->my_service->getApiDataFromService();

		  $build = [
		      '#markup' => $serviceData,
		    ];
		  return $build;
	}

}