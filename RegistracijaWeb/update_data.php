<?php
// konekcija 
include 'db.php';

// Provjera je li forma submitana,provjeri je li forma poslana metodom POST i je li postavljen update_type
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_type"])) {
    $update_type = $_POST["update_type"];

    if ($update_type == "registration") {
        // Update ili insert registracije 
        if (isset($_POST["car_id_reg"]) && isset($_POST["start_date_reg"]) && isset($_POST["end_date_reg"])) {
            $car_id_reg = $_POST["car_id_reg"];
            $start_date_reg = $_POST["start_date_reg"];
            $end_date_reg = $_POST["end_date_reg"];

            // kalkulacija naspram kategorije 
            $kategorija_sql = "SELECT Kategorija FROM Vozilo WHERE VoziloID=$car_id_reg";
            $kategorija_result = $conn->query($kategorija_sql);
            if ($kategorija_result->num_rows > 0) {
                $kategorija_row = $kategorija_result->fetch_assoc();
                $kategorija = $kategorija_row["Kategorija"];

                switch ($kategorija) {
                    case 'A':
                        $cijena = 300;
                        break;
                    case 'B':
                        $cijena = 600;
                        break;
                    default:
                        $cijena = 1000;
                        break;
                }

                // Update ili insert naspram kalkulacije 
                $check_sql_reg = "SELECT * FROM Registracija WHERE VoziloID=$car_id_reg";
                $check_result = $conn->query($check_sql_reg);

                if ($check_result->num_rows > 0) {
                    // postoji update reg 
                    $update_sql_reg = "UPDATE Registracija SET DatumRegistracije='$start_date_reg', DatumIstekaRegistracije='$end_date_reg', Cijena=$cijena WHERE VoziloID=$car_id_reg";
                    if ($conn->query($update_sql_reg) === TRUE) {
                        echo "Registration updated successfully!";
                    } else {
                        echo "Error updating registration: " . $conn->error;
                    }
                } else {
                    // ne postoji insert reg 
                    $insert_sql_reg = "INSERT INTO Registracija (VoziloID, DatumRegistracije, DatumIstekaRegistracije, Cijena) VALUES ($car_id_reg, '$start_date_reg', '$end_date_reg', $cijena)";
                    if ($conn->query($insert_sql_reg) === TRUE) {
                        echo "New registration inserted successfully!";
                    } else {
                        echo "Error inserting new registration: " . $conn->error;
                    }
                }
            } else {
                echo "Error: Car not found.";
            }
        }
    } elseif ($update_type == "vehicle") {
        // Update vozilo 
        if (isset($_POST["car_id_vehicle"]) && isset($_POST["new_brand"]) && isset($_POST["new_model"]) && isset($_POST["new_year"]) && isset($_POST["new_color"])) {
            $car_id_vehicle = $_POST["car_id_vehicle"];
            $new_brand = $_POST["new_brand"];
            $new_model = $_POST["new_model"];
            $new_year = $_POST["new_year"];
            $new_color = $_POST["new_color"];

            $update_sql_vehicle = "UPDATE Vozilo SET Marka='$new_brand', Model='$new_model', GodinaProizvodnje=$new_year, Boja='$new_color' WHERE VoziloID=$car_id_vehicle";
            if ($conn->query($update_sql_vehicle) === TRUE) {
                echo "Vehicle updated successfully!";
            } else {
                echo "Error updating vehicle: " . $conn->error;
            }
        }
    } elseif ($update_type == "user") {
        // Update user 
        if (isset($_POST["user_id"]) && isset($_POST["new_first_name"]) && isset($_POST["new_last_name"]) && isset($_POST["new_address"]) && isset($_POST["new_phone"]) && isset($_POST["new_email"])) {
            $user_id = $_POST["user_id"];
            $new_first_name = $_POST["new_first_name"];
            $new_last_name = $_POST["new_last_name"];
            $new_address = $_POST["new_address"];
            $new_phone = $_POST["new_phone"];
            $new_email = $_POST["new_email"];

            $update_sql_user = "UPDATE Vlasnik SET Ime='$new_first_name', Prezime='$new_last_name', Adresa='$new_address', BrojTelefona='$new_phone', Email='$new_email' WHERE VlasnikID=$user_id";
            if ($conn->query($update_sql_user) === TRUE) {
                echo "User updated successfully!";
            } else {
                echo "Error updating user: " . $conn->error;
            }
        }
    } else {
        echo "Invalid update type.";
    }
} else {
    echo "Form submission error.";
}

$conn->close();
?>
