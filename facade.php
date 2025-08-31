<?php

// class Facade{
//     public static function __callstatic($method ,$args){
//         echo"this is method[[[callstatic _____$method</br>";
//         var_dump($args);
//         echo"</br>";
//         return (new static) -> $method($args);
//     }

//     public function __call($method , $args){
//         echo "this is method[[[call ________$method</br>";
//         var_dump($args);
//         echo"</br>";
//         $this -> $method($args);
//         return $this ;
//     }
// }

// class product extends Facade{
//     protected function select(){
//         echo"this is product select </br>";
//         return $this ;
//     }
//     protected function where(){
//         echo"this is product where </br>";
//         return $this ;
//     }
// }
// product :: select("amir" , "rahmati") -> where();


class facade extends model{
    public static function __callstatic($method , $argc){
        // var_dump($argc);
        return (new static) -> $method($argc);
    }
    public function __call($method , $argc){
        return $this -> $method($argc);
        // return $this ;
    }
}