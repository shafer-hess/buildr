<?php
	#				     ===== USAGE =====
	#				POST or GET "message" form
	#			    to "IPv4 address"/addChatMessage.php
	# use $_GET for URL data
	$messageToAdd = $_GET["message"];
	
	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		echo -1;
		$buildr->close();
		exit();
	}
	$buildr->query("INSERT INTO chat (data) VALUES (\"$messageToAdd\")");
	$buildr->close();
	echo 1;
?>
