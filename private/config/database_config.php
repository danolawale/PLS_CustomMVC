<?php
//keep database credentials in a separate file
//1. it's easy to exclude files from source code managers
//2. unique credentials on development and production servers
//3. unique credentials if working with multiple developers

define("DB_SERVER", "localhost");
define("DB_USER", "webuser"); //replace with your DB_USER
define("DB_PASS", "mysql_pass"); //replace with your DB_PASS
define("DB_NAME", "oophp"); //replace with your DB_NAME
define("DSN", "mysql:host=localhost;dbname=oophp");

 ?>
