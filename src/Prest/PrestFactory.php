<?php

/**
 * Prest - A REST client for PHP based on Pest
 *
 * @author      Armand Zangue <armand@zangue.com>
 * @copyright   (C) 2016 Armand Zangue
 * @link        https://github.com/zangue/prest
 * @version     1.0.0
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

use Prest\Prest;

class PrestFactory {

	/**
	 * The server /service base URL
	 * @var string
	 */
	protected $baseUrl;

	/**
	 * Class contructor
	 * @param string $baseUrl The default base URL
	 */
	public function __construct ($baseUrl)
	{
		$this->baseUrl = $baseUrl;
	}

	/**
	 * Create a Prest object
	 * @param  string $type    PEST PHP type
	 * @param  string $baseUrl optional base URL
	 * @return Prest
	 */
	protected function createPrest ($type, $baseUrl = NULL)
	{
		return new Prest($type, $baseUrl ? $baseUrl : $this->baseUrl);
	}

	public function create ($baseUrl = NULL)
	{
		return $this->createPrest('default', $baseUrl);
	}

	public function createJSON ($baseUrl = NULL)
	{
		return $this->createPrest('json', $baseUrl);
	}

	public function createXML ($baseUrl = NULL)
	{
		return $this->createPrest('xml', $baseUrl);
	}

}