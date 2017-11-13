<!DOCTYPE html>
<html>
<title>signin</title>

<?php
include "include.php";
include "header.php";

echo '<h2>Sign in</h2><br />';
//if the user is already logged in, redirect them back to homepage
if(isset($_SESSION["userid"])) {
  echo "Welcome ".$_SESSION['uname'].".<br>";
  echo "Proceed to <a href=\"overview.php\">overview</a>.";
}
else {
  //if the user have entered both entries in the form, check if they exist in the database
  if(isset($_POST["email"]) && isset($_POST["password"])) {

    //check if entry exists in database
    if ($stmt = $mysqli->prepare("select userid,uname,lastlogtime from users where email = ? and password = ?")) {
	  $email = $_POST["email"];
	  $password = md5($_POST["password"]);
      $stmt->bind_param("ss", $email , $password);
      $stmt->execute();
      $stmt->bind_result($userid, $uname, $lastlogtime);
	    //if there is a match set session variables and send user to homepage
        if ($stmt->fetch()) {
		      $_SESSION["userid"] = $userid;
		      $_SESSION["uname"] = $uname;
		      $_SESSION["email"] = $_POST["email"];
		      $_SESSION["time"] = strtotime($lastlogtime);
		      $_SESSION["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"]; //store clients IP address to help prevent session hijack
	//          echo "You will be redirected in 3 seconds or click <a href=\"index.php\">here</a>.";
		      		    echo 'Welcome, ' . $_SESSION['uname'] ."<br> Proceed to <a href=\"overview.php\">overview</a>.";
            header("Refresh:0");
//          header("refresh: 3; index.php");
        }
		//if no match then tell them to try again
		else {
		  sleep(1); //pause a bit to help prevent brute force attacks
		  echo "Your Email and password don't match, click <a href=\"signin.php\">here</a> to try again.";
		}
		$stmt->close();
      
	  $mysqli->close();
    }  
  }
  //if not then display login form
  else {
    echo "Enter your email and password below: <br /><br />";
    echo '<form action="signin.php" method="POST">';
    echo 'Email: <input type="text" name="email" /><br />';
    echo 'Password: <input type="password" name="password" /><br />';
    echo '<input type="submit" value="Sign in" />';
    echo '</form>';
  }
}


include "footer.php"
?>
		}
