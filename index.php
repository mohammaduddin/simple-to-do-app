<?php
// File to store tasks
$tasksFile = 'tasks.json';

// Load existing tasks from JSON file
$tasks = file_exists($tasksFile) ? json_decode(file_get_contents($tasksFile), true) : [];

// Handle form submission to add a new task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task'])) {
    $newTask = htmlspecialchars($_POST['task']); // Sanitize input
    $tasks[] = $newTask; // Add new task to the array
    file_put_contents($tasksFile, json_encode($tasks, JSON_PRETTY_PRINT)); // Save tasks to JSON file
    header('Location: index.php'); // Prevent form resubmission
    exit;
}

// Handle task deletion
if (isset($_GET['delete'])) {
    $taskIndex = (int) $_GET['delete'];
    if (isset($tasks[$taskIndex])) {
        unset($tasks[$taskIndex]); // Remove task
        $tasks = array_values($tasks); // Reindex array
        file_put_contents($tasksFile, json_encode($tasks, JSON_PRETTY_PRINT)); // Save updated tasks
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Task Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .task {
            margin: 5px 0;
        }

        .delete-btn {
            color: red;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <h1>Task Manager</h1>
    <form method="POST" action="">
        <input type="text" name="task" placeholder="Enter a new task" required>
        <button type="submit">Add Task</button>
    </form>
    <h2>Task List</h2>
    <ul>
        <?php foreach ($tasks as $index => $task): ?>
            <li class="task">
                <?php echo htmlspecialchars($task); ?>
                <a href="?delete=<?php echo $index; ?>" class="delete-btn">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>