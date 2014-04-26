<?php 	
session_start();
foreach (glob("classes/*.php") as $filename)
{
  include $filename;
}

if (isset($_SESSION['email'])){
	$user = new User($_SESSION['email']);
}else{
	header("Location: ./index.php");
}

require_once "./headerNav.php";	
?>
<!doctype HTML>
<html>
 <body>

 </body>
</html>
<?php

require_once "./bottomNav.php";

?>