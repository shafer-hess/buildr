<?php
	#				===== USAGE =====
	#	POST or GET to "IPv4 address"/getChatMessages.php, no forms needed
$build_name = $_GET["buildName"];
$username = $_GET["username"];

$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');

if ($buildr->connect_errno) {
	printf("Connect failed: %s\n", $buildr->connect_error);
	echo -1;
	exit();
}
if ($buildr->query("UPDATE models SET upvotes = upvotes + 1 WHERE username = \"$username\" AND buildName = \"$build_name\"")) {
	echo 1;
} else {
	printf("Error: %s\n", $buildr->error);
	echo 0;
}
$buildr->close();
?>
