// classes.php
<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    if (!empty($name)) {
        $stmt = $pdo->prepare("INSERT INTO classes (name) VALUES (?)");
        $stmt->execute([$name]);
        header('Location: classes.php');
        exit;
    }
}

$classes = $pdo->query("SELECT * FROM classes")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Classes</title>
</head>
<body>
    <h1>Manage Classes</h1>
    <form action="" method="POST">
        <label for="name">Class Name:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Add Class</button>
    </form>
    <h2>Class List</h2>
    <ul>
        <?php foreach ($classes as $class): ?>
            <li><?= htmlspecialchars($class['name']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
