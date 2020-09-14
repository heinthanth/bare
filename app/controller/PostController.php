<?php

namespace App\Controller;

class PostController
{
    public function __invoke($param)
    {
        return "Hello, post {$param['variables']['id']}";
    }
}
