<?php
	//$success=0;
	function database($user, $pass){
		$success=0;
		if($user=="john1" && $pass=="John1234"){
			$success+=1;
			//$string="Welcome $user\n";
		} else if($user=="sally" && $pass=="Sally123"){
			$success+=1;
		} 
		return $success;
	}
	//$user1=database("john1", "John1234");
	$user1=database("john1", "John1235");
	$tries=0;
	while($tries < 3){
		if($user1 > 0){
			echo "Welcome.\n";
			exit();
		} else {
			$tries++;
			$left=3-$tries;
			echo "Invalid.You have $left attempts left.\n";
		}
	}//while loop
	if($tries == 3){
		echo "Please try again later.\n";
	}
?>
