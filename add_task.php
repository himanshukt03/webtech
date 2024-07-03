<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $description = $conn->real_escape_string($_POST['description']);
    $sql = "INSERT INTO tasks (user_id, description) VALUES ($user_id, '$description')";

    if ($conn->query($sql) === TRUE) {
        include('get_tasks.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>