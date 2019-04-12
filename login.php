<?php
session_start();
if(isset($_SESSION['admin'])) {
    header('LOCATION:admin.php');
    die();
}
if(isset($_SESSION['user'])) {
    header('LOCATION:index.php');
    die();
}
?>
<html lang="en">
<head>
    <?php
    define("ACCESSKEY", "jf)93/KD84¤5&njd199");
    include "inc/meta.php" ?>
    <link rel="stylesheet" href="css/accessforms.css">
    <title>Итер - Login</title>
</head>
<body onload="init()">
<?php include "inc/nav.php"?>
<section id="login">
    <?php
    include "inc/connection.php";
    if(isset($_POST['Login'])){
        echo "<h1>you tried to log in</h1>";
        $serial = check($_POST['serial_code']);
        $password = check($_POST['password']);

        $sql = "SELECT * FROM iter_users WHERE serial_code = $serial";
        $result = mysqli_query($conn, $sql);

        //checks username
        if (mysqli_num_rows($result) > 0){
            $row = $result->fetch_assoc();
            echo "<h1>your username was found: " . $row["serial_code"] . "</h1>";

            //checks password
            if (password_verify($password, $row["password"])){
                echo "<h1>password is valid</h1>";
            }else {
                echo "<h1>password is invalid. you entered: ". password_hash($password,PASSWORD_DEFAULT) ." expected pass: " . $result["password"] . "</h1>";
            }
        } else {
            echo "<h1>Wrong serial code or password</h1>";
            die("wrong user/pass");
        }

        /*
        if (!$result){
            echo "<h1>Wrong serial code or password</h1>";
            die("wrong user/pass");
        }
        else {
            echo "<h1>your username was found: " . $result["serial_code"] . "</h1>";

            if (password_verify($password, $row["password"])){
                echo "<h1>password is valid</h1>";
            }else {
                echo "<h1>password is invalid. you entered: ". password_hash($password,PASSWORD_DEFAULT) ." expected pass: " . $result["password"] . "</h1>";
            }
        }

        */

        /*
        if ($row == "admin"){
            $_SESSION["admin"] = true;
            header('LOCATION:admin.php');
            die();
        }elseif ($row == "user"){
            $_SESSION["user"] = true;
            header('LOCATION:index.php');
            die();
        }else{
            echo "404: DB ERROR";
        }*/
    }

    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <legend>Sign in</legend>

        <label for="serial_code">Serial Number</label>
        <input type="text" id="serial_code" name="serial_code"  required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" id="loginbutton" value="Login" name="Login">
    </form>

    <form action="register.php">
        <legend>Sign up</legend>
        <input type="submit" id="submit" value="Register">
    </form>
</section>
<?php include "inc/footer.php"?>

</body>
</html>
