
<?php 
	include 'config/functions.php';

	if (isset($_GET['edit_id'])) {
		$array = explode(";", $_GET['edit_id']);
		$id = $array[1];
		extract($db->getID($id));
	} else {
		// if id is empty in url
		header("location:index.php");
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit Person</title>
		<link rel="stylesheet" type="text/css" href="materialize/fonts/materialize-icon.css">
		<!-- <link rel="stylesheet" type="text/css" href="materialize/css/bootstrap.min.css"> -->
		<link rel="stylesheet" type="text/css" href="materialize/css/materialize.min.css">
		<style type="text/css">
			.alert-success{
				padding: 15px;
			}
			.alert-danger{
				padding: 15px;
				color:red;
				background-color: red;
			}
		</style>
	</head>
	<body>
		<nav style="margin-bottom: 20px;" class="blue darken-1">
			<div class="nav-wrapper">
				<a href="index.php" class="left" style="margin-left:50px; font-size: 26px">Back</a>
			</div>
		</nav>
		<main style="padding: 20px 40px">
			<div class="row">
				<div class="col s12 m8 13">
					<!-- form -->
					<div class="row">
					<?php update();?>
						<form  method="post">
							<div class="row">
								<h5 style="margin-left:15px;">Edit Person</h5>
								<br/>
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<div class="input-field col s6">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" class="validate" name="first_name" required="" value="<?php echo $first_name;?>">
									<label for="icon_prefix">First Name</label>
								</div>
								
								<div class="input-field col s6">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" class="validate" name="last_name" required="" value="<?php echo $last_name;?>">
									<label for="icon_prefix">Last Name</label>
								</div>

								<div class="input-field col s6">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="email" class="validate" name="email" required="" value="<?php echo $email;?>">
									<label for="icon_prefix">Email</label>
								</div>

								<div class="input-field col s6">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" class="validate" name="username" required="" value="<?php echo $username;?>">
									<label for="icon_prefix">Username</label>
								</div>

								<button class="btn waves-effect waves-light right col s5" type="submit" name="btn-submit">Save Changes
									<i class="material-icons left">send</i>
								</button>
							</div>
						</form>
					</div>
					<!-- // form     -->
				</div>
			</main>
		<script type="text/javascript" src="materialize/jquery/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
	</body>
</html>