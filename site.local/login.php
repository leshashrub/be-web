<?php
	session_start();
//echo ('SESSION START' . "<br/>");
	?>

<?php require_once("connection.php"); ?>
<?php include("header.php"); ?>	

<?php

	if(isset($_SESSION["session_username"])){
	// вывод "Session is set"; // в целях проверки
	header("Location: intropage.php");
        //echo('сработал иф на установленную сессию' . "<br/>");
	}


	if(isset($_POST["login"])){
       // echo('сработал иф на логин' . "<br/>");
        
	if(!empty($_POST['username']) && !empty($_POST['password'])) {
	$username=htmlspecialchars($_POST['username']);
        //echo($username . "<br/>");
	$password=htmlspecialchars($_POST['password']);
       // echo($password . "<br/>");
    $sql = "SELECT * from users where username = '$username' and userpass ='$password';";
    //echo $sql;
    $query = pg_query($dbcon, $sql);    
	$numrows=pg_num_rows($query);
	
    if($numrows!=0) {
        while($row=pg_fetch_row($query)) {
        $dbusername=$row[0];
        $dbpassword=$row[1];
    }
 
    if($username == $dbusername && $password == $dbpassword) {
	 $_SESSION['session_username']=$username;	 
 /* Перенаправление браузера */
   header("Location: intropage.php");
	}
	} else {
	//  $message = "Invalid username or password!";
	
	echo  "Invalid username or password!";
 }
	} else {
    $message = "All fields are required!";
	}
	}


/*$sql = 'select * from public.users where username = \'lesha\' and userpass = \'123\';';
$query = pg_query($dbcon,$sql);
$numrows=pg_num_rows($query);
echo ($numrows . "<br/>");

if($numrows!=0) {
    while($row=pg_fetch_row($query)) {
    $dbusername=$row[0];
        echo ('Hello,' . $dbusername . "<br/>");
    $dbpassword=$row[1];
        echo ('your pass is: ' . $dbpassword . "<br/>" );
 }
}
else {
    echo ('Неверное имя пользователя или пароль');
}*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title> Benza WEB </title>
<link href="style.css" media="screen" rel="stylesheet">
<link href= 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head> 
<body>

<div class="container mlogin">
<div id="login">
<h1>Вход</h1>
<form action="" id="loginform" method="post"name="loginform">
<p><label for="user_login">Имя пользователя<br>
<input class="input" id="username" name="username"size="20"
type="text" value=""></label></p>
<p><label for="user_pass">Пароль<br>
 <input class="input" id="password" name="password"size="20"
  type="password" value=""></label></p> 
	<p class="submit"><input class="button" name="login"type= "submit" value="Log In"></p>
	</form>
 </div>
  </div>

<?php include("footer.php"); ?> 
    
</body>
</html>