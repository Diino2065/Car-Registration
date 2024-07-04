<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Display Page</title>
    <style>
       
        body {
            font-family: cursive, Helvetica, sans-serif;
            background-image: url("pozadina.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Pozadina se ne pomjera */
            margin: 0;
            padding: 0;
        }

        /* Stilizacija kontejnera */
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }

      
        .user-box {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

       
        .user-box p {
            margin: 5px 0;
        }


        .user-box form {
            margin-top: 10px;
            display: flex;
            justify-content: flex-end; /* Poravnanje forme na desno */
        }

       
        form input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100px;
            box-sizing: border-box;
            background-color: lightblue;
            color: black;
            cursor: pointer;
            font-family: cursive, Helvetica, sans-serif;
        }

   
        form input[type="submit"]:hover {
            background-color: white;
            font-family: cursive, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Information</h2>
        <?php
        // konekcija na bazu
        include 'db.php';

        // Poruka je li uspješno ili ne brisanje 
        $message = "";

        // Provjera da li je forma submitovana i postoji parametar za brisanje korisnika
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_user"])) {
            $id = $_POST["delete_user"];
            
            // Update vozila koja su pripadala korisniku na null (bez vlasnika)
            $update_cars_sql = "UPDATE Vozilo SET VlasnikID=NULL WHERE VlasnikID=$id";
            if ($conn->query($update_cars_sql) === TRUE) {
                $delete_user_sql = "DELETE FROM Vlasnik WHERE VlasnikID=$id";
                if ($conn->query($delete_user_sql) === TRUE) {
                    $message = "Vlasnik deleted successfully and related cars updated";
                } else {
                    $message = "Error deleting user: " . $conn->error;
                }
            } else {
                $message = "Error updating related cars: " . $conn->error;
            }
        }

        // SQL upit za dohvat podataka o vlasnicima
        $sql = "SELECT * FROM Vlasnik";
        $result = $conn->query($sql);

        // Provjera da li ima rezultata upita
        if ($result && $result->num_rows > 0) {
            // Prikaz podataka o vlasnicima u okvirima
            while ($row = $result->fetch_assoc()) {
                echo "<div class='user-box' onclick='selectUser(this)'>";
                echo "<p>ID: " . $row["VlasnikID"] . "</p>";
                echo "<p>Name: " . $row["Ime"] . " " . $row["Prezime"] . "</p>";
                echo "<p>Address: " . $row["Adresa"] . "</p>";
                echo "<p>Phone: " . $row["BrojTelefona"] . "</p>";
                echo "<p>Email: " . $row["Email"] . "</p>";

                // SQL upit za dohvat podataka o vozilima vlasnika
                $cars_sql = "SELECT * FROM Vozilo WHERE VlasnikID=" . $row["VlasnikID"];
                $cars_result = $conn->query($cars_sql);

                if ($cars_result && $cars_result->num_rows > 0) {
                    echo "<p>Cars:</p>";
                    while ($car_row = $cars_result->fetch_assoc()) {
                        echo "<p> - ID: " . $car_row["VoziloID"] . ", Brand: " . $car_row["Marka"] . ", Model: " . $car_row["Model"] . "</p>";
                    }
                } else {
                    echo "<p>No cars found for this user.</p>";
                }

                // Forma za brisanje korisnika
                echo "<form method='POST' action='".$_SERVER["PHP_SELF"]."'>";
                echo "<input type='hidden' name='delete_user' value='" . $row["VlasnikID"] . "'>";
                echo "<input type='submit' value='Delete User'>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }

        echo "<p>$message</p>"; 

        // Zatvaranje konekcije sa bazom podataka
        $conn->close();
        ?>


        <script>
            // JavaScript funkcija za odabir korisnika prilikom klika na okvir
            function selectUser(element) {
                var form = element.querySelector('form');
                form.querySelector('input[type="submit"]').click();
            }
        </script>
    </div>
</body>
</html>
