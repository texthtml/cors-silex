<?php

namespace TH\Silex\CORS;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CORSMiddleware
{
    private $origin;
    private $methods;
    private $headers;

    /**
     * @param string   $origin  orgin domain
     * @param string[] $methods methods
     * @param string[] $headers headers
     */
    public function __construct($origin, Array $methods, Array $headers)
    {
        $this->origin  = $origin;
        $this->methods = implode(', ', $methods);
        $this->headers = implode(', ', $headers);
    }

    public function __invoke(Request $request, Response $response)
    {
        $response->headers->set('Access-Control-Allow-Origin', $this->origin);
        $response->headers->set('Access-Control-Allow-Methods', $this->methods);
        $response->headers->set('Access-Control-Allow-Headers', $this->headers);
        return $response;
    }
}
