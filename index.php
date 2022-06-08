<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>ToolDream</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <style>

	body{
		margin: 0;
		padding: 0;
		display: flex;
		justify-content: center;
		align-items: center;
		min-height: 100vh;
		font-family: 'Jost', sans-serif;
		background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
	}
	.main{
		width: 350px;
		height: 500px;
		background: red;
		overflow: hidden;
		background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
		border-radius: 10px;
		box-shadow: 5px 20px 50px #000;
	}
	#chk{
		display: none;
	}
	.signup{
		position: relative;
		width:100%;
		height: 100%;
	}
	label{
		color: #fff;
		font-size: 2.3em;
		justify-content: center;
		display: flex;
		margin: 60px;
		font-weight: bold;
		cursor: pointer;
		transition: .5s ease-in-out;
	}
	input{
		width: 60%;
		height: 20px;
		background: #e0dede;
		justify-content: center;
		display: flex;
		margin: 20px auto;
		padding: 10px;
		border: none;
		outline: none;
		border-radius: 5px;
	}
	button{
		width: 60%;
		height: 40px;
		margin: 10px auto;
		justify-content: center;
		display: block;
		color: #fff;
		background: #573b8a;
		font-size: 1em;
		font-weight: bold;
		margin-top: 20px;
		outline: none;
		border: none;
		border-radius: 5px;
		transition: .2s ease-in;
		cursor: pointer;
	}
	button:hover{
		background: #6d44b8;
	}
	.login{
		height: 460px;
		background: #eee;
		border-radius: 60% / 10%;
		transform: translateY(-180px);
		transition: .4s ease-in-out;
	}
	.login label{
		color: #573b8a;
		transform: scale(.6);
	}
	
	#chk:checked ~ .login{
		transform: translateY(-500px);
	}
	#chk:checked ~ .login label{
		transform: scale(1);	
	}
	#chk:checked ~ .signup label{
		transform: scale(.6);
	}

	.errormensage{
	text-align: center;
	}

  </style>

</head>

<?php

include_once 'db.php';

conectadb();

?>

<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

		<?php

			session_start();

				if(isset($_SESSION["mensaje2"])){

				$cambios = $_SESSION["mensaje2"];

				print "<div style = 'float: left; margin-left: 32px; margin-top: 10px'class='errormensage'></br><strong>$cambios</strong></div>";

				unset($_SESSION["mensaje2"]);

				}

		?>

			<div class="signup">
				<form  method="post" action="add_usuarios.php">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="user" placeholder="User name">
					<input type="email" name="email" placeholder="Email">
					<input type="password" name="pswd" placeholder="Password">
					<button>Sign up</button>
				</form>
			</div>

			<div class="login">
				<form  method="post" action="login.php">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" id="username" name="user" placeholder="User Name">
					<input type="password" id="password" name="password" placeholder="Password">
					<button>Login</button>

					<?php

							if(isset($_SESSION["mensaje1"])){

							$errormensege = $_SESSION["mensaje1"];

	  						print "<div class='errormensage'></br>$errormensege</div>";

							unset($_SESSION["mensaje1"]);

							}

					?>
				
				</form>

			</div>
	</div>

<!-- partial -->
  
</body>

<?php

closedb();

?>

</html>
