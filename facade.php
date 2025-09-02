<?php

class facade extends model{
    public static function __callstatic($method , $argc){
        return (new static) -> $method($argc);
    }
    public function __call($method , $argc){
        return $this -> $method($argc);
    }
}