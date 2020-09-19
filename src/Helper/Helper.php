<?php

namespace heinthanth\bare\Helper;

use Jenssegers\Blade\Blade;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;

function view(string $view, array $data = []): ResponseInterface
{
    $blade = new Blade(PROJECT_ROOT . "/app/Views", PROJECT_ROOT . "/storage/cache/views");
    $response = new HtmlResponse($blade->render($view, $data));
    return $response;
}