<link rel="stylesheet" type="text/css" href="css.css">
<?php
ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'none');
//This file logs the user out and kills their session then redirects to login page
// Initialize the session.
session_start();
// Unset all of the session variables.
$_SESSION = NULL;
// Kill the session, also delete the session cookie.
if (isset($_COOKIE[session_name()])) 
{
   setcookie(session_name(), '', time()-42000, '/');
}
// Finally, destroy the session.
if (session_destroy())
{
	//header('Location: ./index.php');
	print "{$_SESSION['username']}";
	print "<p>You have logged out.";
?>
<meta HTTP-EQUIV="REFRESH" content="1; url=./index.php">
<?php
}
else {
	print "Error: Not logged out!";
}
?>

