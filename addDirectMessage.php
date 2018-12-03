<?php
	#				     ===== USAGE =====
	#				POST or GET "message" form
	#			    to "IPv4 address"/addChatMessage.php
	# use $_GET for URL data
	$userOne = $_POST["userOne"];
	$userTwo = $_POST["userTwo"];
	$message = $_POST["message"];
	#$message = $_GET["message"];	

	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		echo -1;
		$buildr->close();
		exit();
	}
	if ($result = $buildr->query("SELECT * FROM friends WHERE user_one = \"$userTwo\" AND user_two = \"$userOne\"")) {
		if ($result->num_rows < 1) {
			echo 0;
			$result->close();
			$buildr->close();
			exit();
		}
	}
	if ($buildr->query("INSERT INTO messages (user_one, user_two, text) VALUES (\"$userOne\", \"$userTwo\", \"$message\")")) {
		echo 1;
	} else {
		printf("Error: %s\n", $buildr->error);
	}
	$buildr->close();
?>
