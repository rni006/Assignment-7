<?php
session_start();

if(isset($_SESSION['login'])) {
    if ($_SESSION['login'] == "admin"){
        header('LOCATION:admin.php');
        die();
    } elseif ($_SESSION['login'] == "user"){
        header('LOCATION:index.php');
        die();
    }
}

?>
<html lang="en">
<head>
    <?php
    define("ACCESSKEY", "jf)93/KD84¤5&njd199");
    include "inc/meta.php" ?>
    <link rel="stylesheet" href="css/accessforms.css">
    <style>
        #loginform{
            display: none;
        }
    </style>
    <title>Итер - Login</title>
</head>
<body onload="init()">
<?php include "inc/nav.php"?>
<section id="login">
    <?php
    include "inc/connection.php";
    if(isset($_POST['Login'])){
        $serial = check($_POST['serial_code']);
        $password = check($_POST['password']);

        $sql = "SELECT * FROM iter_users WHERE serial_code = $serial";
        $result = mysqli_query($conn, $sql);

        //checks username
        if ($result){
            $row = $result->fetch_assoc();
            //checks password
            if (password_verify($password, $row["password"])){

                if ($row["type"] == "admin"){
                    $_SESSION['login'] = "admin";
                    $_SESSION["serial"]= $serial;
                    header('LOCATION:admin.php');

                }else{
                    $_SESSION['login'] = "user";
                    $_SESSION["serial"]= $serial;
                    header('LOCATION:index.php');
                }
            }else {
                echo "<div class='error'><h1>Wrong serial and password combination</h1></div>";
            }
        } else {
            echo "<div class='error'><h1>Wrong serial and password combination</h1></div>";
        }
    }

    ?>

    <form class = "modularForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <legend>Sign in</legend>

        <label for="serial_code">Serial Number</label>
        <input type="text" id="serial_code" name="serial_code"  required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" id="loginbutton" value="Login" name="Login">
    </form>

    <form  class = "modularForm"  action="register.php">
        <legend>Sign up</legend>
        <input type="submit" id="submit" value="Register">
    </form>
</section>
<?php include "inc/footer.php"?>

</body>
</html>
