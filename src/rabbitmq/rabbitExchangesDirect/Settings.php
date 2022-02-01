<?php

namespace PkowerzMacwro\GitSandbox\rabbitmq\rabbitExchangesDirect;

class Settings
{
    public const QUEUE_NAME = 'task_queue';
    public const EXCHANGE_NAME = 'direct_logs';
    public const EXCHANGE_BROADCAST_TYPE = 'direct';
}