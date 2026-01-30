<?php
include(dirname(__DIR__, 1) . "/includes/db.php");

$db = new DB();

$current_poll = isset($_GET["id"]) ? $db->retrieve_poll_with_id($_GET["id"]) : $db->current_poll();


?>