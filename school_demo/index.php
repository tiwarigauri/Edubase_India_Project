// Basic index.php setup
// index.php
require 'db.php';
$query = "SELECT student.*, classes.name AS class_name FROM student 
          LEFT JOIN classes ON student.class_id = classes.class_id";
$students = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Student List</h1>
    <a href="create.php">Add New Student</a>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Class</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= htmlspecialchars($student['class_name'] ?? 'N/A') ?></td>
                    <td><img src="uploads/<?= htmlspecialchars($student['image']) ?>" alt="Image" width="50"></td>
                    <td>
                        <a href="view.php?id=<?= $student['id'] ?>">View</a>
                        <a href="edit.php?id=<?= $student['id'] ?>">Edit</a>
                        <a href="delete.php?id=<?= $student['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>