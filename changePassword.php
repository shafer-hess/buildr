<?php
	#				====== USAGE ======
	#		POST or GET "username", "currpass", "newpass" forms 
	#			to "IPv4 Address"/changePassword.php
	$username = $_GET["username"];
	$currpass = $_GET["currpass"];
	$newpass = $_GET["newpass"];

	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		exit();
	}

	if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$username\"")) {
		if ($row = $result->fetch_array()) { # username exists, continue
			$hashed_pass = $row['password'];
			if (password_verify($currpass, $hashed_pass)) { # current password validated, continue
				$newpass_hash = password_hash($newpass, PASSWORD_DEFAULT);
				if ($buildr->query("UPDATE user SET password = \"$newpass_hash\" WHERE username = \"$username\"")) {
					$to = $row['email'];
					$subject = 'Security Notice Regarding Your Buildr Account';
					$first_name = $row['firstName'];
					$message = "Hello $first_name!\n
							This email was sent to notify you of a settings change to your Buildr Account.\n
							Your account password was recently changed. If this was an unauthorized action, please\n
							contact Buildr's support team to immediately get this issue resolved.\n\n
							Thank you,\n
							Team Buildr\n";
					$headers = 'From: Team Buildr' . "\r\n" .
						'Reply-To: buildr@buildr.gg' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);
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
