<?php

require_once("config.php");

class Db{
    public static $pdo;

    static function connection() {

        try{
            self::$pdo = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USERT, DB_PASS);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        return self::$pdo;
    }

    static function prepareOwn($sql) {
        return self::connection()->prepare($sql);
    }

}