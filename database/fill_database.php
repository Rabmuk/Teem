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


mysql_query("INSERT INTO `groups`(`group_id`, `id_owner`, `name`) VALUES (1,1,'Teem Win')");
mysql_query("INSERT INTO `groups`(`group_id`, `id_owner`, `name`) VALUES (2,5,'Teem Lose')");
mysql_query("INSERT INTO `groups`(`group_id`, `id_owner`, `name`) VALUES (3,8,'Teem Neither')");

mysql_query("INSERT INTO `groupmembers`(`id_group`, `id_user`) VALUES (1,1)");
mysql_query("INSERT INTO `groupmembers`(`id_group`, `id_user`) VALUES (1,2)");
mysql_query("INSERT INTO `groupmembers`(`id_group`, `id_user`) VALUES (1,3)");
mysql_query("INSERT INTO `groupmembers`(`id_group`, `id_user`) VALUES (2,4)");
mysql_query("INSERT INTO `groupmembers`(`id_group`, `id_user`) VALUES (2,5)");
mysql_query("INSERT INTO `groupmembers`(`id_group`, `id_user`) VALUES (3,6)");
mysql_query("INSERT INTO `groupmembers`(`id_group`, `id_user`) VALUES (3,7)");
mysql_query("INSERT INTO `groupmembers`(`id_group`, `id_user`) VALUES (3,8)");

mysql_query("INSERT INTO `groupmeeting`(`meeting_id`, `id_group`, `name`, `startTime`, `endTime`) VALUES (1,1,'Our First Meeting', '12:15:30', '13:15:30')");
mysql_query("INSERT INTO `groupmeeting`(`meeting_id`, `id_group`, `name`, `startTime`, `endTime`) VALUES (2,2,'Meeting of the Teem', '00:15:30', '02:15:30')");
mysql_query("INSERT INTO `groupmeeting`(`meeting_id`, `id_group`, `name`, `startTime`, `endTime`) VALUES (3,3,'Final Meeting!', '16:15:30', '17:15:30')");

mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (1,0,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (1,0,'16:15:30', '18:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (1,1,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (1,2,'10:15:30', '19:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (1,3,'11:15:30', '16:15:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (1,4,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (1,5,'08:15:30', '13:20:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (1,6,'10:15:30', '13:15:30')");

mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (2,0,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (2,1,'16:15:30', '18:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (2,1,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (2,2,'10:15:30', '19:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (2,3,'11:15:30', '16:15:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (2,4,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (2,5,'08:15:30', '13:20:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (2,6,'10:15:30', '13:15:30')");

mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (3,0,'14:15:30', '19:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (3,1,'01:15:30', '18:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (3,2,'10:15:30', '19:15:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (3,2,'20:15:30', '24:00:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (3,3,'11:15:30', '16:15:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (3,4,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (3,5,'08:15:30', '13:20:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (3,6,'10:15:30', '13:15:30')");

mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (4,0,'00:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (4,0,'14:15:30', '18:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (4,1,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (4,2,'10:15:30', '19:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (4,3,'11:00:30', '16:15:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (4,4,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (4,5,'08:15:30', '13:20:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (4,6,'10:15:30', '13:00:00')");

mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (5,0,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (5,1,'16:15:30', '18:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (5,2,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (5,3,'10:15:30', '19:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (5,3,'11:15:30', '16:15:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (5,4,'10:15:30', '13:15:30')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (5,5,'08:15:30', '13:20:00')");
mysql_query("INSERT INTO `freetime`(`id_user`, `dayOfWeek`, `startTime`, `endTime`) VALUES (5,6,'10:15:30', '13:15:30')");



mysql_query("INSERT INTO `agendaitems`(`item_id`, `id_meeting`, `id_user`, `description`, `allotedTime`) VALUES (1,1,1,'Description of agenda items', 4)");
mysql_query("INSERT INTO `agendaitems`(`item_id`, `id_meeting`, `id_user`, `description`, `allotedTime`) VALUES (2,1,2,'Description of person 2s agenda items', 2)");
mysql_query("INSERT INTO `agendaitems`(`item_id`, `id_meeting`, `id_user`, `description`, `allotedTime`) VALUES (3,2,4,'Description of agenda items', 3)");
mysql_query("INSERT INTO `agendaitems`(`item_id`, `id_meeting`, `id_user`, `description`, `allotedTime`) VALUES (4,2,5,'Description of agenda items', 4)");
mysql_query("INSERT INTO `agendaitems`(`item_id`, `id_meeting`, `id_user`, `description`, `allotedTime`) VALUES (5,3,6,'Description of agenda items', 1)");
mysql_query("INSERT INTO `agendaitems`(`item_id`, `id_meeting`, `id_user`, `description`, `allotedTime`) VALUES (6,3,7,'Description of agenda items', 4)");
mysql_query("INSERT INTO `agendaitems`(`item_id`, `id_meeting`, `id_user`, `description`, `allotedTime`) VALUES (7,3,8,'Description cool stuff whatevs', 2)");


mysql_close($my_connect);

?>

