<?php
error_reporting(0);
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'password';
$DATABASE_NAME = 'SkidSearchUsers';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>SkidSearch</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="style.css" rel="stylesheet" type="text/css">
    </head>
	<body>
		<div class="activate">
			<h1>Activation</h1>
			<?php
			if (isset($_GET['email'], $_GET['code'])) {
				if ($stmt = $con->prepare('SELECT * FROM current_users WHERE email = ? AND activation_code = ?')) {
					$stmt->bind_param('ss', $_GET['email'], $_GET['code']);
					$stmt->execute();
					$stmt->store_result();
					if ($stmt->num_rows > 0) {
						if ($stmt = $con->prepare('UPDATE current_users SET activation_code = ? WHERE email = ? AND activation_code = ?')) {
							$newcode = 'activated';
							$stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
							$stmt->execute();
							echo "<h2>Account Activated!</h2>";
							echo "<p><a href=\"login.php\">Login!</a></p></br>";
						}
					} else {
						echo "<p>The account is already activated or doesn't exist!</p>";
					}
				}
			}
			?>
		</div>
	</body>
</html>
