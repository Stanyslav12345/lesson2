<?php

namespace App;

class Config{
    static private $config;
    public array $data;

    private function __clone(){}

    private function __construct(){
        $this->data = [
            'db' => [
                'host' => 'localhost',
                'dbname' => 'php2lesson1',
                'user' => 'root',
                'password' => ''
            ]
        ];
    }

    static public function getConfig():Config{
        if(self::$config instanceof self){
            return self::$config;
        }

        self::$config = new self;

        return self::$config;
    }




}