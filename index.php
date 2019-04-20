<?php session_start() ?>
<html lang="en">

<head>
    <?php
    define("ACCESSKEY", "jf)93/KD84¤5&njd199");
    include "inc/meta.php" ?>
    <title>Итер</title>
</head>

<body onload="init()">
    <?php
    include "inc/nav.php";
    include "inc/connection.php";
    ?>

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



    <section id="experience">
        <div>
            <h1 id="experience-title">Experience the world beyond</h1>
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="images/modernmarss.jpg" style="width:100%">
                    <div class="text">Experience the modern mars</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="images/download1.jpg" style="width:100%">
                    <div class="text">Fly through the sky</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="images/ancient1.jpg" style="width:100%">
                    <div class="text">Visit the ancient ruins of Kalebo III</div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

            </div>

            <div id="dots">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>

            <!-- SCRIPT -->

            <script>
                var slideIndex = 1;
                showSlides(slideIndex);

                function plusSlides(n) {
                    console.log("fired");
                    showSlides(slideIndex += n);
                }

                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("dot");
                    if (n > slides.length) {slideIndex = 1}
                    if (n < 1) {slideIndex = slides.length}
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";
                    dots[slideIndex-1].className += " active";
                }
            </script>
        </div>


    </section>
    <section id="events2">
        <h1>Events</h1>

        <?php
        if (isset($_POST['attend'])){
            $eventId = check($_POST['attend']);
            $bookingId = $_SESSION["booking"];

            $query = "INSERT INTO iter_attending
              VALUES ('null','$bookingId', '$eventId')";

            $results = $conn->query($query);

            if ($results === True) {
                echo '<script language="javascript">';
                echo 'alert("Event saved in your homepage")';
                echo '</script>';
            } else {
                echo "<h1>u fucked up</h1>";
                $error = $conn->error;
                $message = 'Error:'.$error;
                echo '<script language="javascript">';
                echo 'alert("'.$message.'")';
                echo '</script>';
            }
        }
        ?>

        <ul id="events-list">
            <?php
            $sql = "SELECT * FROM iter_events";
            $result = $conn->query($sql);

            if (mysqli_num_rows($result) > 0) {
                $events=[];
                // output data of each row
                while( $row = $result->fetch_assoc()) {
                    array_unshift($events,[$row["date"],$row["title"], $row["description"], $row["location"], $row["id"]]);
                }
                foreach ($events as $elem){
                    echo'
                    
                    <li>
                        <div>
                            <div class="event-dot"></div>
                            <h1>'. $elem[0] .'</h1>
                            <h2>'. $elem[1] .'</h2>
                            <p>'. $elem[2] .'</p>
                            <p id="location"><span>Location: </span>'. $elem[3] .'</p>
                        </div>';

                    #only gives the option to save an event if the user has placed a booking order
                    if (isset($_SESSION["booking"])){
                        $bookingId = $_SESSION["booking"];

                        $query = "SELECT * FROM iter_attending
                                  WHERE booking_id = '$bookingId' AND event_id = '$elem[4]'";

                        $results = $conn->query($query);

                        if (mysqli_num_rows($results) > 0) {
                            #event is already in list

                            echo '                      
                                <div>
                                    <form>
                                        <button name="attend" disabled class="attend-inactive"><img src="images/graphics/save.svg" alt="event already saved"></button>
                                    </form>                        
                                </div>';
                        } else {
                            echo '                      
                                    <div>
                                        <form name="saveEvent"  method="POST" enctype="multipart/form-data" action="'.htmlspecialchars($_SERVER['PHP_SELF']).'">
                                            <button name="attend" value="'.$elem[4].'"  class="attend"><img src="images/graphics/save.svg" alt="save event"></button>
                                        </form>                        
                                    </div>
                                 ';
                        }
                        /*
                        echo '                      
                        <div>
                            <form name="saveEvent"  method="POST" enctype="multipart/form-data" action="'.htmlspecialchars($_SERVER['PHP_SELF']).'">
                                <button name="attend" value="'.$elem[4].'"  class="attend"><img src="images/graphics/save.svg" alt="save event"></button>
                            </form>                        
                        </div>';
                        */
                    }
                    echo '</li>';
                }
            } else {
                echo '<li><h1>Ingen arrangementer tilgjengelig</h1></li>';
            }
            ?>

        </ul>
    </section>
    <section id="stay">
    <div class="stay-container">
        <div class="message">
            <h1>DISCLAIMER</h1>
            <ul>
                <li>All tickets are sold at a fixed prive of 5 000 000 Eto-Coins for adults and 3 000 000 Eto-Coins for children </li>
                <li>Passengers with a criminal record are not eligible for the flight</li>
                <li>All children under 12 must be accompanied by an adult</li>
                <li>Duo to limitations of space travel, passengers with mental and/or physical diseases are not eligible for flight</li>
                <li>Your trip booking is not valid until it has undergone manual inspection</li>
                <li>Bookings must be registered at least 3 weeks prior to trip</li>
                <li>You and your group will be contacted within 48 hours after booking for physical and mental examination</li>
                <li>You shall only be cleared for passage after passing the space flight examinations</li>

            </ul>
        </div>  

        <div class="booking">
            <div class="booking-container">
                <h1>BOOK YOUR STAY</h1>
                <div class="bookyourstay">
                    <form action="userpage.php" method="post" enctype="multipart/form-data">
                        <div class="booking-dates">
                            <h1 class="booking-title">Journey dates</h1>
                            <div>
                                <label class="bookyourstay-label" for="departure">Departure</label>
                                <select class="bookyourstay-input bookyourstay-input-select" name="departure">
                                    <?php
                                    $sql = "SELECT departure_date, id  FROM iter_departures";
                                    $result = $conn->query($sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while( $row = $result->fetch_assoc()) {
                                           echo "<option value='".$row['id']."'>".$row['departure_date']."</option>";
                                        }
                                    }else{
                                        echo "<option>No departures available...</option>";
                                    }
                                    ?>
                                </select>      
                            </div>

                            <div>
                                <label class="bookyourstay-label" for="return">Return</label>
                                <select class="bookyourstay-input bookyourstay-input-select" name="return">
                                    <?php
                                    $sql = "SELECT return_date, id  FROM iter_returns";
                                    $result = $conn->query($sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while( $row = $result->fetch_assoc()) {
                                            echo "<option value='".$row['id']."'>".$row['return_date']."</option>";
                                        }
                                    }else{
                                        echo "<option>No departures available...</option>";
                                    }
                                    ?>
                                </select>   
                            </div>

                        </div>
                        <!-- Second box -->

                        <div class="booking-info">
                            <h1 class="booking-title">Guests and rooms</h1>
                            <div>
                                <label class="bookyourstay-label" for="rooms">Rooms</label>
                                <select class="bookyourstay-input bookyourstay-input-select" name="rooms">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>   
                            </div>
                            <div class="twocolumn">
                                <div>
                                    <label class="bookyourstay-label" for="adults">Adults</label>
                                    <select class="bookyourstay-input bookyourstay-input-select bookyourstay-input-small" name="adults">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    </select>     
                                </div>
                                <div>
                                <label class="bookyourstay-label" for="kids">Children (under 12)</label>
                                    <select class="bookyourstay-input bookyourstay-input-select bookyourstay-input-small" name="kids">
                                    <option value="1">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    </select>    
                                </div>
                            </div>
                            <div class="bookyourstay-input-checkbox">
                                <input type="checkbox" value="agreement" name="agreement" required>
                                <label for="agreement">I have read and accept the disclaimer <span>&#8226;</span></label>
                            </div>
                            <?php
                            if (isset($_SESSION['login'])){
                                echo '<input id="btn" name="submit" type="submit" name ="book" value="book">';
                            }else {
                                echo '<input id="btn-inactive" value="Log in to book" disabled>';
                            }
                            ?>
                        </div>

                    </form>
                </div> 
            </div>
        </div>
    </div>
    </section>

    <?php
        $conn->close();
        include "inc/footer.php"
    ?>

</body>
</html>