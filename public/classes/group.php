<?php
require_once "../database/init.php";

class Group{
  private $group_id = -1;
  private $id_owner = -1;
  private $name = "";

  public function __construct($group_id){
    global $db;

    $query = $db->prepare(
      "SELECT `id_owner`, `name` FROM `groups` WHERE `group_id` = :group_id"
      );
    $query->execute(array(":group_id" => $group_id));
    $group = $query->fetch();
    if (!$group) return;

    $this->group_id = $group_id;
    $this->id_owner = $group->id_owner;
    $this->name = $group->name;
  }

  public function exists(){
    return $this->group_id >= 0;
  }

  public function getName(){
    return $this->name;
  }

  public function getOwner(){
    return new User((int)$this->id_owner);
  }

  public function getID(){
    return $this->group_id;
  }

  public function getMemberNames(){
    global $db;

    $toReturn = '';
    $isFirst = true;

    $query = $db->prepare(
      "SELECT `id_user` FROM `groupMembers` WHERE `id_group` = :id_group"
      );
    $query->execute(array(":id_group" => $this->group_id));

    while ($row = $query->fetch()) {
      $tempUser = new User((int)$row->id_user);
      if (!$isFirst) {
        $toReturn .= ', ';
      }
      $toReturn .= $tempUser->getName();
      $isFirst = false;
    }

    return $toReturn;
  }

  public function getMemberArray(){
    global $db;

    $toReturn = array();

    $query = $db->prepare(
      "SELECT `id_user` FROM `groupMembers` WHERE `id_group` = :id_group"
      );
    $query->execute(array(":id_group" => $this->group_id));

    while ($row = $query->fetch()) {
      $tempUser = new User((int)$row->id_user);
      array_push($toReturn, $tempUser->getName());
    }

    return $toReturn;
  }

  public function getMemberArrayID(){
    global $db;

    $toReturn = array();

    $query = $db->prepare(
      "SELECT `id_user` FROM `groupMembers` WHERE `id_group` = :id_group"
      );
    $query->execute(array(":id_group" => $this->group_id));

    while ($row = $query->fetch()) {
      $tempUser = new User((int)$row->id_user);
      array_push($toReturn, $tempUser->getID());
    }

    return $toReturn;
  }

}

//assume that the email is unique
function addGroupToDatabase($id_owner, $name, $members){
  global $db;

  echo $name;
  $name = stripslashes($name);
  echo "\n";
  echo $name;
  $query = $db->prepare(
    "INSERT INTO `groups` (`id_owner`, `name`)
    VALUES (:id_owner, :name)"
    );
  $query->execute(array(
    ":id_owner" => $id_owner,
    ":name" => $name
    ));

  $query = $db->prepare(
    "SELECT `group_id` FROM `groups` WHERE `name` = :name AND `id_owner` = :id_owner"
    );
  $query->execute(array(
    ":name" => $name, 
    ":id_owner" => $id_owner
    ));
  $group = $query->fetch();

  $returnValue = new Group($group->group_id);

  $query = $db->prepare(
    "INSERT INTO `groupMembers` (`id_group`, `id_user`)
    VALUES (:id_group, :id_user)"
    );
  $query->execute(array(
    ":id_group" => $group->group_id,
    ":id_user" => $id_owner
    ));


  $memberArray = explode(",", $members);

  foreach ($memberArray as $member) {
    $member = trim($member);
    $query = $db->prepare(
      "SELECT `user_id` FROM `users` WHERE `email` = :email"
      );
    $query->execute(array(
      ":email" => $member
      ));
    $user = $query->fetch();

    if($user){
      $query = $db->prepare(
        "INSERT INTO `groupMembers` (`id_group`, `id_user`)
        VALUES (:id_group, :id_user)"
        );
      $query->execute(array(
        ":id_group" => $group->group_id,
        ":id_user" => $user->user_id
        ));
    }else{
      echo $member . ' cound not be found\n';  
    }
  }
  return $returnValue;
}

function deleteGroup($id_owner){
  global $db;

  $query = $db->exec("DELETE FROM `groups` WHERE `id_owner` = $id_owner");

}

function deleteMember($id_user){
  global $db;
  //Delete member from group
  $query = $db->exec("DELETE FROM `groupmembers` WHERE `id_user` = $id_user"); 
}

function addMember($id_user, $group_id){
  global $db;

  $member = trim($id_user);
  $query = $db->prepare(
    "SELECT `user_id` FROM `users` WHERE `email` = :email"
    );
  $query->execute(array(
    ":email" => $member
    ));
  $user = $query->fetch();

  if($user){
    $query = $db->prepare(
      "INSERT INTO `groupMembers` (`id_group`, `id_user`)
      VALUES (:id_group, :id_user)"
      );
    $query->execute(array(
      ":id_group" => $group_id,
      ":id_user" => $user->user_id
      ));
  }else{
    echo ('<script type="text/javascript">alert ("The email you entered is not registered with our service.");</script>');
  }
}

function changeGroupName($group_id, $name){
  global $db;
  
  $query = $db->prepare("UPDATE `groups` SET `name`= :email WHERE `group_id`= :group_id");
  $query->execute(array(
    ":email" => $name,
    ":group_id" => $group_id
    ));

}

?>