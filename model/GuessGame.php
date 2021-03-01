<?php

class GuessGame {
	public $secretNumber = 5;
	public $numGuesses = 0;
	public $history = array();
	public $state = "";

	public function __construct() {
        	$this->secretNumber = rand(1,10);
    	}
	
	public function makeGuess($guess){
		$this->numGuesses++;
		$_SESSION['GuessGameGuesses']++;
		if($guess>$this->secretNumber){
			$this->state="too high";
		} else if($guess<$this->secretNumber){
			$this->state="too low";
		} else {
			$_SESSION['GuessGameWins']++;
			$this->state="correct";
		}
		$this->history[] = "Guess #$this->numGuesses was $guess and was $this->state.";
	}

	public function getState(){
		return $this->state;
	}
}
?>
