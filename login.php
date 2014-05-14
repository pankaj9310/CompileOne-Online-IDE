<?php

if(file_exists("functions.php")) include("functions.php"); else exit;



function check()

{	

	global $mysql_hostname,$mysql_username,$mysql_password,$mysql_dbname;

	// username and password sent from form

	$username=$_POST['username'];

	$password=$_POST['password'];

	//Filter out html entities to preve	nt XSS attacks

	$username = htmlentities($username);

	$password = htmlentities($password);



	// To protect MySQL injection (more detail about MySQL injection)

	$username = stripslashes($username);

	$password = stripslashes($password);

	$conn = mysql_connect($mysql_hostname, $mysql_username, $mysql_password);



	if(! $conn )

	{

	  	die('Could not connect: ' . mysql_error());

	}

	mysql_select_db($mysql_dbname);







	$sql="SELECT * FROM users WHERE username='$username'";

	$result=mysql_query($sql,$conn);



	// Mysql_num_row is counting table row

	$count=mysql_num_rows($result);


	// If result matched $username table row must be 1 row



	if($count==1)

	{

		$ret = mysql_fetch_array($result, MYSQL_ASSOC);



		//authenticated user

		$pwd = $ret['password'];

		if($pwd == PwdHash($password,substr($pwd,0,9)))

		{



			if(!$ret['flag'])

			{

				mysql_close($conn);

				echo "Account not verified.Please check your email for verification link";

				die();

			}

			else

			{

				// this sets session and logs user in  

		       	   	session_start();

			   	session_regenerate_id (true); //prevent against session fixation attacks.



			   	// this sets variables in the session  

				$_SESSION['username'] = $username;

				$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);

		

				//update the timestamp and key for cookie

				$stamp = time();

				$ckey = GenKey();

				$upd_qry = "UPDATE users SET ctime=$stamp,ckey='$ckey' WHERE username='$username'";

				mysql_query($upd_qry,$conn);

		

				//set a cookie 

			  	if($_POST['remember'] == "true")

				{

					setcookie("username",$_SESSION['username'], time()+60*60*24*COOKIE_TIME_OUT, "/");

					setcookie("userkey", sha1($ckey), time()+60*60*24*COOKIE_TIME_OUT, "/");

				}					

				mysql_close($conn);

				echo "true";

				//header("Location : http://www.google.com");

				die();

				

			}

		}

		else 

		{

			mysql_close($conn);

			echo "Wrong Password";

		}

		

	}

	else 

	{

		mysql_close($conn);

		echo "Wrong Username";

	}



}

if(isset($_POST['todo'])) 

{

	if($_POST['todo'] == "login")

	{

		check();

	}

	die();	

}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>sign In</title>



<link href="assets/css/bootstrap-with-responsive-1200-only.css" rel="stylesheet" type="text/css" />

<link href="assets/css/compileone.css" rel="stylesheet" type="text/css" />

<link href="assets/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />

<link href="assets/css/styles.css" rel="stylesheet" type="text/css" />

<link rel="shortcut icon" type="image/x-icon" href="logo/favicon.ico"/>

<style type="text/css">

	.navbar-fixed-top,.navbar-fixed-bottom{position:fixed;right:0;left:0;z-index:1030;margin-bottom:0;}

         .navbar-inner{

			 background:#F4F4F4;

				font-size:14px;

				height:40px;

			 }

			 .navbar-inner > a:hover{color:#666;}



	a:hover{

			

			color:#08c;

		}

		

</style>



</head>



<body>



<?php include 'header.php' ?>

	<script type="text/javascript" src="assets/js/bootstrap-dropdown.js"></script>

	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

   	<script type="text/javascript" src="assets/js/login-signup.js"></script>

    	<script type="text/javascript" src="assets/js/jquery_002.js"></script>

        <script type="text/javascript" src="assets/js/jquery_003.js"></script>

        <script type="text/javascript" src="assets/js/mailcheck.js"></script>

    	<script type="text/javascript" src="assets/js/application.js"></script>

<div class="container">

    <div class="row">

	<div class="span2" style="margin-top:70px;">

   		<img src="./login.png" alt="CompileOne" height=200 width=200 style="float:left;"/>   

	</div>

	<div class="signup span8">

  

        <h2>Sign In</h2>

	<form id="signup-form" method="post" novalidate="novalidate">





            <div class="control-group ">

                <div class="controls ">

                    <div class="input-prepend " style="width:400px;">

                        <label class="control-label add-on" for="signup-username">Username</label>

                        <input id="signup-username" name="username" tabindex="1" required="" type="text" >

                    </div>

                </div>

                   <div class="controls">

                    <div class="input-prepend input-append">

                        <label class="control-label add-on" for="login-password">Password</label>

                        <input id="login-password" tabindex="2" name="password" required="" type="password">

                        <label class="checkbox add-on show-password" for="login-show-password-checkbox">

                            <input id="login-show-password-checkbox" class="show-password-checkbox novalidate" data-toggle="showpassword" data-target="#login-password" type="checkbox"> Show

                        </label>

                    </div>

                </div>

            </div>



			

		 <span id="response" style="font-weight:bold"></span>

		

           <div class="control-group">

                <div class="controls">

			

                    <button type="submit" tabindex="3" class="btn btn-large btn-primary transitional">Log In</button>

                    

                    <label class="checkbox"  style="display: inline-block; position: relative; top: 5px; margin-left: 15px;">

                        <input id="remember" type="checkbox"> Remember Me

                    </label>





                    

                </div>

            </div>

            

            <div class="control-group">

                <div class="controls text-center">

                    <div class="span"> New Account? </div><a href="register.php">Register here</a>.

                </div>

            </div>

	</form>

	</div>



    </div><!--/ .signup -->

    </div>

    </div>

<script>

	$("#signup-form").submit(function(){

					$('#response').text(""); 

					var username = $('#signup-username').val();

					var password = $('#login-password').val();

					var remember = $('#remember').is(':checked')



					$.post('login.php', {'todo':'login','username':username,'password':password,'remember':remember},function(dt){  

										if(dt == "true")

										{

											window.location = "home.php"; 

										}

										else

										{

											$('#response').css("color","red");

											$('#response').text(dt);

										} 

										 });

						return false;

		

					});

	$("#drop-sign").click(function(){

				var username = $('#username').val();

				var password = $('#password').val();

				var remember = $('#remember').is(':checked')

				$.post('login.php', {'todo':'login','username':username,'password':password,'remember':remember},function(dt){  

									if(dt == "true")

									{

										window.location = "home.php"; 

									}

									else

									{

										window.location = "login.php"; 

									} 

									 });

					return false;

	

				});

	



</script>



<?php include 'footer.php' ?>

</body>

</html>
