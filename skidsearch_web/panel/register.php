<?php
error_reporting(0);
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'password';
$DATABASE_NAME = 'ExtortionUsers';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	die ('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// One or more values are empty.
    echo '<html>';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<title>extortion - Registration</title>';
    echo '<link href="style.css" rel="stylesheet" type="text/css">';
    echo '</head>';
    echo '<div class="register-failure">';
    echo '<h1>Register</h1>';
    echo '<p>Please fill out all of the fields!<br>';
    echo '<a href="register.html">Try Again!</a></p>';
    echo '</div>';
    echo '</html>';
    die();
}

// Validate email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo '<html>';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<title>extortion - Registration</title>';
    echo '<link href="style.css" rel="stylesheet" type="text/css">';
    echo '</head>';
    echo '<div class="register-failure">';
    echo '<h1>Register</h1>';
    echo '<p>Email is invalid!<br>';
    echo '<a href="register.html">Try Again!</a></p>';
    echo '</div>';
    echo '</html>';
    die();
}

// Validate characters in username
if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
    echo '<html>';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<title>extortion - Registration</title>';
    echo '<link href="style.css" rel="stylesheet" type="text/css">';
    echo '</head>';
    echo '<div class="register-failure">';
    echo '<h1>Register</h1>';
    echo '<p>Username contains invalid characters!<br>';
    echo '<a href="register.html">Try Again!</a></p>';
    echo '</div>';
    echo '</html>';
    die();

}
// Validate characters in password
if (preg_match('/[A-Za-z0-9]+/', $_POST['password']) == 0) {
    echo '<html>';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<title>extortion - Registration</title>';
    echo '<link href="style.css" rel="stylesheet" type="text/css">';
    echo '</head>';
    echo '<div class="register-failure">';
    echo '<h1>Register</h1>';
    echo '<p>Password contains invalid characters!<br>';
    echo '<a href="register.html">Try Again!</a></p>';
    echo '</div>';
    echo '</html>';
    die();

}
// Validate characters in email
if (preg_match('/[A-Za-z0-9]+/', $_POST['email']) == 0) {
    echo '<html>';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<title>extortion - Registration</title>';
    echo '<link href="style.css" rel="stylesheet" type="text/css">';
    echo '</head>';
    echo '<div class="register-failure">';
    echo '<h1>Register</h1>';
    echo '<p>Email contains invalid characters!<br>';
    echo '<a href="register.html">Try Again!</a></p>';
    echo '</div>';
    echo '</html>';
    die();

}
// Max length for username
if (strlen($_POST['username']) > 16 || strlen($_POST['username']) < 3) {
    echo '<html>';
    echo '<head>';
    echo '<meta charset="utf-8">';
    echo '<title>extortion - Registration</title>';
    echo '<link href="style.css" rel="stylesheet" type="text/css">';
    echo '</head>';
    echo '<div class="register-failure">';
    echo '<h1>Register</h1>';
    echo '<p>Username must be between 3 and 16 characters long!<br>';
    echo '<a href="register.html">Try Again!</a></p>';
    echo '</div>';
    echo '</html>';
    die();
}
// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT id, password FROM current_users WHERE username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    // Store the result so we can check if the account exists in the database.
    if ($stmt->num_rows > 0) {
        // Username already exists
        echo '<html>';
        echo '<head>';
        echo '<meta charset="utf-8">';
        echo '<title>extortion - Registration</title>';
        echo '<link href="style.css" rel="stylesheet" type="text/css">';
        echo '</head>';
        echo '<div class="register-failure">';
        echo '<h1>Register</h1>';
        echo '<p>Username already exists!<br>';
        echo '<a href="register.html">Try Again!</a></p>';
        echo '</div>';
        echo '</html>';
        die();
    } else {
        if ($stmt = $con->prepare('SELECT id, password FROM current_users WHERE email = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
            $stmt->bind_param('s', $_POST['email']);
            $stmt->execute();
            $stmt->store_result();
            // Store the result so we can check if the account exists in the database.
            if ($stmt->num_rows > 0) {
                // Email already exists
                echo '<html>';
                echo '<head>';
                echo '<meta charset="utf-8">';
                echo '<title>extortion - Registration</title>';
                echo '<link href="style.css" rel="stylesheet" type="text/css">';
                echo '</head>';
                echo '<div class="register-failure">';
                echo '<h1>Register</h1>';
                echo '<p>A user with that email already exists!<br>';
                echo '<a href="register.html">Try Again!</a></p>';
                echo '</div>';
                echo '</html>';
                die();
            } else {
                // Username and Email doesnt exists, insert new account
                if ($stmt = $con->prepare('INSERT INTO current_users (username, password, email, when_registered, activation_code) VALUES (?, ?, ?, ?, ?)')) {
                    // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $current_time = time();
                    $uniqid = uniqid();
                    $stmt->bind_param('sssis', $_POST['username'], $password, $_POST['email'], $current_time, $uniqid);
                    $stmt->execute();
                    $stmt = $con->prepare('UPDATE current_users SET registration_ip = ? WHERE username = ?');
                    $stmt->bind_param('ss', $_SERVER["HTTP_CF_CONNECTING_IP"], $_POST['username']);
                    $stmt->execute();
                    $from    = 'noreply@extortion.net';
                    $subject = 'extortion Account Activation';
                    $headers = 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
                    $activate_link = 'https://skidsearch.net/panel/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
                    $message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
                    mail($_POST['email'], $subject, $message, $headers, "-fnoreply@extortion.net -Fnoreply");
                    echo '<html>';
                    echo '<head>';
                    echo '<meta charset="utf-8">';
                    echo '<title>extortion - Registration</title>';
                    echo '<link href="style.css" rel="stylesheet" type="text/css">';
                    echo '</head>';
                    echo '<div class="register">';
                    echo '<h1>Registered</h1>';
                    echo '<p style="text-align: center;">Please check your email to activate your account!</p>';
                    echo '<p style="text-align: center;">Dont forget to check your spam folder!</p>';
                    echo '<p style="text-align: center; padding-bottom: 15px;">Click <a href="login.php">HERE</a> to Login!</p>';
                    echo '</div>';
                    echo '</html>';
                } else {
                    // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                    var_dump($stmt);
                }
            }
        $stmt->close();
        }
    }
} else {
    // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
    echo 'Could not prepare statement!';
}
$con->close();
?>
