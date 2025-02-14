<?php
include("poll.php");
include("answer.php");

$host_file = "polls.db";

function retrieve_answers_for_poll($poll_id) {
    $answers = [];

    $conn = new PDO($host_file);
    $query = "select id, poll_id, answer, votes FROM answers WHERE poll_id = $poll_id";

    foreach($conn->query as $row) {
        $answer = new Answer($row);

        $answers[] = $answer;
    }
    $conn = NULL;

    return $answers;
}

function retrieve_polls() {
    $polls = [];
    
    $conn = new PDO($host_file);
    $query = "select id, question FROM polls";
    foreach ($conn->query($query) as $row) {
        $poll = Poll($row);

        $poll->answers = retrieve_answers_for_poll($poll->id);

        $polls[] = $poll;
    }
    $conn = NULL;
    
    return $polls;
}
?>