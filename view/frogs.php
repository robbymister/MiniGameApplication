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
				<h1>Frogs</h1>
				<div class="frogsContainer">
				<?php if($_SESSION["FrogsGame"]->isWon()!=true){ ?>
					<form method="post">
					<ul>
						<li>
							<button type="submit" name="frogs1">
							<img name=frogsImg1 class="frogsElement"
							<?php if($_SESSION["FrogsGame"]->checkImg(0) == 0) {?>
								src="./images/empty.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(0) == 1) {?>
								src="./images/yellowFrog.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(0) == -1) {?>
								src="./images/greenFrog.png"
							<?php } ?>>
							</button>
						</li>
						<li>
						<button type="submit" name="frogs2">
							<img name=frogsImg2 class="frogsElement"
							<?php if($_SESSION["FrogsGame"]->checkImg(1) == 0) {?>
								src="./images/empty.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(1) == 1) {?>
								src="./images/yellowFrog.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(1) == -1) {?>
								src="./images/greenFrog.png"
							<?php } ?>>
						</button>
						</li>
						<li>
						<button type="submit" name="frogs3">
							<img name=frogsImg3 class="frogsElement"
							<?php if($_SESSION["FrogsGame"]->checkImg(2) == 0) {?>
								src="./images/empty.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(2) == 1) {?>
								src="./images/yellowFrog.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(2) == -1) {?>
								src="./images/greenFrog.png"
							<?php } ?>>
						</button>
						</li>
						<li>
						<button type="submit" name="frogs4">
							<img name=frogsImg4 class="frogsElement"
							<?php if($_SESSION["FrogsGame"]->checkImg(3) == 0) {?>
								src="./images/empty.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(3) == 1) {?>
								src="./images/yellowFrog.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(3) == -1) {?>
								src="./images/greenFrog.png"
							<?php } ?>>
						</button>
						</li>
						<li>
						<button type="submit" name="frogs5">
							<img name=frogsImg5 class="frogsElement"
							<?php if($_SESSION["FrogsGame"]->checkImg(4) == 0) {?>
								src="./images/empty.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(4) == 1) {?>
								src="./images/yellowFrog.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(4) == -1) {?>
								src="./images/greenFrog.png"
							<?php } ?>>
						</button>
						</li>
						<li>
						<button type="submit" name="frogs6">
							<img name=frogsImg6 class="frogsElement"
							<?php if($_SESSION["FrogsGame"]->checkImg(5) == 0) {?>
								src="./images/empty.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(5) == 1) {?>
								src="./images/yellowFrog.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(5) == -1) {?>
								src="./images/greenFrog.png"
							<?php } ?>>
						</button>
						</li>
						<li>
						<button type="submit" name="frogs7">
							<img name=frogsImg7 class="frogsElement"
							<?php if($_SESSION["FrogsGame"]->checkImg(6) == 0) {?>
								src="./images/empty.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(6) == 1) {?>
								src="./images/yellowFrog.png"
							<?php } ?>
							<?php if($_SESSION["FrogsGame"]->checkImg(6) == -1) {?>
								src="./images/greenFrog.png"
							<?php } ?>>
						</button>
						</li> 
            		</ul>
					</form>
				</div>
				<form method="post">
						<input type="submit" name="restartFrogsDefault" value="Reset the frogs!"/>
				</form>
				<?php } ?>
				<?php if($_SESSION["FrogsGame"]->isWon()==true){ ?>
					<form method="post">
						<input type="submit" name="restartFrogs" value="start again"/>
					</form>
				<?php } ?>
			</section>
			<section class='stats'>
				<h1>Session Stats</h1>
				<li class="statsElement">Amount of Wins: <?php echo($_SESSION['FrogsWins'])?> </li>
				<li class="statsElement">Amount of Total Moves: <?php echo($_SESSION['FrogsMoves'])?> </li>
			</section>
			</div>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

