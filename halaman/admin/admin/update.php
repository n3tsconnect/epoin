<?php
if (isset($_POST['payload'])) {
 $output = shell_exec("git pull");
 echo "<pre>$output</pre>";
}
 ?>
<html>
<body>
<p> v3 This is an update page, please ignore.</p>
</body>
</html>
