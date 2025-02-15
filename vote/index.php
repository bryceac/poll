<?php
include("../includes/functions.php");

$vote = $_GET["choice"];

$polls = retrieve_polls();

$current_poll = empty($polls) ? null : $polls[count($polls) -1];

$stored_answer = NULL;

if (isset($current_poll)) {
    foreach ($current_poll->answers as $answer) {
        if (str_contains(strtolower($vote), strtolower($answer->value))) {
            $stored_answer = $answer;
            break;
        }
    }

    if (isset($stored_answer)) {
        $stored_answer->votes += 1;
    }
} else {
    die("no poll found!");
}
?>