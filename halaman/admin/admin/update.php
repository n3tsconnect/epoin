<?php
if (isset($_POST['payload'])) {
 exec("git pull",$out);
	foreach($out as $key => $value)	{
	    echo $key." ".$value."<br>";
	}
}
 ?>
<html>
<body>
<p> This is an update page, please ignore.</p>
</body>
</html>
