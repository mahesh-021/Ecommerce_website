<?php
include 'db/db.php';

if ($conn) {
    echo "Database connected successfully!";
} else {
    echo "Failed to connect to the database.";
}
?>