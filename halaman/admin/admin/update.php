<?php
if (isset($_POST['payload'])) {
  $output = shell_exec ( "git pull" );
}
 ?>
