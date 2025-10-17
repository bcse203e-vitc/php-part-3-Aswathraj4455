<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $remember = isset($_POST['remember']);

    if ($remember && !empty($username)) {
        setcookie('username', $username, time() + (3600 * 24), "/");
        $message = "Cookie set! You'll be remembered as **" . htmlspecialchars($username) . "**.";
    } elseif (isset($_COOKIE['username'])) {
        setcookie('username', '', time() - 3600, "/");
        $message = "Cookie cleared! You won't be remembered.";
    } else {
        $message = "No action taken. Please enter a username.";
    }
}

$greeting_name = $_COOKIE['username'] ?? 'Guest';
$remembered_username = $_COOKIE['username'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Simple Remember Me</title>
</head>
<body>
    <h1>Welcome <?php echo htmlspecialchars($greeting_name); ?>! 👋</h1>
    <p>This page demonstrates saving your username in a cookie.</p>

    <?php if (isset($message)): ?>
        <p style="border: 1px solid green; padding: 10px; background-color: #e6ffe6;">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form action="index.php" method="POST">
        <label for="username">Enter Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($remembered_username); ?>" required>
        <br><br>
        
        <input type="checkbox" id="remember" name="remember" 
               <?php echo isset($_COOKIE['username']) ? 'checked' : ''; ?>>
        <label for="remember">Remember Me (Saves Username)</label>
        <br><br>
        
        <input type="submit" value="Login / Set Cookie">
    </form>
    
    <hr>
    
</body>
</html>
