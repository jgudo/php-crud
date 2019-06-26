<?php 
	include 'class.php';

	function add() {	
		global $db;
		if (isset($_POST['btn-submit'])) {
			$firstname   = htmlentities($_POST['first_name']);
			$lastname    = htmlentities($_POST['last_name']);
			$username    = htmlentities($_POST['username']);
			$email       = htmlentities($_POST['email']);
			$password    = password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT);
			
			$check = $db->username_exist($username,$email);
			if ($check) {
				echo '<div class="card-panel red darken-4 white-text" style="border-radius:0px; position: absolute; bottom: 20px; right: 20px;"><strong>Username or Email</strong> already exists</div>';
			} else {
				$query = $db->Insert($firstname,$lastname,$username,$email,$password);
				echo '<div class="card-panel green darken-1 white-text" style="border-radius:0px; position: absolute; bottom: 20px; right: 20px;"><strong>Successfully</strong> save person</div>';
			}
		}
	}

	function update() {
		global $db;
		if (isset($_POST['btn-submit'])) {
			$id = $_POST['id'];
			$firstname = htmlentities($_POST['first_name']);
			$lastname  = htmlentities($_POST['last_name']);
			$username  = htmlentities($_POST['username']);
			$email     = htmlentities($_POST['email']);

			$query = $db->update($id, $firstname,$lastname,$username,$email);
			if ($query) {
				header('location: edit.php?edit_id=?update='.password_hash($id,PASSWORD_DEFAULT).';'.$id.';'.password_hash('idhash', PASSWORD_DEFAULT));
			}
		}
	}

