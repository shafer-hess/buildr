<?php
	#				     ===== USAGE =====
	#				POST or GET "message" form
	#			    to "IPv4 address"/addChatMessage.php
	# use $_GET for URL data
	$build_data = $_POST["buildData"];
	$build_name = $_POST["buildName"];
	$username = $_POST["userName"];
	$location = $_POST["location"];
	$privacy = $_POST["privacy"];
	$avatar = $_POST["avatar"];
	//$upvotes = $_GET["upvotes"];
	echo $build_data;
	echo $build_name;
	echo $username;
	echo $location;
	echo $privacy;
	echo $avatar;

	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		echo -1;
		$buildr->close();
		exit();
	}
	if ($buildr->query("INSERT INTO models (buildData, buildName, username, location, privacy, avatar) VALUES (\"$build_data\", \"$build_name\", \"$username\", \"$location\", \"$privacy\", \"$avatar\")")) {
		echo 1;
	} else {
		printf("Error: %s\n", $buildr->error);
		echo 0;
	}
	$buildr->close();
?>
