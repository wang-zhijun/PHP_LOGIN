<?php
include('core/init.inc.php');
$errors = array();
if(isset($_POST['username'], $_POST['password'], $_POST['repeat_password'])) {
	if(empty($_POST['username'])) {
		$errors[] = 'The username cannot be empty.';
	}

	if(empty($_POST['password']) || empty($_POST['repeat_password'])){
		$errors[] = 'The password cannot be empty.';
	}
	if($_POST['password'] !=  $_POST['repeat_password']){
		$errors[] = 'Password verification failed.' ;
	}

	if(user_exists($_POST['username'])) {
		$error[] = 'The username you entered is already taken.';
	}
	if(empty($errors)) {
		add_user($_POST['username'], $_POST['password']);

		$_SESSION['username'] = htmlentities($_POST['username']);

		header('Location: protected.php');
		die();
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD xhtml 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
	</head>
	<body>
		<div>
			<?php
			
			if( empty($errors) === false) {
			?>
				<ul>
					<?php
					foreach($errors as $error) {
						echo "<li>{$error}</li>";
					}
					?>
				</ul>
			<?php
			}
			?>
		</div>
		<form action"" method="post">
			<p>
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" value="<?php if(isset($_POST['username'])) {echo htmlentities($_POST['username']);}  ?>" />
			</p>
			<p>
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" />
			</p>
			<p>
				<label for="repeat_password">Repeat Password:</label>
				<input type="password" name="repeat_password" id="repeat_password" />
			</p>
			<p>
				<input type="submit" value="Register" />
			</p>
		</form>
	</body>
</html>
