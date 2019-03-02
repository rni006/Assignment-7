<!--
username: admin
password: password123
-->
<?php
/*
session_start();
# checks to see if the user is logged in as an admin. if not, user is sent to the login page
if (!isset($_SESSION['login'])){
    header('LOCATION:login.php');
    die();
}*/
?>
<html lang="en">
<head>
    <?php
    define("ACCESSKEY", "jf)93/KD84¤5&njd199");
    include "inc/meta.php";
    include "inc/connection.php";
    include 'ChromePhp.php';
    ?>
    <link rel="stylesheet" href="css/accessforms.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>Iter Agency - Admin</title>
</head>
<body onload="init()">
<?php
# remember to change nav.php so that the login button changes to logout if a user is logged in.
include "inc/nav.php";
?>
<section id="events_handler">
    <?php
    # inserts input data into database
    if (isset($_POST['submit']) && $_POST['submit'] == "Add event"){
        $title = check($_POST['title']);
        $description = check($_POST['description']);
        $location = check($_POST['location']);
        $date = check($_POST['date']);

        $query = "INSERT INTO iter_events
              VALUES ('$title','$description', '$location', '$date', null)";

        $results = $conn->query($query);

        if ($results === True) {
            echo '<script language="javascript">';
            echo 'alert("Row added successfully")';
            echo '</script>';
        } else {
            $error = $conn->error;
            $message = 'Error:'.$error;
            echo '<script language="javascript">';
            echo 'alert("'.$message.'")';
            echo '</script>';
        }
    }
    ?>
    <h1>Add event</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description</label>
        <textarea rows="15" name="description" id="description"></textarea>

        <label for="location">Location</label>
        <input type="text" name="location" id="location">

        <label for="date">Date</label>
        <input type="date" name="date" id="date">

        <input type="submit" name="submit" id="submit" value="Add event">
    </form>
    </div>
</section>
<section>
    <h1>Events</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Location</th>
            <th>Description</th>
            <th></th>
        </tr>
        <?php
        # deletes a selected item from the database
        if (isset($_POST['submit']) && $_POST['submit'] == "delete"){
            $deleteid = $_POST['msgid'];
            $deletequery = "DELETE FROM iter_events WHERE id = $deleteid";
            $result = $conn->query($deletequery);
            if ($result === TRUE) {
                echo '<script language="javascript">';
                echo 'alert("Row successfully deleted")';
                echo '</script>';
            } else {
                $err = $conn->error;
                echo "Sorry: $err";
                echo '<script language="javascript">';
                echo 'alert("Sorry:'.$err.'")';
                echo '</script>';
            }
        }

        # iterates through all entries in events and posts them in a table
        $query = "SELECT * FROM iter_events";
        $results = $conn->query($query);

        if (mysqli_num_rows($results) > 0) {
            ChromePhp::log('getting items: success');

            while($row = $results->fetch_assoc()) {
                echo '
                        <tr>
                            <td>' . $row["title"] . '</td>
                            <td>' . substr($row["description"], 0, 50) . '(...)</td>
                            <td>' . $row["location"] . '</td>
                            <td>' . $row["date"] . '</td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="msgid" value="'.$row['id'].'">                                 
                                    <input type="submit" id="delete" name="submit" value="delete">
                                </form>
                            </td>                 
                        </tr>
                ';
            }
        } else {
            $error = $conn->error;
            ChromePhp::log("Error description: " . mysqli_error($conn));
        }
        $conn->close();
        ?>
    </table>
</section>
<?php include "inc/footer.php"?>

</body>
</html>

