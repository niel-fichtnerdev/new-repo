<?php

class Dbh{
    private $host = "sql109.infinityfree.com";
    private $user = "if0_34899882";
    private $pwd = "mDPT7uGvO6ZVd";
    private $dbName = "if0_34899882_demo_syspos";

    protected function connect(){
        // Add the colon (:) and equal sign (=) in the DSN string
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}

