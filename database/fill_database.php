<?php
require_once "config.php";
require_once "init.php";

try{
	$sql = "INSERT INTO users ( user_id, password, email ) VALUES ( :userid, :password, :email )";
	$query = $db->prepare( $sql );
	$query->execute( array( ':username'=>'1', ':password'=>'password', ':email'=>'example@rpi.edu' ) );
	$query->execute( array( ':username'=>'2', ':password'=>'password2', ':email'=>'bobr4@rpi.edu' ) );
	$query->execute( array( ':username'=>'3', ':password'=>'password3', ':email'=>'like23@rpi.edu' ) );
	$query->execute( array( ':username'=>'4', ':password'=>'password4', ':email'=>'miney4@rpi.edu' ) );
	$query->execute( array( ':username'=>'5', ':password'=>'password5', ':email'=>'jerry5@rpi.edu' ) );
	$query->execute( array( ':username'=>'6', ':password'=>'password6', ':email'=>'cashmoney@rpi.edu' ) );
	$query->execute( array( ':username'=>'7', ':password'=>'password7', ':email'=>'executiveleader1@rpi.edu' ) );
}catch(PDOException $e) {
  die("DB ERROR: ". $e->getMessage());
}

?>