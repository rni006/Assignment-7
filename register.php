<html lang="en">
<head>
    <?php
    define("ACCESSKEY", "jf)93/KD84¤5&njd199");
    include "inc/meta.php" ?>
    <link rel="stylesheet" href="css/accessforms.css">
    <title>Iter Agency - Register</title>
</head>
<body onresize="init()" onload="init()">
<?php include "inc/nav.php"?>
<section id="register">
    <form action="">
        <legend>Register</legend>

        <label for="fname">First name <span>&#8226;</span></label>
        <input type="text" id="fname" required>

        <label for="lname">Last name <span>&#8226;</span></label>
        <input type="text" id="lname" required>

        <label for="email">Email <span>&#8226;</span></label>
        <input type="email" id="email" required>

        <label for="phone">Phone number <span>&#8226;</span></label>
        <input type="text" id="phone" required>

        <label for="username">Username <span>&#8226;</span></label>
        <input type="text" id="username" required>

        <label for="password">Password <span>&#8226;</span></label>
        <input type="password" pattern=".{6,}" title="Six or more characters" id="password" required>

        <label for="departurepoint">Preferred departure point </label>
        <select id="departurepoint" name="cars">
            <option value="moscow">Russia - Moscow</option>
            <option value="beijing">China - Beijing</option>
            <option value="washington">USA - Washington DC</option>
            <option value="dubai">UAE - Dubai</option>
        </select><span> &#8226;</span>

        <input type="submit" id="registerbutton" value="Register">

    </form>
</section>
<?php include "inc/footer.php"?>

</body>
</html>
