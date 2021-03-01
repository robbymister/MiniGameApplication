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
				<h1>Unavailable</h1>
				game goes here
				game goes here
				game goes here
				game goes here
				game goes here
				game goes here
				game goes here
				game goes here
				game goes here
				game goes here
				game goes here
				game goes here
				game goes here
				game goes here
				game goes here
			</section>
			<section class='stats'>
				<h1>Stats</h1>
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
			</section>
			</div>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

