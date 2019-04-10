<html lang="en">

<head>
    <?php
    define("ACCESSKEY", "jf)93/KD84¤5&njd199");
    include "inc/meta.php" ?>
    <title>Итер</title>
</head>

<body onload="init()">
    <?php include "inc/nav.php"?>

    <section id="intro">

        <img alt="logo" src="images/graphics/icon-iter.png">
        <h1>THE COSMOS AWAITS YOU</h1>
        <form action="#about">
            <input type="submit" value="Start your journey" />
        </form>
        <div id="line">
            <hr>
        </div>

    </section>

    <section id="about">
        <div>
            <h2>Venture beyond your reality</h2>
            <p>The luxurious transcendent vacation that goes beyond the Earthy limitations.</p>
            <p>
                ИТЕР is the leading interplanetary expedition service on planet Earth. We offers a unique journey to our
                new
                World. With over 200 years of experience on Mars, we are finally able to offer resident visitations.
            </p>
        </div>
    </section>
    <section id="experience"></section>
    <section id="events">
        <div id="content">
            <h2>Events</h2>
            <ul class="timeline-list">
                <?php
                include "inc/connection.php";

                $sql = "SELECT * FROM iter_events";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $events=[];
                    // output data of each row
                    while( $row = $result->fetch_assoc()) {
                        array_unshift($events,[$row["date"],$row["title"], $row["description"], $row["location"]]);
                    }
                    foreach ($events as $elem){
                        echo'
                        <li class="event" data-date="'. $elem[0] .'">
                            <h3>'. $elem[1] .'</h3>
                            <p>
                                '. $elem[2] .'
                            </p>
                            <p>Location: '. $elem[3] .'</p>
                        </li>
                        ';
                    }
                } else {
                    echo '<h1>Ingen arrangementer tilgjengelig</h1>';
                }
                $conn->close();

                ?>
            </ul>
        </div>
    </section>
    <section id="stay"></section>
    <?php include "inc/footer.php"?>

</body>

</html>