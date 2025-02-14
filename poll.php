<?php
class Poll {
    public $id;
    public $question;
    public $answers;

    function __construct($array = []) {
        if (empty($array)) {
            $this->id = 0;
            $this->question = "";
            $this->answers = [];
        } else {
            $this->id = $array["id"];
            $this->question = $array["question"];
            $this->answers = [];
        }
    }

    function total_votes() {
        $votes = 0;

        if (!empty($this->answers)) {
            foreach($answers as $answer) {
                $votes += $answer->votes;
            }
        }

        return $votes;
    }
}
?>