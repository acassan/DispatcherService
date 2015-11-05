<?php
namespace AppBundle\Dispatcher;

use ApiBundle\Api\Api;
use ApiBundle\Dispatcher\DispatcherInterface;

/**
 * Class ServiceDispatcher
 * @package AppBundle\Dispatcher
 */
Class ServiceDispatcher implements DispatcherInterface
{
    /**
     * @var Api
     */
    private $api;

    /**
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * @param $eventKey
     * @param $eventValue
     * @return mixed
     */
    public function dispatch($eventKey, $eventValue)
    {
        $parameters = [
            'eventkey'      => $eventKey,
            'eventvalue'    => $eventValue,
        ];

        foreach($this->api->getServices() as $serviceConfig) {
            $this->api->callServiceMethod($serviceConfig->getName(), 'api_dispatcher_entry', $parameters);
        }
    }
}