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
			<nav>
				<ul>
				</ul>
			</nav>
		</header>
		<main>
			<section>
				<h1>Games</h1>
				<form action="index.php" method="post">
					<legend>Register</legend>
					<table>
						<!-- Trick below to re-fill the user form field -->
						<tr><th><label for="user">User</label></th><td><input type="text" name="userRegister" /></td></tr>
						<tr><th><label for="password">Password:</label></th><td> <input type="password" name="passwordRegister" /></td></tr>
                        <tr><th><label for="passwordConfirm">Confirm Password:</label></th><td> <input type="password" name="passwordConfirm" /></td></tr>
                        <tr><th><label for="email">Email:</label></th><td> <input type="text" name="email" /></td></tr>
                        <tr><th><label for="dob">Date of Birth:</label></th><td> <input type="date" name="dateOfBirth" /></td></tr>
                        <tr><th><label for="gender">Gender:</label></th><td>
                            <input list="genders" name="genders">
                                <datalist id="genders">
                                    <option value="Male">
                                    <option value="Female">
                                    <option value="Other">
                                </datalist>
                        </td></tr>
						<tr><th>&nbsp;</th><td><input type="submit" name="submitRegister" value="register" /></td></tr>
						<tr><th>&nbsp;</th><td><?php echo(view_errors($errors)); ?></td></tr>
						<tr><th>&nbsp;</th><td><?php if ($_SESSION["registerSuccess"]) echo("User registration successful!"); ?></td></tr>
					</table>
				</form>
				<a href="?operation=logout">Back to Login</a>
			</section>
			<section>
			</section>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>
