<?php
include("functions.php");

$vote = $_GET["choice"];

$polls = retrieve_polls();

$current_poll = empty($polls) ? null : $polls[count($polls) -1];

if (isset($current_poll)) {
    
} else {
    die("no poll found!");
}
?>