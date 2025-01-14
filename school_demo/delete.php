// delete.php
<?php
require 'db.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Student ID is required.");
}

$stmt = $pdo->prepare("SELECT * FROM student WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$student) {
    die("Student not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (file_exists($student['image'])) {
        unlink($student['image']);
    }
    $stmt = $pdo->prepare("DELETE FROM student WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
</head>
<body>
    <h1>Delete Student</h1>
    <p>Are you sure you want to delete <?= htmlspecialchars($student['name']) ?>?</p>
    <form action="" method="POST">
        <button type="submit">Yes, Delete</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>