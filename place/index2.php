<?php
session_start();

include("connection.php");
include("functions.php");

$user_data=check_login2($con);

?>
<!DOCTYPE html>
<html>
<head>
	<title>admin dashboard</title>
</head>
<body>
	<?php
	echo "<h2>This is admin page</h2>";
	?>
	<a class="nav-link" href="logout.php">Logout</a>

</body>
</html>
