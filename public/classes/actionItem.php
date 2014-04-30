<?php
require_once "../database/init.php";

class ActionItem{

  private $action_id = -1;
  private $id_meeting = -1;
  private $id_user = -1;
  private $action = '';

  public function __construct($param){
    global $db;
    
    $query = $db->prepare(
      "SELECT * FROM `actionItems` WHERE `action_id` = :action_id"
      );
    $query->execute(array(":action_id" => $param ));
    $item = $query->fetch();

    if (!$item) {return ; }

    $this->action_id = $param;
    $this->id_meeting = $item->id_meeting;
    $this->id_user = $item->id_user;
    $this->action = $item->action;
  }

  public function getAction(){
    return $this->action;
  }

}

function addActionItem($id_meeting, $id_user, $action){
  global $db;

  $query = $db->prepare(
    "INSERT INTO `actionItems` (`id_meeting`, `id_user`, `action`)
    VALUES (:id_meeting:, :id_user, :action)"
    );
  $query->execute(array(
    ":id_meeting" => $id_meeting,
    ":id_user" => $id_user,
    ":action" => $action
    ));

}