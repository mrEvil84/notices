<?php

namespace PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator;

use PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator\ChangeDataDbComponent;
use PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator\ChangeDbLogger;
use PkowerzMacwro\GitSandbox\patterns\behavioral\Mediator\DbMediator;

require_once '../../../../vendor/autoload.php';


// Mediator to behawioralny wzorzec projektowy pozwalający zredukować chaos zależności pomiędzy obiektami.
// Wzorzec ten ogranicza bezpośrednią komunikację pomiędzy obiektami i zmusza je do współpracy wyłącznie
// za pośrednictwem obiektu mediatora

//  - Stosuj wzorzec Mediator gdy zmiana jakichś klas jest trudna z powodu ścisłego sprzęgnięcia z innymi klasami.
//  - Stosuj ten wzorzec gdy nie możesz ponownie użyć jakiegoś komponentu w innym programie, z powodu zbytniej jego
//  zależności od innych komponentów.
//  - Stos

// MT: analogia z życia wieża kontroli lotów oraz samoloty w przestrzeni kontrolowanej przez wieżę
// MT: samoloty komunikuja sie ze soba za pomoca wiezy kontroli lotow ale nie wzajemnie

//class MediatorPattern
//{
//}

$writer = new ChangeDataDbComponent();
$logger = new ChangeDbLogger();

// obierkt mediatora
$mediator = new DbMediator($writer, $logger);

$writer->insertToDb('INSERT INTO test');
$writer->updateToDb('UPDATE abc ');
