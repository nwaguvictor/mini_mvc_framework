<?php

namespace App\Models;

use Core\Model;

class Post extends Model
{
    /**
     * Get all post as an associative array
     * 
     * @return Array - the data
     */
    public static function getAll()
    {
        $conn = static::getDB();

        $stmt = $conn->query("SELECT * FROM posts");
        $results = $stmt->fetchAll();
        return $results;
    }
}
