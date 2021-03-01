<?php
	ini_set('display_errors', 'On');
	require_once "lib/lib.php";
	require_once "model/something.php";
	require_once "model/GuessGame.php";
	require_once "model/RockPaperScissors.php";
	require_once "model/FrogsGame.php";

	session_save_path("sess");
	session_start(); 

	$dbconn = db_connect();

	$errors=array();
	$view="";

	$pages = array();

	$activePage = "index.php";

	/* controller code */

	/* local actions, these are state transforms */
	if(!isset($_SESSION['state'])){
		$_SESSION['state']='login';
	}

	if (isset($_GET['operation'])) {
		if ($_GET['operation'] == 'register') {
    		$_SESSION['state']='register';
			$activePage = "register.php";
			$view="register.php";
		}
		elseif ($_GET['operation'] == 'guessGame') {
			$_SESSION['state']='guessGame';
			$activePage = "guessGame.php";
			$view="guessGame.php";
		}
		elseif ($_GET['operation'] == 'logout') {
    		$_SESSION['state']='login';
			$activePage = "login.php";
			$view="login.php";
			$_SESSION['user']="";
		}
		elseif ($_GET['operation'] == 'stats') {
    		$_SESSION['state']='stats';
			$activePage = "stats.php";
			$view="stats.php";
		}
		elseif ($_GET['operation'] == 'rps') {
    		$_SESSION['state']='rps';
			$activePage = "rps.php";
			$view="rps.php";
		}
		elseif ($_GET['operation'] == 'frogs') {
    		$_SESSION['state']='frogs';
			$activePage = "frogs.php";
			$view="frogs.php";
		}
		elseif ($_GET['operation'] == 'profile') {
    		$_SESSION['state']='profile';
			$activePage = "profile.php";
			$view="profile.php";
		}
  	}
	
	// the restart buttons for each respective game
	if(isset($_POST['restartGuess'])){
		$_SESSION['state']='wonGuess';
		$activePage="guessGame.php";
		$view="guessGame.php";
	} 
	if(isset($_POST['restartRPS'])){
		$_SESSION['state']='resetRPS';
		$activePage="rps.php";
		$view="rps.php";
	} 
	if(isset($_POST['restartFrogs']) || isset($_POST['restartFrogsDefault'])){
		$_SESSION['state']='resetFrogs';
		$activePage="frogs.php";
		$view="frogs.php";
	} 
	if(isset($_POST['registerButton'])){
		$_SESSION['state']='register';
		$activePage="register.php";
		$view="register.php";
	} 

	switch($_SESSION['state']){
		case "login":
			// the view we display by default
			$view="login.php";

			// check if submit or not
			if(empty($_REQUEST['submitLogin']) || $_REQUEST['submitLogin']!="login"){
				break;
			}

			// validate and set errors
			$errors=verifyLoginFields();
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			if (!checkDbConn($dbconn, $errors)) {
				break;
			}

			if ($validLogin = validateCorrectLogin($_REQUEST['user'], $_REQUEST['password'], $dbconn)) {
				$_SESSION['user']=$_REQUEST['user'];
				$_SESSION['GuessGame']=new GuessGame(); $_SESSION['GuessGameGuesses']=0; $_SESSION['GuessGameWins']=0;
				$_SESSION['RockPaperScissors']=new RockPaperScissors(); $_SESSION['RPSPlays']=0; $_SESSION['RPSWins']=0;
				$_SESSION['FrogsGame']=new FrogsGame(); $_SESSION['FrogsMoves']=0; $_SESSION['FrogsWins']=0;
				$row = initializeValues($_SESSION['user'], $dbconn);
				$_SESSION['globalRPSWins']=($row['rpswins']);
				$_SESSION['globalFrogsWins']=($row['frogswins']);
				$_SESSION['globalGuessWins']=($row['guesswins']);
				$_SESSION['email']=($row['email']);
				$_SESSION['dateOfBirth']=($row['dateofbirth']);
				$_SESSION['gender']=($row['gender']);

				getTopThree($dbconn);

				$_SESSION['state']='stats'; // initially load into stats page
				$view="stats.php";
				$activePage="stats.php";
			} else {
				$errors[]="invalid login";
			}
			break;

		case "register":
			$_SESSION['registerSuccess']=false;
			$view="register.php";

			// check if register submitted or not
			if(empty($_REQUEST['submitRegister']) || $_REQUEST['submitRegister']!="register"){
				break;
			}

			$errors=verifyRegisterFields();
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}

			if ($userExists = userAlreadyExists($dbconn, $errors)) {
				$_SESSION['registerSuccess']=false;
				break;
			} else {
				registerNewUser($_REQUEST['userRegister'], $_REQUEST['passwordRegister'], $_REQUEST['email'], $_REQUEST['dateOfBirth'], $_REQUEST['genders'], $dbconn);
				$_SESSION['registerSuccess']=true;
				$_SESSION['state']="login";
				$view="login.php";
			}

			break;

		case "stats":
			$view="stats.php";
			$activePage="stats.php";
			$_SESSION['state']='stats';

			$row = getStatsRow($_SESSION['user'], $dbconn);
			$_SESSION['globalRPSWins']=($row['rpswins']);
			$_SESSION['globalFrogsWins']=($row['frogswins']);
			$_SESSION['globalGuessWins']=($row['guesswins']);
			break;

		case "rps":
			$view="rps.php";
			$activePage="rps.php";
			$_SESSION['state']='rps';
			
			if(isset($_POST['rock'])) {
				$_SESSION['RockPaperScissors']->playRPS('rock');
			}
			if(isset($_POST['paper'])) {
				$_SESSION['RockPaperScissors']->playRPS('paper');
			}
			if(isset($_POST['scissors'])) {
				$_SESSION['RockPaperScissors']->playRPS('scissors');
			}

			updateRPSWins($_SESSION['user'], $dbconn);
			
			break;

		case "resetRPS":
			$view="rps.php";

			if(!empty($errors))break;
	
	
			// perform operation, switching state and view if necessary
			$_SESSION["RockPaperScissors"]->resetGame();
			$_SESSION['state']="rps";
			$view="rps.php";
			$activePage="rps.php";

			break;

		case "frogs":
			$_SESSION["resetFrogs"]=false;
			$view="frogs.php";
			$activePage="frogs.php";
			$_SESSION['state']='frogs';
			if(isset($_POST['frogs1'])) {
				$_SESSION['FrogsGame']->clickSquare(0);
			}
			if(isset($_POST['frogs2'])) {
				$_SESSION['FrogsGame']->clickSquare(1);
			}
			if(isset($_POST['frogs3'])) {
				$_SESSION['FrogsGame']->clickSquare(2);
			}
			if(isset($_POST['frogs4'])) {
				$_SESSION['FrogsGame']->clickSquare(3);
			}
			if(isset($_POST['frogs5'])) {
				$_SESSION['FrogsGame']->clickSquare(4);
			}
			if(isset($_POST['frogs6'])) {
				$_SESSION['FrogsGame']->clickSquare(5);
			}
			if(isset($_POST['frogs7'])) {
				$_SESSION['FrogsGame']->clickSquare(6);
			}
			updateFrogsWins($_SESSION['user'], $dbconn);
			break;

		case "resetFrogs":
			$view="frogs.php";
			if(!empty($errors))break;
	
			// perform operation, switching state and view if necessary
			$_SESSION["FrogsGame"]->resetBoard();

			$_SESSION['state']="frogs";
			$view="frogs.php";
			$activePage="frogs.php";

			break;

		case "profile":
			$_SESSION['updateSuccess']=false;
			$view="profile.php";
			$activePage="profile.php";

			if(empty($_REQUEST['submitUpdate']) || $_REQUEST['submitUpdate']!="update"){
				break;
			}

			$errors = validateProfileForms();
			if(!empty($errors))break;

			submitUpdate($_REQUEST['passwordUpdate'],  $_REQUEST['emailUpdate'], $_REQUEST['dateOfBirthUpdate'], $_REQUEST['gendersUpdate'], $_SESSION['user'], $dbconn);			
			$_SESSION['updateSuccess']=true;

			break;

		case "unavailable":
			$view="unavailable.php";
			$activePage="unavailable.php";
			$_SESSION['state']='unavailable';
			break;

		case "guessGame":
			$_SESSION['state']='guessGame';
			// the view we display by default
			$view="guessGame.php";
			$activePage="guessGame.php";
	
			// check if submit or not
			if(empty($_REQUEST['submit'])||$_REQUEST['submit']!="guess"){
				break;
			}
	
			// validate and set errors
			if(!is_numeric($_REQUEST["guess"]))$errors[]="Guess must be numeric.";
			if(!empty($errors))break;
	
			// perform operation, switching state and view if necessary
			$_SESSION["GuessGame"]->makeGuess($_REQUEST['guess']);
			if($_SESSION["GuessGame"]->getState()=="correct"){
				$_SESSION['state']="wonGuess";
				$view="guessGame.php";
				$activePage="guessGame.php";
				updateGuessWins($_SESSION['user'], $dbconn);
			}
			$_REQUEST['guess']="";
	
			break;
	
		case "wonGuess":
			// the view we display by default
			$view="guessGame.php";

			// check if submit or not
			if(empty($_REQUEST['restartGuess'])||$_REQUEST['restartGuess']!="start again"){
				$errors[]="Invalid request";
				$view="guessGame.php";
				$activePage="guessGame.php";
			}
	
			// validate and set errors
			if(!empty($errors))break;
	
	
			// perform operation, switching state and view if necessary
			$_SESSION["GuessGame"]=new GuessGame();
			$_SESSION['state']="guessGame";
			$view="guessGame.php";
			$activePage="guessGame.php";

			break;
	}
	require_once "view/$view";
?>
