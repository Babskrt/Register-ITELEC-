<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    
    <a href="register.php">Register</a> |
    <a href="login.php">Login</a><br /><br />
    
    <form action="includes/login.inc.php" method="get">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        
        <label for="pwd">Password:</label>
        <input type="password" name="pwd" id="pwd" required><br>
        
        <button type="submit">Log In</button>
    </form>
</body>
</html>