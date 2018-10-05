<?php
	#				====== USAGE ======
	#		php simpleChange.php <username> <newpassword>
	#			argv[0]        argv[1]     argv[2]
	$username = $argv[1];
	$newpass = $argv[2];

	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		exit();
	}
	
	if ($buildr->query("UPDATE user SET password = \"$newpass\" WHERE username = \"$username\"")) {
		$to = 'hess33@purdue.edu';
		$subject = 'Presidential Alert';
		$message = "$username's password was successfully changed to $newpass\n";
		$headers = 'From: Team Buildr' . "\r\n" .
			'Reply-To: buildr@buildr.gg' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
		printf("$username's password was successfully changed to $newpass\n");
		#$result->close();
	} else {
		printf("Error changing $username's password to $newpass\n");
	}
	$buildr->close();
?>
