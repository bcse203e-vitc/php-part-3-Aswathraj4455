<?php
session_start();

$error_message = '';
$username = '';
$is_logged_in = isset($_SESSION['user']);

if (isset($_GET['logout'])) {
    $_SESSION = array(); 
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$is_logged_in) {
    
    $submitted_user = $_POST['user'] ?? '';
    $submitted_pass = $_POST['pass'] ?? '';

    if ($submitted_user === "admin" && $submitted_pass === "1234") {
        $_SESSION['user'] = $submitted_user;
        header("Location: login.php"); 
        exit(); 
    } else {
        $error_message = "Invalid credentials. Please try again.";
    }
    $is_logged_in = isset($_SESSION['user']);
}

if ($is_logged_in) {
    $username = $_SESSION['user'];
}
?>

<!DOCTYPE html>
<html>
<head><title>Session Login</title></head>
<body>

<?php 
if ($is_logged_in): 
?>
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>You are successfully logged in to the protected area.</p>
    <p><a href="login.php?logout=true">Logout</a></p>

<?php 
else: 
?>
    <h1>Login Required</h1>

    <?php 
    if ($error_message) {
        echo "<p style='color: red;'>$error_message</p>";
    } 
    ?>
    
    <form method="POST" action="q2_login.php">
        <label for="user">Username:</label>
        <input type="text" id="user" name="user" required value="<?php echo htmlspecialchars($_POST['user'] ?? ''); ?>"><br><br>

        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required><br><br>

        <input type="submit" value="Log In">
    </form>

<?php endif; ?>

</body>
</html>
