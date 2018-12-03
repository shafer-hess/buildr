<?php
	#				====== USAGE ======
	#		POST or GET "username", "currpass", "newemail" forms 
	#			to "IPv4 Address"/changeEmail.php
	$username = $_GET["username"];
	$currpass = $_GET["currpass"];
	$newemail = $_GET["newemail"];

	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		exit();
	}

	if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$username\"")) {
		if ($row = $result->fetch_array()) { # username exists, continue
			$hashed_pass = $row['password'];
			$curremail = $row['email'];
			if (password_verify($currpass, $hashed_pass)) { # current password validated, continue
				if ($buildr->query("UPDATE user SET email = \"$newemail\" WHERE username = \"$username\"")) {
					$to = $curremail;
					$subject = 'Presidential Alert';
					$first_name = $row['firstName'];
					$message = "Hello $first_name!\n
							This email was sent to notify you of a settings change to your Buildr Account.\n
							Your account email address was recently changed. If this was an unauthorized action, please\n
							contact Buildr's support team to immediately get this issue resolved.\n\n
							Thank you,\n
							Team Buildr\n";
					$headers = 'From: Team Buildr' . "\r\n" .
						'Reply-To: buildr@buildr.gg' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);

					$to2 = $newemail;
					$subject2 = 'Presidential Alert';
					$first_name = $row['firstName'];
					$message2 = "Hello $first_name!\n
							This email was sent to notify you of a settings change to your Buildr Account.\n
							Your account email address was recently changed to this email address.\n
							If this was an unauthorized action, please contact Buildr's support team to\n
							immediately get this issue resolved.\n\n
							Thank you,\n
							Team Buildr\n";
					$headers2 = 'From: Team Buildr' . "\r\n" .
						'Reply-To: buildr@buildr.gg' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
					mail($to2, $subject2, $message2, $headers2);
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
