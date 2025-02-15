<?php
class Answer {
    public $id;
    public $poll_id;
    public $value;
    public $votes;

    function __construct($array = []) {
        if (empty($array)) {
            $id = 0;
            $poll_id = 0;
            $value = "";
            $votes = 0;
        } else {
            $this->id = $array["id"];
            $this->poll_id = $array["poll_id"];
            $this->value = $array["answer"];
            $this->votes = $array["votes"];
        }
    }
}
?>