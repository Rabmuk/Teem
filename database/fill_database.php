<?php
require_once 'config.php';

$my_connect = mysql_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD);

if (!$my_connect) {
	die('Error connecting to the database: ' . mysql_error());
}

mysql_select_db($DB_NAME, $my_connect);

mysql_query("INSERT INTO `users`(`user_id`, `email`, `password`, `salt`) VALUES (1,'example@rpi.edu','password','saltedpassword')");
mysql_query("INSERT INTO `users`(`user_id`, `email`, `password`, `salt`) VALUES (2,'rick@rpi.edu','lkdsfj','saltedpassword')");
mysql_query("INSERT INTO `users`(`user_id`, `email`, `password`, `salt`) VALUES (3,'evelyn@rpi.edu','passwor345','saltedpassword')");
mysql_query("INSERT INTO `users`(`user_id`, `email`, `password`, `salt`) VALUES (4,'lisa3@rpi.edu','pa34word','saltedpassword')");
mysql_query("INSERT INTO `users`(`user_id`, `email`, `password`, `salt`) VALUES (5,'moneybanks@rpi.edu','23ssword','saltedpassword')");
mysql_query("INSERT INTO `users`(`user_id`, `email`, `password`, `salt`) VALUES (6,'executiveleader@rpi.edu','passw78d','saltedpassword')");
mysql_query("INSERT INTO `users`(`user_id`, `email`, `password`, `salt`) VALUES (7,'alex3@rpi.edu','pass099d','saltedpassword')");
mysql_query("INSERT INTO `users`(`user_id`, `email`, `password`, `salt`) VALUES (8,'mop@rpi.edu','passw878d','saltedpassword')");


mysql_close($my_connect);

?>

