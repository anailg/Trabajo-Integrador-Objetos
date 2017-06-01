<?php

	require_once("soporte.php");
	$auth->logout();
	header("Location:main.php");exit;
	