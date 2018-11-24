<?php
if (isset($_POST['updatebutton'])) {
  $output = shell_exec ( "ls -a" );
}
 ?>
 <html>
 <body>
   <form method="post">
     <button name="updatebutton">Update</button>
   </form>
   <pre>
     <?php echo $output; ?>
   </pre>
 </body>
 </html>
