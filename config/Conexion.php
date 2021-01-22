<?php

class Conexion{
    static private $db;
    const DSN = 'mysql:host=127.0.0.1;dbname=tienda_master';
    const USER = 'root';
    const PASSWORD = '';
    const CHARSET = 'utf8';
    /**
     * @return PDO
     */
    static function getConnection()
    {
        // si aun no esta creado mi objeto PDO
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(
                    self::DSN,
                    self::USER,
                    self::PASSWORD,
                    [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . self::CHARSET]
                );
            } catch (Exception $e) {
                echo $e->getMessage();
//                var_dump(self::$db);
            }
        }
        return self::$db;
    }

    static function getStatement($sql)
    {
        return self::getConnection()->prepare($sql);
//        $db = self::getConnection();
//        return $db->prepare($sql);
    }
}