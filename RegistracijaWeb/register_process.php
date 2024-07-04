+<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = $_POST["ime"];
    $prezime = $_POST["prezime"];
    $adresa = $_POST["adresa"];
    $broj_telefona = $_POST["broj_telefona"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $confirm_password = $_POST["confirm_pass"];

    if ($password != $confirm_password) {
        echo "Error: Passwords do not match";
    } else {
        $stmt = $conn->prepare("INSERT INTO Vlasnik (Ime, Prezime, Adresa, BrojTelefona, Email, Pass) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $ime, $prezime, $adresa, $broj_telefona, $email, $password);
        
        if ($stmt->execute()) {
            echo "Registration successful";// redirect 
            header("Location: welcome.php");
            exit();
        } else {
            // redirect na formu 
            header("Location: register.php");
            exit();
        }
        
        $stmt->close();
    }
}
?>

 