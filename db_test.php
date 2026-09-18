<?php
$conn = mysqli_connect("localhost", "root", "", "quicks");

if ($conn) {
    echo "✅ Database connected successfully!";
} else {
    echo "❌ Connection failed: " . mysqli_connect_error();
}
