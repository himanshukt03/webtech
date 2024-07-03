<?php
include('session.php');
include('db.php');

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with this username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <main>
        <form action="login.php" method="POST" class="form">
            <h2>Login to Your Account</h2>
            <?php
            if ($error) {
                echo "<p class='error'>$error</p>";
            }
            ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </main>
</body>
</html>