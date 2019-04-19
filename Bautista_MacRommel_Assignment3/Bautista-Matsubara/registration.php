<!--
Modified written by Mac Rommel Bautista from Assignment 2
-->
<link rel="stylesheet" type="text/css" href="css.css">.
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
<?php
//Brief Description: This file is the registration form which collects the user's data
//for username, password,  password confirmation and email address.  After the
//new user clicks the "Register this Account" button. The user will be redirected to
//the main purchasing page which is index.php. The registration also displays
//if a username is already taken.



//Taken from https://www.php.net/manual/en/function.include.php
//Include allows the file to include and evaluate the file given 
include("userinfo.inc");
//Used to define global array variables
global $errors;
global $username;
global $password;
global $password_confirmed;
global $email;
//User  enters their username, password, confirmation to password, and email
//Determines if the variables in submitted is declared and different than NULL
//Taken from https://www.php.net/manual/en/function.isset.php
if(isset($_POST['submitted'])) 
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_confirmed = $_POST['password_confirmed'];
	$email = $_POST['email_textfield'];
	//Validates information and checks for errors
	$errors = validate_information($all_users);
	//Displays errors found in forms
	if(count($errors)>0) 
        {
		displayForm();
	}
	else
                //Taken from https://www.php.net/manual/en/function.header.php
                //Redirects user to main purchasing page
		header('Location: ./allproducts.php');
}
else
	displayForm();
//Validates information for existing users
function validate_information($existing_users) 
{
	//Initialization of $errors array
	$errors = array();
	//Gets all of the data from the $_POST array
	$username = strtolower($_POST['username']);
	$password = $_POST['password'];
	$password_confirmed = $_POST['password_confirmed'];
    $email = strtolower($_POST['email_textfield']);
	//The first 4 if-statements test the validity of the username.
	//This tests whether the username contains only letters & numbers.
	for($i=0; $i<count($existing_users); $i++) 
        {
		foreach($existing_users[$i] as $key => $value)
		if ($key == 'username') 
                {
			if($username == $value)
				$errors['username']['unique'] = ' Username is already taken.'; 
		}

	}
	//The following code was taken and modified from http://www.phpbuilder.com/board/showthread.php?t=10314920
        //The code below was modified from work written by Christie Mattos & Sheridan Wu

        // This code test to see if the username contained only letters and numbers
        // username is case insensitive
	if(preg_match('[^a-z/0-9]', $username))
		$errors['username']['type'] = ' Username must contain
			only letters & numbers.';
	/* This tests whether the username begins with a letter.  This test is
		necessary because our users array uses the username as the name of the
		individual array.  Since php does not allow variable names to begin with
		a number, we have to ensure that our users aren't allowed to create
		usernames beginning with numbers, or we wouldn't be able to store
		them properly.
	*/
 	if(preg_match('[^a-z]', substr($username, 0, 1)))
		$errors['username']['start_type'] = ' Username must begin with a letter.'; 
	//This tests whether the username is of the approved length
        //Must be between 4-11 characters
	$length = strlen($username);
	if($length < 4 or $length > 11)
		$errors['username']['length'] = ' Username must be between 4 and 11 characters.';
   	//The following 2 if-statements test the validity of the password
        //Password is case sensitive
        //The password cannot contain any other characters besides letters and numbers, if someone tries to input another character, they will receive the error message
	if(preg_match('[^a-zA-Z0-9]', $password))
		$errors['password']['type'] = ' Password must contain only letters and numbers.';
	//This tests whether the password is of the approved length
        //Password needs to be 6 characters or longer
	$length = strlen($password);
	if($length < 6)
		$errors['password']['length'] = ' Password must be longer than 6 characters.';
	/*This tests whether the user entered the same password in the password and
		confirm password textboxes.
	*/
	if($password_confirmed != $password)
		$errors['password_confirmed'] = ' Passwords must be exactly the same.';
	//Tests whether an email was entered.
    if ($email == '') 
        {
		$errors['email']['empty'] = " You didn't enter an email address.";
		//Returns and doesn't continue testing if no email address was entered.
		return $errors;
	}
    // split address into parts
    if(preg_match('[^a-z0-9_.@]',$email ))
    	$errors['email']['invalid'] = " Email address should contain only letters, numbers, the ., _, and @.";
	//Separates the email address into parts before @ symbols and parts after them.
	$parts = explode('@', $email);
	//Tests to see if there was only one @ sign.
    if (count($parts) != 2)
    {
    	$errors['email']['number_of_@_signs'] = " You entered too many @'s or too few @'s.";
   		/*If there were too many @'s or too few, then it will return the $errors array
   			and not continue with the remaining tests.
   		*/
		return $errors;
    }
	// get part after @ in email address and sets temp variable $X to it
    $X = $parts[1];
    $parts = explode('.', $X);
    //Testing to make sure that a period was entered after the @ sign
    if (count($parts) < 2)
		$errors['email']['not_enough_parts'] = " You didn't enter enough address parts after the @ sign.";
	//This tests the string after the last period entered
	$Z = $parts[count($parts)-1];
	//Tests to make sure that only 3 letters or only 2 letters follow the last period.
    if (strlen($Z) != 3 and strlen($Z) !=2) 
    {
		$errors['email']['too_few_letters'] = strlen($Z) . " You entered an incorrect amount of letters after '.'.";
    }
	return $errors;
}

function displayForm()
{
?>
<!--Allows user to register for a new account-->
<center><h2>Register for a New Account</h2></center>
<!--Creates form for entering the email address, username, password, and password confirmation-->
<form action=<?php echo  $_SERVER['PHP_SELF'] ?> method='POST'>
<?php
//Stores email addresses entered and prints the outputs of the email address
echo "<br>Enter your Email Address: <input type='text'
	name='email_textfield' value='{$GLOBALS['email']}'>";
//Determines if a variable is declared and is not NULL
if(isset($GLOBALS['errors']['email'])) 
{
        //Declares foreach loop
	foreach($GLOBALS['errors']['email'] as $key => $value)
		echo "$value ";
        //Closes foreach loop
}
// stores username entered and prints output
echo "<br>Enter your Username: <input type='text' name='username' value='{$GLOBALS['username']}'>";
if(isset($GLOBALS['errors']['username'])) 
{
        //Declares foreach loop
	foreach($GLOBALS['errors']['username'] as $key => $value)
		echo "$value ";
        //Closes foreach loop
}
//stores password entered and prints output
echo "<br>Enter your Password: <input type='password' name='password'
	value='{$GLOBALS['password']}'>";
if(isset($GLOBALS['errors']['password'])) 
{
	foreach($GLOBALS['errors']['password'] as $key => $value)
		echo "$value ";
}
//confirms password entered and prints output
echo "<br>Confirm your Password: </h3><input type='password'
	name='password_confirmed' value='{$GLOBALS['password_confirmed']}'>";
if(isset($GLOBALS['errors']['password_confirmed']))
	echo "{$GLOBALS['errors']['password_confirmed']}";

?>
<br>
<!--Submit button to register new accounts-->
<input type='submit' name='submitted' value='Register this Account'>
<!--Closes form-->
</form>
<!--This code will create a button that allow users to go back.
Taken from https://www.w3schools.com/jsref/met_his_back.aspr-->
<button onclick="goBack()">Back</button>
                                <script>
                                    function goBack()
                                    {
                                        window.history.back();
                                    }
                                </script>
<?php
}

?>