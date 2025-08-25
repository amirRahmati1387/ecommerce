<?php

// class factory{
//     public static $instance = [];
//     public static function factory($className){
//         if (!in_array($className, self::$instance)) {
//             self::$instance[$className] = new $className;
//         }
//         return self::$instance[$className];
//     }
// }


class factory{
    public static $instance = [];
    public static function factory($className){
        if (!isset(self::$instance[$className])) {
            self::$instance[$className] = new $className;
        }
        return self::$instance[$className];
    }
}