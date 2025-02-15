<?php
include("../includes/functions.php");

$vote = $_GET["choice"];

$current_poll = current_poll();

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

        update_vote_in_database($stored_answer);

        echo("Thanks for voting!");
    } else {
        die("choice was not valid!");
    }
} else {
    die("no poll found!");
}
?>