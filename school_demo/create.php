// create.php
<?php
require 'db.php';
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
        $stmt = $pdo->prepare("INSERT INTO student (name, email, address, class_id, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $address, $class_id, $imagePath ?? null]);
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
    <title>Create Student</title>
</head>
<body>
    <h1>Create Student</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="address">Address:</label>
        <textarea name="address" id="address"></textarea><br>

        <label for="class_id">Class:</label>
        <select name="class_id" id="class_id">
            <?php foreach ($classes as $class): ?>
                <option value="<?= $class['class_id'] ?>"><?= htmlspecialchars($class['name']) ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image"><br>

        <button type="submit">Create</button>
    </form>
</body>
</html>