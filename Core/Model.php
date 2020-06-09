<?php

namespace Core;

use PDO;
use PDOException;
use Config\Database;

abstract class Model
{
    /**
     * Get the PDO database connection
     * 
     * @return mixed
     */
    public static function getDB()
    {
        static $db = null;
        if ($db === null) {
            $host = Database::DB_HOST;
            $user = Database::DB_USER;
            $passwd = Database::DB_PASS;
            $dbname = Database::DB_NAME;

            try {
                $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $passwd);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return $db;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}
