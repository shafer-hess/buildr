<?php
	#				====== USAGE ======
	#		POST or GET "username", "currpass", "newusername" forms 
	#			to "IPv4 Address"/changePassword.php
	$username = $_GET["username"];
	$currpass = $_GET["currpass"];
	$newusername = $_GET["newusername"];

	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		exit();
	}

	if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$username\"")) {
		if ($row = $result->fetch_array()) { # username exists, continue
			$hashed_pass = $row['password'];
			if (password_verify($currpass, $hashed_pass)) { # current password validated, continue
				if ($result2 = $buildr->query("SELECT * FROM user WHERE username = \"$newusername\"")) { # check if new desired username is taken
					if ($result2->num_rows > 0) { # username already taken, abort
						echo 2; # username already taken, abort
					} else { # username is not taken, continue
						if ($buildr->query("UPDATE user SET username = \"$newusername\" WHERE username = \"$username\"")) {
							$to = $row['email'];
							$subject = 'Security Notice Regarding Your Buildr Account';
							$first_name = $row['firstName'];
							$message = "Hello $first_name!\n
									This email was sent to notify you of a settings change to your Buildr Account.\n
									Your account username was recently changed from $username to $newusername.\n
									If this was an unauthorized action, please contact Buildr's support team to\n
									immediately get this issue resolved.\n\n
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
					}
					$result2->close();
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
