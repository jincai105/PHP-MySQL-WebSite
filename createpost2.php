<!DOCTYPE html>
<html>
<title>createpost</title>

<?php
//This page displays the list of the user's message
include "include.php";
include "header.php";

echo '<h2>Create a post</h2>';
if(!isset($_SESSION['userid'])){
	//the user is not signed in
	echo 'Sorry, you have to be <a href="/forum/signin.php">signed in</a> to create a post.';
}
else{
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown
		echo '<br>
		<form action = "" method="POST">
		<br>
		Choose a group<br>
		<select name="group">

		<option value="friends">friends</option>
		<option value="neighbors">neighbors</option>
		<option value="hood">hood</option>
		<option value="block">block</option>
		</select>
    	</br>

    	Choose a subject<br>
    	<select name="subject">

		<option value="General">General</option>
		<option value="Free items">Free items</option>
		<option value="Lost&Found">Lost&Found</option>
		<option value="Crime&Safety">Crime&Safety</option>
		</select>
		<br />
		add location <input type="text" name="location"/><br>
		<br>
		title  <input type="text" name="title"/><br/>
		<textarea name="post_content" /></textarea><br /><br />
		<input type = "submit" value = "Create post">
		</form>';
	}
	else
	{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = $mysqli->query($query);
		
		if($_POST["location"] != NULL){
			$address = mysqli_real_escape_string($mysqli,$_POST['location']);
			$googleAddress = str_replace(" ","+",$address);
	        $url = "http://maps.google.com/maps/api/geocode/json?address=$googleAddress&sensor=false";
	        $ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	        $response = curl_exec($ch);
	        curl_close($ch);
	        $response_a = json_decode($response);
	        $lat = $response_a->results[0]->geometry->location->lat;
            $long = $response_a->results[0]->geometry->location->lng;
			if(!isset($lat))
			{
				echo '<h3>Illegal address!</h3><br>
				<form action = "" method="POST">
				<p><strong>group</strong>:<input type="hidden" name="group" value="'.$_POST['group'].'"/>'.$_POST['group'].'<br/>
				<strong>subject</strong>:<input type="hidden" name="subject" value="'.$_POST['subject'].'"/>'.$_POST['subject'].'<br/>
				<strong>add location</strong> <input type="text" name="location"/><br>
				<strong>title</strong>:<input type="hidden" name="title" value="'.$_POST['title'].'"/>'.$_POST['title'].'<br/></p>
				<input type="hidden" name="post_content" value="'.$_POST['post_content'].'"/>'.$_POST['post_content'].'<br/>
				<input type = "submit" value = "Try again">';
			}


		if(!$result)
		{
			//Damn! the query failed, quit
			echo 'An error occured while creating your post. Please try again later.';
		}
		else
		{
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			if ($_POST['group'] == 'friends' || $_POST['group'] == 'neighbors'){
				$sql = "INSERT INTO posts(subject,recipient_type,title,author,text,location,coordinate)
				VALUES(?,?,?,?,?,?,POINT(?,?))";
				if ($stmt = $mysqli->prepare($sql)) {
	        		$stmt->bind_param('sssissdd', $_POST['subject'],$_POST['group'],$_POST['title'],$_SESSION['userid'],$_POST['post_content'],$_POST['location'],$lat,$long);
	        		$stmt->execute();
	        	}
	        	$stmt->close();
			}
			elseif($_POST['group'] == 'hood') {
				$hbid = mysqli_fetch_array($mysqli->query("select block.hid from member natural join block join hood where block.hid = hood.hid and member.userid = ".$_SESSION["userid"]));
				$sql = "INSERT INTO posts(subject,recipient_type,recipient_id,title,author,text,location,coordinate)
				   VALUES(?,?,?,?,?,?,?,POINT(?,?))";
				if ($stmt = $mysqli->prepare($sql)) {
	        		$stmt->bind_param('ssisissdd', $_SESSION['userid']);
	        		$stmt->execute();
	        	}
	        	$stmt->close();
			}
			elseif($_POST['group'] == 'hood')  {
				$hbid = mysqli_fetch_array($mysqli->query("select bid from member where member.userid = ".$_SESSION["userid"]));
				$sql = "INSERT INTO posts(subject,recipient_type,recipient_id,title,author,text,location,coordinate)
				   VALUES(?,?,?,?,?,?,?,POINT(?,?))";
				if ($stmt = $mysqli->prepare($sql)) {
	        		$stmt->bind_param('ssisissdd', $_SESSION['userid']);
	        		$stmt->execute();
	        	}
	        	$stmt->close();
			}
			$pid = $mysqli->insert_id;
			if($pid==NULL)
				{
					//something went wrong, display the error
					echo 'An error occured while inserting your post. Please try again later.<br /><br />';
					$sql = "ROLLBACK;";
					$result = $mysqli->query($sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = $mysqli->query($sql);
					
					//after a lot of work, the query succeeded!
					echo 'You have succesfully created <a href="readpost.php?id='. $pid . '">your new topic</a>.';
				}
			}
		}
	}

$mysqli->close();
include 'footer.php';
?>