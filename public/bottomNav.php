<!-- This is the header navigation for pages when a user is logged in. --> 

<?php
?>
 <link rel="stylesheet" href="css/foundation.css" />
    <footer class="row">
        <div class="large-6 columns">
          <p>©Team SnapChatRoulette</p>
        </div>
        <div class="large-6 columns">
          <ul class="inline-list right">
             <li><a href="index.php">Home</a></li>
             <li><a href="about.php">About</a></li>
             <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </div>
    </footer>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script>
    $(window).bind("load", function() {
      var footer = $("footer");
      var pos = footer.position();
      var height = $(window).height();
      height = height - pos.top;
      height = height - footer.height();
      if (height > 0) {
        footer.css({'margin-top' : height+'px'});
      }
    });
    </script>

</html>
