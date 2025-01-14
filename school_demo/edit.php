// edit.php
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
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $class_id = $_POST['class_id'] ?? null;
    $image = $_FILES['image'] ?? null;

    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if ($image && $image['error'] === 0) {
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($image['type'], $allowedTypes)) {
            $errors[] = "Invalid image format. Only JPG and PNG are allowed.";
        } else {
            $imagePath = 'uploads/' . uniqid() . '-' . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $imagePath);
        }
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE student SET name = ?, email = ?, address = ?, class_id = ?, image = ? WHERE id = ?");
        $stmt->execute([$name, $email, $address, $class_id, $imagePath ?? $student['image'], $id]);
        header('Location: index.php');
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
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($student['name']) ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($student['email']) ?>" required><br>

        <label for="address">Address:</label>
        <textarea name="address" id="address"><?= htmlspecialchars($student['address']) ?></textarea><br>

        <label for="class_id">Class:</label>
        <select name="class_id" id="class_id">
            <?php foreach ($classes as $class): ?>
                <option value="<?= $class['class_id'] ?>" <?= $class['class_id'] == $student['class_id'] ? 'selected' : '' ?>><?= htmlspecialchars($class['name']) ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image"><br>
        <img src="uploads/<?= htmlspecialchars($student['image']) ?>" alt="Image" width="100"><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>