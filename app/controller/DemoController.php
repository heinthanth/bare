<?php

namespace App\Controller;

class DemoController
{
    public static function hello()
    {
        return "Hello, World!";
    }

    public function deletePost($param)
    {
        return "Deleted post id: {$param['variables']['id']} with uid: {$param['queries']['uid']}";
    }
}
