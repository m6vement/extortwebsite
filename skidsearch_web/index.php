<?PHP
error_reporting(0);
session_start();
if (!isset($_SESSION['loggedin'])) {
        header('Location: panel/login.php');
        exit();
} else {
        header('Location: panel/login.php');
}
?>
