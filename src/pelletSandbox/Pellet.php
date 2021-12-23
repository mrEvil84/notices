<?php

namespace PkowerzMacwro\GitSandbox\pelletSandbox;

class Pellet
{
    public const NAME = 'Poltarex';
    public const BAG_CAPACITY = 15;

    private int $bagCapacity = self::BAG_CAPACITY;
    private string $name = self::NAME;

    private string $addDateTime;
    private int $addTimestamp;

    public function __construct(
        string $addDateTime,
        int $addTimestamp,
        int $bagCapacity = self::BAG_CAPACITY,
        string $name = self::NAME
    ) {
        $this->bagCapacity = $bagCapacity;
        $this->name = $name;
        $this->addDateTime = $addDateTime;
        $this->addTimestamp = $addTimestamp;
    }
}