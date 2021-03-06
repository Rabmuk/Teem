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
    // can be constructed on either an email or id. Emails are forced to be unique because of indexing on the database.
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

  // updates user email
  public function setEmail($em){
    global $db;

    $query = $db->prepare(
      "UPDATE `users` SET `email` = :email WHERE `user_id` = :user_id"
      );
    $query->execute(array(
      ":email" => $em,
      ":user_id" => $this->user_id
      ));
    $this->email = $em;
  }

  public function getFirstName(){
    return $this->firstName;
  }

  public function isUser($user){
    if ($user instanceof User) {
      return $this->user_id == $user->getID();
    }
    return false;
  }

  public function setFirstName($fn){
    global $db;

    $query = $db->prepare(
      "UPDATE `users` SET `firstName` = :firstName WHERE `user_id` = :user_id"
      );
    $query->execute(array(
      ":firstName" => $fn,
      ":user_id" => $this->user_id
      ));
    $this->firstName = $fn;
  }

  public function getLastName(){
    return $this->lastName;
  }

  public function setLastName($ln){
    global $db;

    $query = $db->prepare(
      "UPDATE `users` SET `lastName` = :lastName WHERE `user_id` = :user_id"
      );
    $query->execute(array(
      ":lastName" => $ln,
      ":user_id" => $this->user_id
      ));
    $this->lastName = $ln;
  }

  public function getName(){
    return $this->getFirstName() . ' ' . $this->getLastName();
  }

  // returns an array of groups that the member belongs to used in profile.php
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

  // returns an array of meetings that the member belongs to used in profile.php
  public function getMeetings(){
    global $db;

    $toReturn = array();

    $query = $db->prepare(
      "SELECT `id_meeting` FROM meetingMembers 
      INNER JOIN meetings ON meetingMembers.id_meeting = meetings.meeting_id
      WHERE id_user = :user_id ORDER BY `date`, `startTime`"
      );
    $query->execute(array(":user_id" => $this->user_id));
    while ($row = $query->fetch()) {
      array_push($toReturn, new Meeting($row->id_meeting));
    }
    
    return $toReturn;    
  }

  // returns true if user is a member of given meeting
  public function atMeeting($meeting_id){
    global $db;

    $query = $db->prepare(
      "SELECT * FROM meetingMembers 
      WHERE id_user = :user_id AND `id_meeting` = :id_meeting"
      );
    $query->execute(array(
      ":user_id" => $this->user_id,
      ":id_meeting" => $meeting_id
      ));
    if ($row = $query->fetch()) {
      return true;
    }

    return false;
  }


  public function getActionItems($meeting_id){
    global $db;

    $toReturn = array();

    $query = $db->prepare(
     "SELECT `action_id` FROM actionItems
     WHERE id_meeting = :id_meeting AND id_user = :id_user"
     );
    $query->execute(array(
      ":id_meeting" => $meeting_id,
      ":id_user" => $this->user_id
      ));
    while ($row = $query->fetch()) {
      array_push($toReturn, new actionItem($row->action_id));
    }

    return $toReturn;
  }

  public function deleteUser(){
    global $db;

    $query = $db->prepare(
     "DELETE FROM `users` WHERE `user_id` = :user_id"
     );
    $query->execute(array(
      ":user_id" => $this->user_id
      ));
  }

}

// email is checked for uniqueness elsewhere
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

  return new User($email);
}

?>