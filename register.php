<html lang="en">
<head>
    <?php
    define("ACCESSKEY", "jf)93/KD84¤5&njd199");
    include "inc/meta.php" ?>
    <link rel="stylesheet" href="css/accessforms.css">
    <title>Итер - Register</title>
</head>
<body onload="init()">
<?php include "inc/nav.php"?>
<section id="register">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
        <legend>Register</legend>

        <label for="serial">Insert your serial number<span>&#8226;</span></label>
        <input type="text" id="serial" name="serial" required>

        <!-- <label for="lname">Last name <span>&#8226;</span></label>
        <input type="text" id="lname" required>

        <label for="email">Email <span>&#8226;</span></label>
        <input type="email" id="email" required>

        <label for="phone">Phone number <span>&#8226;</span></label>
        <input type="text" id="phone" required>

        <label for="username">Username <span>&#8226;</span></label>
        <input type="text" id="username" required> -->

        <label for="password1">Choose a password <span>&#8226;</span></label>
        <input type="password" name="password1" pattern=".{6,}" title="Six or more characters" id="password1" required>

        <label for="password2">Repeat password <span>&#8226;</span></label>
        <input type="password" name="password2" pattern=".{6,}" title="Six or more characters" id="password2" required>

        <!--
        <label for="departurepoint">Preferred departure point <span>&#8226;</span> </label>
        <select id="departurepoint" name="cars">
            <option value="moscow">Russia - Moscow</option>
            <option value="beijing">China - Beijing</option>
            <option value="washington">USA - Washington DC</option>
            <option value="dubai">UAE - Dubai</option>
        </select>
        -->

        <input type="submit" id="registerbutton" value="Register">

    </form>

    <?php
    include "inc/connection.php";


    if ( isset($_POST["serial"]) && isset($_POST["password1"]) && isset($_POST["password2"]) ){
        $serial = check($_POST["serial"]);
        $pass1 = check($_POST["password1"]);
        $pass2 = check($_POST["password2"]);
        $pass = null;

        # makes sure the two emails match
        if ($pass1 != $pass2){
            echo "<script type='text/javascript'> alert('the passwords are not identical');</script>";
            die();

        }else{
            $pass1 = password_hash($pass1, PASSWORD_DEFAULT);
        }

        $query = "INSERT INTO iter_users 
                  VALUES ('$serial','$pass1', NULL, NULL)";

        $result = $conn->query($query);
        if ($result === TRUE) {
            echo '<script language="javascript">';
            echo 'alert("Registration complete.")';
            echo '</script>';
            header('LOCATION:login.php');
        } else {
            $err = $conn->error;
            echo '<script language="javascript">';
            echo 'alert("Sorry: '.$err.'")';
            echo '</script>';
        }
    }
    $conn->close();






    ?>
</section>
<?php include "inc/footer.php"?>

</body>
</html>
