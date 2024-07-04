<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Fetch the user with the given username from the database
    $stmt = $conn->prepare("SELECT * FROM Vlasnik WHERE Ime=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify the password directly
        if ($password === $row["Pass"]) {
            // Password is correct, set session and redirect
            $_SESSION["username"] = $username;

            // Redirect to welcome.php
            header("Location: welcome.php");
            exit();
        } else {
            echo "Error: Invalid password";
        }
    } else {
        echo "Error: User not found";
    }

    $stmt->close();
}

$conn->close();
?>
