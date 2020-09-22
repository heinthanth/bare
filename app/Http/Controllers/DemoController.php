<?php

namespace App\Http\Controllers;

use Laminas\Diactoros\Response\TextResponse;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\HtmlResponse;

class DemoController
{
    public function index(): ResponseInterface
    {
        return new TextResponse('Won\'t execute!');
    }

    public function test(array $vars)
    {
        return new HtmlResponse('<pre>' . print_r($vars, true) . '</pre>');
    }
}
