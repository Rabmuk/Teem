<!--header, yo-->
<?php
    require_once "headerNav.php";
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
  	<!--all links-->
    <meta charset="utf-8" />
    <title>Contact</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="js/contactscripts.js" type="text/javascript"></script>
  </head>

<body>
<div id = "specialwrapper">
    <div class="row" id="contact">
     	 <div class="large-12 columns">

	        <!-- Start #contact -->
			<?php include "php_helpers/contactphpbit.php" ?>

				
		        <?php if(isset($emailSent) && $emailSent == true) { ?>
	            <!--sent email notification if you send it right-->    
		       	<div class="large-6 columns">
	                <p class="info">Your email was sent. Huzzah!</p>
	            </div>
	            <?php } else { ?>
	            <!--title/explanation-->
	            <h1 style="color:black;">Contact Us</h1>
				<p class="desc">You can use this contact form to report any bugs, ask a question, or send a message to the team. All fields are required.</p>
				<!--if there's an error, don't send it yet-->
				<?php if(isset($hasError) || isset($captchaError) ) { ?>
	                <p id="alert">Error submitting the form.</p>
	            <?php } ?>
				
				
	            <!--physical form starts-->
				<form id="contact-us" class="" action="#" method="post">
					<div class="row">
						<div class="large-6 columns">
							<!--enter name-->
							<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField messageinput name" placeholder="Name" onclick="clearTextArea(this);"/>
							<?php if($nameError != '') { ?>
								<br /><span class="error"><?php echo $nameError;?></span> 
							<?php } ?>
						</div>
					</div>
	                
					<div class="row">
						<div class="large-6 columns">
							<!--enter email address-->
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="txt requiredField email messageinput" placeholder="Email" onclick="clearTextArea(this);" />
							<?php if($emailError != '') { ?>
								<br /><span class="error"><?php echo $emailError;?></span>
							<?php } ?>
						</div>
					</div>
	                
					<div class="row">
						<div class="large-6 columns">
							<!--enter message to send-->
							 <textarea name="comments" id="commentsText" class="txtarea requiredField messageinput messageinputtextarea message" placeholder="Message" onclick="clearTextArea(this);"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
								<br /><span class="error"><?php echo $commentError;?></span> 
							<?php } ?>
						</div>
					</div>
						<!--submit that jazz-->
	                	<button class = "button" name="submit" type="submit" id="submitbutton">Send</button>
						<input type="hidden" name="submitted" id="submitted" value="true" />
				</form>			
				<?php } ?>
		    
		    
		    <!-- End #contact -->
		</div>
	</div>
</div>
</body>
<!--footer, yo-->
<?php
  require_once "bottomNav.php";

?>
