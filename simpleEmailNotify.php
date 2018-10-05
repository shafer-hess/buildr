<?php
	$to = 'hess33@purdue.edu'
	$subject = 'Presidential Alert'
	$message = 'man mail notify, monitor.sh'
	$headers = 'From: Buildr Team' . "\r\n" .
		'Reply-To: buildr@buildr.gg' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
?>
