<?php

namespace PkowerzMacwro\GitSandbox\rabbitmq\rabbitWorkQueues;

class Settings
{
    public const QUEUE_NAME = 'task_queue';
    public const EXCHANGE_NAME = 'logs';
    public const EXCHANGE_BROADCAST_TYPE = 'fanout';
}