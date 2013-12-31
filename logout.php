<?php
	require("app/engine.php");
	
	session_regenerate_id(true);

	$cookie = session_get_cookie_params();

	setcookie(session_name(), '', 0, $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly']);
    
	unset($_SESSION["loggedin"]);

	unset($_SESSION["username"]);

	unset($_SESSION["password"]);

	session_destroy();

	header("Location: index.php?error=7");
