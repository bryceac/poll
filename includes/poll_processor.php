<?php
include("db.php");

$db = new DB();

$question = $_POST["question"];
$options = $_POST["answers"];
$poll = new Poll();

function answers_from($input) {
    $answers = [];

    $input_array = preg_split("/\r\n|\n|\r/", $input);

    foreach ($input_array as $response) {
        $answer = new Answer();

        $answer->value = $response;
        $answers[] = $answer;
    }


    return $answers;
}

$poll->question = $question;
$poll->answers = answers_from($options);

$db->add_poll_to_store($poll);

echo("Poll created successfully.");
?>