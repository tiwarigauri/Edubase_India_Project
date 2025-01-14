// db.php
$host = 'localhost';
$dbname = 'school_db';
$user = 'root';
$password = 'csjma16001390197';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Database creation script (run this once to set up the database)
try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS school_db;");
    $pdo->exec("USE school_db;");

    $pdo->exec("CREATE TABLE IF NOT EXISTS classes (
        class_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );");

    $pdo->exec("CREATE TABLE IF NOT EXISTS student (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        address TEXT,
        class_id INT,
        image VARCHAR(255),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (class_id) REFERENCES classes(class_id)
    );");

    echo "Database and tables created successfully.";
} catch (PDOException $e) {
    die("Error creating database: " . $e->getMessage());
}
