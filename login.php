<?php
include('core/init.inc.php');

$errors = array();

if (isset($_POST['username'], $_POST['password'])) {
	if(empty($_POST['username'])) {
		$errors[] = 'The username cannot be empty.';
	}
	if(empty($_POST['password'])) {
		$errors[] = 'The password cannot be empty.';
	}

	if(valid_credentials($_POST['username'], $_POST['password']) === false) {
		//log in
		$errors[] = 'Username / Password incorrect.';
	}

	if(empty($errors)) {
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
		<link rel="stylesheet" type="text/css" href="ext/css/style.css" />
		<title></title>
	</head>
	<body>
		<div>
			<?php
			if (empty($errors) === false) {
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
			else {
				echo 'Need an account ? <a href="register.php">Register here</a>';
			}
			?>	
		</div>
		<form action="" method="post">
			<p>
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" value="<?php if(isset($_POST['username'])) echo htmlentities($_POST['username']); ?>" />
			</p>
			<p>
				<label for="password">Password:</label>
				<input type="password" name="password" id="passsword" />
			</p>
			<p>
				<input type="submit" value="Login" />
			</p>
		</form>
	</body>
</html>
