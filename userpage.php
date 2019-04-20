<?php
session_start();
# checks to see if the user is logged in as a user. if not, user is sent to the login page
if (!isset($_SESSION['login'])){
    header('LOCATION:login.php');
    die();
}else if ($_SESSION["login"] !="user"){
    #this does not work for some reason:
    # http_response_code(404);
    #temporary workaround:
    header('LOCATION:error.php');
}
?>
<html lang="en">
<head>
    <?php
    define("ACCESSKEY", "jf)93/KD84¤5&njd199");
    include "inc/meta.php";
    include "inc/connection.php";
    include 'ChromePhp.php'; # hjelpeklasse som tillater PHP å printe på chrome console
    ?>

    <link rel="stylesheet" href="css/accessforms.css">
    <link rel="stylesheet" href="css/user.css">


    <title>Итер - User</title>
</head>
<body>
<header>
    <nav>
        <a id="logo" href="index.php">[Logo]</a>
        <div id="fade"></div>
        <form id = 'loginform' action='logout.php'>
            <input type='submit' id='navloginbutton' value='Logout'/>
        </form>
       </nav>
</header>
<section id="users_booking">

    <?php
    $serial = $_SESSION["serial"];
    $bookId = null;
    # handles booking form data
    if (isset($_POST['submit']) && $_POST['submit'] == "book") {

        #breaks operation if the user already has an active booking.
        $query = "SELECT * 
                  FROM iter_booking
                  WHERE booker_id = $serial";
        $results = $conn->query($query);
        if (mysqli_num_rows($results) > 0){
            echo "
            <div class='errorbox'>
                <h1> ERROR:</h1>
                <p>You already have an ongoing booking. Only one booking per customer is allowed<br>
                Redirecting to your current booking order...</p>
            </div>        
            ";
            header('Refresh: 5; URL=userpage.php');
        }
        $departure = check($_POST['departure']);
        $return = check($_POST['return']);
        $rooms = check($_POST['rooms']);
        $adults = check($_POST['adults']);
        $kids = check($_POST['kids']);
        $query = "INSERT INTO iter_booking
                  VALUES ($departure, $return, null, $serial, $rooms, $adults, $kids)";

        $results = $conn->query($query);

        if ($results === True) {
            echo "
            <div class='successbox'>
                <h1> Success:</h1>
                <p>Booking order is registered. We will contact you after manually inspecting your application.<br>
                Redirecting to your booking page...</p>
            </div>        
            ";
            header('Refresh: 5; URL=userpage.php');
        } else {
            $error = $conn->error;
            $message = 'Error:'.$error;
            echo '<script language="javascript">';
            echo 'alert("'.$message.'")';
            echo '</script>';
        }
    }else{
        #prints booking details
        $query = "SELECT iter_departures.departure_location, iter_departures.departure_date,
                  iter_returns.return_date, iter_booking.booking_id
                  FROM iter_booking INNER JOIN iter_departures
                  ON iter_booking.departure_id = iter_departures.id
                  INNER JOIN iter_returns
                  ON iter_booking.return_id=iter_returns.id                 
                  WHERE iter_booking.booker_id = $serial";

        $results = $conn->query($query);

        if (mysqli_num_rows($results) > 0) {
            echo "<div>";
            echo "<h1>Booked trip</h1>";
            $resultRow = mysqli_fetch_assoc($results);
            $bookId = $resultRow['booking_id'];
            mysqli_data_seek($results, 0);

            echo "<table>";

            echo "<tr><td>departure location</td>";
            echo "<td> " . $resultRow['departure_location'] . "</td></tr>";

            echo "<tr><td>departure date</td>";
            echo "<td> " . $resultRow['departure_date'] . "</td></tr>";

            echo "<tr><td>Return date</td>";
            echo "<td> " . $resultRow['return_date'] . "</td></tr>";

            echo "</table>";

            #appends an event section if the user has saved any
            $query = "SELECT iter_events.title, iter_events.location, iter_events.date
                          FROM iter_attending INNER JOIN iter_events
                          ON iter_attending.event_id = iter_events.id
                          WHERE iter_attending.booking_id = $bookId";
            echo "</div>";
            echo "<div>";
            echo "<h1>Saved Events</h1>";
            $results = $conn->query($query);
            if (mysqli_num_rows($results) > 0) {
                echo "<table>
                    <tr>
                       <th>Event</th>
                       <th>Location</th>
                    </tr>";

                while ($row = $results->fetch_assoc()) {

                    echo "<tr><td> " . $row['location'] . "</td>";
                    echo "<td> " . $row['title'] . "</td></tr>";
                }
                echo "</table>";

            }else{
                echo "<div id='centered-box'>";
                echo "<p>You have no booked trips.</p>";
                echo "
              <form method='get' action='index.php#stay'>
                  <button class='orange-button' type='submit'>Book Now</button>
              </form>";
              echo "</div>";
            }
            echo "<div>";
        }
    }


    ?>

</section>

<?php include "inc/footer.php"?>

</body>
</html>