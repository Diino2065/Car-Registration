<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
    <style>
        body {
            font-family: cursive, Helvetica, sans-serif;
            background-image: url("pozadina.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .car-info {
            margin-bottom: 10px;
            cursor: pointer;
        }

        form {
            margin-top: 10px;
        }

        
        input[type="submit"] {
            background-color: #add8e6;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease; 
        }

        input[type="submit"]:hover {
            background-color: #87ceeb; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Data</h2>

        <!-- forma za update registracije -->
        <form method="POST" action="update_data.php">
            <!-- Skriveni input za označavanje vrste ažuriranja -->
            <input type="hidden" name="update_type" value="registration">
            <label for="car_id_reg">Select Car for Registration Update:</label>
            <select name="car_id_reg" id="car_id_reg">
                <!-- Dinamički popunjavanje opcija iz baze podataka -->
                <?php
                // konekcija 
                include 'db.php';

                // kupi vozila 
                $cars_sql_reg = "SELECT * FROM Vozilo";
                $cars_result_reg = $conn->query($cars_sql_reg);

                if ($cars_result_reg->num_rows > 0) {
                    while ($car_row_reg = $cars_result_reg->fetch_assoc()) {
                        echo "<option value='" . $car_row_reg["VoziloID"] . "'>" . $car_row_reg["Marka"] . " " . $car_row_reg["Model"] . " (" . $car_row_reg["RegistracijaTablica"] . ")" . "</option>";
                    }
                } else {
                    echo "<option value=''>No cars available</option>";
                }
                ?>
            </select>
            <br>
            <!-- Polje za unos početnog datuma registracije -->
            <label for="start_date_reg">Registration Start Date:</label>
            <input type="date" id="start_date_reg" name="start_date_reg" required>
            <br>
            <!-- Polje za unos završnog datuma registracije -->
            <label for="end_date_reg">Registration End Date:</label>
            <input type="date" id="end_date_reg" name="end_date_reg" required>
            <br>
            <!-- Dugme za ažuriranje registracije -->
            <input type="submit" value="Update Registration">
        </form>

        <!-- forma za update vozila -->
        <form method="POST" action="update_data.php">
            <!-- Skriveni input za označavanje vrste ažuriranja -->
            <input type="hidden" name="update_type" value="vehicle">
            <label for="car_id_vehicle">Select Car for Vehicle Update:</label>
            <select name="car_id_vehicle" id="car_id_vehicle">
                <!-- Dinamički popunjavanje opcija iz baze podataka -->
                <?php
                //kupi vozila 
                $cars_sql_vehicle = "SELECT * FROM Vozilo";
                $cars_result_vehicle = $conn->query($cars_sql_vehicle);

                if ($cars_result_vehicle->num_rows > 0) {
                    while ($car_row_vehicle = $cars_result_vehicle->fetch_assoc()) {
                        echo "<option value='" . $car_row_vehicle["VoziloID"] . "'>" . $car_row_vehicle["Marka"] . " " . $car_row_vehicle["Model"] . " (" . $car_row_vehicle["RegistracijaTablica"] . ")" . "</option>";
                    }
                } else {
                    echo "<option value=''>No cars available</option>";
                }
                ?>
            </select>
            <br>
            
            <label for="new_brand">New Brand:</label>
            <input type="text" id="new_brand" name="new_brand" required>
            <br>
           
            <label for="new_model">New Model:</label>
            <input type="text" id="new_model" name="new_model" required>
            <br>
            
            <label for="new_year">New Year of Manufacture:</label>
            <input type="number" id="new_year" name="new_year" min="1900" max="2099" required>
            <br>
           
            <label for="new_color">New Color:</label>
            <input type="text" id="new_color" name="new_color" required>
            <br>
           
            <input type="submit" value="Update Vehicle">
        </form>

        <!-- Forma za update korisnika -->
        <form method="POST" action="update_data.php">
            <!-- Skriveni input za označavanje vrste ažuriranja -->
            <input type="hidden" name="update_type" value="user">
            <label for="user_id">Select User for Update:</label>
            <select name="user_id" id="user_id">
                <!-- Dinamički popunjavanje opcija iz baze podataka -->
                <?php
                //kupi user-e 
                $users_sql = "SELECT * FROM Vlasnik";
                $users_result = $conn->query($users_sql);

                if ($users_result->num_rows > 0) {
                    while ($user_row = $users_result->fetch_assoc()) {
                        echo "<option value='" . $user_row["VlasnikID"] . "'>" . $user_row["Ime"] . " " . $user_row["Prezime"] . " (" . $user_row["Email"] . ")" . "</option>";
                    }
                } else {
                    echo "<option value=''>No users available</option>";
                }
                ?>
            </select>
            <br>
            
            <label for="new_first_name">New First Name:</label>
            <input type="text" id="new_first_name" name="new_first_name" required>
            <br>
       
            <label for="new_last_name">New Last Name:</label>
            <input type="text" id="new_last_name" name="new_last_name" required>
            <br>
           
            <label for="new_address">New Address:</label>
            <input type="text" id="new_address" name="new_address" required>
            <br>
           
            <label for="new_phone">New Phone Number:</label>
            <input type="text" id="new_phone" name="new_phone" required>
            <br>
         
            <label for="new_email">New Email:</label>
            <input type="email" id="new_email" name="new_email" required>
            <br>
           
            <input type="submit" value="Update User">
        </form>
    </div>
</body>

</html>
