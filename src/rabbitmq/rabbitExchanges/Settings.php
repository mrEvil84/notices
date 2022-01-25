<?php

namespace PkowerzMacwro\GitSandbox\rabbitmq\rabbitExchanges;

class Settings
{
    public const QUEUE_NAME = 'task_queue';
    public const EXCHANGE_NAME = 'logs';
    public const EXCHANGE_BROADCAST_TYPE = 'fanout'; // rozglasza do kazdego
}