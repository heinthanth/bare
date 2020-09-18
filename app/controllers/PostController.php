<?php

namespace App\Controllers;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PostController
{
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $res = new Response();
        $res->getBody()->write('List all Post');
        return $res;
    }

    public function update(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $res = new Response();
        $res->getBody()->write("Update post id: {$args['id']}");
        return $res;
    }
}
