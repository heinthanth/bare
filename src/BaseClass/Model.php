<?php

namespace heinthanth\bare\BaseClass;

use PDO;

abstract class Model
{
    protected static string $table;

    /**
     * create PDO instance
     * @return \PDO
     */
    protected static function getDB()
    {
        $host = env('DATABASE_HOST', '127.0.0.1');
        $user = env('DATABASE_USER', 'root');
        $pass = env('DATABASE_PASS', 'root');
        $dbname = env('DATABASE_NAME', '');
        $dsn = "mysql:host=$host;dbname=$dbname;";

        $db = new PDO($dsn, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
}
