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
				<h1>Stats by Game for <?php echo($_SESSION['user'])?></h1>
				<li class="statsElement">Amount of Total Frogs Wins: <?php echo($_SESSION['globalFrogsWins'])?> </li>
				<li class="statsElement">Amount of Total GuessGame Wins: <?php echo($_SESSION['globalGuessWins'])?> </li>
				<li class="statsElement">Amount of Total Rock Paper Scissors Wins: <?php echo($_SESSION['globalRPSWins'])?> </li>
			</section>
			<section class='stats'>
				<h1>Leaderboard of Most Wins (All Games)</h1>
				<li class="statsElement">First: <?php echo($_SESSION['firstUser'])?> </li>
				<li class="statsElement">Second: <?php echo($_SESSION['secondUser'])?> </li>
				<li class="statsElement">Third: <?php echo($_SESSION['thirdUser'])?> </li>
			</section>
			</div>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

