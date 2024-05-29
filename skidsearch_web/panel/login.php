<?PHP
error_reporting(0);
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>SkidSearch - Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="css/main.css" rel="stylesheet" type="text/css">
		<link href="style.css" rel="stylesheet" type="text/css">
		<meta name="description" content="SkidSearch - The best Minecraft database search engine. Period." />
		<meta name="keywords" content="skidsearch, minecraft, mcresolver, mc dbs, db, db lookup, minecraft resolver" />
	</head>
	<body>
        <div id="notificaton-banner">
        </div>
		<nav class="navtop">
			<div>
                             <h1></h1>
                             <a href="https://discord.gg/tvYUFQaT2w"><i class="fab fa-discord"></i>Discord</a>
                             <a href="removals.php"><i class="fas fa-trash-alt"></i>IP Removals</a>
                             <a href="faq.php"><i class="fas fa-info-circle"></i>FAQ</a>
                             <a href="register.html"><i class="fas fa-user-plus"></i>Register</a>
			</div>
                </nav>

		<div class="wrapper"><div class="clip-text header"><a href="index.php">SKIDSEARCH</a></div></div>

		<div class="login">
			<h1>Login</h1>
			<form action="authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
        		<p>Dont have an account? <a href="register.html">Register!</a></p>
				<input name="submit" type="submit" value="Login">
			</form>
		</div>
   </div>
   <script>
     close = document.getElementById("close");
     close.addEventListener('click', function() {
       notificaton = document.getElementById("notificaton-banner");
       notificaton.style.display = 'none';
     }, false);
   </script>
</html>

