<?php
require_once "../database/init.php";

class Group{
  private $group_id = -1;
  private $id_owner = -1;
  private $name = "";

  public function __constructor($group_id){
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