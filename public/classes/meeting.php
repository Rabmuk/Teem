<?php
require_once "../database/init.php";

class Meeting{

  private $meeting_id = -1;
  private $title = '';
  private $description = '';
  private $location = '';
  private $date = '';
  private $startTime = '';
  private $endTime = '';
  
  public function __construct($param){
    global $db;
    
    $query = $db->prepare(
      "SELECT * FROM `meetings` WHERE `meeting_id` = :meeting_id"
      );
    $query->execute(array(":meeting_id" => $param ));
    $meeting = $query->fetch();

    if (!$meeting) { return ; }

    $this->meeting_id = $param;
    $this->title = $meeting->title;
    $this->description = $meeting->description;
    $this->location = $meeting->location;
    $this->date = $meeting->date;
    $this->startTime = $meeting->startTime;
    $this->endTime = $meeting->endTime;
  }

  public function exists(){
    return $this->meeting_id >= 0;
  }

  public function getTitle(){
    return $this->title;
  }

  public function getDescription(){
    return $this->description;
  }

  public function getDate(){
    return $this->date;
  }

  public function getTime(){
    return $this->startTime; 
  }

  public function getID(){
    return $this->meeting_id;
  }

  public function checkMember($id_user){
    global $db;
    $query = $db->prepare(
      "SELECT * FROM `meetingMembers` WHERE `id_user` = :id_user AND `id_meeting` = :id_meeting"
      );
    $query->execute(array(
      ":id_user" => $id_user,
      ":id_meeting" => $this->meeting_id
      ));
    $meeting = $query->fetch();
    if ($meeting) {
      return true;
    }
    return false;
  }

  public function getAgendaItems(){
    global $db;

    $toReturn = array();

    $query = $db->prepare(
     "SELECT `item_id`
     FROM agendaItems
     WHERE id_meeting = :id_meeting"
     );
    $query->execute(array(":id_meeting" => $this->meeting_id));
    while ($row = $query->fetch()) {
      array_push($toReturn, new agendaItem($row->item_id));
    }

    return $toReturn;
  }

}

function addMeetingToDatabase($title, $id_owner, $location, $date, $startTime, $members){
  global $db;

  $query = $db->prepare(
    "INSERT INTO `meetings` (`id_owner`, `title`, `description`, `location`, `date`, `startTime`)
    VALUES (:id_owner, :title, :description, :location, :date, :startTime)"
    );
  $query->execute(array(
    ":id_owner" => $id_owner,
    ":title" => $title,
    ":description" => "",
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

  $insertQuery = $db->prepare(
    "INSERT INTO `meetingMembers` (`id_meeting`, `id_user`)
    VALUES (:id_meeting, :id_user)"
    );
  $insertQuery->execute(array(
    ":id_meeting" => $meeting->meeting_id,
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
          $insertQuery = $db->prepare(
            "INSERT INTO `meetingMembers` (`id_meeting`, `id_user`)
            VALUES (:id_meeting, :id_user)"
            );
          $insertQuery->execute(array(
            ":id_meeting" => $meeting->meeting_id,
            ":id_user" => $row->id_user
            ));
        }
      }else{
        echo '<p>' . $member . ' cound not be found</p>';
      }
    }

  }

  return $toReturn;
}

function addItemToMeeting($meeting_id, $heading, $allottedTime, $presenter){
  global $db;

  $user = new User($presenter);

  $query = $db->prepare(
    "INSERT INTO `agendaItems` (`id_meeting`, `id_user`, `heading`, `allottedMinutes`)
    VALUES (:id_meeting, :id_user, :heading, :allottedMinutes)"
    );
  $query->execute(array(
    ":id_meeting" => $meeting_id,
    ":id_user" => $user->getID(),
    ":heading" => $heading,
    ":allottedMinutes" => $allottedTime
    ));
}

?>