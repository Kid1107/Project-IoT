<?php 
	session_start();
		$mode=$_GET['md'];
		file_put_contents('mode.text',$mode);

 ?>