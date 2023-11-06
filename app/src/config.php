<?php

class Config{
    private $dbSettings;
    private $errorSettings;

    public function __construct(){
        $this->dbSettings = [
            'dbname' => 'slimphp',
            'user' => 'root',
            'password' => 'password',
            'host' => '192.168.1.3',
            'driver' => 'pdo_mysql'
        ];
    }

    public function getConfig(){
        return $this->dbSettings;
    }
    
    public function getErrorSettings() {
        return $this->errorSettings;
    }

}