<html>
<body>
<?php
	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		exit();
	}
	$data = $_POST['chartMsg'];
	$buildr->query("INSERT INTO user (username, password, email, firstName, lastName) VALUES (\"$data\", \"zoudfhouseh\", \"grr@gmail.com\", \"Gustavo\", \"Rivera\")");
	$buildr->close();
?>
</body>
</html>
