<?php 

	session_start();

	if (isset($_SESSION['username'])) {
		session_destroy();
		header("location:../views/loginView.php");
	}
	else{
		header("location:../views/loginView.php");
	}

?>