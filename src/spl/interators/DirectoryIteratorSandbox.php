<?php

namespace PkowerzMacwro\GitSandbox\spl\interators;

use DirectoryIterator;

class DirectoryIteratorSandbox
{

}

///** @var \SplFileInfo $fileInfo */
//foreach (new DirectoryIterator('../../rabbitmq') as $fileInfo) {
//    if($fileInfo->isDot()) continue;
//    if ($fileInfo->isDir()) echo '[D] '; else echo '[F] ';
//    echo $fileInfo->getFilename() . ' ' . $fileInfo->getPerms() . ' ' . $fileInfo->getType() . PHP_EOL;
//}


$Directory = new \RecursiveDirectoryIterator('../../');

$it = new \RecursiveTreeIterator($Directory);
foreach( $it as $key => $value ){
    echo $value . PHP_EOL;
}

