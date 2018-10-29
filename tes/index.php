<html>
<head>
<title>Testing</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


</head>
<body>
<?php
include('../konfigurasi/koneksi.php');
$user = esc_trim($_GET['fds']);
echo mysqli_real_escape_string($koneksi, $user);
?>
</body>
</html>
