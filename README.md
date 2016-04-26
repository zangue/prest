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

$rest2 = $factory->create('http://base-url.com')
    ->url('/uri')
    ->viaGet()
    ->execute();

...

```
Just as with Pest one can use the createJSON() and createXML() factory methods to
create JSON and XML-centric version of Prest.


API
---
```php
Prest url (string $value)
```
Set the resource URL.

```php
string getUrl ()
```
Returns the resource URL, empty string if not set.

```php
Prest withHeader (string $key, string $value)
```
Adds a header.

```php
array getHeaders ()
```
Returns the request headers, empty array if no headers set.

```php
Prest contentType (string $value)
```
Shortcut: adds Content-Type header.

```php
Prest data (mixed $key, mixed $value)
```
Adds request data

```php
array getData ()
```
Returns the request data, empty array if no data set

