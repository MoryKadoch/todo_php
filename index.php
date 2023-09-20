<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['task'])) {
        $task = $_POST['task'];
        $stmt = $pdo->prepare("INSERT INTO tasks (task) VALUES (?)");
        $stmt->execute([$task]);
    }

    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->execute([$delete_id]);
    }
}

$tasks = $pdo->query("SELECT * FROM tasks")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card shadow">
                    <div class="card-header text-center text-white bg-primary">
                        <h5 class="mb-0">Todo List</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="input-group mb-3">
                                <input type="text" name="task" class="form-control" placeholder="Add a new task" id="taskInput" autofocus>
                                <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i></button>
                            </div>
                        </form>

                        <ul class="list-group">
                            <?php foreach ($tasks as $task) : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= htmlspecialchars($task['task']); ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="delete_id" value="<?= $task['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>