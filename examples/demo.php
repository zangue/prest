<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Prest\PrestFactory;

$base = 'http://jsonplaceholder.typicode.com';

$factory = new PrestFactory($base);

$rest = $factory->create()
    ->url('/posts/1')
    ->viaGet()
    ->execute();

if ($rest->succeed()) {
    var_dump($rest->getResponseBody());
}
else {
    var_dump($rest->getException()->getMessage());
}

$rest->reset()
    ->url('comments')
    ->data('postId', 1)
    ->viaGet()
    ->execute();

//var_dump($rest->getData());

if ($rest->succeed()) {
    var_dump($rest->getResponseBody());
}
else {
    var_dump($rest->getException()->getMessage());
}

$rest = $factory->create('http://validate.jsontest.com')
    ->url('/')
    ->data('json', '{"key":"value"}')
    ->viaGet()
    ->execute();

if ($rest->succeed()) {
    var_dump($rest->getResponseBody());
}
else {
    var_dump($rest->getException()->getMessage());
}