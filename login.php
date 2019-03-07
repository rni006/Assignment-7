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
    <form action="">
        <legend>Sign in</legend>

        <label for="username">Serial Number</label>
        <input type="text" id="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" required>

        <input type="submit" id="loginbutton" value="Login">
    </form>

    <form action="register.php">
        <legend>Sign up</legend>
        <input type="submit" id="submit" value="Register">
    </form>
</section>
<?php include "inc/footer.php"?>

</body>
</html>
