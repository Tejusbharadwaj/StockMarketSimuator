<html>
<body>
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
Echo "<font color='white' size='6'>Registration Successful!</font>";
}
Else
{
Echo "<font color='white' size='6'>Registration Failed! \n</font>";
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
Echo "<font color='white' size='6'>You are now Registered!\n</font>";
}
Else
{
Echo "<font color='white' size='6'>Could not register! User already exists.. Try with a different E-mail ID.\n</font>";
}

}
else {
print "<font color='white' size='6'>Database Not Found</font> ";
}

?>
<body background="2.jpg">
<form method="get" action="login.html">
    <button type="submit" style="height:40px;width:70px">Continue</button>
</form>


</body>
</html>