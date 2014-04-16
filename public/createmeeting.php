<?php 
require_once "../database/init.php"; 
require_once "classes/user.php";
?>

<?php
    require_once "./headerNav.php";
?>

<!doctype HTML>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
    <title>Create a Meeting</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/formsettings.css"/>
</head>
<body>
  <div class="row">
		<div class="large-12">
			<h2>Create a Meeting</h2>
		</div>
  </div>
  
	<form>
	  <div class="row">
	    <div class="small-12 large-12 columns">
	      <div class="row">
	        <div class="small-3 columns">
	          <label for="title" class="right inline">Title</label>
	        </div>
	        <div class="small-9 columns">
	          <input type="text" id="title" placeholder="Enter Title">
	        </div>
	      </div>
	      <div class="row">
	        <div class="small-3 columns">
	          <label for="description" class="right inline">Description</label>
	        </div>
	        <div class="small-9 columns">
	          <textarea type="text" id="description" rows="2" placeholder="Enter Description"></textarea>
	        </div>
	      </div>
	      <div class="row">
	        <div class="small-3 columns">
	          <label for="location" class="right inline">Location</label>
	        </div>
	        <div class="small-9 columns">
	          <input type="text" id="location" placeholder="Enter Location">
	        </div>
	      </div>
	      <div class="row">
	        <div class="small-3 columns">
	          <label for="date" class="right inline">Date</label>
	        </div>
	        <div class="small-9 columns">
	          <input type="text" id="date" placeholder="Enter Date">
	        </div>
	      </div>
	      <div class="row">
	        <div class="small-3 columns">
	          <label for="time" class="right inline">Time</label>
	        </div>
	        <div class="small-9 columns">
	          <input type="text" id="time" placeholder="Enter Time">
	        </div>
	      </div>
        
	      <div class="row">
	        <div class="small-3 large-3 columns">
	          <label for="attendees" class="right inline">Attendees</label>
	        </div>
	        <div class="small-9 large-9 columns">
            <textarea type="text" id="attendees" rows="5" placeholder="Enter Individuals and Groups"></textarea>
	        </div>
	      </div>

        <div>
	     		<div class="small-10 large-6 small-centered large-centered columns">
            <a href="#" type="search" class="button nice small radius"><img src="img/search.png"></img>Search</a>
          </div>
        </div>
        
	      <div class="row">
	     		<div class="small-10 large-6 small-centered large-centered columns">
            <a href="#" type="submit" class="button nice small radius">Create</a>
	     		</div>
	      </div>
        
	    </div>
	  </div>
	</form>
</body>
</html>

<?php
  require_once "./bottomNav.php";
?>