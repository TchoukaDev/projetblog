<?php

abstract class PdoModel
{
    public static $db;
    protected function setdb()
    {
        try {
            if (self::$db === null) {
                self::$db = new PDO('mysql:host=localhost; dbname=blog; charset=utf8', 'root', '');
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$db;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
