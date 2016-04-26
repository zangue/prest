Prest
=====

Prest is a PHP REST client library based on [Pest](https://github.com/educoder/pest).
In a nutshell Prest is a wrapper around Pest that let you write RESTful client in
a more elegant way (imho).

Installation
------------


Basic Usage
-----------

```php

$factory = new PrestFactory('http://example.com');

$rest = $factory->create()
    ->url('/resource')
    ->withHeader('Authorization', 'Basic ' . OAUTH_BASIC))
    ->contentType('application/x-www-form-urlencoded')
    ->accept('application/json')
    ->data('data1', 'value1')
    ->data('data2', 'value2')
    ->buildHttpQuery()
    ->viaPost()
    ->execute();

if ($rest->succeed()) {
    var_dump($rest->getResponse);
} else {
    ...
}

$rest->reset();

$rest = $rest->url('/delete')
            ->viaDelete()
            ->execute();

if ($rest->failed()) {
    ...
}

```
Just as with Pest one can use the createJSON() and createXML() factory methods to
create JSON and XML-centric version of Prest.


API
---