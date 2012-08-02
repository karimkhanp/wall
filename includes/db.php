<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'awans15');
define('DB_PASSWORD', 'Optimus!1993');
define('DB_DATABASE', 'awans15');
define('DEVELOPMENT','TRUE');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
