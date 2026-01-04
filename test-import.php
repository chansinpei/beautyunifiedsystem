<?php
echo "✅ TEST FILE WORKING!<br>";
echo "Current directory: " . __DIR__ . "<br>";

// Check if SQL file exists
if (file_exists('image_encryption_db.sql')) {
    echo "✅ SQL file exists! Size: " . filesize('image_encryption_db.sql') . " bytes<br>";
} else {
    echo "❌ SQL file NOT found!<br>";
}

// Check if db.php exists
if (file_exists('php/db.php')) {
    echo "✅ db.php exists!<br>";
} else {
    echo "❌ db.php NOT found!<br>";
}
?>
