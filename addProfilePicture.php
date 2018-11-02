<?php
	#				====== USAGE ======
	#		POST or GET "username", "currpass", "picture" forms 
	#			to "IPv4 Address"/addProfilePicture.php
	$username = $_GET["username"];
	$currpass = $_GET["currpass"];
	$newpicture = $_GET["picture"];

	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		echo -1;
		exit();
	}
	if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$username\"")) {
		if ($row = $result->fetch_array()) { # username exists, continue
			$hashed_pass = $row['password'];
			if (password_verify($currpass, $hashed_pass)) { # current password validated, continue
				if ($buildr->query("UPDATE user SET picture = \"$newpicture\" WHERE username = \"$username\"")) {
					echo 1; # successfully changed, process code = 1
				} else { # there was an error ???, abort
					echo -1;
				}
			} else { # current password does not match, abort
				echo 0;
			}
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
