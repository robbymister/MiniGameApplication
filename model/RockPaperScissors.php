<?php

class RockPaperScissors {
	public $history = array();
	public $state = "";
    public $numPlayed = 0;

	public function __construct() {
        	$this->decision = rand(0,2);
            $this->endedGame=false;
    	} // 0 for rock, 1 for paper, 2 for scissors
	
	public function playRPS($play){
        $_SESSION['RPSPlays']++;
        $this->numPlayed++;
		if($play=="rock"){
            if ($this->decision == 0) {
                $this->state="draw";
            }
            elseif ($this->decision == 1) {
                $this->state="loss";
            }
            elseif ($this->decision == 2) {
                $this->state="win";
            }
		}
        elseif($play=="paper"){
            if ($this->decision == 0) {
                $this->state="win";
            }
            elseif ($this->decision == 1) {
                $this->state="draw";
            }
            elseif ($this->decision == 2) {
                $this->state="loss";
            }
		} 
        elseif($play=="scissors"){
            if ($this->decision == 0) {
                $this->state="loss";
            }
            elseif ($this->decision == 1) {
                $this->state="win";
            }
            elseif ($this->decision == 2) {
                $this->state="draw";
            }
		} 
        if ($this->state == "win") {
            $_SESSION['RPSWins']++;
        }
        $this->endedGame=true;
		$this->history[] = "Play #$this->numPlayed was $play and was a $this->state.";
	}

	public function getState(){
		return $this->state;
	}

    public function resetGame(){
        $this->endedGame=false;
        $this->decision=rand(0,2);
    }
}
?>
