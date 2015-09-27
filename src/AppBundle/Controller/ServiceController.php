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
	 * @param Request $request
	 * @return array
	 */
	public function getServicesAction(Request $request)
	{
		$client 		= new Client();
		$services		= [];
		$serviceList	= $this->getParameter('app.services');

		foreach($serviceList as $serviceConfig) {
			$response	= $client->get($serviceConfig['endpoint'].$serviceConfig['method']);
			$response	= json_decode($response->getBody()->getContents());

			foreach($response->configuration as $serviceName => $config) {
				$services[$serviceName] = [
					'endpoint'	=> $serviceConfig['endpoint'],
					'routes'	=> (array) $config->routes,
				];
			}
		}

		return ['services' => $services];
	}
}
