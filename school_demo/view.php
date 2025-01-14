// view.php
<?php
require 'db.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Student ID is required.");
}

$stmt = $pdo->prepare("SELECT student.*, classes.name AS class_name FROM student 
                        LEFT JOIN classes ON student.class_id = classes.class_id WHERE student.id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$student) {
    die("Student not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student</title>
</head>
<body>
    <h1>View Student</h1>
    <p><strong>Name:</strong> <?= htmlspecialchars($student['name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
    <p><strong>Address:</strong> <?= htmlspecialchars($student['address']) ?></p>
    <p><strong>Class:</strong> <?= htmlspecialchars($student['class_name'] ?? 'N/A') ?></p>
    <p><strong>Created At:</strong> <?= htmlspecialchars($student['created_at']) ?></p>
    <p><img src="uploads/<?= htmlspecialchars($student['image']) ?>" alt="Image" width="100"></p>
    <a href="index.php">Back to List</a>
</body>
</html>
