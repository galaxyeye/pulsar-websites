<?php 
// for built-in proxy server

require dirname(__DIR__) . '/config/bootstrap.php';

use Proxy\Proxy;
use Proxy\Adapter\Guzzle\GuzzleAdapter;
use Proxy\Response\Filter\RemoveEncodingFilter;

// Create a PSR7 request based on the current browser request.
$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

// Create a guzzle client
$client = new GuzzleHttp\Client();

// Create the proxy instance
$proxy = new Proxy(new GuzzleAdapter($client));

// Add a response filter that removes the encoding headers.
$proxy->addRequestFilter(new RemoveEncodingFilter());

// Forward the request and get the response.
$response = $proxy->forward($request)->to('http://master:50070' . $request->getPathInfo());

// Output response to the browser.
$response->send();
