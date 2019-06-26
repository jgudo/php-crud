<?php 

	class DBHandler {
		private  $db;

		function __construct() {
			$this->connect();
		}

		public function getInstance() {
			return $this->db;
		}

		private function connect() {
			define('HOST', 'localhost');
			define('USERNAME', 'root');
			define('PASSWORD', '');
			define('DBNAME', 'crud');

			$conn_string = "mysql:host=" . HOST . ";dbname=" . DBNAME;
			try {
				$this->db = new PDO($conn_string, USERNAME, PASSWORD);
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}

		function Insert($firstname,$lastname,$username,$email,$password) {
			$data = implode(',', array('first_name','last_name','username','email','password'));
			try {
				$stmt = $this->db->prepare("INSERT INTO person_tbl ($data) VALUES (:fname , :lname , :username , :email , :pw )");
				$stmt->bindparam(':fname', $firstname, PDO::PARAM_STR);
				$stmt->bindparam(':lname', $lastname, PDO::PARAM_STR);
				$stmt->bindparam(':username', $username, PDO::PARAM_STR);
				$stmt->bindparam(':email', $email, PDO::PARAM_STR);
				$stmt->bindparam(':pw', $password, PDO::PARAM_STR);
				$stmt->execute();
				return true;
			} catch(PDOException $e) {
				echo $e;
			}
 		}

 		function update($id, $firstname, $lastname, $username, $email) {
			try {
				$query = "UPDATE person_tbl SET first_name = :fname, last_name = :lname, username = :username, email = :email WHERE id= :id";
				$stmt = $this->db->prepare($query);
				$stmt->bindparam(':fname', $firstname, PDO::PARAM_STR);
				$stmt->bindparam(':lname', $lastname, PDO::PARAM_STR);
				$stmt->bindparam(':username', $username, PDO::PARAM_STR);
				$stmt->bindparam(':email', $email, PDO::PARAM_STR);
				$stmt->bindparam(':id', $id, PDO::PARAM_INT);
				$stmt->execute();
				return true;
			} catch(PDOException $e) {
				echo $e;
			}
 		}

 		function delete($id) {
 			$stmt = $this->db->prepare("DELETE FROM person_tbl WHERE id= :id ");
 			$stmt->execute(array(":id"=> $id));
 			return true;
 		}

 		function getID($id) {
 			$stmt = $this->db->prepare("SELECT * FROM person_tbl WHERE id = :id  ");
 			$stmt->execute(array(":id" => $id));
 			if($stmt->rowCount() > 0)
			{
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
 				return $result;
			} else {
				// if id is empty in database
 				header("location: index.php");
 			}
 		}

 		function username_exist($username, $email) {
 			try {
 				$stmt = $this->db->prepare("SELECT username FROM person_tbl WHERE username = ? OR email = ? ");
 				$stmt->bindparam(1, $username);
 				$stmt->bindparam(2, $email);
 				$stmt->execute();
 				if($stmt->rowCount() > 0)
 				{
 					return true;
 				}
 			} catch(PDOException $e) {
 				echo $e;
 			}

 		}

 		function personview($query) {
 			$stmt = $this->db->prepare($query);
 			$stmt->execute();

 			if ($stmt->rowCount() > 0) {
 				while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
		 			?>
							<tr>
								<td><?php echo $row->first_name.' '.$row->last_name;?></td>
								<td><?php echo $row->username;?></td>
								<td><?php echo $row->email;?></td>
								<td>
									<!-- Hashing id url link -->
									<a href="edit.php?edit_id=<?php echo password_hash($row->id,PASSWORD_DEFAULT).';'.$row->id.';'.password_hash('idhash',PASSWORD_DEFAULT) ?>" class="btn waves-effect waves-light">Edit</a>
									<a href="index.php?delete_id=<?php echo $row->id; ?>" class="btn waves-effect waves-light">delete</a>
								</td>
							</tr>					
		 			<?php 
		 		}
 			} else {
 				?>
 					   <tr>
							<td>No result found</td>
 					   </tr>

 				<?php 	
 			}
 		}
}

$db = new DBHandler();

if ($db->getInstance() === null) {
    die("Cannot establish database connection");
}