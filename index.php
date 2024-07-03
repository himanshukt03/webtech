<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Task Manager</h1>
        <nav>
            <a href="register.php">Register</a> | <a href="login.php">Login</a>
        </nav>
    </header>
    <main class="main">
        <section class="task-list">
            <h2>Tasks</h2>
            <div id="tasks">
                <?php
                $sql = "SELECT * FROM tasks";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="task" data-task-id="' . $row["id"] . '">
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
            </div>
        </section>
    </main>
    <script src="js/main.js"></script>
</body>
</html>
