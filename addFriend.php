<?php
	#				     ===== USAGE =====
	#				POST or GET "message" form
	#			    to "IPv4 address"/addChatMessage.php
	# use $_GET for URL data
	$userOne = $_GET["userOne"];
	$userTwo = $_GET["userTwo"];
	
	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		echo -1;
		$buildr->close();
		exit();
	}
	if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$userTwo\"")) {
		if ($result->num_rows < 1) {
			echo 0;
			$result->close();
			$buildr->close();
			exit();
		}
	}
	if ($buildr->query("INSERT INTO friends (user_one, user_two) VALUES (\"$userOne\", \"$userTwo\")")) {
		echo 1;
	} else {
		printf("Error: %s\n", $buildr->error);
	}
	//$buildr->query("INSERT INTO friends (user_one, user_two) VALUES (\"$userTwo\", \"$userOne\")");
	$buildr->close();
?>
