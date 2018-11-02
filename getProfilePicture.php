<?php
	#				====== USAGE ======
	#			    POST or GET "username" form 
	#		      to "IPv4 Address"/getProfilePicture.php
	$username = $_GET["username"];

	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		echo -1;
		exit();
	}
	if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$username\"")) {
		if ($row = $result->fetch_array()) { # username exists, continue
			$returnPicture = $row['picture'];
			echo $returnPicture;
			$result->close();
		} else { # username was not found, abort
			echo 3;
			$result->close();
		}
	} else { # error during query ???, abort
		echo -1;
	}
	$buildr->close();
?>
