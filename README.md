Prest
=====

Prest is a PHP REST client library based on [Pest](https://github.com/educoder/pest).
In a nutshell Prest is a wrapper around Pest that let you write RESTful client in
a more elegant way (imho).

Note
----

Still in beta.

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
Returns the request headers, empty array if no headers were set.

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
Returns the request data, empty array if no data were set.

```php
Prest buildHttpQuery ()
```
Builds http query from request data.

```php
Prest withCookie (string $name, string $value)
```
Add a cookie.

```php
array getCookies ()
```
Returns array of cookies or empty array if no cookies were added to the request.

```php
Prest withAuth (string $user, string $pass, string $auth = 'basic')
```
Setup authentication. $auth can basic (default) or disgest.

```php
Prest withProxy (string $host, int $port, [string $user, string $pass])
```
Setup proxy.

```php
Prest function curlOpts (string $option, mixed $value)
```
Set cURL option.

```php
boolean succeed ()
boolean failed()
```
Tells if the request was successful/failed.

```php
int getStatus ()
```
Get last response status code

```php
Exception getException ()
```
Return the raised exception in case of failure.

```php
mixed getResponseBody ()
```
Returns the last response body on success. This method will return an associative array or
a SimpleXMLElement if the Prest object were created using ```createJSON``` or ```createXML```
factory method respectively.

```php
boolean responseHasHeader (string $header)
```
Checks if last response has a specific header.

```php
string getResponseHeader (string $header)
```
Returns the last response header (case insensitive) or NULL if not present.

```php
Prest viaGet ()
Prest viaPost ()
Prest viaPut ()
Prest viaPatch ()
Prest viaHead ()
Prest viaDelete ()
```
Use HTTP GET/POST/PUT/PATCH/HEAD/DELETE method.

```php
Prest execute ()
```
Executes the request.