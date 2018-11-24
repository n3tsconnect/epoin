<?php
  $output = shell_exec ( "/usr/bin/git pull" );
 ?>
 <html>
 <body>
   <pre>
     <?php echo $output; ?>
   </pre>
 </body>
 </html>
