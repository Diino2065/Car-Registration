<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <h2>REGISTER</h2>
        <form action="register_process.php" method="POST">
            
            First Name: <input type="text" name="ime" required><br>
            Last Name: <input type="text" name="prezime" required><br>
            Address: <input type="text" name="adresa" required><br>
            Phone Number: <input type="text" name="broj_telefona" required><br>
            Email: <input type="text" name="email" required><br>
            Password: <input type="password" name="pass" required><br>
            Confirm Password: <input type="password" name="confirm_pass" required><br>
            <input type="submit" value="Register">
        </form>

        <p>Already have an account? <a href="index0.html">Login here</a>.</p>
    </div>
</body>
</html>
