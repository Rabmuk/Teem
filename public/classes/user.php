<?php
require_once "../database/init.php";

class User{
  private $user_id = -1;
  private $email = "";
  private $firstName = "";
  private $lastName = "";
  private $groups = array();

  public function __construct($param){
    global $db;
    if (gettype($param) == "integer") {
      $query = $db->prepare(
        "SELECT `email`, `firstName`, `lastName` FROM `users` WHERE `user_id` = :user_id"
        );
      $query->execute(array(":user_id" => $param));
      $user = $query->fetch();
      if (!$user) return;

      $this->user_id = $param;
      $this->email = $user->email;
      $this->firstName = $user->firstName;
      $this->lastName = $user->lastName;
    }else if(gettype($param) == "string"){
      $query = $db->prepare(
        "SELECT `user_id`, `firstName`, `lastName` FROM `users` WHERE `email` = :email"
        );
      $query->execute(array(":email" => $param));
      $user = $query->fetch();
      if (!$user) return;

      $this->user_id = $user->user_id;
      $this->email = $param;
      $this->firstName = $user->firstName;
      $this->lastName = $user->lastName;
    }
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

  public function getName(){
    return $this->getFirstName() . ' ' . $this->getLastName();
  }

  public function getGroups(){
    global $db;

    $toReturn = array();

    $query = $db->prepare(
     "SELECT `group_id`
     FROM groups
     INNER JOIN groupMembers ON groups.group_id = groupMembers.id_group
     INNER JOIN users ON groupMembers.id_user = users.user_id WHERE id_user = :user_id"
     );
    $query->execute(array(":user_id" => $this->user_id));
    while ($row = $query->fetch()) {
      array_push($toReturn, new Group($row->group_id));
    }
    
    return $toReturn;
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

  // $query = $db->prepare(
  //  "SELECT `user_id` FROM `users` WHERE `email` = :email"
  // );
  // $query->execute(array(":email" => $email));
  // $user = $query->fetch();
  return new User($email);
}

?>