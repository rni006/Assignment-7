# logout management written by candidate 110.
<?php
# destroys session and redirects user to the index page
session_start();
session_unset();
session_destroy();
echo"<script> window.location.href = 'index.php' ; </script>";
die();