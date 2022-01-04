<?php
// hash
$avaiableHashAlgos = hash_algos();
$dataToEncrypt = 'PiotrKowerzanow';

foreach ($avaiableHashAlgos as $algo) {
    echo $algo . ' -> ' . hash($algo, $dataToEncrypt) . PHP_EOL;
}

// crypt
$cryptedData = crypt($dataToEncrypt, '1234');
echo $cryptedData . PHP_EOL;

// password_hash
$data = password_hash('secret', PASSWORD_ARGON2I);

echo 'Data from password_hash: ' . $data . PHP_EOL;


$encryptedData = hash_hmac('sha256', 'secret', '84101714435');

var_dump($encryptedData);

