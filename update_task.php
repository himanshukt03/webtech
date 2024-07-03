<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $id = intval($_POST['id']);
    $description = $conn->real_escape_string($_POST['description']);
    $sql = "UPDATE tasks SET description='$description' WHERE id=$id AND user_id=$user_id";

    if ($conn->query($sql) === TRUE) {
        include('get_tasks.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>