<?php require_once "./db/init.php"; ?>

<?php 
    $query = $db->prepare(
      "SELECT * FROM `users`"
      );
    $query->execute();
    while ($user = $query->fetch()) {
      // print_r($artist);
      ?>
      <h4><?php echo $user->email ?></h4>
      <?php
    }
    ?>