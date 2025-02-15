<?php
class DB {
    private $host = "../assets/polls.db";

    function connect() {
        $conn = new PDO("sqlite:realpath($host)");

        return $conn;
    }
}
?>