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

function addMeetingToDatabase($title, $location, $date, $startTime, $members){
  global $db;

  $query = $db->prepare(
    "INSERT INTO `meetings` (`title`, `location`, `date`, `startTime`)
    VALUES (:title, :location, :date, :startTime)"
    );
  $query->execute(array(
    ":title" => $title,
    ":location" => $location,
    ":date" => $date,
    ":startTime" => $startTime
    ));

  $query = $db->prepare(
    "SELECT `meeting_id` FROM `meetings` WHERE `title` = :title 
    AND `location` = :location AND `date` = :date"
    );
  $query->execute(array(
    ":title" => $title, 
    ":location" => $location, 
    ":date" => $date
    ));
  $meeting = $query->fetch();

  $toReturn = new Meeting($meeting->meeting_id);

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
        "INSERT INTO `meetingMembers` (`id_meeting`, `id_user`)
        VALUES (:id_meeting, :id_user)"
        );
      $query->execute(array(
        ":id_meeting" => $meeting->meeting_id,
        ":id_user" => $user->user_id
        ));
    }else{
      $query = $db->prepare(
        "SELECT `group_id` FROM `groups` WHERE `name` = :name"
        );
      $query->execute(array(
        ":name" => $member
        ));
      $group = $query->fetch();
      if ($group) {
        $query = $db->prepare(
          "SELECT `id_user` FROM `groupMembers` WHERE `id_group` = :id_group"
          );
        $query->execute(array(
          ":id_group" => $group->group_id
          ));
        while ($row = $query->fetch()) {
          $query = $db->prepare(
            "INSERT INTO `meetingMembers` (`id_meeting`, `id_user`)
            VALUES (:id_meeting, :id_user)"
            );
          $query->execute(array(
            ":id_meeting" => $meeting->meeting_id,
            ":id_user" => $row->id_user
            ));
        }
      }else{
        echo $member . ' cound not be found\n';  
      }
    }

  }

  return $toReturn;
}

?>