<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ServiceController
 * @package AppBundle\Controller
 */
Class ServiceController extends FOSRestController
{
	/**
	 * @return array
	 */
	public function getServicesAction()
	{
		$client 		= new Client();
		$services		= [];
		$serviceList	= $this->getParameter('app.services');

		foreach($serviceList as $serviceName => $serviceConfig) {
			$response		= $client->get($serviceConfig['endpoint'].$serviceConfig['method']);
			$serviceRoutes	= json_decode($response->getBody()->getContents(), true);

			$services[$serviceName] = [
				'endpoint'	=> $serviceConfig['endpoint'],
				'routes'	=> $serviceRoutes,
			];
		}

		return $services;
	}
}
