<?php

namespace App\Core;

class Model {
    private static $instance;

    public static function getConn(): \PDO
    {
        if(!isset(self::$instance)) {
            self::$instance = new \PDO('mysql:host=localhost;dbname=projeto;charset=utf-8',
                'root', '');
        }

        return self::$instance;
    }
}