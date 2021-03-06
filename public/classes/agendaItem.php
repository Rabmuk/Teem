<?php
require_once "../database/init.php";

class AgendaItem{

  private $item_id = -1;
  private $id_meeting = -1;
  private $id_user = -1;
  private $heading = '';
  private $topics = '';
  private $allottedMinutes = -1;
  private $itemOrder = -1;

  public function __construct($param){
    global $db;
    
    $query = $db->prepare(
      "SELECT * FROM `agendaItems` WHERE `item_id` = :item_id"
      );
    $query->execute(array(":item_id" => $param ));
    $item = $query->fetch();

    if (!$item) {return ; }

    $this->item_id = $param;
    $this->id_meeting = $item->id_meeting;
    $this->id_user = $item->id_user;
    $this->heading = $item->heading;
    $this->topics = $item->topics;
    $this->allottedMinutes = $item->allottedMinutes;
    $this->itemOrder = $item->itemOrder;
  }

  public function getID(){
    return $this->item_id;
  }

  //if the item does not exist item_id will be -1
  public function exists(){
    return $this->item_id >= 0;
  }

  public function getTime(){
    return $this->allottedMinutes;
  }

  public function getPresenter(){;
    return new User((Integer)$this->id_user);
  }

  public function getHeading(){
    return $this->heading;
  }

  // returns an array of topics for the given item
  public function getTopics(){
    global $db;

    $toReturn = array();

    $query = $db->prepare(
     "SELECT `topic`
     FROM topics
     WHERE id_item = :id_item"
     );
    $query->execute(array(":id_item" => $this->item_id));
    while ($row = $query->fetch()) {
      array_push($toReturn, $row->topic);
    }

    return $toReturn;
  }

  // returns an array of file objects
  public function getFiles(){
    global $db;

    $toReturn = array();

    $query = $db->prepare(
     "SELECT `file_id` FROM files
     WHERE id_item = :id_item"
     );
    $query->execute(array(":id_item" => $this->item_id));
    while ($row = $query->fetch()) {
      array_push($toReturn, new File($row->file_id));
    }

    return $toReturn;
  }

  //clears the topics for a given item
  public function clearTopics(){
    global $db;

    $query = $db->prepare(
      "DELETE FROM `topics` WHERE `id_item` = :id_item"
      );
    $query->execute(array(
      ":id_item" => $this->item_id
      ));
  }

}

// adds a new agenda item to the database and then returns the item as an object
function addAgendaItemToDatabase($id_meeting, $id_user, $topics, $allottedMinutes, $itemOrder){
  $query = $db->prepare(
    "INSERT INTO `agendaItems` (`id_meeting`, `id_user`, `topics`, `allottedMinutes`, `itemOrder`)
    VALUES (:id_meeting:, :id_user, :topics, :allottedMinutes, :itemOrder)"
    );
  $query->execute(array(
    ":id_meeting" => $id_meeting,
    ":id_user" => $id_user,
    ":topics" => $topics,
    ":allottedMinutes" => $allottedMinutes,
    ":itemOrder" => $itemOrder
    ));

  //callback on the item that was just created
  $query = $db->prepare(
    "SELECT `item_id` FROM `agendaItems` WHERE `id_meeting` = :id_meeting AND `id_user` = :id_user AND `topics` = :topics"
    );
  $query->execute(array(
    ":id_meeting" => $id_meeting,
    ":id_user" => $id_user,
    ":topics" => $topics
    ));
  $item = $query->fetch();

  return new AgendaItem($item->item_id);
}

function addTopicsToItem($item_id, $topics){
  global $db;
  $topicArray = explode("\n", $topics);

  foreach ($topicArray as $topic) {
    $query = $db->prepare(
      "INSERT INTO `topics` (`id_item`, `topic`)
      VALUES (:id_item, :topic)"
      );
    $query->execute(array(
      ":id_item" => $item_id,
      ":topic" => $topic
      ));
  }


}

?>