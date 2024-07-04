<!DOCTYPE html>
<html lang="en">
<head>
    <!-- karakter set za latinicu -->
    <meta charset="UTF-8">
    <!-- Viewport za responzivnost ->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>Welcome Page</title>
  
    <style>
        /* Body styling */
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

        /* Main kont styling */
        .container {
            width: 400px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            color: black;
        }

        /* Heading 2 */
        h2 {
            margin-top: 10px;
        }

        /* Form styling */
        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Input field styling u formi */
        form input[type="text"],
        form input[type="password"] {
            margin-bottom: 10px;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            width: calc(100% - 22px);
            box-sizing: border-box;
        }

        /* Submit button styling u formi */
        form button[type="submit"] {
            margin-top: 15px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: calc(100% - 22px);
            box-sizing: border-box;
            background-color: lightblue;
            color: black;
            cursor: pointer;
            font-family: cursive, Helvetica, sans-serif;
        }

        /* Hover efekt za submit  */
        form button[type="submit"]:hover {
            background-color: white;
            font-family: cursive, Helvetica, sans-serif;
        }

        /* P styling */
        p {
            text-align: center;
            margin-top: 10px;
            color: black;
        }
    </style>
</head>
<body>
    <!-- Main kont -->
    <div class="container">
        
        <h2>Welcome</h2>
        <hr>

        <h3>Choose an option</h3>

        <!-- Forma za prikaz podataka -->
        <form action="read.php" method="GET">
            <button type="submit">View Data</button>
        </form>

        <!-- Forma za brisanje -->
        <form action="delete.php" method="GET">
            <button type="submit">Delete Data</button>
        </form>

        <!-- Forma za update -->
        <form action="update.php" method="GET">
            <button type="submit">Update Data</button>
        </form>

        <!-- Forma za input  -->
        <form action="create.php" method="GET">
            <button type="submit">Input Data</button>
        </form>
    </div>
</body>
</html>
