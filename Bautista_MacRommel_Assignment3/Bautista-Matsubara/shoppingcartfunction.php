<link rel="stylesheet" type="text/css" href="css.css">.
<center>
<?php
//starting the session
session_start();
//turning off errors
ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'none');

//if no username or session started redirect them to the login page
//declare a function for validating the quantity of GET values
//<---------START FUNCTION quantity_validate------->
function quantity_validate($quantity, $error_type){
global $quantity_errors;
//check to see if the GET value is numeric greater than zero and not an integer
if (!(is_numeric($quantity) && is_int($quantity - (int) $quantity) && $quantity >= 0)){
		$quantity_errors[$error_type]="<font color=red><b>*Please enter a valid quantity.</b>";
	}
}
//<---------END FUNCTION quantity_validate------>

//defining a function to display the items
function display_item($item_quantity, $cookie_kind, $item_index){
include ('./productinfo.inc');
global $quantity_errors;
//<-------------START Function for displaying product code--------------->
//if the remove button is pressed then set the chocolate quantity to zero
if (isset($_GET["remove_$cookie_kind"])){
	$_SESSION[$cookie_kind]= NULL;
	$item_quantity=0;
}
//if the quanitty exists show this item in the shopping cart
if ($item_quantity){
	//declaring the total price equal to the product price times the quantity ordered by user.
	print "<td align=center> {$products[$item_index]['number']} </td>\r";
	print "<td align=center> {$products[$item_index]['desc']} </td>\r";
	print "<td align=center> <input type='text' name='$cookie_kind' value='$item_quantity' size='2'></td>\r";

	if(count($quantity_errors) > 0){
	echo "{$quantity_errors[$cookie_kind]}</td>\r";
	}
	print "<td align=center> \${$products[$item_index]['price']}</td>\r";
	if (count($quantity_errors) > 0){
		print "<td align=center> $0 </td>\r";
	}
	else {
		print "<td align=center> $" . $_SESSION["$cookie_kind"]*$products[$item_index]['price'] . "</td>\r";
	}
	print "<td align=left> <input type='submit' name='remove_$cookie_kind' value='Remove'></td></tr>\r";
}
//<-------------------- END Function code------------------->
}





//defining a function to show the shopping cart
function show_cart(){
//include the product info in the function so the variables are visiable
include ('./productinfo.inc');
//making all the variables global
global $quantity1;
global $quantity2;
global $quantity3;
global $shipping_errors;
global $quantity_errors;
global $quantity6;
global $quantity7;
global $quantity4;
global $quantity5;
global $quantity9;
global $quantity8;

global $nothing_purchased;


?>
<table border=1 width=70%>
<tr>
<form method='GET' action="<?php echo $_SERVER['PHP_SELF']; ?>">
<td align='center'><b>Item #</b></td>
<td align='center'><b>Description</b></td>
<td align='center'><b>Quantity</b></td>
<td align='center'><b>Unit Price</b></td>
<td align='center'><b>Total Price</b></td>

</tr>
<tr>
<?php
echo $nothing_purchased;

display_item($quantity1, 'quantity1', 0);
display_item($quantity2, 'quantity2', 1);
display_item($quantity3, 'quantity3', 2);
display_item($quantity4, 'quantity4', 3);
display_item($quantity5, 'quantity5', 4);
display_item($quantity6, 'quantity6', 5);
display_item($quantity7, 'quantity7', 6);
display_item($quantity8, 'quantity8', 7);
display_item($quantity9, 'quantity9', 8);

//count how to see if there are errors in the quantity_errors array and if there are set all values to 0
if(count($quantity_errors) > 0 && isset($_GET['checkout'])){
$total_after_tax=0;
$total_tax=0;
$total_price=0;

}
else
{
$choco_total_price = $products[0]['price']* $quantity1;
$peanut_total_price = $products[1]['price']* $quantity2;
$sponge_total_price = $products[2]['price']* $quantity3;
$sponge_box_total_price = $products[3]['price']* $quantity4;
$sponge_cake_total_price = $products[4]['price']* $quantity5;
$choco_big_total_price = $products[5]['price']* $quantity6;
$choco_filling_total_price = $products[6]['price']* $quantity7;
$peanut_cup_total_price = $products[7]['price']* $quantity8;
$peanut_candy_total_price = $products[8]['price']* $quantity9;


//defining the total price with all the items added togetehr
$_SESSION['choco_total_price'] = &$choco_total_price;
$_SESSION['peanut_total_price'] = &$peanut_total_price;
$_SESSION['sponge_total_price'] = &$sponge_total_price;
$_SESSION['sponge_box_total_price']= &$sponge_box_total_price;
$_SESSION['sponge_cake_total_price']= &$sponge_cake_total_price;
$_SESSION['peanut_cup_total_price']= &$peanut_cup_total_price;
$_SESSION['peanut_candy_total_price']= &$peanut_candy_total_price;
$_SESSION['choco_big_total_price']= &$choco_big_total_price;
$_SESSION['choco_filling_total_price']= &$choco_filling_total_price;

$total_price = $choco_total_price + $peanut_total_price + $sponge_total_price + $sponge_box_total_price
+ $sponge_cake_total_price + $choco_big_total_price + $choco_filling_total_price + $peanut_cup_total_price
+ $peanut_candy_total_price;
$_SESSION['total_price'] = &$total_price;
//defining the total tax
$total_tax=$total_price * .04116;
$_SESSION['total_tax'] = &$total_tax;
//adding total tax to the total price for the total after tax price
$total_after_tax= $total_price +$total_tax;
$_SESSION['total_after_tax'] = &$total_after_tax;
}
?>
<center>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
<br>
<table border=1 width='40%'>
	<tr>
		<td align=center>
			Total before tax:
		</td>
		<td align=center>
			<?php
				printf ("$%.2f", $total_price);
			?>
		</td>
	</tr>
	<tr>
		<td align=center>
		Tax (4.166%):
		</td>
		<td align=center>
		<?php
		printf("$%.2f", $total_tax);
		?>
		</td>
	</tr>
	<tr>
		<td align=center>
		Total with tax:
		</td>
		<td align=center>
		<?php
		printf("$%.2f",$total_after_tax);
		?>
		</td>
	</tr>
	<tr>
		<td align=center>
		Shipping:
		</td>
		<td align=center>
	<select name='shipping'>
	<option value='0'
	<?php if (isset($_GET['checkout']) || isset($_GET['update']) && $_GET["shipping"]=="0")
			echo "selected='selected'";
		?>>Select Shipping</option>
	<option value='3.00'
	<?php if (isset($_GET['checkout']) || isset($_GET['update']) && $_GET["shipping"]=="2.25")
			echo "selected='selected'";
		?>>United States Mainland ($3.00)</option>
	<option value='3.50'
	<?php if (isset($_GET['checkout']) || isset($_GET['update']) && $_GET["shipping"]=="3.15")
			echo "selected='selected'";
		?>>Canada ($3.50)</option>
	<option value='10.00'
	<?php if (isset($_GET['checkout']) || isset($_GET['update']) && $_GET["shipping"]=="9.95")
			echo "selected='selected'";
		?>>Alaska or Hawaii ($10.00)</option>
	<option value='15.00'
	<?php if (isset($_GET['checkout']) || isset($_GET['update']) && $_GET["shipping"]=="15.75")
			echo "selected='selected'";
		?>>International ($15.00)</option>
	</select>
	<?php
	echo $shipping_errors;
	?>
		</td>
	</tr>

</table>

<table width=50%>
    <br>
	<tr>
		<td align=left>
			<input type='submit' name='checkout' value='Checkout'>
		</td>
		<td align='right'>
			<input type='submit' name='update' value='Update Quantity'>
			</form>
		</td>
	</tr>

</table>
</center>
<?php

//close function show_cart from line 73
}








if ($_SESSION['username']==NULL){
	echo '<meta HTTP-EQUIV="REFRESH" content="3; url=./Login.php">';
	echo "<p><h3>Error: You must be logged in to view products!</h3><br>
			You are now being redirect to log in.";
	}
else {
//including the product information arrays
include ('./productinfo.inc');
//declaring the quantiy variable equal to the session which was what the user posted
//foreach ($_SESSION as $sessVar => $value){
//	$$sessVar = &$_SESSION[$sessVar];
//}
//declaring all of the session variables to work in this particluar php page
$quantity1 = &$_SESSION['quantity1'];
$quantity2= &$_SESSION['quantity2'];
$quantity3= &$_SESSION['quantity3'];
$quantity7= &$_SESSION['quantity7'];
$quantity6= &$_SESSION['quantity6'];
$quantity4= &$_SESSION['quantity4'];
$quantity5= &$_SESSION['quantity5'];
$quantity9= &$_SESSION['quantity9'];
$quantity8= &$_SESSION['quantity8'];
//declaring the username is equal to the session user name value
$username = $_SESSIOIN['username'];
//creating an empty array for quantity errors to be stored in
$quantity_errors=array();
global $quantity_errors;
echo "<h1>{$_SESSION['username']}'s Shopping Cart</h1>";

//var_dump($quantity_errors);

//if the update button is pressed then make the chocolate quantitty equal to the GET quantity and validate
if (isset($_GET['update'])){
	if($quantity1){
		$quantity1= $_GET['quantity1'];
		quantity_validate($quantity1, 'choco');
	}
	if($quantity2){
		$quantity2= $_GET['quantity2'];
		quantity_validate($quantity2, 'peanut');
	}
	if($quantity3){
		$quantity3= $_GET['quantity3'];
		quantity_validate($quantity3, 'sponge');
	}
	if($quantity4){
		$quantity4= $_GET['quantity4'];
		quantity_validate($quantity4, 'sponge_box');
	}
	if($quantity5){
		$quantity5= $_GET['quantity5'];
		quantity_validate($quantity5, 'sponge_cake');
	}
	if($quantity9){
		$quantity9= $_GET['quantity9'];
		quantity_validate($quantity9, 'peanut_candy');
	}
	if($quantity8){
		$quantity8= $_GET['quantity8'];
		quantity_validate($quantity8, 'peanut_cup');
	}
	if($quantity6){
		$quantity6= $_GET['quantity6'];
		quantity_validate($quantity6, 'choco_big');
	}
	if($quantity7){
		$quantity7= $_GET['quantity7'];
		quantity_validate($quantity7, 'choco_filling');
	}

	show_cart();
}

elseif (isset($_GET['checkout'])){
	if($quantity1){
		$quantity1= $_GET['quantity1'];
		quantity_validate($quantity1, 'choco');
	}
	if($quantity2){
		$quantity2= $_GET['quantity2'];
		quantity_validate($quantity2, 'peanut');
	}
	if($quantity3){
		$quantity3= $_GET['quantity3'];
		quantity_validate($quantity3, 'sponge');
	}
	if($quantity4){
		$quantity4= $_GET['quantity4'];
		quantity_validate($quantity4, 'sponge_box');
	}
	if($quantity5){
		$quantity5= $_GET['quantity5'];
		quantity_validate($quantity5, 'sponge_cake');
	}
	if($quantity9){
		$quantity9= $_GET['quantity9'];
		quantity_validate($quantity9, 'peanut_candy');
	}
	if($quantity8){
		$quantity8= $_GET['quantity8'];
		quantity_validate($quantity8, 'peanut_cup');
	}
	if($quantity6){
		$quantity6= $_GET['quantity6'];
		quantity_validate($quantity6, 'choco_big');
	}
	if($quantity7){
		$quantity7= $_GET['quantity7'];
		quantity_validate($quantity7, 'choco_filling');
	}

//if the count of the quantity errors array is greater than zero show the shopping cart
	if (count($quantity_errors) > 0){
		show_cart();
	}
	//if the shipping is zero then print error and show the cart
	elseif ($_GET['shipping'] == 0) {
		$shipping_errors = '<font color=red><b><br>*Please select a shipping method.</b>';
		show_cart();
	}
	elseif ($_SESSION['total_price']==0){
		$nothing_purchased="<b><font color=red>Nothing Purchased</b>";
		show_cart();
	}
	//if no errors then set the variables and redirect.
	else {
	global $choco_total_price;
	global $peanut_total_price;
	global $sponge_total_price;
		$_SESSION['shipping'] = $_GET['shipping'];
		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=./confirmation.php">';
	}

}

//if checkout button not pressed show the shopping cart
else {
	show_cart();
}
?>
</center>
<?php







?>
<center>
<p><h2>Not Done? &nbsp;<a href="./allproducts.php">Keep Shopping!</a></h2></p>

</center>
<?php
}
?>
