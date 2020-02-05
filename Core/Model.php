<?php

namespace Core;
use PDO;
use PostgreSQLTutorial\Connection as Connection;

class Model {

    protected $pdo;

    public function __construct(){

        
        global $config;
        
        
 
        try {
            $this->pdo = Connection::get()->connect();
            

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}