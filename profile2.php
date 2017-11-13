<!DOCTYPE html>
<html>
<title>register</title>

<?php
include "include.php";
include "header.php";

echo '<h2>Edit your profile</h2>';

if (!isset($_SESSION["userid"])){
	echo 'Sorry, you have to be <a href="signin.php">signed in</a> to see your profile.';
}
else{
	echo '<h3>Hi'.$_SESSION["uname"].'</h3>';
	
}