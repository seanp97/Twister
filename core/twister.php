<?php

class Twister {
    public $pdo;

    public $queryBuilder;

    function __construct() {
        $this->Connect();
    }
  
    function Connect() {
        $host = Configuration::$connection["servername"];
        $user = Configuration::$connection["username"];
        $pass = Configuration::$connection["password"];
        $db = Configuration::$connection["database"];
  
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
  
    function query($query, $params = null) {
        if(!$params) {
          $stmt = $this->pdo->query($query);
          return $stmt;
        }
        else {
          $stmt = $this->pdo->prepare($query);
          $stmt->execute($params);
          return $stmt;
      }
    }
  
    function stored_proc($sp, $params = null) {
      if(!$params) {
        $stmt = $this->pdo->prepare("CALL $sp");
        $stmt->execute();
        return $stmt;
      }
  
      else {
        $stmt = $this->pdo->prepare("CALL $sp($params)");
        $stmt->bindParam(':param1', $params, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
      }
    }

}