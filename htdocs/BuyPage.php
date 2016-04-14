<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Stock Market Simulator</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="jquery/cufon-yui.js"></script>
    <script type="text/javascript" src="jquery/Book_Antiqua_400.font.js"></script>
    <script type="text/javascript">
        Cufon.replace ('h1')('h2')('h3')('h4')('#logo a')('#buttons a');
    </script>
<link href="styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
</head>

<style>
*{
  margin:0px;
  padding:0px;
  }
body{
  font-family:Tahoma, Geneva, sans-serif;
  }
#container{
  width:550px;
  background-color:rgba(250,250,252,.9);
  margin:auto;
  margin-top:10px;
  margin-bottom:10px;
  box-shadow:0 0 3px #999;
  }
#container_body{
  padding:20px;
  }
.form_title{
  font-size:35px;
  color:#141823;
  text-align:center;
  padding:10px;
  font-weight:normal;
  /* background-image: url('../images/reg.jpg');*/
  }
.head_para{
  font-size:19px;
  color:#99a2a7;
  text-align:center;
  font-weight:normal;
  }
#form_name{
  padding:25px 0 0 15px;
  }
.firstnameorlastname{
   margin-right:20px;
  }
.input_name{
  width:207px;
  padding:5px;
  font-size:18px;
  }
#email_form{
  clear:both;
  padding:15px 0 10px 0px;
  }
.input_email{
  width:434px;
  padding:5px;
  font-size:18px;
  }
#Re_email_form{
  padding:10px 0 10px 0px;
  }
.input_Re_email{
  width:434px;
  padding:5px;
  font-size:18px;
  }
#password_form{
  padding:10px 0 10px 0px;
  }
.input_password{
  width:434px;
  padding:5px;
  font-size:18px;
  }
.birthday_title{
  font-size:16px; 
  color:#8b919d; 
  font-weight:normal;
  padding:0 0 10px 0;
  }
select{
  padding:5px;
  }
#birthday{
  font-size:12px;
  color:#8b919d;
  padding-top:10px;
  }
#radio_button{
  padding:10px 0 0 0;
  }
#sign_user{
  font-size:14px;
  color:#FFF;
  text-align:center;
  background-color:#3B5998;
  padding:10px;
  margin-top:10px;
  cursor: pointer;
  }
#errorBox{
  color:#F00;
  }
  input.Submit {
    width: 20em;  height: 2em;
}

.bgimg {
    background-image: url('../images/reg.jpg');
}

.save{
    background-image:url("../images/save.gif");
    background-repeat:no-repeat;
    color:white;
    width:100px;
    height:40px;
    cursor:pointer;
    background-color:transparent;
    border:none;    
}




</style>
<?php

header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_start();
$name= $_SESSION['name'];

mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('userdata') or die(mysql_error());

$companyName='';

if ( isset($_POST['company_name']) && $_POST['company_name'])
{
	
	$companyName=$_POST['company_name'];
	$query=mysql_query("select * from myaccount where username='".$name."'") or die(mysql_error());
	$result=mysql_fetch_row($query);

	$query1=mysql_query("select * from stockData where CompanySymbol='".$companyName."'") or die(mysql_error());
	$stockPrice=mysql_fetch_row($query1);
	$buyingCapacity=0;
	if($stockPrice[2] != 0)
	{
		$buyingCapacity=$result[4]/$stockPrice[2];
	}
	

}
else
{
	
	$cname= $_POST['company_name_2'];
	$query=mysql_query("select * from myaccount where username='".$name."'") or die(mysql_error());
	$result=mysql_fetch_row($query);

	$query1=mysql_query("select * from stockData where CompanySymbol='".$cname."'") or die(mysql_error());
	$stockPrice=mysql_fetch_row($query1);

	
	//if($stockPrice != 0)
	{
		$buyingCapacity=$result[4]/$stockPrice[2];
	}

	if($_POST['quantity'] > $buyingCapacity)
	{
		 echo "The no of shares exceeds the maximum quantity";
		echo '<script language="javascript">';
		echo 'alert("The no of shares exceeds the maximum quantity!! Please enter the values within buying capacity!")';
		echo '</script>';
	}
	else
	{
		$query=mysql_query("select * from stockData where companySymbol='".$cname."'") or die(mysql_error());
		$res=mysql_fetch_row($query);
		if($res)
		{
			//echo "Query of stockData Passes!";
		}

		$sql_1="insert into stockHistory(username, companySymbol, stockPrice, noOfShares) 
		        values('".$_SESSION['name']."','".$cname."','".$res[2]."','".$_POST['quantity']."')";
		$res1=mysql_query($sql_1);
		if($res1)
		{
			//echo "Query of stockHistory Passed!";
		}


		$sql_2="update myaccount set stocksPurchased = stocksPurchased + '".$_POST['quantity']."', balance = balance - '".$res[2]."' * '".$_POST['quantity']."'  where username = '".$_SESSION['name']."'";
		$res2=mysql_query($sql_2);
		if($res2)
		{
			//echo "Query of myaccount Passes!";
		}
  	}
  	$companyName=$cname;
}
?>
<body>
    <div id="main">
    <!-- header begins -->
    <div id="header">
        <div id="logo">
            <a href="#">Stock Market Simulator</a>
			<h2><font font="small-caption" color="yellow"; style="text-decoration: blink;"><blink><marquee width="60%">Get the most updated live stock values</blink></marquee></font></h2>

        </div>
        <div id="buttons" align="center">
            <a href="learnMoreSpecific.html" class="but"  title="">Learn More </a><div class="but_razd"></div>
			      <a href="Myaccount.php" class="but"  title="">My Account    </a><div class="but_razd"></div>
            <a href="Mystocks.php" class="but" title=""> My Stocks</a><div class="but_razd"></div>
            <a href="Logout.php"  class="but" title="">Logout    </a><div class="but_razd"></div>

        </div>

         <div>  <!-- START Worden Top Gainers Ticker Widget -->
		<script src="js/jquery-1.3.1.min.js" type="text/javascript"></script> 
		<script src="js/WBIHorizontalTicker2.js?ver=12334" type="text/javascript"></script> 
		<link href="css/WBITickerblue.css" rel="stylesheet" type="text/css" />
		<script>
		var gainTicker = new WBIHorizontalTicker('gainers');gainTicker.start(); 
		 </script> <!-- End Scrolling Ticker Widget --> </div>
          

    
    </div>
    <!-- header ends -->

    <!-- top -->
    <div class="top">
       <!-- <div class="top_top"></div>-->


       <div style="width: 100%; overflow: hidden;">

       	<div style="width: 500px; float: left;"> 
<?php
          

if ( isset($_POST['company_name']))
{
					$comp_name= $_POST['company_name'];
}
else //if (isset($_POST['company_name_2']))
{
					$comp_name=$_POST['company_name_2'];
}
					mysql_connect('localhost','root','') or die(mysql_error());
					mysql_select_db('userdata') or die(mysql_error());


					$query=mysql_query("select * from stockData where CompanySymbol='".$comp_name."'") or die(mysql_error());
					$res=mysql_fetch_array($query);

echo "<div class=clear style=height:19px></div>";
				  {
					  echo "<form>";
					  
					echo "<table  style=width:90% height:70%>";

           			 echo "<tr style='border:5px double white'>";
					echo "<th bgcolor='000000' style='border:5px double white'><b><font color=white>Company Ticker Symbol:</font></b></th>";
					  echo "<td bgcolor='000000' style='border:5px  white'> <font color=white>" . $res['CompanySymbol'] . "</font></td>";
					  
					  
					  echo "<tr style='border:5px double green'>";
					 echo "<th bgcolor='000000' style='border:5px double white'><font color=white>Company Name:</font></th>";
					  echo "<td bgcolor='000000' style='border:5px  white'><font color=white>" . $res['Name'] . "</font></td>";
					  
					    echo "</tr>";
						
						echo "<tr style='border:5px double green'>";
					  echo "<th bgcolor='000000' style='border:5px double white'><font color=white>Last Trade Price:</font></th>";
					  echo "<td bgcolor='000000' style='border:5px  white'><font color=white>" . $res['lastTradePrice'] . "</font></td>";
					    echo "</tr>";
						
						
						 echo "<tr style='border:5px double green'>";
					  echo "<th bgcolor='000000' style='border:5px double white'><font color=white>Last Trade Date:</font></th>";
					  echo "<td bgcolor='000000' style='border:5px  white'><font color=white>" . $res['lastTradeDate'] . "</font></td>";
					    echo "</tr>";
						
						echo "<tr style='border:5px double green'>";
					  echo "<th bgcolor='000000' style='border:5px double white'><font color=white>Last Trade Time:</font></th>";
					  echo "<td bgcolor='000000' style='border:5px  white'><font color=white>" . $res['lastTradeTime'] . "</font></td>";
					    echo "</tr>";
						
						echo "<tr style='border:5px double green'>";
					  echo "<th bgcolor='000000' style='border:5px double white'><font color=white>Change and Percent Change:</font></th>";
					  echo "<td bgcolor='000000' style='border:5px  white'><font color=white>" . $res['PChange'] . "</font></td>";
					    echo "</tr>";

					    echo "<tr style='border:5px double green'>";
					  echo "<th bgcolor='000000' style='border:5px double white'><font color=white>Volume:</font></th>";
					  echo "<td bgcolor='000000' style='border:5px  white'><font color=white>" . $res['Volume'] . "</font></td>";
					    echo "</tr>";

					    	echo "<tr style='border:5px double green'>";
					  echo "<th bgcolor='000000' style='border:5px double white'><font color=white>Day's High:</font></th>";
					  echo "<td bgcolor='000000' style='border:5px  white'><font color=white>" . $res['DayHigh'] . "</font></td>";
					    echo "</tr>";

					    	echo "<tr style='border:5px double green'>";
					  echo "<th bgcolor='000000' style='border:5px double white'><font color=white>Day's Low:</font></th>";
					  echo "<td bgcolor='000000' style='border:5px  white'><font color=white>" . $res['DayLow'] . "</font></td>";
					    echo "</tr>";

					    	echo "<tr style='border:5px double green' >";
					  echo "<th bgcolor='000000' style='border:5px double white'><font color=white>52-Week High:</font></th>";
					  echo "<td bgcolor='000000' style='border:5px  white'><font color=white>" . $res['WeekHigh'] . "</font></td>";
					    echo "</tr>";

						echo "<tr style='border:5px double green'>";
					  echo "<th bgcolor='000000' style='border:5px double white'><font color=white>52-Week Low: </font></th>";
					  echo "<td bgcolor='000000' style='border:5px  white'><font color=white>" . $res['WeekLow'] . "</font></td>";
					    echo "</tr>";


					echo "</table>";

					echo "</form>";
					  }
					?>

       	</div>

       	<div style="margin-left: 500px;margin-top: 20px"> 						<!-- TradingView Widget BEGIN -->


				
				<script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
				<script type="text/javascript">
				 var php_var = "<?php echo $comp_name; ?>";

				new TradingView.MediumWidget({
				  "container_id": "tv-medium-widget-fd7b0",
				  "symbols": [
				    [
				      php_var,
				      php_var
				    ],

				  ],
				  "gridLineColor": "#E9E9EA",
				  "fontColor": "#83888D",
				  "underLineColor": "#dbeffb",
				  "trendLineColor": "#4bafe9",
				  "width": 560,
				  "height": 320,
				  "locale": "en"
				});
				</script>
		</div>
		
 		<div class="clear" style="height: 19px"></div>

		<div><!-- START Worden Top Losers Ticker Widget <script src="http://widgets.freestockcharts.com/js/jquery-1.3.1.min.js" type="text/javascript"></script> <script src="http://widgets.freestockcharts.com/script/WBIHorizontalTicker2.js?ver=12334" type="text/javascript"></script> <link href="http://widgets.freestockcharts.com/WidgetServer/WBITickerblue.css" rel="stylesheet" type="text/css" /> <script> var loserTicker = new WBIHorizontalTicker('losers'); loserTicker.start(); </script>  End Scrolling Ticker Widget -->
		</div>

		<div class="clear" style="height: 29px"></div>

<div><!-- START Worden Top Losers Ticker Widget -->
<script src="js/jquery-1.3.1.min.js" type="text/javascript"></script> 
<script src="js/WBIHorizontalTicker2.js?ver=12334" type="text/javascript"></script> 
<link href="css/WBITickerblue.css" rel="stylesheet" type="text/css" />
<script>
var loserTicker = new WBIHorizontalTicker('losers'); loserTicker.start(); </script> <!-- End Scrolling Ticker Widget -->
		</div>

<div>

<form method="post" action="BuyPage.php">
					<table style="width:100%">
					  <tr>
					    <td bgcolor="000000"><b><font color="white">Buy Quantity :</font></b></td>
						<td bgcolor="000000"><font color="white"><input style="color: #FFFFFF;background-color: #000000;width: 500px;" type="text" name="quantity" value="" placeholder="Enter No of of Shares to be bought"/></font></td>			    
					  </tr>
					  <tr>
					      <?php

					    $query=mysql_query("select * from myaccount where username='".$name."'") or die(mysql_error());
						$result=mysql_fetch_row($query);
					    ?>

					    <td bgcolor="000000"><font color="white"><b>Available Funds:</b></font></td>
					    <td bgcolor="000000"><font color="white"><?=$result[4]?></font></td> 
					  </tr >
					    <tr>
					    <?php
					    $buyingCapacity=$result[4]/$stockPrice[2]
					    ?>
					    <td bgcolor="000000"><font color="white"><b>Buying Capacity:</b></font></td>
					    <td bgcolor="000000"><font color="white"><?=intval($buyingCapacity)?></font></td> 
					  </tr>
					</table>	

					<div id="buttons">
        	 		<input  align ="center" class="save" style= "font-size:100%;width:100px;height:50px" 
        	 		type="submit" value="Buy" 			background-color="transparent">

        	 		<input type="hidden" name="company_name_2" value="<?php echo $companyName; ?>">
            		 </div>	


				
			   </form>
			   
			   <form method="post" action="stockofacompany.php">
			  
			   <div id="buttons">
        	 		<input  align ="center" class="save" style= "font-size:100%;width:100px;height:50px" 
        	 		type="submit" value="Back" 			background-color="transparent">

        	 		<input type="hidden" name="company" value="<?php echo $companyName; ?>">
            	</div>	



			   </form>
</div>






       </div>


	</div>



<div class="top_top"></div>
         <!-- START Worden Top Gainers and Losers Ticker Widget 
<script src="http://widgets.freestockcharts.com/js/jquery-1.3.1.min.js" type="text/javascript"></script> <script src="http://widgets.freestockcharts.com/script/WBIHorizontalTicker2.js?ver=12334" type="text/javascript"></script> <link href="http://widgets.freestockcharts.com/WidgetServer/WBITickerblue.css" rel="stylesheet" type="text/css" />
<script>
    var gainerTick = new WBIHorizontalTicker('gainers');
    gainerTick.start();
    var loserTick = new WBIHorizontalTicker('losers');
    loserTick.start();
    </script>  End Scrolling Ticker Widget -->
 


    
 
	
   
<div id="footer">
        <div id="footer_box1">
            <p>Copyright 2015 <!-- Do not remove -->Designed by Group 23</a><!-- end --><br />
            <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a> </p>
        </div>
        <div id="footer_box2">
            <a href="https://www.youtube.com/"><img src="images/f5.png" class="footer_img" alt="" /></a>
            <a href="https://twitter.com/"><img src="images/f2.png" class="footer_img" alt="" /></a>
            <a href="https://www.yahoo.com/"><img src="images/f3.png" class="footer_img" alt="" /></a>
            <a href="https://www.facebook.com/"><img src="images/f1.png" class="footer_img" alt="" /></a>
        </div>
    </div>
    </div>
</body>
</html>
