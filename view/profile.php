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
			<form action="index.php" method="post">
					<h1>Profile</h1>
					<table>
						<!-- Trick below to re-fill the user form field -->
						<tr><th><label for="password">New password:</label></th><td> 
							<input type="password" name="passwordUpdate"/>
						</td></tr>
                        <tr><th><label for="passwordConfirm">Confirm new password:</label></th><td> 
							<input type="password" name="passwordUpdateConfirm"/>
						</td></tr>
                        <tr><th><label for="email">Email:</label></th><td> 
							<input type="text" name="emailUpdate" value="<?php echo($_SESSION['email']); ?>"/>
						</td></tr>
                        <tr><th><label for="dob">Date of Birth:</label></th><td> 
							<input type="date" name="dateOfBirthUpdate" value="<?php echo($_SESSION['dateOfBirth']); ?>"/>
						</td></tr>
                        <tr><th><label for="gender">Gender:</label></th><td>
                            <input list="genders" name="gendersUpdate" value="<?php echo($_SESSION['gender']); ?>">
                                <datalist id="genders">
                                    <option value="Male">
                                    <option value="Female">
                                    <option value="Other">
                                </datalist>
                        </td></tr>
						<tr><th>&nbsp;</th><td><input type="submit" name="submitUpdate" value="update" /></td></tr>
						<tr><th>&nbsp;</th><td><?php echo(view_errors($errors)); ?></td></tr>
						<tr><th>&nbsp;</th><td><?php if ($_SESSION["updateSuccess"]) echo("User update successful!"); ?></td></tr>
					</table>
				</form>
			</section>
			</div>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

