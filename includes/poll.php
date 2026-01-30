<?php
class Poll {
    public $id;
    public $question;
    public $answers;
    public $is_open;

    function __construct($array = []) {
        if (empty($array)) {
            $this->id = 0;
            $this->question = "";
            $this->answers = [];
            $this->is_open = true;
        } else {
            $this->id = $array["id"];
            $this->question = $array["question"];
            $this->answers = [];
            $this->is_open = strcasecmp($array["open"], "Y") == 0 ? true : false;
        }
    }

    function total_votes() {
        $votes = 0;

        if (!empty($this->answers)) {
            foreach($this->answers as $answer) {
                $votes += $answer->votes;
            }
        }

        return $votes;
    }
}
?>