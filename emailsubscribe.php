<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['email']) && !empty($_POST['email'])) {

        $email = mysqli_real_escape_string($conn, $_POST['email']);

        // Check if already subscribed
        $check = "SELECT id FROM tblsubscribers WHERE email='$email'";
        $result = mysqli_query($conn, $check);

        if (mysqli_num_rows($result) > 0) {

            echo "<script>
                alert('Email already subscribed!');
                window.location.href='index.php';
            </script>";

        } else {

            $insert = "INSERT INTO tblsubscribers (email) VALUES ('$email')";

            if (mysqli_query($conn, $insert)) {

                echo "<script>
                    alert('Subscription successful!');
                    window.location.href='index.php';
                </script>";

            } else {
                echo "Insert failed: " . mysqli_error($conn);
            }
        }

    } else {
        echo "Email is empty!";
    }

} else {
    echo "Form not submitted properly.";
}
?>