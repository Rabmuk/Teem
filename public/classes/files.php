<?php
require_once "../database/init.php";

class File{

  private $file_id = -1;
  private $id_item = -1;
  private $name = '';
  private $location = '';

  public function __construct($param){
    global $db;

    $query = $db->prepare(
      "SELECT `id_item`, `name`, `location` FROM `files` WHERE `file_id` = :file_id"
      );
    $query->execute(array(":file_id" => $param));
    $file = $query->fetch();
    if (!$file) return;

    $this->file_id = $param;
    $this->id_item = $file->id_item;
    $this->name = $file->name;
    $this->location = $file->location;
  }

  public function getID(){
    return $this->file_id;
  }

  public function getName(){
    return $this->name;
  }

  public function getLocation(){
    return $this->location;
  }

}

// created new file rows for the database
function addFileToItem($id_item, $name, $location){
  global $db;
  
  $query = $db->prepare(
    "INSERT INTO `files` (`id_item`, `name`, `location`)
    VALUES (:id_item, :name, :location)"
    );
  $query->execute(array(
    ":id_item" => $id_item,
    ":name" => $name,
    ":location" => $location
    ));
}

?>