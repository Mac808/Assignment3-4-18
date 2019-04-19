<link rel="stylesheet" type="text/css" href="css.css">.
<?php
ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'NONE');
//start the session
session_start();
function show_product(){
global $quantity_errors;
global $quantity;
global $username;

?>
<html>
<head>
<title> Optimum Nutrition Creatine </title>
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
        <h1>Grandma's Own Cookie Store</h1>
      </div></th>
    </tr>
    <tr>
      <th height="50" align="left" valign="bottom" bgcolor="#FFFFFF" scope="col"><table width="100%" height="39" >
        <tr>
           <th width="40%" height="33" scope="col">Welcome <?php echo $username ; ?> <a href="./logout.php">Logout...</a></th>
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
                    <th bgcolor="#CCCCCC" scope="col"><img src='./Creatine.jpg' width="150" height="150"></th>
                </tr>
              </table></th>
            </tr>
          </table>
		  <a href="./barchocolate.php"><--Previous Product</a> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		  &nbsp; &nbsp; &nbsp;<a href="./barpeanut.php">Next Product--> </a>
		  </td>
          <td width="59%" align='top left' valign="top"><h2><font face="Verdana, Arial, Helvetica, sans-serif"> <br>
            Optimum Nutrition Creatine </h2>
              <br>
			  <Br>
			  <p align="left">Description:<br>
			   Optimum Nutrition Creatine <br></p>
              <p align="left"><font color="white">Price: $44.99</p>
			  <table width="100%" height="160" >
                <tr>
                  <th scope="col"><p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <table width="100%" height="40" >
                    <tr><td><form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
					Quantity: <input type='text' name='quantity' value='<?php echo $quantity; ?>'  size='2'>
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


//if no username or session started redirect them to the login page
if ($_SESSION['username']==NULL){
	echo '<meta HTTP-EQUIV="REFRESH" content="3; url=./Login.php">';
	echo "<p><h3>Error: You must be logged in to view products!</h3><br>
			You are now being redirect to log in.";
	}
else {
$username = $_SESSION['username'];
$quantity_errors=array();


if (isset($_POST['addcart'])) {
	$quantity = trim($_POST['quantity']);

	if (!(is_numeric($quantity) && is_int($quantity - (int) $quantity) && $quantity >= 0)){
		$quantity_errors[]="<font color=red><b>*Please enter a valid quantity.</b>";
		show_product();
	}
	elseif($quantity==0){
		$quantity_errors[]="<font color=red><b>*Please enter a valid quantity.</b>";
		show_product();
	}
	else {
		if ($_SESSION['quantity5'] > 0) {
			$_SESSION['quantity5']+= $quantity;
		}
		else {
			$_SESSION['quantity5']=$quantity;
		}
		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=./shoppingcartfunction.php">';
	}
}
else {
	show_product();
}

}
?>