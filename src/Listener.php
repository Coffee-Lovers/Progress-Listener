<?php
/**
 * Created by PhpStorm.
 * User: nikolatrbojevic
 * Date: 27/09/2016
 * Time: 08:24
 */

namespace CL;

use CLLibs\Messaging\CoffeePotProgressMessage;
use CLLibs\Messaging\Hub;
use Psr\Log\LoggerInterface;

class Listener
{
    /**
     * @var Hub
     */
    private $messagingHub;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Controller constructor.
     * @param Hub $messagingHub
     * @param LoggerInterface $logger
     */
    public function __construct(Hub $messagingHub, LoggerInterface $logger)
    {
        $this->messagingHub = $messagingHub;
        $this->logger       = $logger;
    }

    /**
     * Process method.
     */
    public function process()
    {
        $this->logger->info("Booting up processing");
        $that = $this;
        $this->messagingHub->subscribe(CoffeePotProgressMessage::TOPIC, function ($message) use ($that) {
            $that->logger->info("Message {message} received", ["message" => $message]);
        });
    }

}