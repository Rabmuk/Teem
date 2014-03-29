<?php
require_once "../database/init.php";

class User{
  private $user_id = -1;
  private $email = "";
  private $firstName = "";
  private $lastName = "";
  private $groups = array();

  public function __constructor($user_id){
    global $db;
    $query = $db->prepare(
      "SELECT `email`, `firstName`, `lastName` FROM `users` WHERE `user_id` = :user_id"
      );
    $query->execute(array(":user_id" => $user_id));
    $user = $query->fetch();
    if (!$user) return;

    $this->user_id = $user_id;
    $this->email = $user->email;
    $this->firstName = $user->firstName;
    $this->lastName = $user->lastName;
  }

  public function exists(){
    return $this->user_id >= 0;
  }

  public function getID(){
    return $this->user_id;
  }

  public function getEmail(){
    return $this->email;
  }

  public function getFirstName(){
    return $this->firstName;
  }

  public function getLastName(){
    return $this->lastName;
  }

}

//assume that the email is unique
function addUserToDatabase($email, $password, $salt, $firstName, $lastName){
  global $db;

  $query = $db->prepare(
    "INSERT INTO `users` (`email`, `password`, `salt`, `firstName`, `lastName`)
    VALUES (:email, :password, :salt, :firstName, :lastName)"
    );
  $query->execute(array(
    ":email" => $email,
    ":password" => $password,
    ":salt" => $salt,
    ":firstName" => $firstName,
    ":lastName" => $lastName
    ));

  $query = $db->prepare(
      "SELECT `user_id` FROM `users` WHERE `email` = :email"
      );
    $query->execute(array(":email" => $email));
    $user = $query->fetch();

  return new User($user->user_id);
}

?>