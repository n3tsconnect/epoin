<?php
if (isset($_POST['payload'])) {
 $shell = exec("git pull", $result);
 print_r($result);
}
 ?>
<html>
<body>
<p> v5 This is an update page, please ignore.</p>
</body>
</html>
