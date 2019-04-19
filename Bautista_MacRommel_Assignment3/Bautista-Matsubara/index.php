<!--
Names: Mac Rommel Bautista and Hikari Matsubara
Instructor: Professor Rick Kazman
Class: ITM 352-1
Date: April 18, 2019
Assignment 3: Adding Sessions to your e-Commerce Web-site
-->
<link rel="stylesheet" type="text/css" href="css.css">.
<?php
ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'none');

//Heavily modified from a program by Ryan Hung & Colin McGillivray
//This page allows the user to log in if they have a username and password.

//Initiates the session
session_start();
global $validuser;
global $validpassword;
//Function is created to show a form
function show_form(){
$validuser = false;
$validpassword= false;
global $validuser;
global $validpassword;
$errors = array();

//if the submit button was pressed and the user is false return an error
if (isset($_POST['submit']) && $validuser == false) {
  $errors['invalid user'] = '<br><br><font color = red>*Login incorrect. Please retype the username and password,
	 or sign up if you haven\'t already done so. <a href="./registration.php"><br>Register Here for New Account</a>';
}
elseif (isset($_POST['submit']) && $_POST['username']==''){
	$errors['blank user'] = '<br><br><font color = red>*The username is blank. Please retype the username and password,
	 or sign up if you haven\'t already done so. <a href="./registration.php"><br>Register Here for New Account</a>';
}
elseif (isset($_POST['submit']) && $validpassword==false){
	$errors['invalid pw'] = '<br><br><font color = red>*The password is incorrect. Please retype your password,
	 or sign up if you haven\'t already done so. <a href="./registration.php"><br>Register Here for New Account</a>';
}
?>
<body bgcolor="gray"></body>
<form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'] ?>">
<table>
            <tr>
                <th><b><span style=color:white;">M</span></b></th>
                <th><b><span style=color:white;">N</span></b></th>
                <th><b><span style=color:white;">C</span></b></th>
            </tr>
        </table>
        <!--
        The code below creates the header for entire assignment which can be viewed in the Form, Invoice, and Error pages.
        The headers will be in the two largest sizes, centered, colored crimson (a bright red), underlined, and bold.
        MNC is a reference to the GNC which is popular for selling health and nutrition based products.
        I have made a slight change to GNC's slogan "Live Well" to "LIVE HEALTHY". It is colored dim gray.
        -->
        <h1><center><b>WELCOME TO <span style="color:red;"><u> MNC!</u></span></b><center></h1>
                    <h2><center><b><span style="color:dimgray;"><u>LIVE HEALTHY</u></span><br><b></center></h2>
                    <h2><center><b><span style="color:red;"><u>MAC'S NUTRITION CENTER</u></span><br><b></center></h2><BR>
</table>
<tr><td>
Please Login Below:<p>
<br>Username:  <input type="text" name="username" value="
<?php
if(isset($_POST['username']))echo $_POST['username'];?>">
<?php
?>
<br>
Password:  <input type="password" name="password" value="
<?php if(isset($_POST['password']))echo $_POST['password'];?>">
<?php
//if (isset($_POST['submit']) && $validpassword == false){
//	echo "<font color=red>Invalid Password!";
//}
?>
<br>
<input type='submit' value='Login' name='submit'>
</form>
 If you are new user, click here: <a href="registration.php">Register for New Account</a>
</td>
<td><?php
//display the errors that were set if the user name and or passwordS are wrong
if (isset($errors['invalid user']))
    echo "<b>{$errors['invalid user']}</b>";
elseif (isset($errors['blank user']))
	echo "<b>{$errors['blank user']}</b>";
elseif (isset($errors['invalid pw']))
    echo "<b>{$errors['invalid pw']}</b>";
?>
</table>
</BODY>
<?php
}
//including the array for the existing user information.
//include "./userinfo.inc";

//passing the information into an array
$file_path = "./user_data.dat";
$fp = fopen($file_path , 'a+') or die("File $file_path did not open<br>");
//read data
if (isset($_POST['submit'])) {
  while(!feof($fp)){
    $line = fgets($fp);
    $tok = strtok($line, ";");
    $username = strtolower(trim($tok));
    $tok = strtok(";");
    $password= trim($tok);
    $tok = strtok(";");
    $email= trim($tok);
    if ($username == strtolower($_POST['username']) && ($password == $_POST['password'])) {
		$validuser = true;
		$validpassword = true;
		$_SESSION['username'] = $username;
		$_SESSION['email_address']=$email;
		}
}
}
if ( !fclose($fp) ) die("File $file_path did not close!<br>");
//print out the data
if(!(isset($_POST['submit']))) {
  show_form();
}
else if (isset($_POST['submit']) && $validuser == false) {
  show_form();
}
else if(isset ($_POST['submit']) && $_POST['username']==''){
	show_form();
}
else if (isset($_POST['submit']) && $validpassword == false) {
  show_form();
}
else {
  header('Location: ./allproducts.php');
}
?>