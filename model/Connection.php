<?php

class ConnectionClass
{
    public static function conn()
    {
        $connection = new mysqli("localhost", "root", "", "MEDIA_COURSE");
        return $connection;
    }
}
