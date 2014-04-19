<?php
require_once "../database/init.php";
require_once "user.php";

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

    $query = $db->prepare(
      "SELECT `id_user` FROM `groupMembers` WHERE `id_group` = :id_group"
      );
    $query->execute(array(":id_group" => $this->group_id));

    while ($row = $query->fetch()) {
      $tempUser = new User((int)$row->id_user);
      $toReturn .= ', ' . $tempUser->getName();
    }

    return $toReturn;
  }

}

//assume that the email is unique
function addGroupToDatabase($id_owner, $name){
  global $db;

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

  return new User($group->group_id);
}

?>