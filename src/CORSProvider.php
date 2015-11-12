<?php

namespace TH\Silex\CORS;

use Exception;
use Silex\Api\BootableProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use TH\Silex\CORS\CORSMiddleware;

class CORSProvider implements BootableProviderInterface, ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container["cors.origin"] = "*";
        $container["cors.methods"] = ["DELETE", "GET", "HEAD", "PATCH", "POST", "PUT"];
        $container["cors.headers"] = ["Authorization", "Content-Type"];
        $container["cors.middleware"] = function (Container $container) {
            return new CORSMiddleware(
                $container["cors.origin"],
                $container["cors.methods"],
                $container["cors.headers"]
            );
        };
        $container["cors.exception_handler"] = $container->protect(
            function (Exception $e, Request $request, $code) use ($container) {
                if ($e instanceof MethodNotAllowedHttpException && $request->getmethod() === Request::METHOD_OPTIONS) {
                    return $container["cors.middleware"](
                        $request,
                        new Response("", Response::HTTP_NO_CONTENT, ["X-Status-Code" => Response::HTTP_NO_CONTENT])
                    );
                }
            }
        );
    }

    public function boot(Application $app)
    {
        $app->after($app["cors.middleware"]);
        $app->error($app["cors.exception_handler"], 0);
    }
}
