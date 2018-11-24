<?php
  $output = shell_exec ( "git pull 2>&1" );
  echo "<pre>$output</pre>";
 ?>
