<?php
include('session.php');
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <nav>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main class="main">
        <form id="new-task-form" class="form">
            <input type="text" name="description" id="new-task-input" placeholder="What do you have planned?" required>
            <input type="submit" id="new-task-submit" value="Add Task">
        </form>
        <section class="task-list">
            <h2>Your Tasks</h2>
            <div id="tasks">
                <?php include('get_tasks.php'); ?>
            </div>
        </section>
    </main>
    <script src="js/main.js"></script>
</body>
</html>