<?php
include("answer.php");
include("poll.php");

class DB {
    private $host = "assets/polls.db";

    function connect() {
        $db_path = dirname(__DIR__, 1) . "/$this->host";

        $conn = new PDO("sqlite:$db_path");

        return $conn;
    }

    function retrieve_answers_for_poll($poll_id) {
        $answers = [];
    
        $conn = $this->connect();
        $query = "select id, poll_id, answer, votes FROM answers WHERE poll_id = ?";
        $statement = $conn->prepare($query);
        $statement->execute([$poll_id]);
    
        $results = $statement->fetchAll();
    
        foreach($results as $row) {
            $answer = new Answer($row);
    
            $answers[] = $answer;
        }
    
        return $answers;
    }
    
    function retrieve_polls() {
        $polls = [];
        
        $conn = $this->connect();
        $query = "select id, question FROM polls";
        foreach ($conn->query($query) as $row) {
            $poll = new Poll($row);
    
            $poll->answers = $this->retrieve_answers_for_poll($poll->id);
    
            $polls[] = $poll;
        }
        
        return $polls;
    }
    
    function current_poll() {
        $poll = null;
    
        $polls = $this->retrieve_polls();
    
        if (!empty($polls)) {
            $poll = $polls[count($polls) -1];
        }
    
        return $poll;
    }
    
    function retrieve_poll_with_id($id) {
        $polls = $this->retrieve_polls();
    
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
        $conn = $this->connect();
        $polls = $this->retrieve_polls();
        $latest_poll = $this->current_poll();
    
        $query = "insert into answers (poll_id, answer, votes) values (?, ?, ?)";
        $statement = $conn->prepare($query);
    
        $statement->execute([$latest_poll->id, $answer->value, $answer->votes]);
    }
    
    function add_poll_to_store($poll) {
        global $db;
        $conn = $this->connect();
    
        $query = "insert into polls (question) values (?)";
    
        $statement = $conn->prepare($query);
    
        $statement->execute([$poll->question]);
    
        foreach($poll->answers as $answer) {
            $this->add_answer_to_store($answer);
        }
    }
    
    function update_vote_in_database($answer) {
        $conn = $this->connect();
        $query = "update answers set votes = ? WHERE id = ?";
    
        $statement = $conn->prepare($query);
    
        $statement->execute([$answer->votes, $answer->id]);
    }
}
?>