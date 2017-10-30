<?php
	session_start();
	require 'connection.php';
	date_default_timezone_set("Asia/Manila");
	$date = date("Y-m-d");
	$date_time = date("Y-m-d h:i:sa");

	$usernameErr = $passwordErr = $current_passwordErr = $new_passwordErr = $repeat_passwordErr = $edit_item_idErr = $item_nameErr = $item_categoryErr = $item_descriptionErr = $item_critical_lvlErr = $quantityErr = $uomErr = $received_by = "";
	$username = $txtpassword  = $current_password  = $new_password  = $repeat_password  = $edit_item_id  = $item_name  = $item_category  = $item_description  = $item_critical_lvl  = $quantity = $received_by = $remarks = "";

	function clean($data) {
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    if (empty($_POST["username"])) {
	        $usernameErr = "Username is required";
	    } else {
	        $username = clean($_POST["username"]);
	    }

	}   


?>