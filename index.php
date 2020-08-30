<!DOCTYPE html>
<html>
	<head>
		<title>Postigram</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="login_include/main.css" />
		<link rel="shortcut icon" type="image/x-icon" href="/login_images/Logo.png"/>
	</head>
	<body class="is-preload">
			<header id="header">
				<h1 style="font-family: cursive; font-size: 80px;">Postigram</h1>
				<p>Your personal social space for sharing pictures and opinions<br />
				But before that, please login into your account...</p>
			</header>

			<form method="POST" action="code.login.php">
				<input type="text" name="username" id="email" placeholder="Username" style="width: 45%;"/> <br>
				<input type="password" name="password" id="password" placeholder="Password" style="width: 45%;"/><br><br>
				<input type="submit" value="Login" style="width: 45%;" />
			</form>

			<form id="signup-form">
				<input type="button" value="Sign Up" style="width: 45%;" onclick="location.href='sign_up.php';"/>
			</form>

			<script src="login_include/main.js"></script>
	</body>
</html>

