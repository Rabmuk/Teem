<?php
    require_once "./headerNav.php";
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <title>YO</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="js/index.js" type="text/javascript"></script>
    <script src="js/contactscripts.js" type="text/javascript"></script>
  </head>

    <div class="row">
      <div class="large-12 columns">
<h1>Get in touch.</h1>
	            <!-- Start #contact -->
				<?php include "php_helpers/contactphpbit.php" ?>
				<div id = "contactbox" style="background-color:lightgrey;">
		
			        <?php if(isset($emailSent) && $emailSent == true) { ?>
		                <p class="info">Your email was sent. Huzzah!</p>
		            <?php } else { ?>
					<p class="desc">You can use this contact form to report any bugs, ask a question, or send a message to the team. All fields are required.</p>
				
					<?php if(isset($hasError) || isset($captchaError) ) { ?>
                        <p id="alert">Error submitting the form.</p>
                    <?php } ?>
				
					<form id="contact-us" action="#" method="post">
						<div class="formblock">
							<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField messageinput name" placeholder="Name" onclick="clearTextArea(this);"/>
							<?php if($nameError != '') { ?>
								<br /><span class="error"><?php echo $nameError;?></span> 
							<?php } ?>
						</div>
                        
						<div class="formblock">
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="txt requiredField email messageinput" placeholder="Email" onclick="clearTextArea(this);" />
							<?php if($emailError != '') { ?>
								<br /><span class="error"><?php echo $emailError;?></span>
							<?php } ?>
						</div>
                        
						<div class="formblock">
							 <textarea name="comments" id="commentsText" class="txtarea requiredField messageinput messageinputtextarea message" placeholder="Message" onclick="clearTextArea(this);"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
								<br /><span class="error"><?php echo $commentError;?></span> 
							<?php } ?>
						</div>
                        
							<button name="submit" type="submit" id="submitbutton">Send</button>
							<input type="hidden" name="submitted" id="submitted" value="true" />
					</form>			
					<?php } ?>
			    </div>
			    <!-- End #contact -->
			    </div>
			    </div>
<?php

  require_once "./bottomNav.php";

?>