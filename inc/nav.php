<?php
# navigation written by candidate 110
# logo created by candidate 118
if (ACCESSKEY == "jf)93/KD84¤5&njd199"){
    
    echo '
    <header>
        <nav>
            <a id="logo" href="index.php#intro"><img id="small-logo" src="images/graphics/small-logo-alt.png"></a>
            <div id="fade"></div>
            <div id="navOptions" onclick="toggleExpansion()">
                <ul id="menu">
                    <li><a href="index.php#about">About</a></li>
                    <li><a href="index.php#experience">Experience</a></li>
                    <li><a href="index.php#events2">Events</a></li>
                    <li><a href="index.php#stay">Stay</a></li>
                </ul>
            </div>
            ';

        if (isset($_SESSION['login'])) {
            if ($_SESSION['login'] == 'admin') {
                echo "<form id=\"loginform\" action=\"admin.php\">";
            }else{
                echo "<form id=\"loginform\" action=\"userpage.php\">";
            }
            echo "<button type='submit' id='navloginImage' form='loginform'><img src='images/graphics/user.svg'></button>";

        }else {
            echo "<form id = 'loginform' action='login.php'>
                  <input type='submit' id='navloginbutton' value='login'/>";
        };

        echo '
                
            </form>
            <img src="images/graphics/burgerbutton.svg" id="hamburger" alt="menu">
            <img src="images/graphics/crossbutton.svg" id="cross" alt="exit">
        </nav>
    </header>
    ';
}