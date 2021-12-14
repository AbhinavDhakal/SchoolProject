<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css" />

</head>

<body id="home">
    <nav>
        <a href="./index.html">Home</a>
        <a href="./logout.php">Logout</a><br><br>
    </nav>
    <main>
        <h1>Welcome!</h1>
        <div class="result">
            <?php
            if ($_SESSION['id']) {

                $id = $_SESSION["id"];

                //Create connection and connect to database
                // $connection = mysqli_connect("localhost", "root", "", "SchoolProject");
                $connection = mysqli_connect("localhost", "id16492889_dhakal", "Abhinav@12345", "id16492889_schoolproject");

                //Queries


                //Select data
                $query = "SELECT * FROM accounts WHERE id = '$id' ";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<h2>Your Infos:</h2><br>";
                    echo "Name: " . $row["name"];
                    echo "<br><br>Username: " . $row["username"];
                    echo "<br><br>Email: " . $row["email"];
                    echo "<br><br>Age: " . $row["age"];
                    echo "<br><br>Gender: " . $row["gender"];
                }
            } else {
                echo '<script type="text/javascript">window.location = "login.php"</script>';
            }
            ?>
        </div>
    </main>
</body>
<!--Trying to remove watermark, Ignore this-->
<script>
    document.querySelectorAll('a[href*="000webhost"]').forEach(e => e.remove());
</script>

</html>