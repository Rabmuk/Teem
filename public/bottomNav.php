<!-- This is the header navigation for pages when a user is logged in. --> 

<?php
?>
    <footer class="row">
        <div class="large-6 columns">
          <p>©Team SnapChatRoulette</p>
        </div>
        <div class="large-6 columns">
          <ul class="inline-list right">

<<<<<<< HEAD
  <footer id="footer">
          <ul class="inline-list">
             <li><a href="index.php">Home</a></li>
             <li><a href="about.php">About</a></li>
             <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </div>
    </footer>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script>
     $(window).bind("load", function () {
      var footer = $("#footer");
      var pos = footer.position();
      var height = $(window).height();
      height = height - pos.top;
      height = height - footer.height();
      if (height > 0) {
          footer.css({
              'margin-top': height + 'px'
          });
      }
    });
    </script>
=======
 <footer class="row footer">
    
    <div class="large-9 columns">
      <ul class="inline-list left">
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
    </div>

    <div class="large-3 columns">
        <p>&copy; Team SnapChatRoulette</p>
    </div>
  </footer>
>>>>>>> 1a1da9670dfb0e701f332299d93a1d80f8eeeb11

</html>
