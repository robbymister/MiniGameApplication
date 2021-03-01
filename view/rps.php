<?php
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
				<h1>Rock Paper Scissors</h1>
				<div class="rpsContainer">
				<?php if($_SESSION["RockPaperScissors"]->endedGame!=true){ ?>
				<form method="post">
					<ul>
						<li><button type="submit" name="rock"><img src="./images/rock.jpg" class="rpsElement"></button></li>
						<li><button type="submit" name="paper"><img src="./images/paper.jpg" class="rpsElement"></button></li>
						<li><button type="submit" name="scissors"><img src="./images/scissors.png" class="rpsElement"></button></li>
					</ul>	
				</form>
				<?php 
					} 
				?>
				<?php
					if($_SESSION["RockPaperScissors"]->endedGame==true){
				?>
				<form method="post">
					<input type="submit" name="restartRPS" value="play again"/>
				</form>
				<?php 
					} 
				?>
				</div>
				<?php echo(view_errors($errors)); ?> 

				<?php 
					foreach($_SESSION['RockPaperScissors']->history as $key=>$value){
						echo("<br/> $value");
					}
				?>

			</section>
			<section class='stats'>
				<h1>Session Stats</h1>
				<li class="statsElement">Amount of Wins: <?php echo($_SESSION['RPSWins'])?> </li>
				<li class="statsElement">Amount of Total Plays: <?php echo($_SESSION['RPSPlays'])?> </li>
			</section>
			</div>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

