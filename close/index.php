<?php
include(dirname(__DIR__, 1) . "/includes/db.php");

$db = new DB();

$current_poll = isset($_GET["id"]) ? $db->retrieve_poll_with_id($_GET["id"]) : $db->current_poll();

if ($current_poll->is_open) {
    $db->close_poll($current_poll);

    echo("Poll successfully closed!");
} else {
    die("Poll is already closed.");
}
?>