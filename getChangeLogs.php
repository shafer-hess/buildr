<?php
	#				===== USAGE =====
	#	POST or GET to "IPv4 address"/getChatMessages.php, no forms needed
$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');

if ($buildr->connect_errno) {
	printf("Connect failed: %s\n", $buildr->connect_error);
	echo -1;
	exit();
}

if ($result = $buildr->query("SELECT * FROM changelog")) {
	if ($result->num_rows < 1) {
		echo 0;
		$result->close();
		$buildr->close();
		exit();
	} else {
		# printf("Select returned %d rows.\n", $result->num_rows);
		$entry = "";
		while ($row = $result->fetch_array()) {
			$entry = $entry . $row['date'];
			$entry = $entry . " " . $row['added'];
			$entry = $entry . " " . $row['deprecated'];

			echo "\n";
			echo $entry;
		}
		$result->close();
	}
}
$buildr->close();
?>
