<?php
	session_start();
?>

<html>
	<body>

	<?php
		error_reporting( E_ALL&~E_NOTICE );
		
		//create database function
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "myDBPDO";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			// sql to create table
			$sql = "CREATE TABLE userinfo (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			username VARCHAR(30) NOT NULL,
			password VARCHAR(30) NOT NULL,
			email VARCHAR(50),
			reg_date TIMESTAMP
			)";

			// use exec() because no results are returned
			$conn->exec($sql);
			echo "Table MyGuests created successfully";
			}
		catch(PDOException $e)
			{
			//echo $sql . "<br>" . $e->getMessage();
			}
		
		//login function 
		if(isset($_POST['username']) == FALSE){
			header('Location: ../pp/login.html');
		}
	
		//Receive username from clint side
		$entered_username = $_POST['username'];
		//Receive password from client side
		$entered_password = $_POST['password'];
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		if($entered_username!="" & $entered_password != ""){
			$login = 0;
			$sql = "SELECT id, username, password,email FROM userinfo WHERE username='$entered_username'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$id1 = $row["id"];
				$U1 = $row["username"];
				$P = $row["password"];
				$E = $row["email"];
			}
			} else {
				echo "Wrong username";
			}
			if($entered_password=$P){
					$login = 1;
					$_SESSION['user'] = $entered_username;
					//header('Location: ../pp/content.php');
			}
		
		if($login==0){
			echo "cannot connect to the database";//！
		}else{
			echo "Login successful!";
		}
		
		echo "<br/>Go <a href='../pp/login.html'>back</a> to login or <a href='../pp/register.html'>register</a>";
	}else{
		echo "Username and Password cannot be empty!";
		echo "<br/>Go <a href='../pp/login.html'>back</a> to login or <a href='../pp/register.html'>register</a>";
	}
?>


	</body>
</html>

