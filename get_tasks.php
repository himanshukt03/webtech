<?php
include('session.php');
include('db.php');

if (!isset($_SESSION['user_id'])) {
    echo "User not logged in";
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tasks WHERE user_id = $user_id ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $completed_class = $row["is_complete"] ? 'completed' : '';
        echo '<div class="task ' . $completed_class . '" data-task-id="' . $row["id"] . '">
                <div class="content">
                    <input type="text" class="text" value="' . htmlspecialchars($row["description"], ENT_QUOTES, 'UTF-8') . '" readonly>
                </div>
                <div class="actions">
                    <button class="complete">' . ($row["is_complete"] ? "Incomplete" : "Complete") . '</button>
                    <button class="edit">Edit</button>
                    <button class="delete">Delete</button>
                </div>
            </div>';
    }
} else {
    echo "<p>No tasks found</p>";
}
?>