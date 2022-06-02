<?php

class Manager
{
    public static $instance;
    private $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO("sqlite:".__DIR__."/ideabox.db");
        $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function db(){
        return $this->pdo;
    }

    public static function getInstance() : Manager{
        if(!isset(Manager::$instance)) Manager::$instance = new Manager;
        return Manager::$instance;
    }

}