<link rel="stylesheet" type="text/css" href="css.css">
<?php
ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'NONE');
//start the session
session_start();
$username = $_SESSION['username'];
//if no username or session started redirect them to the login page
function show_product(){
global $quantity_errors;
global $quantity2;
global $username;
?>
<html>
<head>
<title>Gold Standard Whey Protein - Double Chocolate</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style3 {color: #FFCC00}
a:link {
	color: #CC6600;
}
a:visited {
	color: #996699;
}
a:hover {
	color: #CC33CC;
}
-->
</style>
</head>
<body bgcolor="#999999">
<div align="center">
  <table width="60%" height="587" >
    <tr>
      <th height="38" align="left" valign="bottom" bgcolor="#FFFFFF" scope="col"><div align="center">
        <h1><font color="#993300" face="Verdana, Arial, Helvetica, sans-serif"> MNC </font></h1>
      </div></th>
    </tr>
    <tr>
      <th height="50" align="left" valign="bottom" bgcolor="#FFFFFF" scope="col"><table width="100%" height="39" >
        <tr>
          <th width="40%" height="33" scope="col">Welcome <?php echo $username ; ?> <a href="./logout.php">Logout</a></th>
          <th width="76%" valign="bottom" scope="col"><div align="right">| <span class="style3">
			<a href="./allproducts.php"><img src="./house.gif" width=22 height=22 border=0> Home</a></span> | <a href="./shoppingcartfunction.php" class="style1">
		  	<img src="./shoppingcart.gif" height=22 width=22 border=0> Shopping Cart</a> |
		  		  </div></th>
		</tr>
      </table></th>
    </tr>
    <tr>
      <th height="480" bgcolor="#FFFFFF" scope="col"><table width='98%' height="98%" border='0' align='center' bgcolor='cccccc'>
        <tr>
          <td width='41%' height="465"><table width="100%" height="274" >
            <tr>
              <th bgcolor="#FFFFFF" scope="col"><table width="100%" height="95%" >
                <tr>
                  <th bgcolor="#CCCCCC" scope="col"><img src='./DC.jpg' width="150" height="150"></th>
                </tr>
              </table></th>
            </tr>
          </table>
		  <a href="./wheyvanilla.php"><--Previous Product</a> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		  &nbsp; &nbsp; &nbsp;<a href="./wheymocha.php">Next Product--> </a>
		  </td>
          <td width="59%" align='top left' valign="top"><h2><font face="Verdana, Arial, Helvetica, sans-serif"> <font color="#993300">
            <br> Whey Protein - Double Chocolate </font></font></h2><Br>
			  <Br><p align="left"><font color="#993300" face="Arial, Helvetica, sans-serif">Description:<br>
  One Dozen (12) </font><font color="#993300" face="Arial, Helvetica, sans-serif" style='text'> Gold Standard Whey Protein <br>
  </font><font color="#993300" face="Arial, Helvetica, sans-serif"> Double Chocolate Flavored </font><font color="#993300">.</font></p>
              <p align="left"><font color="#CC3300">Price: $59.99</font></p>
			  <table width="100%" height="160" >
                <tr>
                  <th scope="col"><p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <table width="100%" height="40" >
                    <tr><td><form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
					Quantity: <input type='text' name='quantity2' value='<?php echo $quantity2; ?>'  size='2'>
					<input type='hidden' name='addcart' value='addcart'>
					 <?php if (count($quantity_errors >0)) {echo $quantity_errors[0];} ?>
					</td></tr>
                    <tr>
                      <td> <input type='submit' name='addcart' value='Add To Cart'></td>
                    </tr></form>
                  </table></th>
                </tr>
              </table>
			                </td>
        </tr>
      </table></th>
    </tr>
  </table>
</div>
<p>&nbsp;</p>
</body>
</html>
<?php
}
if ($_SESSION['username']==NULL)
{
	echo '<meta HTTP-EQUIV="REFRESH" content="3; url=./index.php">';
	echo "<p><h3>Error: You must be logged in to view products!</h3><br>
			You are now being redirect to log in.";
}
else 
{
    $quantity_errors=array();
    if (isset($_POST['addcart'])) 
{
	$quantity2 = trim($_POST['quantity2']);
	if (!(is_numeric($quantity2) && is_int($quantity2 - (int) $quantity2) && $quantity2 >= 0))
        {
		$quantity_errors[]="<font color=red><b>*Please enter a valid quantity.</b></font>";
		show_product();
	}
		elseif($quantity2==0)
                {
			$quantity_errors[]="<font color=red><b>*Please enter a valid quantity.</b></font>";
			show_product();
		}
	else 
        {
		if ($_SESSION['quantity2'] > 0) 
                {
			$_SESSION['quantity2']+= $quantity2;
		}
		else 
                {
			$_SESSION['quantity2']=$quantity2;
		}
		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=./shoppingcartfunction.php">';
	}
}
else 
{
	show_product();
}
}
?>