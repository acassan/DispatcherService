<?php
namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations as REST;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Class GameController
 * @package AppBundle\Controller\Api
 * @Route("/dispatcher")
 */
class DispatcherController extends FOSRestController
{
    /**
     * @REST\Post("/dispatchevent", name="api_dispatcher_dispatchevent", requirements={ "id"="\d+"})
     *
     * @REST\RequestParam(name="eventkey", requirements="[a-z]+", description="Event key")
     * @REST\RequestParam(name="eventvalue", description="Event value")
     *
     * @param ParamFetcherInterface $paramFetcher
     * @return array
     */
    public function dispatcheventAction(ParamFetcherInterface $paramFetcher)
    {
        $eventkey   = $paramFetcher->get('eventkey');
        $eventvalue = $paramFetcher->get('eventvalue');

        $this->get('api.dispatcher')->dispatch($eventkey, $eventvalue);

        return [];
    }
}
