<?php

session_start();
//check If already logged in
if (isset($_SESSION['id'])) {
    //Send to home if a session is already running
    echo '<script type="text/javascript">window.location="home.php"</script>';
    die();
} ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css" />


    <script type="text/javascript">
        function validation() {

            let user = document.getElementById("user").value;
            let password = document.getElementById("pass").value;

            if (user == undefined || user == null || user.trim() == "") {
                alert("Please provide your username/email!");
                return false;
            }
            if (user.length > 30) {
                alert("Username/Email too long. Must be less than 30 characters.")
                return false;
            }

            if (user.includes("@")) {
                atpos = user.indexOf("@");
                dotpos = user.lastIndexOf(".");
                if (atpos < 1 || (dotpos - atpos < 2)) {
                    alert("Please enter correct email ID")
                    return false;
                }
            }


            if (password == undefined || password == null || password.trim() == "" || password.length < 0) {
                alert("Please provide a password!");
                return false;
            }
            if (password.length > 30) {
                alert("Password too long. Must be less than 30 characters.")
                return false;
            }

            return true;
        }






        function wrongUsername() {
            document.getElementById('userError').innerText = 'User/Email doesn\'t exist. Try with correct email.';
        }

        function wrongPassword() {
            document.getElementById('passError').innerText = 'Wrong Password.....';
        }
    </script>

</head>

<body id="login">

    <nav>
        <a href="index.html">Home</a>
    </nav>
    <main>


        <br><br><br>
        <h1>Login</h1>
        <form method="post" id="loginForm" onsubmit="return validation()">


            <!--Email -->
            <label for="user">Username or Email:</label><br>
            <input type="text" name="userLogin" id="user" class="input">
            <span style="color: red;" id="userError"></span><br>

            <!--Password-->
            <label for="pass">Password:</label><br>
            <input type="password" name="passwordLogin" id="pass" class="input">
            <span style="color: red;" id="passError"></span><br>


            <!--Submit Button-->
            <input type="submit" value="Submit" class="button"><br>
            Don't have an account?
            <a href="register.php">Register</a><br><br>

        </form>

    </main>

</body>


<?php



if ($_POST) {

    // Get datas from post. 
    $enteredUser = $_POST["userLogin"];
    $enteredPassword = $_POST["passwordLogin"];


    //Create connection and connect to database
    // $connection = mysqli_connect("localhost", "root", "", "SchoolProject");
    $connection = mysqli_connect("localhost", "id16492889_dhakal", "Abhinav@12345", "id16492889_schoolproject");

    //Queries


    //Select data
    $query = "SELECT * FROM accounts WHERE email='$enteredUser' || username='$enteredUser' ";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row["id"];
        $password = $row["password"];
        $username = $row["username"];
        if ($enteredPassword == $password) {

            // storing id to the session and redirect to home.php where id is used to fetch data.
            $_SESSION["id"] = $id;
            echo '<script>window.location = "home.php"</script>';
            die();
        } else {
            echo "<script>
            alert('Wrong Password, Please try again with a correct one!')
            </script>";
        }
    } else {
        echo "<script>
        alert('Wrong Username/Email, Please try again with a correct one!')
        </script>";
    }
}
?>
<!--Trying to remove watermark, Ignore this-->
<script>
    document.querySelectorAll('a[href*="000webhost"]').forEach(e => e.remove());
</script>

</html>