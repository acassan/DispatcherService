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
		$client 	= new Client();
		$services	= [];
		$servicesEndpoint 		= [
			'http://localhost/esport/GameDataService/web/app_dev.php'
		];

		foreach($servicesEndpoint as $endpoint) {
			$response	= $client->get($endpoint.'/routes.json');
			$config		= json_decode($response->getBody()->getContents());

			foreach($config->configuration as $serviceName => $serviceConfig) {
				$services[$serviceName] = [
					'endpoint'	=> $endpoint,
					'routes'	=> (array) $serviceConfig->routes,
				];
			}
		}

		return ['services' => $services];
	}
}
