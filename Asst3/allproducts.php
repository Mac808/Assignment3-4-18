<link rel="stylesheet" type="text/css" href="css.css">
<table>
            <tr>
                <th><b><span style=color:white;">M</span></b></th>
                <th><b><span style=color:white;">N</span></b></th>
                <th><b><span style=color:white;">C</span></b></th>
             
            </tr>
        </table>
<th width="40%" height="33" scope="col" ><p align="right"><a href="./logout.php">Logout</a></p></right></th>
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
ini_set('error_reporting', 'E_ALL');
ini_set('display_errors', 'none');
session_start();
//if no username or session started redirect them to the login page
function quantity_count($cookie_type)
{
    global $items_in_cart;
	if ($_SESSION[$cookie_type])
        {
		$items_in_cart+=1;
	}
	elseif(!$items_in_cart)
        {
		$items_in_cart=0;
	}
}
if ($_SESSION['username']==NULL)
{
	echo '<meta HTTP-EQUIV="REFRESH" content="3; url=./index.php">';
	echo "<p><h3>Error: You must be logged in to view products!</h3><br>
			You are now being redirect to log in.";
}
else 
{
    $Month = 2592000 + time();
    $time = 'time';
    $date = date("F jS Y - g:i a");
    //this cookie will expire in 30 days
    setcookie($time, $date, $Month);
?>



<html>
<head>
<title>All Products</title>
</head>

<body>

<table align=center width="70%" height="226" border="1">
  <tr>
  <th height="105" valign="bottom" scope="col">
      
  <?php
if(isset($_COOKIE[$time]))
{
$last = $_COOKIE[$time];
echo "	<h1><center><font face=arial>Welcome Back {$_SESSION['username']}! </h1><br>
				<font face=arial size=1>Username: {$_SESSION['username']}<br>
				Last visited: ". $last;
    $date = date("F jS Y - g:i a");
}
else
{
    echo "<center><h1><font face=arial>Welcome to our site {$_SESSION['username']}!
				</h1><font face=arial size=1>";
}
  ?>

<br><?php echo "Page last visited: {$_SERVER['HTTP_REFERER']}";?>
<br><?php if (isset($_SESSION['username'])) 
{
    echo "Login Status: Logged In";
}
    quantity_count('quantity1');
    quantity_count('quantity2');
    quantity_count('quantity3');
    quantity_count('quantity4');
    quantity_count('quantity5');
    quantity_count('quantity6');
    quantity_count('quantity7');
    quantity_count('quantity8');
    quantity_count('quantity9');
    global $items_in_cart;
    echo '<br><a href="./shoppingcartfunction.php"><img src="./shoppingcart.gif" width=22 height=22 border=0> Shopping Cart </a>';
    echo "Cart contains: $items_in_cart item(s)</font>";
?>

    <div align="center">
	<p>To start shopping click on the pictures below!</p></div></th>
  </tr>
  <tr>
    <th height="113" scope="row"><table width="100%" height="100%" border="1">
      <tr>
        <th scope="col"><font face=arial> Whey Protein </font> <br>
            <a href="./allwhey.php"><img src="./FV.jpg" border=0 alt="" width="150" height="150"></a></th>
        <th scope="col"><font face=arial> Pre-Workout </font> <br>
            <a href="./allpre.php"><img src="./FP.jpg" border=0 alt="" width="150" height="150"></a></th>
        <th scope="col"><font face=arial> Miscellaneous </font><br>
          <a href="./allmisc.php"><img src="./Creatine.jpg" border=0 alt="" width="150" height="150"></a></th>
      </tr>
    </table></th>
  </tr>
</table>
</body>
</html>
<?php
}
?>