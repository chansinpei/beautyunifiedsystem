<?php
echo "<h3>🚀 Importing Database...</h3>";

// Include database connection
include 'php/db.php';

// Read SQL file
$sql = file_get_contents('image_encryption_db.sql');

if (empty($sql)) {
    die("❌ ERROR: SQL file is empty or not found!");
}

echo "SQL file loaded successfully!<br>";
echo "File size: " . strlen($sql) . " bytes<br>";

// Execute SQL
if ($conn->multi_query($sql)) {
    echo "✅ Database imported successfully!<br><br>";
    
    // Show tables
    $result = $conn->query("SHOW TABLES");
    echo "<h4>📊 Tables Created: " . $result->num_rows . "</h4>";
    
    // List all tables
    while ($row = $result->fetch_array()) {
        echo "• " . $row[0] . "<br>";
    }
    
    echo "<br><h4>🎉 IMPORT COMPLETE!</h4>";
    echo "Your database is now ready on Railway!<br>";
    echo "You can now test login at: <br>";
    echo "<a href='login.html'>https://beautyunifiedsystem-production.up.railway.app/login.html</a>";
    
} else {
    echo "❌ Import failed: " . $conn->error;
}

$conn->close();
?>
