<?php

namespace PkowerzMacwro\GitSandbox\pelletSandbox;

class PelletService
{
    public function addOneBag(): void
    {
        $pellet = new Pellet(date('Y-m-d H:i:s'), time());

    }

}