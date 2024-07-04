<!DOCTYPE html>
<html lang="en">
<head>
<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_user"])) {
        // dodaj usera 
        $ime = $_POST["ime"];
        $prezime = $_POST["prezime"];
        $adresa = $_POST["adresa"];
        $broj_telefona = $_POST["broj_telefona"];
        $email = $_POST["email"];
        $password = isset($_POST["pass"]) ? $_POST["pass"] : '';

        $sql = "INSERT INTO Vlasnik (Ime, Prezime, Adresa, BrojTelefona, Email, Pass) 
                VALUES ('$ime', '$prezime', '$adresa', '$broj_telefona', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>window.onload = function() { document.getElementById("userSuccess").style.display = "block"; }</script>';
        } else {
            echo '<script>window.onload = function() { document.getElementById("userError").style.display = "block"; }</script>';
        }
    } elseif (isset($_POST["add_car"])) {
        $registracija = $_POST["registracija"];
        $marka = $_POST["marka"];
        $model = $_POST["model"];
        $godina_proizvodnje = $_POST["godina_proizvodnje"];
        $boja = $_POST["boja"];
        $kategorija = $_POST["kategorija"]; 
        $vlasnik_id = $_POST["vlasnik_id"];

        $sql = "INSERT INTO Vozilo (RegistracijaTablica, Marka, Model, GodinaProizvodnje, Boja, Kategorija, VlasnikID) 
                VALUES ('$registracija', '$marka', '$model', $godina_proizvodnje, '$boja', '$kategorija', $vlasnik_id)";

        if ($conn->query($sql) === TRUE) {
            echo '<script>window.onload = function() { document.getElementById("carSuccess").style.display = "block"; }</script>';
        } else {
            echo '<script>window.onload = function() { document.getElementById("carError").style.display = "block"; }</script>';
        }
    }
}

$conn->close();
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User or Car</title>
    <style>
        body {
            font-family: cursive, Helvetica, sans-serif;
            background-image: url("pozadina.jpg");
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .container {
            width: 300px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: black;
        }

        h2 {
            margin-top: 10px;
        }

        form {
            display: none;
            flex-direction: column;
            align-items: center;
            color: black;
        }

        form input[type="text"],
        form input[type="password"],
        form input[type="email"],
        form input[type="year"],
        form input[type="text"] {
            margin-bottom: 10px;
            padding: 6px;
            border: 2px solid #ccc;
            border-radius: 5px;
            width: calc(100% - 22px);
            box-sizing: border-box;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .btn-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            background-color: lightblue;
            color: black;
            cursor: pointer;
            font-family: cursive, Helvetica, sans-serif;
        }

        .btn-container button:hover {
            background-color: white;
        }

        .message {
            display: none;
            margin-top: 10px;
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add User or Car</h2>

        <button onclick="showForm('userForm')" style="margin-top: 15px; padding: 10px; border: none; border-radius: 5px; width: calc(100% - 22px); box-sizing: border-box; background-color: lightblue; color: black; cursor: pointer; font-family: cursive, Helvetica, sans-serif;">Add User</button>

        <button onclick="showForm('carForm')" style="margin-top: 15px; padding: 10px; border: none; border-radius: 5px; width: calc(100% - 22px); box-sizing: border-box; background-color: lightblue; color: black; cursor: pointer; font-family: cursive, Helvetica, sans-serif;">Add Car</button>

        <form id="userForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="ime">Ime:</label>
            <input type="text" name="ime" required><br>
            <label for="prezime">Prezime:</label>
            <input type="text" name="prezime" required><br>
            <label for="adresa">Adresa:</label>
            <input type="text" name="adresa" required><br>
            <label for="broj_telefona">Broj Telefona:</label>
            <input type="text" name="broj_telefona" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <label for="pass">Password:</label>
            <input type="password" name="pass" required><br>
            <div class="btn-container">
                <input type="submit" name="add_user" value="Submit" style=" border: none;background-color: lightblue; color: black; cursor: pointer; font-family: cursive, Helvetica, sans-serif;">
                <button type="button" onclick="hideForm('userForm')">Cancel</button>
            </div>
        </form>
        <div id="userSuccess" class="message">User added successfully</div>
        <div id="userError" class="message" style="color: red;">Error adding user</div>

        <form id="carForm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="registracija">Registracija Tablica:</label>
            <input type="text" name="registracija" required><br>
            <label for="marka">Marka:</label>
            <input type="text" name="marka" required><br>
            <label for="model">Model:</label>
            <input type="text" name="model" required><br>
            <label for="godina_proizvodnje">Godina Proizvodnje:</label>
            <input type="year" name="godina_proizvodnje" required><br>
            <label for="boja">Boja:</label>
            <input type="text" name="boja" required><br>
            <label for="kategorija">Kategorija:</label>
            <input type="text" name="kategorija" required><br> <!-- kategorija naknadno  -->
            <label for="vlasnik_id">Vlasnik ID:</label>
            <input type="year" name="vlasnik_id" required><br>
            <div class="btn-container">
                <input type="submit" name="add_car" value="Submit" style="  background-color: lightblue; cursor: pointer; border: none; font-family: cursive, Helvetica, sans-serif;">
                <button type="button" onclick="hideForm('carForm')">Cancel</button>
            </div>
        </form>
        <div id="carSuccess" class="message">Car added successfully</div>
        <div id="carError" class="message" style="color: red;">Error adding car</div>

        <script>
            // skripta za prikaz i sakrivanje forme 
            function showForm(formId) {
                var forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    if (form.id === formId) {
                        form.style.display = 'flex';
                    } else {
                        form.style.display = 'none';
                    }
                });
            }

            function hideForm(formId) {
                var form = document.getElementById(formId);
                form.style.display = 'none';
            }
        </script>
    </div>
</body>
</html>
