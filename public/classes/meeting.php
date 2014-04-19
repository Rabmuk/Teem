<?php
require_once "../database/init.php";

class Meeting{

  private $meeting_id = -1;
  private $id_group = -1;
  private $startTime = '';
  private $endTime = '';
  
  public function __construct($param){
    global $db;
    
    $query = $db->prepare(
    "SELECT * FROM `groupMeeting` WHERE `meeting_id` = :meeting_id"
      );
    $query->execute(array(":meeting_id" => $param ));
    $meeting = $query->fetch();

    if (!$meeting) {return ; }

    $this->meeting_id = $param;
    $this->id_group = $meeting->id_group;
    $this->startTime = $meeting->startTime;
    $this->endTime = $meeting->endTime;
  }

  public function exists(){
    return $this->meeting_id >= 0;
  }

  public function getGroupID(){
    return $this->id_group;
  }

  public function exists(){
    return $this->meeting_id >= 0;
  }

}

function addMeetingToDatabase($id_group, $startTime, $endTime, $members){
  $query = $db->prepare(
    "INSERT INTO `groupMeeting` (`id_group`, `startTime`, `endTime`)
    VALUES (:id_group, :startTime, :endTime)"
    );
  $query->execute(array(
    ":id_group" => $id_group,
    ":startTime" => $startTime,
    ":endTime" => $endTime
    ));

  $query = $db->prepare(
      "SELECT `meeting_id` FROM `groupMeeting` WHERE `id_group` = :id_group AND `startTime` = :startTime"
      );
    $query->execute(array(
      ":id_group" => $id_group, 
      ":startTime" => $startTime
      ));
    $meeting = $query->fetch();

    // TODO add meeting members to database

    return new Meeting($meeting->meeting_id);
}

?>