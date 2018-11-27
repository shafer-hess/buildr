<?php
	#				===== USAGE =====
	#	POST or GET to "IPv4 address"/getChatMessages.php, no forms needed
$location = $_GET["location"];
$username = $_GET["username"];
$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');

if ($buildr->connect_errno) {
	printf("Connect failed: %s\n", $buildr->connect_error);
	echo -1;
	exit();
}
if ($result = $buildr->query("SELECT * FROM models WHERE location = \"$location\" AND (privacy = 0 OR username = \"$username\")")) {
	if ($result->num_rows < 1) {
		echo 0;
		$result->close();
		$buildr->close();
		exit();
	} else if ($result->num_rows == 1) {
		$row = $result->fetch_array();
		$sendThis = "";
		$sendThis = $sendThis . $row['buildData'] . "||" . $row['buildName'] . "||" . $row['username'] . "||" . $row['location'] . "||" . $row['privacy'] . "||" . $row['avatar'] . "||" . $row['upvotes'];
		echo $sendThis;
		$result->close();
	} else {
		# printf("Select returned %d rows.\n", $result->num_rows);
		$sendThis = "";
		while ($row = $result->fetch_array()) {
			$rows[] = $row;
			//$allMessages = $allMessages . $row['data'];
		}
		$rng = $rows[rand(0, $result->num_rows)];
		$sendThis = $sendThis . $rng['buildData'] . "||" . $rng['buildName'] . "||" . $rng['username'] . "||" . $rng['location'] . "||" . $rng['privacy'] . "||" . $rng['avatar'] . "||" . $rng['upvotes'];
		echo $sendThis;
		$result->close();
	}
} else {
	printf("Error: %s\n", $buildr->error);
}
$buildr->close();
?>
