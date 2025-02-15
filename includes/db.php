<?php
include("answer.php");
include("poll.php");

class DB {
    private $host = "../assets/polls.db";

    function connect() {
        $conn = new PDO("sqlite:realpath($host)");

        return $conn;
    }
}
?>