<?php

namespace App\Http\Controllers;

use Laminas\Diactoros\Response\HtmlResponse;

class DemoController
{
    public function index()
    {
        return new HtmlResponse('<h1>Well, well</h1>');
    }
}
