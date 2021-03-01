<?php

class FrogsGame {
	public $board = array();
	public $imgChoices = array();


	public function __construct() {
        	$this->board = [1,1,1,0,-1,-1,-1];
			$this->imgChoices = ["./images/empty.png", "./images/greenFrog.png", "./images/yellowFrog.png"];
    	}

	public function getState(){
		return $this->state;
	}

	public function clickSquare($index) {
		$_SESSION['FrogsMoves']++;
		if ($this->move($index, $index+$this->board[$index])) {
			return;
		}
		$this->move($index, $index + 2*$this->board[$index]);
	}
	
	public function isEmpty($index){
		if ($index < 0 || $index > 6) {
			return false;
		}
		if ($this->board[$index] == 0) {
			return true;
		} else {
			return false;
		}
	}

	public function move($start, $end) {
		if ($this->isEmpty($end)) {
			$value = $this->board[$start];
			$this->board[$end]=$value;
			$this->board[$start]=0;
			return true;
		} else {
			return false;
		}
	}

	public function checkImg($index) {
		return $this->board[$index];
	}

	public function isWon() {
		if ($this->board == [-1,-1,-1,0,1,1,1]) {
			$_SESSION['FrogsWins']++;
			return true;
		}
		else {
			return false;
		}
	}

	public function resetBoard() {
		$this->board = [1,1,1,0,-1,-1,-1];
	}
}
?>