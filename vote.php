<?php
include("functions.php");

$vote = $_GET["choice"];

$polls = retrieve_polls();

$current_poll = empty($polls) ? null : $polls[count($polls) -1];

if (isset($current_poll)) {
    foreach ($current_poll->answers as $answer) {
        if (str_contains(strtolower($vote), strtolower($answer->value))) {
            $answer->value += 1;
            break;
        }
    }
} else {
    die("no poll found!");
}
?>