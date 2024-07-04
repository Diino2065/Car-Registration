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
            background-attachment: fixed; /* Pozadina se ne pomjera*/
            margin: 0;
            padding: 0;
        }

        
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Prozirna pozadina */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }

        h2 {
            color: #333; 
            margin-bottom: 20px;
        }

        .user-info {
            margin-bottom: 20px;
            cursor: pointer;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

      
        .user-info:hover {
            background-color: #f0f0f0; 
        }

        .car-info {
            display: none; /* Podaci o vozilima su sakvriveni (po defaultu je ovo) */
            margin-bottom: 10px;
            border-left: 3px solid #ccc; 
            padding: 10px;
            border-radius: 0 0 5px 5px; 
        }

        /* Stilizacija naslova za podatke o vozilima */
        .cars-heading {
            margin-top: 20px;
        }

        .no-users-info {
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9; /* Pozadina za oznaku bez korisnika */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Information</h2>
        <?php
        // Uključivanje veze sa bazom podataka
        include 'db.php';

        // Upit za dohvat podataka o vlasnicima
        $sql = "SELECT * FROM Vlasnik";
        $result = $conn->query($sql);

        // Provjera da li ima podataka
        if ($result->num_rows > 0) {
            // Prolazak kroz podatke o vlasnicima
            while ($row = $result->fetch_assoc()) {
                // Prikaz informacija o vlasniku
                echo "<div class='user-info' onclick='toggleDetails(\"details_" . $row["VlasnikID"] . "\")'>";
                echo "ID: " . $row["VlasnikID"] . "<br>";
                echo "Name: " . $row["Ime"] . " " . $row["Prezime"] . "<br>";
                echo "Address: " . $row["Adresa"] . "<br>";
                echo "Email: " . $row["Email"] . "<br>";
                echo "Phone: " . $row["BrojTelefona"] . "<br>";
                echo "<div class='car-info' id='details_" . $row["VlasnikID"] . "' style='display: none;'>";

                // Upit za dohvat podataka o vozilima vlasnika
                $cars_sql = "SELECT * FROM Vozilo WHERE VlasnikID=" . $row["VlasnikID"];
                $cars_result = $conn->query($cars_sql);
                // Provjera da li ima podataka o vozilima
                if ($cars_result->num_rows > 0) {
                    echo "<h2 class='cars-heading'>Cars Information</h2>";
                    // Prolazak kroz podatke o vozilima
                    while ($car_row = $cars_result->fetch_assoc()) {
                        echo "Car ID: " . $car_row["VoziloID"] . "<br>";
                        echo "Registration Plate: " . $car_row["RegistracijaTablica"] . "<br>";
                        echo "Brand: " . $car_row["Marka"] . "<br>";
                        echo "Model: " . $car_row["Model"] . "<br>";
                        echo "Production Year: " . $car_row["GodinaProizvodnje"] . "<br>";
                        echo "Color: " . $car_row["Boja"] . "<br><br>";
                    }
                } else {
                    echo "No cars information available for this user.<br>";
                }

                echo "</div>"; // car info div
                echo "</div>"; // user info div
            }
        } else {
            echo "No users available."; 
        }

        // Upit za dohvat podataka o vozilima bez vlasnika
        $all_cars_sql = "SELECT * FROM Vozilo WHERE VlasnikID IS NULL";
        $all_cars_result = $conn->query($all_cars_sql);
        // Provjera da li ima podataka o vozilima bez vlasnika
        if ($all_cars_result->num_rows > 0) {
            echo "<h2 class='cars-heading'>Cars that the owners abondend </h2>";
            // Prolazak kroz podatke o vozilima bez vlasnika
            while ($car_row = $all_cars_result->fetch_assoc()) {
                echo "Car ID: " . $car_row["VoziloID"] . "<br>";
                echo "Registration Plate: " . $car_row["RegistracijaTablica"] . "<br>";
                echo "Brand: " . $car_row["Marka"] . "<br>";
                echo "Model: " . $car_row["Model"] . "<br>";
                echo "Production Year: " . $car_row["GodinaProizvodnje"] . "<br>";
                echo "Color: " . $car_row["Boja"] . "<br><br>";
            }
        } else {
            echo "<div class='no-users-info'>No cars information available without users.</div>"; // Poruka kad nema vozila bez vlasnika
        }

        $conn->close();
        ?>

        <script>
            // JavaScript funkcija za prikaz/sakrivanje detalja o vozilima
            function toggleDetails(id) {
                var details = document.getElementById(id);
                if (details.style.display === "block") {
                    details.style.display = "none";
                } else {
                    details.style.display = "block";
                }
            }
        </script>
    </div>
</body>
</html>
