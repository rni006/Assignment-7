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
                $result = $conn->query($sql);

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

    <section id="stay">
    <div class="stay-container">
        <div class="message">
            <h1>Best trip you will ever have</h1>
            <p>Please look forward to it</p>
        </div>  

        <div class="booking">
            <div class="booking-container">
                <h1>BOOK YOUR STAY HERE</h1>
                <div class="bookyourstay">
                    <form>
                        <div class="booking-dates">
                            <h1 class="booking-title">Journey dates</h1>
                            <div>
                                <label class="bookyourstay-label" for="departure">Departure</label>
                                <select class="bookyourstay-input bookyourstay-input-select" name="departure">
                                    <option>01.03.3019</option>
                                    <option>08.03.3019</option>
                                    <option>15.03.3019</option>
                                    <option>22.03.3019</option> 
                                    <option>29.03.3019</option>
                                </select>      
                            </div>

                            <div>
                                <label class="bookyourstay-label" for="return">Return</label>
                                <select class="bookyourstay-input bookyourstay-input-select" name="return">
                                <option>01.03.3019</option>
                                <option>08.03.3019</option>
                                <option>15.03.3019</option>
                                <option>22.03.3019</option> 
                                <option>29.03.3019</option>
                                </select>   
                            </div>

                        </div>
                        <!-- Second box -->

                        <div class="booking-info">
                            <h1 class="booking-title">Guests and rooms</h1>
                            <div>
                                <label class="bookyourstay-label" for="rooms">Rooms</label>
                                <select class="bookyourstay-input bookyourstay-input-select" name="rooms">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>  
                                </select>   
                            </div>
                            <div class="twocolumn">
                                <div>
                                    <label class="bookyourstay-label" for="adults">Adults</label>
                                    <select class="bookyourstay-input bookyourstay-input-select bookyourstay-input-small" name="adults">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    </select>     
                                </div>
                                <div>
                                <label class="bookyourstay-label" for="kids">Children (under 12)</label>
                                    <select class="bookyourstay-input bookyourstay-input-select bookyourstay-input-small" name="kids">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    </select>    
                                </div>
                            </div>
                        </div>
                        <input id="btn" type="submit" value="Submit"/>
                    </form> 
                </div> 
            </div>
        </div>
    </div>
    </section>

    <?php include "inc/footer.php"?>

</body>

</html>