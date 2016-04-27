<?php
/**
 * Prest - A REST client for PHP based on Pest
 *
 * @author      Armand Zangue <armand@zangue.com>
 * @copyright   (C) 2016 Armand Zangue
 * @link        https://github.com/zangue/prest
 * @version     0.1
 * @package     Prest
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Prest;

use Pest;
use PestJSON;
use Exception;

// TODO - Response headers

class Prest {

    /**
     * The REST (PEST) object
     * @var Pest | PestJSON
     */
    protected $rest = null;

    /**
     * The resource url
     * @var string
     */
    protected $url = "";

    /**
     * Request headers
     * @var array
     */
    protected $headers = array();

    /**
     * Request data
     * @var array
     */
    protected $data = array();

    /**
     * Request status
     * @var boolean
     */
    protected $ok = false;

    /**
     * The choosen request executor
     * @var array
     */
    private $executor;

    /**
     * Server response
     * @var string
     */
    protected $response = "";

    /**
     * Server response message
     * @var string
     */
    protected $message = "";

    /**
     * Class constructor
     * @param string $type PEST PHP type
     * @param string $base Server/Service base URL
     */
    public function __construct($type, $base)
    {
        if ($type === 'default') {

            $this->rest = new Pest($base);

        } elseif ($type === 'json') {

            $this->rest = new PestJSON($base);

        } elseif ($type === 'xml') {

            $this->rest = new PestXML($base);

        } else {

            throw new Exception("Unknow (PEST) type", 1);
        }

        $this->executor = [$this, 'get'];

    }

    /**
     * Reset the Prest object
     * @return void
     */
    public function reset ()
    {
        $this->url = "";
        $this->headers = array();
        $this->data = array();
        $this->ok = false;
        $this->executor = [$this, 'get'];
        $this->response = "";
        $this->message = "";
    }

    /**
     * Set the resource url
     * @param string $url
     * @return Prest
     */
    public function url ($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get the resource url
     * @return string
     */
    public function getUrl ()
    {
        return $this->url;
    }

    /**
     * Add request header
     * @param string $key
     * @param string $value
     * @return Prest
     */
    public function withHeader ($key, $value)
    {
        $this->headers[] = $key . ': ' . $value;
        return $this;
    }

    /**
     * Get the request headers
     * @return array
     */
    public function getHeaders ()
    {
        return $this->headers;
    }

    /**
     * Set the request content type
     * @param  string $type
     * @return Prest
     */
    public function contentType ($type)
    {
        $this->withHeader('Content-Type', $type);
        return $this;
    }

    /**
     * Add request data
     * @param string $key
     * @param mixed $value
     * @return Prest
     */
    public function data ($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * Get the request data
     * @return array
     */
    public function getData ()
    {
        return $this->data;
    }

    /**
     * Utility function to build http query from request data
     * @return string
     */
    public function buildHttpQuery()
    {
        if (!empty($this->data))
            $this->data = http_build_query($this->data);

        return $this;
    }

    /**
     * Get request status
     * @return boolean
     */
    public function succeed ()
    {
        return $this->ok;
    }

    /**
     * Get failure status
     * @return boolean
     */
    public function failed ()
    {
        return !$this->ok;
    }

    /**
     * Get the server message
     * @return string
     */
    public function getMessage ()
    {
        return $this->message;
    }

    /**
     * Get the server response
     * @return string
     */
    public function getResponse ()
    {
        return $this->response;
    }

    /**
     * Perfom a HTTP GET request
     * @return Prest
     */
    protected function get ()
    {
        try {

            $this->response = $this->rest->get(
                $this->url,
                $this->data,
                $this->headers
            );

            $this->ok = true;

        } catch (Exception $e) {

            $this->ok = false;
            $this->message = $e->getMessage();

        } finally {

            return $this;
        }
    }

    /**
     * Perfom a HTTP POST request
     * @return Prest
     */
    protected function post ()
    {
        try {

            $this->response = $this->rest->post(
                $this->url,
                $this->data,
                $this->headers
            );

            $this->ok = true;

        } catch (Exception $e) {

            $this->ok = false;
            $this->message = $e->getMessage();

        } finally {

            return $this;
        }
    }

    /**
     * Perfom a HTTP PUT request
     * @return Prest
     */
    protected function put ()
    {
        try {

            $this->response = $this->rest->put(
                $this->url,
                $this->data,
                $this->headers
            );

            $this->ok = true;

        } catch (Exception $e) {

            $this->ok = false;
            $this->message = $e->getMessage();

        } finally {

            return $this;
        }
    }

    /**
     * Perfom a HTTP PATCH request
     * @return Prest
     */
    protected function patch ()
    {
        try {

            $this->response = $this->rest->patch(
                $this->url,
                $this->data,
                $this->headers
            );

            $this->ok = true;

        } catch (Exception $e) {

            $this->ok = false;
            $this->message = $e->getMessage();

        } finally {

            return $this;
        }
    }

    /**
     * Perfom a HTTP HEAD request
     * @return Prest
     */
    protected function head () 
    {
        try {

            $this->response = $this->rest->head($this->url);

            $this->ok = true;

        } catch (Exception $e) {

            $this->ok = false;
            $this->message = $e->getMessage();

        } finally {

            return $this;
        }
    }

    /**
     * Perfom a HTTP DELETE request
     * @return Prest
     */
    protected function delete ()
    {
        try {

            $this->response = $this->rest->delete(
                $this->url,
                $this->headers
            );

            $this->ok = true;

        } catch (Exception $e) {

            $this->ok = false;
            $this->message = $e->getMessage();

        } finally {

            return $this;
        }
    }

    /**
     * Use HTTP POST method
     * @return Prest
     */
    public function viaPost ()
    {
        $this->executor = [$this, 'post'];
        return $this;
    }

    /**
     * Use HTTP GET method
     * @return Prest
     */
    public function viaGet ()
    {
        $this->executor = [$this, 'get'];
        return $this;
    }

    /**
     * Use HTTP PUT method
     * @return Prest
     */
    public function viaPut ()
    {
        $this->executor = [$this, 'put'];
        return $this;
    }

    /**
     * Use HTTP PATCH method
     * @return Prest
     */
    public function viaPatch ()
    {
        $this->executor = [$this, 'patch'];
        return $this;
    }

    /**
     * Use HTTP HEAD method
     * @return Prest
     */
    public function viaHead ()
    {
        $this->executor = [$this, 'head'];
        return $this;
    }

    /**
     * Use HTTP DELETE method
     * @return Prest
     */
    public function viaDelete ()
    {
        $this->executor = [$this, 'delete'];
        return $this;
    }

    /**
     * Setup authentication
     * @param string $user
     * @param string $pass
     * @param string $auth  'basic' or 'digest'
     * @return Prest
     */
    public function withAuth ($user, $pass, $auth = 'basic')
    {
        $this->rest->setupAuth($user, $pass, $auth);
        return $this;
    }

    /**
     * Setup proxy
     * @param string $host
     * @param int $port
     * @param string $user Optional.
     * @param string $pass Optional.
     * @return Prest
     */
    public function withProxy ($host, $port, $user = NULL, $pass = NULL)
    {
        $this->rest->setupProxy($host, $port, $user, $pass);
        return $this;
    }

    /**
     * Set cURL options
     * @param  int $option
     * @param  mixed $value
     * @return Prest
     */
    public function curlOpts ($option, $value)
    {
        $this->rest->curl_opts[$option] = $value;
        return $this;
    }

    /**
     * Perform the request
     * @return Prest
     */
    public function execute ()
    {
        return call_user_func($this->executor);
    }

}