<?php
    session_start();
    include 'connection.php';

    if (isset($_POST['submit'])) {
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $query = mysqli_query($db, "SELECT * FROM user WHERE email = '$email' AND password = '$pass'");
        $num_rows = mysqli_num_rows($query);
        $row = mysqli_fetch_array($query);

        if ($num_rows > 0) {
            $_SESSION["id"] = $row['user_id']; // Store user ID in session

            // Successful login, redirect to homepage using JavaScript
            echo "<script>
                    alert('Welcome! You have successfully logged in. Hope you have a fun journey with us.');
                    window.location.href = 'index.html'; // Redirect to homepage
                  </script>";
            exit(); // Stop further code execution
        } else {
            echo "<script>alert('Invalid login credentials. Kindly check your username/password.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Log In</title>
        <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="login.css">
        <style>
            body {
                background: url('images/wallpaper.jpg');
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
        <script>
            function validateform() {
                var email = document.regform.email.value;
                var password = document.regform.pass.value;

                // Check if email is empty
                if (email == null || email == "") {
                    alert("Email-ID required");
                    email.focus();
                    return false;
                }
                // Check if email contains "@" symbol
                if (email.indexOf("@", 0) < 0) {
                    alert("Please enter a valid e-mail address.");
                    email.focus();
                    return false;
                }
                // Check if email contains a "." symbol
                if (email.indexOf(".", 0) < 0) {
                    alert("Please enter a valid e-mail address.");
                    email.focus();
                    return false;
                }
                // Check if password is at least 6 characters long
                if (password.length < 6) {
                    alert("Password must be at least 6 characters long.");
                    return false;
                }
                return true; // If all validations pass, submit the form
            }
        </script>
    </head>
    <body>
        <header>
            <div class="header" style="color:white;">
                <a href="homepage.html">
                    <img src="images/logo.png" width="35px" height="30px">
                    <h1 style="display: inline;">FITNESS 101</h1>
                </a>
                <div class="dropdown">
                    <button class="dropbtn">
                        <img src="images/user.png" width="40px" height="40px">
                    </button>
                    <div class="dropdown-content">
                        <a href="index.php">Log-In</a>
                        <a href="register.php">Sign-Up</a>
                    </div>
                </div>
            </div>
        </header>

        <nav>
            <div id="navigation">
                <a href="homepage.html">Home</a>
                <a href="health.php">Healthy Living</a>
                <a href="faq.html">FAQ</a>
                <a href="contactus.html">Contact Us</a>
                <a href="help.php">Help</a>
                <a href="member.php">Member's Area</a>
            </div>
        </nav>

        <form method="post" action="#" name="regform">
            <div style="background: rgba(121, 86, 86, 0.4);" id="login-box">
                <div class="left">
                    <h1>Log in</h1>

                    <input type="text" name="email" placeholder="E-mail" required>
                    <input type="password" name="pass" required placeholder="Password">

                    Not a member? <a href="register.php" style="color:black;">Sign-Up</a>
                    <br><br>
                    <input style="align-self: center;" type="submit" name="submit" value="Log in" onClick="return (validateform());">
                </div>
            </div>
        </form>

        <div class="right">
            <span class="loginwith">Log in with<br />social network</span>

            <button class="social-signin facebook" onclick="location.href='https://en-gb.facebook.com/login/'">Log in with Facebook</button>
            <button class="social-signin twitter" onclick="location.href='https://twitter.com/login?lang=en'">Log in with Twitter</button>
            <button class="social-signin google" onclick="location.href='https://accounts.google.com/signin/v2/identifier?flowName=GlifWebSignIn&flowEntry=ServiceLogin'">Log in with Google+</button>
        </div>
        <div class="or">OR</div>
    </body>
</html>
