<?php
	#				     ===== USAGE =====
	#				POST or GET "message" form
	#			    to "IPv4 address"/addChatMessage.php
	# use $_GET for URL data
	$changelogDate = $_GET["changelogdate"];
	$changelogAdditions = $_GET["changelogadd"];
	$changelogRemoved = $_GET["changelogremove"];
	
	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		echo -1;
		$buildr->close();
		exit();
	}
	$buildr->query("INSERT INTO changelog (date, added, deprecated) VALUES (\"$changelogDate\", \"$changelogAdditions\", \"$changelogRemoved\")");
	$buildr->close();
	echo 1;
?>
