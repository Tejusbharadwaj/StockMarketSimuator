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

  $user_name = "root";
$password = "";
$database = "userdata";
$server = "127.0.0.1";

$db_handle = mysql_connect($server, $user_name, $password);
$db_found = mysql_select_db($database, $db_handle);

if ($db_found) {
//print "Database Found ";

//if ($_POST['radiobutton1'] != " ") 
 //$gender= "male";
 //else
  $gender="female";
 //$sql="insert into myTable(firstname,lastname)  
//values('".$_POST['username']."', '".$_POST['name']."')";
  
$sql="insert into registrationDetails(firstname,lastname,email,password,birthday_month,birthday_day,birthday_year)  
values('".$_POST['Name']."', '".$_POST['LastName']."','".$_POST['Email']."','".$_POST['Password']."','".$_POST['birthday_month']."','".$_POST['birthday_day']."','".$_POST['birthday_year']."')";
$res=mysql_query($sql);
If($res)
{
//Echo "<font color='white' size='6'>Registration Successful!</font>";
$myVar='Registration Successful!';
$page='login.html';
$value='Login!';
}
Else
{
//Echo "<font color='white' size='6'>Registration Failed! \n</font>";
$myVar='Registration Failed!';
$page='register.html';
$value='Register Again';
}

//$uname= '".$_POST['email']."';
$bal=100000.0;
$sp=0; $ss=0;
$sql_2="insert into myAccount(firstname, lastname, username,password,balance,stocksPurchased,stocksSold)  
values('".$_POST['Name']."', '".$_POST['LastName']."','".$_POST['Email']."','".$_POST['Password']."', $bal,$sp,$ss)";
//values('".$_POST['email']."', $bal,$sp,$ss)";


$res2=mysql_query($sql_2);
If($res2)
{
//Echo "<font color='white' size='6'>You are now Registered!\n</font>";
$myVar2='You are now Registered!';
$page='login.html';
$value='Login';

}
Else
{
//Echo "<font color='white' size='6'>Could not register! User already exists.. Try with a different E-mail ID.\n</font>";
$myVar2='Could not register! User already exists.. Try with again..';
$page='register.html';
$value='Register Again';

}

}
else {
print "<font color='white' size='6'>Database Not Found</font> ";
}

?>


          ?>
<body>
    <div id="main">
    <!-- header begins -->
    <div id="header">
        <div id="logo">
        
            <a href="#" style= "font-size:320%;"><strong>Stock Market Simulator</strong></a>
			<h2><font font="small-caption" color="yellow"; style="text-decoration: blink;"><blink><marquee width="60%">Get the most updated live stock values</blink></marquee></font></h2>

        </div>
        <div id="buttons" align="center">
        

        </div>

  
    



    </div>
    <!-- header ends -->


    <!-- top -->
    <div class="top">
        <div class="top_top"></div>
         <!-- START Worden Top Gainers and Losers Ticker Widget -->
<script src="js/jquery-1.3.1.min.js" type="text/javascript"></script> 
<script src="js/WBIHorizontalTicker2.js?ver=12334" type="text/javascript"></script> 
<link href="css/WBITickerblue.css" rel="stylesheet" type="text/css" />
<script>
    var gainerTick = new WBIHorizontalTicker('gainers');
    gainerTick.start();
    var loserTick = new WBIHorizontalTicker('losers');
    loserTick.start();
    </script> <!-- End Scrolling Ticker Widget -->


<div id="buttons" align="center">
      
      
       <a align="center" href="" class="but_"  title="">  <?=$myVar?>    <?=$myVar2?>       </a><div class="but_razd"></div>
     
        

      </div>

  <div class="top_top_2">   </div>

        <div class="top_img">
		
		   <div id="slider-wrapper">        
            <div id="slider" class="nivoSlider">
                <img src="images/top_img.jpg" alt="" />
                <img src="images/top_img2.jpg" alt=""/>
                <img src="images/top_img3.jpg" alt="" />
            </div>        
        </div>

		
      
        
        

<script type="text/javascript" src="jquery/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
		
		</div>

        <div class="top_bot"></div>
    </div>
    <div class="clear" style="height: 9px"></div>
    
	<!-- content -->
	<div>
<form name="form" method="post" action="<?php echo $page; ?>" >
          <div id="buttons">
              <input  align ="center" class="save" style= "font-size:150%;width:200px;height:50px" 
              type="submit"  value="<?php echo $value; ?>"  name="submit"    background-color="transparent">
          </div> 
 </form>         

	<!--	<div id="description" ></div>
<div id="container">
  <div id="container_body">
    <div>
		<br /> <br />
      <h2 class="form_title">Search Stocks</h2>
    </div>

    <div id="form_name" >

      <div class="firstnameorlastname">

       <form name="form" method="post" action="searchStock_UpdateStock.php" >
	  
	   <div>
		<input id="sign_user" type="submit"  name="submit" value="Search"  style="height:50px; width:500px"  />
      </div>
   
     </form>
    </div>

  </div>
</div>
-->
	</div>
   
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
