<?php
	#				===== USAGE =====
	#	POST or GET to "IPv4 address"/getChatMessages.php, no forms needed
$username = $_GET["username"];

$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');

if ($buildr->connect_errno) {
	printf("Connect failed: %s\n", $buildr->connect_error);
	echo -1;
	exit();
}

if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$username\"")) {
	if ($result->num_rows < 1) {
		echo 0;
		$result->close();
		$buildr->close();
		exit();
	} else {
		# printf("Select returned %d rows.\n", $result->num_rows);
		$rank = "";
		while ($row = $result->fetch_array()) {
			$rank = $row['rank'];
		}
		echo $rank;
		$result->close();
	}
}
$buildr->close();
?>
