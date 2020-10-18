<?php

class DataBase
{
    public static function getConnection()
    {
        $envPath = realpath(dirname(__FILE__, 2) . "/env.ini");
        $env = parse_ini_file($envPath);
        $connect = new mysqli(
            $env['host'], $env['user'],
            $env['password'], $env['db']

        );
        if($connect->connect_error){
            die("Err: ". $connect->connect_error);
        }

        return $connect;
    }
}

