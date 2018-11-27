<?php
	#				===== USAGE =====
	#	POST or GET to "IPv4 address"/getChatMessages.php, no forms needed
$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');

$userOne = $_GET["user_one"];
$userTwo = $_GET["user_two"];
if ($buildr->connect_errno) {
	printf("Connect failed: %s\n", $buildr->connect_error);
	echo -1;
	exit();
}

if ($result = $buildr->query("SELECT * FROM messages WHERE (user_one = \"$userOne\" AND user_two = \"$userTwo\") OR (user_one = \"$userTwo\" AND user_two = \"$userOne\")")) {
	if ($result->num_rows < 1) {
		echo 0;
		$result->close();
		$buildr->close();
		exit();
	} else {
		# printf("Select returned %d rows.\n", $result->num_rows);
		$message = "";
		while ($row = $result->fetch_array()) {
			$message = $message . $row['user_one'];
			$message = $message . " " . $row['user_two'];
			$message = $message . " " . $row['text'] . "||";	
		}
		echo $message;
		$result->close();
		//echo $friendList;
	}
}
$buildr->close();
?>
