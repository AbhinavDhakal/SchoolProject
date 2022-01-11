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

				//Create connection and connect to database
   $connection=mysqli_connect("localhost", "id16492889_dhakal", "Abhinav@12345", "id16492889_schoolproject");


            if ($_SESSION['id'] ) {
                $id = $_SESSION["id"];

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
                    echo "<br><br>Gender: " . $row["gender"];}
				

            } else {
                echo '<script type="text/javascript">window.location = "login.php"</script>';
}
            ?>
        </div>
<div id='adminPanel'>

<?php
if($_SESSION['id']==1){
	$query2 = "SELECT * FROM accounts";
	$result2 = mysqli_query($connection,$query2);
	if($result2){
		echo"<h2>Database</h2>";
		echo "<table border=1><tr><th>Id</th><th>Name</th><th>Age</th><th>Gender</th><th>Username</th><th>Email</th><th>Password</th></tr>";
		while($row2 = mysqli_fetch_assoc($result2)){
			if($row2['id']==1) continue;
			echo "<tr><th>".$row2['id']."</th><th>".$row2['name']."</th><th>".$row2['age']."</th><th>".$row2['gender']."</th><th>".$row2['username']."</th><th>".$row2['email']."</th><th>".$row2['password']."</th><tr>";
		}
		echo "</table>";
	}
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
