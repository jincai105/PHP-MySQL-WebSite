<!DOCTYPE html>
<html>
<title>readpost</title>

<?php
//This page displays the list of the user's message
include "include.php";
include "header.php";

if(isset($_GET['id'])){
	$id = intval($_GET['id']);
}
$group = $_GET['group'];
echo 'go back to <a href="post.php?group='.$group.'">'.$group.'</a> posts <br>';
$sql = "replace into readpost VALUES ('".$_SESSION['userid']."','".$id."')";
$result = $mysqli->query($sql);
// if ($result) {echo 'OK';}

$query = "select subject,title,text,time,uname,X(coordinate),Y(coordinate),location,email
		  from posts,users
		  where postid = ? and author = userid";
if ($stmt = $mysqli->prepare($query)) {
	$stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->bind_result($subject,$title, $text, $time, $author,$lat,$long,$location,$email);
    }

if (!$stmt->fetch()) {
    echo 'failed.';
    }
else {
	echo '<table class="topic" border="1">
		  <tr>
		  <th colspan="2">[' .$subject.']'. $title . '</th>
		  </tr>';
	echo '<tr class="topic-post">';
	echo '<td class="user-post">';
	echo $author.'('.$email.')';
	echo "<br>";
	echo "created at ".$time;
	echo '</td>';
	echo '<td class="post-content">';
	echo htmlentities($text, ENT_QUOTES, 'UTF-8');
	if (isset($lat)){
		$_SESSION["pProfile"]=$author;
		$_SESSION["pName"]=$title;
		$_SESSION["pAddress"]=$location;
		$_SESSION["pLat"]=$lat;
		$_SESSION["pLong"]=$long;
		$_SESSION["show"]=1;
		$_SESSION["pNorth"]=41.01;
		$_SESSION["pSouth"]=41.005;
		$_SESSION["pEast"]=-74.00;
		$_SESSION["pWest"]=-74.01;
		$_SESSION["drawRectangle"]=0;
		include "map.php";
	}

	echo '</td>';
	echo '</tr>';
}
$stmt->close();

$query = "select text,time,uname,email
		  from reply,users
		  where postid = ? and replier=userid
		  order by time asc";
if ($stmt = $mysqli->prepare($query)) {
		$stmt->bind_param('s', $id);
    	$stmt->execute();
    	$stmt->bind_result($reply, $replytime, $replier,$email);
    }

while ($stmt->fetch()) {
	echo '<tr class="topic-post">';
	echo '<td class="user-post">';
	echo $replier.'('.$email.')';
	echo "<br>";
	echo "replied at ".$replytime;
	echo '</td>';
	echo '<td class="post-content">';
	echo htmlentities($reply, ENT_QUOTES, 'UTF-8');
	echo '</td>';
	echo '</tr>';
}
//finish the table
echo '</table>';
$stmt->close();
$mysqli->close();

if(!isset($_SESSION['userid'])) {
		echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
	}
else{
	//show reply box
	echo '<tr><td colspan="2"><h2>Reply:</h2><br />
		<form method="post" action="replypost.php">
		<textarea name="message-content"></textarea><br /><br />
		<input type="hidden" name="group" value="'.$group.'"/>
		<input type="hidden" name="postid" value="'.$id.'"/>
		<input type="submit" value="Submit reply" />
		</form></td></tr>';
	}

include 'footer.php';
?>
