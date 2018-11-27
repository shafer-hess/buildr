<?php
	#				===== USAGE =====
	#	POST or GET to "IPv4 address"/getChatMessages.php, no forms needed
$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');

$username = $_GET["username"];

if ($buildr->connect_errno) {
	printf("Connect failed: %s\n", $buildr->connect_error);
	echo -1;
	exit();
}

if ($result = $buildr->query("SELECT * FROM friends WHERE user_one = \"$username\"")) {
	if ($result->num_rows < 1) {
		echo 0;
		$result->close();
		$buildr->close();
		exit();
	} else {
		# printf("Select returned %d rows.\n", $result->num_rows);
		$friendList = "";
		while ($row = $result->fetch_array()) {
			$friendList = $friendList . " " . $row['user_two'];
		}
		$result->close();
		echo $friendList;
	}
}
$buildr->close();
?>
