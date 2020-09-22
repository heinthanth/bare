<?php

namespace App\Models;

use heinthanth\bare\BaseClass\Model;
use Laminas\Diactoros\Response\RedirectResponse;

class User extends Model
{
    /**
     * table for User model
     */
    protected static string $table = 'users';

    public static function all()
    {
        return self::getDB()->query('SELECT * FROM ' . self::$table)->fetchAll();
    }

    public static function create($fname, $lname, $email)
    {
        $sql = "INSERT INTO users (firstname, lastname, email) VALUES (?, ?, ?)";
        $stmt = self::getDB()->prepare($sql);
        $stmt->execute([$fname, $lname, $email]);
        return new RedirectResponse('/users');
    }

    public static function details(int $id)
    {
        $stmt = self::getDB()->prepare('SELECT * FROM ' . self::$table . ' WHERE id=:id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
