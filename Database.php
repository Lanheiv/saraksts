<?php
class Database {
    public $pdo;

    public function __construct($config) {
        $dsn = "mysql:" . http_build_query($config, "", ";");

        $this->pdo = new PDO($dsn);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    public function query($sql) {
        $state = $this->pdo->prepare($sql);
        $state->execute();

        return $state;
    }
}
?>