<html lang="en">
<head>
    <?php
    define("ACCESSKEY", "jf)93/KD84¤5&njd199");
    include "inc/meta.php" ?>
    <link rel="stylesheet" href="css/accessforms.css">
    <title>Iter Agency</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php#intro">[Logo]</a> </li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="index.php#experience">Experience</a></li>
            <li><a href="index.php#events">Events</a></li>
            <li><a href="index.php#stay">Stay</a></li>
            <li id="buffer"></li>
        </ul>
    </nav>
</header>
<section id="login">
    <form action="">
        <legend>Login</legend>

        <label for="username">Username</label>
        <input type="text" id="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" required>

        <input type="submit" id="loginbutton" value="Login">
    </form>

    <form action="register.php">
        <legend>Register</legend>
        <input type="submit" id="submit" value="Register">
    </form>
</section>
<?php include "inc/footer.php"?>

</body>
</html>
