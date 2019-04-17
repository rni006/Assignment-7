<?php
echo "<h1>404: Not Found</h1>";
echo "<p>Redirecting to landing page...</p>";
header('Refresh: 3; URL=index.php');
