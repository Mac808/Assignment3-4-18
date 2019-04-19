<link rel="stylesheet" type="text/css" href="css.css">.
<?php
session_start();
ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'none');

$errors=array();
global $errors;

//declaring all of the session variables to work in this particluar php page

//declaring the username is equal to the session user name value
$username = $_SESSION['username'];
include("./productinfo.inc");
//var_dump($_SESSION['email_address']);

//if ($items ==0){
//	print "<h2>Nothing Ordered</h2>";
//}
//else{
//printing a table that displays the products purchased.
function display_items($cookie_quantity, $item_number){
global $products;

	print "<tr><td align=center> {$products[$item_number]['number']} </td>";
	print "<td align=center> {$products[$item_number]['desc']} </td>";
	print "<td align=center> $cookie_quantity</td>";
	print "<td align=center> \${$products[$item_number]['price']}</td>";
}



	$errors=array();
	global $errors;
	define('min_length', 4);//define minimum length of credit card section

	if ($_GET['credit_card'] == '0') {
		$errors['no credit card'] = '<font face=arial color=red size=2><b>*Please specify your credit card</b>';
	}

if (isset($_GET['place_order'])){

if ((!(preg_match('/^[0-9]*$/', $_GET['first'])))||(!(preg_match('/^[0-9]*$/', $_GET['second'])))||(!(preg_match('/^[0-9]*$/', $_GET['third'])))||(!(preg_match('/^[0-9]*$/', $_GET['fourth'])))){

		$errors['validate']="<font color=red><b>*Please enter a valid number.</b>";
}
if($_GET['month']=='select_month' or $_GET['day']=='select_day')
	$errors['expiration']="<br><font color=red><b>*Please Enter an expiration date.</b>";

}


if(isset($_GET['place_order'])){
if (strlen($_GET["first"]) < min_length ||strlen($_GET["second"]) < min_length || strlen($_GET["third"]) < min_length || strlen($_GET["fourth"]) < min_length)

 	$errors ['too_short'] = '<font color=red><b>*Please enter a valid number (total of 16 numbers)</b>';

}
?><form method="GET" action="<?php echo $_SERVER['PHP_SELF'];?>">

<?php

function credit_card(){
$errors=array();
global $errors;

?>
	<table border=0 width=70% align=center>
<tr>
<td align=center>
<P>
<br>
Credit Card Type:
<select name='credit_card'>
<option value='0'> -- Credit Card -- </option>
<option value='visa'
<?php if(isset($_GET['checkout']) && $_GET['credit_card']=='visa') echo "selected";?> >Visa</option>
<option value='mastercard'
<?php if(isset($_GET['checkout']) && $_GET['credit_card']=='mastercard') echo "selected='selected'";?>>MasterCard</option>
<option value='discover'
<?php if(isset($_GET['checkout']) && $_GET['credit_card']=='discover') echo "selected='selected'";?>>Discover</option>
<option value='jcb'
<?php if(isset($_GET['checkout']) && $_GET['credit_card']=='jcb') echo "selected='selected'";?>>JCB</option>
</select>
<p>
<?php

if(isset($errors['no credit card']))
{

echo "{$errors['no credit card']}";
}

?>

</p>
<p>
Credit Card Number:
<input type = text name="first" value="<?php if (isset($_GET['first'])) echo $_GET['first']; ?>" maxlength=4 style="width=50">
<input type = text name="second" value="<?php if (isset($_GET['second'])) echo $_GET['second']; ?>" maxlength=4 style="width=50">
<input type = text name="third" value="<?php if (isset($_GET['third'])) echo $_GET['third']; ?>" maxlength=4 style="width=50">
<input type = text name="fourth" value="<?php if (isset($_GET['fourth'])) echo $_GET['fourth']; ?>" maxlength=4 style="width=50">
<p>
<?php
if(isset($errors['validate']))
{

echo "{$errors['validate']}";
}
elseif(isset($errors['too_short']))
{

echo "{$errors['too_short']}";
}

?>
<br>
<Br>
Expiration Date
<select name=month>
<option value=select_month>Select Month</option>
<?php

for($i=1; $i<13; $i++){
echo "<option value=$i>$i</option>";
}
?>
</select>
<select name=date>
<option value=select_day>Select Year</option>
<?php
for($i=2006; $i<=2012; $i++){
echo "<option value=$i>$i</option>";
}
?>
</select>
<?php



if(isset($errors['expiration']))
{
echo $errors['expiration'];
}









?>
</p>

</td>
</tr>
</table>

<table align=center width=70% border=0>
<tr>
	<td>

		<input type='submit' value="Place Order" name='place_order'>
	</td>
	<td align=right>
	<input type='submit' name='cancel' value='Cancel'>
	</form>
	</td>
</tr>
</table>

<?php
}

function display_invoice(){
global $errors;
$quantity1 = &$_SESSION['quantity1'];
$quantity2= &$_SESSION['quantity2'];
$quantity3= &$_SESSION['quantity3'];
$quantity7= &$_SESSION['quantity7'];
$quantity6= &$_SESSION['quantity6'];
$quantity4= &$_SESSION['quantity4'];
$quantity5= &$_SESSION['quantity5'];
$quantity9= &$_SESSION['quantity9'];
$quantity8= &$_SESSION['quantity8'];
?>
<table border=1 width=70% align=center>
<tr align=center>
<td align=center>
<h2>Invoice for <?php echo $_SESSION['username']; ?></h2>
</td>
</tr>
</table>
<table border=1 width=70% align=center>
<tr>
<td align='center'><b>Item #</b></td>
<td align='center'><b>Description</b></td>
<td align='center'><b>Quantity</b></td>
<td align='center'><b>Unit Price</b></td>
<td align='center'><b>Total Price</b></td>

</tr>
<?php

//if(count($errors)!=0 || !(isset($_GET['place_order']))){

if ($_SESSION['choco_total_price']){
	display_items($quantity1, 0);
	$choco_total_price= printf ("<td align=center> $%.2f </td></tr>", $_SESSION['choco_total_price']);
	$items+=1;
}
if ($_SESSION['peanut_total_price']){
	display_items($quantity2, 1);
	$peanut_total_price= printf ("<td align=center> $%.2f </td></tr>", $_SESSION['peanut_total_price']);
	$itmes+=1;
}
if ($_SESSION['sponge_total_price']){
	display_items($quantity3, 2);
	$sponge_total_price=printf ("<td align=center> $%.2f </td></tr>", $_SESSION['sponge_total_price']);
	$items+=1;
}
if ($_SESSION['sponge_box_total_price']){
	display_items($quantity4, 3);
	$sponge_box_total_price=printf ("<td align=center> $%.2f </td></tr>", $_SESSION['sponge_box_total_price']);
	$items+=1;
}
if ($_SESSION['sponge_cake_total_price']){
	display_items($quantity5, 4);
	$sponge_cake_total_price=printf ("<td align=center> $%.2f </td></tr>", $_SESSION['sponge_cake_total_price']);
	$items+=1;
}
if ($_SESSION['choco_big_total_price']){
	display_items($quantity6, 5);
	$choco_big_total_price=printf ("<td align=center> $%.2f </td></tr>", $_SESSION['choco_big_total_price']);
	$items+=1;
}
if ($_SESSION['choco_filling_total_price']){
	display_items($quantity7, 6);
	$choco_filling_total_price=printf ("<td align=center> $%.2f </td></tr>", $_SESSION['choco_filling_total_price']);
	$items+=1;
}
if ($_SESSION['peanut_cup_total_price']){
	display_items($quantity8, 7);
	$peanut_cup_total_price=printf ("<td align=center> $%.2f </td></tr>", $_SESSION['peanut_cup_total_price']);
	$items+=1;
}
if ($_SESSION['peanut_candy_total_price']){
	display_items($quantity9, 8);
	$peanut_candy_total_price=printf ("<td align=center> $%.2f </td></tr>", $_SESSION['peanut_candy_total_price']);
	$items+=1;
}
print "</table>";
global $grand_total;
$grand_total= $_SESSION['total_after_tax']+$_SESSION['shipping'];
echo "<table border=1 width=70% align=center>
	<tr><td align=right><b>Grand Total: $";
	printf("%.2f </td></tr></table>", $grand_total);

}

if (isset($_GET['cancel'])){
	header('Location: ./allproducts.php');
}
if(!isset($_GET['place_order']) || count($errors)>0){
display_invoice();
credit_card();
}

if(isset($_GET['place_order']) && count($errors)==0){
print "<p align=left><h3>Thank you for your order $username!</h3></p>
		A confirmation email has been sent.<p></p>
		<font face=arial size=3> Please print this page for your records <br><br><br><br>";
display_invoice();




$connumber=134356546;



$mail_server = "mail.hawaii.edu";
ini_set("SMTP", $mail_server);

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

global $grand_total;
global $username;
$grand_total_formated= round($grand_total, 2);
$from = "GrandmasOwn";
ini_set("sendmail_from", $from);
$email=$_SESSION['email_address'];
$recipient = $email;
$subject = "GrandmasOwn Invoice";
$message = "Thank you for your order $username; $grand_total_formated has been charged to your credit card.
Your confirmation number is $connumber
if you have any questions concerning your order call: 808-596-7873";

mail($recipient, $subject, $message, $headers);

// Unset all of the session variables.
$_SESSION = NULL;

// Kill the session, also delete the session cookie.
if (isset($_COOKIE[session_name()])) {
   setcookie(session_name(), '', time()-42000, '/');
}

// Finally, destroy the session.
if (session_destroy()){
	//header('Location: ./Login.php');
	print "{$_SESSION['username']}";
	print '<p><a href="./Login.php">Click Here </a>to log in again';

}
}
?>
