<?php
//keep database credentials in a separate file
//1. it's easy to exclude files from source code managers
//2. unique credentials on development and production servers
//3. unique credentials if working with multiple developers

define("DB_SERVER", "localhost");
define("DB_USER", "webuser");
define("DB_PASS", "mysql_phebian3");
define("DB_NAME", "oophp");
define("DSN", "mysql:host=localhost;dbname=oophp");

 ?>
