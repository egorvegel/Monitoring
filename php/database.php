<?php
    $server = "localhost";
	$login = "root";
	$pass  = "";
	$name_db = "hospitals";

	$link = mysqli_connect($server, $login, $pass, $name_db);

	if($link == false){
		echo 'Соединение не удалось! ' . mysqli_connect_error();
	}
?>