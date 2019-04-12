<?php
if (ACCESSKEY == "jf)93/KD84¤5&njd199"){

    $host = "localhost";
    $username = "dk205GR3_19";
    $password = "CrguGuutG1i1bmxX";
    $database = "dk205GR3_19";

    $conn = new mysqli($host, $username, $password, $database);

    if (mysqli_connect_errno()) {
        echo "<script>alert('could not connect')</script>";
        die("Cannot connect to database");
    }

    //database input security check tool
    function check($data) {
        $data = trim($data);
        $data = strip_tags($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
