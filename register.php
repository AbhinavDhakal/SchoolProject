<?php

session_start();
//If already logged in
if (isset($_SESSION['id'])) {
    echo '<script type="text/javascript">window.location="home.php"</script>';
    die();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css" />

    <script type="text/javascript">
        function validation() {
            let name = document.getElementById("name").value;
            let age = document.getElementById("age").value;
            let username = document.getElementById("username").value;
            let email = document.getElementById("email").value;
            let emailRe = document.getElementById("emailRe").value;
            let password = document.getElementById("pass").value;
            let passwordRe = document.getElementById("passRe").value;
            let gender = document.querySelector("input[name='genderRegister']:checked")?.value;

            if (name == undefined || name == null || name.trim() == "") {
                alert("Please provide your name!");
                return false;
            }
            if (name.length > 30) {
                alert("Name too long. Must be less than 30 characters.")
                return false;
            }

            if (isNaN(age) || age < 0 || age == "") {
                alert("Please enter a valid age!");
                return false;
            }

            console.log(typeof age);
            if (username == undefined || username == null || username.trim() == "") {
                alert("Please provide a username!");
                return false;
            }

            if (email.trim() == "" || email == undefined || email == null || email.length < 0) {
                alert("Please enter a email!");
                return false;
            }
            if (email.length > 30) {
                alert("Email too long. Must be less than 30 characters.")
                return false;
            }
            atpos = email.indexOf("@");
            dotpos = email.lastIndexOf(".");

            if (atpos < 1 || (dotpos - atpos < 2)) {
                alert("Please enter correct email ID")
                return false;
            }

            if (email.trim().toLowerCase() != emailRe.trim().toLowerCase()) {
                alert("Please enter same email in both fields!");
                return false;
            }
            if (password == undefined || password == null || password.trim() == "") {
                alert("Please provide a password!");
                return false;
            }
            if (password.length > 30) {
                alert("Password too long. Must be less than 30 characters.")
                return false;
            }
            if (password != passwordRe) {
                alert("Please enter same password in both fields!");
                return false;
            }

            if (gender == undefined || gender == "") {
                alert("Please select a gender!");
                return false;
            }

            return (true);

        }
    </script>

</head>



<body id="register">
    <nav>
        <a href="index.html">Home</a>
    </nav>

    <main>

        <br><br><br>

        <h1>Register</h1>

        <form method="post" id="registerForm" onsubmit="return validation()">
            <!--Full Name Input-->
            <div>
                <label for="name">Full Name:</label><br>
                <input type="text" name="nameRegister" id="name" class="input"> <br>
            </div>





            <!-- Username Input -->
            <div>
                <label for="email">Username:</label><br>
                <input type="text" name="usernameRegister" id="username" class="input">
                <br>
            </div>



            <div class="break"></div>
            <!--Break-->

            <!--Email Input-->
            <div>
                <label for="email">Email:</label><br>
                <input type="text" name="emailRegister" id="email" class="input">
            </div>

            <!-- Re-Email Input -->
            <div>
                <label for="emailRe">Re-enter Email:</label><br>
                <input type="text" id="emailRe" class="input">
            </div>

            <div class="break"></div>
            <!--Break-->


            <!--Password Input-->
            <div>
                <label for="pass">Password:</label><br>
                <input type="password" name="passwordRegister" id="pass" class="input"> <br>
            </div>

            <!-- Re-Password Input -->
            <div>
                <label for="passRe">Re-enter Password:</label><br>
                <input type="password" id="passRe" class="input"><br>
            </div>

            <div class="break"></div>
            <!--Break-->

            <!-- Age Input -->
            <div>
                <label for="age">Age:</label><br>
                <input type="number" name="ageRegister" id="age" class="input"> <br>
            </div>

            <!--Gender Radio Buttons-->

            <div>
                <label>Gender:</label><br>
<div id="gender">
                <input type="radio" name="genderRegister" value="male">Male
                <input type="radio" name="genderRegister" value="female">Female
                <input type="radio" name="genderRegister" value="other">Other
</div>
                <br>
            </div>


            <div class="break"></div>
            <!--Break-->


            <!--Submit Button-->
            <div class="submit">
                <input type="submit" value="Submit" class="button">
                Already have an account? <a href="login.php">Login</a>
            </div>

        </form>

    </main>


</body>


<?php




if ($_POST) {

    // Get datas from post. 
    $name = htmlspecialchars($_POST["nameRegister"]);
    $age = htmlspecialchars($_POST["ageRegister"]);
    $username = htmlspecialchars($_POST["usernameRegister"]);
    $email = htmlspecialchars($_POST["emailRegister"]);
    $password = htmlspecialchars($_POST["passwordRegister"]);
    $gender = htmlspecialchars($_POST["genderRegister"]);

	//Create connection and connect to database
   $connection=mysqli_connect("localhost", "id16492889_dhakal", "Abhinav@12345", "id16492889_schoolproject");
    //Queries


    //Check if email or username already registered

    $query1 = "SELECT * FROM accounts WHERE username='$username'";


    $result1 = mysqli_query($connection, $query1);
    if (mysqli_num_rows($result1)) {
        die("<script>alert('Username already exists.');</script>");
    }

    $query2 = "SELECT * FROM accounts WHERE email='$email'";


    $result2 = mysqli_query($connection, $query2);

    if (mysqli_num_rows($result2)) {
        die("<script>alert('Email already exists.')</script>");
    }




    //Register new email
    $query3 = "INSERT INTO accounts (name,age,username,email,password,gender) Values('$name','$age','$username','$email','$password','$gender')";

    $result3 = mysqli_query($connection, $query3);
    if ($result3) {

        echo "<script>alert('Successfully Registered, Now you can login to access your account.');
        window.location='login.php';
        </script>";
    } else {
        $error = mysqli_error($connection);
        echo "<script>
        alert('Sorry, registration failed.');
        </script>";
        echo $error;
    }
}

?>


<!--Trying to remove watermark, Ignore this-->
<script>
    document.querySelectorAll('a[href*="000webhost"]').forEach(e => e.remove());
</script>

</html>
