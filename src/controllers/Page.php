<?php


class Page
{
    private static $page;
    private static $page_list = [
        'home' => __DIR__ . '/../views/home.php',
        'wiki' => __DIR__ . '/../views/wiki.php',
        'history' => __DIR__ . '/../views/history.php'

    ];
    public static function setPage($page)
    {
        self::$page = $page;
    }

    public static function getContent()
    {
        if(array_key_exists(self::$page, self::$page_list)){
            return [
                'page' => true,
                'path' => self::$page_list[self::$page]
            ];
        }else {
            return [
                'page' => false,
                'path' => __DIR__ . '/../views/err.php'

            ];
        }
    }
}