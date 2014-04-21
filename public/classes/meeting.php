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
      "SELECT * FROM `meetings` WHERE `meeting_id` = :meeting_id"
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

}

function addMeetingToDatabase($title, $location, $startTime, $members){
  global $db;

  $query = $db->prepare(
    "INSERT INTO `meetings` (, `title`, `startTime`)
    VALUES (:title, :startTime)"
    );
  $query->execute(array(
    ":title" => $title,
    ":startTime" => $startTime
    ));

  $query = $db->prepare(
    "SELECT `meeting_id` FROM `meetings` WHERE `title` = :title 
    AND `startTime` = :startTime"
    );
  $query->execute(array(
    ":title" => $title, 
    ":startTime" => $startTime
    ));
  $meeting = $query->fetch();

  $toReturn = new Meeting($meeting->meeting_id);

  $memberArray = explode(", ", $members);

  foreach ($memberArray as $member) {
    $query = $db->prepare(
      "SELECT `user_id` FROM `users` WHERE `email` = :email"
      );
    $query->execute(array(
      ":email" => $member
      ));
    $user = $query->fetch();

    if($user){
      $query = $db->prepare(
        "INSERT INTO `meetingMembers` (`id_meeting`, `id_user`)
        VALUES (:id_meeting, :id_user)"
        );
      $query->execute(array(
        ":id_meeting" => $meeting->meeting_id,
        ":id_user" => $user->user_id
        ));
    }else{
      echo $member . ' cound not be found\n';
    }

  }

  return $toReturn;
}

?>