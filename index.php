<?php 
	include 'config/functions.php';

	if (isset($_GET['delete_id'])) {
		$id = $_GET['delete_id'];
		$result = $db->delete($id);
		if($result) {
			header('location: index.php');
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP CRUD</title>
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
				<a href="index.php" class="left" style="margin-left:50px; font-size: 26px;">
					PHP PDO CRUD
				</a>
			</div>
		</nav>
		<main style="padding: 20px 40px;">
			<div class="row">
				<div class="col s12 m4 13">
					<!-- form -->
					<div class="row">
						<?php  add(); ?>
					
						<form  method="post">
							<div class="row">
								<h5 style="margin-left:15px;">Add Person</h5>

								<div class="input-field col s6 m12">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" class="validate" name="first_name" required="">
									<label for="icon_prefix">First Name</label>
								</div>
								
								<div class="input-field col s6 m12">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" class="validate" name="last_name" required="">
									<label for="icon_prefix">Last Name</label>
								</div>

								<div class="input-field col s6 m12">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="email" class="validate" name="email" required="">
									<label for="icon_prefix">Email</label>
								</div>

								<div class="input-field col s6 m12">
									<i class="material-icons prefix">account_circle</i>
									<input id="icon_prefix" type="text" class="validate" name="username" required="">
									<label for="icon_prefix">Username</label>
								</div>

								<div class="input-field col s6 m12">
									<i class="material-icons prefix">lock</i>
									<input id="icon_prefix" type="password" class="validate" name="password" required="">
									<label for="icon_prefix">Password</label>
								</div>

								<button class="btn waves-effect waves-light right col s5" type="submit" name="btn-submit">Save Changes
									<i class="material-icons left">send</i>
								</button>
							</div>
						</form>
					</div>
					<!-- // form     -->
				</div>

				<div class="col s12 m8 19">
					<div class="row">
						<h5>Accounts</h5>
						<table class="responsive-table bordered striped">
							<thead>
							<tr>
								<th>Name</th>
								<th>Username</th>
								<th>Email</th>
								<th>Controls</th>
							</tr>
							</thead>

							<tbody>
								<?php $query = "SELECT * FROM person_tbl"?>
								<?php $db->personview($query); ?>
							</tbody>

						</table>
					</div>
				</div>
			</div>
		</main>
		<script type="text/javascript" src="materialize/jquery/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
	</body>
</html>