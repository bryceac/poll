<?php
include("poll.php");
include("answer.php");

$host_file = "../assets/polls.db";

function retrieve_answers_for_poll($poll_id) {
    $answers = [];

    $conn = new PDO($host_file);
    $query = "select id, poll_id, answer, votes FROM answers WHERE poll_id = ?";
    $statement = $conn->prepare($query);
    $statement->execute([$poll_id]);

    $results = $statement->fetchAll();

    foreach($results as $row) {
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

function current_poll() {
    $poll = null;

    $polls = retrieve_polls();

    if (!empty($polls)) {
        $poll = $polls[count(polls) -1];
    }

    return $poll;
}

function poll_with_id($id) {
    $polls = retrieve_polls();

    $poll = null;

    foreach ($polls as $stored_poll) {
        if ($stored_poll === $id) {
            $poll = $stored_poll;
            break;
        }
    }

    return $poll;
}

function add_answer_to_store($answer) {
    $conn = new PDO($host_file);
    $polls = retrieve_polls();
    $latest_poll = current_poll();

    $query = "insert into answers (poll_id, answer, votes)";
    $statement = $conn->prepare($query);

    $statement->execute([$latest_poll->id, $answer->value, $answer->votes]);
    $conn = null;
}

function add_poll_to_store($poll) {
    $conn = new PDO($host_file);

    $query = "insert into polls (question) values (?)";

    $statement = $conn->prepare($query);

    $statement->execute([$poll->question]);

    $conn = null;

    foreach($poll->answers as $answer) {
        add_answer_to_store($answer);
    }
}

function update_vote_in_database($answer) {
    $conn = new PDO($host_file);
    $query = "update answers set votes = ? WHERE id = ?";

    $statement = $conn->prepare($query);

    $statement->execute([$answer->vote, $answer->id]);
    $conn = null;
}