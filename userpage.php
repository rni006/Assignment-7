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
<body onload="init()">
<style>
    :root {
        --main-bg-color: #232323;
        --main-txt-color: #fdfdfd;
        --main-accent-color: #EE750E;
    }

    table {
        background-color: var(--main-txt-color);
        border-spacing: 0;
        width: 100%;
        max-height: 488px;
        overflow-y:scroll;

    }

    th{
        background-color: var(--main-accent-color);
        text-align: left;
        padding: 15px 10px 15px 10px;
        color: var(--main-txt-color);
    }
    td{
        border-top: 1px solid #c0c0c0;
        padding: 10px;
        color: var(--main-bg-color);
    }
</style>
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
    $query = "Select iter_departures.departure_location, iter_departures.departure_date,
              iter_returns.return_date, iter_events.title, iter_events.location
              from iter_booking INNER JOIN iter_departures
              ON iter_booking.departure_id = iter_departures.id
              INNER JOIN iter_returns
              ON iter_booking.return_id=iter_returns.id
              INNER JOIN iter_attending
              ON iter_booking.booking_id=iter_attending.booking_id 
              INNER JOIN iter_events
              ON iter_attending.event_id = iter_events.id 
              WHERE iter_booking.booker_id = $serial";

    $results = $conn->query($query);
    $conn->close();

    echo "<h1>Booking</h1>";
    if (mysqli_num_rows($results) > 0) {
        $firstrow = mysqli_fetch_assoc($results);
        mysqli_data_seek($results, 0);

        echo "<table>";

        echo "<tr><td>departure location</td>";
        echo "<td> " . $firstrow['departure_location'] . "</td></tr>";
        
        echo "<tr><td>departure date</td>";
        echo "<td> " . $firstrow['departure_date'] . "</td></tr>";

        echo "<tr><td>Return date</td>";
        echo "<td> " . $firstrow['return_date'] . "</td></tr>";

        echo "</table>";

        #appends an event section if the user has saved any
        if ($firstrow["title"] != null){
            echo "<h1>Saved Events</h1>";
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
        }



    }else{
        echo "<p>You have no booked trips.</p>";
        echo "
              <form method='get' action='index.php#stay'>
                  <button type='submit'>Book Now</button>
              </form>
              ";
    }

    ?>
</section>

<?php include "inc/footer.php"?>

</body>
</html>

