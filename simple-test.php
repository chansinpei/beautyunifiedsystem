<?php
echo "PHP Version: " . phpversion() . "<br>";
echo "Current Dir: " . __DIR__ . "<br>";

// Check if db.php exists
if (file_exists("php/db.php")) {
    echo "db.php: ✅ EXISTS<br>";
    
    include 'php/db.php';
    echo "Database: " . ($conn->connect_error ? "❌ " . $conn->connect_error : "✅ CONNECTED") . "<br>";
    
    $result = $conn->query("SHOW TABLES");
    echo "Tables in DB: " . $result->num_rows . "<br>";
    
    if ($result->num_rows == 0) {
        echo "🚨 DATABASE IS EMPTY!<br>";
        echo "Create 'import-now.php' to import your data!";
    }
} else {
    echo "db.php: ❌ NOT FOUND<br>";
}
?>
