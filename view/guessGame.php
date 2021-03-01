<?php
	// So I don't have to deal with uninitialized $_REQUEST['guess']
	$_REQUEST['guess']=!empty($_REQUEST['guess']) ? $_REQUEST['guess'] : '';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Games</title>
	</head>
	<body>
		<header>
			<nav class="container">
			<ul>
				<li> <a <?php if($activePage=="stats.php") { ?>  style="color: black; background-color: white; border: 1px solid black;"   <?php   }  ?> href="?operation=stats">All Stats</a> </li>
				<li> <a <?php if($activePage=="guessGame.php") { ?>  style="color: black; background-color: white; border: 1px solid black;"   <?php   }  ?> href="?operation=guessGame">Guess Game</a> </li>
				<li> <a <?php if($activePage=="rps.php") { ?>  style="color: black; background-color: white; border: 1px solid black;"   <?php   }  ?> href="?operation=rps">Rock Paper Scissors</a> </li>
				<li> <a <?php if($activePage=="frogs.php") { ?>  style="color: black; background-color: white; border: 1px solid black;"   <?php   }  ?> href="?operation=frogs">Frogs</a> </li>
				<li> <a <?php if($activePage=="profile.php") { ?>  style="color: black; background-color: white; border: 1px solid black;"   <?php   }  ?> href="?operation=profile">Profile</a> </li>
				<li> <a <?php if($activePage=="logout.php") { ?>  style="color: black; background-color: white; border: 1px solid black;"   <?php   }  ?> href="./index.php?operation=logout">
					Logout
				</a> </li> 
            </ul>
			</nav>
		</header>
		<main>
			<div class='mainDiv'>
			<section class='game'>
				<h1>Guess Game</h1>
				<?php if($_SESSION["GuessGame"]->getState()!="correct"){ ?>
				<form method="post">
					<input type="text" name="guess" value="<?php echo($_REQUEST['guess']); ?>" /> <input type="submit" name="submit" value="guess" />
				</form>
				<?php } ?>

				<?php echo(view_errors($errors)); ?> 

				<?php 
					foreach($_SESSION['GuessGame']->history as $key=>$value){
						echo("<br/> $value");
					}
					if($_SESSION["GuessGame"]->getState()=="correct"){ 
				?>
				<form method="post">
					<input type="submit" name="restartGuess" value="start again"/>
				</form>
				<?php 
					} 
				?>
			</section>
			<section class='stats'>
				<h1>Session Stats</h1>
				<li class="statsElement">Amount of Wins: <?php echo($_SESSION['GuessGameWins'])?> </li>
				<li class="statsElement">Amount of Total Guesses: <?php echo($_SESSION['GuessGameGuesses'])?> </li>
			</section>
			</div>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

