<?php
include('db.php');

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Check if username already exists
    $check_sql = "SELECT * FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        $error = "Username already exists. Please choose a different username.";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php?registered=1");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Register</h1>
    </header>
    <main>
        <form action="register.php" method="POST" class="form">
            <h2>Create an Account</h2>
            <?php
            if ($error) {
                echo "<p class='error'>$error</p>";
            }
            ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Register">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </main>
</body>
</html>