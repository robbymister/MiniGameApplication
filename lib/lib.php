<?php
	require_once "dbconnect_string.php";
        function db_connect(){
                global $g_dbconnect_string;
                $dbconn = pg_connect($g_dbconnect_string);
                if(!$dbconn){
			$system_errors[] = "Can't connect to the database.";
			return null;
		} else return $dbconn;
        }

	// return the errors in a standard format
        function view_errors($e){
                $s="";
                foreach($e as $key=>$value){
                        $s .= "<br/> $value";
                }
                return $s;
        }

        // global helpers
        function checkDbConn($dbconn, $errors) {
                if(!$dbconn){
                        $errors[]="Can't connect to db";
                        return false;
                } else {
                        return true;
                }
        }

        // helpers for login
        function verifyLoginFields() {
                $errors = array();
                if(empty($_REQUEST['user']))$errors[]='user is required';
		if(empty($_REQUEST['password']))$errors[]='password is required';
                return $errors;
        }

        function validateCorrectLogin($username, $password, $dbconn) {
                $query = "SELECT * FROM appuser WHERE userid=$1 and password=$2;";
                $result = pg_prepare($dbconn, "", $query);
                $result = pg_execute($dbconn, "", array($_REQUEST['user'], $_REQUEST['password']));
                if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
                        return true;
                } else {
                        return false;
                }
        }

        function initializeValues($username, $dbconn) {
                $query = "SELECT * FROM appuser WHERE userid=$1;";
		$result = pg_prepare($dbconn, "", $query);
		$result = pg_execute($dbconn, "", array($username));
                $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
                return $row;
        }

        // helpers for register case
        function verifyRegisterFields(){
                $errors = array();
                if(empty($_REQUEST['userRegister']))$errors[]='user is required';
		if(empty($_REQUEST['passwordRegister']))$errors[]='password is required';
		if(empty($_REQUEST['passwordConfirm']))$errors[]='password confirmation is required';
		if ($_REQUEST['passwordRegister'] != $_REQUEST['passwordConfirm'])$errors[]='passwords do not match';
		if(empty($_REQUEST['email']))$errors[]='email is required';
		if(empty($_REQUEST['dateOfBirth']))$errors[]='date of birth is required';
		if(empty($_REQUEST['genders']))$errors[]='gender is required';
                return $errors;
        }

        function userAlreadyExists($dbconn, $errors) {
                $userQuery = "SELECT * FROM appuser WHERE userid=$1";
                $userResult = pg_prepare($dbconn, "", $userQuery);
                $userResult = pg_execute($dbconn, "", array($_REQUEST['userRegister']));
                if ($row = pg_fetch_array($userResult, NULL, PGSQL_ASSOC)) {
                        $errors[]='user already exists';
                        return true;
                } else {
                        return false;
                }
        }

        function getTopThree($dbconn) {
                $query="SELECT userid FROM appuser ORDER BY rpswins+frogswins+guesswins DESC LIMIT 3;";
		$userResult = pg_prepare($dbconn, "", $query);
                $userResult = pg_execute($dbconn, "", array());
		$row1 = pg_fetch_array($userResult, 0, PGSQL_ASSOC);
		$row2 = pg_fetch_array($userResult, 1, PGSQL_ASSOC);
		$row3 = pg_fetch_array($userResult, 2, PGSQL_ASSOC);
		$_SESSION['firstUser']=$row1['userid'];
	        $_SESSION['secondUser']=$row2['userid'];
		$_SESSION['thirdUser']=$row3['userid'];
        }

        function registerNewUser($username, $password, $email, $dateofbirth, $gender, $dbconn) {
                $query = "INSERT INTO appuser values($1, $2, $3, $4, $5, $6, $7, $8);";
                $result = pg_prepare($dbconn, "", $query);
		$result = pg_execute($dbconn, "", array($username, $password,  $email, $dateofbirth, $gender, 0, 0, 0));
        }

        // helper for stats 
        function getStatsRow($username, $dbconn) {
                $query = "SELECT rpswins, frogswins, guesswins FROM appuser WHERE userid=$1;";
		$result = pg_prepare($dbconn, "", $query);
		$result = pg_execute($dbconn, "", array($_SESSION['user']));
                $row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
                return $row;
        }

        // helpers for RPS
        function getPlay() {
                if(isset($_POST['rock'])) {
                        return 'rock';
                }
                if(isset($_POST['paper'])) {
                        return 'paper';
                }
                if(isset($_POST['scissors'])) {
                        return 'scissors';
                }
        }

        function updateRPSWins($username, $dbconn) {
                if ($_SESSION['RockPaperScissors']->getState()=="win") {
                        $query = "UPDATE appuser SET rpsWins=rpsWins+1 WHERE userid=$1;";
                        $result = pg_prepare($dbconn, "", $query);
                        $result = pg_execute($dbconn, "", array($username));
                }
        }

        // helpers for frogs
        function updateFrogsWins($username, $dbconn) {
                if ($_SESSION['FrogsGame']->isWon()==true) {
                        $query = "UPDATE appuser SET frogsWins=frogsWins+1 WHERE userid=$1;";
                        $result = pg_prepare($dbconn, "", $query);
                        $result = pg_execute($dbconn, "", array($username));
                }
        }

        // helpers for profile
        function validateProfileForms() {
                $errors=array();
                if(empty($_REQUEST['passwordUpdate']))$errors[]='password is required';
		if(empty($_REQUEST['passwordUpdateConfirm']))$errors[]='password confirmation is required';
		if ($_REQUEST['passwordUpdate'] != $_REQUEST['passwordUpdateConfirm'])$errors[]='passwords do not match';
		if(empty($_REQUEST['emailUpdate']))$errors[]='email is required';
		if(empty($_REQUEST['dateOfBirthUpdate']))$errors[]='date of birth is required';
		if(empty($_REQUEST['gendersUpdate']))$errors[]='gender is required';
                return $errors;
        }

        function submitUpdate($password, $email, $dateofbirth, $gender, $username, $dbconn) {
                $query = "UPDATE appuser SET password=$1, email=$2, dateofbirth=$3, gender=$4 WHERE userid=$5;";
		$result = pg_prepare($dbconn, "", $query);
		$result = pg_execute($dbconn, "", array($password,  $email, $dateofbirth, $gender, $username));
        }

        // helper for guessGame 
        function updateGuessWins($username, $dbconn) {
                $query = "UPDATE appuser SET guessWins=guessWins+1 WHERE userid=$1;";
                $result = pg_prepare($dbconn, "", $query);
                $result = pg_execute($dbconn, "", array($username));
        }
?>
