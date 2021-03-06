<?php 	
session_start();
// Includes all class files for use in this document
foreach (glob("classes/*.php") as $filename)
{
  include $filename;
}
// check if there is an email currently in this session. If yes construct a new User with that email, else go back to the index page
if (isset($_SESSION['email'])){
  $user = new User($_SESSION['email']);
}else{
  header("Location: ./index.php");
}
// Same concept as above, but constructing a new case of Group 
if (isset($_GET['id'])){
  $group = new Group($_GET['id']);
}else{
  header("Location: ./index.php");
}
// Check if the id of this user is the owner of the group
if (!$group->checkOwner($user->getID())) {
  header("Location: ./index.php"); 
}



// switch creation for submit2, leaving it switch in case of addition of more inputs
switch ($_POST['submit2']) {
    case 'Save':
    $group = new Group($_GET['id']);
    $memberarray = $group->getMemberArrayID();
    $groupid = $group->getID();
    $groupname = $group->getName();
    $email_user = $user->getEmail();

    // if(isset($_POST['deleteAcc'])){

    //   //$id_owner = $user->getID();
    //   //deleteGroup($id_owner);


    //   //header("Location: ./profile.php");
    // }
    // if the checklist is not empty, loop through the array deleting the members whose ids are checked using the deleteMember funtion
    if(!empty($_POST['check_list'])) {
      foreach($_POST['check_list'] as $check) {
        deleteMember($check); 
        }
      }
    // Changing group name
    $newgroupname = $_POST['changeName'];
    if($newgroupname != $groupname){
      changeGroupName($groupid, $newgroupname);
    }
    
    // Adding group member
    $newmember = $_POST['addMember'];
    if($newmember != ''){
      addMember($newmember, $groupid);
      // echo $id_owner;
    }
  break;
}

// switch for secon form submission. In case "Yes" delete the group in case "No" do nothing
switch ($_POST['submit']) {
    case "Yes":
      $group->deleteGroup();
      header("Location: ./index.php");
      break;
    case "No":
    break;
}


require_once "./headerNav.php";	
?>
<!doctype HTML>
<html>
<head>
  <title>Edit Group</title>
  <link rel="stylesheet" type="text/css" href="css/foundation.css" />
  <link rel="stylesheet" type="text/css" href="css/editgroup.css"/>
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
 <body>
  <div id = "specialwrappereditgroup">
    <div class="row">
      <div class="large-12 columns">
        <h1> Edit Group </h1>
      </div>
    </div>
    <?php 
    // constructing new Group element
      if (isset($_GET['id'])) {
        $group = new Group($_GET['id']);
      }
    ?>
    <!-- on submission send data to the location specified -->
    <form action=<?php echo '"?id=' . $_GET['id'] . '"';?> method="post">
      <div class="row">
        <div class="small-3 columns">
          <label for="changeName" class="right inline">Change Group Name: </label>
        </div>
        <div class="small-9 columns">
          <input type="text" id="changeName" name="changeName" value="<?php echo $group->getName(); ?>">
        </div>
      </div>
      <div class="row">
        <div class="small-3 columns">
          <label for="addMember" class="right inline">Add Members</label>
        </div>
        <div class="small-9 columns">
          <input type="text" id="addMember" name="addMember" placeholder="Enter Member Name">
        </div>
      </div>
      <div class="row">
        <div class="small-3 columns">
          <label for="deleteMemembers" class="right inline">Delete Members</label>
        </div>
        <div class="small-9 columns">
        <?php
        // creation of two arrays
        // First one is an array of Member ID's
        // Second one is an array of Member emails
        // set the value to the ID so you can use it in the delete function above
        // use the member email to display in the check box
          $counter = 0;
          $memberarray = $group->getMemberArrayID();
          $members = $group->getMemberArray();
          foreach ($memberarray as $value) {
            if($counter == 0){
              echo "<li>" . $members[$counter] . "</li>";
            }
            else{
            echo "<li><input type='checkbox' name='check_list[]' alt='Checkbox' value=$value>" . $members[$counter] . "</label></input></li>";
          }
            $counter++;
          }
          ?>
        </div>
      </div>
      <div class="row">
        <div class="large-7 columns"><p></p></div>
        <div class="large-3 columns">
          <!-- Cool Popup menu for delete group -->
          <a href="#" data-reveal-id="myModal" class="button expand" data-reveal>Delete Group</a>
        </div>
        <div class="large-2 columns">
          <input type="submit" name="submit2" value="Save" class="button expand"></input>
        </div>
      </div>
    </form>
      <div id='myModal' class='reveal-modal small' data-reveal>
        <p class="text-center">Are you sure you want to delete your group?</p>
        <div class="row">
          <div class="large-3 columns"><p></p></div>
          <form method="post">
          <div class="large-3 columns">
            <input type="submit" name="submit" value="Yes" class="button expand"></input>
          </div>
          <div class="large-3 columns">
            <input type="submit" name="submit" value="No" class="button expand"></input>
          </div>
          <div class="large-3 columns"><p></p></div>
        </div>
        </form>
        <a class="close-reveal-modal">&#215;</a>
      </div>
  </div>
  <script type="text/javascript" src="js/foundation/foundation.js"></script>
  <script type="text/javascript" src="js/foundation/foundation.reveal.js"></script>
  <script> $(document).foundation(); </script>
  </div>
 </body>
</html>

<?php
require_once "./bottomNav.php";
?>